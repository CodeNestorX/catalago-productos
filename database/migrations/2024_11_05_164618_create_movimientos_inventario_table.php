<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->enum('tipo_movimiento', ['entrada', 'salida']);
            $table->integer('cantidad');
            $table->text('motivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_inventario');
    }
};
