<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        // En esta clase podemos registrar nuestros Seeder y asi poder mandarlos a llamar todos
        // en una sola linea de comandos (Hay que fijarnos de colocarlos en el Orden Correcto)
        // Primero tenemos que ejectuar el de las cateogiras porque esta nos borra por defecto todos los Post
        //$this->call([
        //    CategorySeeder::class,
        //    PostSeeder::class,
        //]);
        // Si obtennemos errores es porque hay que comentar las lineas de codigos de STATEMENT

        // Ahora implementamos los FACTORY
        // agregamos la cantidad de factories que queremos agregar
        Post::factory(30)->create();

    }
}
