<x-guest-layout>
    <div class="flex flex-col items-center justify-center p-4 min-h-screen">
        
        <div class="w-full max-w-[450px] bg-gradient-to-b from-[#1a1c23] to-[#0a0a0a] rounded-[3rem] p-10 border border-white/5 shadow-2xl relative overflow-hidden">
            
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-orange-500/10 blur-[80px]"></div>
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-white tracking-tighter uppercase">
                    JOIN <span class="text-orange-500">GALLERY</span>
                </h1>
               
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="relative group">
                    <label class="block text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                        placeholder="Your Name"
                        class="w-full bg-[#12141a] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-700 focus:ring-2 focus:ring-orange-500/50 transition-all shadow-inner text-sm">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                </div>

                <div class="relative group">
                    <label class="block text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2 ml-1">Username</label>
                    <input id="username" type="text" name="username" :value="old('username')" required 
                        placeholder="CECImila"
                        class="w-full bg-[#12141a] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-700 focus:ring-2 focus:ring-orange-500/50 transition-all shadow-inner text-sm">
                    <x-input-error :messages="$errors->get('username')" class="mt-1 text-xs" />
                </div>

                <div class="relative group">
                    <label class="block text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required 
                        placeholder="Input Your Email"
                        class="w-full bg-[#12141a] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-700 focus:ring-2 focus:ring-orange-500/50 transition-all shadow-inner text-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative group">
                        <label class="block text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2 ml-1">Password</label>
                        <input id="password" type="password" name="password" required 
                            placeholder="••••••••"
                            class="w-full bg-[#12141a] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-700 focus:ring-2 focus:ring-orange-500/50 transition-all shadow-inner text-sm">
                    </div>
                    <div class="relative group">
                        <label class="block text-[9px] font-black text-orange-500 uppercase tracking-widest mb-2 ml-1">Confirm</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                            placeholder="••••••••"
                            class="w-full bg-[#12141a] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-700 focus:ring-2 focus:ring-orange-500/50 transition-all shadow-inner text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="col-span-2 mt-1 text-xs" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="col-span-2 mt-1 text-xs" />
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-black font-black py-5 rounded-[1.2rem] shadow-[0_15px_30px_rgba(249,115,22,0.3)] hover:shadow-orange-500/40 hover:-translate-y-1 active:translate-y-0 transition-all duration-300 uppercase text-[11px] tracking-[0.25em]">
                        Register
                    </button>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-[10px] font-bold text-gray-500 uppercase tracking-widest hover:text-orange-500 transition-colors">
                        Already registered? <span class="text-orange-500">Login</span>
                    </a>
                </div>
            </form>
        </div>

        <p class="mt-10 text-[9px] text-gray-800 font-black uppercase tracking-[0.6em] text-center">
            STUDIOONE • CREATIVE SYSTEM
        </p>
    </div>
</x-guest-layout>