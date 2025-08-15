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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .print-container {
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .page-header {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .restaurant-card {
            background: linear-gradient(to bottom, #e0f7fa, #b2dfdb);
            border: 3px solid #004d40;
            border-radius: 12px;
            width: 400px;
            height: 250px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            margin: 50px auto;
            position: relative;
            padding: 20px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: #004d40;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-circle i {
            color: white;
            font-size: 24px;
        }

        .card-title {
            font-size: 1.4em;
            font-weight: bold;
            color: #004d40;
            text-align: center;
            flex: 1;
        }

        .card-content {
            display: block;
        }

        .user-info {
            font-size: 0.8em;
            line-height: 1.3;
            color: #004d40 !important;
            margin-top: 8px;
        }

        .info-row {
            margin: 5px 0;
        }

        .info-row p {
            margin: 5px 0;
            color: #004d40 !important;
        }

        .info-label {
            font-weight: bold;
            color: #004d40 !important;
        }

        .info-value {
            color: #004d40 !important;
        }

        .qr-section {
            position: absolute;
            bottom: 39px;
            right: 13px;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .qr-code i {
            font-size: 40px;
            color: #666;
        }

        .card-slogan {
            font-size: 0.8em;
            position: absolute;
            bottom: 5px;
            left: 10px;
            right: 10px;
            color: #00796b;
            text-align: center;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            padding: 15px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-print {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .btn-cancel:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(245, 101, 101, 0.4);
        }

        .btn-download {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .btn-download:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .page-header,
            .action-buttons {
                display: none;
            }
            
            .restaurant-card {
                box-shadow: none;
                border: 2px solid #2d3748;
                page-break-inside: avoid;
                margin: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .page-title {
                font-size: 2rem;
            }
            
            .restaurant-card {
                width: 90%;
                height: auto;
                min-height: 250px;
                padding: 15px;
                margin: 20px auto;
            }
            
            .card-title {
                font-size: 1.2em;
            }
            
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .restaurant-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .action-buttons {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        /* Ensure all text is visible */
        .restaurant-card * {
            color: inherit;
        }
        
        .restaurant-card p {
            color: #004d40 !important;
            font-weight: 500 !important;
        }
        
        .restaurant-card strong {
            color: #004d40 !important;
            font-weight: 700 !important;
        }

        .user-info {
            font-size: 0.8em;
            line-height: 1.3;
            color: #004d40 !important;
            margin-top: 8px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="print-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Restaurant Card</h1>
            <p class="page-subtitle">Print your digital meal access card</p>
        </div>

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
                </div>
                <div class="card-title">
                    Umunezero Restaurant Card
                </div>
            </div>
            <hr>
            <!-- Card Content -->
            <div class="card-content">
                <!-- User Information -->
                <div class="user-info">
                    <div class="info-row">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                    </div>
                    <div class="info-row">
                        <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="info-row">
                        <p><strong>College:</strong> {{ $user->campus ?? 'College of Education' }}</p>
                    </div>
                    <div class="info-row">
                        <p><strong>Reg Number:</strong> {{ $user->regnumber ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="qr-section">
                    <div class="qr-code">
                        @if($user->qr_code && file_exists(public_path($user->qr_code)))
                            <img src="{{ asset($user->qr_code) }}" alt="QR Code">
                        @else
                            <p>No QR Code</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Slogan -->
            <div class="card-slogan">
                "Valid for meal access | Enjoy your time with us!"
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-print" onclick="window.print()">
                <i class="fas fa-print"></i>
                Print Card
            </button>
            <button class="btn btn-download" onclick="downloadCard()">
                <i class="fas fa-download"></i>
                Download PDF
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-cancel">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <script>
        function downloadCard() {
            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Download Card - {{ $user->name }}</title>
                        <style>
                            body { margin: 0; padding: 20px; }
                            .restaurant-card {
                                background: white;
                                border: 2px solid #2d3748;
                                border-radius: 15px;
                                padding: 30px;
                                max-width: 500px;
                                margin: 0 auto;
                            }
                            @media print {
                                body { padding: 0; }
                            }
                        </style>
                    </head>
                    <body>
                        ${document.querySelector('.restaurant-card').outerHTML}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        // Auto-print functionality (optional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // };
    </script>
</body>
</html> 