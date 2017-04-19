@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')

    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h1>Add a new book</h1>

    <form method='POST' action='/books/new'>
        {{ csrf_field() }}

        <label for='title'>Title</label>
        <input type='text' name='title' id='title' value='{{ old('title') }}'>
        <input type='submit' value='Add book'>
    </form>

@endsection
