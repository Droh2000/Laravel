<!--
    Componente Anonimo

        Podriamos haber creado una clase componente asociada a esto y los enreaizamos
        pero en este caso lo que vamos a hacer solo porque podemos es que vamos a crear
        otro controlador que solo retorne este componente

        La sintaxis de "x-app" tambien la podemos emplear en una vista devuelta por un componente 
        que seria el uso del componente internamente

    Si este componente tuviera una clase asociada podriamos hacer la operacion que metiemos en el controlador 
    Blogcontroller en la clase asociada y no tener el controlador, otro enfoque es regresar todo desde el controlador
    y solo implementar el Foreach en la vista (Asi como vimos al inicio)
-->
<div>
    <br>
    <!-- Uso de SLOT para agregar los datos pasados desde la vista, aqui no hay problema porque esta aqui
        arriba lo luego (Aqui es donde vamos a mostrar el contenido)-->
    <h1>{{ $slot }}</h1> 

    <!-- SLOT Con con Nombre tenemos que preguntar si exite o sta definida en donde se aplicara esto
        No tenemos que hacer esta logica si estamos seguros que se le pasara siempre contenido-->
    @if (isset($header))
        <h3>$header</h3>
    @endif

    <!-- Aqui se van a listar nuestros posts -->
    @foreach ($posts as $p)
        <div class="card card-white mt-2">
            <h3>{{ $p->title }}</h3>

            <a href="{{ route('blog.show', $p) }}">Ir</a>

            <p>{{ $p->description }}</p>
        </div>
    @endforeach
    <br>
    
    <!-- Otro Slot Con Nombre -->
    @isset($extra)
        <h2>$extra</h2>
    @endisset

    <!-- La paginacion -->
    {{ $posts->links() }}
</div>