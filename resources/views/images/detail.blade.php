<x-layout>
<main class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Imagen con tamaño fijo y ajustable -->
            <img src="{{ asset('storage/images/' . $image->path) }}" 
                 alt="image" 
                 class="img-fluid rounded shadow-sm mb-3" 
                 style="max-width: 100%; height: auto; max-height: 500px;">
            
            <h2 class="mt-3">{{ $image->title }}</h2>

            <!-- Mostrar etiquetas si están disponibles -->
            @if ($image->tags && count(explode(',', $image->tags)) > 0)
                <div class="mb-3">
                    <strong>Etiquetas:</strong>
                    @foreach (explode(',', $image->tags) as $tag)
                        <a href="/images?tag={{ $tag }}" class="badge bg-primary text-white me-1">{{ $tag }}</a>
                    @endforeach
                </div>
            @endif

            <!-- Botón para regresar a la galería -->
            <a href="/images" class="btn btn-outline-secondary mt-3">← Volver</a>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalles</h5>
                    <ul class="list-unstyled">
                        <li><strong>Fecha de subida:</strong> {{ $image->created_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
</x-layout>
