# libreria_2

Práctica 2 de Laravel - EIP

## Cambios en los modelos Libros y prestamos

-   Libro:

    -   El campo Año de publicación pasa de tipo date a entero ya que queremos únicamente el año.
    -   Al campo disponible se le asigna por defecto el valor true, ya que una vez añadido un libro, éste estará disponible para su préstamo.

-   Préstamo:
    -   Nuevo campo devuelto, por defecto falso. Indica si un préstamo ha sido devuelto o no.
    -   Añadida la clave foránea libro_id que es relacionado con la tabla Libro.

## Rutas.

-   Libro:

    -   Lista de libros
    -   Creación, borrado y edición de libros

-   Préstamos:
    -   Lista de préstamos
    -   Creación de préstamos

### Operaciones CRUD en Libro

Las operaciones CRUD del modelo libro son todas gestionadas a través de las rutas

#### Reglas para añadir un libro

- Todos los campos deben de estar rellenos
- El año debe tener un formáto númerico válido y ser menor o igual que el año actual

### Operaciones CRUD en Préstamo

En los préstamos, tanto el listado como la creación se realizan de la misma manera que con los libros.

Para gestionar que un libro no esté disponible cuando se cree un préstamo asociado, se realiza a través del observer PrestamoObserver.
En el observer se indica que tanto al crear como al finalizar un préstamo cambie el estado de disponibildad del libro en cuestión.

```
    public function created(Prestamo $prestamo): void
    {
        $libro = $prestamo->libro;
        $libro->disponible = false;
        $libro->save();
    }

    public function updated(Prestamo $prestamo): void
    {
        $libro = $prestamo->libro;
        $libro->disponible = true;
        $libro->save();
    }
```

Para finalizar un préstamo (actualizar su estado a devuelto), se abre una ventana modal que realiza la gestión enviando el id del préstamo a través de una ruta de tipo post.
Lo mismo ocurre cuando se modifica un préstamo.

#### Reglas para los préstamos

- Todos los campos deben de estar rellenos
- La fecha de la devolución debe de ser mayor que la fecha de inicio del préstamo
- Los préstamos no serán borrados, serán finalizados
