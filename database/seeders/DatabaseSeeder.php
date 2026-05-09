<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Manager Account
        User::firstOrCreate(
            ['username' => 'manager'],
            [
                'name' => 'General Manager',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]
        );

        // Staff Account
        User::firstOrCreate(
            ['username' => 'staff'],
            [
                'name' => 'Staff',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );
    }
}
