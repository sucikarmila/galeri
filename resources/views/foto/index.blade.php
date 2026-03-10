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
                       class="bg-orange-500 text-black font-black px-8 py-3 rounded-full shadow-xl hover:bg-orange-600 hover:scale-105 transition-all duration-300 border-2 border-white uppercase text-sm">
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
                    <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-5 rounded-3xl shadow-2xl col-span-2 md:col-span-2">
                        <p class="text-orange-400 text-[10px] font-black uppercase tracking-widest mb-2">Informasi Akun</p>
                        <p class="text-white font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[2rem] border border-orange-400/30">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black text-orange-400 uppercase">
                            <tr>
                                <th class="px-6 py-6 text-left text-xs font-black tracking-widest">PHOTO</th>
                                <th class="px-6 py-6 text-left text-xs font-black tracking-widest">DESCRIPTION</th>
                                <th class="px-6 py-6 text-center text-xs font-black tracking-widest">INTERACTION</th>
                                <th class="px-6 py-6 text-center text-xs font-black tracking-widest">Detail</th>
                                @if(auth()->user()->role == 'admin')
                                    <th class="px-6 py-6 text-right text-xs font-black tracking-widest">Option</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($fotos as $foto)
                                <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="relative group w-24 h-24">
                                            <img src="{{ asset('storage/fotos/'.$foto->LokasiFile) }}" 
     class="w-full h-full object-cover rounded-2xl border-2 border-orange-500 shadow-md group-hover:rotate-3 transition-transform duration-300"
     alt="{{ $foto->JudulFoto }}">
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="text-lg font-black text-gray-900 leading-tight">{{ $foto->JudulFoto }}</div>
                                        <div class="text-sm text-gray-500 mt-1 italic line-clamp-2">{{ $foto->DeskripsiFoto }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center items-center gap-8">
                                            <button type="button" onclick="likeFoto(this, {{ $foto->FotoID }})" 
                                                    class="flex flex-col items-center group focus:outline-none">
                                                <span class="heart-icon text-2xl group-active:scale-150 transition-transform duration-200">
                                                    {{ $foto->isLikedByUser ? '❤️' : '🤍' }}
                                                </span>
                                                <span class="like-count font-black text-xs text-gray-700 mt-1">{{ $foto->likes_count }}</span>
                                            </button>

                                            <button onclick="toggleKomentar({{ $foto->FotoID }})" 
                                                    class="flex flex-col items-center group hover:text-orange-600 transition-colors">
                                                <span class="text-2xl group-hover:animate-bounce">💬</span>
                                                <span class="font-black text-xs text-gray-700 mt-1">{{ $foto->komentars_count }}</span>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('foto.show', $foto->FotoID) }}" 
                                           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-black hover:text-white text-black px-4 py-2 rounded-xl transition-all font-black text-xs uppercase tracking-widest border border-gray-200">
                                            <span>👁️</span> VIEW
                                        </a>
                                    </td>
                                    
                                    @if(auth()->user()->role == 'admin')
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('foto.edit', $foto->FotoID) }}" 
                                                   class="text-blue-600 hover:text-white hover:bg-blue-600 border-2 border-blue-600 px-4 py-2 rounded-xl transition-all font-bold text-xs uppercase">
                                                    Update
                                                </a>
                                                <form action="{{ route('foto.destroy', $foto->FotoID) }}" method="POST" onsubmit="return confirm('Hapus foto permanen?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-white hover:bg-red-600 border-2 border-red-600 px-4 py-2 rounded-xl transition-all font-bold text-xs uppercase">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>

                                <tr id="row-komentar-{{ $foto->FotoID }}" class="hidden">
                                    <td colspan="{{ auth()->user()->role == 'admin' ? 5 : 4 }}" class="px-12 py-8 bg-gray-50/50">
                                        <div class="bg-white rounded-3xl p-6 shadow-inner border border-gray-100">
                                            <h4 class="font-bold text-gray-800 mb-6 flex items-center gap-2 uppercase tracking-tighter">
                                                <span class="w-2 h-6 bg-orange-500 rounded-full"></span> Diskusi Galeri
                                            </h4>
                                            
                                            <div class="space-y-6 mb-6 max-h-[400px] overflow-y-auto custom-scrollbar pr-4">
                                                @forelse($foto->all_comments as $k)
                                                    <div class="flex flex-col gap-3 mb-4">
                                                        <div class="flex gap-3 items-start">
                                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-600 shrink-0 border-2 border-white">
                                                                {{ substr($k->user->name, 0, 1) }}
                                                            </div>
                                                            <div class="flex-1 bg-gray-50 rounded-2xl p-4 relative border border-gray-100">
                                                                <div class="flex justify-between items-center mb-1">
                                                                    <p class="text-xs font-black text-gray-900 uppercase">{{ $k->user->name }}</p>
                                                                    <div class="flex items-center gap-2 text-[10px] text-gray-400">
                                                                        {{ $k->created_at->diffForHumans() }}
                                                                        @if($k->UserID === auth()->id() || auth()->user()->role === 'admin')
                                                                            <button onclick="tampilEditKomentar({{ $k->KomentarID }})" class="text-blue-500 hover:underline">Edit</button>
                                                                            <form action="{{ route('komentar.destroy', $k->KomentarID) }}" method="POST" class="inline">
                                                                                @csrf @method('DELETE')
                                                                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div id="text-komentar-{{ $k->KomentarID }}" class="text-sm text-gray-700">{{ $k->IsiKomentar }}</div>
                                                                
                                                                <form id="form-edit-{{ $k->KomentarID }}" action="{{ route('komentar.update', $k->KomentarID) }}" method="POST" class="hidden mt-2">
                                                                    @csrf @method('PUT')
                                                                    <textarea name="IsiKomentar" class="w-full text-sm border-gray-300 rounded-lg" rows="2">{{ $k->IsiKomentar }}</textarea>
                                                                    <div class="flex gap-2 mt-2">
                                                                        <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded text-[10px]">Simpan</button>
                                                                        <button type="button" onclick="tutupEditKomentar({{ $k->KomentarID }})" class="bg-gray-500 text-white px-3 py-1 rounded text-[10px]">Batal</button>
                                                                    </div>
                                                                </form>

                                                                <button onclick="siapkanBalasan('{{ $k->user->name }}', {{ $foto->FotoID }}, {{ $k->KomentarID }})" 
                                                                        class="mt-2 text-[10px] font-black text-orange-500 uppercase">↩ Balas</button>
                                                            </div>
                                                        </div>

                                                        @foreach($k->replies as $balasan)
                                                            <div class="flex gap-3 items-start ml-12 border-l-2 border-orange-200 pl-4 mt-2">
                                                                <div class="h-8 w-8 rounded-full bg-orange-500 flex items-center justify-center text-[10px] font-bold text-white shrink-0">
                                                                    {{ substr($balasan->user->name, 0, 1) }}
                                                                </div>
                                                                <div class="flex-1 bg-orange-50 rounded-2xl p-3 border border-orange-100">
                                                                    <p class="text-[10px] font-black text-orange-700 uppercase">{{ $balasan->user->name }}</p>
                                                                    <div class="text-sm text-gray-800">{{ $balasan->IsiKomentar }}</div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @empty
                                                    <p class="text-center text-gray-400 italic text-sm">Belum ada komentar.</p>
                                                @endforelse
                                            </div>

                                            <div class="mt-4 pt-4 border-t">
                                                <div id="reply-indicator-{{ $foto->FotoID }}" class="hidden mb-2 text-xs text-orange-600 font-bold bg-orange-50 p-2 rounded-lg flex justify-between">
                                                    <span>Membalas: <span id="reply-target-{{ $foto->FotoID }}"></span></span>
                                                    <button onclick="batalBalas({{ $foto->FotoID }})">&times;</button>
                                                </div>
                                                <form action="{{ route('komentar.store', $foto->FotoID) }}" method="POST" class="flex gap-2">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" id="parent-id-{{ $foto->FotoID }}">
                                                    <input type="text" name="IsiKomentar" id="input-komentar-{{ $foto->FotoID }}"
                                                           placeholder="Tulis pendapatmu..." required
                                                           class="flex-1 bg-gray-100 border-none rounded-2xl px-5 text-sm py-3 shadow-inner focus:ring-2 focus:ring-orange-400">
                                                    <button class="bg-orange-500 text-white px-8 py-3 rounded-2xl font-black hover:bg-black transition-all text-xs uppercase">Kirim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role == 'admin' ? 5 : 4 }}" class="px-6 py-24 text-center">
                                        <div class="text-6xl mb-4">🏜️</div>
                                        <p class="text-gray-400 font-black text-xl">Galeri masih kosong melompong...</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
            if(!row.classList.contains('hidden')) row.classList.add('animate-fade-in');
        }

        function siapkanBalasan(nama, fotoId, commentId) {
            document.getElementById('reply-indicator-' + fotoId).classList.remove('hidden');
            document.getElementById('reply-target-' + fotoId).innerText = nama;
            document.getElementById('parent-id-' + fotoId).value = commentId;
            document.getElementById('input-komentar-' + fotoId).focus();
        }

        function batalBalas(fotoId) {
            document.getElementById('reply-indicator-' + fotoId).classList.add('hidden');
            document.getElementById('parent-id-' + fotoId).value = '';
        }

        function tampilEditKomentar(id) {
            document.getElementById('text-komentar-' + id).classList.add('hidden');
            document.getElementById('form-edit-' + id).classList.remove('hidden');
        }

        function tutupEditKomentar(id) {
            document.getElementById('text-komentar-' + id).classList.remove('hidden');
            document.getElementById('form-edit-' + id).classList.add('hidden');
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f97316; border-radius: 20px; }
        .animate-fade-in { animation: fadeIn 0.4s ease forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>