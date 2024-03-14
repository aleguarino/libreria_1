@extends('home')

@section('title', 'Añadir libro')



@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h2 class="mt-5 mb-3">Nuevo libro</h2>
        <form action="{{ route('addBook') }}" method="POST" class="form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}">
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genero</label>
                <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}">
            </div>
            <div class="mb-3">
                <label for="publicDate" class="form-label">Año de publicación</label>
                <input type="text" name="publicDate" id="publicDate" class="form-control"
                    value="{{ old('publicDate') }}">
            </div>
            <input type="submit" class="btn btn-primary" value="Añadir">
        </form>
    </div>
@endsection
