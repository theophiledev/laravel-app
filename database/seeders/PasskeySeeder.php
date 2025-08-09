<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PasskeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set default passkeys for users who don't have one
        $users = User::whereNull('passkey')->orWhere('passkey', '')->get();
        
        foreach ($users as $user) {
            $user->passkey = '0000';
            $user->save();
        }
        
        $this->command->info('Default passkeys set for ' . $users->count() . ' users.');
    }
} 