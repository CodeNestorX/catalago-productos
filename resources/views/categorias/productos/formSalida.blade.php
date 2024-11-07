@extends('user.dashboard')

@section('content')
<div class="container">
    <h2>Registrar Salida para {{ $producto->nombre }}</h2>
    <form action="{{ route('movimientos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
        <input type="hidden" name="tipo_movimiento" value="salida">
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad de Salida</label>
            <input type="number" name="cantidad" class="form-control" required min="1">
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <input type="text" name="motivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger">Registrar Salida</button>
        <a href="{{ route('productos.index', $producto->categoria_id) }}" class="btn btn-secondary">Regresar a Productos</a>
    </form>
</div>
@endsection
