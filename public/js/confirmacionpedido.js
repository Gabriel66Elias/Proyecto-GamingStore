document.addEventListener('DOMContentLoaded', () => {
    const badge = document.getElementById('cart-count-badge');
    if (badge) { badge.innerText = '0'; badge.classList.add('d-none'); }

    const mensajeEl      = document.getElementById('mensaje-envio');
    const numeroPedidoEl = document.getElementById('numero-pedido');
    const avisoTransfEl  = document.getElementById('aviso-transferencia');
    const params         = new URLSearchParams(window.location.search);
    const metodoEnvio    = params.get('envio');
    const metodoPago     = params.get('pago');
    const nroPedido      = params.get('pedido');

    if (numeroPedidoEl && nroPedido) {
        numeroPedidoEl.textContent = 'N° Pedido: ' + nroPedido;
    }

    if (metodoEnvio === 'retiro') {
        mensajeEl.innerHTML = 'Te avisaremos por correo cuando tu pedido esté listo para ser retirado en nuestro local.';
    } else if (metodoEnvio === 'domicilio') {
        mensajeEl.innerHTML = 'Se le enviará a su correo el código de seguimiento de su pedido.';
    } else {
        mensajeEl.innerHTML = 'Tu pedido fue procesado correctamente. Nos comunicaremos pronto.';
    }

    // Pago por transferencia: avisar que falta subir el comprobante desde el perfil
    if (metodoPago === 'transferencia' && avisoTransfEl) {
        avisoTransfEl.style.display = 'block';
    }
});
