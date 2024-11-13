<?php

namespace App\View\Components\blog;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{

    // Esto es para Ocultar Atributos o Metodos que esepcifiquemos dentro del array
    // (Estos ya no podran ser pasados o especificados desde donde se implementa el componente ya que no queremos que sea publicos)
    // Hay que asegurarnos que el componente si este bien conectado con su Clase porque sino sera
    // tratado como un componente huerfano y lo que implementemos en la clase no servira de nada 
    // (Para asegurarnos esto hay que revisar la ruta en la funcion Render que coincida)
    // Tambien le podemos pasar el nombre de una funcion definida Aqui
    // Igual para no hacer esto se puede hacer con solo poner PROTECTED al atributo y metodo que no queramo exponer
    protected $except = ['post'];

    // Aqui se declara lo que recibe el componente
    //public $post;

    // los que se le pase al componente en donde se use(HTML), en el constructor es donde se recibe
    // Podemos declarar de esta forma para no tener que escribir la propiedad como arriba
    public function __construct(public Post $post)
    {
        // Verificamos que se esten recibiendo los datos
        //dd($post);
        // Aqui y en la clase en general podemos implementar cualquier logica como un acceso a la BD

    }

    // Logica que vamos a implementar en este caso
    public function changeTitle()
    {
        $this->post->title = "New Title";
        
        // Asi podemos mandar a imprimir un resultado directamentee
        //return "texto";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Para usar post fuera del contructor lo referenciamos con el this
        // $this->post
        // Aqui podemos aprovechar para pasarle parametros a la vista en caso que sea necesario
        return view('components.blog.show');
    }
}
