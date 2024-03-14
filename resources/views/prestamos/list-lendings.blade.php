@extends('home')

@section('title', 'Préstamos')

@section('content')

    <div class="row justify-content-center m-5">
        <div class="col-6">
            <table class="table table-hover table-striped table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>LIBRO</th>
                        <th>FECHA PRÉSTAMO</th>
                        <th>FECHA DEVOLUCIÓN</th>
                        <th>¿DEVUELTO?</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @if (count($prestamos) > 0)
                        @foreach ($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->libro->titulo }}</td>
                                <td>{{ $prestamo->fecha_prestamo->format('d-m-Y') }}</td>
                                <td>{{ $prestamo->fecha_devolucion->format('d-m-Y') }}</td>
                                @if ($prestamo->devuelto)
                                    <td colspan="2">SI</td>
                                @else
                                    <td>No</td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editLending{{ $prestamo->id }}">
                                            Modificar
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#returnLending{{ $prestamo->id }}">
                                            Devolver
                                        </button>
                                        @include('prestamos.modal.action')
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <a href="{{ route('showLendingForm') }}" class="btn btn-primary">Nuevo préstamo</a>
        </div>
    </div>
    <div class="alert alert-danger" role="alert" id="infoError">
        This is a info alert—check it out!
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        infoError = document.getElementById("infoError");
        infoError.style.display = "none";
        @if ($errors->any())
            console.log("{{ $errors }}")
            infoError.style.display = "block";
            infoError.innerHTML =
                `<ul>`;

            @foreach ($errors->all() as $error)
                infoError.innerHTML +=
                    `<li>Error: {{ $error }}</li>`;
            @endforeach
            infoError.innerHTML += `</ul>`;
        @endif
    </script>
@endpush
