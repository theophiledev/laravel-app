<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digital Meals System</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        
        <!-- Google Fonts - Modern Typography System -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Global Typography System -->
        <style>
            /* Modern Typography System */
            :root {
                /* Font Family */
                --font-primary: 'Inter', 'Roboto', 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
                
                /* Font Sizes */
                --text-xs: 0.75rem;      /* 12px - Small notes/hints */
                --text-sm: 0.875rem;     /* 14px - Body text/labels */
                --text-base: 1rem;       /* 16px - Body text */
                --text-lg: 1.125rem;     /* 18px - Subheadings */
                --text-xl: 1.25rem;      /* 20px - Section headings */
                --text-2xl: 1.5rem;      /* 24px - Dashboard titles */
                --text-3xl: 1.875rem;    /* 30px - Large titles */
                --text-4xl: 2.25rem;     /* 36px - Page headings */
                --text-5xl: 3rem;        /* 48px - Hero titles */
                
                /* Font Weights */
                --font-light: 300;
                --font-normal: 400;
                --font-medium: 500;
                --font-semibold: 600;
                --font-bold: 700;
                
                /* Line Heights */
                --leading-tight: 1.25;
                --leading-normal: 1.5;
                --leading-relaxed: 1.75;
            }
            
            /* Apply typography system globally */
            * {
                font-family: var(--font-primary);
            }
            
            body {
                font-family: var(--font-primary);
                font-size: var(--text-base);
                font-weight: var(--font-normal);
                line-height: var(--leading-normal);
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            
            /* Typography Classes */
            .text-hero { font-size: var(--text-5xl); font-weight: var(--font-bold); line-height: var(--leading-tight); }
            .text-page-title { font-size: var(--text-4xl); font-weight: var(--font-bold); line-height: var(--leading-tight); }
            .text-dashboard-title { font-size: var(--text-2xl); font-weight: var(--font-semibold); line-height: var(--leading-tight); }
            .text-section-title { font-size: var(--text-xl); font-weight: var(--font-semibold); line-height: var(--leading-tight); }
            .text-card-title { font-size: var(--text-lg); font-weight: var(--font-semibold); line-height: var(--leading-tight); }
            .text-body { font-size: var(--text-base); font-weight: var(--font-normal); line-height: var(--leading-normal); }
            .text-label { font-size: var(--text-sm); font-weight: var(--font-normal); line-height: var(--leading-normal); }
            .text-caption { font-size: var(--text-xs); font-weight: var(--font-light); line-height: var(--leading-normal); }
            
            /* Stats and Numbers */
            .text-stats-large { font-size: var(--text-5xl); font-weight: var(--font-bold); line-height: var(--leading-tight); }
            .text-stats-medium { font-size: var(--text-3xl); font-weight: var(--font-bold); line-height: var(--leading-tight); }
            .text-stats-small { font-size: var(--text-2xl); font-weight: var(--font-semibold); line-height: var(--leading-tight); }
            
            /* Ensure header and footer text is visible */
            .text-white {
                color: #ffffff !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
        </style>
        
        <!-- Mobile Menu Styles - Isolated from Alpine.js -->
        <style>
            /* Mobile menu container */
            #mobileMenuContainer {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                pointer-events: none;
            }
            
            #mobileMenuContainer.show {
                opacity: 1;
                visibility: visible;
                pointer-events: all;
            }
            
            /* Mobile menu sidebar */
            #mobileMenuSidebar {
                position: fixed;
                top: 0;
                left: -300px;
                width: 300px;
                height: 100%;
                background-color: #1f2937;
                z-index: 10000;
                transition: left 0.3s ease;
                overflow-y: auto;
            }
            
            #mobileMenuContainer.show #mobileMenuSidebar {
                left: 0;
            }
            
            /* Mobile menu header */
            .mobile-menu-header {
                padding: 1rem;
                border-bottom: 1px solid #374151;
                background-color: #111827;
                position: relative;
            }
            
            /* Mobile menu close button */
            .mobile-menu-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: transparent;
                border: none;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0.5rem;
                border-radius: 0.375rem;
                transition: background-color 0.2s ease;
            }
            
            .mobile-menu-close:hover {
                background-color: #374151;
            }
            
            /* Mobile menu navigation */
            .mobile-menu-nav {
                padding: 1rem;
            }
            
            .mobile-menu-nav a,
            .mobile-menu-nav button {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 0.75rem 1rem;
                margin-bottom: 0.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                transition: all 0.2s ease;
                border: none;
                background: transparent;
                text-align: left;
                font-size: 1rem;
                color: #d1d5db;
            }
            
            .mobile-menu-nav a:hover,
            .mobile-menu-nav button:hover {
                background-color: #374151;
                color: white;
            }
            
            .mobile-menu-nav a.active,
            .mobile-menu-nav button.active {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                color: white;
                box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
                border-left: 4px solid #fbbf24;
            }
            
            /* Menu section divider */
            .mobile-menu-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent 0%, #374151 50%, transparent 100%);
                margin: 1rem 0;
            }
            
            /* Mobile menu button */
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background-color: #ffffff;
                border: 2px solid #111827;
                border-radius: 0.5rem;
                padding: 0.25rem;
                color: #111827;
                cursor: pointer;
                font-size: 1.25rem;
                box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            }
            .mobile-menu-btn:hover {
                background-color: #f3f4f6;
            }

            /* Desktop top-bar toggle button */
            .desktop-menu-btn {
                display: none !important;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background-color: #ffffff;
                border: 2px solid #111827;
                border-radius: 0.5rem;
                padding: 0.25rem;
                color: #111827;
                cursor: pointer;
                font-size: 1.25rem;
                box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            }
            .desktop-menu-btn:hover { background-color: #f3f4f6; }
            
            /* Mobile menu navigation - apply same styling as desktop */
            .mobile-menu-nav a,
            .mobile-menu-nav button {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 0.75rem 1rem;
                margin-bottom: 0.5rem;
                border-radius: 0.5rem;
                text-decoration: none;
                transition: all 0.2s ease;
                border: none;
                background: transparent;
                text-align: left;
                font-size: 1rem;
                color: #d1d5db;
                gap: 0.75rem;
                font-weight: 500;
                letter-spacing: 0.1px;
            }
            .mobile-menu-nav a i,
            .mobile-menu-nav button i {
                width: 28px;
                height: 28px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
                color: #ffffff;
                border-radius: 0.5rem;
                font-size: 0.9rem;
                margin-right: 0.75rem;
                box-shadow: inset 0 0 0 1px rgba(255,255,255,0.06);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }
            .mobile-menu-nav a:hover i,
            .mobile-menu-nav button:hover i {
                transform: translateY(-1px);
                box-shadow: 0 2px 6px rgba(0,0,0,0.25);
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            }
            .mobile-menu-nav a.active i,
            .mobile-menu-nav button.active i {
                background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
                color: #0b3d2e;
            }
            
            .mobile-menu-nav a:hover,
            .mobile-menu-nav button:hover {
                background-color: #374151;
                color: white;
            }
            
            .mobile-menu-nav a.active,
            .mobile-menu-nav button.active {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                color: white;
                box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
                border-left: 4px solid #fbbf24;
            }

            /* Desktop sidebar active styling */
            #desktopSidebar a.active {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                color: white;
                box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
                border-left: 4px solid #fbbf24;
            }

            /* Unified menu link styling (desktop + mobile) */
            .menu-link {
                gap: 0.75rem;
                font-weight: 500;
                letter-spacing: 0.1px;
                transition: color 0.2s ease, background-color 0.2s ease, transform 0.2s ease;
            }
            .menu-link i {
                width: 28px;
                height: 28px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
                color: #ffffff;
                border-radius: 0.5rem;
                font-size: 0.9rem;
                margin-right: 0.75rem;
                box-shadow: inset 0 0 0 1px rgba(255,255,255,0.06);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }
            .menu-link:hover i {
                transform: translateY(-1px);
                box-shadow: 0 2px 6px rgba(0,0,0,0.25);
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            }
            .menu-link.active i {
                background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
                color: #0b3d2e;
            }

            /* Collapsed desktop sidebar */
            #desktopSidebar.desktop-sidebar-collapsed {
                display: none !important;
            }
            
            /* Hide mobile menu on desktop */
            @media (min-width: 1024px) {
                #mobileMenuContainer {
                    display: none !important;
                }
            }
            
            /* Show mobile menu button only on mobile */
            @media (max-width: 1023px) {
                .mobile-menu-btn {
                    display: flex !important;
                }
            }
            
            /* Debug styles */
            .debug-mobile-menu {
                background: #fbbf24;
                color: #1f2937;
                padding: 0.75rem;
                margin-bottom: 0.5rem;
                border-radius: 0.5rem;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100">
            <!-- Sidebar - Hidden on mobile, visible on desktop -->
            <div id="desktopSidebar" class="hidden lg:block w-64 bg-gray-800 text-white">
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
                        <button id="desktopSidebarToggle" class="w-full bg-white text-gray-800 px-3 py-2 rounded text-sm font-medium">
                            <i class="fas fa-bars mr-2"></i>Menu
                        </button>
                    </div>
                    
                    <div class="px-4 space-y-2">
                        @if(Auth::user()->role === 'student')
                            <a href="{{ route('dashboard') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('take-food') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('take-food*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-utensils mr-3"></i>
                                Take Food
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                Take Order
                            </a>
                            
                            <a href="{{ route('take-food.payment') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('take-food.payment') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-wallet mr-3"></i>
                                Add Funds
                            </a>
                            
                            <a href="{{ route('settings') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'manager')
                            <a href="{{ route('manager-dashboard') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager-dashboard') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-users mr-3"></i>
                                Manage Students
                            </a>
                            
                            <a href="{{ route('manager.meal-costs') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-money-bill mr-3"></i>
                                Meal Costs
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-utensils mr-3"></i>
                                Manage Menu
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-chart-bar mr-3"></i>
                                Reports
                            </a>
                            
                            <a href="{{ route('settings') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin-dashboard') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('admin-dashboard') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-users-cog mr-3"></i>
                                User Management
                            </a>
                            
                            <a href="{{ route('manager.meal-costs') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('manager.meal-costs*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-money-bill mr-3"></i>
                                Meal Costs
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-database mr-3"></i>
                                System Backup
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-chart-line mr-3"></i>
                                Analytics
                            </a>
                            
                            <a href="{{ route('settings') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cogs mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-print mr-3"></i>
                                Print Card
                            </a>
                        @elseif(Auth::user()->role === 'worker')
                            <a href="{{ route('work-dashboard') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('work-dashboard') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-qrcode mr-3"></i>
                                Scan QR Code
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-utensils mr-3"></i>
                                Serve Meals
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-list mr-3"></i>
                                View Orders
                            </a>
                            
                            <a href="#" class="menu-link flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-question-circle mr-3"></i>
                                Help Students
                            </a>
                            
                            <a href="{{ route('settings') }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('settings*') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
                                <i class="fas fa-cog mr-3"></i>
                                Settings
                            </a>
                            
                            <a href="{{ route('print.card', Auth::user()) }}" class="menu-link flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('print.card') ? 'active' : 'text-gray-300 hover:bg-gray-700' }}">
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
                        <!-- Desktop Sidebar Toggle (visible on desktop) -->
                        <button class="desktop-menu-btn hidden lg:flex mr-3" aria-label="Toggle sidebar" onclick="toggleDesktopSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <!-- Mobile Menu Button -->
                        <button class="mobile-menu-btn lg:hidden mr-3" aria-label="Open menu" onclick="toggleMobileMenu()">
                            <i class="fas fa-bars"></i>
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

        <!-- Mobile Navigation Menu - Isolated from Alpine.js -->
        <div id="mobileMenuContainer">
            <div id="mobileMenuSidebar">
                <!-- Mobile Menu Header -->
                <div class="mobile-menu-header">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">ST</span>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-white">STUDENT TRACK</h1>
                            <p class="text-xs text-gray-400">Meal System</p>
                        </div>
                    </div>
                    <button class="mobile-menu-close" onclick="toggleMobileMenu()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Mobile Navigation Links -->
                <nav class="mobile-menu-nav">
                    <!-- Menu Header -->
                    <div class="px-3 mb-4">
                        <button class="w-full bg-white text-gray-800 px-3 py-2 rounded text-sm font-medium">
                            <i class="fas fa-bars mr-2"></i>Menu
                        </button>
                    </div>
                    
                    <div class="space-y-2">
                    @if(Auth::user()->role === 'student')
                        <a href="{{ route('dashboard') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('take-food') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('take-food*') ? 'active' : '' }}">
                            <i class="fas fa-utensils mr-3"></i>
                            Take Food
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Take Order
                        </a>
                        
                        <a href="{{ route('take-food.payment') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('take-food.payment') ? 'active' : '' }}">
                            <i class="fas fa-wallet mr-3"></i>
                            Add Funds
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('settings*') ? 'active' : '' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('print.card') ? 'active' : '' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'manager')
                        <a href="{{ route('manager-dashboard') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('manager-dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-users mr-3"></i>
                            Manage Students
                        </a>
                        
                        <a href="{{ route('manager.meal-costs') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('manager.meal-costs*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill mr-3"></i>
                            Meal Costs
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-utensils mr-3"></i>
                            Manage Menu
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-chart-bar mr-3"></i>
                            Reports
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('settings*') ? 'active' : '' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('print.card') ? 'active' : '' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin-dashboard') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('admin-dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-users-cog mr-3"></i>
                            User Management
                        </a>
                        
                        <a href="{{ route('manager.meal-costs') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('manager.meal-costs*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill mr-3"></i>
                            Meal Costs
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-database mr-3"></i>
                            System Backup
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-chart-line mr-3"></i>
                            Analytics
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('settings*') ? 'active' : '' }}">
                            <i class="fas fa-cogs mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('print.card') ? 'active' : '' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @elseif(Auth::user()->role === 'worker')
                        <a href="{{ route('work-dashboard') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('work-dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-qrcode mr-3"></i>
                            Scan QR Code
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-utensils mr-3"></i>
                            Serve Meals
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-list mr-3"></i>
                            View Orders
                        </a>
                        
                        <a href="#" onclick="toggleMobileMenu()">
                            <i class="fas fa-question-circle mr-3"></i>
                            Help Students
                        </a>
                        
                        <a href="{{ route('settings') }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('settings*') ? 'active' : '' }}">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                        
                        <a href="{{ route('print.card', Auth::user()) }}" onclick="toggleMobileMenu()" class="{{ request()->routeIs('print.card') ? 'active' : '' }}">
                            <i class="fas fa-print mr-3"></i>
                            Print Card
                        </a>
                    @endif
                    </div>
                    
                    <div class="mobile-menu-divider"></div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="mt-6">
                        @csrf
                        <button type="submit" onclick="toggleMobileMenu()">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Mobile Menu JavaScript - Isolated from Alpine.js -->
        <script>
            // Mobile menu functionality - isolated from Alpine.js
            function toggleMobileMenu() {
                const container = document.getElementById('mobileMenuContainer');
                const sidebar = document.getElementById('mobileMenuSidebar');
                const body = document.body;
                
                console.log('Toggle mobile menu called');
                console.log('Container:', container);
                console.log('Sidebar:', sidebar);
                
                if (container.classList.contains('show')) {
                    container.classList.remove('show');
                    body.style.overflow = 'auto';
                    console.log('Menu closed');
                } else {
                    container.classList.add('show');
                    body.style.overflow = 'hidden';
                    console.log('Menu opened');
                }
            }

            // Desktop sidebar toggle (top bar button and inside sidebar button)
            function toggleDesktopSidebar() {
                const desktopSidebar = document.getElementById('desktopSidebar');
                if (desktopSidebar) {
                    desktopSidebar.classList.toggle('desktop-sidebar-collapsed');
                }
            }

            // Close mobile menu when clicking outside
            document.getElementById('mobileMenuContainer').addEventListener('click', function(e) {
                if (e.target === this) {
                    toggleMobileMenu();
                }
            });

            // Close mobile menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const container = document.getElementById('mobileMenuContainer');
                    if (container.classList.contains('show')) {
                        toggleMobileMenu();
                    }
                }
            });

            // Prevent body scroll when menu is open
            document.addEventListener('touchmove', function(e) {
                const container = document.getElementById('mobileMenuContainer');
                if (container.classList.contains('show')) {
                    e.preventDefault();
                }
            }, { passive: false });

            // Initialize mobile menu when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded, mobile menu ready');
                // Desktop sidebar toggle: click the Menu button to hide/show sidebar
                const toggleBtn = document.getElementById('desktopSidebarToggle');
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleDesktopSidebar();
                    });
                }
            });
        </script>
    </body>
</html>
