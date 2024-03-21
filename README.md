# libreria_3

Práctica 3 de Laravel - EIP

## Autenticación

Se ha añadido una autenticación con jetstream.

## Cambios en el modelo

- El campo user_id es una clave foránea que hace referencia a la tabla users.

## Restricciones de acceso

- Admin:
  - Solo el usuario que pertenezca al grupo de administrador podrá ver todos los prestamos. Para ello se ha creado un middleware llamado AdminMiddleware que comprueba si el usuario pertenece a ese grupo o no.

```
    class AdminMiddleware
    {
        /**
        * Handle an incoming request.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \Closure  $next
        * @return mixed
        */
        public function handle($request, Closure $next)
        {
            if (Auth::check() && Auth::user()->currentTeam && Auth::user()->currentTeam->name !== 'administrador') {
                abort(403, 'Unauthorized');
            }

            return $next($request);
        }
    }
```

- Login:
  - Además, se ha restringido el acceso a diferentes rutas en las que debe de haber un usuario logeado para poder acceder a su información. Esto es manjeado por el middleware Auth ya definido por jetstream. Las rutas son:
    - /prestamos/nuevo
    - /perfil/prestamos
    - /prestamos

```
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/prestamos', [PrestamoController::class, 'showLendings'])->name('listLendings');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/prestamos/nuevo', [PrestamoController::class, 'showAddForm'])->name('showLendingForm');
        Route::get('/perfil/prestamos', [UserController::class, 'showLendings'])->name('listMyLendings');
    });
```


## Barra de navegación

- Nuevos botones de autenticación (iniciar sesión, registro, cerrar sesión)
- Nuevo botón de perfil
- Nuevo botón 'mis préstamos' que muestra los muestros del usuario logeado
- El enlace a préstamos solo aparecerá en caso de que haya iniciado sesión un administrador


## Nueva vista 'mis préstamos'

Esta vista muestra únicamente los préstamos que haya realizado el usuario logeado en cuestión. El controlador UserController es quien se encarga de mandar los préstamos a la vista.
