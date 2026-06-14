@extends('layout.main')
@section('titulo', 'Gestión de Usuarios — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Gestión de Usuarios</h1>
            <p class="admin-page-subtitle">{{ $usuarios->count() }} usuarios registrados</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('roles.index') }}" class="btn-admin-outline" style="font-size: 0.85rem; padding: 0.55rem 1.1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a1.5 1.5 0 0 1 1.5 1.5v4A1.5 1.5 0 0 1 14 7h-4a1.5 1.5 0 0 1-1.5-1.5zM10 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5zm-9.5 8.5A1.5 1.5 0 0 1 2 8h4a1.5 1.5 0 0 1 1.5 1.5v4A1.5 1.5 0 0 1 6 15H2a1.5 1.5 0 0 1-1.5-1.5zM2 9a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5z"/>
                </svg>
                Gestionar roles
            </a>
            <a href="{{ route('usuarios.create') }}" class="btn btn-mars d-flex align-items-center gap-2" style="font-size: 0.85rem; padding: 0.55rem 1.1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
                Nuevo Usuario
            </a>
        </div>
    </div>

    @if(session('exito'))
    <div class="admin-flash admin-flash-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        {{ session('exito') }}
    </div>
    @endif

    @if(session('error'))
    <div class="admin-flash admin-flash-error">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="admin-table-wrapper d-none d-md-block">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Registrado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <span class="cat-badge">{{ $usuario->rol?->nombre ?? 'Sin rol' }}</span>
                    </td>
                    <td>{{ $usuario->created_at?->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                              id="form-eliminar-usuario-{{ $usuario->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-accion" title="Dar de baja" style="border:none;"
                                    data-confirmar-eliminar="form-eliminar-usuario-{{ $usuario->id }}"
                                    data-titulo="Dar de baja a {{ addslashes($usuario->nombre) }}"
                                    data-desc="El usuario no podrá iniciar sesión, pero su historial se conserva.">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- VISTA MÓVIL: Sistema de Tarjetas (Se oculta en PC) --}}
    <div class="d-block d-md-none mt-3">
        <div class="row g-3">
            @forelse($usuarios as $usuario)
            <div class="col-12">
                <div class="p-3" style="background: #0d0f18; border: 1px solid #1c1f2e; border-radius: 12px;">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="pe-2 min-w-0">
                            <h6 class="text-white fw-bold mb-1 text-truncate" style="font-size: 0.95rem;">{{ $usuario->nombre }}</h6>
                            <span class="cat-badge">{{ $usuario->rol?->nombre ?? 'Sin rol' }}</span>
                        </div>
                        
                        {{-- OJO ACÁ: Le agregamos "-mobile" al ID del form para que no choque con el ID de la tabla --}}
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                              id="form-eliminar-usuario-mobile-{{ $usuario->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-accion" title="Dar de baja" style="border:none; padding: 6px; flex-shrink:0;"
                                    data-confirmar-eliminar="form-eliminar-usuario-mobile-{{ $usuario->id }}"
                                    data-titulo="Dar de baja a {{ addslashes($usuario->nombre) }}"
                                    data-desc="El usuario no podrá iniciar sesión, pero su historial se conserva.">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <div class="mt-3 pt-2" style="border-top: 1px solid #1c1f2e;">
                        <div class="d-flex align-items-center mb-1" style="font-size: 0.82rem; color: #94a3b8; word-break: break-all;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-2" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/></svg>
                            {{ $usuario->email }}
                        </div>
                        <div class="d-flex align-items-center" style="font-size: 0.82rem; color: #64748b;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-2" viewBox="0 0 16 16"><path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/></svg>
                            Registrado: {{ $usuario->created_at?->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-secondary py-4">
                No hay usuarios registrados.
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- ════════════════════════════════════════════════════════
     MODAL DE CONFIRMACIÓN DE BAJA
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
                <p class="modal-eliminar-title" id="modal-eliminar-title">Dar de baja</p>
                <p class="modal-eliminar-desc" id="modal-eliminar-desc">El usuario no podrá iniciar sesión, pero su historial se conserva.</p>
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
                    Dar de baja
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    let formPendiente = null;
    const modalEliminarEl = document.getElementById('modalEliminar');
    if (!modalEliminarEl) return;
    const modalEliminar = new bootstrap.Modal(modalEliminarEl);

    document.querySelectorAll('[data-confirmar-eliminar]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            formPendiente = document.getElementById(this.dataset.confirmarEliminar);
            document.getElementById('modal-eliminar-title').textContent = this.dataset.titulo || 'Dar de baja';
            document.getElementById('modal-eliminar-desc').textContent  = this.dataset.desc   || 'El usuario no podrá iniciar sesión, pero su historial se conserva.';
            modalEliminar.show();
        });
    });

    document.getElementById('btn-confirm-eliminar').addEventListener('click', function () {
        if (formPendiente) { formPendiente.submit(); formPendiente = null; }
    });
})();
</script>
@endpush
@endsection
