<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('dashboard/category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        return view('dashboard/category/create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Category::create($request->validated());

        // Mensaje de tipo Flash para indicar al usuario que la accion se realizo
        // Dentro del With se pasa como CLAVE : Valor accediendo a la vaisa con la Clave 
        // Estos solo se muestran un Request, saliendo despues que se manda al usuario a la pagina indicada aqui
        return to_route('category.index')->with('status', 'Category created');

        // Mensaje de Session
        // Es igual con Clave:Valor pero a diferencia del anterior no dura solo un request sino
        // que dura lo que configuremos en tiempo, esta forma se usa comunmente para almacenar datos
        // de usuario, dato de control, datos de compra

        // Aqui estamos estableciendo un Valor en la llave Key
        session(['key' => 'value']);

        // Para destruir el mensaje (Se tiene que comentar la linea de arriba que lo activa y descomentar esta linea que destruye)
        session()->flush();// Este no recibe argumento y destruye todo
        // session()->forget('key');// Es para indicar cual de las Claves queremos destruir en caso de tener varias

        // Para activar esto tenemos que ir a la pagina de index (Porque ahi esta implementado para ver el SESSION)
        // asi activamos o desactivamos la SESSION
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard/category/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard/category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());

        return to_route('category.index')->with('status', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('category.index')->with('status', 'Category Deleted');
    }
}
