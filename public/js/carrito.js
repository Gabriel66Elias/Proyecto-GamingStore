
// 1. ESTADO GLOBAL (Variables de la sesión actual)
// JSON.parse() transforma la cadena de texto guardada en el navegador en un Array de objetos reales.
// El "|| []" asegura que si no hay nada guardado (null), el carrito inicie como un array vacío.
let carrito = JSON.parse(localStorage.getItem('gaming_station_cart')) || [];

/**
 * FUNCIÓN: agregarAlCarrito
 * DESCRIPCIÓN: Recibe los datos de un producto, valida el stock y lo inserta en el array.
 */
function agregarAlCarrito(id, nombre, precio, stock, imagen) {
    id = String(id); // Estandarizamos el ID a formato texto para evitar errores de búsqueda
    
    // Captura el cuadro numérico si el usuario está en la vista de detalle
    const inputCant = document.getElementById('input-cantidad');
    // Si el cuadro existe, tomamos su valor numérico (parseInt). Si no existe (ej. estamos en catálogo), agregamos 1.
    const cantidadSeleccionada = inputCant ? parseInt(inputCant.value) : 1;

    // Método .find(): Recorre el array buscando si el ID del producto nuevo ya existe adentro.
    const itemExistente = carrito.find(item => item.id === id);

    if (itemExistente) {
        // Lógica de control de Stock: Evita que el usuario agregue más de lo que hay en inventario
        if (itemExistente.cantidad + cantidadSeleccionada > stock) {
            alert(`Stock insuficiente. Solo quedan ${stock} unidades.`);
            return; // Corta la ejecución de la función
        }
        itemExistente.cantidad += cantidadSeleccionada; // Suma a la cantidad existente
    } else {
        // Si el método .find() devolvió undefined, significa que es nuevo. Lo insertamos (push) al array.
        carrito.push({ id, nombre, precio, stock, imagen, cantidad: cantidadSeleccionada });
    }

    actualizarInterfaz(); // Guardamos cambios y dibujamos la vista

    // Feedback UI: Al agregar, le damos una orden a Bootstrap para que despliegue el menú lateral automáticamente
    const cartEl = document.getElementById('carritoLateral');
    if (cartEl) {
        const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(cartEl);
        bsOffcanvas.show();
    }
}

/**
 * FUNCIÓN: actualizarCantidad
 * DESCRIPCIÓN: Se activa cuando el usuario tipea un número nuevo dentro del input en el panel del carrito.
 */
function actualizarCantidad(id, nuevaCantidad) {
    const item = carrito.find(item => item.id === id);
    if (!item) return;

    nuevaCantidad = parseInt(nuevaCantidad);

    // Validación: Si el usuario escribe un número mayor al stock, lo bloquea.
    if (nuevaCantidad > item.stock) {
        alert(`Límite de stock alcanzado: ${item.stock} unidades.`);
        renderizarCarrito(); // Redibuja la vista para borrar el número excedido que tipeó el usuario
        return;
    }

    // Validación: Si baja a 0 o números negativos, interpreta que lo quiere borrar.
    if (nuevaCantidad <= 0) {
        eliminarItem(id);
    } else {
        item.cantidad = nuevaCantidad; // Actualiza el objeto
        actualizarInterfaz(); // Guarda y redibuja
    }
}

/**
 * FUNCIÓN: eliminarItem
 * DESCRIPCIÓN: Quita un producto entero del array.
 */
function eliminarItem(id) {
    // El método .filter() crea un array NUEVO, quedándose solo con los ítems que NO coincidan con el ID seleccionado.
    carrito = carrito.filter(item => item.id !== id);
    actualizarInterfaz();
}

/**
 * FUNCIÓN: vaciarCarrito
 * DESCRIPCIÓN: Borra todos los elementos de una sola vez.
 */
function vaciarCarrito() {
    // Muestra ventana nativa de confirmación
    if (confirm('¿Deseas eliminar todos los productos del carrito?')) {
        carrito = []; // Sobrescribe el array a vacío
        actualizarInterfaz();
    }
}

/**
 * FUNCIÓN: actualizarInterfaz
 * DESCRIPCIÓN: Funciona como un "Guardar". Sincroniza la RAM temporal con el disco duro del navegador.
 */
function actualizarInterfaz() {
    // JSON.stringify() convierte el array de objetos a un formato de texto plano (String) que el navegador sabe almacenar.
    localStorage.setItem('gaming_station_cart', JSON.stringify(carrito));
    renderizarCarrito(); // Tras guardar, actualiza el HTML
}

/**
 * FUNCIÓN: renderizarCarrito
 * DESCRIPCIÓN: Toma el array y construye dinámicamente todo el código HTML necesario para mostrar los productos.
 */
function renderizarCarrito() {
    const contenedor = document.getElementById('contenedor-items-carrito');
    const totalTxt = document.getElementById('total-carrito');
    const badge = document.getElementById('cart-count-badge');

    if (!contenedor) return; // Si la página actual no tiene carrito lateral, corta aquí.

    // Método .reduce(): Acumula valores de un array. Aquí suma todas las "cantidades" para saber el volumen de productos.
    const totalProductos = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    
    // Si hay productos, muestra la burbuja roja en la Navbar, si no, le pone display:none (d-none).
    if (totalProductos > 0) {
        badge.innerText = totalProductos;
        badge.classList.remove('d-none');
    } else {
        badge.classList.add('d-none');
    }

    // Dibujado: Estado Vacío
    if (carrito.length === 0) {
        contenedor.innerHTML = `
            <div class="text-center mt-5 opacity-50">
                <img src="/assets/cart3.svg" style="width: 48px; height: 48px; filter: invert(1); opacity: 0.5;">
                <p class="mt-3 text-white fw-light">Tu carrito está vacío</p>
            </div>`;
        totalTxt.innerText = '$0';
        return;
    }

    // Dibujado: Estado Lleno
    let totalGeneral = 0;
    // Método .map(): Transforma cada objeto del array en un bloque grande de texto HTML (Template Literals ``)
    // El método .join('') une todos esos bloques de texto generados en un solo String gigante.
    contenedor.innerHTML = carrito.map(item => {
        totalGeneral += item.precio * item.cantidad; // Va acumulando precio en cada ciclo
        return `
            <div class="cart-item-modern d-flex align-items-center">
                
                <button class="btn-eliminar-carrito" onclick="eliminarItem('${item.id}')" title="Eliminar producto">&times;</button>
                
                <div class="cart-item-img me-3">
                    <img src="${item.imagen}" alt="${item.nombre}" class="w-100 h-100 object-fit-contain">
                </div>
                
                <div class="grow">
                    <h6 class="mb-1 text-white fw-bold pe-4" style="font-size: 0.95rem;">${item.nombre}</h6>
                    <div class="text-success fw-bold mb-2">$${(item.precio * item.cantidad).toLocaleString('es-AR')}</div>
                    
                    <input type="number" class="input-dark text-center" value="${item.cantidad}" min="1" 
                           style="width: 60px; height: 32px; border-radius: 6px; padding: 0;" 
                           onchange="actualizarCantidad('${item.id}', this.value)">
                </div>
            </div>`;
    }).join(''); // Reemplaza el innerHTML completo del contenedor con este String de tarjetas.

    // Aplica el formato de moneda Argentina (Puntos en miles) al total.
    totalTxt.innerText = '$' + totalGeneral.toLocaleString('es-AR');
}

/**
 * FUNCIÓN: finalizarCompra
 * DESCRIPCIÓN: Redirige a la página de pago.
 */
function finalizarCompra() {
    if (carrito.length === 0) return alert('El carrito está vacío.');
    window.location.href = '/comercializacion'; // Redirección vía JavaScript
}

// EventListener: Cuando el archivo HTML termine de cargar todo su esqueleto, dispara la función de renderizado.
document.addEventListener('DOMContentLoaded', renderizarCarrito);