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
        Header
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