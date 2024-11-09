<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // En base al nombre que ejecutamos en la linea de comandos supo laravel que creara este metodo y la tabla "categories"
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);// por defecto no es nula
            // SLUG es la URL limpia, esta la usamos para reaizar unas acciones por esta URL
            $table->string('slug', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
