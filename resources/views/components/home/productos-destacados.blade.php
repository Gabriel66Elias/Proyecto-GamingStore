@props(['productos'])

<section class="container py-3 mb-4">
    <div class="d-flex align-items-end justify-content-between mb-5">
        <div>
            <span class="seccion-linea d-block mb-2"></span>
            <h2 class="seccion-titulo mb-1">Más vendidos</h2>
            <p class="seccion-subtitulo mb-0">Los favoritos de nuestra comunidad gamer</p>
        </div>
        <a href="/catalogo" class="btn-ver-todos">Ver todos &rarr;</a>
    </div>

    <div class="row g-4">
        @foreach($productos as $producto)
            <x-producto-card :producto="$producto" :id="$producto->id" col-class="col-12 col-sm-6 col-lg-3" />
        @endforeach
    </div>
</section>
