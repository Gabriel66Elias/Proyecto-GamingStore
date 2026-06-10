const CSRF_CO = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

function mostrarNotificacion(mensaje, tipo = 'info') {
    const container = document.getElementById('co-toast-container');
    if (!container) return;
    const cfg = {
        success: { bg: 'rgba(34,197,94,.1)',  border: 'rgba(34,197,94,.3)',  color: '#4ade80' },
        error:   { bg: 'rgba(239,68,68,.1)',  border: 'rgba(239,68,68,.3)',  color: '#f87171' },
        warning: { bg: 'rgba(251,191,36,.1)', border: 'rgba(251,191,36,.3)', color: '#fbbf24' },
        info:    { bg: 'rgba(99,102,241,.1)', border: 'rgba(99,102,241,.3)', color: '#818cf8' },
    }[tipo] || { bg: 'rgba(99,102,241,.1)', border: 'rgba(99,102,241,.3)', color: '#818cf8' };
    const el = document.createElement('div');
    el.style.cssText = `background:${cfg.bg};border:1px solid ${cfg.border};border-radius:10px;padding:.75rem 1rem;font-size:.83rem;color:${cfg.color};font-weight:600;pointer-events:all;box-shadow:0 4px 20px rgba(0,0,0,.5);`;
    el.innerHTML = mensaje;
    container.appendChild(el);
    setTimeout(() => { el.style.transition='opacity .3s'; el.style.opacity='0'; setTimeout(() => el.remove(), 300); }, 4000);
}

// ─── CALCULADORA DE ENVÍO POR CÓDIGO POSTAL ──────────────────────────────────
// Zonas basadas en rangos de CP argentinos (mock realista)
const ZONAS_CP = [
    { min: 3400, max: 3499, zona: 'Corrientes',          provincia: 'Corrientes',         andreani: 5500,  correo: 6200  },
    { min: 3300, max: 3399, zona: 'Misiones',             provincia: 'Misiones',            andreani: 7500,  correo: 8300  },
    { min: 3500, max: 3599, zona: 'Chaco',                provincia: 'Chaco',               andreani: 7800,  correo: 8700  },
    { min: 3600, max: 3699, zona: 'Formosa',              provincia: 'Formosa',             andreani: 8500,  correo: 9400  },
    { min: 3100, max: 3299, zona: 'Entre Ríos',           provincia: 'Entre Ríos',          andreani: 9800,  correo: 10800 },
    { min: 3000, max: 3099, zona: 'Santa Fe (Rosario)',   provincia: 'Santa Fe',            andreani: 11000, correo: 12100 },
    { min: 2000, max: 2399, zona: 'Santa Fe (interior)',  provincia: 'Santa Fe',            andreani: 11000, correo: 12100 },
    { min: 4000, max: 4199, zona: 'Tucumán',              provincia: 'Tucumán',             andreani: 12000, correo: 13200 },
    { min: 4200, max: 4349, zona: 'Santiago del Estero',  provincia: 'Santiago del Estero', andreani: 12000, correo: 13200 },
    { min: 4400, max: 4499, zona: 'Salta',                provincia: 'Salta',               andreani: 12800, correo: 14100 },
    { min: 4600, max: 4699, zona: 'Jujuy',                provincia: 'Jujuy',               andreani: 13500, correo: 14800 },
    { min: 4700, max: 4799, zona: 'Catamarca',            provincia: 'Catamarca',           andreani: 13200, correo: 14500 },
    { min: 5000, max: 5299, zona: 'Córdoba',              provincia: 'Córdoba',             andreani: 12500, correo: 13800 },
    { min: 5300, max: 5399, zona: 'La Rioja',             provincia: 'La Rioja',            andreani: 14500, correo: 15900 },
    { min: 5400, max: 5499, zona: 'San Juan',             provincia: 'San Juan',            andreani: 14500, correo: 15900 },
    { min: 5500, max: 5699, zona: 'Mendoza',              provincia: 'Mendoza',             andreani: 15200, correo: 16700 },
    { min: 5700, max: 5899, zona: 'San Luis',             provincia: 'San Luis',            andreani: 14200, correo: 15600 },
    { min: 1000, max: 1499, zona: 'CABA',                 provincia: 'CABA',                andreani: 14000, correo: 15400 },
    { min: 1500, max: 1999, zona: 'Gran Buenos Aires',    provincia: 'Buenos Aires',        andreani: 14000, correo: 15400 },
    { min: 6200, max: 6399, zona: 'La Pampa',             provincia: 'La Pampa',            andreani: 15000, correo: 16500 },
    { min: 6000, max: 7999, zona: 'Buenos Aires (Prov.)', provincia: 'Buenos Aires',        andreani: 13500, correo: 14800 },
    { min: 8300, max: 8399, zona: 'Neuquén',              provincia: 'Neuquén',             andreani: 17000, correo: 18700 },
    { min: 8400, max: 8499, zona: 'Río Negro',            provincia: 'Río Negro',           andreani: 17000, correo: 18700 },
    { min: 9000, max: 9199, zona: 'Chubut',               provincia: 'Chubut',              andreani: 19500, correo: 21400 },
    { min: 9200, max: 9399, zona: 'Santa Cruz',           provincia: 'Santa Cruz',          andreani: 21500, correo: 23600 },
    { min: 9400, max: 9499, zona: 'Tierra del Fuego',     provincia: 'Tierra del Fuego',    andreani: 24000, correo: 26400 },
];

function calcularCostoCP(cp) {
    const codigo = parseInt(String(cp).trim());
    if (isNaN(codigo) || String(cp).trim().length < 4) return null;
    for (const z of ZONAS_CP) {
        if (codigo >= z.min && codigo <= z.max) return z;
    }
    // Fallback genérico para CPs válidos no catalogados
    return { zona: 'Argentina', andreani: 15000, correo: 16500 };
}

// ─── INIT ─────────────────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', async () => {

    // ── 1. CARGAR CARRITO DESDE EL SERVIDOR ──────────────────────────────────
    let carritoItems = [];
    let subtotal     = 0;

    try {
        const res  = await fetch('/carrito/datos', { headers: { Accept: 'application/json' } });
        const data = await res.json();
        carritoItems = data.items ?? [];
        subtotal     = data.total  ?? 0;
    } catch { /* sin conexión */ }

    // ── 2. RENDERIZAR RESUMEN ─────────────────────────────────────────────────
    const contenedorItems = document.getElementById('checkout-items');
    const subtotalEl      = document.getElementById('checkout-subtotal');
    const envioEl         = document.getElementById('checkout-envio');
    const totalEl         = document.getElementById('checkout-total');

    let costoEnvio = 0;

    if (carritoItems.length === 0) {
        contenedorItems.innerHTML = `
            <p class="text-center text-danger small fw-bold">
                Tu carrito está vacío.
                <a href="/catalogo" class="text-mars">Ver catálogo</a>
            </p>`;
    } else {
        contenedorItems.innerHTML = carritoItems.map(item => {
            const nombre = item.nombre.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            return `
            <div class="co-summary-item">
                <div class="co-summary-img">
                    <img src="${item.imagen}" alt="${nombre}">
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="text-white fw-semibold text-truncate" style="font-size:.82rem;">${nombre}</div>
                    <div class="text-secondary" style="font-size:.75rem;">Cant: ${item.cantidad}</div>
                </div>
                <div class="text-white fw-bold" style="font-size:.85rem;white-space:nowrap;">
                    $${item.subtotal.toLocaleString('es-AR')}
                </div>
            </div>`;
        }).join('');
    }

    // ── 3. ACTUALIZAR TOTALES ─────────────────────────────────────────────────
    const actualizarTotales = () => {
        const grand = subtotal + costoEnvio;
        subtotalEl.textContent = '$' + subtotal.toLocaleString('es-AR');
        envioEl.textContent    = costoEnvio > 0 ? '+$' + costoEnvio.toLocaleString('es-AR') : 'Gratis';
        envioEl.style.color    = costoEnvio > 0 ? '#e2e8f0' : '#4ade80';
        totalEl.textContent    = '$' + grand.toLocaleString('es-AR');
    };
    actualizarTotales();

    // ── 4. PASO VISUAL (steps indicator) ─────────────────────────────────────
    const activarStep = (n) => {
        for (let i = 1; i <= 3; i++) {
            const el = document.getElementById(`step-${i}`);
            if (!el) continue;
            el.classList.remove('active', 'done');
            if (i < n) el.classList.add('done');
            if (i === n) el.classList.add('active');
        }
    };

    const billing   = ['billing-nombre','billing-apellido','billing-email','billing-telefono'];
    const shipping  = ['tipo_envio'];

    document.querySelectorAll('#billing-nombre, #billing-apellido, #billing-email, #billing-telefono').forEach(el => {
        el.addEventListener('input', () => {
            const allFilled = billing.every(id => document.getElementById(id)?.value?.trim());
            activarStep(allFilled ? 2 : 1);
        });
    });

    document.querySelectorAll('input[name="metodo_pago"]').forEach(r => {
        r.addEventListener('change', () => activarStep(3));
    });

    // ── 5. CALCULADORA CÓDIGO POSTAL ─────────────────────────────────────────
    const inputCP    = document.getElementById('input-cp');
    const cpResult   = document.getElementById('cp-result');
    const btnCalc    = document.getElementById('btn-calcular-cp');
    const labelEnvio = document.getElementById('label-costo-envio');
    const precioAnd  = document.getElementById('precio-andreani');
    const precioCorr = document.getElementById('precio-correo');
    const inputCpFinal = document.getElementById('envio-cp-final');

    let cpData = null;

    function setProvince(name) {
        const hidden = document.getElementById('envio-provincia');
        const texto  = document.getElementById('texto-provincia');
        if (hidden) hidden.value = name;
        if (texto) { texto.textContent = name; texto.style.color = '#e2e8f0'; }
        document.querySelectorAll('.prov-item').forEach(el => {
            const sel = el.dataset.prov === name;
            el.style.color      = sel ? '#FF3B3B' : '';
            el.style.background = sel ? 'rgba(255,59,59,.1)' : '';
            el.style.fontWeight = sel ? '700' : '';
        });
    }

    const seccionTransportes = document.getElementById('seccion-transportes');

    function aplicarCP(cp) {
        if (!cp || cp.length < 4) {
            cpResult.style.display = 'none';
            return;
        }
        const result = calcularCostoCP(cp);
        if (!result) {
            cpResult.className = 'co-cp-result error';
            cpResult.style.display = 'block';
            cpResult.innerHTML = '<img src="/assets/x.svg" style="width:12px;filter:invert(.6);margin-right:5px;vertical-align:middle;"> Código postal no reconocido. Ingresá un CP válido de Argentina.';
            if (seccionTransportes) seccionTransportes.style.display = 'none';
            return;
        }
        cpData = result;
        cpResult.className = 'co-cp-result ok';
        cpResult.style.display = 'block';
        cpResult.innerHTML = `<img src="/assets/check2.svg" style="width:13px;filter:invert(.45) sepia(1) saturate(3) hue-rotate(90deg);margin-right:6px;vertical-align:middle;"><strong>${result.zona}</strong> — Andreani: <strong>$${result.andreani.toLocaleString('es-AR')}</strong> | Correo Argentino: <strong>$${result.correo.toLocaleString('es-AR')}</strong>`;

        // Mostrar sección de transporte y dirección
        if (seccionTransportes) seccionTransportes.style.display = 'block';

        // Auto-completar provincia y CP
        if (result.provincia) setProvince(result.provincia);
        if (inputCpFinal) inputCpFinal.value = cp;

        // Actualizar precios en los botones de transporte
        if (precioAnd)  precioAnd.textContent = '$' + result.andreani.toLocaleString('es-AR');
        if (precioCorr) precioCorr.textContent = '$' + result.correo.toLocaleString('es-AR');

        // Actualizar data-costo
        const radAndreani = document.getElementById('transAndreani');
        const radCorreo   = document.getElementById('transCorreo');
        if (radAndreani) radAndreani.dataset.costo = result.andreani;
        if (radCorreo)   radCorreo.dataset.costo   = result.correo;

        // Si ya hay un transporte seleccionado, actualizar costo
        const selTrans = document.querySelector('input[name="transporte"]:checked');
        if (selTrans) {
            costoEnvio = parseInt(selTrans.dataset.costo) || 0;
            actualizarTotales();
        }
    }

    if (btnCalc) btnCalc.addEventListener('click',  () => aplicarCP(inputCP?.value?.trim()));
    if (inputCP) inputCP.addEventListener('keydown', (e) => { if (e.key === 'Enter') { e.preventDefault(); aplicarCP(inputCP.value.trim()); } });

    // Dropdown de provincias
    document.querySelectorAll('.prov-item').forEach(item => {
        item.addEventListener('click', e => { e.preventDefault(); setProvince(item.dataset.prov); });
    });

    // Recalcular al seleccionar transporte
    document.querySelectorAll('input[name="transporte"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            costoEnvio = parseInt(e.target.dataset.costo) || 0;
            if (labelEnvio) labelEnvio.textContent = '+$' + costoEnvio.toLocaleString('es-AR');
            actualizarTotales();
        });
    });

    // ── 6. MOSTRAR/OCULTAR SECCIÓN DOMICILIO ─────────────────────────────────
    const seccionDomicilio = document.getElementById('seccion-domicilio');
    const inputsDom        = document.querySelectorAll('.co-dom');

    document.querySelectorAll('input[name="tipo_envio"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.value === 'domicilio') {
                seccionDomicilio.style.display = 'block';
                inputsDom.forEach(i => i.required = true);
            } else {
                seccionDomicilio.style.display = 'none';
                if (seccionTransportes) seccionTransportes.style.display = 'none';
                inputsDom.forEach(i => { i.required = false; });
                costoEnvio = 0;
                document.querySelectorAll('input[name="transporte"]').forEach(r => r.checked = false);
                if (labelEnvio) labelEnvio.textContent = 'Calculá tu envío →';
                cpData = null;
                if (cpResult) { cpResult.style.display = 'none'; }
                actualizarTotales();
            }
        });
    });

    // ── 7. MOSTRAR/OCULTAR FORMULARIOS DE PAGO ───────────────────────────────
    const formTarjeta = document.getElementById('form-tarjeta');
    const infoTransf  = document.getElementById('info-transferencia');

    document.querySelectorAll('input[name="metodo_pago"]').forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (formTarjeta) formTarjeta.style.display = e.target.value === 'tarjeta' ? 'block' : 'none';
            if (infoTransf)  infoTransf.style.display  = e.target.value === 'transferencia' ? 'block' : 'none';
        });
    });

    // ── 8. MÁSCARAS DE TARJETA ────────────────────────────────────────────────
    const numInput  = document.getElementById('card-number');
    const cvvInput  = document.getElementById('card-cvv');
    const expInput  = document.getElementById('card-expiry');

    numInput?.addEventListener('input',  e => { e.target.value = e.target.value.replace(/\D/g,'').replace(/(.{4})/g,'$1 ').trim().substring(0,19); });
    cvvInput?.addEventListener('input',  e => { e.target.value = e.target.value.replace(/\D/g,''); });
    expInput?.addEventListener('input',  e => {
        let v = e.target.value.replace(/\D/g,'');
        if (v.length > 2) v = v.substring(0,2) + '/' + v.substring(2,4);
        e.target.value = v;
    });

    // ── 9. SIMULACIÓN DE PROCESAMIENTO DE PAGO (solo tarjeta) ────────────────
    const ppOverlay  = document.getElementById('pp-overlay');
    const ppSpinner  = document.getElementById('pp-spinner');
    const ppSuccess  = document.getElementById('pp-success');
    const ppTitle    = document.getElementById('pp-title');
    const ppSubtitle = document.getElementById('pp-subtitle');

    const espera = (ms) => new Promise(resolve => setTimeout(resolve, ms));

    function mostrarOverlayProcesando() {
        if (!ppOverlay) return;
        ppSpinner.style.display  = 'block';
        ppSuccess.style.display  = 'none';
        ppTitle.textContent      = 'Procesando pago...';
        ppSubtitle.textContent   = 'Estamos validando los datos de tu tarjeta. No cierres ni recargues esta ventana.';
        ppOverlay.style.display  = 'flex';
    }

    function mostrarOverlayConfirmado() {
        if (!ppOverlay) return;
        ppSpinner.style.display  = 'none';
        ppSuccess.style.display  = 'flex';
        ppTitle.textContent      = '¡Pago confirmado!';
        ppSubtitle.textContent   = 'Tu pago fue aprobado correctamente. Redirigiendo...';
    }

    function ocultarOverlay() {
        if (ppOverlay) ppOverlay.style.display = 'none';
    }

    // ── 10. SUBMIT: CONFIRMAR EN EL SERVIDOR ─────────────────────────────────
    document.getElementById('form-checkout').addEventListener('submit', async (e) => {
        e.preventDefault();

        if (carritoItems.length === 0) {
            mostrarNotificacion('Tu carrito está vacío. Agregá productos antes de continuar.', 'warning');
            return;
        }

        // Auth check: mostrar aviso en página sin redirigir
        if (typeof USUARIO_AUTENTICADO !== 'undefined' && !USUARIO_AUTENTICADO) {
            const notice = document.getElementById('auth-notice');
            if (notice) { notice.style.display = 'block'; notice.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
            return;
        }

        const tipoEnvio = document.querySelector('input[name="tipo_envio"]:checked')?.value;
        const transporte = tipoEnvio === 'domicilio'
            ? document.querySelector('input[name="transporte"]:checked')?.value ?? null
            : null;

        if (tipoEnvio === 'domicilio' && !transporte) {
            mostrarNotificacion('Seleccioná un transporte para el envío a domicilio.', 'warning');
            return;
        }

        const payload = {
            nombre:        document.getElementById('billing-nombre')?.value?.trim(),
            apellido:      document.getElementById('billing-apellido')?.value?.trim(),
            email:         document.getElementById('billing-email')?.value?.trim(),
            telefono:      document.getElementById('billing-telefono')?.value?.trim(),
            tipo_envio:    tipoEnvio,
            transporte:    transporte,
            provincia:     tipoEnvio === 'domicilio' ? document.getElementById('envio-provincia')?.value : null,
            localidad:     tipoEnvio === 'domicilio' ? document.getElementById('envio-localidad')?.value?.trim() : null,
            calle:         tipoEnvio === 'domicilio' ? document.getElementById('envio-calle')?.value?.trim() : null,
            codigo_postal: tipoEnvio === 'domicilio' ? (document.getElementById('envio-cp-final')?.value?.trim() || inputCP?.value?.trim()) : null,
            metodo_pago:   document.querySelector('input[name="metodo_pago"]:checked')?.value,
            costo_envio:   costoEnvio,
        };

        const btn = document.getElementById('btn-pagar');
        const esTarjeta = payload.metodo_pago === 'tarjeta';

        btn.disabled    = true;
        btn.textContent = 'Procesando...';

        // Para tarjeta, mostramos la simulación de procesamiento de pago
        if (esTarjeta) {
            mostrarOverlayProcesando();
            await espera(2200);
        }

        try {
            const res = await fetch('/carrito/confirmar', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': CSRF_CO },
                body:    JSON.stringify(payload),
            });

            if (res.status === 401) {
                ocultarOverlay();
                const notice = document.getElementById('auth-notice');
                if (notice) { notice.style.display = 'block'; notice.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
                else { mostrarNotificacion('Debés iniciar sesión para completar la compra.', 'warning'); }
                btn.disabled = false;
                btn.textContent = 'Pagar ahora';
                return;
            }

            const data = await res.json();

            if (!res.ok) {
                ocultarOverlay();
                const errors = data.errors ? Object.values(data.errors).flat().join(' — ') : (data.error ?? 'Error al confirmar la compra');
                mostrarNotificacion(errors, 'error');
                btn.disabled    = false;
                btn.textContent = 'Pagar ahora';
                return;
            }

            const redirectUrl = data.redirect
                + '?envio='  + encodeURIComponent(tipoEnvio)
                + '&pedido=' + encodeURIComponent(data.numero_pedido ?? '')
                + '&pago='   + encodeURIComponent(payload.metodo_pago ?? '');

            if (esTarjeta) {
                mostrarOverlayConfirmado();
                await espera(1300);
            }

            window.location.href = redirectUrl;

        } catch {
            ocultarOverlay();
            mostrarNotificacion('Error de conexión. Intentá de nuevo.', 'error');
            btn.disabled    = false;
            btn.textContent = 'Pagar ahora';
        }
    });
});
