
     @extends('layout.main')
     @section('titulo', $producto->nombre)

     @section('contenido')
         <div class="container mt-5 mb-5">

             <div class="mb-4">
                 <a href="/catalogo" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al catálogo</span>
                 </a>
             </div>

             <div class="detalle-wrapper" style="background-color: #11131A; border-radius: 1rem; overflow: hidden; box-shadow: 0 1rem 3rem rgba(0,0,0,0.5);">

                 <div class="row g-0">

                     {{-- COLUMNA IZQUIERDA: IMAGEN --}}
                     <div class="col-md-6 border-end border-secondary border-opacity-10 d-flex align-items-center justify-content-center p-3 p-md-4" style="background: radial-gradient(circle, #1a1d27 0%, #0b0c10 100%); min-height: 400px;">
                         @php
                             $imagenUrl = $producto->imagen
                                 ? asset('storage/' . $producto->imagen)
                                 : asset('assets/placeholder-producto.svg');
                         @endphp
                         <img src="{{ $imagenUrl }}" alt="{{ $producto->nombre }}" class="img-fluid"
                              style="width: 100%; height: 100%; max-height: 600px; object-fit: contain; filter: drop-shadow(0 15px 25px rgba(0,0,0,0.5)); transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);"
                              onmouseover="this.style.transform='scale(1.05)'"
                              onmouseout="this.style.transform='scale(1)'">
                     </div>

                     {{-- COLUMNA DERECHA: INFO Y COMPRA --}}
                     <div class="col-md-6 p-4 p-lg-5">
                         <div class="detalle-info-container h-100 d-flex flex-column">

                             <div class="mb-2">
                                 <span class="text-mars fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1.5px;">
                                     {{ $producto->categoria?->nombre }}
                                 </span>
                             </div>
                             <h1 class="fw-black text-white text-uppercase mb-2 tracking-tighter display-5">
                                 {{ $producto->nombre }}
                             </h1>

                             <div class="detalle-precio mb-4 text-success fw-black fs-2">
                                 ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                             </div>

                             <p class="text-secondary mb-5 lh-lg fs-5 fw-light">
                                 {{ $producto->descripcion }}
                             </p>

                             {{-- ESPECIFICACIONES --}}
                             @if($producto->especificaciones)
                             <div class="mb-5 grow">
                                 <h5 class="text-white fw-bold mb-4 fs-6 text-uppercase" style="letter-spacing: 1px;">Especificaciones Destacadas</h5>
                                 <ul class="detalle-specs">
                                     @foreach ($producto->especificaciones as $spec)
                                         <li>{{ $spec }}</li>
                                     @endforeach
                                 </ul>
                             </div>
                             @endif

                             {{-- ZONA DE ACCIÓN --}}
                             <div class="mt-auto pt-4 border-top border-secondary border-opacity-25">
                                 <div class="d-flex justify-content-between align-items-center mb-4">
                                     <span class="d-flex align-items-center text-secondary gap-2">
                                         <img src="{{ asset('assets/boxes.svg') }}" alt="Stock" style="width: 18px; height: 18px; filter: invert(0.5);">
                                         Stock disponible:
                                         <span class="fw-bold text-white fs-5 ms-1">{{ $producto->stock }}</span>
                                     </span>
                                 </div>

                                 <div class="row g-3 align-items-center">
                                     <div class="col-12 col-sm-4 col-md-3">
                                         <input type="number" id="input-cantidad"
                                                class="input-cantidad-moderno form-control bg-dark text-white border-secondary text-center fw-bold w-100"
                                                value="1" min="1" max="{{ $producto->stock }}"
                                                style="height: 55px; font-size: 1.2rem;">
                                     </div>

                                     <div class="col-12 col-sm-8 col-md-9">
                                         <button
                                             class="btn btn-mars w-100 fw-bold d-flex align-items-center justify-content-center gap-2 text-nowrap"
                                             style="height: 55px; border-radius: 8px; font-size: 1.1rem;"
                                             onclick="agregarAlCarrito(
                                                 '{{ $producto->id }}',
                                                 '{{ addslashes($producto->nombre) }}',
                                                 {{ $producto->precio_venta }},
                                                 {{ $producto->stock }},
                                                 '{{ $imagenUrl }}'
                                             )">
                                             <img src="{{ asset('assets/cart-plus.svg') }}" alt="Agregar" style="width: 22px; height: 22px; filter: invert(1);">
                                             <span>Agregar al Carrito</span>
                                         </button>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     @endsection
