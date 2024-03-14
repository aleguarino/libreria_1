<?php

namespace App\Observers;

use App\Models\Prestamo;

class PrestamoObserver
{
    public function created(Prestamo $prestamo): void
    {
        $libro = $prestamo->libro;
        $libro->disponible = false;
        $libro->save();
    }

    public function updated(Prestamo $prestamo): void
    {
        if ($prestamo->devuelto == true) {
            $libro = $prestamo->libro;
            $libro->disponible = true;
            $libro->save();
        }
    }

    /**
     * Handle the Prestamo "deleted" event.
     */
    public function deleted(Prestamo $prestamo): void
    {
        //
    }

    /**
     * Handle the Prestamo "restored" event.
     */
    public function restored(Prestamo $prestamo): void
    {
        //
    }

    /**
     * Handle the Prestamo "force deleted" event.
     */
    public function forceDeleted(Prestamo $prestamo): void
    {
        //
    }
}
