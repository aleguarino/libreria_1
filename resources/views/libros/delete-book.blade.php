@extends('home')

@section('title', 'Borrar libro')

@section('css')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h2 class="mt-5 mb-3">¿Desea borrar el libro {{ $libro->titulo }}?</h2>
        <form action="{{ route('deleteBook') }}" method="POST" class="form">
            @csrf
            <input type="text" name="id" id="id" value="{{ $libro->id }}" hidden>
            <input type="submit" name="delete" value="Borrar" class="btn btn-danger">
            <input type="submit" name="cancel" value="Cancelar" class="btn btn-secondary">
        </form>
    </div>
@endsection
