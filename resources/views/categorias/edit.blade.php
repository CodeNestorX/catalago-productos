@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Categoría</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
        <li class="breadcrumb-item active">Editar Categoría</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" placeholder="Ej: Pinturas, Herramientas, Electrónica" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" placeholder="Breve descripción de la categoría. Ej: Productos relacionados con pinturas y accesorios para pintar.">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
            </form>
        </div>
    </div>
</div>
@endsection
