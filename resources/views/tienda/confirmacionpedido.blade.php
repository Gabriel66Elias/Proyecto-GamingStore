
     @extends('layout.main')
     @section('titulo', 'Pedido Confirmado')
     @section('contenido')
         <div class="container mt-5 mb-5" style="min-height: 70vh;">
             
             <div class="mb-4">
                 <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al inicio</span>
                 </a>
             </div>
     
             <div class="row w-100 justify-content-center m-0">
                 <div class="col-12 col-md-8 col-lg-6">
     
                     <div class="card card-estado text-center shadow-lg">
                         <div class="card-body p-5">
                             
                             {{-- Icono SVG incrustado (Inline). Esto ahorra una petición HTTP al servidor, 
                                  haciendo que la pantalla de éxito cargue literalmente al instante. --}}
                             <div class="mb-4 d-flex justify-content-center">
                                 <div style="width: 80px; height: 80px; background-color: rgba(25, 135, 84, 0.1); border: 2px solid #198754; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#198754" viewBox="0 0 16 16">
                                         <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                     </svg>
                                 </div>
                             </div>
     
                             <h1 class="text-white fw-black mb-3 text-uppercase display-5 tracking-tighter">¡Pedido Confirmado!</h1>
                             
                             {{-- Contenedor vacío: El texto real será inyectado por JS dependiendo de 
                                  lo que el usuario haya seleccionado en la página anterior. --}}
                             <p id="numero-pedido" class="fw-bold mb-2" style="font-size:1rem; color:#FF3B3B; letter-spacing:1px;"></p>
                             <p id="mensaje-envio" class="text-secondary fs-5 mb-4">
                                 Cargando información del envío...
                             </p>

                             <div id="aviso-transferencia" class="mb-4 text-start" style="display:none;background:rgba(251,191,36,.07);border:1px solid rgba(251,191,36,.2);border-radius:10px;padding:1rem 1.1rem;">
                                 <div class="d-flex align-items-center gap-2 mb-1">
                                     <img src="{{ asset('assets/bank.svg') }}" style="width:14px;filter:invert(.9) sepia(1) saturate(2) hue-rotate(-10deg);">
                                     <span style="font-size:.85rem;font-weight:700;color:#fbbf24;">Falta un paso: subí tu comprobante</span>
                                 </div>
                                 <p style="font-size:.82rem;color:#94a3b8;margin:0 0 .85rem;">
                                     Para confirmar tu pago por transferencia, subí el comprobante desde tu perfil.
                                 </p>
                                 <a href="/mi-perfil" class="btn btn-sm fw-bold px-3" style="background:#fbbf24;color:#1a1306;border-radius:7px;font-size:.8rem;">
                                     Ir a mi perfil
                                 </a>
                             </div>
     
                             <div class="d-grid gap-2 col-10 mx-auto">
                                 <a href="/" class="btn btn-mars btn-lg py-3 fw-bold" style="border-radius: 0.8rem; letter-spacing: 1px;">
                                     Volver al Inicio
                                 </a>
                             </div>
     
                         </div>
                     </div>
     
                 </div>
             </div>
         </div>
     
         @push('scripts')
         <script src="{{ asset('js/confirmacionpedido.js') }}"></script>
         @endpush
     @endsection