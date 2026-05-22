@extends('layout.main')
@section('titulo', 'Gestión de Productos — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="admin-page-title">Gestión de Productos</h1>
                <p class="admin-page-subtitle">{{ $productos->total() }} productos en el catálogo</p>
            </div>
            <a href="{{ route('admin.productos.crear') }}" class="btn btn-mars d-flex align-items-center gap-2" style="font-size: 0.85rem; padding: 0.55rem 1.1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
                Nuevo Producto
            </a>
        </div>

        @if(session('success'))
        <div class="admin-flash admin-flash-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio compra</th>
                        <th>Precio venta</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($p->imagen)
                                    <img src="{{ asset('storage/' . $p->imagen) }}" class="prod-thumb" alt="{{ $p->nombre }}">
                                @else
                                    <div class="prod-thumb-placeholder">?</div>
                                @endif
                                <div>
                                    <p class="fw-semibold mb-0" style="color:#e2e8f0; font-size: 0.875rem;">{{ $p->nombre }}</p>
                                    <span style="font-size: 0.72rem; color:#64748b;">ID #{{ $p->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="cat-badge">{{ $p->categoria?->nombre }}</span></td>
                        <td style="color:#94a3b8;">${{ number_format($p->precio_compra, 2) }}</td>
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
                        <td>
                            <div class="d-flex gap-1">
                                {{-- Ver en tienda --}}
                                <a href="/consulta/{{ $p->id }}" target="_blank" class="btn-accion btn-accion-ok" title="Ver en tienda">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </a>
                                {{-- Editar --}}
                                <a href="{{ route('admin.productos.editar', $p->id) }}" class="btn-accion" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg>
                                </a>
                                {{-- Eliminar --}}
                                <form action="{{ route('admin.productos.destroy', $p->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar {{ addslashes($p->nombre) }}? Esta acción es reversible desde la base de datos.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-accion" title="Eliminar" style="border: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-empty-state">
                                <div class="admin-empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5"/>
                                    </svg>
                                </div>
                                <p class="text-white fw-semibold mb-1">No hay productos cargados</p>
                                <p class="text-secondary small mb-3">Empezá agregando tu primer producto al catálogo.</p>
                                <a href="{{ route('admin.productos.crear') }}" class="btn btn-mars btn-sm px-4">Crear primer producto</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($productos->hasPages())
            <div class="d-flex justify-content-center py-3" style="border-top: 1px solid #1f222e;">
                {{ $productos->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
