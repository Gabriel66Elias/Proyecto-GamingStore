@props(['producto', 'id', 'colClass' => 'col-12 col-sm-6 col-lg-4', 'favoritoIds' => []])

@php
    $esFavorito = in_array($id, $favoritoIds);
@endphp

<div class="{{ $colClass }} producto-item"
     data-id="{{ $id }}"
     data-categoria="{{ $producto->categoria?->nombre }}"
     data-precio="{{ $producto->precio_venta }}"
     data-nombre="{{ Str::lower($producto->nombre) }}">

    <a href="/consulta/{{ $id }}" class="card h-100 border-0 bg-transparent hover-elevate text-decoration-none" style="display: block; cursor: pointer;">

        <div class="contenedor-img rounded-4 bg-dark bg-opacity-50 mb-3" style="transition: transform 0.4s ease;">
            <button type="button"
                    class="btn-favorito {{ $esFavorito ? 'is-favorito' : '' }}"
                    data-producto-id="{{ $id }}"
                    title="{{ $esFavorito ? 'Quitar de favoritos' : 'Agregar a favoritos' }}"
                    aria-label="Favorito">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                </svg>
            </button>
            <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('assets/placeholder-producto.svg') }}"
                 alt="{{ $producto->nombre }}" class="p-4">
        </div>

        <div class="card-body p-0 d-flex flex-column">

            <span class="text-mars fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 1px;">
                {{ $producto->categoria?->nombre }}
            </span>

            <h5 class="text-white fw-bold mb-2 fs-5 lh-sm">{{ $producto->nombre }}</h5>

            <div class="mt-auto d-flex align-items-center justify-content-between pt-2">
                <span class="text-white fw-bolder fs-4">
                    ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                </span>
                <span class="btn btn-mars btn-sm px-3 fw-bold rounded-3">
                    Detalles
                </span>
            </div>
        </div>
    </a>
</div>
