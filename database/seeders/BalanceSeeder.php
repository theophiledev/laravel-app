<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add initial balance to users who don't have sufficient balance
        $users = User::whereHas('foodTaken', function($query) {
            $query->where('payment_amount', '<', 5000);
        })->get();
        
        foreach ($users as $user) {
            if ($user->foodTaken) {
                // Add 50,000 RWF to their balance
                $user->foodTaken->payment_amount = 50000;
                $user->foodTaken->times_remaining = 10; // 10 meals
                $user->foodTaken->save();
            }
        }
        
        $this->command->info('Initial balance added to ' . $users->count() . ' users.');
    }
} 