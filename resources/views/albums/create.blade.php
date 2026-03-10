<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            
            <div class="mb-8">
                <h2 class="text-4xl font-extrabold text-orange-500 uppercase tracking-widest drop-shadow-md">
                    ADD <span class="text-white">ALBUM</span>
                </h2>
            </div>

            <div class="bg-white overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[2.5rem] border border-orange-400/30">
                <div class="p-8 md:p-10">
                    <form action="{{ route('albums.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Album Name</label>
                            <input type="text" name="NamaAlbum" placeholder="Contoh: Liburan 2024" required
                                   class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner">
                        </div>

                        <div class="mb-8">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="Deskripsi" rows="5" placeholder="Ceritakan tentang album ini..."
                                      class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner"></textarea>
                        </div>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('albums.index') }}" 
                               class="text-gray-500 hover:text-orange-600 font-black text-xs uppercase tracking-widest transition-colors">
                                &larr; Back TO Albums
                            </a>
                            
                            <button type="submit" 
                                    class="bg-orange-500 text-black font-black px-10 py-3 rounded-2xl hover:bg-black hover:text-orange-500 transition-all uppercase text-xs">
                             Save Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>