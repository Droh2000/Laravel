@extends('dashboard/master')

@section('content')
    <a href="{{ route('post.create') }}" target="blank">Crear Post</a>

    <!-- De los posts solo vamos a mostrar titulo pero no el contenido porque es mucho dato 
    
        En la tabla podemos agregar las opciones CRUD al lado del registro o mas opciones
        Por eso se agrega la columna de las opciones
    -->
    <table>
        <thead>
            <tr>
                <td>
                    Id
                </td>
                <td>
                    Title
                </td> 
                <td>
                    Posted
                </td> 
                <td>
                    Category
                </td> 
                <td>
                    Options
                </td>
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
                        <a href="{{ route('post.show', $post->id) }}">Mostrar</a>
                        <a href="{{ route('post.edit', $post->id) }}">Editar</a>
                        <!-- Para el de eliminar tenemos que hacerlo de otra forma porque asi no va funcion, se tiene que hacer por
                             que es con un formulario porque no es una peticion de tipo GET-->
                        <form action="{{route('post.destroy',$post->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit">Eliminar</button>
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
    {{ $posts -> links() }}
@endsection