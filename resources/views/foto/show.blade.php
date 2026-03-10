<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-700 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            
            <a href="{{ route('foto.index') }}" class="group inline-flex items-center text-orange-500 hover:text-white mb-6 transition-all font-black uppercase tracking-widest text-xs drop-shadow-md">
                <span class="mr-2 group-hover:-translate-x-2 transition-transform">←</span> BACK TO GALLERY
            </a>

            <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-orange-400/30 flex flex-col lg:flex-row min-h-[80vh]">
                
                <div class="lg:w-2/3 bg-black flex items-center justify-center p-4 md:p-10 relative">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#f97316 0.5px, transparent 0.5px); background-size: 20px 20px;"></div>
<img src="{{ asset('storage/fotos/'.$foto->LokasiFile) }}"                         class="relative z-10 max-w-full max-h-[70vh] object-contain rounded-xl shadow-[0_0_50px_rgba(249,115,22,0.3)] border border-orange-500/20" 
                         alt="{{ $foto->JudulFoto }}">
                </div>

                <div class="lg:w-1/3 flex flex-col bg-white h-[80vh]">
                    
                    <div class="p-8 pb-4 shrink-0">
                        <h2 class="text-3xl font-black text-gray-900 leading-tight uppercase tracking-tighter drop-shadow-sm">
                            {{ $foto->JudulFoto }}
                        </h2>
                        <div class="flex items-center gap-2 mt-2 text-[10px] font-black text-orange-600 uppercase tracking-widest">
                            <span class="bg-orange-100 px-2 py-1 rounded">📅 {{ $foto->created_at->format('d M Y') }}</span>
                            <span class="bg-gray-100 px-2 py-1 rounded text-gray-600 text-[9px]">By: {{ $foto->user->name ?? 'User' }}</span>
                        </div>
                        <p class="text-gray-500 mt-4 italic text-sm leading-relaxed border-l-4 border-orange-500 pl-4">
                            "{{ $foto->DeskripsiFoto }}"
                        </p>
                    </div>

                    <div class="px-8 shrink-0">
                        <div class="flex items-center justify-between py-4 border-y border-gray-100">
                            <button type="button" onclick="likeFoto(this, {{ $foto->FotoID }})" class="flex items-center gap-3 group">
                                <span class="heart-icon text-3xl group-active:scale-150 transition-transform duration-200">
                                    {{ $foto->isLikedByUser ? '❤️' : '🤍' }}
                                </span>
                                <div class="flex flex-col items-start">
                                    <span class="like-count font-black text-lg text-gray-900 leading-none">{{ $foto->likes_count }}</span>
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">LIKES</span>
                                </div>
                            </button>

                            <div class="flex flex-col items-end">
                                <span class="font-black text-lg text-gray-900 leading-none">{{ $foto->komentars_count }}</span>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">COMMENT</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto p-8 pt-6 custom-scrollbar space-y-6 bg-gray-50/50">
                        @forelse($comments as $k)
                            <div class="flex flex-col gap-3">
                                <div class="flex gap-3">
                                    <div class="h-10 w-10 rounded-full bg-black flex items-center justify-center text-xs font-black text-orange-500 border-2 border-orange-500/50 shrink-0 shadow-md">
                                        {{ substr($k->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 relative">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-[10px] font-black text-gray-900 uppercase">{{ $k->user->name }}</span>
                                                <span class="text-[9px] text-gray-400 font-bold">{{ $k->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $k->IsiKomentar }}</p>
                                        </div>
                                        
                                        <div class="flex gap-4 mt-2 ml-2">
                                            <button onclick="siapkanBalasan('{{ $k->user->name }}', {{ $k->KomentarID }})" 
                                                    class="text-[9px] font-black text-orange-500 uppercase tracking-widest hover:text-black transition-all">
                                                ↩ Balas
                                            </button>
                                            @if($k->replies->count() > 0)
                                                <button onclick="toggleBalasan({{ $k->KomentarID }})" 
                                                        class="text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-orange-600 transition-all">
                                                    👁️ <span id="btn-text-{{ $k->KomentarID }}">Lihat {{ $k->replies->count() }} Balasan</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div id="replies-{{ $k->KomentarID }}" class="hidden ml-12 space-y-3 border-l-2 border-orange-200 pl-4 animate-fade-in">
                                    @foreach($k->replies as $balasan)
                                        <div class="flex gap-2">
                                            <div class="h-7 w-7 rounded-full bg-orange-500 flex items-center justify-center text-[9px] font-black text-white shrink-0 shadow-sm">
                                                {{ substr($balasan->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1 bg-orange-50/50 rounded-xl p-3 border border-orange-100">
                                                <p class="text-[9px] font-black text-orange-700 uppercase mb-0.5">{{ $balasan->user->name }}</p>
                                                <p class="text-xs text-gray-800">{{ $balasan->IsiKomentar }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-gray-400 italic text-[10px] uppercase tracking-widest font-black">No discussion yet...</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-6 bg-white border-t border-gray-100 shrink-0">
                        <div id="reply-info" class="hidden mb-3 text-[10px] text-white font-black bg-black p-3 rounded-xl flex justify-between items-center animate-fade-in uppercase">
                            <span>↩ Membalas: <span id="reply-name" class="text-orange-500"></span></span>
                            <button onclick="batalBalas()" class="text-lg hover:text-red-500 transition-colors">&times;</button>
                        </div>

                        <form action="{{ route('komentar.store', $foto->FotoID) }}" method="POST" class="relative">
                            @csrf
                            <input type="hidden" name="parent_id" id="parent_id">
                            <textarea name="IsiKomentar" id="input-komentar" rows="2" placeholder="Input Your Comment.." required
                                      class="w-full bg-gray-100 border-none rounded-2xl p-4 pr-16 text-sm focus:ring-2 focus:ring-orange-500 transition-all resize-none shadow-inner"></textarea>
                            
                            <button class="absolute bottom-3 right-3 bg-orange-500 text-black p-3 rounded-xl hover:bg-black hover:text-orange-500 transition-all shadow-lg group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleBalasan(id) {
            const area = document.getElementById('replies-' + id);
            const text = document.getElementById('btn-text-' + id);
            area.classList.toggle('hidden');
            text.innerText = area.classList.contains('hidden') ? `Lihat ${area.children.length} Balasan` : 'Sembunyikan Balasan';
        }

        function siapkanBalasan(nama, id) {
            document.getElementById('reply-info').classList.remove('hidden');
            document.getElementById('reply-name').innerText = nama;
            document.getElementById('parent_id').value = id;
            document.getElementById('input-komentar').focus();
            document.getElementById('input-komentar').placeholder = "Balas " + nama + "...";
        }

        function batalBalas() {
            document.getElementById('reply-info').classList.add('hidden');
            document.getElementById('parent_id').value = '';
            document.getElementById('input-komentar').placeholder = "Tulis pendapatmu...";
        }

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
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>