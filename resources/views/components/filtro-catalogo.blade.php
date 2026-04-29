
{{-- ESTILOS ESPECÍFICOS DEL COMPONENTE --}}
     <style>
        /* ... Las propiedades CSS dan colores a los botones 
           '.btn-check:checked + .btn-filtro' aplica un estilo iluminado solo cuando el input oculto está activado ... */
        .filtro-container { background-color: #11131A !important; border: 1px solid #1f222e !important; border-radius: 1rem; }
        .btn-filtro { background-color: #1a1d27; border: 1px solid #2d313f; color: #94a3b8; border-radius: 0.5rem; padding: 0.5rem 0.9rem; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-filtro:hover { border-color: #FF3B3B; color: #fff; background-color: rgba(255, 59, 59, 0.05); }
        .btn-check:checked + .btn-filtro { background-color: rgba(255, 59, 59, 0.15) !important; border-color: #FF3B3B !important; color: #fff !important; box-shadow: 0 0 15px rgba(255, 59, 59, 0.1); }
        .btn-limpiar-modern { background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.1); color: #64748b; border-radius: 0.5rem; padding: 0.5rem; transition: all 0.3s ease; height: 42px; }
        .btn-limpiar-modern:hover { border-color: #FF3B3B; color: #FF3B3B; background-color: rgba(255, 59, 59, 0.05); }
        .custom-select-btn { background-color: #1a1d27 !important; border: 1px solid #2d313f !important; color: #ffffff !important; height: 42px; border-radius: 0.5rem; box-shadow: none !important; transition: all 0.3s ease; font-size: 0.9rem; }
        .custom-select-btn:focus, .custom-select-btn:hover { border-color: #FF3B3B !important; }
        .custom-dropdown-menu { background-color: #11131A; border: 1px solid #2d313f; border-radius: 0.5rem; padding: 0.5rem 0; box-shadow: 0 10px 25px rgba(0,0,0,0.8); margin-top: 5px !important; }
        .custom-dropdown-item { color: #94a3b8; padding: 0.5rem 1rem; font-size: 0.9rem; transition: all 0.2s ease; }
        .custom-dropdown-item:hover, .custom-dropdown-item:focus { background-color: rgba(255, 59, 59, 0.1); color: #ffffff; }
        .custom-dropdown-item.active { background-color: rgba(255, 59, 59, 0.15); color: #FF3B3B; font-weight: bold; }
    </style>
    
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
    
                    <input type="radio" class="btn-check" name="filtro_categoria" id="cat-consolas" value="Consolas" autocomplete="off">
                    <label class="btn-filtro" for="cat-consolas">Consolas</label>
    
                    <input type="radio" class="btn-check" name="filtro_categoria" id="cat-hardware" value="Hardware" autocomplete="off">
                    <label class="btn-filtro" for="cat-hardware">Hardware</label>
    
                    <input type="radio" class="btn-check" name="filtro_categoria" id="cat-perifericos" value="Periféricos" autocomplete="off">
                    <label class="btn-filtro" for="cat-perifericos">Periféricos</label>
    
                    <input type="radio" class="btn-check" name="filtro_categoria" id="cat-tvs" value="TVs y Monitores" autocomplete="off">
                    <label class="btn-filtro" for="cat-tvs">TVs & Monitores</label>
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