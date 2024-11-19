<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Producto;
use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalProductos = Producto::where('user_id', $userId)->count();
        
        $productosStockBajo = Producto::where('user_id', $userId)
            ->whereRaw('stock <= stock_minimo')
            ->count();
        
        $entradasHoy = MovimientoInventario::whereHas('producto', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('tipo_movimiento', 'entrada')
            ->whereDate('created_at', today())
            ->count();
        
        $salidasHoy = MovimientoInventario::whereHas('producto', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('tipo_movimiento', 'salida')
            ->whereDate('created_at', today())
            ->count();

        $movimientosPorFecha = DB::table('movimientos_inventario')
            ->join('productos', 'movimientos_inventario.producto_id', '=', 'productos.id')
            ->where('productos.user_id', $userId)
            ->select(
                DB::raw('DATE(movimientos_inventario.created_at) as fecha'),
                DB::raw('COUNT(CASE WHEN tipo_movimiento = "entrada" THEN 1 END) as total_entradas'),
                DB::raw('COUNT(CASE WHEN tipo_movimiento = "salida" THEN 1 END) as total_salidas'),
                DB::raw('COUNT(DISTINCT movimientos_inventario.producto_id) as productos_afectados')
            )
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->get();

        return view('user.dashboard', compact(
            'totalProductos',
            'productosStockBajo',
            'entradasHoy',
            'salidasHoy',
            'movimientosPorFecha'
        ));
    }
}
