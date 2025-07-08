<x-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-light mb-4">Iniciar Sesión</h4>
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-light">Correo Electrónico</label>
                            <input type="email" class="form-control bg-secondary text-white" name="email" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-light">Contraseña</label>
                            <input type="password" class="form-control bg-secondary text-white" name="password" id="password" required>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-info text-white px-4">Ingresar</button>
                        </div>

                        <div class="text-center text-light">
                            ¿No tienes cuenta? <a href="{{ route('auth.register') }}" class="text-info">Regístrate</a>
                        </div>
                    </form>
                    @if($errors->any())
                        <ul class="px-4 py-2 bg-red100">
                            @foreach($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
