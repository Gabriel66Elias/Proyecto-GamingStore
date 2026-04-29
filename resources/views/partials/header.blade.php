
{{-- NAVBAR DE BOOTSTRAP:
     navbar-expand-lg: Indica que en pantallas grandes (lg) se vean los links, 
     pero en celulares se colapse en el menú hamburguesa.
     sticky-top: Hace que el menú se quede pegado arriba al hacer scroll.
     z-index: 1040: Asegura que el menú siempre esté por encima de cualquier foto o producto. --}}
     <nav class="navbar navbar-expand-lg navbar-dark border-bottom py-3 sticky-top" style="z-index: 1040; background-color: #11131A; border-bottom-color: #1f222e !important;">
        <div class="container">
            
            {{-- LOGOTIPO: Apunta a la raíz del sitio ('/') --}}
            <a class="navbar-brand fw-bold fs-4 logo-text" href="/">GAMING<span class="text-mars">STATION</span></a>
    
            {{-- BOTÓN HAMBURGUESA (Solo visible en celulares/tablets)
                 data-bs-toggle y data-bs-target se comunican con el JS de Bootstrap para abrir el menú --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            {{-- CONTENIDO COLAPSABLE DEL MENÚ --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                
                {{-- ENLACES DE NAVEGACIÓN
                     mx-auto: Margen horizontal automático (Centra los enlaces en el medio de la barra).
                     text-nowrap: Prohíbe que el texto de un enlace (ej: "Quiénes Somos") se parta en dos renglones. --}}
                <div class="navbar-nav mx-auto align-items-center gap-1">
                    
                    {{-- LÓGICA DE CLASE ACTIVA (Blade):
                         {{ Request::is('/') ? 'active text-mars' : '' }}
                         Le pregunta a Laravel: "¿La URL actual es '/'?". Si es cierto (True), 
                         le imprime las clases 'active text-mars' para pintarlo de rojo. 
                         Si es falso, no imprime nada. --}}
                    <a class="nav-link px-2 text-nowrap {{ Request::is('/') ? 'active text-mars' : '' }}" href="/">Inicio</a>
                    <a class="nav-link px-2 text-nowrap {{ Request::is('quienes-somos') ? 'active text-mars' : '' }}" href="/quienes-somos">Quiénes Somos</a>
                    <a class="nav-link px-2 text-nowrap {{ Request::is('catalogo') ? 'active text-mars' : '' }}" href="/catalogo">Catálogo</a>
                    <a class="nav-link px-2 text-nowrap {{ Request::is('contacto') ? 'active text-mars' : '' }}" href="/contacto">Contacto</a>
                    <a class="nav-link px-2 text-nowrap {{ Request::is('terminos') ? 'active text-mars' : '' }}" href="/terminos">Términos</a>
                </div>
    
                {{-- ZONA DERECHA: BUSCADOR Y BOTÓN DEL CARRITO --}}
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    
                    {{-- FORMULARIO DE BÚSQUEDA
                         Manda los datos por método GET a la ruta '/catalogo'. La variable se llama 'q' (Query). --}}
                    <form class="d-flex" action="/catalogo" method="GET">
                        <div class="input-group">
                            <input class="form-control input-charcoal text-light border-0 shadow-none" type="search" placeholder="Buscar..." name="q" style="background-color: #1a1d27;">
                            <button class="btn btn-mars-outline border-0" type="submit" style="background-color: #1a1d27;">
                                <img src="{{ asset('assets/search.svg') }}" style="width: 16px; filter: invert(1);">
                            </button>
                        </div>
                    </form>
    
                    {{-- BOTÓN DEL CARRITO (Abre el Offcanvas)
                         data-bs-toggle="offcanvas": Ordena a Bootstrap que abra un panel lateral.
                         href="#carritoLateral": Le dice exactamente QUÉ panel abrir (por su ID). --}}
                    <a class="btn btn-mars d-flex align-items-center position-relative" href="#carritoLateral" data-bs-toggle="offcanvas">
                        <img src="{{ asset('assets/cart3.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                        <span class="d-none d-xl-inline text-nowrap"></span>
                        
                        {{-- GLOBO NOTIFICADOR DE ITEMS (Badge)
                             id="cart-count-badge": JavaScript usa esto para actualizar el numerito en tiempo real.
                             d-none: Inicia oculto por defecto hasta que JS confirme que hay productos. --}}
                        <span id="cart-count-badge" class="cart-badge d-none">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>