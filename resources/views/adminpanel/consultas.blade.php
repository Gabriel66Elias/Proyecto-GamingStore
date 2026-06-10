@extends('layout.main')
@section('titulo', 'Gestión de Consultas — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilos.consultas-admin.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header">
        <h1 class="admin-page-title">Gestión de Consultas</h1>
        <p class="admin-page-subtitle">
            {{ $consultas->total() }} mensaje(s) recibidos
            @php $sinLeer = $consultas->getCollection()->where('leida', false)->count(); @endphp
            @if($sinLeer > 0)
                &mdash; <span style="color:#FF3B3B; font-weight:600;">{{ $sinLeer }} sin leer</span>
            @endif
            &mdash; {{ $resenas->total() }} reseña(s) de productos
        </p>
    </div>

    {{-- Flash de éxito --}}
    @if(session('success'))
    <div class="admin-flash admin-flash-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabs: Mensajes / Reseñas --}}
    <ul class="nav admin-tabs mb-4" id="consultasTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-mensajes" data-bs-toggle="tab" data-bs-target="#pane-mensajes" type="button" role="tab" aria-controls="pane-mensajes" aria-selected="true">
                Mensajes
                <span class="admin-tab-count">{{ $consultas->total() }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-resenas" data-bs-toggle="tab" data-bs-target="#pane-resenas" type="button" role="tab" aria-controls="pane-resenas" aria-selected="false">
                Reseñas
                <span class="admin-tab-count">{{ $resenas->total() }}</span>
            </button>
        </li>
    </ul>

    <div class="tab-content">
    <div class="tab-pane fade show active" id="pane-mensajes" role="tabpanel" aria-labelledby="tab-mensajes">

    {{-- Lista de consultas --}}
    <div class="d-flex flex-column gap-3">
        @forelse($consultas as $c)
        <div class="consulta-card {{ $c->leida ? 'leida' : 'no-leida' }}" id="consulta-{{ $c->id }}">

            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">

                {{-- Información principal --}}
                <div style="min-width: 0; flex: 1;">

                    {{-- Nombre + badge --}}
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="consulta-nombre">{{ $c->nombre }}</span>
                        @if(!$c->leida)
                        <span class="badge-nuevo" id="badge-{{ $c->id }}">NUEVO</span>
                        @endif
                    </div>

                    {{-- Email + fecha --}}
                    <div class="consulta-meta mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="opacity:0.5; flex-shrink:0;">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                        </svg>
                        <span>{{ $c->email }}</span>
                        <span style="color:#1f222e;">·</span>
                        <span class="consulta-fecha">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16" style="margin-right:3px; opacity:0.4;">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            {{ $c->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span style="color:#1f222e;">·</span>
                        <span style="font-size:0.72rem; color:#2d3347; font-family:monospace;">ID #{{ $c->id }}</span>
                    </div>

                    {{-- Mensaje --}}
                    <p class="consulta-mensaje">{{ Str::limit($c->mensaje, 200) }}</p>

                </div>

                {{-- Acciones --}}
                <div class="consulta-actions">

                    {{-- Botón Responder → abre modal --}}
                    <button type="button"
                            class="btn-consulta btn-consulta-reply"
                            data-bs-toggle="modal"
                            data-bs-target="#modalResponder"
                            data-id="{{ $c->id }}"
                            data-nombre="{{ $c->nombre }}"
                            data-email="{{ $c->email }}"
                            data-mensaje="{{ $c->mensaje }}"
                            data-leida="{{ $c->leida ? '1' : '0' }}"
                            data-leida-url="{{ route('admin.consultas.leida', $c->id) }}"
                            title="Responder consulta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                        </svg>
                        Responder
                    </button>

                    {{-- Botón Eliminar --}}
                    <form action="{{ route('admin.consultas.destroy', $c->id) }}" method="POST"
                          id="form-eliminar-{{ $c->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn-consulta btn-consulta-delete"
                                title="Eliminar consulta"
                                data-confirmar-eliminar="form-eliminar-{{ $c->id }}"
                                data-titulo="Eliminar consulta de {{ addslashes($c->nombre) }}"
                                data-desc="Esta acción no se puede deshacer.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @empty
        <div class="admin-table-wrapper">
            <div class="admin-empty-state">
                <div class="admin-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    </svg>
                </div>
                <p class="text-white fw-semibold mb-1">Sin consultas por el momento</p>
                <p class="text-secondary small mb-0">Cuando los usuarios envíen mensajes desde el formulario de contacto, aparecerán aquí.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    @if($consultas->hasPages())
    <div class="admin-pagination-wrapper mt-4" style="background-color:#11131A; border:1px solid #1f222e; border-radius:14px;">
        {{ $consultas->links() }}
    </div>
    @endif

    </div>

    {{-- ── Pestaña: Reseñas ──────────────────────────────── --}}
    <div class="tab-pane fade" id="pane-resenas" role="tabpanel" aria-labelledby="tab-resenas">

    <div class="d-flex flex-column gap-3">
        @forelse($resenas as $r)
        <div class="consulta-card resena-card" id="resena-{{ $r->id }}">
            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">

                {{-- Información principal --}}
                <div style="min-width: 0; flex: 1;">

                    {{-- Nombre + estrellas --}}
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="consulta-nombre">{{ $r->usuario?->nombre ?? 'Usuario eliminado' }}</span>
                        <x-estrellas :calificacion="$r->calificacion" :size="13" />
                    </div>

                    {{-- Producto + fecha --}}
                    <div class="consulta-meta mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="opacity:0.5; flex-shrink:0;">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                        </svg>
                        <span>{{ $r->producto?->nombre ?? 'Producto eliminado' }}</span>
                        <span style="color:#1f222e;">·</span>
                        <span class="consulta-fecha">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 16 16" style="margin-right:3px; opacity:0.4;">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            {{ $r->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    {{-- Comentario --}}
                    @if($r->comentario)
                        <p class="consulta-mensaje">{{ $r->comentario }}</p>
                    @else
                        <p class="consulta-mensaje fst-italic" style="opacity:.6;">Sin comentario, solo calificación.</p>
                    @endif

                </div>

                {{-- Acciones --}}
                <div class="consulta-actions">
                    <form action="{{ route('admin.resenas.destroy', $r->id) }}" method="POST"
                          id="form-eliminar-resena-{{ $r->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn-consulta btn-consulta-delete"
                                title="Eliminar reseña"
                                data-confirmar-eliminar="form-eliminar-resena-{{ $r->id }}"
                                data-titulo="Eliminar reseña de {{ addslashes($r->usuario?->nombre ?? 'usuario') }}"
                                data-desc="Esta acción no se puede deshacer.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="admin-table-wrapper">
            <div class="admin-empty-state">
                <div class="admin-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                </div>
                <p class="text-white fw-semibold mb-1">Todavía no hay reseñas</p>
                <p class="text-secondary small mb-0">Cuando un cliente complete un pedido, podrá calificar sus productos y aparecerán aquí.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    @if($resenas->hasPages())
    <div class="admin-pagination-wrapper mt-4" style="background-color:#11131A; border:1px solid #1f222e; border-radius:14px;">
        {{ $resenas->links() }}
    </div>
    @endif

    </div>
    </div>

</div>

{{-- ════════════════════════════════════════════════════════
     MODAL DE CONFIRMACIÓN DE ELIMINACIÓN
     ════════════════════════════════════════════════════════ --}}
<div class="modal fade modal-eliminar" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="modal-eliminar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FF3B3B" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                </div>
                <p class="modal-eliminar-title" id="modal-eliminar-title">Eliminar consulta</p>
                <p class="modal-eliminar-desc" id="modal-eliminar-desc">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-delete" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                    Cancelar
                </button>
                <button type="button" class="btn-confirm-delete" id="btn-confirm-eliminar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     MODAL DE RESPUESTA
     ════════════════════════════════════════════════════════ --}}
<div class="modal fade modal-consulta" id="modalResponder" tabindex="-1" aria-labelledby="modalResponderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 540px;">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalResponderLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#FF3B3B" viewBox="0 0 16 16" style="margin-right:6px; margin-top:-2px;">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                    </svg>
                    Responder consulta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">

                {{-- Remitente --}}
                <div class="modal-remitente-card">
                    <div class="modal-avatar" id="modal-avatar">J</div>
                    <div class="modal-remitente-info">
                        <p class="modal-remitente-nombre" id="modal-nombre">—</p>
                        <p class="modal-remitente-email" id="modal-email">—</p>
                    </div>
                </div>

                {{-- Mensaje original --}}
                <p class="modal-mensaje-label">Mensaje recibido</p>
                <div class="modal-mensaje-body" id="modal-mensaje">—</div>

            </div>

            <div class="modal-footer flex-wrap">
                <button type="button" class="btn-modal-close" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                    Cerrar
                </button>
                <a href="#" id="btn-mailto" class="btn-mailto" target="_blank" rel="noopener">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                    </svg>
                    Responder por Gmail
                </a>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/consultas-admin.js') }}"></script>
@endpush

@endsection
