<?php

use App\Http\Controllers\PrimerControlador;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Snipe: RouteGet
Route::get('/test', function () {
    //return "Hola Mundo"; -> Retorna el texto directamente a la pagina
    return view('test');
});

// Pasarle datos a la pagina
Route::get('/crudy', function () {
    // Array porque estamos pasando un conjunto de datos
    // Con clave y valor
    $age = 33;
    $data = ['name' => 'Andres', 'age' => $age];

    return view('/crud/index', $data);// Solo especificamos la ruta de las carpetas
// Dar nombre a la ruta para no tener problemas con la navegacion entre paginas
// esto es interno, la URL de arriba si se expone al cliente pero este nombre NO
}) -> name("crud");

/*Route::get('/conta1', function () {
    $edad = ['edad' => 15];
    return view('/crud/conta1', $edad);

    // Redireccion a otra pagina
    //      return redirect('/conta2');// Al recargar la pagina nos mandara a conta2

    // Lo mejor es usar las rutas con nombre
    //      return redirect()->route('contados');

    // Otra forma igual de redireccionar
    //      return to_route('contados');
     
}); Ctrl+Shift+FlechaAbajo Para duplicar el mismo codigo*/

// Seleccionamos una palabara y  Ctrl+D para modificar todas sus referencias por un nuevo nombre
Route::get('/conta2', function () {
    $name = ["name" => "Jose"];
    return view('/crud/conta2', $name);
})->name('contados'); // Podemos redireccion tanto con la Uri como con el Nombre 

// No es recomendable poner codigo de programacion aqui para eso se usan los controladores
// La logica que implica muchas funciones es mejor crear componentes apartes
// Se puede crear el controlador con artisan y ademas junto al modelo

// Creamos la Ruta para el controlador
// 'NombreURL', NombreControlador::class, NombreMetodo
Route::get('conta1', [PrimerControlador::class, 'index']);

// En una aplicacion real tendriamos muchas rutas para un solo recurso
// todos estos recurson serian Get, Put, Delete, La acciones en la pagina
// esto nos va a hacer crecer mucho el numero de rutas cosa que al final no es practico
// Laravel nos facilita este proceso para no crear un monton de Routes para cada recurso
// podemos emplear una ruta de tipo Recurso (Este ya nos dara los nombre de las rutas)

// En este caso la ruta se llama 'post' (De este nombre toma para crear la URI principal)
// Esto ya nos gerera las routas para cada uno de los metodos que tenga definido el controlador
//              Route::resource('post', PrimerControlador::class);
// Para ver las rutas definidas en el proyecto: 
//      php artisan router:list

// Parametros en las Rutas
// entre llaves le ponemos cualquier nombre valido,(Con ? (post?) indicamos que el parametro es opcional)
// El opcional normalmente se pone al utimo para no complicarnos y evitarnos errores
Route::get('test/{post}/{otro?}', [PrimerControlador::class, 'parametro']);