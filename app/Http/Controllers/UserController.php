<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showLendings()
    {
        $user = auth()->user();
        $prestamos = $user->prestamos;
        return view('prestamos.list-lendings', ['prestamos' => $prestamos]);
    }
}
