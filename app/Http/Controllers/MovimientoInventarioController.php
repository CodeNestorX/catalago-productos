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
            'stock_minimo' => 'sometimes|required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        if ($request->tipo_movimiento === 'salida' && $producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        // Si se proporciona un nuevo stock_minimo, actualizarlo
        if ($request->has('stock_minimo')) {
            $producto->stock_minimo = $request->stock_minimo;
        }

        // Calcular nuevo stock
        $nuevo_stock = $request->tipo_movimiento === 'entrada' 
            ? $producto->stock + $request->cantidad 
            : $producto->stock - $request->cantidad;

        $movimiento = new MovimientoInventario();
        $movimiento->producto_id = $request->producto_id;
        $movimiento->cantidad = $request->cantidad;
        $movimiento->tipo_movimiento = $request->tipo_movimiento;
        $movimiento->motivo = $request->motivo;
        $movimiento->stock_resultante = $nuevo_stock;  // Guardamos el stock resultante
        $movimiento->save();

        // Actualizar stock del producto
        $producto->stock = $nuevo_stock;
        $producto->save();

        // Verificar stock bajo
        if ($producto->tieneStockBajo()) {
            session()->flash('warning', "¡Advertencia! El stock de {$producto->nombre} está por debajo del mínimo ({$producto->stock_minimo} unidades)");
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
