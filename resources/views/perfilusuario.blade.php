@extends('layout.main')
@section('titulo', 'Mi Perfil')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.perfil.css') }}">
<style>
/* ── Badges de estado ───────────────────────────────── */
.badge-estado {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 9px; border-radius: 20px;
    font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .4px;
}
.badge-pendiente  { background: rgba(251,191,36,.12); color: #fbbf24; border: 1px solid rgba(251,191,36,.2); }
.badge-confirmado { background: rgba(251,191,36,.12); color: #fbbf24; border: 1px solid rgba(251,191,36,.2); }
.badge-en-proceso { background: rgba(59,130,246,.12);  color: #60a5fa; border: 1px solid rgba(59,130,246,.2); }
.badge-enviado    { background: rgba(139,92,246,.12);  color: #a78bfa; border: 1px solid rgba(139,92,246,.2); }
.badge-en-camino  { background: rgba(99,102,241,.12);  color: #818cf8; border: 1px solid rgba(99,102,241,.2); }
.badge-entregado  { background: rgba(20,184,166,.12);  color: #2dd4bf; border: 1px solid rgba(20,184,166,.2); }
.badge-completado { background: rgba(34,197,94,.12);   color: #4ade80; border: 1px solid rgba(34,197,94,.2); }
.badge-cancelado  { background: rgba(239,68,68,.12);   color: #f87171; border: 1px solid rgba(239,68,68,.2); }

/* ── Pedido card ────────────────────────────────────── */
.pedido-card {
    background: #0d0f18; border: 1px solid #1c1f2e; border-radius: 12px;
    margin-bottom: .9rem; overflow: hidden; transition: border-color .25s;
}
.pedido-card:hover { border-color: #2a2d3e; }
.pedido-card-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: .85rem 1.1rem; cursor: pointer; gap: .75rem; flex-wrap: wrap;
}
.pedido-num { font-size: .8rem; font-weight: 700; color: #FF3B3B; letter-spacing: .5px; }
.pedido-fecha { font-size: .75rem; color: #64748b; }
.pedido-total { font-size: .95rem; font-weight: 800; color: #e2e8f0; white-space: nowrap; }
.pedido-toggle { font-size: .72rem; color: #64748b; white-space: nowrap; }

.pedido-items { padding: 0 1.1rem 1.1rem; display: none; }
.pedido-items.open { display: block; }

.pedido-item-row { display: flex; align-items: center; gap: .75rem; padding: .55rem 0; border-bottom: 1px solid #1c1f2e; }
.pedido-item-row:last-child { border-bottom: none; }
.pedido-item-img { width: 44px; height: 44px; border-radius: 8px; background: rgba(255,255,255,.04); object-fit: contain; flex-shrink: 0; }

/* ── Envío badge ────────────────────────────────────── */
.envio-badge {
    display: inline-flex; align-items: center; gap: 4px;
    background: #1a1d27; border: 1px solid #1c1f2e; border-radius: 6px;
    padding: 3px 9px; font-size: .72rem; color: #94a3b8;
}

/* ── Favoritos ──────────────────────────────────────── */
.favorito-item {
    display: flex; align-items: center; gap: .6rem;
    padding: .5rem; border-radius: 10px;
    border: 1px solid #1c1f2e; background: #0d0f18;
    transition: border-color .25s;
}
.favorito-item:hover { border-color: #2a2d3e; }
.favorito-img {
    width: 42px; height: 42px; border-radius: 8px;
    background: rgba(255,255,255,.04); object-fit: contain; flex-shrink: 0;
}
.btn-favorito-quitar {
    position: static; flex-shrink: 0;
    width: 30px; height: 30px;
    background: rgba(255,59,59,.08); border: 1px solid rgba(255,59,59,.2);
}
.btn-favorito-quitar:hover { background: rgba(255,59,59,.18); }

/* ── Código de seguimiento ──────────────────────────── */
.tracking-box {
    background: rgba(96,165,250,.07); border: 1px solid rgba(96,165,250,.2);
    border-radius: 8px; padding: .65rem .9rem;
}
.tracking-code {
    font-family: 'Courier New', monospace; font-weight: 800; letter-spacing: 1px;
    color: #60a5fa; font-size: .9rem;
}

/* ── Descargar factura ───────────────────────────────── */
.btn-descargar-factura {
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; background: #1a1d27; border: 1px solid #1f222e; color: #e2e8f0;
    border-radius: 8px; padding: .55rem 1rem; font-size: .8rem; font-weight: 700;
    text-decoration: none; transition: all .2s ease;
}
.btn-descargar-factura:hover { border-color: #FF3B3B; color: #FF3B3B; }

/* ── Flash de éxito ──────────────────────────────────── */
.perfil-flash-success {
    display: flex; align-items: center; gap: .6rem;
    background: rgba(74,222,128,.08); border: 1px solid rgba(74,222,128,.25);
    color: #4ade80; border-radius: 10px; padding: .75rem 1.1rem;
    font-size: .85rem; font-weight: 600; margin-bottom: 1.25rem;
}

/* ── Reseñas ─────────────────────────────────────────── */
.pedido-item-block { padding: .55rem 0; border-bottom: 1px solid #1c1f2e; }
.pedido-item-block:last-child { border-bottom: none; }
.pedido-item-block .pedido-item-row { padding: 0; border-bottom: none; }

.estrellas-display { display: inline-flex; align-items: center; gap: 2px; }

.resena-box { margin-top: .65rem; padding-top: .65rem; border-top: 1px dashed #1c1f2e; }

.resena-existente { display: flex; flex-direction: column; gap: .4rem; }
.resena-comentario-existente { font-size: .8rem; color: #94a3b8; margin: 0; line-height: 1.5; }

.btn-resena-editar {
    background: transparent; border: 1px solid #1f222e; color: #64748b;
    border-radius: 6px; padding: 3px 10px; font-size: .72rem; font-weight: 600;
    cursor: pointer; transition: all .2s ease; white-space: nowrap;
}
.btn-resena-editar:hover { border-color: #2a2d3e; color: #94a3b8; }

.resena-form { display: flex; flex-direction: column; gap: .5rem; margin-top: .5rem; }
.resena-form-label {
    font-size: .72rem; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: .5px; margin: 0;
}

.estrellas-input { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 2px; }
.estrellas-input input { position: absolute; opacity: 0; pointer-events: none; }
.estrellas-input label {
    font-size: 1.45rem; line-height: 1; color: #2a2d3e;
    cursor: pointer; transition: color .15s ease;
}
.estrellas-input input:checked ~ label,
.estrellas-input label:hover,
.estrellas-input label:hover ~ label { color: #fbbf24; }

.resena-textarea {
    background: #0d0f18; border: 1px solid #1c1f2e; border-radius: 8px;
    color: #e2e8f0; padding: .6rem .75rem; font-size: .82rem; font-family: inherit;
    resize: vertical; min-height: 60px;
}
.resena-textarea:focus { outline: none; border-color: rgba(255,59,59,.35); }

.btn-resena-enviar {
    align-self: flex-start;
    background: #1a1d27; border: 1px solid #1f222e; color: #e2e8f0;
    border-radius: 8px; padding: .5rem 1.1rem; font-size: .8rem; font-weight: 700;
    cursor: pointer; transition: all .2s ease;
}
.btn-resena-enviar:hover { border-color: #FF3B3B; color: #FF3B3B; }
</style>
@endpush

@section('contenido')
<div class="perfil-wrapper">
    <div class="container">

        @if(session('success'))
        <div class="perfil-flash-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="row justify-content-center g-4">

            {{-- ── COLUMNA IZQUIERDA: Identidad ───────────────── --}}
            <div class="col-lg-4">
                <div class="perfil-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="fw-bold text-white mb-1 fs-6 text-truncate">{{ $usuario->nombre }}</p>
                            <span class="badge-rol {{ $usuario->rol?->nombre === 'admin' ? 'badge-admin' : 'badge-cliente' }}">
                                {{ $usuario->rol?->nombre ?? 'Sin rol' }}
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
                        <span class="dato-valor" style="word-break:break-all;">{{ $usuario->email }}</span>
                    </div>
                    <div class="dato-row">
                        <span class="dato-label">Miembro desde</span>
                        <span class="dato-valor">{{ $usuario->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="dato-row">
                        <span class="dato-label">Total pedidos</span>
                        <span class="dato-valor fw-bold text-white">{{ $pedidos->count() }}</span>
                    </div>
                </div>

                {{-- Favoritos --}}
                <div class="perfil-card p-4">
                    <p class="seccion-label mb-3">
                        Favoritos
                        @if($favoritos->isNotEmpty())
                            <span style="font-size:.78rem;font-weight:600;color:#64748b;">({{ $favoritos->count() }})</span>
                        @endif
                    </p>

                    @if($favoritos->isEmpty())
                        <p class="text-secondary small mb-0">Todavía no agregaste productos a tus favoritos. Tocá el corazón en cualquier producto del catálogo.</p>
                    @else
                        <div class="d-flex flex-column gap-2" id="lista-favoritos">
                            @foreach($favoritos as $producto)
                            <div class="favorito-item">
                                <a href="/consulta/{{ $producto->id }}" class="d-flex align-items-center gap-2 flex-grow-1 min-w-0 text-decoration-none">
                                    <img class="favorito-img"
                                         src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('assets/placeholder-producto.svg') }}"
                                         alt="{{ $producto->nombre }}">
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="text-white fw-semibold text-truncate" style="font-size:.83rem;">{{ $producto->nombre }}</div>
                                        <div class="text-secondary" style="font-size:.72rem;">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</div>
                                    </div>
                                    <span class="fw-bold" style="font-size:.82rem;color:#4ade80;white-space:nowrap;">${{ number_format($producto->precio_venta, 0, ',', '.') }}</span>
                                </a>
                                <button type="button" class="btn-favorito is-favorito btn-favorito-quitar" data-producto-id="{{ $producto->id }}" title="Quitar de favoritos" aria-label="Quitar de favoritos">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 16 16">
                                        <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── COLUMNA DERECHA: Historial de pedidos ───────── --}}
            <div class="col-lg-8">
                <div class="perfil-card p-4">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <p class="seccion-label mb-1">Historial</p>
                            <h5 class="fw-bold text-white mb-0" style="letter-spacing:-.5px;">
                                Mis Pedidos
                                @if($pedidos->isNotEmpty())
                                    <span class="ms-2" style="font-size:.8rem;font-weight:600;color:#64748b;">
                                        ({{ $pedidos->count() }})
                                    </span>
                                @endif
                            </h5>
                        </div>
                        <a href="/catalogo" class="btn btn-mars btn-sm px-3 py-2 d-flex align-items-center gap-2" style="font-size:.82rem;">
                            <img src="{{ asset('assets/controller.svg') }}" style="width:14px;filter:invert(1);">
                            Ver Catálogo
                        </a>
                    </div>

                    @if($pedidos->isEmpty())
                        {{-- Estado vacío --}}
                        <div class="empty-orders">
                            <div class="empty-orders-icon">
                                <img src="{{ asset('assets/cart3.svg') }}" style="width:28px;filter:invert(0.3);">
                            </div>
                            <p class="text-white fw-semibold mb-1" style="font-size:.95rem;">Todavía no realizaste pedidos</p>
                            <p class="text-secondary small mb-4">Cuando completes una compra, tu historial aparecerá aquí.</p>
                            <a href="/catalogo" class="btn btn-sm px-4 py-2 fw-semibold"
                               style="background:#1a1d27;border:1px solid #1f222e;color:#e2e8f0;border-radius:8px;font-size:.85rem;transition:border-color .3s;"
                               onmouseover="this.style.borderColor='#FF3B3B'" onmouseout="this.style.borderColor='#1f222e'">
                                Explorar productos
                            </a>
                        </div>
                    @else
                        @foreach($pedidos as $pedido)
                        @php
                            $badgeClass = \App\Models\VentaCabecera::estadoBadgeClass($pedido->estado);
                            $estadoLabel = \App\Models\VentaCabecera::estadoLabel($pedido->estado);
                            $subtotalProductos = $pedido->detalles->sum('subtotal');
                        @endphp
                        <div class="pedido-card">
                            {{-- Cabecera del pedido --}}
                            <div class="pedido-card-head" onclick="togglePedido({{ $pedido->id }})">
                                <div class="d-flex flex-column gap-1">
                                    <span class="pedido-num">
                                        {{ $pedido->numero_pedido ?? '#' . $pedido->id }}
                                    </span>
                                    <span class="pedido-fecha">
                                        {{ $pedido->fecha_venta?->format('d \d\e F \d\e Y, H:i') ?? $pedido->created_at->format('d \d\e F \d\e Y') }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    {{-- Tipo envío --}}
                                    @if($pedido->tipo_envio === 'retiro')
                                        <span class="envio-badge">
                                            <img src="{{ asset('assets/shop.svg') }}" style="width:11px;filter:invert(.5);">
                                            Retiro
                                        </span>
                                    @elseif($pedido->tipo_envio === 'domicilio')
                                        <span class="envio-badge">
                                            <img src="{{ asset('assets/truck.svg') }}" style="width:11px;filter:invert(.5);">
                                            {{ $pedido->transporte ?? 'Domicilio' }}
                                        </span>
                                    @endif

                                    {{-- Estado --}}
                                    <span class="badge-estado {{ $badgeClass }}">{{ $estadoLabel }}</span>

                                    {{-- Total --}}
                                    <span class="pedido-total">${{ number_format($pedido->total, 0, ',', '.') }}</span>

                                    {{-- Toggle --}}
                                    <span class="pedido-toggle" id="toggle-{{ $pedido->id }}">Ver detalle ↓</span>
                                </div>
                            </div>

                            {{-- Detalle de productos --}}
                            <div class="pedido-items" id="items-{{ $pedido->id }}">
                                @foreach($pedido->detalles as $detalle)
                                <div class="pedido-item-block">
                                    <div class="pedido-item-row">
                                        <img class="pedido-item-img"
                                             src="{{ $detalle->producto?->imagen ? asset('storage/' . $detalle->producto->imagen) : asset('assets/placeholder-producto.svg') }}"
                                             alt="{{ $detalle->producto?->nombre ?? 'Producto' }}">
                                        <div class="flex-grow-1">
                                            <div class="text-white fw-semibold" style="font-size:.82rem;">
                                                {{ $detalle->producto?->nombre ?? 'Producto no disponible' }}
                                            </div>
                                            <div class="text-secondary" style="font-size:.74rem;">
                                                {{ $detalle->cantidad }} × ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="text-white fw-bold" style="font-size:.85rem;white-space:nowrap;">
                                            ${{ number_format($detalle->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    @if($pedido->estado === 'completado' && $detalle->producto)
                                        @php $resenaExistente = $resenas[$pedido->id . '-' . $detalle->producto_id] ?? null; @endphp
                                        <div class="resena-box">
                                            @if($resenaExistente)
                                            <div class="resena-existente" id="resena-vista-{{ $pedido->id }}-{{ $detalle->producto_id }}">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                    <x-estrellas :calificacion="$resenaExistente->calificacion" :size="13" />
                                                    <button type="button" class="btn-resena-editar" onclick="toggleResena({{ $pedido->id }}, {{ $detalle->producto_id }})">Editar reseña</button>
                                                </div>
                                                @if($resenaExistente->comentario)
                                                <p class="resena-comentario-existente">{{ $resenaExistente->comentario }}</p>
                                                @endif
                                            </div>
                                            @endif

                                            <form action="{{ route('resenas.store') }}" method="POST"
                                                  class="resena-form {{ $resenaExistente ? 'd-none' : '' }}"
                                                  id="resena-form-{{ $pedido->id }}-{{ $detalle->producto_id }}">
                                                @csrf
                                                <input type="hidden" name="venta_id" value="{{ $pedido->id }}">
                                                <input type="hidden" name="producto_id" value="{{ $detalle->producto_id }}">
                                                <p class="resena-form-label">{{ $resenaExistente ? 'Editar tu reseña' : 'Dejá tu reseña de este producto' }}</p>
                                                <div class="estrellas-input">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="r{{ $pedido->id }}-{{ $detalle->producto_id }}-{{ $i }}" name="calificacion" value="{{ $i }}" {{ ($resenaExistente?->calificacion ?? 0) == $i ? 'checked' : '' }} required>
                                                    <label for="r{{ $pedido->id }}-{{ $detalle->producto_id }}-{{ $i }}">★</label>
                                                    @endfor
                                                </div>
                                                <textarea name="comentario" class="resena-textarea" placeholder="Contanos qué te pareció el producto (opcional)" maxlength="1000">{{ old('comentario', $resenaExistente->comentario ?? '') }}</textarea>
                                                <button type="submit" class="btn-resena-enviar">{{ $resenaExistente ? 'Actualizar reseña' : 'Enviar reseña' }}</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                @endforeach

                                {{-- Totales --}}
                                <div class="mt-2 pt-2" style="border-top:1px solid #1c1f2e;">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="font-size:.78rem;color:#64748b;">Subtotal productos</span>
                                        <span style="font-size:.8rem;color:#e2e8f0;">${{ number_format($subtotalProductos, 0, ',', '.') }}</span>
                                    </div>
                                    @if($pedido->costo_envio > 0)
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="font-size:.78rem;color:#64748b;">Costo de envío</span>
                                        <span style="font-size:.8rem;color:#e2e8f0;">${{ number_format($pedido->costo_envio, 0, ',', '.') }}</span>
                                    </div>
                                    @endif
                                    <div class="d-flex justify-content-between mt-2">
                                        <span style="font-size:.85rem;font-weight:700;color:#e2e8f0;">Total</span>
                                        <span style="font-size:.95rem;font-weight:800;color:#4ade80;">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                                    </div>

                                    {{-- Descargar factura en PDF --}}
                                    <a href="{{ route('pedidos.factura', $pedido->id) }}" class="btn-descargar-factura mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                        </svg>
                                        Descargar factura (PDF)
                                    </a>
                                </div>

                                {{-- Aviso de comprobante si el pago es por transferencia --}}
                                @if($pedido->metodo_pago === 'transferencia')
                                <div class="mt-3 pt-2" style="border-top:1px solid #1c1f2e;">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2" style="background:rgba(251,191,36,.07);border:1px solid rgba(251,191,36,.2);border-radius:8px;padding:.65rem .9rem;">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/bank.svg') }}" style="width:13px;filter:invert(.9) sepia(1) saturate(2) hue-rotate(-10deg);">
                                            <span style="font-size:.78rem;color:#fbbf24;font-weight:700;">Pago por transferencia: envianos tu comprobante</span>
                                        </div>
                                        <a href="https://www.whatsapp.com" target="_blank" rel="noopener" class="btn btn-sm fw-bold px-3 d-flex align-items-center gap-2" style="background:#25D366;color:#0b1c12;border-radius:7px;font-size:.78rem;white-space:nowrap;">
                                            <img src="{{ asset('assets/whatsapp.svg') }}" style="width:13px;">
                                            Subir comprobante
                                        </a>
                                    </div>
                                </div>
                                @endif

                                {{-- Dirección si tiene domicilio --}}
                                @if($pedido->tipo_envio === 'domicilio' && $pedido->calle)
                                <div class="mt-3 pt-2" style="border-top:1px solid #1c1f2e;">
                                    <p style="font-size:.7rem;color:#64748b;text-transform:uppercase;letter-spacing:.5px;font-weight:700;margin-bottom:.4rem;">Dirección de entrega</p>
                                    <p style="font-size:.8rem;color:#94a3b8;margin:0;">
                                        {{ $pedido->calle }}, {{ $pedido->localidad }}, {{ $pedido->provincia }} (CP: {{ $pedido->codigo_postal }})
                                    </p>
                                </div>
                                @endif

                                {{-- Código de seguimiento --}}
                                @if($pedido->codigo_seguimiento)
                                <div class="mt-3 pt-2" style="border-top:1px solid #1c1f2e;">
                                    <div class="tracking-box d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/truck.svg') }}" style="width:13px;filter:invert(.6) sepia(1) saturate(3) hue-rotate(190deg);">
                                            <span style="font-size:.78rem;color:#94a3b8;font-weight:700;">Código de seguimiento</span>
                                        </div>
                                        <span class="tracking-code">{{ $pedido->codigo_seguimiento }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePedido(id) {
    const items  = document.getElementById('items-' + id);
    const toggle = document.getElementById('toggle-' + id);
    if (!items) return;
    const open = items.classList.toggle('open');
    if (toggle) toggle.textContent = open ? 'Ocultar ↑' : 'Ver detalle ↓';
}

function toggleResena(pedidoId, productoId) {
    const vista = document.getElementById('resena-vista-' + pedidoId + '-' + productoId);
    const form  = document.getElementById('resena-form-' + pedidoId + '-' + productoId);
    if (!form) return;
    form.classList.toggle('d-none');
    if (vista) vista.classList.toggle('d-none');
}
</script>
@endpush
@endsection
