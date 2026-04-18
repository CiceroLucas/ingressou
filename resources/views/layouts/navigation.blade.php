<nav x-data="{ open: false }" class="bg-white border-b border-neutral-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-black text-neutral-900 tracking-tight flex items-center gap-2">
                        <span class="text-2xl opacity-80">🎫</span> Ingressou
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('profile.tickets')" :active="request()->routeIs('profile.ticket*')">
                            {{ __('Meus Ingressos') }}
                        </x-nav-link>

                        @if(Auth::user()->is_admin)
                            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                                {{ __('Gerenciar Eventos') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.scanner')" :active="request()->routeIs('admin.scanner')">
                                {{ __('Scanner') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-neutral-200 text-sm leading-4 font-semibold rounded-lg text-neutral-700 bg-white hover:bg-neutral-50 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                @if(Auth::user()->is_admin)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-900 text-white uppercase tracking-wider">
                                        Admin
                                    </span>
                                @endif

                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-neutral-600 hover:text-neutral-900 transition mr-6">Entrar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-sm font-semibold px-4 py-2 bg-neutral-900 text-white rounded-lg hover:bg-neutral-800 transition shadow-sm">Criar Conta</a>
                    @endif
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-neutral-500 hover:text-neutral-900 hover:bg-neutral-100 focus:outline-none focus:bg-neutral-100 focus:text-neutral-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-neutral-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Início') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('profile.tickets')" :active="request()->routeIs('profile.ticket*')">
                    {{ __('Meus Ingressos') }}
                </x-responsive-nav-link>

                @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                        {{ __('Gerenciar Eventos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.scanner')" :active="request()->routeIs('admin.scanner')">
                        {{ __('Scanner') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-neutral-200">
            @auth
                <div class="px-4">
                    <div class="font-bold text-base text-neutral-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-neutral-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth

            @guest
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Entrar') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Criar Conta') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endguest
        </div>
    </div>
</nav>
