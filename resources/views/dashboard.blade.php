<x-app-layout>
    <div class="py-10 bg-gradient-to-br from-black via-gray-900 to-orange-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6 border-b border-orange-500/20 pb-8">
                <div>
                    <h2 class="text-5xl font-black text-white uppercase tracking-tighter">
                        Welcome <span class="text-orange-500 italic drop-shadow-[0_0_10px_rgba(249,115,22,0.5)]">DASHBOARD</span>
                    </h2>
                    <p class="text-gray-400 text-[10px] mt-2 uppercase tracking-[0.4em] font-bold">
                        Welcome back, <span class="text-orange-500">{{ Auth::user()->name }}</span> • System Operational
                    </p>
                </div>
                
                <div class="flex gap-4">
                    <a href="{{ route('foto.index') }}" 
                       class="bg-orange-500 text-black font-black px-8 py-3 rounded-full hover:bg-white hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(249,115,22,0.4)] border-2 border-white/20 uppercase text-[10px] tracking-widest">
                        Open Gallery
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-6 rounded-3xl shadow-2xl flex flex-col justify-between group hover:bg-orange-500 transition-all duration-500">
                    <p class="text-orange-400 group-hover:text-black text-[9px] font-black uppercase tracking-widest mb-4 transition-colors">Account Role</p>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl font-black text-white group-hover:text-black uppercase tracking-wider transition-colors">{{ auth()->user()->role }}</span>
                    </div>
                </div>

                <div class="bg-orange-600 text-black p-6 rounded-3xl flex flex-col justify-between shadow-[0_20px_40px_rgba(249,115,22,0.3)] border-2 border-white/20">
                    <p class="text-black/60 text-[9px] font-black uppercase tracking-widest mb-4">System Status</p>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black uppercase italic">Active</span>
                        <div class="w-3 h-3 rounded-full bg-black animate-ping"></div>
                    </div>
                </div>

                

                <div class="bg-white/10 backdrop-blur-lg border border-orange-500/30 p-6 rounded-3xl shadow-2xl flex flex-col justify-between">
                    <p class="text-orange-400 text-[9px] font-black uppercase tracking-widest mb-4">Server Time</p>
                    <div class="text-xl font-bold text-white uppercase tracking-tighter">
                        {{ now()->format('H:i') }} <span class="text-orange-500 text-xs">WIB</span>
                    </div>
                </div>
            </div>

            <div class="bg-black/40 backdrop-blur-md border border-orange-500/20 overflow-hidden relative rounded-[3rem] shadow-2xl">
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <svg class="w-80 h-80 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <div class="p-10 md:p-16 relative z-10">
                    <div class="max-w-2xl">
                        {{-- <span class="text-orange-500 text-[10px] font-black uppercase tracking-[0.5em] mb-4 block">
                            Secure Authentication
                        </span>
                        <h3 class="text-5xl font-black text-white tracking-tight uppercase mb-6 leading-none">
                            ACCESS <span class="text-orange-500">GRANTED.</span>
                        </h3> --}}
                        <p class="text-gray-300 text-sm leading-relaxed tracking-widest mb-10 border-l-4 border-orange-500 pl-6">
                            Sistem galeri telah siap digunakan. Anda dapat mulai mengunggah aset visual, mengatur koleksi album, dan memantau interaksi pengguna melalui panel navigasi utama. 
                        </p>
                        
                        <div class="flex flex-wrap gap-6">
                            <a href="{{ route('foto.create') }}" class="group flex items-center gap-4 text-white hover:text-orange-500 transition-all">
                                <span class="w-12 h-px bg-orange-500 group-hover:w-20 transition-all"></span>
                                <span class="text-[10px] font-black uppercase tracking-[0.5em]">Create New Galery</span>
                            </a>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="mt-12 flex items-center justify-center gap-4">
                <div class="h-px w-8 bg-orange-500/40"></div>
                <p class="text-[9px] text-gray-500 font-black uppercase tracking-[1em]">
                    STUDIOONE • 2026
                </p>
                <div class="h-px w-8 bg-orange-500/40"></div>
            </div>
        </div>
    </div>
</x-app-layout>