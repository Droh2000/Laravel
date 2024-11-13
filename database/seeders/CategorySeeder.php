<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aqui van los registros que queremos generar
        // En la documentacion usan el DB (Query builder) pero nosotros ya tenemos el modelo
        // para usar Eloquent
        // Aqui ademas se usan los Bucles para generar varios datos de prueba (Aprovechando el iterador le podemos agregar datos dinamicos)
        // Depende de nosotros como queremos manejar esto ya que si ejecutamos el comando para generar todos los 
        // seeders es mejor eliminar la DAta ya registrada porque sino se nos va a generar multiples veses esto

        // En caso de tener problemas tambien tenemos la siguiente sintaxis
        DB::statement('SET FOREIGN_KEY_CHECKS=0');// Desactivamos las FK para que no nos borre los contenido de los POSTs

        // Asi eliminamos la Data Anterior primero pero hay que tener en cuenta si esta tabla esta Relacionada con una FK
        // Esto nosotros los configuramos al incio con los Post como una RELACION DE TIPO CASCADA por lo tanto al eliminar 
        // las categorias tambien se eliminan los datos asociados a la otra tabla Post
        Category::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');//Ya creada la data volvemos a activar las FK

        for($i=0; $i < 20; $i++){// En este caso vamos a generar 20 registros
            Category::create([
                'title' => "Category $i",
                'slug' => "category-$i"
            ]);
        }
    }
}
