/** ===========================================================================
se encarga de:
 * 1. Leer el carrito de LocalStorage y dibujarlo.
 * 2. Calcular totales dinámicos (Subtotal + Envío).
 * 3. Mostrar/ocultar paneles condicionales (Envío a domicilio, Datos bancarios).
 * 4. Validar inputs de tarjetas en vivo (Máscaras).
 * 5. Guardar las preferencias de envío y confirmar la orden.
 * =========================================================================== */

// DOMContentLoaded: Asegura que el script solo corra cuando el HTML ya terminó de cargar
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. CARGA DE MEMORIA: Recupera los datos del carrito (o inicia un array vacío)
    const carrito = JSON.parse(localStorage.getItem('gaming_station_cart')) || [];
    
    // Referencias a etiquetas HTML donde inyectaremos los precios
    const subtotalEl = document.getElementById('checkout-subtotal');
    const envioEl = document.getElementById('checkout-envio');
    const totalEl = document.getElementById('checkout-total');
    
    let subtotal = 0;
    let costoEnvio = 0;

    // 2. RENDERIZADO DEL RESUMEN (Ticket lateral)
    const contenedorItems = document.getElementById('checkout-items');
    
    if (carrito.length === 0) {
        // Seguridad: Si entraron a la URL directo sin comprar nada
        contenedorItems.innerHTML = '<p class="text-danger small text-center fw-bold">No hay productos en el carrito.</p>';
    } else {
        // Iteramos el array para crear un bloque HTML por cada producto
        contenedorItems.innerHTML = carrito.map(item => {
            const totalItem = item.precio * item.cantidad;
            subtotal += totalItem; // Vamos sumando al acumulador global
            
            // Retornamos el HTML interpolado (Template Literals)
            return `<div class="d-flex align-items-center mb-3">
                <div class="p-1 rounded-3 me-3" style="width: 55px; height: 55px; background-color: rgba(255,255,255,0.05);">
                    <img src="${item.imagen}" class="w-100 h-100 object-fit-contain">
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1 text-white fw-bold" style="font-size: 0.9rem;">${item.nombre}</h6>
                    <small class="text-secondary">Cant: ${item.cantidad}</small>
                </div>
                <div class="text-white fw-bold small">$${totalItem.toLocaleString('es-AR')}</div>
            </div>`;
        }).join(''); // Convierte el Array resultante en un String de HTML puro
    }

    // 3. FUNCIÓN CALCULADORA: Actualiza la interfaz en tiempo real
    const actualizarTotales = () => {
        const total = subtotal + costoEnvio;
        subtotalEl.innerText = '$' + subtotal.toLocaleString('es-AR');
        
        // Operador ternario: Si hay costo muestra plata, sino muestra 'Gratis'
        envioEl.innerText = costoEnvio > 0 ? '+$' + costoEnvio.toLocaleString('es-AR') : 'Gratis';
        totalEl.innerText = '$' + total.toLocaleString('es-AR');
    };

    // 4. LÓGICA CONDICIONAL: MÉTODO DE ENVÍO
    const seccionDomicilio = document.getElementById('seccion-domicilio');
    const inputsDomicilio = document.querySelectorAll('.input-domicilio');

    // Escuchamos cambios en los "Radio Buttons" de envío
    document.querySelectorAll('input[name="tipo_envio"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.value === 'domicilio') {
                // Mostrar formulario y volver obligatorios los campos (Seguridad HTML5)
                seccionDomicilio.style.display = 'block';
                inputsDomicilio.forEach(i => i.required = true);
            } else {
                // Retiro Local: Ocultar form, quitar obligatoriedad y resetear costo de envío
                seccionDomicilio.style.display = 'none';
                inputsDomicilio.forEach(i => i.required = false);
                costoEnvio = 0;
                // Desmarcamos las opciones de correo (Andreani/Argentino)
                document.querySelectorAll('input[name="envio_precio"]').forEach(r => r.checked = false);
                actualizarTotales();
            }
        });
    });

    // Sumamos el valor del transporte seleccionado
    document.querySelectorAll('input[name="envio_precio"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            costoEnvio = parseInt(e.target.value);
            actualizarTotales();
        });
    });

    // 5. LÓGICA CONDICIONAL: MÉTODO DE PAGO
    const formTarjeta = document.getElementById('form-tarjeta');
    const infoTransf = document.getElementById('info-transferencia');

    document.querySelectorAll('input[name="metodo_pago"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.value === 'tarjeta') {
                formTarjeta.style.display = 'block';
                infoTransf.style.display = 'none';
            } else {
                formTarjeta.style.display = 'none';
                infoTransf.style.display = 'block';
            }
        });
    });

    // 6. VALIDACIONES EN VIVO (Máscaras de Input)
    const inputNumero = document.getElementById('card-number');
    const inputCvv = document.getElementById('card-cvv');

    // Expresión Regular (Regex): Reemplaza todo lo que NO (\D) sea número por vacío ('')
    if (inputNumero) {
        inputNumero.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }

    if (inputCvv) {
        inputCvv.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }

    // Máscara inteligente para la fecha: Agrega automáticamente la barra '/'
    const inputVencimiento = document.getElementById('card-expiry');
    if (inputVencimiento) {
        inputVencimiento.addEventListener('input', (e) => {
            let valor = e.target.value.replace(/\D/g, ''); // Limpiar letras
            if (valor.length > 2) {
                // Inserta '/' en el medio
                valor = valor.substring(0, 2) + '/' + valor.substring(2, 4);
            }
            e.target.value = valor;
        });
    }

    // 7. INTERCEPCIÓN DEL FORMULARIO FINAL
    document.getElementById('form-checkout').addEventListener('submit', (e) => {
        e.preventDefault(); // Evitamos que la página se recargue (comportamiento default)
        
        if (carrito.length === 0) {
            alert('El carrito está vacío. Agrega productos antes de pagar.');
            return;
        }

        // --- PUENTE HACIA LA VISTA DE ÉXITO ---
        // Guardamos si eligió "Retiro" o "Domicilio" para que la página de confirmación lo sepa
        const metodoEnvio = document.querySelector('input[name="tipo_envio"]:checked').value;
        localStorage.setItem('metodo_envio_final', metodoEnvio);

        // Vaciamos el carrito porque la compra fue "exitosa"
        localStorage.removeItem('gaming_station_cart');
        
        // Redirigimos manualmente vía JS
        window.location.href = '/confirmacion-pedido';
    });

    // Iniciar el cálculo la primera vez que se carga la página
    actualizarTotales();
});