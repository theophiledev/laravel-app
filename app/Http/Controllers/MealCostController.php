<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class MealCostController extends Controller
{
    /**
     * Show the meal cost management page
     */
    public function index()
    {
        // Get all users with their meal costs
        $users = User::with('foodTaken')->get();
        
        return view('manager.meal-costs', compact('users'));
    }

    /**
     * Update meal cost for a specific user
     */
    public function updateUserMealCost(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'meal_cost' => ['required', 'integer', 'min:1', 'max:100000'],
        ], [
            'meal_cost.required' => 'Meal cost is required.',
            'meal_cost.integer' => 'Meal cost must be a whole number.',
            'meal_cost.min' => 'Meal cost must be at least 1 RWF.',
            'meal_cost.max' => 'Meal cost cannot exceed 100,000 RWF.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!$user->foodTaken) {
            return back()->withErrors(['error' => 'User does not have a food taken record.'])->withInput();
        }

        // Update meal cost
        $user->foodTaken->meal_cost = $request->meal_cost;
        $user->foodTaken->save();

        return back()->with('success', 'Meal cost updated successfully for ' . $user->name . ' to ' . number_format($request->meal_cost) . ' RWF');
    }

    /**
     * Update meal cost for all users (bulk update)
     */
    public function updateAllMealCosts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meal_cost' => ['required', 'integer', 'min:1', 'max:100000'],
        ], [
            'meal_cost.required' => 'Meal cost is required.',
            'meal_cost.integer' => 'Meal cost must be a whole number.',
            'meal_cost.min' => 'Meal cost must be at least 1 RWF.',
            'meal_cost.max' => 'Meal cost cannot exceed 100,000 RWF.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update meal cost for all users who have food taken records
        $updatedCount = 0;
        $users = User::with('foodTaken')->get();
        
        foreach ($users as $user) {
            if ($user->foodTaken) {
                $user->foodTaken->meal_cost = $request->meal_cost;
                $user->foodTaken->save();
                $updatedCount++;
            }
        }

        return back()->with('success', 'Meal cost updated successfully for ' . $updatedCount . ' users to ' . number_format($request->meal_cost) . ' RWF');
    }
} 