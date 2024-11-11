@extends('dashboard/master')

@section('content')

    @include('dashboard/fragment/errors-forms')

    <!-- 
            Habilitamos la carga de archivos le colocamos el atrbuto en el FORM
            solo aqui en Editar vamos a emplear esto
    -->
    <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')<!-- Empleamos el comportamiento de actualizacion -->
        
        <!-- Campos Reutilizables para el formulario 
            
            Aqui le vamos a pasar un PARAMETRO ADICIONAL, asi como en el controlador le pasamos valores a la vista con "COMPACT()"
            y aqui se le pasa de manera indirecta al componente del fomulario OTROS VALORES ya que al ser un componente hijo de
            esta pagina, por defecto el componente ya puede usar los datos pasados como parametro

            Entonces adicionalmente le pasamos mas datos
                task -> Seria para saber el Estado
        -->
        @include('dashboard/fragment/form', [ 'task' => 'edit'])
    </form>
@endsection