<x-layout>
<div class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white">Listado de Imágenes</h2>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Crear Imagen
            </button>
        </div>

        <!-- Tabla de imágenes -->
        <div class="card bg-dark shadow-sm">
            <div class="card-body">
                <table class="table table-dark table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ruta</th>
                            <th>Etiquetas</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($images as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td>{{ $image->path }}</td>
                            <td>{{ $image->tags }}</td>
                            <td>{{ $image->category_id }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $image->id }}">
                                    Editar
                                </button>

                                <form action="{{ route('admin.images.destroy', $image) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($errors->any())
                    <ul class="px-4 py-2 bg-red-100">
                        @foreach($errors->all() as $error)
                            <li class="my-2 text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            {{ $images->links() }}
        </div>
    </div>

    <!-- Modales de edición -->
    @foreach($images as $image)
    <div class="modal fade" id="editModal{{ $image->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $image->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card bg-dark">
                <form method="POST" action="{{ route('admin.images.update', $image) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="editModalLabel{{ $image->id }}">Editar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                        <!-- Imagen -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="image" class="form-label text-light">Imagen</label>
                            <input type="file" name="image" id="image" class="form-control bg-secondary text-white @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected($image->category_id == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                        </select>
                        <!-- Etiquetas -->
                        <div class="mb-3">
                            <label for="tags" class="form-label text-light">Etiquetas</label>
                            <div class="d-flex flex-wrap bg-secondary p-2 rounded">
                                <ul class="tags-list list-inline mb-2" data-existing-tags="{{ $image->tags }}"></ul>
                                    @foreach (array_filter(explode(',', old('tags'))) as $tag)
                                        <li class="text-white me-2">{{ $tag }} <button class="btn btn-sm btn-danger delete-button">X</button></li>
                                    @endforeach
                                </ul>
                               <input type="text" class="tag-input form-control bg-dark text-white border-0" placeholder="Agregar etiqueta" />
                            </div>
                        </div>
                        <input type="hidden" name="tags" class="tags-hidden-input" value="{{ $image->tags }}">
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
                <form method="POST" action="{{ route('admin.images.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="createModalLabel">Agregar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="image" class="form-label text-light">Imagen</label>
                            <input type="file" name="image" id="image" class="form-control bg-secondary text-white @error('image') is-invalid @enderror" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                        </select>
                        <!-- Etiquetas -->
                        <div class="mb-3">
                            <label for="tags" class="form-label text-light">Etiquetas</label>
                            <div class="d-flex flex-wrap bg-secondary p-2 rounded">
                                <ul class="tags-list list-inline mb-2"></ul>
                                    @foreach (array_filter(explode(',', old('tags'))) as $tag)
                                        <li class="text-white me-2">{{ $tag }} <button class="btn btn-sm btn-danger delete-button">X</button></li>
                                    @endforeach
                                </ul>
                                <input type="text" class="tag-input form-control bg-dark text-white border-0" placeholder="Agregar etiqueta" />
                            </div>
                        </div>
                         <input type="hidden" name="tags" class="tags-hidden-input">
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

<script>
document.querySelectorAll('.modal').forEach(function(modal) {

    const tagsList = modal.querySelector('.tags-list');
    const inputTag = modal.querySelector('.tag-input');
    const tagsInputField = modal.querySelector('.tags-hidden-input');

    if (!tagsList || !inputTag || !tagsInputField) return;

    let tags = [];

    // 🔹 Cargar tags existentes
    const existingTags = tagsList.dataset.existingTags;
    if (existingTags) {
        tags = existingTags.split(',').map(tag => tag.trim()).filter(tag => tag);

        tags.forEach(tag => {
            const tagItem = document.createElement('li');
            tagItem.classList.add('text-white', 'me-2');
            tagItem.innerHTML = `
                ${tag}
                <button type="button" class="btn btn-sm btn-danger delete-button">X</button>
            `;
            tagsList.appendChild(tagItem);
        });

        tagsInputField.value = tags.join(',');
    }

    function updateTagsInput() {
        tagsInputField.value = tags.join(',');
    }

    inputTag.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            const tagContent = inputTag.value.trim();

            if (tagContent && !tags.includes(tagContent)) {
                tags.push(tagContent);

                const tagItem = document.createElement('li');
                tagItem.classList.add('text-white', 'me-2');
                tagItem.innerHTML = `
                    ${tagContent}
                    <button type="button" class="btn btn-sm btn-danger delete-button">X</button>
                `;

                tagsList.appendChild(tagItem);
                inputTag.value = '';
                updateTagsInput();
            }
        }
    });

    tagsList.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-button')) {
            const tagItem = event.target.parentNode;
            const tagText = tagItem.firstChild.textContent.trim();

            tags = tags.filter(tag => tag !== tagText);
            tagItem.remove();
            updateTagsInput();
        }
    });

});
</script>
</x-layout>