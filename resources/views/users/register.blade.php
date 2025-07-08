<x-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-light mb-4">Registro</h4>
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-light">Nombre</label>
                            <input type="text" class="form-control bg-secondary text-white" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Correo Electrónico</label>
                            <input type="email" class="form-control bg-secondary text-white" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Contraseña</label>
                            <input type="password" class="form-control bg-secondary text-white" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Confirmar Contraseña</label>
                            <input type="password" class="form-control bg-secondary text-white" name="password_confirmation" required>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-info text-white px-4">Registrarse</button>
                        </div>

                        <div class="text-center text-light">
                            ¿Ya tienes cuenta? <a href="{{ route('users.login') }}" class="text-info">Inicia sesión</a>
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
