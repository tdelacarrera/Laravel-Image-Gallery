<x-layout>
<div class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white">Listado de Usuarios</h2>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Crear Usuario
            </button>
        </div>

        <!-- Tabla de usuarios -->
        <div class="card bg-dark shadow-sm">
            <div class="card-body">
                <table class="table table-dark table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                    Editar
                                </button>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($errors->any())
                    <ul class="px-4 py-2 bg-red100">
                        @foreach($errors->all() as $error)
                            <li class="my-2 text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
            {{$users->links()}}
        </div>
    </div>

    <!-- Modales de edición -->
    @foreach($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card bg-dark">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="editModalLabel{{ $user->id }}">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-name-{{ $user->id }}" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-name-{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email-{{ $user->id }}" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email-{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-password-{{ $user->id }}" class="form-label">Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="edit-password-{{ $user->id }}" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="edit-password_confirmation-{{ $user->id }}" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="edit-password_confirmation-{{ $user->id }}" name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-info">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal de creación -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card bg-dark">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="createModalLabel">Crear Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="create-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="create-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="create-password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="create-password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-info">Crear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>
