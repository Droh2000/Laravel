<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Este es un controlador de tipo Recurso
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::paginate(10));
    }

    public function all()
    {
        return response()->json(Post::get());
    }

    // La diferencia de este con el de Category es que aqui estamos realizando la inyeccion de dependencias
    public function slug(Post $post)// El dato lo recibimos de la URL
    {
        //$post = Post::where('slug', $slug)->firstOrFail();
        return response()->json($post);// Con la inyeccion de dependencias solo se declara esta linea
    }// En la definicion de las rutas tambien cambia por la inyeccion de dependencias

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Nosotros queremos devolver una respuesta (Asi que todas las respuestas la regresamos dentro del JSON)
        return response()->json(Post::create($request->validated()));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Solo mostramos la categoria
        return response()->json($post);
    }

    // Implementamos el Request que creamos
    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('ok');
    }
}
