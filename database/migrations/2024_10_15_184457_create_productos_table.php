<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del producto
            $table->text('descripcion')->nullable(); // Descripción del producto
            $table->decimal('precio', 8, 2); // Precio del producto
            $table->unsignedBigInteger('categoria_id'); // Relación con la tabla de categorías
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade'); // Clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
