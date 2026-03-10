<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            
            <div class="mb-8">
                <h2 class="text-4xl font-extrabold text-orange-500 uppercase tracking-widest drop-shadow-md">
                    ADD <span class="text-white">GALLERY</span>
                </h2>
            </div>

            <div class="bg-white overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[2.5rem] border border-orange-400/30">
                <div class="p-8 md:p-10">
                    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">SELECT YOUR FILE</label>
                            <div class="relative group">
                                <input type="file" name="file" required
                                       class="block w-full text-sm text-gray-500
                                              file:mr-4 file:py-3 file:px-6
                                              file:rounded-2xl file:border-0
                                              file:text-xs file:font-black file:uppercase
                                              file:bg-orange-500 file:text-black
                                              hover:file:bg-black hover:file:text-white
                                              file:transition-all file:duration-300
                                              bg-gray-50 rounded-2xl border border-gray-200 p-2">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2">"JPG, PNG, WEBP.</p>
                        </div>

                        <div class="mb-6">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Your Title</label>
                            <input type="text" name="JudulFoto" placeholder="" required
                                   class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner">
                        </div>

                        <div class="mb-8">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="DeskripsiFoto" rows="5" placeholder=""
                                      class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner"></textarea>
                        </div>

                        <input type="hidden" name="AlbumID" value="1">

                        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('foto.index') }}" 
                               class="text-gray-500 hover:text-orange-600 font-black text-xs uppercase tracking-widest transition-colors">
                                &larr; Back TO Gallery
                            </a>
                            
                            <button type="submit" 
                                    class="w-full md:w-auto bg-black text-orange-500 font-black px-12 py-4 rounded-2xl shadow-xl hover:bg-orange-500 hover:text-black hover:scale-105 transition-all duration-300 border-2 border-orange-500 uppercase text-xs tracking-widest">
                                Save Photo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>