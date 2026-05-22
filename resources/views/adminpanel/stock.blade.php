@extends('layout.main')
@section('titulo', 'Gestión de Stock — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="admin-page-title">Gestión de Stock</h1>
                <p class="admin-page-subtitle">Ordenado de menor a mayor stock — productos críticos primero</p>
            </div>
            <div class="d-flex gap-2">
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

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock actual</th>
                        <th>Nivel</th>
                        <th>Precio venta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $p)
                    @php
                        $maxStock = $productos->max('stock') ?: 1;
                        $pct = min(100, ($p->stock / $maxStock) * 100);
                        if ($p->stock == 0)         { $color = '#FF3B3B'; $clase = 'stock-empty'; $label = 'Sin stock'; }
                        elseif ($p->stock <= 5)     { $color = '#fbbf24'; $clase = 'stock-low';   $label = 'Crítico'; }
                        elseif ($p->stock <= 10)    { $color = '#fbbf24'; $clase = 'stock-low';   $label = 'Bajo'; }
                        else                        { $color = '#4ade80'; $clase = 'stock-ok';    $label = 'OK'; }
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($p->imagen)
                                    <img src="{{ asset('storage/' . $p->imagen) }}" class="prod-thumb" alt="{{ $p->nombre }}">
                                @else
                                    <div class="prod-thumb-placeholder">?</div>
                                @endif
                                <span class="fw-semibold" style="color:#e2e8f0;">{{ $p->nombre }}</span>
                            </div>
                        </td>
                        <td><span class="cat-badge">{{ $p->categoria?->nombre }}</span></td>
                        <td>
                            <span style="font-size: 1.1rem; font-weight: 800; color: {{ $color }};">
                                {{ $p->stock }}
                            </span>
                            <span style="font-size: 0.75rem; color:#64748b;"> u.</span>
                            <div class="stock-bar-track" style="width: 80px;">
                                <div class="stock-bar-fill" style="width: {{ $pct }}%; background-color: {{ $color }};"></div>
                            </div>
                        </td>
                        <td>
                            <span class="stock-badge {{ $clase }}">
                                <span class="stock-dot"></span>{{ $label }}
                            </span>
                        </td>
                        <td style="color:#4ade80; font-weight:700;">${{ number_format($p->precio_venta, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="admin-empty-state">
                                <div class="admin-empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2z"/>
                                    </svg>
                                </div>
                                <p class="text-white fw-semibold mb-1">No hay productos para gestionar</p>
                                <p class="text-secondary small">El catálogo está vacío.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
