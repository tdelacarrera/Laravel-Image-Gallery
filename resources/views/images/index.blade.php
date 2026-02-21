<x-layout>
<div class="row mb-4">
    <div class="col-md-12 search-bar">
        <form class="d-flex" action="{{ route('images.index') }}" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Buscar imágenes...">
            <button class="btn" type="submit">Buscar</button>
        </form>
    </div>
</div>

<!-- Tags -->
<div class="mb-4">
    <form action="{{ route('images.index') }}" method="GET" class="d-flex flex-wrap">
        @foreach($tags as $tag)
            <button type="submit" name="search" value="{{ $tag }}" class="tag-btn">{{ $tag }}</button>
        @endforeach
    </form>
</div>

<!-- Galería -->
<div class="row">
    @foreach($images as $image)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <a href="{{ route('admin.images.show', ['image' => $image]) }}">
                    <img class="card-img-top" src="{{ asset('storage/' . $image->path) }}" alt="Imagen" onError="this.onerror=null;this.src='default-image.jpg';">
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $images->links('pagination::bootstrap-4') }}
</div>

</x-layout>
