@extends('dashboard/master')

@section('content')
    <a href="{{ route('category.create') }}" target="blank">Create Category</a>

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
                    Slug
                </td>
                <td>
                    Options
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        {{$category->id}}
                    </td>
                    <td>
                        {{$category->title}}
                    </td>
                    <td>
                        {{$category->slug}}
                    </td>
                    <td>
                        <a href="{{route('category.show',$category->id)}}">Mostrar</a>
                        <a href="{{route('category.edit',$category->id)}}">Editar</a>
                        <form action="{{route('category.destroy',$category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Paginacion -->
    {{$categories->links()}}
@endsection