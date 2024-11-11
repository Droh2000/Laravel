@extends('dashboard/master')

@section('content')

    @include('dashboard/fragment/errors-forms')

    <form action="{{ route('category.update', $category->id) }}" method="post">
        @method('PUT')
        @include('dashboard/fragment/category-form')
    </form>

@endsection