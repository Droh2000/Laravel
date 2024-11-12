<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccessDashboardMiddleware
{
    // Este metodo se encarga de maejar la Peticion
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Con next aprovamos la peticion pero si hacemos otra cosa como una redireccion entonces significa que lo estamos rebotando
        // Podemos redireccionar a otra pagina donde indiquemos al usuario que no tien Acceso a tal ruta

        // Verificamos si el usario es Admin
        // Para obtener el usuario autenticado con Auth::user() donde podemos preguntar el tipo de Rol
        /*if(Auth::user()->rol == 'admin'){
            return $next($request);
        }*/

        // Una forma mas correcta es crear esto en el modelo del User
        // con un metodo el cual se encarge de hacer esa verificacion por nosotros
        // No importa que salga que de Error porque si va a funcionar
        // Ese es un Facades y todos tienen su equivalente a funciones: auth()->user()
        if(Auth::user()->isAdmin()){
            return $next($request);
        }

        return redirect('/');
    }
}
