     @extends('layout.main')
     @section('titulo', 'Catálogo')
     @section('contenido')
     
         {{-- DIVS QUE DIBUJAN LAS LUCES (Efecto Visual Neón) --}}
         <div class="fondo-luces-catalogo">
             <div class="luz-roja-top"></div>
             <div class="luz-roja-bottom"></div>
         </div>
     
         <div class="container mt-5 mb-5">
     
             {{-- BOTON VOLVER--}}
             <div class="mb-4">
                 <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;" onmouseover="this.style.color='#FF3B3B'" onmouseout="this.style.color='#6c757d'">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al inicio</span>
                 </a>
             </div>
             
             <div class="container mt-5 mb-5">
                 {{-- Encabezado de la página --}}
                 <div class="text-center mb-5">
                     <h2 class="fw-black text-white text-uppercase tracking-tighter display-5 mb-2">
                         Catálogo
                     </h2>
                 </div>
     
                 {{-- COMPONENTE DE FILTROS DE BLADE
                      Al usar la etiqueta <x-... /> le decimos a Laravel que importe 
                      el archivo 'resources/views/components/filtro-catalogo.blade.php'. --}}
                 <x-filtro-catalogo />
     
                 {{-- MOTOR DE RENDERIZADO BUCLE PRINCIPAL --}}
                 {{-- 1. Itera sobre cada grupo de categorías (ej: "Consolas", luego "Hardware") --}}
                 @foreach ($productosAgrupados as $categoria => $productos)
                     <div class="categoria-bloque mb-5">
                         
                         {{-- Título de la Categoría actual --}}
                         <div class="d-flex align-items-center mb-4">
                             <h3 class="text-white fw-bold text-uppercase fs-4 mb-0 me-3">{{ $categoria }}</h3>
                             <div class="grow border-bottom border-secondary opacity-25"></div>
                         </div>
     
                         {{-- Sistema de Grillas (Row) con espaciado interno (g-4) --}}
                         <div class="row g-4">
                             {{-- 2. Itera sobre cada producto ESPECÍFICO dentro de esa categoría --}}
                             @foreach ($productos as $producto)
                                 {{-- COMPONENTE DE TARJETA:
                                      Le pasamos dinámicamente las variables de PHP al componente Blade 
                                      usando los dos puntos (:producto y :id) para que la tarjeta se 
                                      dibuje con los datos correctos. --}}
                                 <x-producto-card :producto="$producto" :id="$producto->id" />
                             @endforeach
                         </div>
                     </div>
                 @endforeach
             </div>
     
             {{-- Script que controla cómo funcionan los filtros sin recargar la página. --}}
             <script src="{{ asset('js/filtros.js') }}"></script>
         </div>
     @endsection