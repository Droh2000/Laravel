<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller; // Como ya esta en otra carpeta importa esto
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\PutRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\HttpCache\Store;

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
        //  $post = Post::find(2);
        // Aqui queremos acceder a la relacion del objeto
        //dd($post -> category_id); // Esto solo nos da el ID de la categoria que le corresponde del POST
        // Entonces para poder acceder al objeto completo tenemos que hacer el tipo de Relaciones comentadas
        // Para esto creamos el modelo de Categorias

        // Despues de implementar la relacion en el modelo podemos pasarle el campo nombrado asi
        // Ahora ya obtenemos la informacion detallada del objeto y no solo un Uno, por lo tanto podemos acceder a cada uno de sus atributos
        //  dd($post -> category-> title); 

        // Buscamos ahora por una categoria
        //   $category = Category::find(1);
        // Al ser varios estan en un Array entonces accedes por su posicion
        // dd($category -> posts[0] -> title);

        // LISTAR LOS POSTS
        /*
            PAGINACION EN LARAVEL
        
            Para mostrar conjuntos o subconjuntos si tenemos 100 posts no los vamos a mostrar de Golpe
            asi que solo mostramos solo un conjunto por paginas (registro por registro)

            En lugar de Post::get() usamos Post::paginate(NumeroDeRegistrosPorPaginas)
            ya esto nos hace toda la logica en base a la paginacion
            Esto por defecto nos muestra el numero de registros indicados por pagina
        */
        $posts = Post::paginate(2); // Obtenemos todos los posts
    
        // CREAMOS LA VISTA
        // Como buena practica del nombre la nombramos como el metodo del Controllador que la usa

        return view('dashboard/post/index', compact('posts'));
    }

    // Aqui tenemos dos funciones para crearlo, el que recibe el Request es de tipo POST
    // que es el que recibe la peticion del usuario y el Create es de tipo GET
    // Para saber los tipos de estas funciones lo podemos verificar en: php artisan r:l
    // En este caso el nombre son: post.create, post.store
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Esta funcion se llama en el Form con method=POST
        // Para las categorias si se las tenemos que pasar las que tengamos almacenadas en la BD
        //$categries = Category::get(); -> Con este obtenemos el arreglo de todos los campos de la cateogrias pero no los requereimos todos
        $categories = Category::pluck('id', 'title');// -> Con esta funcion le especificamos solo los campos que requerimos (Esto nos da un array de clave:valor)
        //dd($categries) // Analizamos que si obtengamos las categorias

        //  OBJETO POR LA CREACION DE REUTILZAR LOS CAMPOS DEL FORMULARIO
        $post = new Post(); // Le pasamos el objeto post que esper recibir que estaria limpio porque este es para Crear y se adapto a los campos de actualizar

        // Para las rutas podemos usar . o slash
        // Le pasamos los valores con compact
        return view('dashboard/post/create', compact('categories','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)// Este es l peticion del usuario
    {
        // Al dar click en el boton para enviar el formulario lo recibiremos desde este metodo
        // Asi podemos acceder a los datos que esta mandando el usuario
        // dd($request->all());          -> Asi accedemos a todos los datos
        // dd($request->all()['title']); -> acceder por campos
        // dd(request()->get('title'));  -> Esto es lo mismo que arriba

        // Le pasamos los valores definidos en el formulario
        // podemos acceder con la funcion o la variable request
        // Post::create([
            // 'title' => $request->all()['title'],
            // 'slug' => $request->all()['slug'],
            // 'content' => $request->all()['content'],
            // 'category_id' => $request->all()['category_id'],
            // 'description' => $request->all()['description'],
             /*     el de posted como ya le pusimos un valor por defecto lo podriamos omitir
                    Si especificamos otor nombre en la propiedad, donde no sea posted sino postedmfrfrf
                    esto no nos dara error y si verificamos en la BD se creo otro post, esto paso porque en el $fillable del modelo tenemos
                    los campos manejables desde el modelo lo que siginifica que cualquier campo adicional no sera tomado en cuenta
                    esto es otra capa de proteccion que tiene laravel 
                    Este ejemplo aplica cuando en el modelo usuario tenemos el campo ROL entonces no tiene caso especificar al registrar un nuevo usuario el tipo de rol
                    y ademas exponer este campo en el Fronted, lo mejor es que lo establecemos con un valor por defecto como usuario regular y solo editamos nosotros
                    su rol en caso de ser Administrador (No tenemos que poner todos los campos en $fillable para exponer los que requerimos) asi laravel si le ponemos 
                    otros campos solo los omite */
             // 'posted' => $request->all()['posted'],
             //'image' => $request->all()['image']
         //]);// Cuando se recarga la pagina se envia el formulario que es cuando envia el POST
         // dd($request->all()); -> Aqui tambien tenemos el campo del Token que no forma parte del post

        // APLICAR VALIDACIONES BASICAS
        // Aqui dentro del array indicamos la validacion para cada uno de los campos
        /*$request->validate([
                        // Argumento : Valor
            'title' => 'required|min:5|min:500', // La longitud maxima la ponemos igual que lo maximo en la tabla de la BD
            'slug' => 'required|min:5|min:500',
            'content' => 'required|min:7',
            'category_id' => 'required|integer',
            'description' => 'required|min:7',
            'posted' => 'required',
        ]);*/// Si no se cunmplen las validacion no Continua con las lineas de abajo, esto por defecto hace una redireccion a la misma pagina

        // SEGUNDA FORMA DE APLICAR VALIDACIONES
        // Con la Clase "Facade" llamada "Validator", estas clases se pueden consumir sus metodos de manera estatica
        // YA no se usan tanto porque su sintaxis es mas compleja y es anit-patron (Se puede usar si no tenemos acceso al Request)
        // Con este no hacemos una redireccion
        // Primero se le pasa un array con los datos que queremos validar
        /*$validate = Validator::make($request->all(),[ // esto nos retorna el resultado si se paso o no la validacion
            'title' => 'required|min:5|min:500',
            'slug' => 'required|min:5|min:500',
            'content' => 'required|min:7',
            'category_id' => 'required|integer',
            'description' => 'required|min:7',
            'posted' => 'required',
        ]);// Con este se ejecuta el resto del codigo independientemente si se pasan las validaciones o NO
        dd($validate->fails());*///Con fails es para saber si se pasaron las validaciones o NO

        // OTRO ESQUEMA PARA APLICAR LAS VALIDACIONES
        // Este es con otra clase aparte y se ejecuta el comando
        // php artisan make:request Post/StoreRequest
        // Arriba pusimos Post(Es el tipo de Recurso que lo ponemos en esta otra carpeta aparte) pero ademas estas mismas validaciones se aplicara 
        // tanto para crear como para editar (En este caso si aplica para todos los campos), el nombre Store es el nombre del metodo que es parte del Requset
        // Asi le damos este nombre particular a esta clase para la validacion
        // Para usarlo lo inyectamos en la funcion como StoreRequest
        // Asi dentro del CREATE en lugar de all usamos VALIDATE()
        // ASI COLOCAMOS LAS VALIDACIONES EN OTRO ARCHIVO APARTE

        // Lo de arriba lo podemos simplificar mucho mas
        // El create() recibe un array que ya lo tenemos en el $request
        //Post::create($request->all());// Como los campos que no existen en el $fillable solo los ignora, esto funciona sin problemas
        Post::create($request->validated()); // Asi ya nos protegemos de SQL inyection y listos para ser procesados

        // Como este es un controlador que no tiene una vista asociada por lo tanto hacemos una redireccion
        // Esto ya depende, en este caso queremos mandarlo a la pagina de inicio
        return to_route('post.index');
    }

    /**
     * Display the specified resource.
     */
    // Si no creamos el controlador junto al modelo el parametro seria: String $id (Con este id buscariamos un Post)
    // Como si creamos el modelo Laravel hace una inyeccion de dependencias pasandole el modelo (El nombre de la URL la asocia al modelo POST)
    public function show(Post $post)
    {
        // Detalle 
        // En lugar de compact le podemos pasar el parametro ASI
        return view('dashboard/post/show',['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Este es para la parte del GET para mostrar el formulario
        // aqui como parametro ya tenemos la entidad que queremos editar asi que los datos tienen
        // que estar presentes en el mismo post y que no se pierdan los datos anteriores
        // En el HTML en el FORM en VALUES colocamos el valor actual $post->campo (Seria otra vista)
        
        //$p = Post::find($post->id); -> El post ya lo tenemos inyectado en la RUTA

        $categories = Category::pluck('id', 'title');
        
        return view('dashboard/post/edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        // Este es para actualizarlo porque tenemos el Request que es el que recibe la peticion del usuario
        // El validate toma solo los campos definidos porque si los ponemos en la interface pero no estan en la validacion entonces no toma esos campos  y no los cambia

        // Con la Funcion: 'public_path()' accedemos a los archivo de la carpeta publica
        // Esto esta definido en Config/filesystems.php en el array de "disk" esta especificados sistemas de almacenamiento
        // que en este caso es la ruta publica (Tambien podemos configurar almacenamiento de archivos en la nube)
        // A esta funcion le anexamos cualquier carpeta (En este caso donde esta la imagen)

        // No se nos olvide agregar la validacion de la imagen en el PutRequest
        $data = $request->validated();// Si aqui no pasa las validaciones entonces no continua con la ejecucion

        // Manipulamos la IMAGEN
        // dd($request->image) -> Si analizamos esto veremos que es un objeto de una clase por eso podemos llamar metodos
        // Verificamos si el usuario subio una imagen ya que es opcional
        if(isset($data['image'])){ // que el nombre sea correcto y sea una imagen no otro archivo
            // Aqui hacemos una asignacion multiple, con ['image'] accedemos al campo obteniendo la extencion pero le agregamos el nombre
            // con la funcion 'time()' que es para evitar problemas con imagenes que tengan el mismo nombre con esto ya las diferenciamos
            // Con el Punto concatenamos la Extencion
            $data['image'] = $filename = time().'.'.$data['image']->extension();

            // La movemos hacia la ruta publica
            $request->image->move(public_path('uploads/posts'), $filename);
        }

        $post -> update($data);

        return to_route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //$post = Post::find(3);
        $post->delete();

        return to_route('post.index');
    }
}
