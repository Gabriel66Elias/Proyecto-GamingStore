@extends('layout.main')
@section('titulo', 'Gestión de Stock — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Gestión de Stock</h1>
            <p class="admin-page-subtitle">Ordenado de menor a mayor stock — productos críticos primero</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            @php
                $sinStock  = $productos->where('stock', 0)->count();
                $stockBajo = $productos->whereBetween('stock', [1, 5])->count();
            @endphp
            @if($sinStock > 0)
                <span class="stock-badge stock-empty"><span class="stock-dot"></span>{{ $sinStock }} sin stock</span>
            @endif
            @if($stockBajo > 0)
                <span class="stock-badge stock-low"><span class="stock-dot"></span>{{ $stockBajo }} stock bajo</span>
            @endif
        </div>
    </div>

    <div class="row g-3 g-md-4">
        @forelse($productos as $p)
        @php
            $maxStock = $productos->max('stock') ?: 1;
            $pct = min(100, ($p->stock / $maxStock) * 100);
            if ($p->stock == 0)        { $color = '#FF3B3B'; $clase = 'stock-empty'; $label = 'Sin stock'; }
            elseif ($p->stock <= 5)    { $color = '#fbbf24'; $clase = 'stock-low';   $label = 'Crítico'; }
            elseif ($p->stock <= 10)   { $color = '#fbbf24'; $clase = 'stock-low';   $label = 'Bajo'; }
            else                       { $color = '#4ade80'; $clase = 'stock-ok';    $label = 'OK'; }
        @endphp
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="prod-card stock-card">

                <div class="prod-card-img-wrap stock-card-img-wrap">
                    @if($p->imagen)
                        <img src="{{ asset('storage/' . $p->imagen) }}" class="prod-card-img" alt="{{ $p->nombre }}">
                    @else
                        <div class="prod-card-img-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            <span>Sin imagen</span>
                        </div>
                    @endif

                    {{-- Indicador de nivel de alerta en esquina --}}
                    @if($p->stock == 0)
                        <span class="prod-card-stock-overlay stock-badge stock-empty">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16" style="flex-shrink:0;">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Sin stock
                        </span>
                    @elseif($p->stock <= 5)
                        <span class="prod-card-stock-overlay stock-badge stock-low">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16" style="flex-shrink:0;">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            Crítico
                        </span>
                    @endif
                </div>

                <div class="prod-card-body">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div style="min-width:0;">
                            <p class="prod-card-name">{{ $p->nombre }}</p>
                        </div>
                        @if($p->categoria)
                            <span class="cat-badge flex-shrink-0">{{ $p->categoria->nombre }}</span>
                        @endif
                    </div>

                    <div class="stock-info-block">
                        <div class="d-flex align-items-end justify-content-between gap-2 mb-2">
                            <div>
                                <span class="stock-num" style="color:{{ $color }};">{{ $p->stock }}</span>
                                <span class="stock-unit">unidades</span>
                            </div>
                            <span class="stock-badge {{ $clase }} flex-shrink-0">
                                <span class="stock-dot"></span>{{ $label }}
                            </span>
                        </div>
                        <div class="stock-bar-track" style="height:6px;">
                            <div class="stock-bar-fill" style="width:{{ $pct }}%; background-color:{{ $color }};"></div>
                        </div>
                    </div>
                </div>

                <div class="stock-card-footer">
                    <span class="stock-footer-label">Precio venta</span>
                    <span class="stock-footer-price">${{ number_format($p->precio_venta, 2) }}</span>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-empty-state">
                    <div class="admin-empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2z"/>
                        </svg>
                    </div>
                    <p class="text-white fw-semibold mb-1">No hay productos para gestionar</p>
                    <p class="text-secondary small">El catálogo está vacío.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
@endsection
