
     @extends('layout.main')
     @section('titulo', 'Términos y Usos | GamingStation')
     @section('contenido')
         <div class="container mt-5 mb-5">
     
             <div class="mb-4">
                 <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 hover-text-mars" style="transition: color 0.3s;" onmouseover="this.style.color='#FF3B3B'" onmouseout="this.style.color='#6c757d'">
                     <img src="{{ asset('assets/caret-left.svg') }}" alt="Volver" style="width: 18px; height: 18px; filter: invert(0.6);">
                     <span class="fw-semibold">Volver al inicio</span>
                 </a>
             </div>
     
             <div class="row mb-5 text-center">
                 <div class="col-12">
                     <h1 class="text-white fw-black display-5 tracking-tighter">TÉRMINOS Y USOS</h1>
                     <p class="text-secondary lead">Políticas claras para una experiencia de compra segura y transparente.</p>
                 </div>
             </div>
     
             {{-- CONTENEDOR PRINCIPAL:
                  Se usa justify-content-center en la fila (row) y col-lg-10 en la columna 
                  para que el bloque de texto no llegue a los bordes y sea más cómodo leer. --}}
             <div class="row justify-content-center">
                 <div class="col-12 col-lg-10">
                     <div class="card card-contacto shadow-lg border-0">
                         <div class="card-body p-4 p-md-5">
     
                             {{-- SECCIÓN INDIVIDUAL DE TÉRMINO --}}
                             <div class="termino-seccion mb-5">
                                 
                                 {{-- ENCABEZADO CON NÚMERO (FLEXBOX):
                                      d-flex y align-items-center asegura que el círculo numérico
                                      siempre esté alineado perfectamente al centro de la altura del título. --}}
                                 <div class="d-flex align-items-center mb-3">
                                     {{-- .termino-numero define un círculo rojo en el CSS global --}}
                                     <span class="termino-numero">1</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Introducción y Uso del Sitio</h4>
                                 </div>
                                 
                                 {{-- TEXTO: lh-lg incrementa el espacio (Line Height) entre renglones,
                                      ms-md-5 empuja el texto hacia la derecha en PC para alinearse con el título. --}}
                                 <p class="text-secondary lh-lg ms-md-5">
                                     Bienvenido a GamingStation. Al acceder a nuestro sitio web y realizar compras, aceptas cumplir con los siguientes términos. Nuestro sitio está destinado exclusivamente a mayores de 18 años. Al utilizarlo, garantizas que toda la información proporcionada para la facturación y envío es precisa y actual.
                                 </p>
                             </div>
     
                             <div class="termino-seccion mb-5">
                                 <div class="d-flex align-items-center mb-3">
                                     <span class="termino-numero">2</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Compras, Precios y Stock</h4>
                                 </div>
                                 <p class="text-secondary lh-lg ms-md-5">
                                     Nos esforzamos por mantener el inventario de consolas y hardware actualizado en tiempo real. Sin embargo, debido a la alta demanda, un producto agregado al carrito no garantiza su reserva hasta que el pago sea confirmado. Nos reservamos el derecho de cancelar pedidos en caso de errores de sistema o falta de stock, reintegrando el 100% del dinero de forma inmediata.
                                 </p>
                             </div>
     
                             <div class="termino-seccion mb-5">
                                 <div class="d-flex align-items-center mb-3">
                                     <span class="termino-numero">3</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Formas de Entrega y Tiempos</h4>
                                 </div>
                                 <p class="text-secondary lh-lg ms-md-5">
                                     Realizamos envíos a todo el país. Los tiempos de entrega estimados son de 2 a 5 días hábiles dependiendo de tu ubicación. Todo el hardware delicado (monitores, placas de video, consolas) se despacha con embalaje de alta protección y seguro de traslado. Una vez despachado, recibirás por email tu número de seguimiento.
                                 </p>
                             </div>
     
                             <div class="termino-seccion mb-5">
                                 <div class="d-flex align-items-center mb-3">
                                     <span class="termino-numero">4</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Garantías y Soporte Postventa</h4>
                                 </div>
                                 <p class="text-secondary lh-lg ms-md-5">
                                     Todos nuestros productos cuentan con garantía oficial del fabricante (mínimo 6 meses). Si un componente presenta fallas de fábrica, nuestro equipo de soporte técnico te guiará en el proceso de RMA (Autorización de Retorno de Mercancía). La garantía queda anulada si el hardware presenta daños físicos, quemaduras por sobretensión o modificaciones no autorizadas (overclocking extremo).
                                 </p>
                             </div>
     
                             <div class="termino-seccion mb-5">
                                 <div class="d-flex align-items-center mb-3">
                                     <span class="termino-numero">5</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Política de Devoluciones (Arrepentimiento)</h4>
                                 </div>
                                 <p class="text-secondary lh-lg ms-md-5">
                                     Tienes 10 días corridos desde la recepción del pedido para solicitar la devolución por arrepentimiento de compra.
                                     El producto debe estar en las mismas condiciones en las que fue entregado: cajas selladas, manuales intactos y sin uso.
                                     <strong>Importante:</strong> Por cuestiones de derechos de autor, no se aceptan devoluciones por arrepentimiento de videojuegos físicos desprecintados.
                                     <em>Si el juego presenta una falla de lectura de fábrica, el cambio se gestionará a través de la garantía (Punto 4).</em>
                                 </p>
                             </div>
     
                             <div class="termino-seccion">
                                 <div class="d-flex align-items-center mb-3">
                                     <span class="termino-numero">6</span>
                                     <h4 class="text-white fw-bold mb-0 ms-3">Ley Aplicable</h4>
                                 </div>
                                 <p class="text-secondary lh-lg ms-md-5 mb-0">
                                     Estos términos se rigen por las leyes de la República Argentina. Cualquier disputa será sometida a la jurisdicción exclusiva de los tribunales competentes de la ciudad de Corrientes.
                                 </p>
                             </div>
     
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     @endsection