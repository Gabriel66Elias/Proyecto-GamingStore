@extends('layout.main')
@section('titulo', 'Finalizar Compra')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.comercializacion.css') }}">
@endpush

@section('contenido')

<div class="co-page">
<div class="container">

    {{-- ── HEADER ────────────────────────────────────────────────── --}}
    <div class="mb-4">
        <a href="/catalogo" class="text-secondary text-decoration-none d-inline-flex align-items-center gap-2 mb-3" style="font-size:.85rem;">
            <img src="{{ asset('assets/caret-left.svg') }}" style="width:14px;filter:invert(.5);">
            Volver al catálogo
        </a>
        <h2 class="fw-black text-white mb-0" style="font-size:1.8rem;letter-spacing:-1px;">
            Finalizar <span class="text-mars">Compra</span>
        </h2>
    </div>

    {{-- ── STEPS ──────────────────────────────────────────────────── --}}
    <div class="co-steps">
        <div class="co-step active" id="step-1">
            <div class="co-step-num">1</div>
            <span class="co-step-label">Datos</span>
        </div>
        <div class="co-step-line"></div>
        <div class="co-step" id="step-2">
            <div class="co-step-num">2</div>
            <span class="co-step-label">Envío</span>
        </div>
        <div class="co-step-line"></div>
        <div class="co-step" id="step-3">
            <div class="co-step-num">3</div>
            <span class="co-step-label">Pago</span>
        </div>
    </div>

    <form id="form-checkout">
        @csrf
        <div class="row g-4">

            {{-- ── COLUMNA IZQUIERDA ──────────────────────────────── --}}
            <div class="col-lg-8">

                {{-- PASO 1: FACTURACIÓN ─────────────────────────────── --}}
                <div class="co-card">
                    <div class="co-card-head">
                        <div class="co-step-badge">1</div>
                        <h5>Datos de Facturación</h5>
                    </div>
                    <div class="co-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="co-label">Nombre</label>
                                <input id="billing-nombre" type="text" class="form-control co-input" placeholder="Ej: Lucas" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="co-label">Apellido</label>
                                <input id="billing-apellido" type="text" class="form-control co-input" placeholder="Ej: González" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="co-label">Email</label>
                                <input id="billing-email" type="email" class="form-control co-input" placeholder="tu@email.com" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="co-label">Teléfono</label>
                                <input id="billing-telefono" type="tel" class="form-control co-input" placeholder="Ej: 3794123456" required maxlength="20">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PASO 2: MÉTODO DE ENVÍO ─────────────────────────── --}}
                <div class="co-card">
                    <div class="co-card-head">
                        <div class="co-step-badge">2</div>
                        <h5>Método de Envío</h5>
                    </div>
                    <div class="co-card-body">
                        <div class="row g-3">

                            {{-- Opción: Retiro --}}
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="tipo_envio" id="radioRetiro" value="retiro" required autocomplete="off" checked>
                                <label class="co-opt-label" for="radioRetiro">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="co-opt-icon">
                                            <img src="{{ asset('assets/shop.svg') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.92rem;">Retiro en Local</div>
                                            <div class="text-secondary" style="font-size:.78rem;">Av. 25 de Mayo 1234, Corrientes Capital</div>
                                        </div>
                                    </div>
                                    <span class="text-success fw-bold" style="font-size:.95rem;">Gratis</span>
                                </label>
                            </div>

                            {{-- Opción: Domicilio --}}
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="tipo_envio" id="radioEnvio" value="domicilio" autocomplete="off">
                                <label class="co-opt-label" for="radioEnvio">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="co-opt-icon">
                                            <img src="{{ asset('assets/truck.svg') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.92rem;">Envío a Domicilio</div>
                                            <div class="text-secondary" style="font-size:.78rem;">Envíos a todo el país</div>
                                        </div>
                                    </div>
                                    <span id="label-costo-envio" class="text-secondary" style="font-size:.8rem;">Calculá tu envío →</span>
                                </label>
                            </div>

                        </div>

                        {{-- Sección domicilio (aparece al elegir envío) --}}
                        <div id="seccion-domicilio" class="co-domicilio">

                            {{-- Calculadora CP ─────────────────────── --}}
                            <div class="co-cp-box">
                                <label class="co-label mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="#64748b" viewBox="0 0 16 16" style="margin-right:5px;vertical-align:middle;flex-shrink:0;"><path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                                    Calculá el costo de envío por Código Postal
                                </label>
                                <div class="d-flex gap-2">
                                    <input id="input-cp" type="text" class="form-control co-input" placeholder="Ej: 3400 o 1005" maxlength="8" style="max-width:160px;">
                                    <button type="button" id="btn-calcular-cp" class="btn btn-sm fw-bold px-3" style="background:#1c1f2e;border:1px solid #2a2d3e;color:#e2e8f0;border-radius:8px;font-size:.82rem;white-space:nowrap;">
                                        Calcular
                                    </button>
                                </div>
                                <div id="cp-result" class="co-cp-result"></div>
                            </div>

                            {{-- Transporte y dirección (aparece tras calcular CP) --}}
                            <div id="seccion-transportes" style="display:none;">

                            {{-- Selección de transporte ─────────────── --}}
                            <p class="co-label mb-2">Seleccioná el transporte:</p>
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="transporte" id="transAndreani" value="Andreani" data-costo="0" autocomplete="off">
                                    <label class="co-carrier-label" for="transAndreani">
                                        <div class="co-carrier-logo">
                                            <img src="{{ asset('img/anlogo.webp') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.85rem;">Andreani</div>
                                            <div id="precio-andreani" class="co-carrier-price text-success">—</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="transporte" id="transCorreo" value="Correo Argentino" data-costo="0" autocomplete="off">
                                    <label class="co-carrier-label" for="transCorreo">
                                        <div class="co-carrier-logo">
                                            <img src="{{ asset('img/calogo.webp') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.85rem;">Correo Argentino</div>
                                            <div id="precio-correo" class="co-carrier-price text-success">—</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Dirección ──────────────────────────── --}}
                            <p class="co-label mb-2">Dirección de entrega:</p>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="co-label">Provincia</label>
                                    <div class="dropdown prov-dropdown-wrap">
                                        <button type="button"
                                                id="dropdownProvincia"
                                                class="co-input w-100 d-flex justify-content-between align-items-center"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                style="cursor:pointer;height:auto!important;">
                                            <span id="texto-provincia" style="color:#374151;">Seleccioná...</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#64748b" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu w-100"
                                            aria-labelledby="dropdownProvincia"
                                            style="background:#11131a;border:1px solid #2d313f;border-radius:.6rem;padding:.3rem 0;box-shadow:0 12px 30px rgba(0,0,0,.8);max-height:240px;overflow-y:auto;">
                                            @foreach(['Buenos Aires','CABA','Catamarca','Chaco','Chubut','Córdoba','Corrientes','Entre Ríos','Formosa','Jujuy','La Pampa','La Rioja','Mendoza','Misiones','Neuquén','Río Negro','Salta','San Juan','San Luis','Santa Cruz','Santa Fe','Santiago del Estero','Tierra del Fuego','Tucumán'] as $prov)
                                            <li>
                                                <a class="dropdown-item prov-item" href="#" data-prov="{{ $prov }}"
                                                   style="color:#94a3b8;padding:.4rem 1rem;font-size:.85rem;transition:all .15s;">
                                                    {{ $prov }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" id="envio-provincia" class="co-dom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="co-label">Localidad</label>
                                    <input id="envio-localidad" type="text" class="form-control co-input co-dom" placeholder="Ciudad / Barrio" maxlength="80">
                                </div>
                                <div class="col-md-8">
                                    <label class="co-label">Calle y Altura</label>
                                    <input id="envio-calle" type="text" class="form-control co-input co-dom" placeholder="Ej: Av. Corrientes 1234, Piso 3" maxlength="120">
                                </div>
                                <div class="col-md-4">
                                    <label class="co-label">Código Postal</label>
                                    <input id="envio-cp-final" type="text" class="form-control co-input co-dom" placeholder="Ej: 3400" maxlength="10">
                                </div>
                            </div>

                            </div>{{-- /seccion-transportes --}}
                        </div>
                    </div>
                </div>

                {{-- PASO 3: MÉTODO DE PAGO ──────────────────────────── --}}
                <div class="co-card">
                    <div class="co-card-head">
                        <div class="co-step-badge">3</div>
                        <h5>Método de Pago</h5>
                    </div>
                    <div class="co-card-body">
                        <div class="row g-3">

                            {{-- Tarjeta --}}
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="metodo_pago" id="pagoTarjeta" value="tarjeta" required autocomplete="off">
                                <label class="co-opt-label" for="pagoTarjeta">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="co-opt-icon">
                                            <img src="{{ asset('assets/credit-card-fill.svg') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.92rem;">Tarjeta de Crédito / Débito</div>
                                            <div class="text-secondary" style="font-size:.78rem;">Visa, Mastercard, Cabal — hasta 12 cuotas sin interés</div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <img src="{{ asset('img/visa.svg') }}" style="height:18px;opacity:.6;" onerror="this.style.display='none'">
                                        <img src="{{ asset('img/mc.svg') }}" style="height:18px;opacity:.6;" onerror="this.style.display='none'">
                                    </div>
                                </label>
                            </div>

                            {{-- Card form --}}
                            <div class="col-12 co-card-form" id="form-tarjeta">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="co-label">Nombre en la Tarjeta</label>
                                        <input type="text" class="form-control co-input" id="card-name" placeholder="NOMBRE APELLIDO" maxlength="50">
                                    </div>
                                    <div class="col-12">
                                        <label class="co-label">Número de Tarjeta</label>
                                        <input type="text" class="form-control co-input" id="card-number" placeholder="0000 0000 0000 0000" maxlength="19">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="co-label">Vencimiento</label>
                                        <input type="text" class="form-control co-input" id="card-expiry" placeholder="MM/AA" maxlength="5">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="co-label">CVV</label>
                                        <input type="text" class="form-control co-input" id="card-cvv" placeholder="•••" maxlength="4">
                                    </div>
                                </div>
                            </div>

                            {{-- Transferencia --}}
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="metodo_pago" id="pagoTransf" value="transferencia" autocomplete="off">
                                <label class="co-opt-label" for="pagoTransf">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="co-opt-icon">
                                            <img src="{{ asset('assets/bank.svg') }}">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white" style="font-size:.92rem;">Transferencia Bancaria</div>
                                            <div class="text-secondary" style="font-size:.78rem;">5% de descuento al abonar por transferencia</div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            {{-- Bank info --}}
                            <div class="col-12 co-bank-info" id="info-transferencia">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="co-bank-logo">
                                        <img src="{{ asset('img/malogo.webp') }}" alt="Banco Macro" onerror="this.parentElement.style.display='none'">
                                    </div>
                                    <div style="border-left:1px solid #1c1f2e;padding-left:1rem;">
                                        <p class="mb-2" style="font-size:.72rem;font-weight:700;color:#FF3B3B;text-transform:uppercase;letter-spacing:1px;">Datos para transferir:</p>
                                        <div class="d-flex flex-column gap-1">
                                            <span style="font-size:.83rem;color:#94a3b8;">Banco: <strong class="text-white">Macro</strong></span>
                                            <span style="font-size:.83rem;color:#94a3b8;">Titular: <strong class="text-white">Carlos López</strong></span>
                                            <span style="font-size:.83rem;color:#94a3b8;">CBU: <strong class="text-white">00000031000123456789</strong></span>
                                            <span style="font-size:.83rem;color:#94a3b8;">Alias: <strong class="text-white">GAMING.STATION.MP</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- ── COLUMNA DERECHA: RESUMEN ────────────────────────── --}}
            <div class="col-lg-4">
                <div class="co-summary">
                    <div class="co-summary-head">
                        <h6 class="fw-bold text-white mb-0 text-uppercase" style="font-size:.82rem;letter-spacing:1px;">Resumen del pedido</h6>
                    </div>
                    <div class="co-summary-body">

                        {{-- Items (JS los inyecta aquí) --}}
                        <div id="checkout-items" class="mb-3"></div>

                        <hr class="co-divider">

                        <div class="co-total-row">
                            <span class="co-total-label">Subtotal productos</span>
                            <span id="checkout-subtotal" class="co-total-val">$0</span>
                        </div>
                        <div class="co-total-row">
                            <span class="co-total-label">Envío</span>
                            <span id="checkout-envio" class="co-total-val">Gratis</span>
                        </div>

                        <hr class="co-divider">

                        <div class="co-total-row">
                            <span class="co-grand-total">Total</span>
                            <span id="checkout-total" class="co-grand-val">$0</span>
                        </div>

                        <button type="submit" id="btn-pagar" class="co-btn-pay mt-4">
                            <img src="{{ asset('assets/lock.svg') }}" style="width:13px;filter:invert(1);margin-right:6px;vertical-align:middle;" onerror="this.style.display='none'">
                            Pagar ahora
                        </button>

                        @guest
                        <div id="auth-notice" style="display:none;background:rgba(251,191,36,.07);border:1px solid rgba(251,191,36,.2);border-radius:10px;padding:.9rem 1rem;margin-top:.75rem;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="{{ asset('assets/person-check-fill.svg') }}" style="width:14px;filter:invert(.9) sepia(1) saturate(2) hue-rotate(-10deg);">
                                <span style="font-size:.82rem;font-weight:700;color:#fbbf24;">Iniciá sesión para continuar</span>
                            </div>
                            <p style="font-size:.78rem;color:#94a3b8;margin:0 0 .75rem;">Para finalizar la compra necesitás una cuenta.</p>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="/login" class="btn btn-sm fw-bold px-3" style="background:#FF3B3B;color:white;border-radius:7px;font-size:.8rem;">Iniciar sesión</a>
                                <a href="/register" class="btn btn-sm px-3" style="background:#1c1f2e;border:1px solid #2a2d3e;color:#e2e8f0;border-radius:7px;font-size:.8rem;">Crear cuenta</a>
                            </div>
                        </div>
                        @endguest

                        <div class="co-secure">
                            <div class="co-secure-item">
                                <img src="{{ asset('assets/shield-check.svg') }}" onerror="this.style.display='none'">
                                <span>SSL seguro</span>
                            </div>
                            <div class="co-secure-item">
                                <img src="{{ asset('assets/lock.svg') }}" onerror="this.style.display='none'">
                                <span>Datos protegidos</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
</div>

<div id="co-toast-container" style="position:fixed;top:80px;right:20px;z-index:9999;width:320px;display:flex;flex-direction:column-reverse;gap:.5rem;pointer-events:none;"></div>

{{-- ── OVERLAY: SIMULACIÓN DE PROCESAMIENTO DE PAGO (tarjeta) ──────────── --}}
<div id="pp-overlay" class="pp-overlay" style="display:none;">
    <div class="pp-box">
        <div id="pp-spinner" class="pp-spinner"></div>
        <div id="pp-success" class="pp-success" style="display:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#22c55e" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
        </div>
        <h3 id="pp-title" class="pp-title">Procesando pago...</h3>
        <p id="pp-subtitle" class="pp-subtitle">Estamos validando los datos de tu tarjeta. No cierres ni recargues esta ventana.</p>
    </div>
</div>

@push('scripts')
<script>
const USUARIO_AUTENTICADO = {{ auth()->check() ? 'true' : 'false' }};
</script>
<script src="{{ asset('js/comercializacion.js') }}"></script>
@endpush
@endsection
