<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'tipo_movimiento',
        'motivo', 
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class); // Un movimiento de inventario pertenece a un producto
    }
}
