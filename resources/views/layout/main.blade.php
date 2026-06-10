     <!DOCTYPE html>
     <html lang="es">
     
     <head>
         <meta charset="UTF-8">
         {{-- Meta Viewport: CRÍTICO para que la web sea Responsive en celulares --}}
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         {{-- CSRF token: lo lee carrito.js para los fetch() --}}
         <meta name="csrf-token" content="{{ csrf_token() }}">
         
         {{-- Favicon: El ícono de la pestaña del navegador --}}
         <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
         
         {{-- Título Dinámico: '@yield' reserva este espacio. Cada página hija 
              insertará su propio nombre aquí usando @section('titulo', 'Nombre') --}}
         <title>GamingStation | @yield('titulo')</title>
     
         {{-- IMPORTACIÓN DE ESTILO (CSS)
              asset(): Es un helper de Laravel que genera la URL absoluta hacia la carpeta 'public'.
              Esto evita errores de rutas rotas cuando subís la web a un servidor real. --}}
         <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
         <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
         <link rel="stylesheet" href="{{ asset('css/fondos.css') }}">
         @auth
             @if(Auth::user()->rol && Auth::user()->rol->nombre === 'admin')
             <link rel="stylesheet" href="{{ asset('css/estilos.header-admin.css') }}">
             @endif
         @endauth
         @stack('styles')
     </head>
     
     {{-- bg-dark y text-light: Clases nativas de Bootstrap para dar un fondo negro 
          por defecto y que todo el texto herede el color blanco/claro. --}}
     @php
         $bodyIsAdmin = Auth::check() && Auth::user()->rol?->nombre === 'admin' && !request()->is('admin*');
     @endphp
     <body class="bg-dark text-light{{ $bodyIsAdmin ? ' has-admin-bar' : '' }}">
     
         {{-- INCLUSIÓN DEL HEADER
              @include inserta un fragmento de código (Partial) exactamente en este lugar.
              Esto mantiene el archivo main limpio y modular. --}}
         @include('partials.header')
     
         {{-- CONTENEDOR PRINCIPAL DINÁMICO
              Aquí es donde se inyectará el contenido único de cada página (Inicio, Catálogo, etc.)
              cuando las páginas hijas llamen a @section('contenido') --}}
         <main>
             @yield('contenido')
         </main>
     
         {{-- INCLUSIÓN DEL FOOTER --}}
         @include('partials.footer')
     
         {{-- COMPONENTE DEL CARRITO
              Usar <x-nombre /> es la sintaxis moderna de Blade Components.
              Llama al archivo resources/views/components/carrito.blade.php. 
              Se pone al final del body para que no bloquee la carga visual de la página. --}}
         <x-carrito />
     
         {{-- IMPORTACIÓN DE SCRIPTS (JavaScript)
              Se colocan justo antes de cerrar el </body> por rendimiento (Performance).
              Así, el HTML y CSS cargan primero y el usuario no se queda viendo una pantalla blanca. --}}
         <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
         <script src="{{ asset('js/carrito.js') }}"></script>
         <script src="{{ asset('js/favoritos.js') }}"></script>
         @stack('scripts')

     </body>

</html>