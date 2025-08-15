<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FoodTaken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TakeFoodController extends Controller
{
    /**
     * Show the take food page with QR code
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get or create food taken record
        $foodTaken = $user->foodTaken;
        if (!$foodTaken) {
            $foodTaken = FoodTaken::create([
                'student_id' => $user->id,
                'payment_amount' => 0,
                'meal_cost' => 1000, // Default meal cost
                'times_taken' => 0,
                'times_remaining' => 0,
            ]);
        }

        // Generate QR code if it doesn't exist
        if (!$user->qr_code || !file_exists(public_path($user->qr_code))) {
            $qrData = url("/confirm_meal/{$user->id}");
            $qrPath = "qrcodes/{$user->id}_qrcode.svg";
            
            // Create qrcodes directory if it doesn't exist
            $qrDirectory = public_path('qrcodes');
            if (!file_exists($qrDirectory)) {
                mkdir($qrDirectory, 0755, true);
            }

            QrCode::format('svg')
                ->size(300)
                ->margin(1)
                ->generate($qrData, public_path($qrPath));

            $user->qr_code = $qrPath;
            $user->save();
        }

        return view('take-food', compact('user', 'foodTaken'));
    }

    /**
     * Process meal access request
     */
    public function accessMeal(Request $request)
    {
        $user = Auth::user();
        $foodTaken = $user->foodTaken;

        if (!$foodTaken) {
            return response()->json([
                'success' => false,
                'message' => 'No meal plan found. Please contact administration.'
            ]);
        }

        // Check if user has remaining meals
        if ($foodTaken->times_remaining <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No meals remaining. Please make payment to access meals.',
                'needsPayment' => true
            ]);
        }

        // Check if user has sufficient balance
        if ($foodTaken->payment_amount < $foodTaken->meal_cost) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance. Please add funds to access meals.',
                'needsPayment' => true
            ]);
        }

        // Process meal access
        $foodTaken->times_taken += 1;
        $foodTaken->times_remaining -= 1;
        $foodTaken->payment_amount -= $foodTaken->meal_cost;
        $foodTaken->save();

        return response()->json([
            'success' => true,
            'message' => 'Meal accessed successfully!',
            'times_remaining' => $foodTaken->times_remaining,
            'times_taken' => $foodTaken->times_taken,
            'balance' => $foodTaken->payment_amount
        ]);
    }

    /**
     * Show payment page
     */
    public function showPayment()
    {
        $user = Auth::user();
        $foodTaken = $user->foodTaken;

        return view('payment', compact('user', 'foodTaken'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|in:mobile_money,bank_transfer,cash'
        ]);

        $user = Auth::user();
        $foodTaken = $user->foodTaken;

        if (!$foodTaken) {
            $foodTaken = FoodTaken::create([
                'student_id' => $user->id,
                'payment_amount' => 0,
                'meal_cost' => 1000,
                'times_taken' => 0,
                'times_remaining' => 0,
            ]);
        }

        $amount = $request->amount;
        $mealsToAdd = floor($amount / $foodTaken->meal_cost);

        $foodTaken->payment_amount += $amount;
        $foodTaken->times_remaining += $mealsToAdd;
        $foodTaken->save();

        return redirect()->route('take-food')->with('success', 
            "Payment of {$amount} RWF processed successfully! You now have {$foodTaken->times_remaining} meals remaining."
        );
    }
}
