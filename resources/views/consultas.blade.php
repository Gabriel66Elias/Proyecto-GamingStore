@extends('layout.main')
@section('titulo', $producto->nombre)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.consultas.css') }}">
@endpush

@section('contenido')

@php
    $imagenUrl = $producto->imagen
        ? asset('storage/' . $producto->imagen)
        : asset('assets/placeholder-producto.svg');

    if ($producto->stock > 5) {
        $stockDot   = 'ok';
        $stockLabel = 'En stock';
    } elseif ($producto->stock > 0) {
        $stockDot   = 'low';
        $stockLabel = 'Pocas unidades';
    } else {
        $stockDot   = 'out';
        $stockLabel = 'Sin stock';
    }
@endphp

<div class="container mt-5 mb-5">

    {{-- Volver al catálogo --}}
    <a href="/catalogo" class="cp-back">
        <img src="{{ asset('assets/caret-left.svg') }}" alt="" width="16" height="16" style="filter: invert(0.5);">
        Volver al catálogo
    </a>

    {{-- ====================================================
         HERO: imagen sticky + panel de info
         ==================================================== --}}
    <div class="cp-grid">

        {{-- ─── IMAGEN ─────────────────────────────────── --}}
        <div class="cp-img-sticky">
            <div class="cp-img-card">
                <img src="{{ $imagenUrl }}" alt="{{ $producto->nombre }}">
            </div>
        </div>

        {{-- ─── INFO ───────────────────────────────────── --}}
        <div class="cp-info-panel">

            <div class="cp-info-header">
                <span class="cp-badge-categoria">{{ $producto->categoria?->nombre ?? 'Producto' }}</span>
            </div>

            <div class="cp-info-body">

                {{-- Nombre --}}
                <h1 class="cp-nombre">{{ $producto->nombre }}</h1>

                {{-- Precio --}}
                <div class="cp-precio-wrap">
                    <div class="cp-precio">${{ number_format($producto->precio_venta, 0, ',', '.') }}</div>
                    <p class="cp-cuotas">
                        o <strong class="text-mars">12 cuotas sin interés</strong> de
                        <strong class="text-white">${{ number_format($producto->precio_venta / 12, 0, ',', '.') }}</strong>
                    </p>
                </div>

                <div class="cp-sep"></div>

                {{-- Stock --}}
                <div class="cp-stock">
                    <span class="cp-stock-dot {{ $stockDot }}"></span>
                    <span class="cp-stock-label {{ $stockDot }}">{{ $stockLabel }}</span>
                    @if($producto->stock > 0)
                        <span class="cp-stock-count">&nbsp;— {{ $producto->stock }} disponibles</span>
                    @endif
                </div>

                {{-- Cantidad + botón (deshabilitado en modo vista previa para admin) --}}
                @php $esAdmin = Auth::check() && Auth::user()->rol?->nombre === 'admin'; @endphp

                @if($esAdmin)
                <div class="cp-preview-notice">
                    <div class="cp-preview-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FF3B3B" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="cp-preview-title">Modo vista previa activo</p>
                        <p class="cp-preview-desc">Las compras están deshabilitadas para administradores. <a href="{{ route('admin.dashboard') }}">Volver al panel</a></p>
                    </div>
                </div>
                @else
                <div class="cp-action">
                    <div class="cp-qty">
                        <button type="button" class="cp-qty-btn" onclick="cpAdjustQty(-1)" aria-label="Restar">−</button>
                        <input type="number" id="input-cantidad" class="cp-qty-input"
                               value="1" min="1" max="{{ $producto->stock }}" readonly>
                        <button type="button" class="cp-qty-btn" onclick="cpAdjustQty(1)" aria-label="Sumar">+</button>
                    </div>

                    <button class="cp-btn-add"
                            {{ $producto->stock === 0 ? 'disabled' : '' }}
                            onclick="agregarAlCarrito({{ $producto->id }})">
                        <img src="{{ asset('assets/cart-plus.svg') }}" alt="" width="20" height="20" style="filter: invert(1);">
                        Agregar al carrito
                    </button>
                </div>
                @endif

                <div class="cp-sep"></div>

                {{-- Trust strip --}}
                <div class="cp-trust">
                    <div class="cp-trust-item">
                        <img src="{{ asset('assets/truck.svg') }}" alt="Envío">
                        <span class="cp-trust-name">Envío gratis</span>
                        <span class="cp-trust-sub">24–72 hs hábiles</span>
                    </div>
                    <div class="cp-trust-item">
                        <img src="{{ asset('assets/check2.svg') }}" alt="Garantía">
                        <span class="cp-trust-name">Garantía oficial</span>
                        <span class="cp-trust-sub">De fábrica</span>
                    </div>
                    <div class="cp-trust-item">
                        <img src="{{ asset('assets/credit-card-fill.svg') }}" alt="Pago">
                        <span class="cp-trust-name">Pago seguro</span>
                        <span class="cp-trust-sub">Todas las tarjetas</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- ====================================================
         SECCIONES: Descripción y Especificaciones siempre visibles
         ==================================================== --}}
    <div class="cp-sections">

        <div class="cp-section-card">
            <div class="cp-section-header">
                <span class="cp-section-title">Descripción</span>
            </div>
            <div class="cp-section-body">
                <p class="cp-desc-text">{{ $producto->descripcion }}</p>
            </div>
        </div>

        @if($producto->especificaciones)
        <div class="cp-section-card">
            <div class="cp-section-header">
                <span class="cp-section-title">Especificaciones Destacadas</span>
            </div>
            <div class="cp-section-body">
                <ul class="cp-specs-grid">
                    @foreach ($producto->especificaciones as $spec)
                        <li>{{ $spec }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

    </div>

</div>

@push('scripts')
<script src="{{ asset('js/consultas.js') }}"></script>
@endpush

@endsection
