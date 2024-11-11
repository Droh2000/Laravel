@extends('dashboard/master')

@section('content')
    <h1>{{$category->title}}</h1>

    <p>{{ $category->slug }}</p>
@endsection