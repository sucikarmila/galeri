<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-orange-500 uppercase mb-8">UPDATE <span class="text-white">ALBUM</span></h2>

            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-2xl border border-orange-400/30">
                <form action="{{ route('albums.update', $album->AlbumID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Album Name</label>
                        <input type="text" name="NamaAlbum" value="{{ $album->NamaAlbum }}" required
                               class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div class="mb-8">
                        <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Description</label>
                        <textarea name="Deskripsi" rows="5" 
                                  class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500">{{ $album->Deskripsi }}</textarea>
                    </div>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('albums.index') }}" class="text-gray-500 font-black text-xs uppercase">&larr; Back</a>
                        <button type="submit" class="bg-orange-500 text-black font-black px-10 py-3 rounded-2xl hover:bg-black hover:text-orange-500 transition-all uppercase text-xs">
                            Update Album
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>