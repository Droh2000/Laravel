<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Esta es para la peticion del usuario

class PrimerControlador extends Controller
{
    // Creamos propieades o metodos
    // Con esto podemos agrupar por funcionalidades, asi tenemos una funcion por cada accion
    // y solo se llama en las Rutas el controlador y la funcion a ejecutar
    function index(){
        // Hacemos la misma logica de retornar a una vista
        //          return view('/crud/conta1', ['edad'=>18, 'name'=>'Jose']);

        // Simplicar el Proceso de pasar parametos a la Pagina como arriba con el arreglo
        // Supongamos que nos conectamos a la BD y obtenemos esto en $posts
        $posts = ['post1', 'post2'];
        //          return view('/crud/conta', ['posts'=>$posts]);
        
        // Lo de arriba lo podemos simplificar ya que si tenemos muchos argumento esto va a crecer mucho
        // para esto usamos la funcin COMPACT
        // Como tenemos el nombre $posts que le dimos para identificarlo dentro del array como 'posts' se puede simplificar
        // (Es comun siempre ponerle el mismo nombre Key => Value)
        // compact -> lo que hace es que el string que le pasemos le asigna ese nombre al array y con eso crea auotamticamente las variable para el template
        return view('/crud/conta', compact('posts'));
        // Asi reducimos lo siguiente:
        // compact('posts', 'categoria') =>  ['posts'=>$posts, 'categoria'=>$categoria]
    }

    // Indicamos que recibimos el parametro de la URL (Le colocamos el mismo nombre en el parametro de la funcion)
    function parametro($post, $otro = 0){// por defecto lo que se le mande lo recibe como un String
        echo $post;
        echo $otro;// Al opcion le asignamos un valor por defecto cuando no se reciba de la URL
    }

}
