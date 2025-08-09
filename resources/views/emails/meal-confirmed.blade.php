<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Confirmed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .info-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            border-left: 4px solid #28a745;
        }
        .balance-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            border-left: 4px solid #007bff;
        }
        .payment-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            border-left: 4px solid #ffc107;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }
        .balance-amount {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .cost-amount {
            font-size: 20px;
            font-weight: bold;
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🍽️ Meal Confirmed Successfully!</h1>
        <p>Digital Meals System</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $user->name }},</h2>
        
        <p>Your meal has been confirmed successfully! Here are the details:</p>
        
        <div class="info-box">
            <h3>📋 Meal Details</h3>
            <p><strong>Student Name:</strong> {{ $user->name }}</p>
            <p><strong>Registration Number:</strong> {{ $user->regnumber }}</p>
            <p><strong>Campus:</strong> {{ $user->campus }}</p>
            <p><strong>Confirmation Time:</strong> {{ $confirmationTime->format('F j, Y \a\t g:i A') }}</p>
        </div>
        
        <div class="info-box">
            <h3>🍽️ Meal Count</h3>
            <p><strong>Previous Times Taken:</strong> {{ $oldTimesTaken }}</p>
            <p><strong>Current Times Taken:</strong> {{ $foodTaken->times_taken }}</p>
            <p><strong>Previous Times Remaining:</strong> {{ $oldTimesRemaining }}</p>
            <p><strong>Current Times Remaining:</strong> {{ $foodTaken->times_remaining }}</p>
        </div>
        
        @if($oldPaymentAmount !== null)
        <div class="balance-box">
            <h3>💰 Balance Information</h3>
            <p><strong>Previous Balance:</strong> <span class="balance-amount">{{ number_format($oldPaymentAmount) }} RWF</span></p>
            <p><strong>Current Balance:</strong> <span class="balance-amount">{{ number_format($foodTaken->payment_amount) }} RWF</span></p>
            <p><strong>Amount Deducted:</strong> <span class="cost-amount">{{ number_format($mealCost) }} RWF</span></p>
        </div>
        
        <div class="payment-box">
            <h3>💳 Payment Summary</h3>
            <p><strong>Meal Cost:</strong> {{ number_format($mealCost) }} RWF</p>
            <p><strong>Balance After Meal:</strong> {{ number_format($foodTaken->payment_amount) }} RWF</p>
            <p><strong>Meals Remaining:</strong> {{ $foodTaken->times_remaining }} times</p>
        </div>
        @endif
        
        <div style="background: #e8f5e8; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="color: #28a745; margin-top: 0;">✅ Confirmation Summary</h3>
            <p><strong>Status:</strong> Meal confirmed successfully</p>
            <p><strong>Location:</strong> Digital Meals System</p>
            <p><strong>Time:</strong> {{ $confirmationTime->format('g:i A') }}</p>
        </div>
        
        <div style="background: #fff3cd; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="color: #856404; margin-top: 0;">📱 Next Steps</h3>
            <ul>
                <li>Keep this confirmation for your records</li>
                <li>Check your remaining balance regularly</li>
                <li>Add funds when balance is low</li>
                <li>Use your QR code for quick meal access</li>
            </ul>
        </div>
        
        @if($foodTaken->payment_amount < 10000)
        <div style="background: #f8d7da; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="color: #721c24; margin-top: 0;">⚠️ Low Balance Alert</h3>
            <p>Your current balance is {{ number_format($foodTaken->payment_amount) }} RWF. Consider adding funds to ensure uninterrupted meal access.</p>
        </div>
        @endif
    </div>
    
    <div class="footer">
        <p>Thank you for using Digital Meals System!</p>
        <p>If you have any questions, please contact support.</p>
        <p>© {{ date('Y') }} Digital Meals System. All rights reserved.</p>
    </div>
</body>
</html> 