<x-layout>
<div class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white">Listado de Categorias</h2>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Crear Categoria
            </button>
        </div>

        <!-- Tabla de categorías -->
        <div class="card bg-dark shadow-sm">
            <div class="card-body">
                <table class="table table-dark table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                    Editar
                                </button>

                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
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
            {{$categories->links()}}
        </div>
    </div>

    <!-- Modales de edición -->
    @foreach($categories as $category)
    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card bg-dark">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="editModalLabel{{ $category->id }}">Editar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-name-{{ $category->id }}" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-name-{{ $category->id }}" name="name" value="{{ $category->name }}" required>
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
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="createModalLabel">Crear Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create-name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="create-name" name="name" required>
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
