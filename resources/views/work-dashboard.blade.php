<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">👷 Worker Dashboard</h1>
            <p class="text-gray-600 text-sm md:text-base">Meal service and student assistance</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-qrcode text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Scans Today</h3>
                        <p class="text-sm md:text-base text-gray-600">89</p>
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
                        <p class="text-sm md:text-base text-gray-600">67</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-yellow-100">
                        <i class="fas fa-question-circle text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Help Requests</h3>
                        <p class="text-sm md:text-base text-gray-600">12</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-clock text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Active Time</h3>
                        <p class="text-sm md:text-base text-gray-600">4h 23m</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-blue-100">
                        <i class="fas fa-qrcode text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Scan QR Code</h3>
                        <p class="text-sm text-gray-600">Verify student meals</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-green-100">
                        <i class="fas fa-utensils text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">Serve Meals</h3>
                        <p class="text-sm text-gray-600">Distribute food items</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="icon-box bg-purple-100">
                        <i class="fas fa-list text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">View Orders</h3>
                        <p class="text-sm text-gray-600">Check meal requests</p>
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