@extends('layout.main')
@section('titulo', 'Iniciar Sesión')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card border-0 shadow-lg" style="background-color: #1a1d27; border: 1px solid #1f222e !important;">
                <div class="card-body p-4 p-md-5">

                    <h2 class="fw-bold text-white mb-1 text-center">Iniciar Sesión</h2>
                    <p class="text-secondary text-center mb-4 small">
                        Accedé a tu cuenta de <span class="text-mars fw-bold">GamingStation</span>
                    </p>

                    @if ($errors->any())
                        <div class="rounded p-3 mb-3 small" style="background-color: rgba(255,59,59,0.1); color: #ff6b6b; border: 1px solid rgba(255,59,59,0.2);">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control border-0 text-light shadow-none @error('email') is-invalid @enderror"
                                style="background-color: #11131A;"
                                placeholder="tu@email.com" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-semibold">Contraseña</label>
                            <input type="password" name="password"
                                class="form-control border-0 text-light shadow-none @error('password') is-invalid @enderror"
                                style="background-color: #11131A;"
                                placeholder="••••••••" required>
                        </div>

                        <div class="mb-4 d-flex align-items-center gap-2">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input border-secondary" style="background-color: #11131A;">
                            <label for="remember" class="text-secondary small mb-0">Recordarme</label>
                        </div>

                        <button type="submit" class="btn btn-mars w-100 fw-semibold py-2">
                            Ingresar
                        </button>
                    </form>

                    <hr style="border-color: #1f222e;" class="my-4">

                    <p class="text-center text-secondary small mb-0">
                        ¿No tenés cuenta?
                        <a href="/register" class="text-mars fw-semibold text-decoration-none">Registrarse</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
