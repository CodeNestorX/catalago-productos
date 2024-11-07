<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 
        'descripcion', 
        'precio', 
        'categoria_id',
        'stock',
        'stock_minimo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoInventario::class);
    }

    public function tieneStockBajo()
    {
        return $this->stock <= $this->stock_minimo;
    }
}
