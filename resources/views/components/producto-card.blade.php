
{{-- @props: Declara las variables dinámicas que este componente DEBE recibir 
     desde el Backend (el controlador). En este caso recibe todo el array de datos 
     del 'producto' y su 'id' numérico. --}}
     @props(['producto', 'id'])

     {{-- CONTENEDOR DE GRILLA (Grid System):
          col-12: En celulares ocupa el 100% de la pantalla (1 producto por fila).
          col-sm-6: En tablets ocupa la mitad (2 por fila).
          col-lg-4: En computadoras ocupa un tercio (3 productos por fila).
     
          DATOS OCULTOS PARA JS (data-attributes): 
          Inyectamos la categoría y el precio directo en el código HTML de la tarjeta.
          JavaScript lee estos atributos 'data-' para poder filtrar y ordenar --}}
     <div class="col-12 col-sm-6 col-lg-4 producto-item" 
          data-id="{{ $id }}"
          data-categoria="{{ $producto['categoria'] }}" 
          data-precio="{{ $producto['precio'] }}">
         
         {{-- ETIQUETA ENLACE <a>: 
          el cliente puede hacer clic en la foto, título o cualquier espacio vacío para ir al detalle. --}}
         <a href="/consulta/{{ $id }}" class="card h-100 border-0 bg-transparent hover-elevate text-decoration-none" style="display: block; cursor: pointer;">
             
             {{-- CONTENEDOR DE LA IMAGEN
                  bg-opacity-50: Crea un fondo gris transparente que hace resaltar las 
                  fotos de hardware aunque tengan fondos blancos o transparentes. --}}
             <div class="contenedor-img rounded-4 bg-dark bg-opacity-50 mb-3" style="transition: transform 0.4s ease;">
                 {{-- Inyectamos la URL de la imagen que viene del array $producto --}}
                 <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="p-4">
             </div>
             
             {{-- CUERPO DE LA TARJETA (Títulos y Precio) 
                  d-flex flex-column: Permite distribuir los elementos internos.--}}
             <div class="card-body p-0 d-flex flex-column">
                 
                 {{-- Imprime la Categoría pequeña y sutil en la parte superior --}}
                 <span class="text-mars fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 1px;">
                     {{ $producto['categoria'] }}
                 </span>
                 
                 {{-- Imprime el Nombre del producto usando la variable Blade --}}
                 <h5 class="text-white fw-bold mb-2 fs-5 lh-sm">{{ $producto['nombre'] }}</h5>
                 
                 {{-- CONTENEDOR DE ACCIÓN
                      mt-auto: Empuja el precio y el botón hacia abajo. Esto asegura que 
                      si un nombre tiene 1 renglón y el de al lado tiene 3, los botones
                      siempre queden alineados a la misma altura horizontal en el catálogo. --}}
                 <div class="mt-auto d-flex align-items-center justify-content-between pt-2">
                     
                     {{-- Formateador PHP: 
                          La función nativa number_format toma el número (ej: 1200000), 
                          le indica que tiene 0 decimales, y usa la coma (,) para los 
                          decimales y el punto (.) como separador de miles. Output: $1.200.000 --}}
                     <span class="text-white fw-bolder fs-4">
                         ${{ number_format($producto['precio'], 0, ',', '.') }}
                     </span>
                     
                     {{-- Falso botón: Como toda la tarjeta ya es un link <a>, este 
                          span funciona solo como indicador visual de que es "clickeable" --}}
                     <span class="btn btn-mars btn-sm px-3 fw-bold rounded-3">
                         Detalles
                     </span>
                 </div>
             </div>
         </a>
     </div>
     
     {{-- EFECTO DE ZOOM FOTOGRÁFICO
          Cuando el usuario pasa el mouse (.producto-item:hover) por CUALQUIER lugar de la tarjeta,
          el CSS detecta la imagen interna y la agranda ligeramente (scale 1.08) creando un
          efecto muy dinámico y moderno. --}}
     <style>
         .producto-item:hover .contenedor-img img {
             transform: scale(1.08);
             transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
         }
     </style>