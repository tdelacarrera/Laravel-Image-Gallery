<x-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="text-center mb-4 text-light">Subir Imagen</h4>
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="file" class="form-label text-light">Imagen</label>
                            <input type="file" name="file" id="file" class="form-control bg-secondary text-white @error('file') is-invalid @enderror" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Etiquetas -->
                        <div class="mb-3">
                            <label for="tags" class="form-label text-light">Etiquetas</label>
                            <div class="d-flex flex-wrap bg-secondary p-2 rounded">
                                <ul id="tags" class="list-inline mb-2">
                                    @foreach (array_filter(explode(',', old('tags'))) as $tag)
                                        <li class="text-white me-2">{{ $tag }} <button class="btn btn-sm btn-danger delete-button">X</button></li>
                                    @endforeach
                                </ul>
                                <input type="text" id="tag" class="form-control bg-dark text-white border-0" placeholder="Agregar etiqueta" />
                            </div>
                        </div>

                        <input type="hidden" name="tags" id="tags-input">

                        <!-- Botón -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-info text-white px-4">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tagsList = document.getElementById('tags');
    const inputTag = document.getElementById('tag');
    const tagsInputField = document.getElementById('tags-input');
    let tags = [];

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
                tagItem.innerHTML = `${tagContent} <button class="btn btn-sm btn-dark delete-button">X</button>`;
                tagItem.classList.add('text-white', 'me-2');
                tagsList.appendChild(tagItem);
                inputTag.value = '';
                updateTagsInput();
            }
        }
    });

    tagsList.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-button')) {
            const tagItem = event.target.parentNode;
            const tagText = tagItem.textContent.replace('X', '').trim();
            tags = tags.filter(tag => tag !== tagText);
            tagItem.remove();
            updateTagsInput();
        }
    });
</script>
</x-layout>
