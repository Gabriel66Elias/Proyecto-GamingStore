
     @extends('layout.main')
     @section('titulo', '¡Envío Exitoso! | GamingStation')
     @section('contenido')
         <style>
             .card-estado {
                 background: linear-gradient(145deg, #1a1d27 0%, #11131A 100%) !important;
                 border: 2px solid transparent !important; 
                 border-radius: 16px;
                 transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
             }
     
             .card-estado:hover {
                 transform: none !important; 
                 border-color: #FF3B3B !important; 
                 box-shadow: 0 0 20px rgba(255, 59, 59, 0.15) !important;
             }
     
             /* Icono de éxito dibujado con puro CSS (sin imágenes) para máxima velocidad */
             .success-circle {
                 width: 80px;
                 height: 80px;
                 background-color: rgba(25, 135, 84, 0.1); 
                 border: 2px solid #198754; 
                 border-radius: 50%;
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 margin: 0 auto;
             }
     
             .checkmark {
                 color: #198754;
                 font-size: 40px;
                 font-weight: bold;
             }
         </style>
     
         <div class="container mt-5 mb-5" style="min-height: 70vh;">
             
             <div class="mb-4">
                 <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;" onmouseover="this.style.color='#FF3B3B'" onmouseout="this.style.color='#6c757d'">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al inicio</span>
                 </a>
             </div>
     
             <div class="row w-100 justify-content-center m-0">
                 <div class="col-12 col-md-8 col-lg-6">
     
                     <div class="card card-estado text-center shadow-lg">
                         <div class="card-body p-5">
     
                             <div class="success-icon-container mb-4">
                                 <div class="success-circle">
                                     <span class="checkmark">✓</span>
                                 </div>
                             </div>
     
                             <h1 class="text-white fw-black mb-3 tracking-tighter">¡MENSAJE ENVIADO!</h1>
     
                             <p class="text-secondary fs-5 mb-5">
                                 {{-- PROTECCIÓN XSS (Cross-Site Scripting):
                                      Las dobles llaves {{ }} de Blade no solo imprimen la variable enviada 
                                      por el backend, sino que escapan caracteres peligrosos (como <script>). 
                                      Si un usuario envía código malicioso como Nombre, Blade lo anula automáticamente. --}}
                                 Gracias por contactarnos, <strong>{{ $nombre }}</strong>. Tu consulta ha sido recibida
                                 correctamente y un asesor de <strong>GamingStation</strong> te responderá a la brevedad al
                                 correo: <strong>{{ $email }}</strong>.
                             </p>
     
                             <div class="d-grid gap-2 col-10 mx-auto">
                                 <a href="{{ url('/') }}" class="btn btn-mars btn-lg py-3 fw-bold" style="border-radius: 0.8rem; letter-spacing: 1px;">
                                     VOLVER AL INICIO
                                 </a>
                             </div>
     
                         </div>
                     </div>
     
                 </div>
             </div>
         </div>
     @endsection