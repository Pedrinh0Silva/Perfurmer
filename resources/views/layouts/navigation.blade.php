<nav x-data="{ open: false }" class="navbar-brand">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline">
                        <svg class="h-9 w-auto text-emerald-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M512 64c0 113.6-84.6 207.5-194.2 222.4C305.5 304.4 288 326.3 288 352V448c0 17.7-14.3 32-32 32s-32-14.3-32-32V352c0-25.7-17.5-47.6-30.2-65.6C84.7 271.5 0 177.6 0 64C0 28.7 28.7 0 64 0c117.4 0 216.6 84.4 239.1 196.5c2.6-1.5 5.4-3 8.3-4.5C333.9 84.4 433.1 0 550.4 0c35.3 0 64 28.7 64 64zM64 64c0 79.5 54.8 146.2 128.8 164c-34.4-44.6-54.3-100-54.3-160c0-1.3 0-2.7 .1-4H64zm384 0c0 1.3 0 2.7-.1 4c0 60-19.9 115.4-54.3 160c74.1-17.7 128.8-84.5 128.8-164H448z"/>
                        </svg>
                        <span style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.25rem; color: #2d4739;">Perfurmer</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('flores.index')" :active="request()->routeIs('flores.*')">
                        {{ __('Flores') }}
                    </x-nav-link>

                    <x-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')">
                        {{ __('Clientes') }}
                    </x-nav-link>

                    <x-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.*')">
                        {{ __('Vendas') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-stone-200 text-sm leading-4 font-medium rounded-md text-stone-600 bg-stone-50 hover:text-emerald-700 hover:border-emerald-200 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()?->name ?? 'Visitante' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-emerald-700 font-medium underline">Entrar</a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-emerald-500 hover:bg-stone-100 focus:outline-none focus:bg-stone-100 focus:text-emerald-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-stone-50 border-t border-stone-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('flores.index')" :active="request()->routeIs('flores.*')">
                {{ __('Flores') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')">
                {{ __('Clientes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.*')">
                {{ __('Vendas') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>  