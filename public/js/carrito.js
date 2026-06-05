// Token CSRF leído del meta tag que inyecta Laravel en el layout
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

const headersJSON = {
    'Content-Type': 'application/json',
    'Accept':       'application/json',
    'X-CSRF-TOKEN': CSRF,
};

// Carga el carrito desde el servidor y renderiza el panel lateral
async function cargarCarrito() {
    try {
        const res  = await fetch('/carrito/datos', { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        renderizarCarrito(data.items ?? [], data.total ?? 0);
    } catch {
        renderizarCarrito([], 0);
    }
}

// Envía un producto al backend y actualiza el panel lateral
async function agregarAlCarrito(productoId) {
    const inputCant = document.getElementById('input-cantidad');
    const cantidad  = inputCant ? parseInt(inputCant.value) || 1 : 1;

    const res = await fetch('/carrito/agregar', {
        method: 'POST',
        headers: headersJSON,
        body: JSON.stringify({ producto_id: productoId, cantidad }),
    });

    if (res.status === 401) { window.location.href = '/login'; return; }

    const data = await res.json();
    if (!res.ok) { alert(data.error ?? 'Error al agregar el producto'); return; }

    renderizarCarrito(data.items, data.total);

    const cartEl = document.getElementById('carritoLateral');
    if (cartEl) bootstrap.Offcanvas.getOrCreateInstance(cartEl).show();
}

// Actualiza la cantidad de un ítem existente en el carrito
async function actualizarCantidad(detalleId, nuevaCantidad, stock) {
    nuevaCantidad = parseInt(nuevaCantidad);

    if (nuevaCantidad <= 0) { eliminarItem(detalleId); return; }

    if (nuevaCantidad > stock) {
        alert(`Límite de stock alcanzado: ${stock} unidades.`);
        cargarCarrito();
        return;
    }

    const res = await fetch(`/carrito/${detalleId}`, {
        method: 'PATCH',
        headers: headersJSON,
        body: JSON.stringify({ cantidad: nuevaCantidad }),
    });

    if (!res.ok) {
        const data = await res.json();
        alert(data.error ?? 'Error al actualizar la cantidad');
        cargarCarrito();
        return;
    }

    const data = await res.json();
    renderizarCarrito(data.items, data.total);
}

// Elimina un ítem del carrito por su ID de detalle
async function eliminarItem(id) {
    const res = await fetch(`/carrito/${id}`, { method: 'DELETE', headers: headersJSON });
    if (!res.ok) return;
    const data = await res.json();
    renderizarCarrito(data.items, data.total);
}

// Elimina todos los ítems del carrito
async function vaciarCarrito() {
    if (!confirm('¿Deseas eliminar todos los productos del carrito?')) return;

    const res = await fetch('/carrito/vaciar', { method: 'POST', headers: headersJSON });
    if (res.status === 401) { window.location.href = '/login'; return; }
    if (!res.ok) return;

    const data = await res.json();
    renderizarCarrito(data.items, data.total);
}

// Confirma la compra y redirige a la página de confirmación
async function finalizarCompra() {
    const res = await fetch('/carrito/confirmar', { method: 'POST', headers: headersJSON });

    if (res.status === 401) { window.location.href = '/login'; return; }

    const data = await res.json();
    if (!res.ok) { alert(data.error ?? 'Error al confirmar la compra'); return; }

    window.location.href = data.redirect;
}

// Dibuja el contenido del panel lateral con los datos recibidos del servidor
function renderizarCarrito(items, total) {
    const contenedor = document.getElementById('contenedor-items-carrito');
    const totalTxt   = document.getElementById('total-carrito');
    const badge      = document.getElementById('cart-count-badge');

    if (!contenedor) return;

    const totalProductos = items.reduce((sum, item) => sum + item.cantidad, 0);

    if (badge) {
        badge.innerText = totalProductos;
        badge.classList.toggle('d-none', totalProductos === 0);
    }

    if (items.length === 0) {
        contenedor.innerHTML = `
            <div class="text-center mt-5 opacity-50">
                <img src="/assets/cart3.svg" style="width: 48px; height: 48px; filter: invert(1); opacity: 0.5;">
                <p class="mt-3 text-white fw-light">Tu carrito está vacío</p>
            </div>`;
        if (totalTxt) totalTxt.innerText = '$0';
        return;
    }

    contenedor.innerHTML = items.map(item => {
        // Escapar nombre para evitar XSS al inyectar en innerHTML
        const nombre   = item.nombre.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        const subtotal = (item.precio_unitario * item.cantidad).toLocaleString('es-AR');
        return `
            <div class="cart-item-modern d-flex align-items-center">
                <button class="btn-eliminar-carrito" onclick="eliminarItem(${item.id})" title="Eliminar producto">&times;</button>
                <div class="cart-item-img me-3">
                    <img src="${item.imagen}" alt="${nombre}" class="w-100 h-100 object-fit-contain">
                </div>
                <div class="grow">
                    <h6 class="mb-1 text-white fw-bold pe-4" style="font-size: 0.95rem;">${nombre}</h6>
                    <div class="text-success fw-bold mb-2">$${subtotal}</div>
                    <input type="number" class="input-dark text-center" value="${item.cantidad}" min="1" max="${item.stock}"
                           style="width: 60px; height: 32px; border-radius: 6px; padding: 0;"
                           onchange="actualizarCantidad(${item.id}, this.value, ${item.stock})">
                </div>
            </div>`;
    }).join('');

    if (totalTxt) totalTxt.innerText = '$' + Number(total).toLocaleString('es-AR');
}

document.addEventListener('DOMContentLoaded', cargarCarrito);
