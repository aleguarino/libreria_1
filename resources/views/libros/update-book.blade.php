@extends('home')

@section('title', 'Actualizar libro')

@section('css')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-5 mb-3">Actualizar libro</h2>
        <form action="{{ route('updateBook') }}" method="POST" class="form">
            @csrf
            <input type="text" name="id" id="id" class="form-control" value="{{ $libro->id }}" hidden>
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $libro->titulo }}">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ $libro->autor }}">
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genero</label>
                <input type="text" name="genre" id="genre" class="form-control" value="{{ $libro->genero }}">
            </div>
            <div class="mb-3">
                <label for="publicDate" class="form-label">Año de publicación</label>
                <input type="text" name="publicDate" id="publicDate" class="form-control"
                    value="{{ $libro->año_publicacion }}">
            </div>
            <input type="submit" value="Actualizar" class="btn btn-primary">
        </form>
    </div>
@endsection
