<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Categoria::create([
                'nombre' => 'Electrónicos',
                'descripcion' => 'Productos electrónicos y gadgets',
                'user_id' => $user->id,
            ]);

            Categoria::create([
                'nombre' => 'Herramientas',
                'descripcion' => 'Herramientas de trabajo',
                'user_id' => $user->id,
            ]);

            Categoria::create([
                'nombre' => 'Oficina',
                'descripcion' => 'Artículos de oficina',
                'user_id' => $user->id,
            ]);
        }
    }
}