<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-orange-100 border-l-4 border-orange-500 text-orange-800 rounded shadow-lg animate-bounce">
                    <span class="font-bold">Sukses!</span> {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold text-orange-500 uppercase tracking-widest drop-shadow-md">
                    My <span class="text-white">ALBUMS</span>
                </h2>
                @if(auth()->user()->role == 'admin')
                <a href="{{ route('albums.create') }}" class="bg-orange-500 text-black font-black px-6 py-3 rounded-full hover:bg-white hover:scale-105 transition-all duration-300 border-2 border-white uppercase text-xs">
                    + ADD YOUR ALBUM
                </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($albums as $album)
                <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-6 rounded-[2rem] hover:border-orange-500 transition-all duration-300 group">
                    <h3 class="text-2xl font-black text-white mb-2 group-hover:text-orange-500 transition-colors">{{ $album->NamaAlbum }}</h3>
                    <p class="text-gray-300 text-sm mb-4 line-clamp-2 italic">"{{ $album->Deskripsi }}"</p>
                    
                    <div class="flex justify-between items-center border-t border-white/10 pt-4">
                        <span class="text-orange-400 font-bold text-xs uppercase tracking-tighter">{{ $album->fotos_count }} Photos</span>
                        <span class="text-white/50 text-[10px]">{{ \Carbon\Carbon::parse($album->TanggalDibuat)->format('d M Y') }}</span>
                    </div>

                    @if(auth()->user()->role == 'admin' || auth()->id() == $album->UserID)
                    <div class="mt-4 flex gap-4 border-t border-white/5 pt-4">
                        <a href="{{ route('albums.edit', $album->AlbumID) }}" 
                           class="text-[10px] font-black uppercase text-blue-400 hover:text-white transition-colors">
                           Edit Album
                        </a>
                        
                        <form action="{{ route('albums.destroy', $album->AlbumID) }}" method="POST" onsubmit="return confirm('Hapus album ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-[10px] font-black uppercase text-red-500 hover:text-white transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>