<?php

namespace App\Providers;

use App\Models\Libro;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\LibroController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Inyección de dependencia
        #$this->app->bind(LibroController::class, function () {
        #   return new Libro();
        #});
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
