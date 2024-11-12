<!-- 
    Este template se creo con Laravel Breeze
    que esta creado mediente componentes (Todo lo que inicie con X- es un componente)
    Despues del 'x-' tenemos la ruta o nombre del componente.
    En este caso no tenemos una ruta porque si no seria "RUTA.NombreComponente"
        Buscamos el archivo "app-layout"
--> 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
