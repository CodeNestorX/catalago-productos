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
        Schema::table('productos', function (Blueprint $table) {
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(0);
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['stock', 'stock_minimo']);
        });
    }
};
