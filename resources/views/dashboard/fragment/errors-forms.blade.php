<!-- Ya automaticamente si tenemos errores se hace una redireccion que se hace para poder mostrar los errores
        donde de forma automatica laravel tiene una variable para acceder a los errores
        Solo se manda a llamar la variable (Se puede hacer tambien campo por campo)

        Estos errores se pueden implementar como un componente para ser reutilizado
        Seris solo esta parte del fragmento y no con todo el codigo HTML

        Verificamos primero si hay errores
    -->
    @if ($errors -> any())
        <!-- Accedemos al error y lo imprimimos -->
        <ul>
            @foreach ($errors->all() as $e)
                <li>
                    {{ $e }}
                </li>
            @endforeach
        </ul>
    @endif
    <!-- 
        Los errores tambien se pueden poner desde el controlar si tenemos el esquema de validacion Request
        con la variable $validate tenemos acceso a los errores
    -->