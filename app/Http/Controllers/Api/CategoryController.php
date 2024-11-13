<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Este es un controlador de tipo Recurso
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // En esta ocacion no queremos retornar una vista sino una respuesta tipo JSON
        // El response es para regresar una respuesta y le aplicamos el tipo JSON
        // Nos interesa que este paginado asi que podemos meter ya de una la paginacion
        // 
        return response()->json(Category::paginate(10));
    }

    // Crer otro tipo de metodos
    // Queremos un metodo que nos regrese todas las categorias 
    public function all(){
        return response()->json(Category::get());
    }
    // Despues de crear el metodo nos ponemos a crear la Ruta en API.PHP

    // Metodo personalizado para buscar por el SLUG
    // Hay varias formas de lograr esto, por ejemplo con la inyeccion de dependencias o especificando
    // en el parametro de la funcion el tipo de dato que estamos buscando
    public function slug(string $slug)// El dato lo recibimos de la URL
    {
        // Hacemos la busquedad
        // Con la funcion del final encuentra la primera coincidencia y sino lo encuentra regresa una excepcion
        $category = Category::where('slug', $slug)->firstOrFail();
        // Tenemos que manejar las excepciones porque obtendremos un error donde se expone mucha informacion de nuestra aplicacion
        // asi que debemos de capturar la excepcion (En APP.PHP tenemos para manejar los middleware y las Excepciones)

        return response()->json($category);
    }// Despues de esto creamos la ruta en el API.PHP


    // Aqui el proceso de Creacion y Actualizacion se hace en un solo controlador
    // porque aqui no se regresa una vista como antes para mostrar el formulario 
    // aqui solo se envia la solicitud

    // Con este metodo almacenamos la peticion (Aqui usamos los Request que creamos)
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Nosotros queremos devolver una respuesta (Asi que todas las respuestas la regresamos dentro del JSON)
        return response()->json(Category::create($request->validated()));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Solo mostramos la categoria
        return response()->json($category);
    }

    // Implementamos el Request que creamos (Gracias a esto nos saldran los mensajes de las validaciones)
    // en caso que no se cumpla una validacion no saldra el mensaje de Error en el JSON
    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('ok');
    }
}
