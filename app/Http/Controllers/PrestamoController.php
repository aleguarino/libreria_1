<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    protected $prestamo;

    public function __construct(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
    }

    public function showLendings()
    {
        $prestamos = $this->prestamo->getAll();
        return view('prestamos.list-lendings', ['prestamos' => $prestamos]);
    }

    public function showAddForm()
    {
        return view('prestamos.add-lending');
    }

    public function add(Request $req)
    {
        $messages = [
            'required' => 'Debe rellenar el campo :attribute.',
            'after'    => 'La fecha de la devolución debe ser mayor a la fecha de inicio',
        ];

        $validatedData = $req->validate([
            'lendingDate' => 'required|date',
            'returnDate' => 'required|date|after:lendingDate',
        ], $messages);
        $userId = Auth::user()->id;
        $libroId = $req->input('book');
        $lendingDate = $validatedData['lendingDate'];
        $returnDate = $validatedData['returnDate'];
        $this->prestamo->add($userId, $lendingDate, $returnDate, $libroId);
        return redirect()->route('listMyLendings');
    }

    public function returnLending(Request $req)
    {
        $this->prestamo->return($req->input('id'));
        return redirect()->route('listMyLendings');
    }

    public function editLending(Request $req)
    {
        $messages = [
            'required' => 'Debe rellenar el campo :attribute.',
            'after'    => 'La fecha de la devolución debe ser mayor a la fecha de inicio',
        ];

        $validatedData = $req->validate([
            'lendingDate' => 'required|date',
            'returnDate' => 'required|date|after:lendingDate',
        ], $messages);
        $lendingDate = $validatedData['lendingDate'];
        $returnDate = $validatedData['returnDate'];
        $this->prestamo->updateLending($req->input('id'), $lendingDate, $returnDate);
        return redirect()->route('listMyLendings');
    }
}
