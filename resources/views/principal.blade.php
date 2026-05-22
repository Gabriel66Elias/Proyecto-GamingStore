@extends('layout.main')
@section('titulo', 'Inicio')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.principal.css') }}">
@endpush

@section('contenido')

    {{-- Fondo con grilla y brillo rojo fijo (definido en fondos.css) --}}
    <div class="fondo-minimalista-grid">
        <div class="brillo-rojo-cenital"></div>
        <div class="mascara-difuminada"></div>
    </div>

    {{-- ========================================================
         HERO: Carrusel de fondo + texto superpuesto centrado
         ======================================================== --}}
    <header class="hero-principal position-relative" style="overflow: hidden;">

        <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-indicators" style="z-index: 5;">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner h-100">
                {{-- Overlay que oscurece las imágenes para que el texto sea legible --}}
                <div class="position-absolute top-0 start-0 w-100 h-100"
                     style="background: linear-gradient(to bottom, rgba(17,19,26,0.35) 0%, #0b0c10 100%); z-index: 1;">
                </div>
                <div class="carousel-item active h-100">
                    <img src="/img/carrusel1.webp" class="d-block w-100 h-100 object-fit-cover" alt="Setup Gaming 1">
                </div>
                <div class="carousel-item h-100">
                    <img src="/img/carrusel2.webp" class="d-block w-100 h-100 object-fit-cover" alt="Setup Gaming 2">
                </div>
                <div class="carousel-item h-100">
                    <img src="/img/carrusel3.webp" class="d-block w-100 h-100 object-fit-cover" alt="Consolas">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 5;">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 0 6px rgba(255,59,59,0.5));"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 5;">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 0 6px rgba(255,59,59,0.5));"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        {{-- Texto centrado sobre el carrusel --}}
        <div class="position-absolute top-50 start-50 translate-middle w-100 text-center" style="z-index: 2;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-xl-8">
                        <p class="hero-eyebrow mb-3">Tu tienda gaming de confianza</p>
                        <h1 class="hero-titulo mb-4">
                            Elevá tu juego al <span class="text-mars">siguiente nivel</span>
                        </h1>
                        <p class="hero-subtitulo mb-5">
                            Consolas, hardware y periféricos top al mejor precio y con garantía oficial.
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a href="/catalogo" class="btn btn-mars btn-lg px-5 py-3 shadow-lg d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 0.8rem;">
                                <img src="{{ asset('assets/controller.svg') }}" alt="" style="width: 20px; height: 20px; filter: invert(1);">
                                Ver Catálogo
                            </a>
                            <a href="/quienes-somos" class="btn btn-conocenos btn-lg px-5 py-3 fw-bold" style="border-radius: 0.8rem;">
                                Conócenos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ========================================================
         BARRA DE BENEFICIOS (envío, garantía, cuotas, soporte)
         ======================================================== --}}
    <x-home.beneficios />

    {{-- ========================================================
         CATEGORÍAS
         ======================================================== --}}
    <x-home.categorias />

    {{-- ========================================================
         PRODUCTOS DESTACADOS (sólo si hay productos)
         ======================================================== --}}
    @if(isset($productosDestacados) && $productosDestacados->isNotEmpty())
        <x-home.productos-destacados :productos="$productosDestacados" />
    @endif

    {{-- ========================================================
         BANNER PROMOCIONAL
         ======================================================== --}}
    <x-home.banner-promo />


@endsection
