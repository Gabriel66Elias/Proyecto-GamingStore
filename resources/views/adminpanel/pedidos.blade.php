@extends('layout.main')
@section('titulo', 'Gestor de Pedidos — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilos.pedidos-admin.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Gestor de Pedidos</h1>
            <p class="admin-page-subtitle">Seguimiento y gestión de órdenes de compra</p>
        </div>

        <div class="pedido-export-box">
            <p class="pedido-export-heading">Descargar registro de ventas</p>
            <form action="{{ route('admin.pedidos.exportar-pdf') }}" method="GET" class="pedido-export-form">
                <div class="pedido-export-field">
                    <label for="export-desde">Desde</label>
                    <div class="pedido-date-wrap">
                        <input type="date" name="desde" id="export-desde" class="admin-form-input pedido-date-input">
                        <button type="button" class="pedido-date-clear" data-clear-target="export-desde" title="Limpiar fecha" aria-label="Limpiar fecha">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="pedido-export-field">
                    <label for="export-hasta">Hasta</label>
                    <div class="pedido-date-wrap">
                        <input type="date" name="hasta" id="export-hasta" class="admin-form-input pedido-date-input">
                        <button type="button" class="pedido-date-clear" data-clear-target="export-hasta" title="Limpiar fecha" aria-label="Limpiar fecha">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="pedido-export-field">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-admin-outline px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg>
                        Descargar PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Stats ──────────────────────────────────────────────────────────── --}}
    <div class="pedido-stats">
        <div class="pedido-stat-card">
            <div class="pedido-stat-val">{{ $stats['total'] }}</div>
            <div class="pedido-stat-label">Total pedidos</div>
        </div>
        <div class="pedido-stat-card">
            <div class="pedido-stat-val" style="color:#fbbf24;">{{ $stats['pendiente'] }}</div>
            <div class="pedido-stat-label">Pendientes</div>
        </div>
        <div class="pedido-stat-card">
            <div class="pedido-stat-val" style="color:#60a5fa;">{{ $stats['en_proceso'] }}</div>
            <div class="pedido-stat-label">En proceso</div>
        </div>
        <div class="pedido-stat-card">
            <div class="pedido-stat-val" style="color:#a78bfa;">{{ $stats['enviado'] }}</div>
            <div class="pedido-stat-label">En camino</div>
        </div>
    </div>

    {{-- Tarjetas de pedido ──────────────────────────────────────────────── --}}
    @if($pedidos->isEmpty())
        <div class="admin-card">
            <div class="admin-empty-state">
                <div class="admin-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                    </svg>
                </div>
                <p class="text-white fw-semibold mb-1">No hay pedidos registrados</p>
                <p class="text-secondary small mb-0">Los pedidos confirmados aparecerán aquí.</p>
            </div>
        </div>
    @else
        <div class="row g-3 g-md-4">
            @foreach($pedidos as $pedido)
            @php
                $primerItem  = $pedido->detalles->first();
                $primerProd  = $primerItem?->producto;
                $extraItems  = $pedido->detalles->count() - 1;
                $pagoPendiente = $pedido->metodo_pago === 'transferencia' && in_array($pedido->estado, ['pendiente','confirmado']);
            @endphp
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="pedido-card" onclick="verDetalle({{ $pedido->id }})" title="Ver detalle del pedido">

                    <div class="pedido-card-top">
                        <div class="pedido-card-img-wrap">
                            @if($primerProd && $primerProd->imagen)
                                <img src="{{ asset('storage/' . $primerProd->imagen) }}" class="pedido-card-img" alt="{{ $primerProd->nombre }}">
                            @else
                                <div class="pedido-card-img-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                                    </svg>
                                </div>
                            @endif
                            @if($extraItems > 0)
                                <span class="pedido-card-extra">+{{ $extraItems }}</span>
                            @endif
                        </div>

                        <div class="pedido-card-main">
                            <div class="d-flex align-items-start justify-content-between gap-2">
                                <span class="pedido-card-numero">{{ $pedido->numero_pedido ?? '#' . $pedido->id }}</span>
                                <span id="sbadge-{{ $pedido->id }}"
                                      class="badge-estado {{ \App\Models\VentaCabecera::estadoBadgeClass($pedido->estado) }} flex-shrink-0">
                                    {{ \App\Models\VentaCabecera::estadoLabel($pedido->estado) }}
                                </span>
                            </div>
                            <div class="pedido-card-cliente">
                                {{ $pedido->nombre_cliente ?? $pedido->usuario?->nombre ?? '—' }}
                                {{ $pedido->apellido_cliente ?? '' }}
                            </div>
                            <div class="pedido-card-fecha">
                                {{ $pedido->fecha_venta?->format('d/m/Y H:i') ?? $pedido->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="pedido-card-footer">
                        <span class="text-secondary" style="font-size:.78rem;">
                            {{ $pedido->detalles->count() }} producto{{ $pedido->detalles->count() !== 1 ? 's' : '' }}
                        </span>
                        <span class="pedido-card-total">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                    </div>

                    @if($pagoPendiente)
                    <div class="pedido-card-flag">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        Pago por transferencia pendiente de confirmación
                    </div>
                    @endif

                </div>
            </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        @if($pedidos->hasPages())
        <div class="admin-pagination-wrapper mt-4" style="background-color:#11131A; border:1px solid #1f222e; border-radius:14px;">
            {{ $pedidos->links() }}
        </div>
        @endif
    @endif

</div>

{{-- ── MODAL CONFIRMAR PAGO ────────────────────────────────────────────────── --}}
<div class="modal fade modal-cpago" id="modalConfirmarPago" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <div style="width:64px;height:64px;background:rgba(251,191,36,.1);border:2px solid rgba(251,191,36,.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.2rem;">
                    <img src="{{ asset('assets/bank.svg') }}" style="width:28px;filter:invert(.9) sepia(1) saturate(2) hue-rotate(-10deg);">
                </div>
                <h6 class="fw-bold text-white mb-2">Confirmar pago recibido</h6>
                <p class="text-secondary mb-0" style="font-size:.83rem;" id="cpago-info">¿Confirmar que se recibió la transferencia de este pedido?</p>
            </div>
            <div class="modal-footer" style="justify-content:center;gap:.75rem;">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btn-cpago-ok"
                        class="btn btn-sm fw-bold px-4"
                        style="background:#fbbf24;color:#0d0f18;border:none;border-radius:7px;">
                    <img src="{{ asset('assets/check2.svg') }}" style="width:12px;filter:brightness(0);margin-right:4px;vertical-align:middle;">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── MODAL DETALLE PEDIDO ────────────────────────────────────────────────── --}}
<div class="modal fade modal-pedido" id="modalDetalle" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-titulo">Detalle del Pedido</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="modal-body">
                <div class="text-center text-secondary py-4">Cargando...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@php
$_pd = [];
foreach ($pedidos as $_p) {
    $_items = [];
    foreach ($_p->detalles as $_d) {
        $_prod   = $_d->producto;
        $_items[] = [
            'nombre'   => $_prod ? $_prod->nombre : 'Producto eliminado',
            'imagen'   => ($_prod && $_prod->imagen) ? asset('storage/' . $_prod->imagen) : asset('assets/placeholder-producto.svg'),
            'cantidad' => $_d->cantidad,
            'precio'   => (float) $_d->precio_unitario,
            'subtotal' => (float) $_d->subtotal,
        ];
    }
    $_usu = $_p->usuario;
    $_pd[$_p->id] = [
        'id'             => $_p->id,
        'numero_pedido'  => $_p->numero_pedido ?? '#' . $_p->id,
        'nombre_cliente' => trim(($_p->nombre_cliente ?? ($_usu ? $_usu->nombre : '—')) . ' ' . ($_p->apellido_cliente ?? '')),
        'email_cliente'  => $_p->email_cliente ?? ($_usu ? $_usu->email : '—'),
        'telefono'       => $_p->telefono_cliente ?? '—',
        'tipo_envio'     => $_p->tipo_envio,
        'transporte'     => $_p->transporte,
        'provincia'      => $_p->provincia,
        'localidad'      => $_p->localidad,
        'calle'          => $_p->calle,
        'codigo_postal'  => $_p->codigo_postal,
        'metodo_pago'    => $_p->metodo_pago,
        'codigo_seguimiento' => $_p->codigo_seguimiento,
        'costo_envio'    => (float) $_p->costo_envio,
        'total'          => (float) $_p->total,
        'estado'         => $_p->estado,
        'fecha'          => $_p->fecha_venta ? $_p->fecha_venta->format('d/m/Y H:i') : $_p->created_at->format('d/m/Y H:i'),
        'items'          => $_items,
    ];
}
@endphp

@push('scripts')
<script>
const PEDIDOS_DATA = {!! json_encode($_pd, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!};
</script>
<script src="{{ asset('js/pedidos-admin.js') }}"></script>
@endpush
@endsection
