<!-- 
        USamos la palnitlla master que creamos combinando el YIELD y 
        el uso de los componentes
-->
@extends('blog.master')

@section('content')
    <!-- Aqui vamos a mostrar el COMPONENTE de listado 
        
        Para indicar que es un componente indicamos "x-" seguido del nombre del componente
        no es solo el nombre sino tambien la ubicacion
        (Cuando no veamos la respuesta del componente lo mas seguro es que tangamos un error en la definicion del mismo)

        Para pasarle los datos de la variable que espera es: dos puntos con el nombre de la variable
        igualado al valor

        En el medio de las etiquetas le pasamos el SLOT (Lo configuramos para mostrar el titulo del Blog)
    -->
    <x-blog.post.index :posts="$posts">
        Post List
        <!-- Uso del Slot con Nombre (No importa el orden en que se declaren) -->
        @slot('header')
            Slot Con Nombre 1
        @endslot

        <!-- Declarar como Slot con Nombre en una Sola Linea
            Donde indicamos su nombre y ademas indicamos su contenido en una sola linea
        -->
        @slot('extra', "Contenido")

    </x-blog.post.index>

@endsection