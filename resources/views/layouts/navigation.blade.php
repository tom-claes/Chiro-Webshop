<nav x-data="{ open: false }" style="display: flex; justify-content: space-between; align-items: center;" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 h-20 flex items-center">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-auto w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')">
                        {{ __('Homepagina') }}
                    </x-nav-link>
                </div>

                @forelse ($categories as $category)
                    <x-nav-link :href="route('shop.category', ['categoryId' => $category->id])">
                        {{ __($category->name) }}
                    </x-nav-link>
                @empty
                    <x-nav-link class="not-clickable" style="color: #F00;">Er zijn nog geen product categoriën aangemaakt!</x-nav-link>
                @endforelse

            </div>

            

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('home') }}
            </x-responsive-nav-link>
        </div>

        @if(auth()->check())
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name}}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div style="display: flex; justify-content: flex-end;">
        <div style="margin-right: 35px;">
            <a href="{{ route('view.cart') }}"><img width="35px" src="{{ asset('IMG\cart-icon.svg') }}" alt="Winkelkar icoon"></a>
        </div>
        <div style="margin-right: 50px;">
            @if(auth()->check())
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <img width="35px" src="{{ asset('IMG\account-icon.svg') }}" alt="Account icoon">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if(auth()->user()->admin == True)
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <img width="35px" src="{{ asset('IMG\account-icon.svg') }}" alt="Account icoon">
                        </button>
                    </x-slot>
            
                    <x-slot name="content">
                        <x-dropdown-link :href="route('login')">
                            {{ __('Log In') }}
                        </x-dropdown-link>
            
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
    </div>
</nav>
