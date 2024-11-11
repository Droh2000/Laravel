<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Generamos varias rutas porque ya tenemos todas las funciones en el controlador
//Route::resource('post', PostController::class);
//Route::resource('category', CategoryController::class);

//          Aplicar la Agrupacion de Rutas

// Dentro del arreglo podemos indicar las opciones en este caso agregarle a la ruta 'dashboard' al incio de las rutas
// Asi tenemos las ventaja de usar rutas con nombre y solo le cambiamos aqui sin modificar la logica interna
Route::group(['prefix' => 'dashboard'], function (){
    //Route::resource('post', PostController::class);
    //Route::resource('category', CategoryController::class);

    // Con esta agrupas los controladores
    // Seria la equivalencia de la definicion de arriba pero mas reducido
    Route::resources([
        'post'=>PostController::class,
        'category'=>CategoryController::class
    ]);
});