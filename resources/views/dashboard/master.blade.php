<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout</title>
</head>
<body>
    <header>
        <!-- 
                Implementacion de los mensajes para indidcar al usuario que la accion se realizo correctamente
            El 'status' es porque es la Clave indicada en el controlador para acceder a este mensaje
        -->
        @if (session('status'))
            {{session('status')}}   
        @endif
        <!-- 
            Tambien se puede declarar de la siguiente forma
        -->
        {{--@session('status')
                <h1>{{$value}}</h1>
        @endsession--}}

        <!-- Estas dos formas aplican tanto para los mensajes de tipo Flash como de Session -->
        
    </header>

    <!-- Vista Maestra configuraando el formato que debe de seguri 
        No tiene el contenido a mostrar al usuario pero si tiene la estructura que se debe de seguir
        Con esto podemos cambiar algo aqui y automaticamente se cambia en todas las pagina que usen esta vista
    -->
    @yield('content')

    <section>
        @yield('morecontent')
    </section>
    
</body>
</html>