<!-- 
    Copiamos el mismo contenido del Componente sin clase que ya habiamos creado
    
    IMPORTANTE
        La comunicacion funciona porque el componente esta en la rtua por defecto de blog.show.blade.php
        y la clase esta en la ruta View/Components/blog/show.php
    
    Como considernacia el codigo del componente lo debemos de tener lo mas sencillo posible
    es decir evitar cualquier tipo de logica y la logica se debe implementar en la clase y sus metodos
    En la clase del componente se invocan metodos para cuando tengamos proceso complejos como conexiones
    a una base de datos y solo lo imprimimos en la vista como una variable
-->
<div class="card card-white">
    <!--
        Para implementar este metodo (Funciones de clase)
        Aqui nosotros solo estamos empleando el compenente en "show.blade.php"
        Solo lo que tenemos que hacer llamando a la funcion con un simbolo de dolar como
        si fuera una variable
    -->
    {{ $changeTitle() }}<!-- Primero cambiamos el titulo con la funcion y luego lo imprimimos abajo -->
    <h1>{{$post->title}}</h1>
    <span>{{$post->category->title}}</span>
    <hr>
    <!--
        Este es otro tipo de atrbutos que podemos recibir al declarar el componente
    -->
    {{$title}}
    {{$post->content}}

    <!-- 
        En este caso vamos a buscar usando la funcion Filter pero a esta le vamos a pasar una funcion 
        Flecha (Resordemos que un atirbuto tiene se Valor y su Key)
        Para indicar que vamos a implementar una funcion Flecha indicados:
            fn(Valor, Clave) => { ... } -> En este caso estamos buscando el atributo "data-id"
    -->
    {{ $attributes->filter((fn(string $value, string $key) => $key == 'data-id')) }}
</div>