@extends('layout.main')
@section('titulo', 'Dashboard — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilos.pedidos-admin.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    {{-- Encabezado --}}
    <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Dashboard</h1>
            <p class="admin-page-subtitle">Resumen general de GamingStation</p>
        </div>
        <span class="dash-date">{{ now()->isoFormat('dddd, D [de] MMMM') }}</span>
    </div>

    {{-- Gráficos: stock y ganancias --}}
    <div class="row g-3 g-md-4 mb-4">

        <div class="col-12 col-lg-6">
            <x-admin.donut-chart
                eyebrow="Inventario"
                title="Stock de productos"
                :segments="$stockChart['segments']"
                :centerValue="$stockChart['total']"
                centerLabel="Productos" />
        </div>

        <div class="col-12 col-lg-6">
            <x-admin.donut-chart
                eyebrow="Finanzas"
                title="Ganancias reales"
                :segments="$gananciaChart['segments']"
                centerValue="${{ number_format($gananciaChart['ganancia'], 0, ',', '.') }}"
                centerLabel="Ganancia neta">
                <div class="donut-summary">
                    <div class="donut-summary-row">
                        <span>Ingresos totales</span>
                        <strong>${{ number_format($gananciaChart['ingresos'], 0, ',', '.') }}</strong>
                    </div>
                    <div class="donut-summary-row">
                        <span>Costo de productos</span>
                        <strong>${{ number_format($gananciaChart['costos'], 0, ',', '.') }}</strong>
                    </div>
                </div>
            </x-admin.donut-chart>
        </div>

    </div>

    {{-- Secciones de actividad reciente --}}
    <div class="row g-3 g-md-4">

        {{-- Pedidos recientes --}}
        <div class="col-12 col-lg-6">
            <div class="admin-card" style="padding:0; overflow:hidden;">
                <div class="dash-section-header">
                    <div>
                        <p class="dash-section-eyebrow">Recientes</p>
                        <h6 class="dash-section-title">Últimos pedidos</h6>
                    </div>
                    <a href="{{ route('admin.pedidos') }}" class="btn btn-mars btn-sm px-3" style="font-size:0.78rem; white-space:nowrap;">Ver todos</a>
                </div>

                <div class="dash-product-list">
                    @forelse($pedidosRecientes as $pedido)
                    <div class="dash-product-row">
                        <div class="dash-product-info">
                            <div class="prod-thumb-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                                </svg>
                            </div>
                            <div style="min-width:0;">
                                <p class="prod-cell-name fw-semibold mb-0" style="color:#e2e8f0; font-size:0.875rem;">{{ $pedido->numero_pedido ?? '#' . $pedido->id }}</p>
                                <span class="text-secondary" style="font-size:.78rem;">
                                    {{ trim(($pedido->nombre_cliente ?? $pedido->usuario?->nombre ?? '—') . ' ' . ($pedido->apellido_cliente ?? '')) }}
                                </span>
                            </div>
                        </div>
                        <div class="dash-product-meta">
                            <span class="dash-price">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                            <span class="badge-estado {{ \App\Models\VentaCabecera::estadoBadgeClass($pedido->estado) }}">
                                {{ \App\Models\VentaCabecera::estadoLabel($pedido->estado) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="dash-empty-row">No hay pedidos registrados aún.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Últimos productos agregados --}}
        <div class="col-12 col-lg-6">
            <div class="admin-card" style="padding:0; overflow:hidden;">
                <div class="dash-section-header">
                    <div>
                        <p class="dash-section-eyebrow">Recientes</p>
                        <h6 class="dash-section-title">Últimos productos agregados</h6>
                    </div>
                    <a href="{{ route('admin.productos') }}" class="btn btn-mars btn-sm px-3" style="font-size:0.78rem; white-space:nowrap;">Ver todos</a>
                </div>

                <div class="dash-product-list">
                    @forelse($ultimos as $p)
                    <div class="dash-product-row">
                        <div class="dash-product-info">
                            @if($p->imagen)
                                <img src="{{ asset('storage/' . $p->imagen) }}" class="prod-thumb" alt="{{ $p->nombre }}">
                            @else
                                <div class="prod-thumb-placeholder">?</div>
                            @endif
                            <div style="min-width:0;">
                                <p class="prod-cell-name fw-semibold mb-0" style="color:#e2e8f0; font-size:0.875rem;">{{ $p->nombre }}</p>
                                @if($p->categoria)
                                    <span class="cat-badge" style="margin-top:5px; display:inline-block;">{{ $p->categoria->nombre }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="dash-product-meta">
                            <span class="dash-price">${{ number_format($p->precio_venta, 2) }}</span>
                            @if($p->stock == 0)
                                <span class="stock-badge stock-empty"><span class="stock-dot"></span>Sin stock</span>
                            @elseif($p->stock <= 5)
                                <span class="stock-badge stock-low"><span class="stock-dot"></span>{{ $p->stock }} u.</span>
                            @else
                                <span class="stock-badge stock-ok"><span class="stock-dot"></span>{{ $p->stock }} u.</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="dash-empty-row">No hay productos cargados aún.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
