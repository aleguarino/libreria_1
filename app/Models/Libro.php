<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';

    // Devuelve todos los libros
    public static function getAllBooks()
    {
        return Libro::all();
    }

    // Devuelve un libro por ID
    public static function getBookById($id)
    {
        return Libro::find($id);
    }

    // Devuelve los libros según el título **NO USADO EN ESTA VERSION
    public static function getBookByTitle($title)
    {
        return Libro::where('titulo', '=', $title)->get();
    }

    // Añade un libro
    public function addBook($title, $author, $genre, $publicDate)
    {
        $libro = new Libro();
        $libro->titulo = $title;
        $libro->autor = $author;
        $libro->genero = $genre;
        $libro->año_publicacion = $publicDate;
        $libro->save();
    }

    // Actualiza un libro
    public function updateBook($id, $title, $author, $genre, $publicDate)
    {
        $libro = Libro::find($id);
        if (!isset($libro))
            return "No existe ese ID";
        $libro->titulo = $title;
        $libro->autor = $author;
        $libro->genero = $genre;
        $libro->año_publicacion = $publicDate;
        $libro->save();
    }

    // Borra un libro
    public function deleteBook($id)
    {
        $libro = Libro::find($id);
        if (!isset($libro))
            return "No existe ese ID";
        $libro->delete();
    }

    // Devuelve todos los préstamos que se hayan realizado de un libro
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
