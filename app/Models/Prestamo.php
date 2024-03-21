<?php

namespace App\Models;

use App\Models\User;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';
    protected $fillable = ['fecha_prestamo', 'fecha_devolucion', 'devuelto', 'libro_id', 'user_id'];
    protected $casts = ["fecha_prestamo" => "datetime", "fecha_devolucion" => "datetime"];

    // Devuelve el libro que pertence al préstamo
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class);
    }

    // Devuelve el usuario que hizo el préstamo
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Devuelve todos los préstamos
    public static function getAll()
    {
        return Prestamo::all();
    }

    // Obtiene los préstamos que esten sin devolver **NO USADO EN ESTA VERSION
    public static function getActives()
    {
        return Prestamo::where('devuelto', false);
    }

    // Obtiene los préstamos que esten devueltos **NO USADO EN ESTA VERSION
    public static function getNotActives()
    {
        return Prestamo::where('devuelto', true);
    }

    // Obtiene un préstamo por ID
    public static function getLendingById($id)
    {
        return Prestamo::find($id);
    }

    // Añade un nuevo préstamo
    public function add($userId, $lendingDate, $returnDate, $libroId)
    {
        $prestamo = new Prestamo();
        $prestamo->user_id = $userId;
        $prestamo->fecha_prestamo = $lendingDate;
        $prestamo->fecha_devolucion = $returnDate;
        $prestamo->libro_id = $libroId;
        $prestamo->save();
    }

    // Actualiza el estado de un préstamo a devuelto
    public function return($id)
    {
        $prestamo = Prestamo::find($id);
        if (!isset($prestamo))
            return "No existe ese ID";
        $prestamo->devuelto = true;
        $prestamo->save();
    }

    // Actualiza las fechas de un préstamo
    public function updateLending($id, $lendingDate, $returnDate)
    {
        Prestamo::find($id)->update([
            'fecha_prestamo' => $lendingDate,
            'fecha_devolucion' => $returnDate,
        ]);
    }
}
