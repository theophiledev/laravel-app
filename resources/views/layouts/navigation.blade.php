<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        <span class="ml-2 text-lg font-bold text-gray-800 dark:text-gray-200 hidden sm:block">SmartLife</span>
                    </a>
                </div>

                <!-- Navigation Links - Hidden on mobile -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-home mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    @if(Auth::check())
                        <x-nav-link :href="route('print.card', Auth::user())" :active="request()->routeIs('print.card')">
                            <i class="fas fa-print mr-2"></i>{{ __('Print Card') }}
                        </x-nav-link>
                    @endif
                    <!-- Additional navigation links for different roles -->
                    @if(Auth::check() && Auth::user()->role === 'manager')
                        <x-nav-link href="{{ route('manager-dashboard') }}" :active="request()->routeIs('manager-dashboard')">
                            <i class="fas fa-chart-line mr-2"></i>{{ __('Manager') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link href="{{ route('admin-dashboard') }}" :active="request()->routeIs('admin-dashboard')">
                            <i class="fas fa-cog mr-2"></i>{{ __('Admin') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::check() && Auth::user()->role === 'worker')
                        <x-nav-link href="{{ route('work-dashboard') }}" :active="request()->routeIs('work-dashboard')">
                            <i class="fas fa-tools mr-2"></i>{{ __('Worker') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown - Hidden on mobile -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-indigo-600 text-sm"></i>
                                </div>
                                <span class="hidden md:block">{{ Auth::user()->name ?? 'Guest' }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user-edit mr-2"></i>{{ __('Profile') }}
                        </x-dropdown-link>

                        @if(Auth::check())
                            <x-dropdown-link :href="route('print.card', Auth::user())">
                                <i class="fas fa-print mr-2"></i>{{ __('Print Restaurant Card') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu - Mobile only -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                        aria-label="Toggle navigation menu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" 
         class="hidden sm:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Main Navigation Links -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fas fa-home mr-3"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if(Auth::check())
                <x-responsive-nav-link :href="route('print.card', Auth::user())" :active="request()->routeIs('print.card')">
                    <i class="fas fa-print mr-3"></i>{{ __('Print Card') }}
                </x-responsive-nav-link>
            @endif

            <!-- Role-based Navigation Links -->
            @if(Auth::check() && Auth::user()->role === 'manager')
                <x-responsive-nav-link href="{{ route('manager-dashboard') }}" :active="request()->routeIs('manager-dashboard')">
                    <i class="fas fa-chart-line mr-3"></i>{{ __('Manager Dashboard') }}
                </x-responsive-nav-link>
            @endif
            
            @if(Auth::check() && Auth::user()->role === 'admin')
                <x-responsive-nav-link href="{{ route('admin-dashboard') }}" :active="request()->routeIs('admin-dashboard')">
                    <i class="fas fa-cog mr-3"></i>{{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
            @endif
            
            @if(Auth::check() && Auth::user()->role === 'worker')
                <x-responsive-nav-link href="{{ route('work-dashboard') }}" :active="request()->routeIs('work-dashboard')">
                    <i class="fas fa-tools mr-3"></i>{{ __('Worker Dashboard') }}
                </x-responsive-nav-link>
            @endif

            <!-- Quick Access Links -->
            <div class="px-3 py-2">
                <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                    Quick Access
                </div>
                <div class="space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
                        <i class="fas fa-sign-in-alt mr-3"></i>{{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
                        <i class="fas fa-user-plus mr-3"></i>{{ __('Register') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        @if(Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 py-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-indigo-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user-edit mr-3"></i>{{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('print.card', Auth::user())">
                        <i class="fas fa-print mr-3"></i>{{ __('Print Restaurant Card') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Guest User Section -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 py-3">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-info-circle mr-2"></i>
                        You are browsing as a guest. 
                        <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Login</a> 
                        for full access.
                    </div>
                </div>
            </div>
        @endif
    </div>
</nav>
