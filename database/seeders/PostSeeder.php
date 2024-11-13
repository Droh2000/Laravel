<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos datos de prueba para los POSTS
        //DB::statement('SET FOREIGN_KEY_CHECKS=0'); --> Estas dos lineas si nos da error las habilitamos o sino las comentamos
        Post::truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS=1');

        for($i=0; $i<20; $i++){

            // Generamos un texto aleatorio en el Titulo de 20 caracteres
            $title = Str::random(20);
            // Tambien podemos hacerlo con funcion de ayuda
            //$title = str()->random(20);

            // Para el Id de la categoria 
            // Lo ponemos para obtenerlo en cualquier orden el listado de las categorias 
            // y nosotros solo obtenemos el primer ID
            $c = Category::inRandomOrder()->first();

            Post::create([
                'title'=>$title,
                'slug'=> Str::slug($title),// str($title)->slug()
                'description'=> "Description $i",
                'content'=>"Content $i",
                'posted'=> "yes",
                'image'=>"Image$i.jpg",
                'category_id'=> $c->id,
            ]);

            // Por el tipo de relacion importa mucho como ejecutemos esto ya que 
            // si primero ejecutamos el de las categorias va a eliminar primero los posts 
            //  y no se nos va a crear nigun Post
        }   
    }
}
