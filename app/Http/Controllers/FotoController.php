<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto; 
use App\Models\Album;
use App\Models\LikeFoto;
use App\Models\KomentarFoto;
class FotoController extends Controller
{
    public function show($id)
{
    $foto = Foto::withCount(['likes', 'komentars'])->findOrFail($id);
    $foto->isLikedByUser = $foto->likes()->where('UserID', auth()->id())->exists();
    $comments = $foto->komentars()->whereNull('parent_id')->with('user', 'replies.user')->latest()->get();

    return view('foto.show', compact('foto', 'comments'));
}
    public function create()
{
    $albums = Album::all(); 
    return view('foto.create', compact('albums'));
}
    public function updateKomentar(Request $request, $id)
{
    $komentar = \App\Models\KomentarFoto::findOrFail($id);
    
    
    if ($komentar->UserID !== auth()->id()) {
        return back()->with('error', 'Kamu tidak punya akses.');
    }

    $request->validate(['IsiKomentar' => 'required']);
    $komentar->update(['IsiKomentar' => $request->IsiKomentar]);

    return back()->with('success', 'Komentar diperbarui!');
}

public function destroyKomentar($id)
{
    $komentar = \App\Models\KomentarFoto::findOrFail($id);

    
    if ($komentar->UserID === auth()->id() || auth()->user()->role === 'admin') {
        $komentar->delete();
        return back()->with('success', 'Komentar dihapus!');
    }

    return back()->with('error', 'Gagal menghapus komentar.');
}
  public function like($id)
{
    $foto = Foto::findOrFail($id);
    $user_id = auth()->id();

    $existing_like = LikeFoto::where('FotoID', $id)->where('UserID', $user_id)->first();

    if ($existing_like) {
        $existing_like->delete();
        $isLiked = false;
    } else {
        LikeFoto::create([
            'FotoID' => $id,
            'UserID' => $user_id,
            'TanggalLike' => now()
        ]);
        $isLiked = true;
    }

    return response()->json([
        'likes_count' => $foto->likes()->count(),
        'isLiked' => $isLiked
    ]);
}

public function index()
{
    $fotos = Foto::withCount(['likes', 'komentars'])->latest()->get(); 
    
    foreach($fotos as $foto) {
        $foto->isLikedByUser = \App\Models\LikeFoto::where('FotoID', $foto->FotoID)
                                ->where('UserID', auth()->id())->exists();
        
        $foto->all_comments = \App\Models\KomentarFoto::where('FotoID', $foto->FotoID)
                                ->whereNull('parent_id') 
                                ->with(['user', 'replies.user']) 
                                ->latest()
                                ->get();
    }

    return view('foto.index', compact('fotos'));
}
public function storeKomentar(Request $request, $id) 
{
    $request->validate([
        'IsiKomentar' => 'required|string',
        'parent_id' => 'nullable|exists:komentar_fotos,KomentarID' 
    ]);

    KomentarFoto::create([
        'FotoID' => $id,
        'UserID' => auth()->id(),
        'IsiKomentar' => $request->IsiKomentar,
        'TanggalKomentar' => now(),
        'parent_id' => $request->parent_id, 
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan!');
} 
public function store(Request $request)
{
    $request->validate([
        'JudulFoto' => 'required|string|max:255',
        'DeskripsiFoto' => 'nullable|string',
        'file' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'AlbumID' => 'required|exists:albums,AlbumID', 
    ]);

    $file = $request->file('file');
    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('storage/fotos'), $namaFile);

    \App\Models\Foto::create([
        'JudulFoto' => $request->JudulFoto,
        'DeskripsiFoto' => $request->DeskripsiFoto,
        'TanggalUnggah' => now(),
        'LokasiFile' => $namaFile,
        'AlbumID' => $request->AlbumID,
        'UserID' => auth()->id(),
    ]);

    return redirect()->route('foto.index')->with('success', 'Foto berhasil ditambahkan ke album!');
}
public function edit($id)
{
    $foto = Foto::findOrFail($id);
    $albums = Album::all();
    return view('foto.edit', compact('foto', 'albums'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'JudulFoto' => 'required',
        'DeskripsiFoto' => 'required',
        'AlbumID' => 'required|exists:albums,AlbumID',
        'file' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $foto = Foto::findOrFail($id);

    if($request->hasFile('file'))
    {
        $oldFilePath = public_path('storage/fotos/' . $foto->LokasiFile);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $file = $request->file('file');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/fotos'), $namaFile);
        
        $foto->LokasiFile = $namaFile;
    }

    $foto->JudulFoto = $request->JudulFoto;
    $foto->DeskripsiFoto = $request->DeskripsiFoto;
    $foto->AlbumID = $request->AlbumID; 
    $foto->save();

    return redirect()->route('foto.index')->with('success', 'Foto berhasil diupdate!');
}
public function destroy($id)
{
    $foto = Foto::findOrFail($id);
    \Storage::disk('public')->delete($foto->LokasiFile);
    $foto->delete();

    return back()->with('success', 'Foto berhasil dihapus!');
}
}
