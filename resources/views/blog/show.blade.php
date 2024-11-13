@extends('blog.master')

@section('content')
    <!-- 
        Aqui vamos a mostrar el contenido del Post que vamos a recibir
        En este caso no decidimos usar el componente
    -->
    {{--<div class="card card-white">
        <h1>{{$post->title}}</h1>
        <span>{{$post->category->title}}</span>

        <hr>
        {{$post->content}}
    </div>--}}
    <!-- 
        Lo de arriba lo comentamos porque sino vamos a emplear un esqueda adicional al de listado
        Asi que pasamos el COMPONENTE DE CLASE que creamos
        y le pasamos la variable que esta esperando
        (Se declara al inicio con dos puntos porque tiene que evlauar el resultado que se le pasa)
    -->
    {{--<x-blog.show :post="$post">
    </x-blog.show>--}}

    {{-- 
            Pasar Atributos a los Componentes 

        Tenemos varios esquemas para trabajar con los atributos, de momento el de :post="$post"
        es para poder pasar datos desde el controlador al componente o desde el componente al controlador
        en pocas palabras para que el componente pueda tener los datos (Esto son datos para manipular dentro 
        del componente, No son como los atributos HTML)
        (:post es porque asi se llama la variable dentro del componente y "$post" es el objeto que se va a manipular)

        La otra forma de los atoributos es pasarle un valor fijo
        Por ejemplo un texto:
            title
        Asi este parametro lo podemos emplear dentro del componente en cualquier parte
        Estos son importante cuando implementemos el MERGE(), Filtrarlos, Hacer otras operaciones
        donde podemos combinar cualquier atributo que colocamos en nuestros elementos HTML
        o componentes
    --}}
    <!-- Si no se le pasa nigun SLOT al componente lo podemos declara asi -->
    <x-blog.show :post="$post" title="Titulo"/>

    <!-- 
            Atributos Merge

        Se le pasa el :bg por la condicion del atributo de Clase que utiliza la condicion
    -->
    <x-card class="bg-yellow-200" :bg="true">
        Contenido por SLOT
    </x-card>
    <!-- 
        Si queremos reutilar este componente pero con otro color de fondo
        y lo definimos aqui directamente NO nos lo tomara en cuenta el atributo

        Para que se tome en cuenta dentro del componente se deefinio el Merge 
    -->
    <x-card class="bg-white" :bg="false">
        Contenido por SLOT
    </x-card>

    <!-- 
        Ejemplo usado para sacar los atributos con una funcion Flecha
    -->
    <x-blog.show :post="$post" data-id="1" class="demo"/>

    <!-- 
        Componente Dinamico

        Cargamos el componente Dinamico que ya nos proporciona Laravel
        el atributo "componente" podriamos pasarle una expreccion que queremos evaluar
        pero de manera facil se indica el nombre del componente que ya creamos
        Despues de esto tenemos que declarle los atributos o variables que requere el componente que creamos

        Con este podemos emplear condiciona evaluar para cargar ciertas cosas u otras
    -->
    <x-dynamic-component component="blog.show" :post="$post" />

@endsection