@extends('layout.main')
@section('titulo', 'Contacto | GamingStation')

@section('contenido')
<div class="container mt-5 mb-5">

    <div class="mb-4">
        <a href="/" class="ip-back-link">
            <img src="{{ asset('assets/caret-left.svg') }}" alt="" style="width:16px;height:16px;filter:invert(0.6);">
            Volver al inicio
        </a>
    </div>

    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="text-white fw-black display-5 tracking-tighter mb-3">CONTACTO Y UBICACIÓN</h1>
            <p class="ip-muted mb-0">Estamos aquí para asesorarte en el armado de tu próximo setup.</p>
            <div class="ip-title-line"></div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Información Legal --}}
        <div class="col-12 col-lg-5">
            <div class="card card-contacto h-100 shadow-lg">
                <div class="card-body p-4 p-lg-5">
                    <h3 class="ip-card-title">Información Legal</h3>

                    <div class="mb-4">
                        <div class="ip-info-row">
                            <span class="ip-info-key">Titular</span>
                            <span>Juan Pérez</span>
                        </div>
                        <div class="ip-info-row">
                            <span class="ip-info-key">Razón Social</span>
                            <span>GamingStation S.R.L.</span>
                        </div>
                        <div class="ip-info-row">
                            <span class="ip-info-key">Domicilio</span>
                            <span>Av. 25 de Mayo 1234, Corrientes</span>
                        </div>
                        <div class="ip-info-row">
                            <span class="ip-info-key">Teléfono</span>
                            <span>+54 379 4123456</span>
                        </div>
                        <div class="ip-info-row">
                            <span class="ip-info-key">Email</span>
                            <span>ventas@gamingstation.com.ar</span>
                        </div>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin-bottom:1.5rem;">

                    <h4 class="ip-card-title" style="font-size:1.1rem;">Nuestras Redes</h4>
                    <p class="ip-text mb-4">Seguinos para enterarte de los últimos ingresos de consolas y hardware de alto rendimiento.</p>

                    <div class="d-flex gap-4">
                        <a href="https://www.instagram.com" class="social-link" target="_blank" title="Instagram">
                            <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram" class="icono-red" style="width:28px;filter:invert(1);transition:opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        </a>
                        <a href="https://www.facebook.com" class="social-link" target="_blank" title="Facebook">
                            <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook" class="icono-red" style="width:28px;filter:invert(1);transition:opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        </a>
                        <a href="https://wa.me/543794123456" class="social-link" target="_blank" title="WhatsApp">
                            <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp" class="icono-red" style="width:28px;filter:invert(1);transition:opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        </a>
                        <a href="mailto:ventas@gamingstation.com.ar" class="social-link" title="Enviar Correo">
                            <img src="{{ asset('assets/envelope-at.svg') }}" alt="Correo" class="icono-red" style="width:28px;filter:invert(1);transition:opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulario --}}
        <div class="col-12 col-lg-7">
            <div class="card card-contacto h-100 shadow-lg">
                <div class="card-body p-4 p-lg-5">
                    <h3 class="ip-card-title">Envianos tu consulta</h3>

                    <form action="{{ url('/contacto') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="ip-form-label">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control input-dark" placeholder="Ej: José García" required>
                        </div>
                        <div class="mb-4">
                            <label class="ip-form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control input-dark" placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="ip-form-label">¿En qué podemos ayudarte?</label>
                            <textarea name="mensaje" class="form-control input-dark" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-mars btn-lg w-100 py-3 fw-bold" style="border-radius:0.8rem; letter-spacing:0.5px;">
                            ENVIAR MENSAJE
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
