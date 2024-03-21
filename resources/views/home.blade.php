<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Librería')</title>

    <!-- Fonts -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    @php
        $team = null;
        $user = Auth::user();
        if (isset($user)) {
            $team = $user->currentTeam;
        }
    @endphp
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('listBooks') }}>Libros</a>
                    </li>
                    @if (isset($team) && $team->name == 'administrador')
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('listLendings') }}>Préstamos</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav justify-content-end">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('login') }}>Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('register') }}>Registro</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('listMyLendings') }}>Mis préstamos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('profile.show') }}>{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link"
                                    onclick="event.preventDefault(); if (!confirm('¿Está seguro de cerrar su sesión?')) return false; this.closest('form').submit()"
                                    href={{ route('logout') }}>
                                    Cerrar sesión
                                </a>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
@stack('scripts')

</html>
