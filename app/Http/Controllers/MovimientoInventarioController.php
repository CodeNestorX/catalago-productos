<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class MovimientoInventarioController extends Controller
{
    public function createEntrada($categoriaId, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        return view('categorias.productos.formEntrada', compact('producto'));
    }

    public function createSalida($categoriaId, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        return view('categorias.productos.formSalida', compact('producto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'tipo_movimiento' => 'required|in:entrada,salida',
            'motivo' => 'required|string|max:255',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        if ($request->tipo_movimiento === 'salida' && $producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $movimiento = new MovimientoInventario();
        $movimiento->producto_id = $request->producto_id;
        $movimiento->cantidad = $request->cantidad;
        $movimiento->tipo_movimiento = $request->tipo_movimiento;
        $movimiento->motivo = $request->motivo;
        $movimiento->save();

        // Actualizar stock
        if ($request->tipo_movimiento === 'entrada') {
            $producto->stock += $request->cantidad;
        } else {
            $producto->stock -= $request->cantidad;
        }
        $producto->save();

        // Verificar stock bajo
        if ($producto->tieneStockBajo()) {
            // Aquí podrías implementar el envío de notificaciones
        }

        return redirect()->route('productos.index', $producto->categoria_id)
            ->with('success', 'Movimiento registrado exitosamente.');
    }

    public function historial($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $movimientos = $producto->movimientos()->orderBy('created_at', 'desc')->get();
        return view('categorias.productos.historial', compact('producto', 'movimientos'));
    }
}
