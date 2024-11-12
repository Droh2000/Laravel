@extends('dashboard/master')

@section('content')
    <a class="btn btn-primary my-3" href="{{ route('category.create') }}" target="blank">Create Category</a>

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
                    Slug
                </th>
                <th>
                    Options
                </th>
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
                        <a class="btn btn-success mt-2" href="{{route('category.show',$category->id)}}">Mostrar</a>
                        <a class="btn btn-success mt-2" href="{{route('category.edit',$category->id)}}">Editar</a>
                        <form action="{{route('category.destroy',$category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Paginacion -->
    <div class="mt-2">
        {{$categories->links()}}
    </div>
@endsection