<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserAccessDashboardMiddleware; // Importamos el Middleware
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Despues de implementar Laravel Breeze tenemos una ruta con el Middleware doonde debe estar autenticado y verificado
// este es el equema que debemos de seguir para proteger las rutas
//Route::get('/dashboard', function () {
//    return view('dashboard'); // Aqui estamos resolviendo la ruta de dashboard
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Estas son nuestras rutas originales y vamos a protegerlas con autenticacion
// Le agregamos el Middleware que es e intermedario que se encarga de verificar si el usuario esta autenticado para que puede acceder a la ruta
// Request(Peticion del Usuario) -> Middleware -> Respuesta
// Aqui al especificar middleware => auth ya estamos usando el middleware (Esta entre una lista pra pasarle diferentes valores)

// auth -> Es para saber si el usario esta autenticado
// verified -> Para saber si el usuario es verificado (Se puede colocar los dos )
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserAccessDashboardMiddleware::class]], function() {
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class
    ]);
    // Aqui tambien podriamos pasar la ruta de Dashboard paa proteger esta ruta
    Route::get('', function () {
        return view('dashboard'); // Aqui estamos resolviendo la ruta de dashboard
    })->middleware(['auth' ])->name('dashboard');
});

require __DIR__.'/auth.php';
