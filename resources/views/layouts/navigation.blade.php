<nav x-data="{ open: false }" class="bg-black border-b border-white/10 sticky top-0 z-50 shadow-[0_4px_30px_rgba(0,0,0,0.5)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
                        <div class="bg-white p-2 rounded-none transform transition-transform group-hover:rotate-90 duration-500">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            </svg>
                        </div>
                        <span class="text-white font-light tracking-[0.3em] text-xl uppercase">
                            STUDIO<span class="font-black">ONE</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-12 sm:-my-px sm:ms-16 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="text-[10px] uppercase font-bold tracking-[0.2em] !text-white/50 hover:!text-white border-b-2 !border-transparent hover:!border-white transition-all duration-300">
        {{ __('Overview') }}
    </x-nav-link>
    
    <x-nav-link :href="route('albums.index')" :active="request()->routeIs('albums.index')"
                class="text-[10px] uppercase font-bold tracking-[0.2em] !text-white/50 hover:!text-white border-b-2 !border-transparent hover:!border-white transition-all duration-300">
        {{ __('Albums') }}
    </x-nav-link>

    <x-nav-link :href="route('foto.index')" :active="request()->routeIs('foto.index')"
                class="text-[10px] uppercase font-bold tracking-[0.2em] !text-white/50 hover:!text-white border-b-2 !border-transparent hover:!border-white transition-all duration-300">
        {{ __('The Gallery') }}
    </x-nav-link>
</div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-6 py-2 border border-white/20 text-[10px] font-black rounded-none text-white bg-transparent hover:bg-white hover:text-black focus:outline-none transition-all duration-500 uppercase tracking-[0.2em]">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-2 opacity-50">
                                <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-black border border-white/20 rounded-none overflow-hidden">
                            <x-dropdown-link :href="route('profile.edit')" class="!text-white/70 hover:!bg-white hover:!text-black font-bold uppercase text-[9px] tracking-widest py-3">
                                {{ __('Account Settings') }}
                            </x-dropdown-link>

                            <div class="border-t border-white/10"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="!text-white/40 hover:!bg-red-600 hover:!text-white font-bold uppercase text-[9px] tracking-widest py-3"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-white hover:bg-white hover:text-black transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 8h16M4 16h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-white/10">
        <div class="pt-4 pb-6 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                   class="!text-white/60 hover:!bg-white hover:!text-black font-black uppercase text-xs tracking-widest py-4">
                {{ __('Overview') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('foto.index')" :active="request()->routeIs('foto.index')"
                                   class="!text-white/60 hover:!bg-white hover:!text-black font-black uppercase text-xs tracking-widest py-4">
                {{ __('The Gallery') }}
            </x-responsive-nav-link>

            </div>

        <div class="pt-4 pb-6 border-t border-white/10 px-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 border border-white flex items-center justify-center font-light text-xl text-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-sm text-white uppercase tracking-widest">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-white/50 uppercase tracking-tighter">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="!text-white/40 !p-0 font-bold uppercase text-[10px] tracking-widest hover:!text-white">
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="!text-red-500 !p-0 font-bold uppercase text-[10px] tracking-widest"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>