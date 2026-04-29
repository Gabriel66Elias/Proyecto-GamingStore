document.addEventListener('DOMContentLoaded', () => {
    // --- 1. CAPTURA DE ELEMENTOS DEL DOM ---
    // Selecciona todos los botones tipo "radio" (Todos, Consolas, Hardware, etc.)
    const radiosCategoria = document.querySelectorAll('input[name="filtro_categoria"]');
    // Selecciona cada sección masiva (Ej: El bloque entero de "CONSOLAS" con sus tarjetas)
    const bloquesCategoria = document.querySelectorAll('.categoria-bloque');
    const btnLimpiar = document.getElementById('btn-limpiar-filtros');
    
    const inputOrdenOculto = document.getElementById('orden-precio'); // Aquí se guarda el valor real
    const btnTextoOrden = document.getElementById('texto-orden'); // Texto visible para el usuario
    const itemsDesplegable = document.querySelectorAll('.custom-dropdown-item'); // Las opciones del menú

    /**
     * FUNCIÓN: procesarCatalogo
     * Lee los inputs actuales y oculta/muestra
     * las tarjetas HTML dependiendo de las decisiones del usuario.
     */
    function procesarCatalogo() {
        // Averigua que categoria esta seleccionada actualmente y que orden se pidio
        const catElegida = document.querySelector('input[name="filtro_categoria"]:checked').value;
        const ordenElegido = inputOrdenOculto.value; 

        // Recorre bloque por bloque (Categoría entera)
        bloquesCategoria.forEach(bloque => {
            const contenedorRow = bloque.querySelector('.row');
            // Busca todas las tarjetas de producto dentro de ese bloque y las convierte a Array real
            const productos = Array.from(bloque.querySelectorAll('.producto-item'));

            let productosVisiblesEnBloque = 0; // Contador auxiliar

            // --- FASE 1: FILTRAR VISIBILIDAD ---
            productos.forEach(p => {
                const pCat = p.getAttribute('data-categoria'); // Lee la categoría inyectada en el HTML
                
                // booleano: Pidió "todas" o pidio una categoría exacta
                const coincide = (catElegida === 'todas' || catElegida === pCat);
                
                // Modifica CSS: Si coincide la muestra (block), si no, la desaparece de pantalla (none)
                p.style.display = coincide ? 'block' : 'none';
                
                if (coincide) productosVisiblesEnBloque++; // Suma 1 a las tarjetas que quedaron visibles
            });

            // --- FASE 2: ORDENAMIENTO (SORTING) ---
            if (productosVisiblesEnBloque > 0) {
                // El método .sort() recibe 2 elementos (A y B) y decide quién va primero según la resta matemática
                productos.sort((a, b) => {
                    const precioA = parseInt(a.getAttribute('data-precio'));
                    const precioB = parseInt(b.getAttribute('data-precio'));
                    const idA = parseInt(a.getAttribute('data-id'));
                    const idB = parseInt(b.getAttribute('data-id'));

                    if (ordenElegido === 'barato') return precioA - precioB; // Positivo manda A atrás
                    if (ordenElegido === 'caro') return precioB - precioA;   // Positivo manda B atrás
                    return idA - idB; // Opción predeterminada: Ordena por el ID original
                });

                // Truco del DOM: Al hacer "appendChild" de un elemento que ya existe, no se clona,
                // sino que se mueve a la última posición. Así reorganizamos visualmente las tarjetas.
                productos.forEach(p => contenedorRow.appendChild(p));
            }

            // --- FASE 3: OCULTAR BLOQUES VACÍOS ---
            // Si el usuario eligió "Hardware" y este bloque era de "Consolas", habrán quedado 0 productos.
            // Entonces, ocultamos todo el bloque (para no dejar el título "CONSOLAS" flotando solo).
            bloque.style.display = productosVisiblesEnBloque === 0 ? 'none' : 'block';
        });
    }

    // --- 2. ASIGNACIÓN DE EVENTOS (LISTENERS) ---

    // Menú desplegable personalizado
    itemsDesplegable.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault(); // Evita que la página salte hacia arriba por el <a href="#">
            
            // Borra el resaltado rojo de todas las opciones
            itemsDesplegable.forEach(i => i.classList.remove('active'));
            
            // Le pone resaltado rojo (active) a la que acabamos de hacer clic
            e.target.classList.add('active');
            
            // Reemplaza el texto del botón visual e inyecta la directiva real al input oculto
            btnTextoOrden.innerText = e.target.innerText;
            inputOrdenOculto.value = e.target.getAttribute('data-value');
            
            // Dispara el cálculo visual
            procesarCatalogo();
        });
    });

    // Si cambia cualquiera de los botones de Categoría (Radio buttons), ejecuta el cálculo
    radiosCategoria.forEach(r => r.addEventListener('change', procesarCatalogo));

    // Botón de la "X" (Limpiar Filtros)
    btnLimpiar.addEventListener('click', () => {
        // Resetea forzosamente la Categoría
        document.getElementById('cat-todas').checked = true;
        
        // Resetea el ordenamiento (Input y visual)
        inputOrdenOculto.value = 'predeterminado';
        btnTextoOrden.innerText = 'Predeterminado';
        
        // Regresa la clase 'active' al valor predeterminado del desplegable
        itemsDesplegable.forEach(i => i.classList.remove('active'));
        document.querySelector('.custom-dropdown-item[data-value="predeterminado"]').classList.add('active');
        
        // Vuelve a calcular todo (básicamente restaura el estado original)
        procesarCatalogo();
    });
});