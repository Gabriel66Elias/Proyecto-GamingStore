
     @extends('layout.main') {{-- Hereda la estructura base (header, footer, head) --}}

     @section('titulo', 'Contacto | GamingStation') {{-- Inyecta el título en la pestaña del navegador --}}
     
     @section('contenido')
         <div class="container mt-5 mb-5">
     
             {{-- BOTÓN DE REGRESO: Mejora la UX permitiendo volver fácilmente. --}}
             <div class="mb-4">
                 <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;" onmouseover="this.style.color='#FF3B3B'" onmouseout="this.style.color='#6c757d'">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al inicio</span>
                 </a>
             </div>
     
             {{-- ENCABEZADO DE LA PÁGINA --}}
             <div class="row mb-5 text-center">
                 <div class="col-12">
                     <h1 class="text-white fw-black display-5 tracking-tighter">CONTACTO Y UBICACIÓN</h1>
                     <p class="text-secondary lead">Estamos aquí para asesorarte en el armado de tu próximo setup.</p>
                 </div>
             </div>
     
             {{-- SISTEMA DE GRILLAS (Grid): 
                  Divide la pantalla en dos columnas. La información legal ocupa 5 columnas (col-lg-5)
                  y el formulario ocupa 7 columnas (col-lg-7). En celulares, ambas ocupan 12 (el 100%). --}}
             <div class="row g-4">
                 
                 {{-- COLUMNA IZQUIERDA: INFORMACIÓN LEGAL --}}
                 <div class="col-12 col-lg-5">
                     <div class="card card-contacto h-100 shadow-lg">
                         <div class="card-body p-4 p-lg-5">
                             <h3 class="fw-bold text-white mb-4">Información Legal</h3>
                             <ul class="list-unstyled text-secondary lh-lg mb-4">
                                 <li class="mb-3"><strong class="text-white">Titular:</strong> Juan Pérez</li>
                                 <li class="mb-3"><strong class="text-white">Razón Social:</strong> GamingStation S.R.L.</li>
                                 <li class="mb-3"><strong class="text-white">Domicilio Legal:</strong> Av. 25 de Mayo 1234, Corrientes</li>
                                 <li class="mb-3"><strong class="text-white">Teléfono:</strong> +54 379 4123456</li>
                                 <li class="mb-3"><strong class="text-white">Email:</strong> ventas@gamingstation.com.ar</li>
                             </ul>
                             <hr class="border-secondary mb-4 opacity-25">
                             
                             <h4 class="fw-bold text-white mb-3">Nuestras Redes</h4>
                             <p class="text-secondary mb-4">Seguinos para enterarte de los últimos ingresos de consolas y hardware de alto rendimiento.</p>
     
                             {{-- ENLACES A REDES SOCIALES (target="_blank" abre en nueva pestaña) --}}
                             <div class="d-flex gap-4">
                                 <a href="https://www.instagram.com" class="social-link" target="_blank" title="Instagram">
                                     <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram" class="icono-red" style="width: 28px; filter: invert(1); transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                 </a>
                                 <a href="https://www.facebook.com" class="social-link" target="_blank" title="Facebook">
                                     <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook" class="icono-red" style="width: 28px; filter: invert(1); transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                 </a>
                                 <a href="https://wa.me/543794123456" class="social-link" target="_blank" title="WhatsApp">
                                     <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp" class="icono-red" style="width: 28px; filter: invert(1); transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                 </a>
                                 <a href="mailto:ventas@gamingstation.com.ar" class="social-link" title="Enviar Correo">
                                     <img src="{{ asset('assets/envelope-at.svg') }}" alt="Correo" class="icono-red" style="width: 28px; filter: invert(1); transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
     
                 {{-- COLUMNA DERECHA: FORMULARIO DE CONTACTO --}}
                 <div class="col-12 col-lg-7">
                     <div class="card card-contacto h-100 shadow-lg">
                         <div class="card-body p-4 p-lg-5">
                             <h3 class="fw-bold text-white mb-4">Envianos tu consulta</h3>
                             
                             {{-- FORMULARIO: Envía los datos por método POST a la ruta '/contacto' --}}
                             <form action="{{ url('/contacto') }}" method="POST">
                                 
                                 {{-- @csrf: Cross-Site Request Forgery. Es un token de seguridad OBLIGATORIO en Laravel 
                                      para evitar que hackers envíen formularios desde sitios externos. --}}
                                 @csrf
                                 
                                 <div class="mb-4 text-start">
                                     <label class="form-label text-secondary fw-semibold">Nombre Completo</label>
                                     <input type="text" name="nombre" class="form-control input-dark" placeholder="Ej: José García" required>
                                 </div>
                                 <div class="mb-4 text-start">
                                     <label class="form-label text-secondary fw-semibold">Correo Electrónico</label>
                                     <input type="email" name="email" class="form-control input-dark" placeholder="nombre@ejemplo.com" required>
                                 </div>
                                 <div class="mb-4 text-start">
                                     <label class="form-label text-secondary fw-semibold">Mensaje - ¿En qué podemos ayudarle? </label>
                                     <textarea name="mensaje" class="form-control input-dark" rows="5" required></textarea>
                                 </div>
                                 <button type="submit" class="btn btn-mars btn-lg w-100 py-3 mt-3 fw-bold" style="border-radius: 0.8rem;">ENVIAR MENSAJE</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     @endsection