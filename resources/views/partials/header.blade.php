@php
    $isAdmin = Auth::check() && Auth::user()->rol && Auth::user()->rol->nombre === 'admin';
@endphp

@if($isAdmin && request()->is('admin*'))
{{-- ================================================================
     HEADER ADMIN (solo en rutas /admin/*)
     ================================================================ --}}
<nav class="navbar navbar-expand-lg navbar-dark border-bottom py-3 sticky-top admin-navbar"
     style="z-index: 1040; background-color: #11131A;">
    <div class="container">

        {{-- LOGO + badge ADMIN --}}
        <a class="navbar-brand fw-bold fs-4 logo-text" href="{{ route('admin.dashboard') }}">
            GAMING<span class="text-mars">STATION</span>
            <span class="admin-mode-badge">ADMIN</span>
        </a>

        {{-- BOTÓN HAMBURGUESA (solo mobile) --}}
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
                aria-controls="navbarAdmin" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">

            {{-- LINKS ADMIN: a la izquierda del logo, empujando al usuario a la derecha --}}
            <div class="d-flex flex-wrap align-items-center gap-1 me-auto ms-lg-3 mt-3 mt-lg-0">

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-header-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                    </svg>
                    Dashboard
                </a>

                <span class="admin-nav-divider d-none d-lg-block"></span>

                <a href="{{ route('admin.productos') }}"
                   class="admin-header-link {{ request()->routeIs('admin.productos*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    Productos
                </a>

                <a href="{{ route('admin.stock') }}"
                   class="admin-header-link {{ request()->routeIs('admin.stock') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                    </svg>
                    Stock
                </a>

                <a href="{{ route('admin.consultas') }}"
                   class="admin-header-link {{ request()->routeIs('admin.consultas') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    </svg>
                    Consultas
                </a>

                <a href="{{ route('admin.pedidos') }}"
                   class="admin-header-link {{ request()->routeIs('admin.pedidos') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                    </svg>
                    Pedidos
                </a>

            </div>

            {{-- ZONA DERECHA: usuario admin --}}
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <div class="dropdown">
                    <button class="ud-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="ud-trigger-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </span>
                        <span class="ud-trigger-name">{{ Auth::user()->nombre }}</span>
                        <svg class="ud-trigger-chevron" xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>

                    <div class="ud-menu dropdown-menu dropdown-menu-end">

                        <div class="ud-header">
                            <div class="ud-header-avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="ud-header-name">{{ Auth::user()->nombre }}</div>
                                <div class="ud-header-role admin">Administrador</div>
                            </div>
                        </div>

                        <div class="ud-items">
                            <a href="{{ route('perfil') }}" class="ud-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                                Mi Perfil
                            </a>
                            <a href="/" class="ud-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5v-4h3v4H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354z"/>
                                </svg>
                                Ver la tienda
                            </a>
                        </div>

                        <div class="ud-divider"></div>

                        <div class="ud-items">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="ud-item ud-item--logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                    </svg>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>

@else
{{-- ================================================================
     HEADER NORMAL (usuarios no admin o no autenticados)
     Si el usuario es admin navegando la tienda, se muestra la barra admin encima.
     ================================================================ --}}
@if($isAdmin)
    @include('partials.admin-bar')
@endif

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
     style="z-index: 1040; background-color: #11131A; border-bottom-color: #1f222e !important;{{ $isAdmin ? ' top: 40px;' : '' }}">
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
                        <button class="ud-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="ud-trigger-avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                            </span>
                            <span class="ud-trigger-name">{{ Auth::user()->nombre }}</span>
                            <svg class="ud-trigger-chevron" xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </button>

                        <div class="ud-menu dropdown-menu dropdown-menu-end">

                            {{-- Cabecera con info del usuario --}}
                            <div class="ud-header">
                                <div class="ud-header-avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="ud-header-name">{{ Auth::user()->nombre }}</div>
                                    <div class="ud-header-role {{ $isAdmin ? 'admin' : 'user' }}">
                                        {{ $isAdmin ? 'Administrador' : 'Cliente' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Links --}}
                            <div class="ud-items">
                                <a href="{{ route('perfil') }}" class="ud-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                    </svg>
                                    Mi Perfil
                                </a>

                                @if($isAdmin)
                                <a href="{{ route('admin.dashboard') }}" class="ud-item ud-item--panel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                    </svg>
                                    Panel de Admin
                                </a>
                                @endif
                            </div>

                            <div class="ud-divider"></div>

                            {{-- Cerrar sesión --}}
                            <div class="ud-items">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ud-item ud-item--logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                        </svg>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="ud-login-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        Ingresar
                    </a>
                @endauth

                {{-- CARRITO: solo para usuarios normales. El admin ve un chip de "Vista previa". --}}
                @if(!$isAdmin)
                <a class="btn btn-mars d-flex align-items-center position-relative" href="#carritoLateral" data-bs-toggle="offcanvas">
                    <img src="{{ asset('assets/cart3.svg') }}" class="me-2" style="width: 20px; filter: invert(1);">
                    <span class="d-none d-xl-inline text-nowrap"></span>
                    <span id="cart-count-badge" class="cart-badge d-none">0</span>
                </a>
                @else
                <span class="admin-preview-chip">
                    <span class="admin-preview-chip-dot"></span>
                    Vista previa
                </span>
                @endif

            </div>
        </div>
    </div>
</nav>
@endif
