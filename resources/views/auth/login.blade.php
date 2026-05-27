@extends('layout.main')
@section('titulo', 'Iniciar Sesión')

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

            <h1 class="login-card-title">Iniciar Sesión</h1>
            <p class="login-card-subtitle">Accedé a tu cuenta para continuar</p>

            @if($errors->any())
            <div class="login-alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                {{ $errors->first() }}
            </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="login-field">
                    <label class="login-label" for="email">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="login-input @error('email') is-invalid @enderror"
                           placeholder="tu@email.com"
                           required
                           autofocus>
                </div>

                <div class="login-field">
                    <label class="login-label" for="password">Contraseña</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="login-input @error('password') is-invalid @enderror"
                           placeholder="••••••••"
                           required>
                </div>

                <button type="submit" class="btn btn-mars w-100 fw-semibold py-2 mt-1">
                    Ingresar
                </button>
            </form>

            <hr class="login-divider">

            <p class="login-footer-text">
                ¿No tenés cuenta?
                <a href="/register" class="text-mars fw-semibold text-decoration-none">Registrarse</a>
            </p>

        </div>
    </div>
</div>
@endsection
