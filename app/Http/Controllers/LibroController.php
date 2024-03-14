<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    protected $libro;

    public function __construct(Libro $libro)
    {
        $this->libro = $libro;
    }

    public function showAddForm()
    {
        return view('libros.add-book');
    }

    public function showUpdateForm($id)
    {
        return view('libros.update-book', ['libro' => $this->libro->getBookById($id)]);
    }

    public function showDeleteDialog($id)
    {
        return view('libros.delete-book', ['libro' => $this->libro->getBookById($id)]);
    }

    // Añade un nuevo libro, recibe los valores del formulario a través de Request y los valida
    public function addBook(Request $req)
    {
        $messages = [
            'required' => 'Debe rellenar el campo :attribute.',
            'numeric' => 'Debe introducir un año válido.',
            'lt'    => 'El año debe ser menor que el año actual.',
        ];

        $validatedData = $req->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'genre' => 'required|string',
            'publicDate' => 'required|numeric|lt:' . date('Y'),
        ], $messages);

        $title = $validatedData['title'];
        $author = $validatedData['author'];
        $genre = $validatedData['genre'];
        $publicDate = $validatedData['publicDate'];
        $this->libro->addBook($title, $author, $genre, $publicDate);
        return redirect()->route('listBooks');
    }

    // Actualiza un libro
    public function updateBook(Request $req)
    {
        $id = $req->input('id');
        $title = $req->input('title');
        $author = $req->input('author');
        $genre = $req->input('genre');
        $publicDate = $req->input('publicDate');
        $this->libro->updateBook($id, $title, $author, $genre, $publicDate);
        return redirect()->route('listBooks');
    }

    // Borra un libro
    public function deleteBook(Request $req)
    {
        if (isset($_POST['delete'])) {
            $id = $req->input('id');
            $this->libro->deleteBook($id);
        }
        return redirect()->route('listBooks');
    }

    // Muestra todos los libros
    public function showBooks()
    {
        $libros = $this->libro->getAllBooks();
        return view('libros.list-books', ['libros' => $libros]);
    }

    // Devuelve los libros que estén disponibles para su préstamo
    public static function getAvailableBooks()
    {
        return Libro::getAllBooks()->where('disponible', '=', true);
    }
}
