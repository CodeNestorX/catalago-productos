@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Resumen de Movimientos</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total Productos: {{ $totalProductos }}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Productos con Stock Bajo: {{ $productosStockBajo }}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total Entradas Hoy: {{ $entradasHoy }}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total Salidas Hoy: {{ $salidasHoy }}
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Movimientos por Fecha
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Total Entradas</th>
                        <th>Total Salidas</th>
                        <th>Productos Afectados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movimientosPorFecha as $movimiento)
                    <tr>
                        <td>{{ $movimiento->fecha }}</td>
                        <td>{{ $movimiento->total_entradas }}</td>
                        <td>{{ $movimiento->total_salidas }}</td>
                        <td>{{ $movimiento->productos_afectados }}</td>
                        <td>
                            <a href="{{ route('movimientos.pdf', $movimiento->fecha) }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
