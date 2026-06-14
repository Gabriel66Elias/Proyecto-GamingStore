@extends('layout.main')
@section('titulo', 'Gestión de Roles — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Gestión de Roles</h1>
            <p class="admin-page-subtitle">{{ $roles->count() }} roles configurados</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn-accion d-flex align-items-center gap-2 px-3" style="width:auto; height:36px; font-size:0.8rem; color:#94a3b8; text-decoration:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            Volver a usuarios
        </a>
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

    @if($errors->any())
    <div class="admin-flash admin-flash-error">
        {{ $errors->first() }}
    </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-7">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Descripción</th>
                            <th>Usuarios</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $rol)
                        <tr>
                            <td>{{ ucfirst($rol->nombre) }}</td>
                            <td>{{ $rol->descripcion ?? '—' }}</td>
                            <td>{{ $rol->usuarios_count }}</td>
                            <td class="text-end">
                                <form action="{{ route('roles.destroy', $rol->id) }}" method="POST"
                                      id="form-eliminar-rol-{{ $rol->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-accion" title="Eliminar" style="border:none;"
                                            {{ $rol->usuarios_count > 0 ? 'disabled' : '' }}
                                            data-confirmar-eliminar="form-eliminar-rol-{{ $rol->id }}"
                                            data-titulo="Eliminar el rol {{ addslashes(ucfirst($rol->nombre)) }}"
                                            data-desc="Esta acción es reversible desde la base de datos.">
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
                            <td colspan="4" class="text-center text-secondary py-4">No hay roles configurados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="admin-card">
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Nuevo rol</p>

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="admin-form-label">Nombre *</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                               class="admin-form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                               placeholder="Ej: vendedor">
                        @error('nombre')<p class="admin-field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="admin-form-label">Descripción</label>
                        <textarea name="descripcion" class="admin-form-textarea" placeholder="Descripción opcional del rol">{{ old('descripcion') }}</textarea>
                        @error('descripcion')<p class="admin-field-error">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn btn-mars w-100">Crear rol</button>
                </form>
            </div>
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
                <p class="modal-eliminar-title" id="modal-eliminar-title">Eliminar rol</p>
                <p class="modal-eliminar-desc" id="modal-eliminar-desc">Esta acción es reversible desde la base de datos.</p>
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
            document.getElementById('modal-eliminar-title').textContent = this.dataset.titulo || 'Eliminar rol';
            document.getElementById('modal-eliminar-desc').textContent  = this.dataset.desc   || 'Esta acción es reversible desde la base de datos.';
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
