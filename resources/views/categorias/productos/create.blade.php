@extends('user.dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Agregar Producto a {{ $categoria->nombre }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
        <li class="breadcrumb-item active">Agregar Producto</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('productos.store', $categoria->id) }}" method="POST">
                @csrf
                <!-- Campo para el nombre del producto -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ej: Taladro, Monitor, Pintura acrílica" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Campo para el precio del producto -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" placeholder="Ej: 499.99" value="{{ old('precio') }}" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para la descripción del producto -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </form>
        </div>
    </div>
</div>
@endsection
