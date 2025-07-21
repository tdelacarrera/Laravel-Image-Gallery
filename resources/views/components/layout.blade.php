<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <title>Galería de Imágenes</title>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="mb-4">Galería</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('images.index') }}">Imágenes</a>
             @auth
            <a class="nav-link" href="{{ route('images.create') }}">Subir Imagen</a>
            <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
            @endauth
            @guest
            <a class="nav-link" href="{{ route('auth.register') }}">Registro</a>
            <a class="nav-link" href="{{ route('auth.login') }}">Iniciar Sesión</a>
            @endguest
            @auth
            <form action="{{ route('auth.logout')}}" method="POST">
                @csrf
                <button class="btn text-white">Cerrar Sesión</button>
            </form>
            @endauth
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            {{ $slot }}
        </div>
    </div>

 <!-- 
    <footer class="footer">
        <p>Galería de Imágenes</p>
    </footer>
  -->

</body>
</html>
