@extends('layout.main')
@section('titulo', 'Gestión de Consultas — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
<style>
    /* ── Cards de consulta ── */
    .consulta-card {
        background-color: #11131A;
        border: 1px solid #1f222e;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        transition: border-color 0.2s ease;
    }
    .consulta-card.no-leida {
        border-left: 3px solid #FF3B3B;
    }
    .consulta-card.leida {
        border-left: 3px solid #1f222e;
        opacity: 0.75;
    }

    /* ── Badge NUEVO ── */
    .badge-nuevo {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        background: rgba(255,59,59,0.12);
        color: #FF3B3B;
        border: 1px solid rgba(255,59,59,0.3);
        border-radius: 6px;
        padding: 2px 8px;
        white-space: nowrap;
        transition: opacity 0.3s ease;
    }

    /* ── Botones de acción en consulta ── */
    .consulta-actions {
        display: flex;
        gap: 0.5rem;
        flex-shrink: 0;
    }
    .btn-consulta {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.9rem;
        border-radius: 8px;
        border: 1px solid #1f222e;
        background-color: #1a1d27;
        color: #94a3b8;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-consulta:hover {
        border-color: rgba(255,59,59,0.4);
        color: #FF3B3B;
        background-color: rgba(255,59,59,0.07);
    }
    .btn-consulta-reply:hover {
        border-color: rgba(96,165,250,0.4);
        color: #60a5fa;
        background-color: rgba(96,165,250,0.07);
    }
    .btn-consulta-delete:hover {
        border-color: rgba(255,59,59,0.4);
        color: #FF3B3B;
        background-color: rgba(255,59,59,0.07);
    }

    /* ── Datos del remitente ── */
    .consulta-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        color: #64748b;
        flex-wrap: wrap;
    }
    .consulta-nombre {
        font-size: 0.95rem;
        font-weight: 700;
        color: #e2e8f0;
    }
    .consulta-mensaje {
        font-size: 0.88rem;
        color: #94a3b8;
        line-height: 1.65;
        white-space: pre-line;
        margin: 0;
    }
    .consulta-fecha {
        font-size: 0.75rem;
        color: #3d4659;
        white-space: nowrap;
    }

    /* ── Modal de respuesta ── */
    .modal-consulta .modal-content {
        background-color: #11131A;
        border: 1px solid #1f222e;
        border-radius: 16px;
    }
    .modal-consulta .modal-header {
        border-bottom: 1px solid #1f222e;
        padding: 1.25rem 1.5rem;
    }
    .modal-consulta .modal-title {
        font-size: 1rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.3px;
    }
    .modal-consulta .btn-close {
        filter: invert(0.5);
        opacity: 0.6;
    }
    .modal-consulta .btn-close:hover { opacity: 1; }
    .modal-consulta .modal-body {
        padding: 1.5rem;
    }
    .modal-consulta .modal-footer {
        border-top: 1px solid #1f222e;
        padding: 1rem 1.5rem;
        gap: 0.5rem;
    }

    .modal-remitente-card {
        background-color: #0b0c10;
        border: 1px solid #1f222e;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .modal-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255,59,59,0.1);
        border: 1px solid rgba(255,59,59,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
        font-weight: 800;
        color: #FF3B3B;
    }
    .modal-remitente-info { min-width: 0; }
    .modal-remitente-nombre {
        font-size: 0.9rem;
        font-weight: 700;
        color: #e2e8f0;
        margin: 0;
    }
    .modal-remitente-email {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0;
        word-break: break-all;
    }

    .modal-mensaje-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #3d4659;
        margin-bottom: 0.5rem;
    }
    .modal-mensaje-body {
        background-color: #0b0c10;
        border: 1px solid #1f222e;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: #c8cad4;
        line-height: 1.65;
        white-space: pre-line;
        max-height: 220px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #1f222e transparent;
    }
    .modal-mensaje-body::-webkit-scrollbar { width: 4px; }
    .modal-mensaje-body::-webkit-scrollbar-thumb { background-color: #1f222e; border-radius: 4px; }

    .btn-mailto {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #FF3B3B;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 700;
        text-decoration: none;
        transition: background-color 0.2s ease, transform 0.15s ease;
        white-space: nowrap;
    }
    .btn-mailto:hover {
        background-color: #e02e2e;
        color: #fff;
        transform: translateY(-1px);
    }
    .btn-modal-close {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background-color: transparent;
        color: #64748b;
        border: 1px solid #1f222e;
        border-radius: 8px;
        padding: 0.6rem 1.1rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-modal-close:hover {
        border-color: #3d4659;
        color: #94a3b8;
    }

    /* ── Responsive ── */
    @media (max-width: 575px) {
        .consulta-card { padding: 1rem; border-radius: 10px; }
        .consulta-actions { width: 100%; margin-top: 0.75rem; }
        .btn-consulta { flex: 1; justify-content: center; padding: 0.5rem 0.5rem; }
        .modal-consulta .modal-body { padding: 1.1rem; }
        .modal-consulta .modal-header,
        .modal-consulta .modal-footer { padding: 1rem; }
        .modal-remitente-card { padding: 0.85rem 1rem; }
        .btn-mailto { width: 100%; justify-content: center; }
        .btn-modal-close { width: 100%; justify-content: center; }
    }
</style>
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
<script>
(function () {
    let formPendiente = null;
    const modalEliminarEl = document.getElementById('modalEliminar');
    if (modalEliminarEl) {
        const modalEliminar = new bootstrap.Modal(modalEliminarEl);

        document.querySelectorAll('[data-confirmar-eliminar]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                formPendiente = document.getElementById(this.dataset.confirmarEliminar);
                document.getElementById('modal-eliminar-title').textContent = this.dataset.titulo || 'Eliminar elemento';
                document.getElementById('modal-eliminar-desc').textContent  = this.dataset.desc   || 'Esta acción no se puede deshacer.';
                modalEliminar.show();
            });
        });

        document.getElementById('btn-confirm-eliminar').addEventListener('click', function () {
            if (formPendiente) { formPendiente.submit(); formPendiente = null; }
        });
    }
})();

(function () {
    const modal = document.getElementById('modalResponder');
    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (e) {
        const btn     = e.relatedTarget;
        const id      = btn.dataset.id;
        const nombre  = btn.dataset.nombre;
        const email   = btn.dataset.email;
        const mensaje = btn.dataset.mensaje;
        const leida   = btn.dataset.leida === '1';
        const leidaUrl = btn.dataset.leidaUrl;

        // Poblar modal
        document.getElementById('modal-avatar').textContent  = nombre.charAt(0).toUpperCase();
        document.getElementById('modal-nombre').textContent  = nombre;
        document.getElementById('modal-email').textContent   = email;
        document.getElementById('modal-mensaje').textContent = mensaje;

        // Gmail compose URL (abre en el navegador)
        const asunto = encodeURIComponent('Re: Tu consulta en GamingStation');
        const cuerpo = encodeURIComponent(
            'Hola ' + nombre + ',\n\nGracias por comunicarte con GamingStation.\n\n' +
            '---\nTu mensaje original:\n' + mensaje + '\n---\n\n'
        );
        document.getElementById('btn-mailto').href =
            'https://mail.google.com/mail/?view=cm&to=' + encodeURIComponent(email) +
            '&su=' + asunto + '&body=' + cuerpo;

        // Marcar como leída si todavía no lo está
        if (!leida) {
            fetch(leidaUrl, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(function (res) {
                if (res.ok) {
                    // Quitar badge NUEVO
                    const badge = document.getElementById('badge-' + id);
                    if (badge) badge.remove();

                    // Cambiar estilo de la card
                    const card = document.getElementById('consulta-' + id);
                    if (card) {
                        card.classList.remove('no-leida');
                        card.classList.add('leida');
                    }

                    // Actualizar data attr para que no vuelva a disparar
                    btn.dataset.leida = '1';

                    // Actualizar contador en el subtítulo
                    const sinLeerSpan = document.querySelector('.admin-page-subtitle span[style*="FF3B3B"]');
                    if (sinLeerSpan) {
                        const actual = parseInt(sinLeerSpan.textContent) - 1;
                        if (actual <= 0) {
                            sinLeerSpan.parentElement
                                .querySelector('span[style*="FF3B3B"]')
                                ?.previousSibling?.remove();
                            sinLeerSpan.remove();
                        } else {
                            sinLeerSpan.textContent = actual + ' sin leer';
                        }
                    }
                }
            });
        }
    });
})();
</script>
@endpush

@endsection
