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

<div class="mb-6">
    <label class="block text-gray-900 font-black text-xs uppercase tracking-[0.2em] mb-2">Assign to Album</label>
    <div class="relative">
        <select name="AlbumID" required 
                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-3 text-gray-900 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none cursor-pointer shadow-inner">
            <option value="" class="text-gray-400" disabled selected>-- Select Album --</option>
            @foreach($albums as $album)
                <option value="{{ $album->AlbumID }}" class="text-gray-900">{{ $album->NamaAlbum }}</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-orange-500">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
            </svg>
        </div>
    </div>
    @error('AlbumID')
        <p class="text-red-500 text-[10px] mt-1 italic uppercase font-bold">{{ $message }}</p>
    @enderror
</div>
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