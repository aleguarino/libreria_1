<!-- DEVOLVER -->
<div class="modal fade" id="returnLending{{ $prestamo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('returnLending') }}" method="POST">
                @csrf
                <input type="text" name="id" value="{{ $prestamo->id }}" hidden>
                <div class="modal-body">
                    ¿Está seguro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Si</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- EDITAR -->
<div class="modal fade" id="editLending{{ $prestamo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar préstamo de {{ $prestamo->libro->titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editLending') }}" method="POST" class="form">
                    @csrf
                    <input type="text" name="id" value="{{ $prestamo->id }}" hidden>
                    <div class="mb-3">
                        <label for="returnDate" class="form-label">Fecha de préstamo</label>
                        <input type="date" name="lendingDate" id="lendingDate" class="form-control"
                            value="{{ $prestamo->fecha_prestamo->format('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="returnDate" class="form-label">Fecha de devolución</label>
                        <input type="date" name="returnDate" id="returnDate" class="form-control"
                            value="{{ $prestamo->fecha_devolucion->format('Y-m-d') }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
