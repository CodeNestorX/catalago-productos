@extends('layouts.app') 

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Productos en {{ $categoria->nombre }}</h1>
    <h2 class="mt-4">Mis Productos</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
        <li class="breadcrumb-item active">Mis Productos</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Productos
            <a href="{{ route('productos.create', $categoria->id) }}" class="btn btn-primary btn-sm float-end">Agregar Nuevo Producto</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
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
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->descripcion }}</td>
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
                            <!-- Botones de acciones -->
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{ route('movimientos.createEntrada', ['categoria' => $producto->categoria_id, 'producto' => $producto->id]) }}" class="btn btn-success btn-sm">Entrada</a>
                            <a href="{{ route('movimientos.createSalida', ['categoria' => $producto->categoria_id, 'producto' => $producto->id]) }}" class="btn btn-danger btn-sm">Salida</a>
                            <a href="{{ route('movimientos.historial', $producto->id) }}" class="btn btn-info btn-sm">Historial</a>

                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
    </div>
</div>

@endsection

