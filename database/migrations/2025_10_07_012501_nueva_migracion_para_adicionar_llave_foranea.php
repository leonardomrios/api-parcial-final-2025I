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
        Schema::table('computers', function (Blueprint $table) {
            // Agregar llave foránea para categorías
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id_category')->on('categories');
            
            // Agregar campo para código de barras (string sin valor por defecto)
            $table->string('computer_barcode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('computers', function (Blueprint $table) {
            // Eliminar llave foránea y campos agregados
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'computer_barcode']);
        });
    }
};
