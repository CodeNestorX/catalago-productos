@extends('user.dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Todos los Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Todos los Productos</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Stock Mínimo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $index => $producto)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>
                            {{ $producto->stock }}
                            @if($producto->tieneStockBajo())
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-triangle"></i> Stock Bajo
                                </span>
                            @endif
                        </td>
                        <td>{{ $producto->stock_minimo }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{ route('movimientos.createEntrada', ['categoria' => $producto->categoria_id, 'producto' => $producto->id]) }}" class="btn btn-success btn-sm">Entrada</a>
                            <a href="{{ route('movimientos.createSalida', ['categoria' => $producto->categoria_id, 'producto' => $producto->id]) }}" class="btn btn-danger btn-sm">Salida</a>
                            <a href="{{ route('movimientos.historial', $producto->id) }}" class="btn btn-info btn-sm">Historial</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection