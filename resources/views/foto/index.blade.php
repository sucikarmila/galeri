<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            @if(session('success'))
                <div class="mb-6 p-4 bg-orange-100 border-l-4 border-orange-500 text-orange-800 rounded shadow-lg animate-bounce">
                    <span class="font-bold">Sukses!</span> {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-4xl font-extrabold text-orange-500 uppercase tracking-widest drop-shadow-md">
                    My <span class="text-white">GALLERY</span>
                </h2>
                
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('foto.create') }}" 
                       class="bg-orange-500 text-black font-black px-8 py-3 rounded-full shadow-xl hover:bg-white hover:scale-105 transition-all duration-300 border-2 border-white uppercase text-sm">
                        + ADD YOUR PHOTO
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl flex flex-col justify-between">
                    <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">TOTAL PHOTO</p>
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-black text-white leading-none">{{ $fotos->count() }}</span>
                        <span class="text-orange-500 text-xs font-bold uppercase mb-1">Files</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl">
                    <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">STATUS</p>
                    <div class="flex items-center gap-2">
                        <span class="text-xl font-black text-white uppercase">{{ auth()->user()->role }}</span>
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    </div>
                </div>

                @if(auth()->user()->role == 'admin')
                    <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl">
                        <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">Total Likes</p>
                        <div class="flex items-center gap-2">
                            <span class="text-3xl font-black text-white leading-none">{{ $fotos->sum('likes_count') }}</span>
                            <span class="text-2xl">❤️</span>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl">
                        <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">Comment</p>
                        <div class="flex items-center gap-2">
                            <span class="text-3xl font-black text-white leading-none">{{ $fotos->sum('komentars_count') }}</span>
                            <span class="text-2xl">💬</span>
                        </div>
                    </div>
                @else
                    <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl col-span-2">
                        <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">Informasi Akun</p>
                        <p class="text-white font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($fotos as $foto)
                    <div class="group relative bg-white/5 backdrop-blur-md border border-white/10 rounded-[2.5rem] overflow-hidden hover:border-orange-500 transition-all duration-500 shadow-2xl">
                        <div class="aspect-square overflow-hidden relative">
                            <img src="{{ asset('storage/fotos/'.$foto->LokasiFile) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                 alt="{{ $foto->JudulFoto }}">
                            
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-6">
                                <button onclick="likeFoto(this, {{ $foto->FotoID }})" class="text-center group/like">
                                    <span class="heart-icon text-3xl block transform group-hover/like:scale-125 transition-transform">
                                        {{ $foto->isLikedByUser ? '❤️' : '🤍' }}
                                    </span>
                                    <span class="like-count text-white text-xs font-black">{{ $foto->likes_count }}</span>
                                </button>
                                
                                <a href="{{ route('foto.show', $foto->FotoID) }}" class="bg-orange-500 p-4 rounded-full hover:bg-white transition-colors group/view">
                                    <span class="text-xl group-hover/view:scale-110">👁️</span>
                                </a>

                                <button onclick="toggleKomentar({{ $foto->FotoID }})" class="text-center group/comm">
                                    <span class="text-3xl block transform group-hover/comm:rotate-12 transition-transform">💬</span>
                                    <span class="text-white text-xs font-black">{{ $foto->komentars_count }}</span>
                                </button>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-black text-white truncate mb-1">{{ $foto->JudulFoto }}</h3>
                            <p class="text-gray-400 text-xs italic line-clamp-1 mb-4">"{{ $foto->DeskripsiFoto }}"</p>
                            
                            <div class="flex justify-between items-center">
                                @if(auth()->user()->role == 'admin')
                                    <div class="flex gap-3">
                                        <a href="{{ route('foto.edit', $foto->FotoID) }}" class="text-[10px] font-black uppercase text-blue-400 hover:text-white transition-colors">Edit</a>
                                        <form action="{{ route('foto.destroy', $foto->FotoID) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-[10px] font-black uppercase text-red-500 hover:text-white transition-colors">Delete</button>
                                        </form>
                                    </div>
                                @endif
                                <span class="text-[10px] text-white/30 font-bold uppercase tracking-widest">{{ $foto->created_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div id="row-komentar-{{ $foto->FotoID }}" class="hidden p-6 bg-black/40 border-t border-white/5 animate-fade-in">
                             <p class="text-orange-400 text-[10px] font-black mb-4 uppercase">Diskusi Singkat</p>
                             <div class="max-h-40 overflow-y-auto custom-scrollbar mb-4">
                                @forelse($foto->all_comments->take(3) as $k)
                                    <div class="text-xs text-gray-300 mb-2">
                                        <span class="font-bold text-orange-500">{{ $k->user->name }}:</span> {{ $k->IsiKomentar }}
                                    </div>
                                @empty
                                    <p class="text-[10px] text-gray-500 italic">Belum ada komentar...</p>
                                @endforelse
                             </div>
                             <a href="{{ route('foto.show', $foto->FotoID) }}" class="text-[10px] block text-center font-black text-white bg-white/10 py-2 rounded-lg hover:bg-orange-500 transition-colors uppercase">Buka Semua Komentar</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="text-6xl mb-4">🏜️</div>
                        <p class="text-gray-400 font-black text-xl italic uppercase tracking-widest">Galeri masih kosong melompong...</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function likeFoto(button, fotoId) {
            const likeCountLabel = button.querySelector('.like-count');
            const heartIcon = button.querySelector('.heart-icon');

            fetch(`/foto/${fotoId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                likeCountLabel.innerText = data.likes_count;
                heartIcon.innerText = data.isLiked ? '❤️' : '🤍';
            });
        }

        function toggleKomentar(id) {
            const row = document.getElementById('row-komentar-' + id);
            row.classList.toggle('hidden');
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>