
     @extends('layout.main')

     @section('titulo', 'Finalizar Compra')
     
     @section('contenido')
     
         {{-- ESTILOS SCOPED: Clases CSS específicas para darle el aspecto 
              "Premium Gaming" a los pasos del formulario. --}}
         <style>
             .card-checkout {
                 height: auto !important;
                 background-color: #11131A !important;
                 border: 1px solid #1f222e !important;
                 border-radius: 1rem;
             }
     
             .card-checkout:hover {
                 transform: none !important;
                 border-color: #2d3748 !important;
             }
     
             /* Clase utilitaria fundamental: JS la usará para mostrar/ocultar paneles */
             .seccion-oculta {
                 display: none;
             }
     
             /* TRUCO UX/UI: Ocultamos el 'radio button' nativo y estilizamos 
                su etiqueta (label) para que parezca un botón gigante y clickeable. */
             .btn-check-label {
                 transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                 cursor: pointer;
                 border: 2px solid #1f222e;
                 background-color: #1a1d27;
                 border-radius: 0.8rem;
             }
     
             .btn-check-label:hover {
                 border-color: #FF3B3B;
                 background-color: #242836;
             }
     
             /* Pseudo-clase :checked + hermano adyacente: Si el radio está seleccionado, 
                pinta el label de rojo y lo eleva. */
             .btn-check:checked+.btn-check-label {
                 border: 2px solid #FF3B3B !important;
                 background-color: rgba(255, 59, 59, 0.1) !important;
                 transform: translateY(-3px);
                 box-shadow: 0 6px 15px rgba(255, 59, 59, 0.2);
             }
     
             .header-checkout {
                 background-color: #0b0c10;
                 border-bottom: 1px solid #1f222e;
                 border-radius: 1rem 1rem 0 0;
             }
     
             .icon-opcion {
                 width: 32px;
                 height: 32px;
                 padding: 6px;
                 border-radius: 8px;
                 background-color: rgba(255, 255, 255, 0.05);
                 transition: all 0.3s ease;
             }
     
             /* Invierte el color del icono (a blanco puro) cuando se selecciona */
             .btn-check:checked+.btn-check-label .icon-opcion {
                 background-color: #FF3B3B;
                 filter: invert(1);
             }
     
             .logo-transporte {
                 height: 30px;
                 width: auto;
                 max-width: 100%;
                 object-fit: contain;
                 filter: brightness(1.2);
             }
         </style>
     
         <div class="container mt-5 mb-5">
             <h2 class="fw-black mb-4 text-uppercase tracking-tighter display-6 text-white">Finalizar <span class="text-mars">Compra</span></h2>
     
             {{-- FORMULARIO PRINCIPAL: Engloba todos los pasos. --}}
             <form id="form-checkout">
                 @csrf {{-- Protección nativa de Laravel contra ataques de falsificación de peticiones --}}
     
                 <div class="row g-4">
                     
                     {{-- COLUMNA IZQUIERDA: Pasos del Checkout (8 de 12 columnas en PC) --}}
                     <div class="col-lg-8">
     
                         {{-- ==========================================
                              PASO 1: DATOS DE FACTURACIÓN
                              ========================================== --}}
                         <div class="card card-checkout mb-4 shadow-lg">
                             <div class="header-checkout py-3 px-4">
                                 <h5 class="mb-0 fw-bold text-white d-flex align-items-center">
                                     <img src="{{ asset('assets/person-circle.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                                     1. Datos de Facturación
                                 </h5>
                             </div>
                             <div class="card-body p-4">
                                 <div class="row g-3">
                                     {{-- VALIDACIÓN HTML5: required obliga a rellenar, maxlength limita caracteres, type="email" valida formato --}}
                                     <div class="col-md-6">
                                         <label class="form-label text-secondary fw-bold small text-uppercase">Nombre</label>
                                         <input type="text" class="form-control input-dark" required maxlength="50">
                                     </div>
                                     <div class="col-md-6">
                                         <label class="form-label text-secondary fw-bold small text-uppercase">Apellido</label>
                                         <input type="text" class="form-control input-dark" required maxlength="50">
                                     </div>
                                     <div class="col-md-6">
                                         <label class="form-label text-secondary fw-bold small text-uppercase">Email</label>
                                         <input type="email" class="form-control input-dark" required maxlength="100">
                                     </div>
                                     <div class="col-md-6">
                                         <label class="form-label text-secondary fw-bold small text-uppercase">Teléfono</label>
                                         <input type="tel" class="form-control input-dark" placeholder="Ej: 3794123456" required maxlength="15">
                                     </div>
                                 </div>
                             </div>
                         </div>
     
                         {{-- ==========================================
                              PASO 2: MÉTODO DE ENVÍO
                              ========================================== --}}
                         <div class="card card-checkout mb-4 shadow-lg">
                             <div class="header-checkout py-3 px-4">
                                 <h5 class="mb-0 fw-bold text-white d-flex align-items-center">
                                     <img src="{{ asset('assets/boxes.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                                     2. Método de Envío
                                 </h5>
                             </div>
                             <div class="card-body p-4">
                                 <div class="row g-3">
     
                                     {{-- Opción: Retiro en Local --}}
                                     <div class="col-12">
                                         <input type="radio" class="btn-check" name="tipo_envio" id="radioRetiro" value="retiro" required autocomplete="off">
                                         <label class="btn btn-check-label w-100 p-3 text-start d-flex justify-content-between align-items-center" for="radioRetiro">
                                             <div class="d-flex align-items-center gap-3">
                                                 <div class="icon-opcion d-flex justify-content-center align-items-center">
                                                     <img src="{{ asset('assets/shop.svg') }}" style="width: 20px; filter: invert(1);">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-5">Retiro en Local</strong><br>
                                                     <small class="text-secondary">Av. 25 de Mayo 1234, Corrientes</small>
                                                 </div>
                                             </div>
                                             <span class="text-success fw-bold fs-5">Gratis</span>
                                         </label>
                                     </div>
     
                                     {{-- Opción: Envío a Domicilio --}}
                                     <div class="col-12">
                                         <input type="radio" class="btn-check" name="tipo_envio" id="radioEnvio" value="domicilio" autocomplete="off">
                                         <label class="btn btn-check-label w-100 p-3 text-start d-flex justify-content-between align-items-center" for="radioEnvio">
                                             <div class="d-flex align-items-center gap-3">
                                                 <div class="icon-opcion d-flex justify-content-center align-items-center">
                                                     <img src="{{ asset('assets/truck.svg') }}" style="width: 20px; filter: invert(1);">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-5">Envío a Domicilio</strong><br>
                                                     <small class="text-secondary">Entrega en la puerta de tu casa</small>
                                                 </div>
                                             </div>
                                             <span id="label-precio-envio" class="text-secondary small">Selecciona transporte...</span>
                                         </label>
                                     </div>
                                 </div>
     
                                 {{-- PANEL DINÁMICO DE DOMICILIO: Inicia oculto. JS lo mostrará si eligen "Envío a Domicilio" --}}
                                 <div id="seccion-domicilio" class="seccion-oculta mt-4 pt-4 border-top border-secondary border-opacity-25">
                                     <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Selecciona el transporte:</h6>
     
                                     <div class="row g-3 mb-4">
                                         <div class="col-md-6">
                                             <input type="radio" class="btn-check" name="envio_precio" id="transAndreani" value="10500" autocomplete="off">
                                             <label class="btn btn-check-label h-100 w-100 p-3 text-start d-flex align-items-center gap-3" for="transAndreani">
                                                 <div style="width: 70px; flex-shrink: 0;" class="text-center">
                                                     <img src="{{ asset('img/anlogo.webp') }}" class="logo-transporte" alt="Andreani">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-6 d-block mb-1">Andreani</strong>
                                                     <span class="text-success fw-bold">$10.500</span>
                                                 </div>
                                             </label>
                                         </div>
     
                                         <div class="col-md-6">
                                             <input type="radio" class="btn-check" name="envio_precio" id="transCorreo" value="11000" autocomplete="off">
                                             <label class="btn btn-check-label h-100 w-100 p-3 text-start d-flex align-items-center gap-3" for="transCorreo">
                                                 <div style="width: 70px; flex-shrink: 0;" class="text-center">
                                                     <img src="{{ asset('img/calogo.webp') }}" class="logo-transporte" alt="Correo Argentino">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-6 d-block mb-1">Correo Argentino</strong>
                                                     <span class="text-success fw-bold">$11.000</span>
                                                 </div>
                                             </label>
                                         </div>
                                     </div>
     
                                     <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Dirección de entrega:</h6>
                                     <div class="row g-3">
                                         <div class="col-md-6">
                                             <label class="small text-secondary fw-bold mb-1 text-uppercase">Provincia</label>
                                             {{-- La clase .input-domicilio permite que JS los haga obligatorios (required) en bloque --}}
                                             <select class="form-select input-dark input-domicilio">
                                                 <option selected disabled value="">Seleccione...</option>
                                                 <option>Buenos Aires</option>
                                                 <option>CABA</option>
                                                 <option>Corrientes</option>
                                                 {{-- Resto de provincias omitidas por brevedad --}}
                                             </select>
                                         </div>
                                         <div class="col-md-6">
                                             <label class="small text-secondary fw-bold mb-1 text-uppercase">Localidad</label>
                                             <input type="text" class="form-control input-dark input-domicilio" maxlength="50">
                                         </div>
                                         <div class="col-md-9">
                                             <label class="small text-secondary fw-bold mb-1 text-uppercase">Calle y Altura</label>
                                             <input type="text" class="form-control input-dark input-domicilio" maxlength="100">
                                         </div>
                                         <div class="col-md-3">
                                             <label class="small text-secondary fw-bold mb-1 text-uppercase">Codigo Postal</label>
                                             <input type="text" class="form-control input-dark input-domicilio" maxlength="8">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
     
                         {{-- ==========================================
                              PASO 3: MÉTODO DE PAGO
                              ========================================== --}}
                         <div class="card card-checkout mb-4 shadow-lg">
                             <div class="header-checkout py-3 px-4">
                                 <h5 class="mb-0 fw-bold text-white d-flex align-items-center">
                                     <img src="{{ asset('assets/credit-card.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                                     3. Método de Pago
                                 </h5>
                             </div>
                             <div class="card-body p-4">
                                 <div class="row g-3">
                                     
                                     {{-- Opción: Tarjeta --}}
                                     <div class="col-12">
                                         <input type="radio" class="btn-check" name="metodo_pago" id="pagoTarjeta" value="tarjeta" required autocomplete="off">
                                         <label class="btn btn-check-label w-100 p-3 text-start" for="pagoTarjeta">
                                             <div class="d-flex align-items-center gap-3">
                                                 <div class="icon-opcion d-flex justify-content-center align-items-center">
                                                     <img src="{{ asset('assets/credit-card-fill.svg') }}" style="width: 20px; filter: invert(1);">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-5">Tarjeta de Crédito o Débito</strong><br>
                                                     <small class="text-secondary">Pagos seguros con cifrado bancario</small>
                                                 </div>
                                             </div>
                                         </label>
                                     </div>
     
                                     {{-- PANEL DINÁMICO DE TARJETA --}}
                                     <div id="form-tarjeta" class="seccion-oculta col-12 p-4 rounded mt-3 shadow-lg" style="background-color: #0b0c10; border: 1px solid #1f222e;">
                                         <div class="row g-3">
                                             <div class="col-12">
                                                 <label class="small text-secondary fw-bold mb-1 text-uppercase">Nombre y Apellido</label>
                                                 <input type="text" class="form-control input-dark" placeholder="Ej: JUAN PEREZ" id="card-name" maxlength="50">
                                             </div>
                                             <div class="col-12">
                                                 <label class="small text-secondary fw-bold mb-1 text-uppercase">Número de Tarjeta</label>
                                                 <input type="text" class="form-control input-dark" placeholder="0000 0000 0000 0000" id="card-number" maxlength="19">
                                             </div>
                                             <div class="col-md-6">
                                                 <label class="small text-secondary fw-bold mb-1 text-uppercase">Vencimiento</label>
                                                 <input type="text" class="form-control input-dark" placeholder="MM/AA" id="card-expiry" maxlength="5">
                                             </div>
                                             <div class="col-md-6">
                                                 <label class="small text-secondary fw-bold mb-1 text-uppercase">CVC / CVV</label>
                                                 <input type="text" class="form-control input-dark" placeholder="***" id="card-cvv" maxlength="3">
                                             </div>
                                         </div>
                                     </div>
     
                                     {{-- Opción: Transferencia --}}
                                     <div class="col-12">
                                         <input type="radio" class="btn-check" name="metodo_pago" id="pagoTransf" value="transferencia" autocomplete="off">
                                         <label class="btn btn-check-label w-100 p-3 text-start mt-2" for="pagoTransf">
                                             <div class="d-flex align-items-center gap-3">
                                                 <div class="icon-opcion d-flex justify-content-center align-items-center">
                                                     <img src="{{ asset('assets/bank.svg') }}" style="width: 20px; filter: invert(1);">
                                                 </div>
                                                 <div>
                                                     <strong class="text-white fs-5">Transferencia Bancaria</strong><br>
                                                     <small class="text-secondary">Abona directamente a nuestra cuenta bancaria</small>
                                                 </div>
                                             </div>
                                         </label>
                                     </div>
     
                                     {{-- PANEL DINÁMICO DE TRANSFERENCIA --}}
                                     <div id="info-transferencia" class="seccion-oculta col-12 p-4 rounded mt-3 shadow-lg" style="background-color: #0b0c10; border: 1px solid #1f222e;">
                                         <div class="d-flex flex-column flex-md-row align-items-center gap-4 text-start">
                                             <div style="width: 120px; flex-shrink: 0;" class="text-center">
                                                 <img src="{{ asset('img/malogo.webp') }}" class="img-fluid" alt="Banco Macro" style="max-height: 60px; filter: brightness(1.1);">
                                             </div>
                                             <div class="border-start border-secondary border-opacity-25 ps-md-4">
                                                 <p class="mb-3 text-mars fw-bold small text-uppercase" style="letter-spacing: 1px;">Datos de la cuenta receptora:</p>
                                                 <h6 class="text-white mb-2">Banco: <span class="fw-normal text-secondary">Macro</span></h6>
                                                 <h6 class="text-white mb-2">Titular: <span class="fw-normal text-secondary">Carlos López</span></h6>
                                                 <h6 class="text-white mb-2">CUIL: <span class="fw-normal text-secondary">20-12345678-9</span></h6>
                                                 <h6 class="text-white mb-2">CBU: <span class="fw-normal text-secondary">00000031000123456789</span></h6>
                                                 <h6 class="text-white mb-0">Alias: <span class="fw-normal text-secondary">GAMING.STATION.MP</span></h6>
                                             </div>
                                         </div>
                                     </div>
     
                                 </div>
                             </div>
                         </div>
                     </div>
     
                     {{-- ==========================================
                          COLUMNA DERECHA: RESUMEN DE ORDEN
                          ========================================== --}}
                     <div class="col-lg-4">
                         {{-- sticky-top: Mantiene el ticket pegado al hacer scroll --}}
                         <div class="card card-checkout border-0 shadow-lg sticky-top" style="top: 120px; z-index: 10;">
                             <div class="card-body p-4">
                                 <h4 class="fw-black mb-4 border-bottom border-secondary border-opacity-25 pb-3 text-uppercase text-white">
                                     Resumen de Orden
                                 </h4>
     
                                 {{-- JS inyectará los productos aquí --}}
                                 <div id="checkout-items" class="mb-4"></div>
     
                                 <div class="border-top border-secondary border-opacity-25 pt-4">
                                     <div class="d-flex justify-content-between mb-2 text-secondary fw-medium">
                                         <span>Subtotal</span>
                                         <span id="checkout-subtotal" class="text-white">$0</span>
                                     </div>
                                     <div class="d-flex justify-content-between mb-3 text-secondary fw-medium">
                                         <span>Envío</span>
                                         <span id="checkout-envio" class="text-white">$0</span>
                                     </div>
                                     <div class="d-flex justify-content-between mt-4 fs-3">
                                         <span class="fw-black text-white">Total</span>
                                         <span id="checkout-total" class="text-success fw-black">$0</span>
                                     </div>
                                 </div>
     
                                 <button type="submit" class="btn btn-mars w-100 py-3 fw-bold mt-4 shadow-lg" style="font-size: 1.1rem; letter-spacing: 1px; border-radius: 0.8rem;">
                                     PAGAR AHORA
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     
         {{-- INTEGRACIÓN LIMPIA: Ahora todo el comportamiento (Behavior) vive aquí --}}
         <script src="{{ asset('js/comercializacion.js') }}"></script>
     
     @endsection