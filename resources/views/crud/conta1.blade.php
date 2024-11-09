<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta 1</title>
</head>
<body>
    <h1>{{$edad}}</h1>

    <!-- Directivas en Blade -->
    @if($name == "Jose")
        <p>Hola Jose</p>
    @endif
   
    @if ($name != "Jose")
        <p>No eres jose</p>
    @else
        <p>{{$name}}</p>
    @endif
    <!-- Sniper: bi: para autocompletar-->

    <ul>
        @foreach ([1,2,3,4,5,6] as $item)
           <li>{{ $item }}</li> <!-- Para solo Imprimir -->
        @endforeach
    </ul>

</body>
</html>

