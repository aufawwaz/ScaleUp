<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Demo',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@example.com',
                'password' => Hash::make('userpass456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
