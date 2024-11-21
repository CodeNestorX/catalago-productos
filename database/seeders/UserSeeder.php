<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Crear 5 usuarios adicionales
        User::factory(5)->create();
    }
}