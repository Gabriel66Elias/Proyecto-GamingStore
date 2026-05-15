<style>
    @media (min-width: 992px) {
        .nav-links-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark border-bottom py-3 sticky-top"
     style="z-index: 1040; background-color: #11131A; border-bottom-color: #1f222e !important;">
    <div class="container position-relative">

        {{-- LOGO: fijo a la izquierda --}}
        <a class="navbar-brand fw-bold fs-4 logo-text" href="/">GAMING<span class="text-mars">STATION</span></a>

        {{-- BOTÓN HAMBURGUESA (solo mobile) --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- LINKS: centrados fijos en desktop, flujo normal en mobile --}}
            <div class="navbar-nav nav-links-center align-items-center gap-1 mt-3 mt-lg-0">
                <a class="nav-link px-2 text-nowrap {{ Request::is('/') ? 'active text-mars' : '' }}" href="/">Inicio</a>
                <a class="nav-link px-2 text-nowrap {{ Request::is('quienes-somos') ? 'active text-mars' : '' }}" href="/quienes-somos">Quiénes Somos</a>
                <a class="nav-link px-2 text-nowrap {{ Request::is('catalogo') ? 'active text-mars' : '' }}" href="/catalogo">Catálogo</a>
                <a class="nav-link px-2 text-nowrap {{ Request::is('contacto') ? 'active text-mars' : '' }}" href="/contacto">Contacto</a>
                <a class="nav-link px-2 text-nowrap {{ Request::is('terminos') ? 'active text-mars' : '' }}" href="/terminos">Términos</a>
            </div>

            {{-- ZONA DERECHA: fija a la derecha --}}
            <div class="ms-auto d-flex align-items-center gap-3 mt-3 mt-lg-0">

                {{-- USUARIO --}}
                @auth
                    <div class="dropdown">
                        <button class="btn border-0 p-0 d-flex align-items-center gap-2"
                                data-bs-toggle="dropdown" style="background: transparent;">
                            <img src="{{ asset('assets/person-circle.svg') }}" style="width: 22px; filter: invert(1);">
                            <span class="text-light small fw-semibold text-nowrap">{{ Auth::user()->nombre }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-0 shadow"
                            style="background-color: #1a1d27; border: 1px solid #1f222e !important; min-width: 160px;">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item small py-2" style="color: #FF3B3B;">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn border-0 p-0 d-flex align-items-center gap-2"
                       style="background: transparent;">
                        <img src="{{ asset('assets/person-circle.svg') }}" style="width: 22px; filter: invert(0.55);">
                        <span class="text-secondary small fw-semibold">Ingresar</span>
                    </a>
                @endauth

                {{-- CARRITO --}}
                <a class="btn btn-mars d-flex align-items-center position-relative" href="#carritoLateral" data-bs-toggle="offcanvas">
                    <img src="{{ asset('assets/cart3.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                    <span class="d-none d-xl-inline text-nowrap"></span>
                    <span id="cart-count-badge" class="cart-badge d-none">0</span>
                </a>

            </div>
        </div>
    </div>
</nav>
