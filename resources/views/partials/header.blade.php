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
                            style="background-color: #1a1d27; border: 1px solid #1f222e !important; min-width: 190px;">
                            <li>
                                <a href="{{ route('perfil') }}" class="dropdown-item small py-2 d-flex align-items-center gap-2" style="color: #e2e8f0;">
                                    <img src="{{ asset('assets/person-circle.svg') }}" style="width: 15px; filter: invert(0.7);">
                                    Mi Perfil
                                </a>
                            </li>
                            @if(Auth::user()->rol->nombre === 'admin')
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item small py-2 d-flex align-items-center gap-2" style="color: #FF3B3B;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#FF3B3B" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                    </svg>
                                    Panel Admin
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider" style="border-color: #1f222e;"></li>
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
