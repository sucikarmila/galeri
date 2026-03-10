<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-4xl font-extrabold text-orange-500 uppercase tracking-widest drop-shadow-md">
                        EDIT <span class="text-white">FOTO</span>
                    </h2>
                    <p class="text-gray-400 text-sm mt-2 italic">Perbarui informasi atau ganti visual koleksimu.</p>
                </div>
                <div class="text-right hidden md:block">
                    <span class="text-[10px] font-black text-orange-400 uppercase tracking-widest bg-white/5 px-4 py-2 rounded-full border border-orange-500/20">
                        ID: #{{ $foto->FotoID }}
                    </span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[2.5rem] border border-orange-400/30">
                <div class="p-8 md:p-10">
                    <form action="{{ route('foto.update', $foto->FotoID) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-8">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-4">Visual Saat Ini</label>
                            <div class="flex flex-col md:flex-row gap-6 items-center">
                                <div class="relative w-40 h-40 shrink-0">
                                    <img src="{{ asset('storage/'.$foto->LokasiFile) }}" 
                                         class="w-full h-full object-cover rounded-3xl border-4 border-orange-500 shadow-xl rotate-2"
                                         alt="Current Image">
                                    <div class="absolute -bottom-2 -right-2 bg-black text-white text-[8px] font-black px-3 py-1 rounded-full uppercase">Aktif</div>
                                </div>
                                
                                <div class="flex-1 w-full">
                                    <label class="block font-bold text-[10px] text-gray-400 uppercase mb-2">Ganti File (Opsional)</label>
                                    <input type="file" name="file" 
                                           class="block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-xl file:border-0
                                                  file:text-[10px] file:font-black file:uppercase
                                                  file:bg-black file:text-orange-500
                                                  hover:file:bg-orange-500 hover:file:text-black
                                                  file:transition-all file:duration-300
                                                  bg-gray-50 rounded-xl border border-gray-100 p-1">
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Judul Foto</label>
                            <input type="text" name="JudulFoto" value="{{ $foto->JudulFoto }}" required
                                   class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner">
                        </div>

                        <div class="mb-8">
                            <label class="block font-black text-xs text-gray-900 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="DeskripsiFoto" rows="5" 
                                      class="w-full bg-gray-50 border-gray-200 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 shadow-inner">{{ $foto->DeskripsiFoto }}</textarea>
                        </div>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('foto.index') }}" 
                               class="text-gray-400 hover:text-black font-black text-xs uppercase tracking-widest transition-colors flex items-center gap-2">
                                &larr; Batalkan Postingan
                            </a>
                            
                            <button type="submit" 
                                    class="w-full md:w-auto bg-orange-500 text-black font-black px-12 py-4 rounded-2xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:bg-black hover:text-orange-500 hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-orange-500 uppercase text-xs tracking-widest">
                                Update Postingan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        
        </div>
    </div>
</x-app-layout>