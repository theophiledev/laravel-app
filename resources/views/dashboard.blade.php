<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">🏠 Dashboard</h1>
            <p class="text-gray-600 text-sm md:text-base">Welcome to Digital Meals System</p>
        </div>

        <!-- Balance Information (for logged in users) -->
        @if(Auth::check() && Auth::user()->foodTaken)
            <div class="card mb-6 md:mb-8">
                <h2 class="section-title">💰 Account Balance</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-wallet text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Available Balance</h3>
                                <p class="text-2xl font-bold text-green-600">{{ number_format(Auth::user()->foodTaken->payment_amount) }} RWF</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-utensils text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Meals Remaining</h3>
                                <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->foodTaken->times_remaining }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-money-bill text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Meal Cost</h3>
                                <p class="text-2xl font-bold text-orange-600">{{ number_format(Auth::user()->foodTaken->meal_cost > 0 ? Auth::user()->foodTaken->meal_cost : 1000) }} RWF</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Meals Taken</h3>
                                <p class="text-2xl font-bold text-purple-600">{{ Auth::user()->foodTaken->times_taken }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @php
                    $mealCost = Auth::user()->foodTaken->meal_cost > 0 ? Auth::user()->foodTaken->meal_cost : 1000;
                @endphp
                @if(Auth::user()->foodTaken->payment_amount < $mealCost)
                    <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                            <span class="text-red-800 font-medium">Low Balance Alert</span>
                        </div>
                        <p class="text-red-700 text-sm mt-1">Your balance is insufficient for a meal. Please add funds.</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Today's Food Section -->
        <div class="card mb-6 md:mb-8">
            <h2 class="section-title">🍽️ Today's Menu</h2>
            @php
                $todayFoods = \App\Models\DailyFood::where('date', today())->get();
            @endphp
            
            @if($todayFoods->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @foreach($todayFoods as $food)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-utensils text-green-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">{{ $food->food_name }}</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Available Today</p>
                            <p class="text-xs text-gray-500">{{ $food->date->format('F j, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-utensils text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No Menu Available</h3>
                    <p class="text-sm text-gray-500">Today's menu has not been set yet.</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h2 class="section-title">⚡ Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <a href="{{ route('login') }}" class="button">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login to Access Personal Data
                </a>
                <a href="{{ route('register') }}" class="button" style="background-color: #4299e1;">
                    <i class="fas fa-user-plus mr-2"></i>Register New Account
                </a>
                @if(Auth::check())
                    <a href="{{ route('settings') }}" class="button" style="background-color: #805ad5;">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </a>
                    <a href="{{ route('print.card', Auth::user()) }}" class="button" style="background-color: #10b981;">
                        <i class="fas fa-print mr-2"></i>Print Restaurant Card
                    </a>
                @else
                    <button class="button" style="background-color: #805ad5;" onclick="alert('Login to access settings')">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </button>
                    <button class="button" style="background-color: #10b981;" onclick="alert('Login to print your restaurant card')">
                        <i class="fas fa-print mr-2"></i>Print Restaurant Card
                    </button>
                @endif
            </div>
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

        /* Section title styles */
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        /* Button styles */
        .button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            min-height: 44px;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card {
                padding: 1rem;
            }
            
            .section-title {
                font-size: 1.25rem;
            }
            
            .button {
                padding: 10px 20px;
                font-size: 0.875rem;
            }
        }
    </style>
</x-app-layout>
