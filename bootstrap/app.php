<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Capturamos las excepciones que nos regrese los Endpoints
        // Aqui en la funcion recibimos la excepcion
        // Tenemos que tipificar la excepcion (Para esto debemos de saber que es lo que esta ocurriendo)
        // Al ejecutar el Endpoint donde puede ocurrir si no encuentra el dato veremos en la respuesta JSON que es un NotFoundHTTPException
        // El problema con esto es que esto lo estamos regresando para toda la aplicacion (cada vez que haga un error de este tipo)
        // Nosotros tenemos que pode detectar cuando es una peticion donde queremos que regrese el resutlado como lo veamos
        // o queremos emplear este esquema de error (Esto es con el tipo de dato que esta esperando donde se implementa la API)

        // Es decir aqui requerimos recibir el Request para obtener la informacion ya que con la excepcion no la podemos tener
        // asi que como siguiente parametro para la funcion es que recibamos el Request
        $exceptions->render(function(NotFoundHttpException $e, $request){
            //dd($e); -> Para verificar que si entra a esta funcion

            // Gracias al request es que tenemos acceso a varios metodos
            // wantsJson() -> Este es un metodo que retorna un booleano que indica si se espera una respuesta de tipo JSON
            // Otra funcion equivalente seria:
            // expectsJson()

            // Ahora gracias al condicional podemos verificar que si espera recibir una JSON muestre el error que configuramos
            // sino que muestre el contenido como siempre
            if($request->expectsJson()){
                // Aqui siempre vamos a retornar un JSON
                return response()->json('Not Found',404);
            }

            // Si tenemos otro tipo de excepcion diferente a esta, solo tenemos que detectar el tipo de clase que es de esa excepcion
            // y solo nos creamos otro metodo igual con la variable "$exceptions"
            
        });
    })->create();
