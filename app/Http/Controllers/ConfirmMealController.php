<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FoodTaken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MealConfirmedNotification;

class ConfirmMealController extends Controller
{
    /**
     * Show the confirm meal page
     */
    public function show(User $user)
    {
        $foodTaken = $user->foodTaken;
        
        return view('confirm-meal', [
            'user' => $user,
            'foodTaken' => $foodTaken
        ]);
    }

    /**
     * Verify the student with registration number and passkey
     */
    public function verify(Request $request, User $user)
    {
        $request->validate([
            'regnumber' => 'required|string',
            'passkey' => 'required|string',
        ]);

        // Check if registration number matches
        if ($request->regnumber !== $user->regnumber) {
            return back()->withErrors(['regnumber' => 'Invalid registration number.'])->withInput();
        }

        // Check if passkey matches (using actual passkey field)
        if ($request->passkey !== $user->passkey) {
            return back()->withErrors(['passkey' => 'Invalid passkey.'])->withInput();
        }

        // Store verification in session
        session(['verified_user_id' => $user->id]);

        return back()->with('success', 'Student verified successfully. You can now confirm the meal.');
    }

    /**
     * Confirm the meal and update balance and payment
     */
    public function confirm(Request $request, User $user)
    {
        // Check if user was verified
        if (session('verified_user_id') !== $user->id) {
            return back()->withErrors(['error' => 'Please verify the student first.'])->withInput();
        }

        $foodTaken = $user->foodTaken;
        
        // Check if user has remaining meals
        if ($foodTaken->times_remaining <= 0) {
            return back()->withErrors(['error' => 'No meals remaining.'])->withInput();
        }

        // Get meal cost from database (default to 5000 if not set)
        $mealCost = $foodTaken->meal_cost > 0 ? $foodTaken->meal_cost : 1000;
        
        // Check if user has sufficient balance
        if ($foodTaken->payment_amount < $mealCost) {
            return back()->withErrors(['error' => 'Insufficient balance. Required: ' . number_format($mealCost) . ' RWF, Available: ' . number_format($foodTaken->payment_amount) . ' RWF'])->withInput();
        }

        // Store old values for email notification
        $oldTimesTaken = $foodTaken->times_taken;
        $oldTimesRemaining = $foodTaken->times_remaining;
        $oldPaymentAmount = $foodTaken->payment_amount;

        // Update meal counts and balance
        $foodTaken->times_taken += 1;
        $foodTaken->times_remaining -= 1;
        $foodTaken->payment_amount -= $mealCost; // Deduct meal cost from balance
        $foodTaken->save();

        // Send email notification
        try {
            Mail::to($user->email)->send(new MealConfirmedNotification($user, $foodTaken, $oldTimesTaken, $oldTimesRemaining, $oldPaymentAmount, $mealCost));
            \Log::info('Meal confirmation email sent successfully to: ' . $user->email);
        } catch (\Exception $e) {
            // Log error but don't fail the meal confirmation
            \Log::error('Failed to send meal confirmation email to ' . $user->email . ': ' . $e->getMessage());
        }

        // Clear verification session
        session()->forget('verified_user_id');

        return back()->with('meal_confirmed', 
            'Meal confirmed successfully! ' .
            'Times remaining: ' . $foodTaken->times_remaining . ' | ' .
            'Balance: ' . number_format($foodTaken->payment_amount) . ' RWF | ' .
            'Meal cost: ' . number_format($mealCost) . ' RWF'
        );
    }
} 