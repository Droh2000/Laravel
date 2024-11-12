<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Esquema para Agregar una nueva columna a la Tabla de Users
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Creamos la Columna 'rol'
            $table->enum('rol', ['admin', 'regular'])->default('regular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimanos la columna por el Rollback
            $table->dropColumn('rol');
        });
    }
};
