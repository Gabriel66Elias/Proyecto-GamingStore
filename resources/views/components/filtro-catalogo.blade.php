@props(['categorias' => collect()])

    {{-- CAJA CONTENEDORA GLOBAL --}}
    <div class="filtro-container p-4 mb-5 shadow-lg">
        <div class="row g-3 align-items-end">
            
            {{-- SECCIÓN 1: FILTRO POR CATEGORÍA (Ocupa 8 de las 12 columnas disponibles en PC) --}}
            <div class="col-xl-8 col-lg-12">
                <label class="text-secondary small fw-bold mb-2 d-block text-uppercase" style="letter-spacing: 1px;">Filtrar por Categoría</label>
                <div class="d-flex flex-wrap gap-2">
                    
                    {{-- Todos comparten el name="filtro_categoria" para que solo puedas elegir uno a la vez. 
                         JavaScript escucha cuándo cambian estos inputs para ocultar las tarjetas en el catálogo. --}}
                    <input type="radio" class="btn-check" name="filtro_categoria" id="cat-todas" value="todas" checked autocomplete="off">
                    <label class="btn-filtro" for="cat-todas">Todos</label>
    
                    @foreach($categorias as $cat)
                    <input type="radio" class="btn-check" name="filtro_categoria"
                           id="cat-{{ $loop->index }}" value="{{ $cat->nombre }}" autocomplete="off">
                    <label class="btn-filtro" for="cat-{{ $loop->index }}">{{ $cat->nombre }}</label>
                    @endforeach
                </div>
            </div>
    
            {{-- SECCIÓN 2: ORDENAMIENTO DE PRECIOS--}}
            <div class="col-xl-3 col-lg-10 col-md-10">
                <label class="text-secondary small fw-bold mb-2 d-block text-uppercase" style="letter-spacing: 1px;">Ordenar por Precio</label>
                
                {{-- Desplegable personalizado  --}}
                <div class="dropdown w-100">
                    <button class="btn w-100 text-start d-flex justify-content-between align-items-center custom-select-btn" type="button" id="dropdownOrden" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="texto-orden">Predeterminado</span>
                        <span style="font-size: 10px; color: #64748b;">▼</span> 
                    </button>
                    <ul class="dropdown-menu w-100 custom-dropdown-menu" aria-labelledby="dropdownOrden">
                        <li><a class="dropdown-item custom-dropdown-item active" href="#" data-value="predeterminado">Predeterminado</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#" data-value="barato"> ▲ Más baratos primero</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#" data-value="caro">▼ Más caros primero</a></li>
                    </ul>
                </div>
                {{-- Este input oculto guarda el valor que el usuario eligió ("barato" o "caro"). 
                     JavaScript lee este input invisible para hacer los cálculos matemáticos del Array. --}}
                <input type="hidden" id="orden-precio" value="predeterminado">
            </div>
    
            {{-- SECCIÓN 3: BOTÓN DE RESETEO  --}}
            <div class="col-xl-1 col-lg-2 col-md-2">
                {{-- Botón con ID específico ('btn-limpiar-filtros') atrapado por JavaScript
                     para resetear la categoría a "Todas" y el precio a "Predeterminado". --}}
                <button type="button" id="btn-limpiar-filtros" class="btn-limpiar-modern w-100 d-flex justify-content-center align-items-center" title="Limpiar Filtros">
                    <img src="{{ asset('assets/x.svg') }}" style="width: 18px; filter: invert(0.5);">
                </button>
            </div>
    
        </div>
    </div>