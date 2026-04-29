
     @extends('layout.main')
     @section('titulo', 'Finalizar Compra')
     @section('contenido')
     
         {{-- ==========================================================================
              1. ESTILOS LOCALES (CSS)
              Estilos únicos para mejorar la experiencia de usuario (UX) en el formulario.
              ========================================================================== --}}
         <style>
             /* Estilo base para los bloques (pasos) del formulario */
             .card-checkout {
                 height: auto !important;
                 background-color: #11131A !important;
                 border: 1px solid #1f222e !important;
                 border-radius: 1rem;
             }
     
             .card-checkout:hover {
                 transform: none !important; /* Desactiva la elevación global para no marear al usuario al llenar datos */
                 border-color: #2d3748 !important;
             }
     
             /* Clase utilitaria de UI: Se usa con JavaScript para mostrar/ocultar paneles dinámicamente */
             .seccion-oculta {
                 display: none;
             }
     
             /* TRUCO DE UI AVANZADA: 
                Ocultamos el típico "botón de redondito" (radio button) y en su lugar 
                estilizamos su etiqueta (label) para que parezca una tarjeta clickeable gigante. */
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
     
             /* CUANDO EL RADIO ESTÁ SELECCIONADO: 
                El hermano adyacente (+) que es el label, se pinta de rojo y se eleva. */
             .btn-check:checked+.btn-check-label {
                 border: 2px solid #FF3B3B !important;
                 background-color: rgba(255, 59, 59, 0.1) !important;
                 transform: translateY(-3px);
                 box-shadow: 0 6px 15px rgba(255, 59, 59, 0.2);
             }
     
             /* Encabezado oscuro de cada paso (1. Datos, 2. Envío, etc.) */
             .header-checkout {
                 background-color: #0b0c10;
                 border-bottom: 1px solid #1f222e;
                 border-radius: 1rem 1rem 0 0;
             }
     
             /* Cuadradito que contiene el ícono dentro de las opciones de pago/envío */
             .icon-opcion {
                 width: 32px;
                 height: 32px;
                 padding: 6px;
                 border-radius: 8px;
                 background-color: rgba(255, 255, 255, 0.05);
                 transition: all 0.3s ease;
             }
     
             /* Si se selecciona, el cuadradito del ícono se pinta de rojo sólido */
             .btn-check:checked+.btn-check-label .icon-opcion {
                 background-color: #FF3B3B;
                 filter: invert(1);
             }
     
             /* Estilos para que los logos de las empresas de correo se vean bien */
             .logo-transporte {
                 height: 30px;
                 width: auto;
                 max-width: 100%;
                 object-fit: contain;
                 filter: brightness(1.2);
             }
         </style>
     
         {{-- ==========================================================================
              2. ESTRUCTURA HTML (GRILLA)
              ========================================================================== --}}
         <div class="container mt-5 mb-5">
             <h2 class="fw-black mb-4 text-uppercase tracking-tighter display-6 text-white">Finalizar <span
                     class="text-mars">Compra</span></h2>
     
             {{-- FORMULARIO MAESTRO: Envuelve todo. JS interceptará el evento "submit" de este form --}}
             <form id="form-checkout">
                 @csrf {{-- Token de seguridad de Laravel para evitar ataques CSRF --}}
     
                 <div class="row g-4">
                     
                     {{-- COLUMNA IZQUIERDA: Formulario principal (Ocupa 8 columnas en PC) --}}
                     <div class="col-lg-8">
     
                         {{-- ================= PASO 1: DATOS PERSONALES ================= --}}
                         <div class="card card-checkout mb-4 shadow-lg">
                             <div class="header-checkout py-3 px-4">
                                 <h5 class="mb-0 fw-bold text-white d-flex align-items-center">
                                     <img src="{{ asset('assets/person-circle.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                                     1. Datos de Facturación
                                 </h5>
                             </div>
                             <div class="card-body p-4">
                                 <div class="row g-3">
                                     {{-- Inputs estándar con validación HTML5 (required, maxlength, type="email") --}}
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
     
                         {{-- ================= PASO 2: MÉTODO DE ENVÍO ================= --}}
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
     
                                 {{-- SUB-PANEL DINÁMICO: Datos de Envío
                                      Empieza oculto (seccion-oculta). Se mostrará vía JS solo si eligen "Envío a Domicilio". --}}
                                 <div id="seccion-domicilio" class="seccion-oculta mt-4 pt-4 border-top border-secondary border-opacity-25">
                                     <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Selecciona el transporte:</h6>
     
                                     <div class="row g-3 mb-4">
                                         {{-- Empresa 1: Andreani --}}
                                         <div class="col-md-6">
                                             {{-- El value contiene el precio real del envío que JS va a sumar --}}
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
     
                                         {{-- Empresa 2: Correo Argentino --}}
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
     
                                     {{-- Formulario de Dirección --}}
                                     <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Dirección de entrega:</h6>
                                     <div class="row g-3">
                                         <div class="col-md-6">
                                             <label class="small text-secondary fw-bold mb-1 text-uppercase">Provincia</label>
                                             {{-- La clase 'input-domicilio' sirve para que JS los haga obligatorios (required) solo si están visibles --}}
                                             <select class="form-select input-dark input-domicilio">
                                                 <option selected disabled value="">Seleccione...</option>
                                                 <option>Buenos Aires</option>
                                                 <option>Corrientes</option>
                                                 <option>Chaco</option>
                                                 {{-- (Resto de provincias) --}}
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
     
                         {{-- ================= PASO 3: MÉTODO DE PAGO ================= --}}
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
     
                                     {{-- SUB-PANEL DINÁMICO: Formulario de Tarjeta --}}
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
     
                                     {{-- Opción: Transferencia Bancaria --}}
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
     
                                     {{-- SUB-PANEL DINÁMICO: Datos Bancarios --}}
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
     
                     {{-- COLUMNA DERECHA: Resumen de Orden (Ocupa 4 columnas en PC) --}}
                     <div class="col-lg-4">
                         {{-- sticky-top hace que la boleta se quede fija en la pantalla al scrollear hacia abajo --}}
                         <div class="card card-checkout border-0 shadow-lg sticky-top" style="top: 120px; z-index: 10;">
                             <div class="card-body p-4">
                                 <h4 class="fw-black mb-4 border-bottom border-secondary border-opacity-25 pb-3 text-uppercase text-white">Resumen de Orden</h4>
     
                                 {{-- Contenedor donde JS inyectará los productos (imagen, nombre, cantidad) --}}
                                 <div id="checkout-items" class="mb-4"></div>
     
                                 {{-- Totales calculados dinámicamente --}}
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
     
                                 {{-- Botón de envío del formulario tipo "submit" --}}
                                 <button type="submit" class="btn btn-mars w-100 py-3 fw-bold mt-4 shadow-lg"
                                     style="font-size: 1.1rem; letter-spacing: 1px; border-radius: 0.8rem;">
                                     PAGAR AHORA
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     
         {{-- ==========================================================================
              3. LOGICA JAVASCRIPT (Control del Formulario)
              ========================================================================== --}}
         <script>
             document.addEventListener('DOMContentLoaded', () => {
                 
                 // --- 1. CARGAR DATOS DEL LOCALSTORAGE ---
                 const carrito = JSON.parse(localStorage.getItem('gaming_station_cart')) || [];
                 
                 // Referencias del DOM para pintar los precios
                 const subtotalEl = document.getElementById('checkout-subtotal');
                 const envioEl = document.getElementById('checkout-envio');
                 const totalEl = document.getElementById('checkout-total');
                 
                 // Variables matemáticas globales para este script
                 let subtotal = 0;
                 let costoEnvio = 0;
     
                 // --- 2. RENDERIZAR PRODUCTOS EN EL RESUMEN ---
                 const contenedorItems = document.getElementById('checkout-items');
                 if (carrito.length === 0) {
                     // Seguridad por si acceden con el carrito vacío
                     contenedorItems.innerHTML = '<p class="text-danger small text-center fw-bold">No hay productos en el carrito.</p>';
                 } else {
                     // Método .map para dibujar una pequeña tarjeta por cada producto del carrito
                     contenedorItems.innerHTML = carrito.map(item => {
                         const totalItem = item.precio * item.cantidad;
                         subtotal += totalItem; // Va sumando al subtotal global
                         return `<div class="d-flex align-items-center mb-3">
                             <div class="p-1 rounded-3 me-3" style="width: 55px; height: 55px; background-color: rgba(255,255,255,0.05);"><img src="${item.imagen}" class="w-100 h-100 object-fit-contain"></div>
                             <div class="flex-grow-1"><h6 class="mb-1 text-white fw-bold" style="font-size: 0.9rem;">${item.nombre}</h6><small class="text-secondary">Cant: ${item.cantidad}</small></div>
                             <div class="text-white fw-bold small">$${totalItem.toLocaleString('es-AR')}</div>
                         </div>`;
                     }).join('');
                 }
     
                 // --- 3. FUNCIÓN PARA RECALCULAR TOTALES ---
                 const actualizarTotales = () => {
                     const total = subtotal + costoEnvio;
                     subtotalEl.innerText = '$' + subtotal.toLocaleString('es-AR');
                     // Si hay envío se muestra la plata, si es 0 muestra "Gratis"
                     envioEl.innerText = costoEnvio > 0 ? '+$' + costoEnvio.toLocaleString('es-AR') : 'Gratis';
                     totalEl.innerText = '$' + total.toLocaleString('es-AR');
                 };
     
                 // --- 4. LÓGICA DE CONDICIONALES PARA EL MÉTODO DE ENVÍO ---
                 const seccionDomicilio = document.getElementById('seccion-domicilio');
                 const inputsDomicilio = document.querySelectorAll('.input-domicilio');
     
                 document.querySelectorAll('input[name="tipo_envio"]').forEach(radio => {
                     radio.addEventListener('change', (e) => {
                         if (e.target.value === 'domicilio') {
                             // Muestra el formulario de dirección y vuelve obligatorios (required) los campos
                             seccionDomicilio.style.display = 'block';
                             inputsDomicilio.forEach(i => i.required = true);
                         } else {
                             // Si elige "Retiro Local", esconde el formulario y quita el estado obligatorio
                             seccionDomicilio.style.display = 'none';
                             inputsDomicilio.forEach(i => i.required = false);
                             // Resetea el precio de envío a 0 y desmarca las opciones de correo
                             costoEnvio = 0;
                             document.querySelectorAll('input[name="envio_precio"]').forEach(r => r.checked = false);
                             actualizarTotales();
                         }
                     });
                 });
     
                 // Suma el precio de Andreani o Correo Argentino cuando el usuario hace clic
                 document.querySelectorAll('input[name="envio_precio"]').forEach(radio => {
                     radio.addEventListener('change', (e) => {
                         costoEnvio = parseInt(e.target.value);
                         actualizarTotales();
                     });
                 });
     
                 // --- 5. LÓGICA DE CONDICIONALES PARA EL MÉTODO DE PAGO ---
                 const formTarjeta = document.getElementById('form-tarjeta');
                 const infoTransf = document.getElementById('info-transferencia');
     
                 document.querySelectorAll('input[name="metodo_pago"]').forEach(radio => {
                     radio.addEventListener('change', (e) => {
                         if (e.target.value === 'tarjeta') {
                             formTarjeta.style.display = 'block';
                             infoTransf.style.display = 'none';
                         } else {
                             formTarjeta.style.display = 'none';
                             infoTransf.style.display = 'block';
                         }
                     });
                 });
     
                 // --- 6. VALIDACIONES EN VIVO (MÁSCARAS DE INPUT) ---
                 const inputNumero = document.getElementById('card-number');
                 const inputCvv = document.getElementById('card-cvv');
     
                 // Expresión Regular (/\D/g) -> Borra automáticamente cualquier letra que el usuario intente escribir, dejando solo números.
                 if (inputNumero) {
                     inputNumero.addEventListener('input', (e) => { e.target.value = e.target.value.replace(/\D/g, ''); });
                 }
                 if (inputCvv) {
                     inputCvv.addEventListener('input', (e) => { e.target.value = e.target.value.replace(/\D/g, ''); });
                 }
     
                 // Máscara para la fecha de vencimiento: Agrega la barra '/' automáticamente después de 2 números
                 const inputVencimiento = document.getElementById('card-expiry');
                 if (inputVencimiento) {
                     inputVencimiento.addEventListener('input', (e) => {
                         let valor = e.target.value.replace(/\D/g, '');
                         if (valor.length > 2) {
                             valor = valor.substring(0, 2) + '/' + valor.substring(2, 4);
                         }
                         e.target.value = valor;
                     });
                 }
     
                 // --- 7. PROCESAMIENTO FINAL AL ENVIAR FORMULARIO (SUBMIT) ---
                 document.getElementById('form-checkout').addEventListener('submit', (e) => {
                     e.preventDefault(); // Frena el comportamiento por defecto de recargar la página HTML
     
                     if (carrito.length === 0) {
                         alert('El carrito está vacío. Agrega productos antes de pagar.');
                         return;
                     }
     
                     // Guardamos la decisión (Retiro o Domicilio) en la memoria local para que la 
                     // página "confirmacion-pedido" la pueda leer y mostrar el mensaje correcto.
                     const metodoEnvio = document.querySelector('input[name="tipo_envio"]:checked').value;
                     localStorage.setItem('metodo_envio_final', metodoEnvio);
     
                     // Como ya se compró, borramos permanentemente el carrito (Vaciar)
                     localStorage.removeItem('gaming_station_cart');
                     
                     // Redirigimos vía Javascript a la pantalla de éxito
                     window.location.href = '/confirmacion-pedido';
                 });
     
                 // Inicializamos la cuenta al cargar la página
                 actualizarTotales();
             });
         </script>
     @endsection