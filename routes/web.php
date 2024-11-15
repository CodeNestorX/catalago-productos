<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MovimientoInventarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class)->only(['create', 'store']);
    // Ruta para mostrar los productos de una categoría específica
    Route::get('/categorias/{categoria}/productos', [ProductoController::class, 'index'])->name('productos.index');
    // Ruta para agregar un nuevo producto a una categoría
    Route::get('/categorias/{categoria}/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    // Ruta para guardar un nuevo producto
    Route::post('/categorias/{categoria}/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/productos/{categoria}/{producto}/entrada', [MovimientoInventarioController::class, 'createEntrada'])->name('movimientos.createEntrada');
    Route::get('/productos/{categoria}/{producto}/salida', [MovimientoInventarioController::class, 'createSalida'])->name('movimientos.createSalida');
    Route::post('/movimientos', [MovimientoInventarioController::class, 'store'])->name('movimientos.store');
    Route::get('/productos/{producto}/historial', [MovimientoInventarioController::class, 'historial'])->name('movimientos.historial');
    Route::get('/productos', [ProductoController::class, 'allProducts'])->name('productos.all');
    Route::get('/movimientos', [MovimientoInventarioController::class, 'allMovimientos'])->name('movimientos.all');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

require __DIR__.'/auth.php';
