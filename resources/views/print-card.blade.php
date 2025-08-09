<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Restaurant Card - {{ $user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .print-container {
            max-width: 500px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .restaurant-card {
            background: linear-gradient(135deg, #e8f5f5 0%, #f0f8f8 100%);
            border: 2px solid #2d5a2d;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            width: 400px;
            height: 250px;
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 25px;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            overflow: hidden;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-circle i {
            color: white;
            font-size: 28px;
        }

        .logo-banner {
            background: #2d5a2d;
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
        }

        .card-title {
            color: #2d5a2d;
            font-size: 22px;
            font-weight: bold;
            line-height: 1.2;
            flex: 1;
        }

        .card-content {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .user-info {
            flex: 1;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .info-label {
            font-weight: bold;
            color: #2d5a2d;
            min-width: 70px;
            font-size: 15px;
        }

        .info-value {
            color: #333;
            font-size: 15px;
            margin-left: 15px;
        }

        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qr-code {
            width: 100px;
            height: 100px;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .qr-code i {
            font-size: 50px;
            color: #666;
        }

        .card-slogan {
            text-align: center;
            font-style: italic;
            color: #2d5a2d;
            font-size: 13px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-print {
            background: #4CAF50;
            color: white;
        }

        .btn-print:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #f44336;
            color: white;
        }

        .btn-cancel:hover {
            background: #da190b;
            transform: translateY(-2px);
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .action-buttons {
                display: none;
            }
            
            .restaurant-card {
                box-shadow: none;
                border: 2px solid #2d5a2d;
                page-break-inside: avoid;
            }
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .card-content {
                flex-direction: column;
                gap: 20px;
            }
            
            .qr-section {
                order: -1;
            }
            
            .card-title {
                font-size: 20px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="print-container">
        <!-- Restaurant Card -->
        <div class="restaurant-card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo-circle">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="System Logo">
                        @else
                            <i class="fas fa-utensils"></i>
                        @endif
                    </div>
                    <div class="logo-banner">
                        RESTAURANT TRACK MEAL
                    </div>
                </div>
                <div class="card-title">
                    Umunezero Restaurant Card
                </div>
            </div>

            <!-- Card Content -->
            <div class="card-content">
                <!-- User Information -->
                <div class="user-info">
                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Campus:</span>
                        <span class="info-value">{{ $user->campus ?? 'College of Education' }}</span>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="qr-section">
                    <div class="qr-code">
                        @if($user->qr_code && file_exists(public_path($user->qr_code)))
                            <img src="{{ asset($user->qr_code) }}" alt="QR Code" style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                            <div style="text-align: center; color: #666;">
                                <i class="fas fa-qrcode" style="font-size: 40px; margin-bottom: 10px;"></i>
                                <div style="font-size: 12px;">QR Code not found</div>
                                <a href="{{ route('generate.qr', $user) }}" style="color: #4CAF50; text-decoration: none; font-size: 11px;">
                                    Generate QR Code
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Slogan -->
            <div class="card-slogan">
                <em>Valid for meal access | Enjoy your time with us!</em>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-print" onclick="window.print()">
                <i class="fas fa-print mr-2"></i>Print Card
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-cancel">
                <i class="fas fa-times mr-2"></i>Click to Cancel
            </a>
        </div>
    </div>

    <script>
        // Auto-print functionality (optional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // };
    </script>
</body>
</html> 