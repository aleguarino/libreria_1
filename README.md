# libreria_1

Práctica 1 de Laravel - EIP

## 1. Instalación de Laravel: Igual que antes, instala Laravel usando Composer.

composer create-project --prefer-dist laravel/laravel libreria

## 2. Configuración de la base de datos: Configura tu base de datos en el archivo. env.

Creación de una nueva base de datos en mi entorno local llamada "librería".

Credenciales modificadas para el acceso (Valores por defecto de MAMP).

## 3. Creación de la migración de libros: Crea una nueva migración para crear la tabla de libros.

php artisan make:model Libro -m

Con este comando creamos el modelo y su migración

## 4. Edita la migración creada para incluir los siguientes campos: id, titulo, autor, año_publicación, género, disponible.

    Schema::create('libros', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('autor');
        $table->date('año_publicacion');
        $table->string('genero');
        $table->boolean('disponible');
        $table->timestamps();
    });

## 5. Creación de la migración de préstamos: Esta migración debe incluir los siguientes campos: id, user_id, book_id, fecha_prestamo, fecha_devolucion.

php artisan make:model Prestamo -m

    Schema::create('prestamos', function (Blueprint $table) {
        $table->id();
        $table->integer('user_id');
        $table->integer('book_id');
        $table->date('fecha_prestamo');
        $table->date('fecha_devolucion');
        $table->timestamps();
    });

## 6. Ejecuta las migraciones.

php artisan migrate
