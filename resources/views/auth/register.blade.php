@extends('layout.main')
@section('titulo', 'Crear Cuenta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.login.css') }}">
@endpush

@section('contenido')
<div class="login-page">
    <div class="login-wrapper">

        {{-- Logo --}}
        <div class="login-logo">
            <a href="/">GAMING<span class="text-mars">STATION</span></a>
        </div>

        {{-- Tarjeta del formulario --}}
        <div class="login-card">

            <h1 class="login-card-title">Crear Cuenta</h1>
            <p class="login-card-subtitle">Únete a <span class="text-mars fw-bold">GamingStation</span></p>

            @if($errors->any())
            <div class="login-alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16" style="flex-shrink:0; margin-top:1px;">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                <ul class="mb-0 ps-2" style="list-style: disc;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="/register" method="POST">
                @csrf

                <div class="login-field">
                    <label class="login-label" for="nombre">Nombre completo</label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre') }}"
                           class="login-input @error('nombre') is-invalid @enderror"
                           placeholder="Juan Pérez"
                           required
                           autofocus>
                </div>

                <div class="login-field">
                    <label class="login-label" for="email">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="login-input @error('email') is-invalid @enderror"
                           placeholder="tu@email.com"
                           required>
                </div>

                <div class="login-field">
                    <label class="login-label" for="password">Contraseña</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="login-input @error('password') is-invalid @enderror"
                           placeholder="Mínimo 8 caracteres"
                           required>
                </div>

                <div class="login-field">
                    <label class="login-label" for="password_confirmation">Confirmar contraseña</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="login-input"
                           placeholder="••••••••"
                           required>
                </div>

                <button type="submit" class="btn btn-mars w-100 fw-semibold py-2 mt-1">
                    Crear Cuenta
                </button>
            </form>

            <hr class="login-divider">

            <p class="login-footer-text">
                ¿Ya tenés cuenta?
                <a href="/login" class="text-mars fw-semibold text-decoration-none">Iniciar Sesión</a>
            </p>

        </div>
    </div>
</div>
@endsection
