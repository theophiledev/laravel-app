<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyFood;
use Carbon\Carbon;

class DailyFoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::today();
        
        // Add today's menu items
        $foods = [
            'Rice and Beans',
            'Ugali and Sukuma Wiki',
            'Chapati and Stew',
            'Bread and Butter',
            'Tea and Coffee',
            'Fresh Fruits',
        ];
        
        foreach ($foods as $foodName) {
            DailyFood::create([
                'food_name' => $foodName,
                'date' => $today,
            ]);
        }
        
        $this->command->info('Daily food items added for today: ' . count($foods) . ' items');
    }
} 