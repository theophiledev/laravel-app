<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-page-title text-gray-800 mb-2">🏠 Dashboard</h1>
            <p class="text-body text-gray-600">Welcome to Digital Meals System</p>
        </div>

        <!-- Balance Information Cards (for logged in users) -->
        @if(Auth::check() && Auth::user()->foodTaken)
            <div class="mb-8">
                <h2 class="text-dashboard-title text-gray-800 mb-6 flex items-center">
                    <span class="text-3xl mr-3">💰</span>
                    Account Balance
                </h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-wallet fa-2x me-3"></i>
                                    <h5 class="card-title mb-0 text-card-title">Account Overview</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="mb-1 text-label">Available Balance</h6>
                                            <p class="card-text mb-0 text-stats-medium">{{ number_format(Auth::user()->foodTaken->payment_amount) }} RWF</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="mb-1 text-label">Meals Remaining</h6>
                                            <p class="card-text mb-0 text-stats-medium">{{ Auth::user()->foodTaken->times_remaining }} meals</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-money-bill-wave fa-2x me-3"></i>
                                    <h5 class="card-title mb-0 text-card-title">Meal Cost</h5>
                                </div>
                                <p class="card-text text-stats-small">{{ number_format(Auth::user()->foodTaken->meal_cost > 0 ? Auth::user()->foodTaken->meal_cost : 1000) }} RWF</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle fa-2x me-3"></i>
                                    <h5 class="card-title mb-0 text-card-title">Meals Taken</h5>
                                </div>
                                <p class="card-text text-stats-small">{{ Auth::user()->foodTaken->times_taken }} meals</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @php
                    $mealCost = Auth::user()->foodTaken->meal_cost > 0 ? Auth::user()->foodTaken->meal_cost : 1000;
                @endphp
                @if(Auth::user()->foodTaken->payment_amount < $mealCost)
                    <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                            <span class="text-red-800 font-medium text-body">Low Balance Alert</span>
                        </div>
                        <p class="text-red-700 text-label mt-1">Your balance is insufficient for a meal. Please add funds.</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Today's Food Section -->
        <div class="card mb-8">
            <h2 class="section-title text-section-title">🍽️ Today's Menu</h2>
            @php
                $todayFoods = \App\Models\DailyFood::where('date', today())->get();
            @endphp
            
            @if($todayFoods->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($todayFoods as $food)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-utensils text-green-600 text-xl"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800 text-card-title">{{ $food->food_name }}</h3>
                            </div>
                            <p class="text-label text-gray-600 mb-2">Available Today</p>
                            <p class="text-caption text-gray-500">{{ $food->date->format('F j, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-utensils text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-3 text-section-title">No Menu Available</h3>
                    <p class="text-body text-gray-500">Today's menu has not been set yet.</p>
                </div>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="card">
            <h2 class="section-title text-section-title">
                <i class="fas fa-comments text-blue-500 me-2"></i>
                Share Your Feedback
            </h2>
            <p class="text-body text-gray-600 mb-6">Your comments will be displayed on the home page once approved by management.</p>
            
            @if(Auth::check())
                <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-label text-gray-700 mb-2">Your Comment</label>
                        <textarea 
                            id="content" 
                            name="content" 
                            rows="4" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-body"
                            placeholder="Share your thoughts about the meal system, suggestions for improvement, or any feedback..."
                            required
                        ></textarea>
                        @error('content')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="submit-comment-btn">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Comment
                    </button>
                </form>

                <!-- User's Recent Comments -->
                @if(Auth::user()->comments->count() > 0)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-card-title text-gray-800 mb-4">Your Recent Comments</h3>
                        <div class="space-y-4">
                            @foreach(Auth::user()->comments->take(3) as $comment)
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="text-caption text-gray-500">{{ $comment->created_at->format('M d, Y - H:i') }}</span>
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($comment->status === 'approved') bg-green-100 text-green-800
                                            @elseif($comment->status === 'rejected') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($comment->status) }}
                                        </span>
                                    </div>
                                    <p class="text-body text-gray-700">{{ $comment->content }}</p>
                                    @if($comment->admin_response)
                                        <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                            <p class="text-sm font-medium text-blue-800 mb-1">Admin Response:</p>
                                            <p class="text-sm text-blue-700">{{ $comment->admin_response }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-sign-in-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-section-title text-gray-600 mb-3">Login to Share Feedback</h3>
                    <p class="text-body text-gray-500 mb-6">Please login to submit comments and share your feedback about the meal system.</p>
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-xl font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Bootstrap-style cards */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: var(--text-lg);
            font-weight: var(--font-semibold);
            margin-bottom: 0.5rem;
            color: white !important;
        }

        .card-text {
            font-size: var(--text-2xl);
            font-weight: var(--font-bold);
            margin-bottom: 0;
            color: white !important;
        }

        /* Account Overview Card */
        .bg-primary .card-text {
            font-size: var(--text-3xl);
        }

        .bg-primary h6 {
            font-size: var(--text-sm);
            font-weight: var(--font-normal);
            color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Icons styling */
        .fa-2x {
            font-size: 1.5rem;
        }

        .me-3 {
            margin-right: 1rem !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .text-center {
            text-align: center !important;
        }

        .w-100 {
            width: 100% !important;
        }

        /* Bootstrap color overrides */
        .bg-primary {
            background-color: #007bff !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .bg-warning .card-title,
        .bg-warning .card-text {
            color: #212529 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        /* Row and column spacing */
        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .col-md-3, .col-md-6 {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Card styles */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 32px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Section title styles */
        .section-title {
            font-size: var(--text-xl);
            font-weight: var(--font-semibold);
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        /* Action Button styles */
        .action-button {
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: var(--font-semibold);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            min-height: 56px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .col-md-3, .col-md-6 {
                width: 50%;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: var(--text-base);
            }
            
            .card-text {
                font-size: var(--text-xl);
            }

            .bg-primary .card-text {
                font-size: var(--text-2xl);
            }
            
            .section-title {
                font-size: var(--text-lg);
            }
            
            .action-button {
                padding: 14px 20px;
                font-size: var(--text-sm);
            }
        }

        @media (max-width: 640px) {
            .col-md-3, .col-md-6 {
                width: 100%;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .card-text {
                font-size: var(--text-lg);
            }

            .bg-primary .card-text {
                font-size: var(--text-xl);
            }
        }

        /* Ensure Digital Meals System text is visible */
        .text-body {
            color: #374151 !important;
            font-weight: var(--font-normal) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Submit comment button - force visible */
        .submit-comment-btn {
            background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: var(--font-semibold);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(29, 78, 216, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
            opacity: 1 !important;
            visibility: visible !important;
        }
        .submit-comment-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(29, 78, 216, 0.35);
        }
        .submit-comment-btn:focus {
            outline: 2px solid #93c5fd;
            outline-offset: 2px;
        }
    </style>
</x-app-layout>
