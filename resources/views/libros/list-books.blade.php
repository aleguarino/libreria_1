@extends('home')

@section('title', 'Libros')

@section('content')

    <div class="row justify-content-center m-5">
        <div class="col-6">
            <table class="table table-hover table-striped table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>TÍTULO</th>
                        <th>AUTOR</th>
                        <th>GÉNERO</th>
                        <th>AÑO</th>
                        <th>DISPONIBLE</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @if (count($libros) > 0)
                        @foreach ($libros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td>{{ $libro->genero }}</td>
                                <td>{{ $libro->año_publicacion }}</td>
                                @if ($libro->disponible)
                                    <td>Si</td>
                                @else
                                    <td>No</td>
                                @endif
                                <td>
                                    <a href="/actualizar-libro/{{ $libro->id }}">
                                        <img src="{{ asset('images/edit.png') }}">
                                    </a>
                                </td>
                                <td>
                                    <a href="/borrar-libro/{{ $libro->id }}">
                                        <img src="{{ asset('images/delete.png') }}">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <a href="{{ route('addBookForm') }}" class="btn btn-primary">Nuevo libro</a>
        </div>
    </div>

@endsection
