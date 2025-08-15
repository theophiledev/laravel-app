<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">👨‍💼 Manager Dashboard</h1>
            <p class="text-gray-600 text-sm md:text-base">Manage the Digital Meals System</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Total Students</h3>
                        <p class="text-sm md:text-base text-gray-600">1,234</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-green-100">
                        <i class="fas fa-utensils text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Meals Served</h3>
                        <p class="text-sm md:text-base text-gray-600">456</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-yellow-100">
                        <i class="fas fa-wallet text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Revenue</h3>
                        <p class="text-sm md:text-base text-gray-600">2.3M RWF</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Growth</h3>
                        <p class="text-sm md:text-base text-gray-600">+15%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Manage Students</h3>
                        <p class="text-sm text-gray-600">View and manage student accounts</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('manager.meal-costs') }}" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-green-100">
                        <i class="fas fa-money-bill text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Meal Costs</h3>
                        <p class="text-sm text-gray-600">Set and manage meal prices</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('manager.comments') }}" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-orange-100">
                        <i class="fas fa-comments text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Comments</h3>
                        <p class="text-sm text-gray-600">Review and manage feedback</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-chart-bar text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Reports</h3>
                        <p class="text-sm text-gray-600">View system reports</p>
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