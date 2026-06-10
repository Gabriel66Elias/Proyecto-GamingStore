@extends('layout.main')
@section('titulo', 'Nuevo Usuario — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-content">

    <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="admin-page-title">Nuevo Usuario</h1>
            <p class="admin-page-subtitle">Creá una cuenta y asignale un rol</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn-accion d-flex align-items-center gap-2 px-3" style="width:auto; height:36px; font-size:0.8rem; color:#94a3b8; text-decoration:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            Volver
        </a>
    </div>

    @if($errors->any())
    <div class="admin-flash admin-flash-error">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>
        Revisá los errores en el formulario antes de continuar.
    </div>
    @endif

    @php
        $rolId  = old('rol_id');
        $rolNom = $rolId ? ($roles->firstWhere('id', (int) $rolId)?->nombre ?? null) : null;
    @endphp

    <form action="{{ route('usuarios.store') }}" method="POST" class="mx-auto" style="max-width: 520px;">
        @csrf

        <div class="admin-card mb-4">

            <div class="mb-3">
                <label class="admin-form-label">Nombre *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       class="admin-form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                       placeholder="Ej: Juan Pérez">
                @error('nombre')<p class="admin-field-error">{{ $message }}</p>@enderror
            </div>

            <div class="mb-3">
                <label class="admin-form-label">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="admin-form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       placeholder="usuario@correo.com">
                @error('email')<p class="admin-field-error">{{ $message }}</p>@enderror
            </div>

            <div class="mb-3">
                <label class="admin-form-label">Contraseña *</label>
                <input type="password" name="password"
                       class="admin-form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Mínimo 8 caracteres">
                @error('password')<p class="admin-field-error">{{ $message }}</p>@enderror
            </div>

            <div class="mb-3">
                <label class="admin-form-label">Confirmar contraseña *</label>
                <input type="password" name="password_confirmation"
                       class="admin-form-input"
                       placeholder="Repetí la contraseña">
            </div>

            <div class="mb-3">
                <label class="admin-form-label">Rol *</label>
                <input type="hidden" name="rol_id" id="rol_id_input" value="{{ $rolId }}">
                <div class="dropdown w-100">
                    <button type="button"
                            id="dropdownRol"
                            class="btn w-100 text-start d-flex justify-content-between align-items-center admin-cat-btn {{ $errors->has('rol_id') ? 'is-invalid-custom' : '' }} {{ !$rolNom ? 'placeholder-active' : '' }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <span id="rol_label">{{ $rolNom ? ucfirst($rolNom) : 'Seleccioná un rol' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="opacity:0.5; flex-shrink:0;">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu w-100 admin-cat-menu" aria-labelledby="dropdownRol">
                        @foreach($roles as $rol)
                        <li>
                            <a href="#"
                               class="dropdown-item admin-cat-item {{ (string) $rolId === (string) $rol->id ? 'active' : '' }}"
                               data-value="{{ $rol->id }}"
                               data-label="{{ ucfirst($rol->nombre) }}">
                                {{ ucfirst($rol->nombre) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @error('rol_id')<p class="admin-field-error">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn btn-mars w-100">Guardar usuario</button>
        </div>
    </form>

</div>

@push('scripts')
<script src="{{ asset('js/usuario-form.js') }}"></script>
@endpush
@endsection
