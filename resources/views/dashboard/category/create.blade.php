@extends('dashboard/master')

@section('content')

    @include('dashboard/fragment/errors-forms')

    <form action="{{ route('category.store') }}" method="post">
        @include('dashboard/fragment/category-form')
    </form>

@endsection