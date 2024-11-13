<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

// Aqui configuramos las Rutas para la API


// Ruta para otro tipo de meotods (Metodos personalizados)
Route::get('category/all', [CategoryController::class, 'all']);
// EL ORDEN en el que coloquemos las rutas es muy importante ya que las que son mas especificas
// como esta que no es de tipo RESOURCES, estas especificas tienen que ir arriba
// ya que laravel con la de tipo Resources va a buscar en este caso el parametro 'all' en la BD
// y se puede confundir, por eso esta ruta al ponerlo arriba va a estar sobrescribiendo a la Resources
Route::get('post/all', [PostController::class, 'all']);

// Ruta para el metodo de buscar por el SLUG
Route::get('category/slug/{slug}', [CategoryController::class, 'slug']);
// Aqui cambio porque en el controller esamos definiendo el parametro con inyeccion de dependencias
// donde indicamos que haga el mapeo automaticamente (Por defecto egresa la primera ocurrencia)
Route::get('post/slug/{post:slug}', [PostController::class, 'slug']);

// Para las categorias no queremos que se habiliten las opciones de Crear ni Editar
// Esto lo especificamos dentro de la funcion except()
Route::resource('category', CategoryController::class)->except(['create', 'edit']);

Route::resource('post', PostController::class)->except(['create', 'edit']);
