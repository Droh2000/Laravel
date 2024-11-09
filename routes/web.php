<?php

use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Generamos varias rutas porque ya tenemos todas las funciones en el controlador
Route::resource('post', PostController::class);