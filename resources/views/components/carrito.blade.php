

{{-- CONTENEDOR PRINCIPAL OFFCANVAS:
     offcanvas-end: Indica que el panel debe entrar desde el lado derecho de la pantalla.
     id="carritoLateral": Es CRÍTICO. Javascript usa este ID para abrir y cerrar el panel.
     tabindex="-1": Accesibilidad web. Evita que el usuario seleccione el panel oculto con la tecla TAB. --}}
     <div class="offcanvas offcanvas-end offcanvas-minimalist" tabindex="-1" id="carritoLateral">
    
        {{-- CABECERA DEL CARRITO (Header) --}}
        <div class="offcanvas-header p-4 border-bottom border-secondary border-opacity-10">
            {{-- Título con contraste de colores (Blanco y Mars Red) --}}
            <h5 class="offcanvas-title fw-black text-uppercase tracking-wider text-white">Tu <span class="text-mars">Carrito</span></h5>
            {{-- Botón de cierre nativo de Bootstrap ('btn-close-white' lo pone en color blanco) --}}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        
        {{-- CUERPO DEL CARRITO (Body)
             Se usa d-flex flex-column para que los elementos internos se apilen de arriba a abajo.
             Esto permite que el "Footer" sea empujado siempre hacia el fondo de la pantalla. --}}
        <div class="offcanvas-body p-4 d-flex flex-column">
            
            {{-- CONTENEDOR DINÁMICO DE PRODUCTOS:
                 id="contenedor-items-carrito": El archivo carrito.js busca este ID y sobrescribe 
                 su interior inyectando las tarjetas HTML de los productos elegidos.
                 overflow-auto: Si hay muchos productos, permite que esta sección tenga scroll interno (barrita para bajar). --}}
            <div id="contenedor-items-carrito" class="grow overflow-auto pe-2">
                {{-- El contenido aquí está vacío porque se inyecta por JS (renderizarCarrito) --}}
            </div>
            
            {{-- PIE DEL CARRITO (Footer / Totales)
                 mt-auto: (Margin Top Auto) Empuja esta caja hasta el borde inferior disponible. --}}
            <div class="cart-footer-modern mt-auto">
                
                {{-- Fila del Total --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-secondary fw-medium text-uppercase" style="letter-spacing: 1px; font-size: 0.9rem;">Total Estimado</span>
                    {{-- id="total-carrito": JS buscará esto para escribir la suma matemática de los precios --}}
                    <span id="total-carrito" class="cart-total-amount text-white fw-black">$0</span>
                </div>
                
                {{-- BOTÓN: FINALIZAR COMPRA
                     onclick="finalizarCompra()": Atrapa el clic del usuario y ejecuta la función 
                     en carrito.js que verifica si hay items y redirige al Checkout. --}}
                <button onclick="finalizarCompra()" class="btn btn-mars w-100 py-3 fw-bold rounded-3 mb-3 shadow-lg" style="font-size: 1.1rem; letter-spacing: 1px;">
                    FINALIZAR COMPRA
                </button>
                
                {{-- BOTÓN: VACIAR CARRITO
                     Llama a vaciarCarrito() en el JS para borrar el localStorage.
                     Diseñado como texto (btn-link) para no quitarle protagonismo al botón de compra. --}}
                <button onclick="vaciarCarrito()" class="btn btn-link w-100 text-secondary text-decoration-none btn-sm" style="transition: color 0.3s;" onmouseover="this.style.color='#FF3B3B'" onmouseout="this.style.color='#6c757d'">
                    Limpiar carrito
                </button>
            </div>
            
        </div>
    </div>