<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-4 text-green-800 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-page-title text-gray-800 mb-2">
                <i class="fas fa-utensils text-orange-500 mr-3"></i>
                Take Food
            </h1>
            <p class="text-body text-gray-600">Access your meals with your QR code</p>
            <div class="text-caption text-gray-500 mt-2">
                <i class="fas fa-clock mr-1"></i>
                {{ now()->format('M d, Y - H:i') }}
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main QR Code Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    @if($foodTaken && $foodTaken->times_remaining > 0)
                        <div class="text-center mb-6">
                            <h2 class="text-dashboard-title text-gray-800 mb-2">Your Meal QR Code</h2>
                            <p class="text-body text-gray-600">Show this QR code to the worker to access your meal</p>
                        </div>
                        
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border-2 border-blue-200 shadow-lg">
                                    <img src="{{ asset($user->qr_code) }}" alt="QR Code" class="w-80 h-80 object-contain rounded-xl shadow-md" />
                                </div>
                                <!-- Animated border effect -->
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 opacity-20 animate-pulse"></div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-caption text-gray-500 bg-gray-50 rounded-lg p-2 inline-block">
                                <i class="fas fa-info-circle mr-1"></i>
                                QR encodes: {{ url('/confirm_meal/'.$user->id) }}
                            </p>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-exclamation-triangle text-amber-600 text-3xl"></i>
                            </div>
                            <h2 class="text-dashboard-title text-amber-800 mb-3">No Meals Remaining</h2>
                            <p class="text-body text-amber-700 mb-6 max-w-md mx-auto">
                                You currently have no meals left. Please make a payment to access meals.
                            </p>
                            <a href="{{ route('take-food.payment') }}" 
                               class="inline-flex items-center px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-credit-card mr-2"></i>
                                Pay for Meals
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar Stats -->
            <div class="space-y-6">
                <!-- Meals Remaining Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-card-title">Meals Remaining</h3>
                            <p class="text-label text-green-100">Available for today</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-utensils text-xl"></i>
                        </div>
                    </div>
                    <div class="text-stats-large">{{ $foodTaken->times_remaining ?? 0 }}</div>
                </div>

                <!-- Meals Taken Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-card-title">Meals Taken</h3>
                            <p class="text-label text-blue-100">Total consumed</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="text-stats-large">{{ $foodTaken->times_taken ?? 0 }}</div>
                </div>

                <!-- Meal Cost Card -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-card-title">Meal Cost</h3>
                            <p class="text-label text-orange-100">Per meal price</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-xl"></i>
                        </div>
                    </div>
                    <div class="text-stats-medium">{{ number_format($foodTaken->meal_cost ?? 0) }} RWF</div>
                </div>

                <!-- Available Balance Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-card-title">Available Balance</h3>
                            <p class="text-label text-purple-100">Current funds</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-wallet text-xl"></i>
                        </div>
                    </div>
                    <div class="text-stats-medium mb-4">{{ number_format($foodTaken->payment_amount ?? 0) }} RWF</div>
                    <a href="{{ route('take-food.payment') }}" 
                       class="inline-flex items-center justify-center w-full px-4 py-2 rounded-xl bg-white bg-opacity-20 text-white font-semibold hover:bg-opacity-30 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Add Funds
                    </a>
                </div>
            </div>
        </div>

        <!-- Information Note -->
        <div class="mt-8 bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
            <div class="flex items-start">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-section-title text-gray-800 mb-2">Important Information</h3>
                    <p class="text-body text-gray-600 leading-relaxed">
                        The QR code can only be used when you have meals remaining. Each scan deducts one meal from your account. 
                        Make sure you have sufficient balance before attempting to access meals.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom animations */
        @keyframes pulse {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.4; }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Hover effects */
        .shadow-xl {
            transition: all 0.3s ease;
        }

        .shadow-xl:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Gradient text */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .text-4xl {
                font-size: 2rem;
            }
            
            .w-80 {
                width: 100%;
                max-width: 300px;
            }
            
            .h-80 {
                height: auto;
                max-height: 300px;
            }
        }
    </style>
</x-app-layout>


