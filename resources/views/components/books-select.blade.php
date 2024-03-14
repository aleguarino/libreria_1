@php
    $libros = App\Http\Controllers\LibroController::getAvailableBooks();
@endphp
<div class="mb-3">
    <select name="book" id="book" class="form-select">
        @foreach ($libros as $libro)
            <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
        @endforeach
    </select>
</div>
