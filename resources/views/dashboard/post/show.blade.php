@extends('dashboard/master')

@section('content')
    <h1>{{$post->title}}</h1>

    <span>{{ $post->posted }}</span>
    <span>{{ $post->category->title }}</span>

    <div>
        {{$post->description}}
    </div>

    <div>
        {{ $post->content }}
    </div>

    <!-- Para mostrar la imagen nos debemos de poner la carpeta Public en la ruta esta ya se pone sola 
        Quedando la ruta como: /uploads/postss/NombreImagen.extencion

        alt es para agregarle descripcion
    -->
    <img src="/uploads/posts/{{ $post->image }}" alt="{{ $post->title}}" style="width:250px">
    {{$post->image}}
@endsection