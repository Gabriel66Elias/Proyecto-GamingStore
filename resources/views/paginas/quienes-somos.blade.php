@extends('layout.main')
@section('titulo', 'Quiénes Somos | GamingStation')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.quienes-somos.css') }}">
<style>
    @media (max-width: 767.98px) {
        .ip-text, .ip-muted, .rol-destacado {
            font-size: 1.15rem !important;
            line-height: 1.6;
        }
    }
</style>
@endpush
@section('contenido')

    <div class="container mt-5 mb-5">

        <div class="mb-4">
            <a href="/" class="ip-back-link">
                <img src="{{ asset('assets/caret-left.svg') }}" alt="" style="width:16px;height:16px;filter:invert(0.6);">
                Volver al inicio
            </a>
        </div>

        {{-- Título principal --}}
        <div class="row mb-5 text-center">
            <div class="col-12">
                <h1 class="text-white fw-black display-5 tracking-tighter mb-3">QUIÉNES SOMOS</h1>
                <p class="ip-muted mb-0">Conocé nuestra historia y al equipo detrás de GamingStation.</p>
                <div class="ip-title-line"></div>
            </div>
        </div>

        {{-- Trayectoria y Compromiso --}}
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-6">
                <div class="card card-nosotros h-100 border-0">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="ip-card-title">Nuestra Trayectoria</h3>
                        <p class="ip-text mb-3">
                            GamingStation nació en 2020 con la misión de ofrecer a los gamers una experiencia de compra única, centrada en la calidad y el alto rendimiento de nuestros productos.
                        </p>
                        <p class="ip-text mb-0">
                            Desde entonces, hemos crecido hasta convertirnos en una de las tiendas de videojuegos más confiables y reconocidas del país, gracias a nuestro compromiso con la satisfacción del cliente y la pasión por los videojuegos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card card-nosotros h-100 border-0">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="ip-card-title">Nuestro Compromiso</h3>
                        <p class="ip-text mb-3">
                            En GamingStation, nos esforzamos por ofrecer una amplia selección de productos de alta calidad, desde consolas y accesorios hasta los últimos lanzamientos en videojuegos. Nuestro equipo de expertos está siempre disponible para brindar asesoramiento personalizado.
                        </p>
                        <p class="ip-text mb-0">
                            Además, nos comprometemos a mantener precios competitivos y a ofrecer promociones exclusivas para nuestros clientes, asegurando que cada compra en GamingStation sea una experiencia satisfactoria y memorable.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Equipo --}}
        <div class="row mt-5 mb-4 text-center">
            <div class="col-12">
                <h2 class="text-white fw-black tracking-tighter mb-3">NUESTRO EQUIPO</h2>
                <p class="ip-muted mb-0">Las personas que hacen posible GamingStation.</p>
                <div class="ip-title-line"></div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-equipo h-100 text-center border-0">
                    <div class="contenedor-img">
                        <img src="/img/juan-perez.webp" alt="Juan Pérez - CEO" class="img-fluid">
                    </div>
                    <div class="card-body p-4 mt-2">
                        <h4 class="fw-bold text-white mb-1">Juan Pérez</h4>
                        <p class="rol-destacado mb-3">Fundador y CEO</p>
                        <p class="ip-text mb-0">Con más de 15 años de experiencia en la industria de los videojuegos, liderando la visión estratégica de GamingStation.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-equipo h-100 text-center border-0">
                    <div class="contenedor-img">
                        <img src="/img/maria-garcia.webp" alt="María García - Directora de Experiencia" class="img-fluid">
                    </div>
                    <div class="card-body p-4 mt-2">
                        <h4 class="fw-bold text-white mb-1">María García</h4>
                        <p class="rol-destacado mb-3">Directora de Experiencia del Cliente</p>
                        <p class="ip-text mb-0">Su misión es asegurar que cada envío llegue en tiempo y forma a cualquier punto del país. Lidera nuestro equipo de postventa para garantizarte un respaldo rápido y efectivo ante cualquier consulta o trámite de garantía oficial.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card card-equipo h-100 text-center border-0">
                    <div class="contenedor-img">
                        <img src="/img/carlos-lopez.webp" alt="Carlos López - Jefe de Ventas" class="img-fluid">
                    </div>
                    <div class="card-body p-4 mt-2">
                        <h4 class="fw-bold text-white mb-1">Carlos López</h4>
                        <p class="rol-destacado mb-3">Jefe de Ventas</p>
                        <p class="ip-text mb-0">Amplia experiencia en atención al cliente y un profundo conocimiento técnico de los productos que ofrecemos.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
