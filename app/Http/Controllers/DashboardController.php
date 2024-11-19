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
        $totalProductos = Producto::count();
        $productosStockBajo = Producto::whereRaw('stock <= stock_minimo')->count();
        $entradasHoy = MovimientoInventario::where('tipo_movimiento', 'entrada')
            ->whereDate('created_at', today())
            ->count();
        $salidasHoy = MovimientoInventario::where('tipo_movimiento', 'salida')
            ->whereDate('created_at', today())
            ->count();

        $movimientosPorFecha = DB::table('movimientos_inventario')
            ->select(
                DB::raw('DATE(created_at) as fecha'),
                DB::raw('COUNT(CASE WHEN tipo_movimiento = "entrada" THEN 1 END) as total_entradas'),
                DB::raw('COUNT(CASE WHEN tipo_movimiento = "salida" THEN 1 END) as total_salidas'),
                DB::raw('COUNT(DISTINCT producto_id) as productos_afectados')
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
