<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Meal - {{ $user->name }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .header {
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }

        .title {
            color: #333;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 1rem;
        }

        .student-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: left;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

        .info-value {
            color: #333;
            font-weight: 500;
        }

        .balance-info {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .balance-amount {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .meal-cost {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .cost-amount {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .no-meals-banner {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
            
            .title {
                font-size: 1.5rem;
            }
            
            .balance-amount {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-utensils"></i>
            </div>
            <h1 class="title">Confirm Meal</h1>
            <p class="subtitle">Digital Meals System</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('meal_confirmed'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('meal_confirmed') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <!-- Student Information -->
        <div class="student-info">
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $user->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Registration:</span>
                <span class="info-value">{{ $user->regnumber }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Campus:</span>
                <span class="info-value">{{ $user->campus }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Times Taken:</span>
                <span class="info-value">{{ $foodTaken->times_taken }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Times Remaining:</span>
                <span class="info-value">{{ $foodTaken->times_remaining }}</span>
            </div>
        </div>

        <!-- Balance Information -->
        <div class="balance-info">
            <div class="balance-amount">{{ number_format($foodTaken->payment_amount) }} RWF</div>
            <div>Available Balance</div>
        </div>

        <!-- Meal Cost Information -->
        <div class="meal-cost">
            <div class="cost-amount">{{ number_format($foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000) }} RWF</div>
            <div>Per Meal Cost</div>
        </div>
        
        @if($foodTaken->times_remaining <= 0)
            <!-- No Meals Remaining -->
            <div class="no-meals-banner">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                No meals remaining! Cannot confirm meal.
            </div>
            
            <div class="text-center">
                <p class="text-gray-600 mb-4">
                    This student has no meals remaining in their account.
                </p>
                
                <button onclick="window.close()" class="btn-cancel w-full">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
            </div>
        @elseif($foodTaken->payment_amount < ($foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000))
            <!-- Insufficient Balance -->
            <div class="no-meals-banner">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Insufficient Balance!
            </div>
            
            <div class="text-center">
                <p class="text-gray-600 mb-4">
                    This student has insufficient balance to confirm a meal.
                    <br>Required: {{ number_format($foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000) }} RWF | Available: {{ number_format($foodTaken->payment_amount) }} RWF
                </p>
                
                <button onclick="window.close()" class="btn-cancel w-full">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
            </div>
        @else
            @if(!session('verified_user_id'))
                <!-- Verification Form -->
                <form method="POST" action="{{ route('confirm_meal.verify', $user) }}" class="space-y-4">
                    @csrf
                    
                    <div class="form-group">
                        <label class="block text-gray-700 font-medium mb-2">
                            Enter Registration Number:
                        </label>
                        <input 
                            type="text" 
                            name="regnumber" 
                            value="{{ $user->regnumber }}"
                            class="input-field"
                            placeholder="Enter Registration Number"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label class="block text-gray-700 font-medium mb-2">
                            Enter Passkey:
                        </label>
                        <input 
                            type="password" 
                            name="passkey" 
                            class="input-field"
                            placeholder="Enter Passkey"
                            required
                        >
                    </div>
                    
                    <button type="submit" class="btn-primary w-full">
                        <i class="fas fa-check mr-2"></i>
                        Verify Student
                    </button>
                </form>
            @else
                <!-- Confirmation Form -->
                <div class="alert alert-info">
                    <i class="fas fa-check-circle mr-2"></i>
                    Student verified successfully. You can now confirm the meal.
                </div>
                
                <form method="POST" action="{{ route('confirm_meal.confirm', $user) }}" class="space-y-4">
                    @csrf
                    
                    <div class="text-center">
                        @php
                            $mealCost = $foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000;
                        @endphp
                        <p class="text-gray-600 mb-4">
                            <strong>Meal Cost:</strong> {{ number_format($mealCost) }} RWF<br>
                            <strong>Balance After:</strong> {{ number_format($foodTaken->payment_amount - $mealCost) }} RWF
                        </p>
                        
                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-utensils mr-2"></i>
                            Confirm Meal ({{ number_format($mealCost) }} RWF)
                        </button>
                    </div>
                </form>
            @endif
        @endif
        
        @php
            $mealCost = $foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000;
        @endphp
        @if($foodTaken->times_remaining > 0 && $foodTaken->payment_amount >= $mealCost)
            <div class="mt-6 text-center">
                <button onclick="window.close()" class="btn-cancel w-full">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
            </div>
        @endif
    </div>
    
    <script>
        // Auto-close browser after successful meal confirmation
        @if(session('meal_confirmed'))
            setTimeout(function() {
                window.close();
            }, 3000); // Close after 3 seconds
        @endif
    </script>
</body>
</html> 