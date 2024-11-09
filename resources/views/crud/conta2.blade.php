<!-- Uso de la vista maestra 
    Exportamos y le damos el nombre del archivo

    Con esto ya tenemos el esqueleto del HTML
-->
@extends('master')

<!-- Le agreamos el contenido a la Vista -->
@section('content')<!-- ESpecificamos el nombre donde lo queremos colocar -->
    <p>Contenido Agregado</p>
@endsection

@section('morecontent')
    <p>Mas Contenido</p>
@endsection