<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth; 
class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('user')->withCount('fotos')->get();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => now(),
            'UserID' => Auth::id(),
        ]);

        return redirect()->route('albums.index')->with('success', 'Album berhasil dibuat!');
    }

public function edit($id)
{
    $album = Album::findOrFail($id);
    if (auth()->user()->role !== 'admin' && $album->UserID !== auth()->id()) {
        abort(403);
    }
    return view('albums.edit', compact('album'));
}

public function update(Request $request, $id)
{
    $album = Album::findOrFail($id);
    
    $request->validate([
        'NamaAlbum' => 'required|string|max:255',
        'Deskripsi' => 'nullable|string',
    ]);

    $album->update([
        'NamaAlbum' => $request->NamaAlbum,
        'Deskripsi' => $request->Deskripsi,
    ]);

    return redirect()->route('albums.index')->with('success', 'Album berhasil diperbarui!');
}

public function destroy($id)
{
    $album = Album::findOrFail($id);
    
    $album->delete();

    return redirect()->route('albums.index')->with('success', 'Album telah dihapus!');
}
}
