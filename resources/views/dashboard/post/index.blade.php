@extends('dashboard/master')

@section('content')
    <a class="btn btn-primary my-3" href="{{ route('post.create') }}" target="blank">Crear Post</a>

    <!-- De los posts solo vamos a mostrar titulo pero no el contenido porque es mucho dato 
    
        En la tabla podemos agregar las opciones CRUD al lado del registro o mas opciones
        Por eso se agrega la columna de las opciones
    -->
    <table class="table">
        <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Title
                </th> 
                <th>
                    Posted
                </th> 
                <th>
                    Category
                </th> 
                <th>
                    Options
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        {{$post->id}}
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        {{$post->posted}}
                    </td>
                    <td>
                        <!-- Por la relacion que implementamos en el modelo nos sale por defecto toda la informacion de la
                            categoria, asi que solo obtenemos el campo que nos interesa -->
                        {{$post->category->title}}
                    </td>
                    <td>
                        <a class="btn btn-succes mt-2" href="{{ route('post.show', $post->id) }}">Mostrar</a>
                        <a class="btn btn-succes mt-2" href="{{ route('post.edit', $post->id) }}">Editar</a>
                        <!-- Para el de eliminar tenemos que hacerlo de otra forma porque asi no va funcion, se tiene que hacer por
                             que es con un formulario porque no es una peticion de tipo GET-->
                        <form action="{{route('post.destroy',$post->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 
        PARA LA PAGINACION

        Ya implementada en el controlador con esto creamos la forma de navegar entre paginas
        Este componente por defecto usa clases de CSS Tawing
    -->
    <div class="mt-2">
        {{ $posts -> links() }}
    </div>
@endsection