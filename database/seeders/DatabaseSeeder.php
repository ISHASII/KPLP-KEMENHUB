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
        // Create or Update Admin User
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@kemenhub.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Create or Update Regular User for testing
        User::updateOrCreate(
            ['username' => 'user'],
            [
                'name' => 'User Biasa',
                'email' => 'user@kemenhub.go.id',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'is_active' => true,
            ]
        );
    }
}