
     @extends('layout.main')
     @section('titulo', 'Inicio')
     @section('contenido')
     
         {{-- FONDO DINÁMICO: Estos divs están controlados por fondos.css. 
              Se quedan fijos en el fondo (z-index: -1) y le dan la estética Gaming. --}}
         <div class="fondo-minimalista-grid">
             <div class="brillo-rojo-cenital"></div>
             <div class="mascara-difuminada"></div>
         </div>
     
         {{-- ======================================================================
              HERO SECTION (CARRUSEL Y LLAMADO A LA ACCIÓN)
              position-relative: Es vital para que el texto (que tiene position-absolute) 
              se quede adentro de esta caja y no se vuele por la página.
              overflow: hidden: Oculta cualquier cosa que se salga de los límites del header.
              ====================================================================== --}}
         <header class="position-relative mb-5" style="height: 75vh; min-height: 600px; overflow: hidden;">
     
             {{-- COMPONENTE CAROUSEL DE BOOTSTRAP --}}
             <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="5000">
     
                 {{-- Indicadores (Las barritas de abajo) --}}
                 <div class="carousel-indicators" style="z-index: 5;">
                     <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                     <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                     <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                 </div>
     
                 <div class="carousel-inner h-100">
                     {{-- CAPA DE OSCURECIMIENTO (Overlay): 
                          Un gradiente negro que se pone por ENCIMA de las fotos pero por DEBAJO 
                          del texto (z-index: 1). Garantiza que el texto blanco siempre se lea bien, 
                          incluso si la foto de fondo es muy clara. --}}
                     <div class="position-absolute top-0 inset-s-0 w-100 h-100"
                         style="background: linear-gradient(to bottom, rgba(17, 19, 26, 0.3) 0%, #0b0c10 100%); z-index: 1;">
                     </div>
     
                     {{-- Imágenes del carrusel: object-fit-cover asegura que la foto llene 
                          todo el espacio sin deformarse ni aplastarse. --}}
                     <div class="carousel-item active h-100">
                         <img src="/img/carrusel1.webp" class="d-block w-100 h-100 object-fit-cover" alt="Setup Gaming 1">
                     </div>
                     <div class="carousel-item h-100">
                         <img src="/img/carrusel2.webp" class="d-block w-100 h-100 object-fit-cover" alt="Setup Gaming 2">
                     </div>
                     <div class="carousel-item h-100">
                         <img src="/img/carrusel3.webp" class="d-block w-100 h-100 object-fit-cover" alt="Consolas">
                     </div>
                 </div>
     
                 {{-- Controles (Flechas izquierda/derecha) --}}
                 <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 5;">
                     <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 0 5px rgba(255, 59, 59, 0.5));"></span>
                     <span class="visually-hidden">Anterior</span>
                 </button>
                 <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 5;">
                     <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 0 5px rgba(255, 59, 59, 0.5));"></span>
                     <span class="visually-hidden">Siguiente</span>
                 </button>
             </div>
     
             {{-- ======================================================================
                  TEXTO SUPERPUESTO (TEXT OVERLAY)
                  translate-middle: Combinado con top-50 y start-50, es la forma matemática 
                  exacta de centrar un elemento tanto vertical como horizontalmente en CSS.
                  z-index: 2: Lo pone por encima del overlay oscuro.
                  ====================================================================== --}}
             <div class="position-absolute top-50 start-50 translate-middle w-100 text-center" style="z-index: 2;">
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-lg-10">
                             {{-- Título principal. text-shadow le da un borde negro a la letra para legibilidad extrema --}}
                             <h1 class="display-4 fw-light mb-3 text-white text-uppercase" style="letter-spacing: 1px; text-shadow: 0 4px 15px rgba(0,0,0,0.8);">
                                 Elevá tu juego al <span class="text-mars fw-bold">siguiente nivel</span>
                             </h1>
                             <p class="lead mb-5 text-light fs-5 fw-normal" style="text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                                 Las mejores consolas, hardware variado y periféricos del mejor nivel. Todo con excelente precio y calidad :)
                             </p>
     
                             {{-- Botones de CTA (Call To Action). d-sm-flex hace que en celulares 
                                  se apilen uno abajo del otro, pero en pantallas más grandes se pongan lado a lado --}}
                             <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                 <a href="/catalogo" class="btn btn-mars btn-lg px-5 py-3 shadow-lg d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 0.8rem;">
                                     <img src="{{ asset('assets/controller.svg') }}" alt="controller" style="width: 22px; height: 22px; filter: invert(1);">
                                     <span>Ver Catálogo</span>
                                 </a>
                                 <a href="/quienes-somos" class="btn btn-conocenos btn-lg px-5 py-3 fw-bold" style="border-radius: 0.8rem;">
                                     Conócenos
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </header>
     
         {{-- ======================================================================
              SECCIÓN DE TARJETAS DE CATEGORÍA
              ====================================================================== --}}
         <main class="container mb-5 pb-5">
             <div class="row text-center g-4">
     
                 {{-- Cada tarjeta envuelta en un enlace (<a>) para UX óptima.
                      col-lg-3 asegura que entren 4 tarjetas por fila en PC (12 / 3 = 4). --}}
                 <div class="col-lg-3 col-md-6 col-sm-6">
                     <a href="/catalogo" class="text-decoration-none">
                         <div class="card card-categoria p-2 cursor-pointer shadow-sm">
                             <div class="card-body d-flex flex-column align-items-center justify-content-center w-100">
                                 {{-- Círculo con fondo rojo transparente que envuelve al icono --}}
                                 <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 65px; height: 65px; background-color: rgba(255, 59, 59, 0.1);">
                                     <img src="{{ asset('assets/playstation.svg') }}" alt="playstation" style="width: 32px; height: 32px; filter: invert(1);">
                                 </div>
                                 <h4 class="fw-black mb-2 text-white text-uppercase fs-5">Consolas</h4>
                                 <p class="text-secondary mb-0 lh-sm px-2" style="font-size: 0.85rem;">PS5, Switch y Xbox con garantía oficial.</p>
                             </div>
                         </div>
                     </a>
                 </div>
     
                 <div class="col-lg-3 col-md-6 col-sm-6">
                     <a href="/catalogo" class="text-decoration-none">
                         <div class="card card-categoria p-2 cursor-pointer shadow-sm">
                             <div class="card-body d-flex flex-column align-items-center justify-content-center w-100">
                                 <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 65px; height: 65px; background-color: rgba(255, 59, 59, 0.1);">
                                     <img src="{{ asset('assets/mouse3.svg') }}" alt="mouse" style="width: 32px; height: 32px; filter: invert(1);">
                                 </div>
                                 <h4 class="fw-black mb-2 text-white text-uppercase fs-5">Periféricos</h4>
                                 <p class="text-secondary mb-0 lh-sm px-2" style="font-size: 0.85rem;">Periféricos profesionales para tener la mejor experiencia.</p>
                             </div>
                         </div>
                     </a>
                 </div>
     
                 <div class="col-lg-3 col-md-6 col-sm-6">
                     <a href="/catalogo" class="text-decoration-none">
                         <div class="card card-categoria p-2 cursor-pointer shadow-sm">
                             <div class="card-body d-flex flex-column align-items-center justify-content-center w-100">
                                 <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 65px; height: 65px; background-color: rgba(255, 59, 59, 0.1);">
                                     <img src="{{ asset('assets/tv.svg') }}" alt="tv" style="width: 32px; height: 32px; filter: invert(1);">
                                 </div>
                                 <h4 class="fw-black mb-2 text-white text-uppercase fs-5">TVs y Monitores</h4>
                                 <p class="text-secondary mb-0 lh-sm px-2" style="font-size: 0.85rem;">Pantallas 4K y los mejores monitores</p>
                             </div>
                         </div>
                     </a>
                 </div>
     
                 <div class="col-lg-3 col-md-6 col-sm-6">
                     <a href="/catalogo" class="text-decoration-none">
                         <div class="card card-categoria p-2 cursor-pointer shadow-sm">
                             <div class="card-body d-flex flex-column align-items-center justify-content-center w-100">
                                 <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 65px; height: 65px; background-color: rgba(255, 59, 59, 0.1);">
                                     <img src="{{ asset('assets/cpu.svg') }}" alt="cpu" style="width: 32px; height: 32px; filter: invert(1);">
                                 </div>
                                 <h4 class="fw-black mb-2 text-white text-uppercase fs-5">Hardware</h4>
                                 <p class="text-secondary mb-0 lh-sm px-2" style="font-size: 0.85rem;">Los mejores componentes para tu PC.</p>
                             </div>
                         </div>
                     </a>
                 </div>
     
             </div>
         </main>
     @endsection