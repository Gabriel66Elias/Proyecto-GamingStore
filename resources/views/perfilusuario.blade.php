@extends('layout.main')
@section('titulo', 'Mi Perfil')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.perfil.css') }}">
@endpush

@section('contenido')
<div class="perfil-wrapper">
    <div class="container">
        <div class="row justify-content-center g-4">

            {{-- ── COLUMNA IZQUIERDA: Identidad + Datos ── --}}
            <div class="col-lg-4">

                {{-- Tarjeta de identidad --}}
                <div class="perfil-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="fw-bold text-white mb-1 fs-6 text-truncate">{{ $usuario->nombre }}</p>
                            <span class="badge-rol {{ $usuario->rol->nombre === 'admin' ? 'badge-admin' : 'badge-cliente' }}">
                                {{ $usuario->rol->nombre }}
                            </span>
                        </div>
                    </div>

                    <p class="seccion-label mb-3">Información de cuenta</p>

                    <div class="dato-row">
                        <span class="dato-label">Nombre completo</span>
                        <span class="dato-valor">{{ $usuario->nombre }}</span>
                    </div>
                    <div class="dato-row">
                        <span class="dato-label">Email</span>
                        <span class="dato-valor" style="word-break: break-all;">{{ $usuario->email }}</span>
                    </div>
                    <div class="dato-row">
                        <span class="dato-label">Miembro desde</span>
                        <span class="dato-valor">{{ $usuario->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="dato-row">
                        <span class="dato-label">Contraseña</span>
                        <span class="dato-valor" style="letter-spacing: 3px; color: #64748b;">••••••••</span>
                    </div>
                </div>


            </div>

            {{-- ── COLUMNA DERECHA: Historial de pedidos ── --}}
            <div class="col-lg-8">
                <div class="perfil-card p-4 h-100">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <p class="seccion-label mb-1">Historial</p>
                            <h5 class="fw-bold text-white mb-0" style="letter-spacing: -0.5px;">Mis Pedidos</h5>
                        </div>
                        <a href="/catalogo" class="btn btn-mars btn-sm px-3 py-2 d-flex align-items-center gap-2" style="font-size: 0.82rem;">
                            <img src="{{ asset('assets/controller.svg') }}" style="width: 14px; filter: invert(1);">
                            Ver Catálogo
                        </a>
                    </div>

                    {{-- Estado vacío --}}
                    <div class="empty-orders">
                        <div class="empty-orders-icon">
                            <img src="{{ asset('assets/cart3.svg') }}" style="width: 28px; filter: invert(0.3);">
                        </div>
                        <p class="text-white fw-semibold mb-1" style="font-size: 0.95rem;">Todavía no realizaste pedidos</p>
                        <p class="text-secondary small mb-4">Cuando completes una compra, tu historial aparecerá aquí.</p>
                        <a href="/catalogo" class="btn btn-sm px-4 py-2 fw-semibold"
                           style="background-color: #1a1d27; border: 1px solid #1f222e; color: #e2e8f0; border-radius: 8px; font-size: 0.85rem; transition: border-color 0.3s ease;"
                           onmouseover="this.style.borderColor='#FF3B3B'" onmouseout="this.style.borderColor='#1f222e'">
                            Explorar productos
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
