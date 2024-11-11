@extends('dashboard.master') 

@section('content')

    <!-- Importamos el componente para activar los Errores a la vista -->
    @include('dashboard/fragment/errors-forms')

    <!-- Hay una relacion con el Formulario el modelo y la tabla creada en la migracion 
        Para enviar se le ponde la ruta absoluta "/post/" o con el nombre que ya tenemos en la ruta de tipo resources
        los nombres los vemos con el comando "php artisan r:l" siendo "post.create, post.store, etc" 
    
        Aqui referenciamos la ruta con el nombre que con esta funcion nos regresa la ruta asociada al nombre-->
    <form action="{{ route('post.store') }}" method="post">
        <!-- Campos Reutilizables para el formulario -->
        @include('dashboard/fragment/form');
    </form>
@endsection