@extends('home')

@section('title', 'Nuevo préstamo')

@section('css')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection

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
        <h2 class="mt-5 mb-3">Nuevo préstamo</h2>
        <form action="{{ route('addLending') }}" method="POST" class="form">
            @csrf
            @include('components.books-select')
            <div class="mb-3">
                <label for="returnDate" class="form-label">Fecha de préstamo</label>
                <input type="date" name="lendingDate" id="lendingDate" class="form-control"
                    value="{{ old('lendingDate') }}">
            </div>
            <div class="mb-3">
                <label for="returnDate" class="form-label">Fecha de devolución</label>
                <input type="date" name="returnDate" id="returnDate" class="form-control"
                    value="{{ old('returnDate') }}">
            </div>
            <input type="submit" value="Crear" class="btn btn-primary">
        </form>
    </div>
@endsection
