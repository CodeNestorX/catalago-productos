@extends('user.dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Historial de Movimientos - {{ $producto->nombre }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index', $producto->categoria_id) }}">Productos</a></li>
        <li class="breadcrumb-item active">Historial de Movimientos</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-history me-1"></i>
            Registro de Movimientos
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Stock Resultante</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($movimiento->tipo_movimiento === 'entrada')
                                <span class="badge bg-success">Entrada</span>
                            @else
                                <span class="badge bg-danger">Salida</span>
                            @endif
                        </td>
                        <td>{{ $movimiento->cantidad }}</td>
                        <td>{{ $movimiento->stock_resultante }}</td>
                        <td>{{ $movimiento->motivo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mb-4">
        <a href="{{ route('productos.index', $producto->categoria_id) }}" class="btn btn-secondary">Volver a Productos</a>
    </div>
</div>
@endsection
