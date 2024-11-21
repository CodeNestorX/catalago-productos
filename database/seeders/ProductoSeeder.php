<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();

        foreach ($categorias as $categoria) {
            for ($i = 1; $i <= 5; $i++) {
                Producto::create([
                    'nombre' => "Producto {$i} - {$categoria->nombre}",
                    'descripcion' => "Descripción del producto {$i}",
                    'precio' => rand(100, 1000),
                    'stock' => rand(5, 50),
                    'stock_minimo' => 10,
                    'categoria_id' => $categoria->id,
                    'user_id' => $categoria->user_id,
                ]);
            }
        }
    }
}