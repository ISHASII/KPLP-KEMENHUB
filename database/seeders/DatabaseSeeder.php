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
        // Create or Update Admin User (use email as unique key to avoid missing column errors)
        User::updateOrCreate(
            ['email' => 'admin@kemenhub.go.id'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Create or Update Regular User for testing
        User::updateOrCreate(
            ['email' => 'user@kemenhub.go.id'],
            [
                'name' => 'User Biasa',
                'username' => 'user',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'is_active' => true,
            ]
        );
    }
}
