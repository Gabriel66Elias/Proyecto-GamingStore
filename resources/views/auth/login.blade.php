@extends('layout.main')
@section('titulo', 'Iniciar Sesión')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.login.css') }}">
@endpush

@section('contenido')

{{-- Toast recuperación de contraseña --}}
<div id="toast-recovery" class="login-toast" role="alert" aria-live="polite">
    <div class="login-toast-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
        </svg>
    </div>
    <div class="login-toast-body">
        <strong>Código enviado</strong>
        <span id="toast-msg">Revisá tu bandeja de entrada.</span>
    </div>
    <button class="login-toast-close" onclick="closeToast()" aria-label="Cerrar">&#x2715;</button>
    <div class="login-toast-progress" id="toast-progress"></div>
</div>

<div class="login-page">
    <div class="login-wrapper">

        <div class="login-logo">
            <a href="/">GAMING<span class="text-mars">STATION</span></a>
        </div>

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
                           autofocus
                           oninput="updateForgotBtn()">
                </div>

                <div class="login-field">
                    <div class="login-field-row">
                        <label class="login-label" for="password">Contraseña</label>
                        <button type="button"
                                id="forgot-btn"
                                class="login-forgot-btn disabled"
                                onclick="forgotPassword()">
                            ¿Olvidaste tu contraseña?
                        </button>
                    </div>
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

@push('scripts')
<script src="{{ asset('js/login.js') }}"></script>
@endpush

@endsection
