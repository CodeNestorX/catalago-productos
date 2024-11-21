@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Mi Perfil</h1>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Información Personal
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <p class="form-control-static text-primary fs-5">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Correo Electrónico</label>
                        <p class="form-control-static text-primary fs-5">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total de Categorías</label>
                        <p class="form-control-static">{{ $totalCategorias }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total de Productos</label>
                        <p class="form-control-static">{{ $totalProductos }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-key me-1"></i>
                    Acciones de Cuenta
                </div>
                <div class="card-body">
                    <a href="{{ route('profile.password') }}" class="btn btn-warning mb-3 w-100">
                        <i class="fas fa-key me-1"></i> Cambiar Contraseña
                    </a>
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="fas fa-trash me-1"></i> Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Eliminar Cuenta -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación de Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    <strong>¡Advertencia!</strong> Esta acción no se puede deshacer.
                </p>
                <p>Al eliminar tu cuenta:</p>
                <ul>
                    <li>Se eliminarán todas tus categorías</li>
                    <li>Se eliminarán todos tus productos</li>
                    <li>Se perderá todo el historial de movimientos</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar mi cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection