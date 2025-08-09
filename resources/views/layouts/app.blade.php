<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digital Meals System</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Mobile Menu Debug Styles -->
        <style>
            /* Ensure mobile menu button is always visible on mobile */
            @media (max-width: 1024px) {
                .mobile-menu-btn {
                    display: flex !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
            }
            
            /* Mobile menu overlay styles */
            .mobile-menu-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                display: none;
            }
            
            .mobile-menu-overlay.show {
                display: block;
            }
            
            .mobile-menu-content {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px;
                height: 100%;
                background-color: #1f2937;
                z-index: 10000;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .mobile-menu-overlay.show .mobile-menu-content {
                transform: translateX(0);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100">
            <!-- Sidebar - Hidden on mobile, visible on desktop -->
            <div class="hidden lg:block w-64 bg-gray-800 text-white">
                <!-- Logo Section -->
                <div class="p-4 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">ST</span>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold">STUDENT TRACK</h1>
                            <p class="text-xs text-gray-400">Meal System</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-6">
                    <div class="px-4 mb-4">
                        <button class="w-full bg-white text-gray-800 px-3 py-2 rounded text-sm font-medium">
                            <i class="fas fa-bars mr-2"></i>Menu
                        </button>
                    </div>
                    
                    <div class="px-4 space-y-2">
                        @if(Auth::user()->role === 'student')
                            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-utensils mr-3"></i>
                                Take Food
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                Take Order
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-wallet mr-3"></i>
                                Make Pay
                            </a>
                            
                            <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'manager')
                            <a href="{{ route('manager-dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-users mr-3"></i>
                                Manage Students
                            </a>
                            
                            <a href="{{ route('manager.meal-costs') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-money-bill mr-3"></i>
                                Meal Costs
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-utensils mr-3"></i>
                                Manage Menu
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-chart-bar mr-3"></i>
                                Reports
                            </a>
                            
                            <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin-dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('admin-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-users-cog mr-3"></i>
                                User Management
                            </a>
                            
                            <a href="{{ route('manager.meal-costs') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-money-bill mr-3"></i>
                                Meal Costs
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-database mr-3"></i>
                                System Backup
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-chart-line mr-3"></i>
                                Analytics
                            </a>
                            
                            <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cogs mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'worker')
                            <a href="{{ route('work-dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('work-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-qrcode mr-3"></i>
                                Scan QR Code
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-utensils mr-3"></i>
                                Serve Meals
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-list mr-3"></i>
                                View Orders
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-question-circle mr-3"></i>
                                Help Students
                            </a>
                            
                            <a href="{{ route('settings') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="mt-6">
                            @csrf
                            <button type="submit" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Top Bar -->
                <div class="bg-amber-800 h-12 md:h-16 flex items-center justify-between px-4 md:px-6">
                    <div class="flex items-center">
                        <!-- Mobile Menu Button - Always visible on mobile -->
                        <button class="mobile-menu-btn lg:hidden text-white mr-3 p-2 rounded-md hover:bg-amber-700 transition-colors" onclick="toggleMobileMenu()">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div class="text-white font-medium text-sm md:text-base">Digital Meals System</div>
                    </div>
                    <div class="text-white text-xs md:text-sm">{{ Auth::user()->name ?? 'Guest' }}</div>
                </div>

                <!-- Page Content -->
                <div class="flex-1 overflow-auto bg-gray-50">
                    <div class="p-4 md:p-6">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-800 h-10 md:h-12 flex items-center justify-center">
                    <p class="text-white text-xs md:text-sm">© 2024 Digital Meals System | All Rights Reserved</p>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Overlay -->
        <div id="mobileMenu" class="mobile-menu-overlay">
            <div class="mobile-menu-content">
                <div class="flex justify-between items-center p-4 border-b border-gray-600">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">ST</span>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-white">STUDENT TRACK</h1>
                            <p class="text-xs text-gray-400">Meal System</p>
                        </div>
                    </div>
                    <button onclick="toggleMobileMenu()" class="text-white p-2 rounded-md hover:bg-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Mobile Navigation Links -->
                <nav class="p-4 space-y-2">
                    @if(Auth::user()->role === 'student')
                        <a href="{{ route('dashboard') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-utensils mr-3"></i>
                            Take Food
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Take Order
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-wallet mr-3"></i>
                            Make Pay
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'manager')
                        <a href="{{ route('manager-dashboard') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('manager-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-users mr-3"></i>
                            Manage Students
                        </a>
                        
                        <a href="{{ route('manager.meal-costs') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-money-bill mr-3"></i>
                            Meal Costs
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-utensils mr-3"></i>
                            Manage Menu
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-chart-bar mr-3"></i>
                            Reports
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin-dashboard') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('admin-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-users-cog mr-3"></i>
                            User Management
                        </a>
                        
                        <a href="{{ route('manager.meal-costs') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-money-bill mr-3"></i>
                            Meal Costs
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-database mr-3"></i>
                            System Backup
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-chart-line mr-3"></i>
                            Analytics
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-cogs mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'worker')
                        <a href="{{ route('work-dashboard') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('work-dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-qrcode mr-3"></i>
                            Scan QR Code
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-utensils mr-3"></i>
                            Serve Meals
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-list mr-3"></i>
                            View Orders
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700">
                            <i class="fas fa-question-circle mr-3"></i>
                            Help Students
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('settings*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('print.card') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="mt-6">
                        @csrf
                        <button type="submit" onclick="toggleMobileMenu()" class="flex items-center px-3 py-3 rounded-lg text-gray-300 hover:bg-gray-700 w-full text-left">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Mobile Menu JavaScript -->
        <script>
            function toggleMobileMenu() {
                const menu = document.getElementById('mobileMenu');
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                    // Restore body scroll
                    document.body.style.overflow = 'auto';
                } else {
                    menu.classList.add('show');
                    // Prevent body scroll when menu is open
                    document.body.style.overflow = 'hidden';
                }
            }

            // Close mobile menu when clicking outside
            document.getElementById('mobileMenu').addEventListener('click', function(e) {
                if (e.target === this) {
                    toggleMobileMenu();
                }
            });

            // Close mobile menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const menu = document.getElementById('mobileMenu');
                    if (menu.classList.contains('show')) {
                        toggleMobileMenu();
                    }
                }
            });

            // Debug: Log when mobile menu button is clicked
            document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
                console.log('Mobile menu button clicked');
            });
        </script>
    </body>
</html>
