
<!-- 
        Si queremos un color de fondo perfectamente se lo podemos especificar aqui 
        pero si en donde estemos usando el componente queremos reutilizarlo pero de otro color

    Para usar la mezcla de atributos despues de la etiqueta colocamos como una impresion de Blade
    mandamos a llamar la variable $attributes y llamamos la funcion MERGE()
    dentro le especificamos los atributos que queremos mezclar (Clas, Id, Perosonalizados, Nombres)
    Entonces especificamos como clave valor, siendo los valores los atributos a tomar en cuenta y seran asignados 
    al atributo que es Class 
    Primero junta estos atributos y los asigna al componente, como segunda accion combina estos atributos
    que se le estan pasando desde donde se implementa el componente 
        (Primero Junta Atributos y Luego los Mezcla)

    Importante: Es que no hay que sobrescribir estilos osea si aqui definimos el fondo de color blanco entones no
    tiene sentido querer cambiar este estilo afuera en la implentacion porque en ocaciones no va a funcionar

    Al ser un arreglo le podemos pasar mas atirbutos por ejemplo se pone una coma y se coloca 'data-id'=>'test'
    La Mezcla de Atributos Solo funcionan para las clases
-->
<div {{$attributes->merge(['class' => 'w-full border shadow-md rounded-md p-5'])}}>
    Content {{$slot}}

    {{-- Si imprimimos la variable $attributes  veremos que obtendremos la informacion de los atributos 
        que se definan com class="..." (Ya este nos da la informacion)
        {{ $attributes }}
    --}}
</div>

<!--
        Atributos de Clase
    
    La implementacion en donde se utiliza el componente es igual solo que aqui la definicion
    es que solo es para el atirbuto Class, la ventaja de esta forma es que por ejemplo
    arriba el componente se quedaba sin un colo de fondo y era un atributo que se tenia que 
    definir a fuerza donde se usaba el componente si lo queriamos con color de fondo
    Pero aqui podemos definirle separado por coma el atributo indicandole con una condicion booleana
    para indicar si este se va o no a imprmir.

    Igual a True el atributo siempre saldra y al declararlo para que se mezclen ocurrira que se sobrescribe
    el atibuto
    Igual a False el atribuo no se activa

    Esta condicion podria ser cualquier cosa por ejemplo en donde se implementa el componente le podemos
    pasar como atributo: :bg=true y se lo podemos pasar directamente aqui (Establecer como un Valor Opcional)
    Asi como esta definida ahorita, se tendria que especificar SIEMPRE cuando se use el componente
    ya que es obligatorio

    Con este "bg" ya tenemos la logica para activar el color de fondo al componente o No, en caso que si ya no tendriamos
    porque definirle otro color de fondo cuando se utiliza el componente y si es False entonces tenemos que definirlo


-->
<div {{$attributes->class(['w-full border shadow-md rounded-md p-5', 'bg-white'=>$bg])}}>
    Content {{$slot}}
</div>

<!-- 
        Uso de los Props

    Si al componente le especificamos otra clase de atributos como "title="titulo"" esto en la definicion
    del componente, aparte de que dentro del componente lo podemos acceder directamene mandandolo a llamar
    como $title, tambien podemos ver que por medio de la variable $attribute->title
    (Todos los atributos que le especifiquemos a un componente se almacenaran en la variable $attribbute)

    El SLOT no es un atributo porque se definen por nombre o por defecto pasandole como contenido al componente

    Los PROPS son otra forma que tenemos para compartir los datos
    Supongamos que queremos definir el tipo pasandolo todo en un array de clave valor donde le definimos el valor
    por defecto (Dentro de los PROPS tenemos que definir todos los atributos que le tengamos definidos o pasando al componente)

    Al momento de declara los PROPS todo se va hacia otra parte que no es la variable $attribute
    (Esta en otro tipo de almacenamiento)
    Lo interesante aqui es que aparte que se almacenan en otra parte es que les podemos dar valores por defecto a los
    atributos
        Por ejemplo antes le teniamos que especificar a fuerzas un valor a $bg cuando usabamos el componente
        (esto era obligatorio por cada uso del componente) pero ahora le podemos dar una valro por defecto
        y ya no se requiere especificar a fuerzas el atributo en el componente
-->
@props(["type"=>"info","bg"=>true,"title"=>"Title" ])
<div {{$attributes->class(['w-full border shadow-md rounded-md p-5', 'bg-white'=>$bg])}}>
    Content {{$slot}}
    {{$type}}
    {{$attributes}}<!-- Esta ya no sale por los PROPS -->

    <!-- Obtener y Filtrar Atributos 
        Estos metodos no sirven para los atrobutos que declaramos dnetro del PROPS
        tienen que ser declarados de forma normal (Atributos pasados desde donde se implementa el componente)
    -->
    {{ $attributes -> whereStartsWith('wire:model') }}
    {{ $attributes -> whereDoesntStartsWith('wire:model') }}

    @if($attributes -> has('class'))
        <div>El atributo class esta presente</div>
    @endif
    @if ($attributes -> has(['bf','class']))
        <div>Todos los atributos estan presente</div>
    @endif
    @if ($attributes -> hasAny(['href',':href','v-bind:href']))
        <div>Algunos de los atributos estan presente</div>
    @endif
    <!-- Asi obtenemos el valor del atributo -->
    {{ $attributes->get('class') }}
</div>