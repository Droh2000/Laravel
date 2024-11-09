<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller; // Como ya esta en otra carpeta importa esto
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
    Comando usado para crear:
            php artisan make:controller Dashboard/PostController -r -m Post

    Si lo creamos solo indicando el nombre del controlador, por defecto nos crea la clase pero nada de codigo
    Con este parametro tenemos varios comandos
        r -> Con esto podemos crear un controlador de tipo recursos (Tipo CRUD), anteriormente habiamos
             visto la rutas de tipo Resources donde teniamos una serie de rutas que eran englobados en una sola
             donde cada ruta era un CRUD, con este paramtro el controlador ya nos crea las funciones para crear un CRUD

        m -> Con este creamos el modelo asociado al controlador (Asi las funciones que se nos generan por el parametro de arriba)
             ya tienen implementando en los parametros de las funciones el nombre del modelo indicado
             El modelo se puede crear desde cero o podemos indicarle un modelo ya Creado para asociarlo con el controlador
        
    Ademas al crear el controlar lo especificamos dentro de una carpeta donde vamos a agrupar el controlar ya que vamos a usar dos modulos
    uno para el usuario final y uno para el Dashboard (Si no existe la carpeta solo la crea y si existe solo anexa el controlador)
        
    Este controlador lo vamos a usar para hacer el Dashboard
*/

class PostController extends Controller
{
    // Las consultas de SQL las vamos a usar mediante funciones de PHP
    /**
     * Display a listing of the resource.
     */
    // Si queremos colocar mas control de lo que debe retornar el metodo (El tipo de dato especifico definirmos la respuesta)
    // el problema es que si no se cumple tendremos errores
    public function index() //: Response
    {
        // Con el controlar nos comunicamos a la Vista
        // Aqui para crear un registro esta la funcion de Create (En laravel tenemos una funcion para cada tipo de operacion a realizar)
        // que internamente se traducen estas funciones al SQL asociado al sistema gestor de base de datos que estamos empleando ( esto es ORM donde maipulamos este objeto a SQL)
        // Post::create([
        //     // Aqui ingresamos lo que queremos insertar a la tabla Posts
        //     'title' => 'test title',
        //     'slug' => 'test slug',
        //     'content' => 'test content',
        //     // Si no ha nada registrado en estqa tabla nos dara errores
        //     'category_id' => 1,// Suponemos que existe la categoria 1
        //     'description' => 'test description',
        //     'posted' => 'no', // Este como lo pusimos para que tome un valor por defecto no es obligacion declararla
        //     'image' => 'test imaga'
        // ]);
        // CTrl + k + c -> Cometar los seleccionado

        // ACTUALIZAR
        // Esta variable nos debe almacenar el ID o el id
        // Como queremos actualizar un registro, no podemos usar la referencia al modelo porque tenemos que indicar
        // lo que queremos actualizar pero fijemoos que al almacenar en la variable $post si tenemos la referencia a lo registrado
        // tenemos que actualizar el objeto (Usamos esa referencia)
        
        // Primero buscamos el objeto que queremos actualizar (En este caso el registro 1)
        // $post=Post::find(2); // Esto es equivalente al SELECT con WHERE

        // $post->update([
        //     // No tiene porque ser todos los campos
        //     'title' => 'test title changed',
        //     'slug' => 'test slug changed',
        //     'content' => 'test content changed',
        //     'image' => 'test imaga changed'
        // ]);
        // Hacer Debug (Saber lo que se esta imprimiendo)
        // Como es un objeto podemos consultar las propiedades
        // dd($post->title); -> Esto es como un Return entonrces detiene la ejecucion del codigo que tenga abajo

        //  ELIMINAR
        // $post = Post::find(3);// Encontramos el registro
        // $post->delete();
        // dd($post); // Si no existe es NULL porque lo eliminamosa antes pero si lo elimina correctamente nos da True
                     //  Con esto vemos lo que una Rest API nos puede regresar 
        
    /*
        En los controladores podemos regresar:
            Response: regresando una vista de tipo JSON (Respuesta generica)
            RedirectResponse: Devolver una operacion como los CRUD de arriba
            View: Una vista 
        Ejemplo:
            return response()->json([
                '' => '',
            ]);

            // Este es un texto que le asignamos el codigo 200 inertandolo en el Header y es un texto plano
            return response('Hello Word', 200)->header('Content-Type', 'text/plain');
    */
        /*
            Tambien tenemos otro tipo de relaciones (Para ser implementadas en los modelos)
            Relacion Actual:
                  * hasMany() -> Si una categoria tiene multiples Post
            Relacion Inversa:
                  * belongsTo() -> Si una categoria pertenece a un POST

            Aqui tenemos que una categoria puede tener muchos POST o una cateogira puede estar asignada a multiples POST
        */
        // Si quremos acceder a la categoria del POST
        $post = Post::find(2);
        // Aqui queremos acceder a la relacion del objeto
        //dd($post -> category_id); // Esto solo nos da el ID de la categoria que le corresponde del POST
        // Entonces para poder acceder al objeto completo tenemos que hacer el tipo de Relaciones comentadas
        // Para esto creamos el modelo de Categorias

        // Despues de implementar la relacion en el modelo podemos pasarle el campo nombrado asi
        // Ahora ya obtenemos la informacion detallada del objeto y no solo un Uno, por lo tanto podemos acceder a cada uno de sus atributos
        dd($post -> category-> title); 

        // Buscamos ahora por una categoria
        $category = Category::find(1);
        // Al ser varios estan en un Array entonces accedes por su posicion
        dd($category -> posts[0] -> title);

        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)// Este es l peticion del usuario
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // Si no creamos el controlador junto al modelo el parametro seria: String $id (Con este id buscariamos un Post)
    // Como si creamos el modelo Laravel hace una inyeccion de dependencias pasandole el modelo (El nombre de la URL la asocia al modelo POST)
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
