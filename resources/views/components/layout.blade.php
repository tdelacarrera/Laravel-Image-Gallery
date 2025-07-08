<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <title>Galería Moderna</title>
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
