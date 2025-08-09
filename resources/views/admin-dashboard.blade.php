<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">👨‍💻 Admin Dashboard</h1>
            <p class="text-gray-600 text-sm md:text-base">System administration and monitoring</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Total Users</h3>
                        <p class="text-sm md:text-base text-gray-600">1,456</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-green-100">
                        <i class="fas fa-server text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">System Status</h3>
                        <p class="text-sm md:text-base text-gray-600">Online</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-yellow-100">
                        <i class="fas fa-database text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Storage</h3>
                        <p class="text-sm md:text-base text-gray-600">75% Used</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-shield-alt text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Security</h3>
                        <p class="text-sm md:text-base text-gray-600">Protected</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-users-cog text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">User Management</h3>
                        <p class="text-sm text-gray-600">Manage all system users</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-green-100">
                        <i class="fas fa-database text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">System Backup</h3>
                        <p class="text-sm text-gray-600">Backup and restore data</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Analytics</h3>
                        <p class="text-sm text-gray-600">System performance metrics</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <style>
        /* Card styles */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* Icon box styles */
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card {
                padding: 1rem;
            }
        }
    </style>
</x-app-layout> 