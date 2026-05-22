@extends('layout.main')
@section('titulo', 'Dashboard — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        {{-- Encabezado --}}
        <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="admin-page-title">Dashboard</h1>
                <p class="admin-page-subtitle">Resumen general de GamingStation</p>
            </div>
            <span style="font-size: 0.78rem; color: #3d4659;">
                {{ now()->format('d/m/Y') }}
            </span>
        </div>

        {{-- Stat cards --}}
        <div class="row g-3 mb-4">

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-icon stat-icon-red">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FF3B3B" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </div>
                    <div class="stat-card-value">{{ $stats['total_productos'] }}</div>
                    <div class="stat-card-label">Productos activos</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-icon stat-icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#4ade80" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['stock_total']) }}</div>
                    <div class="stat-card-label">Unidades en stock</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-icon stat-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#60a5fa" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                    </div>
                    <div class="stat-card-value">{{ $stats['categorias'] }}</div>
                    <div class="stat-card-label">Categorías</div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-icon stat-icon-amber">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fbbf24" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </div>
                    <div class="stat-card-value">{{ $stats['sin_stock'] }}</div>
                    <div class="stat-card-label">Sin stock</div>
                </div>
            </div>

        </div>

        {{-- Últimos productos agregados --}}
        <div class="admin-table-wrapper">
            <div class="d-flex align-items-center justify-content-between px-4 py-3" style="border-bottom: 1px solid #1f222e;">
                <div>
                    <p style="font-size: 0.65rem; font-weight:700; letter-spacing:2px; color:#FF3B3B; text-transform:uppercase; margin:0 0 2px;">Recientes</p>
                    <h6 class="text-white fw-bold mb-0" style="font-size: 0.95rem;">Últimos productos agregados</h6>
                </div>
                <a href="{{ route('admin.productos') }}" class="btn btn-mars btn-sm px-3 py-2" style="font-size: 0.78rem;">Ver todos</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio venta</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimos as $p)
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
                        <td><span class="cat-badge">{{ $p->categoria }}</span></td>
                        <td style="color:#4ade80; font-weight:700;">${{ number_format($p->precio_venta, 2) }}</td>
                        <td>
                            @if($p->stock == 0)
                                <span class="stock-badge stock-empty"><span class="stock-dot"></span>Sin stock</span>
                            @elseif($p->stock <= 5)
                                <span class="stock-badge stock-low"><span class="stock-dot"></span>{{ $p->stock }} u.</span>
                            @else
                                <span class="stock-badge stock-ok"><span class="stock-dot"></span>{{ $p->stock }} u.</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4" style="color:#64748b;">No hay productos cargados aún.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
