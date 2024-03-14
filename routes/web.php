<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

############## LIBROS ################
// Página de inicio, por defecto muestra el listado de los libros
Route::get('/', [LibroController::class, 'showBooks'])->name('listBooks');

// Muestra el formulario para añadir un libro
Route::get('/libros/nuevo', [LibroController::class, 'showAddForm'])->name('addBookForm');

// Muestra el formulario para actualizar el libro seleccionado con su ID
Route::get('/actualizar-libro/{id}', [LibroController::class, 'showUpdateForm']);
// Muestra el formulario para borrar el libro seleccionado por su ID
Route::get('/borrar-libro/{id}', [LibroController::class, 'showDeleteDialog']);

// ->name() le asigna un nombre a la ruta para ser llamado por ejemplo en el formulario a través del parámetro action
// Rutas que son lanzadas al enviar los distintos formularios de creación, edición y borrado de los libros
Route::post('/addBookPost', [LibroController::class, 'addBook'])->name('addBook');
Route::post('/updateBookPost', [LibroController::class, 'updateBook'])->name('updateBook');
Route::post('/deleteBookPost', [LibroController::class, 'deleteBook'])->name('deleteBook');

############# PRESTAMOS #################
Route::get('/prestamos', [PrestamoController::class, 'showLendings'])->name('listLendings');
Route::get('/prestamos/nuevo', [PrestamoController::class, 'showAddForm'])->name('showLendingForm');

Route::post('/addLending', [PrestamoController::class, 'add'])->name('addLending');
Route::post('/returnLending', [PrestamoController::class, 'returnLending'])->name('returnLending');
Route::post('/editLending', [PrestamoController::class, 'editLending'])->name('editLending');
