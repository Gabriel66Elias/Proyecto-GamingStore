const CSRF_ADMIN = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

const ESTADO_META = {
    'pendiente':  { label: 'Pendiente',  dot: '#fbbf24' },
    'en_proceso': { label: 'En proceso', dot: '#60a5fa' },
    'enviado':    { label: 'Enviado',    dot: '#a78bfa' },
    'en_camino':  { label: 'En camino',  dot: '#818cf8' },
    'entregado':  { label: 'Entregado',  dot: '#2dd4bf' },
    'completado': { label: 'Completado', dot: '#4ade80' },
    'cancelado':  { label: 'Cancelado',  dot: '#f87171' },
};

// Estados a partir de los cuales tiene sentido cargar/mostrar un código de seguimiento
const ESTADOS_CON_SEGUIMIENTO = ['enviado', 'en_camino', 'entregado', 'completado'];

let _currentModalPedidoId = null;
let _selectedEstado = null;

function selEstadoCard(el, val) {
    document.querySelectorAll('#modal-estado-carousel .estado-card').forEach(c => {
        c.style.borderColor = '';
        c.style.color = '';
        c.style.background = '';
    });
    const meta = ESTADO_META[val];
    if (meta && el) {
        el.style.borderColor = meta.dot;
        el.style.color       = meta.dot;
        el.style.background  = meta.dot + '1a';
    }
    _selectedEstado = val;

    const trackingWrapper = document.getElementById('tracking-wrapper');
    if (trackingWrapper) {
        trackingWrapper.style.display = ESTADOS_CON_SEGUIMIENTO.includes(val) ? 'block' : 'none';
    }
}

function verDetalle(id, focusEstado = false) {
    const p = PEDIDOS_DATA[id];
    if (!p) return;

    _currentModalPedidoId = id;
    _selectedEstado = (p.estado === 'confirmado') ? 'pendiente' : p.estado;

    document.getElementById('modal-titulo').textContent = 'Pedido ' + p.numero_pedido;

    const pagoPendiente = p.metodo_pago === 'transferencia' && ['pendiente', 'confirmado'].includes(p.estado);
    const pagoBannerHTML = pagoPendiente ? `
        <div class="modal-pago-banner mb-3">
            <div class="d-flex align-items-center gap-2">
                <img src="/assets/bank.svg" style="width:14px;filter:invert(.8) sepia(1) saturate(3) hue-rotate(-10deg);">
                <span>Pago por transferencia pendiente de confirmación</span>
            </div>
            <button type="button" class="btn btn-sm fw-bold px-3" onclick="abrirConfirmarPago(${id})"
                    style="background:#fbbf24;color:#0d0f18;border:none;border-radius:7px;flex-shrink:0;">
                Confirmar pago
            </button>
        </div>` : '';

    const envioTexto = p.tipo_envio === 'retiro'
        ? 'Retiro en local'
        : (p.transporte ?? 'Envío a domicilio') + (p.localidad ? ' — ' + p.localidad + ', ' + (p.provincia ?? '') : '');

    const itemsHTML = p.items.map(item => `
        <div class="item-row">
            <img src="${item.imagen}" class="item-img" alt="${item.nombre}">
            <div class="flex-grow-1">
                <div class="text-white fw-semibold" style="font-size:.83rem;">${item.nombre}</div>
                <div class="text-secondary" style="font-size:.75rem;">Cant: ${item.cantidad} × $${item.precio.toLocaleString('es-AR')}</div>
            </div>
            <div class="text-white fw-bold" style="font-size:.85rem;">$${item.subtotal.toLocaleString('es-AR')}</div>
        </div>`).join('');

    const iconPerson  = `<img src="/assets/person-circle.svg"    style="width:12px;filter:invert(.5);margin-right:5px;vertical-align:middle;">`;
    const iconTruck   = `<img src="/assets/truck.svg"            style="width:12px;filter:invert(.5);margin-right:5px;vertical-align:middle;">`;
    const iconCard    = `<img src="/assets/credit-card-fill.svg" style="width:12px;filter:invert(.5);margin-right:5px;vertical-align:middle;">`;
    const iconBank    = `<img src="/assets/bank.svg"             style="width:12px;filter:invert(.5);margin-right:5px;vertical-align:middle;">`;
    const iconBox     = `<img src="/assets/boxes.svg"            style="width:12px;filter:invert(.5);margin-right:5px;vertical-align:middle;">`;
    const iconSliders = `<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#64748b" viewBox="0 0 16 16" style="margin-right:5px;vertical-align:middle;"><path d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/></svg>`;

    // Build carousel cards
    const carouselCards = Object.entries(ESTADO_META).map(([val, meta]) => {
        const isCurrent = val === _selectedEstado;
        const s = isCurrent ? `border-color:${meta.dot};color:${meta.dot};background:${meta.dot}1a;` : '';
        return `<div class="estado-card" data-val="${val}" onclick="selEstadoCard(this,'${val}')" style="${s}">
            <span style="width:9px;height:9px;border-radius:50%;background:${meta.dot};display:inline-block;flex-shrink:0;"></span>
            ${meta.label}
        </div>`;
    }).join('');

    // Input de código de seguimiento (solo visible para estados de envío en adelante)
    const mostrarTracking = ESTADOS_CON_SEGUIMIENTO.includes(_selectedEstado);
    const trackingHTML = `
        <div class="mt-3" id="tracking-wrapper" style="display:${mostrarTracking ? 'block' : 'none'};">
            <label class="info-key d-block mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;">Código de seguimiento</label>
            <input type="text" id="input-tracking" class="form-control form-control-sm"
                   placeholder="Ej: AR123456789AR" maxlength="60"
                   value="${p.codigo_seguimiento ?? ''}"
                   style="background:#0d0f18;border:1px solid #1c1f2e;color:#e2e8f0;">
        </div>`;

    document.getElementById('modal-body').innerHTML = pagoBannerHTML + `
        <div class="row g-3">
            <div class="col-md-6">
                <div class="info-section">
                    <div class="info-section-title">${iconPerson} Cliente</div>
                    <div class="info-row"><span class="info-key">Nombre</span><span class="info-val">${p.nombre_cliente}</span></div>
                    <div class="info-row"><span class="info-key">Email</span><span class="info-val">${p.email_cliente}</span></div>
                    <div class="info-row"><span class="info-key">Teléfono</span><span class="info-val">${p.telefono}</span></div>
                    <div class="info-row"><span class="info-key">Fecha</span><span class="info-val">${p.fecha}</span></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-section">
                    <div class="info-section-title">${iconTruck} Envío y Pago</div>
                    <div class="info-row"><span class="info-key">Envío</span><span class="info-val">${envioTexto}</span></div>
                    ${p.codigo_postal ? `<div class="info-row"><span class="info-key">CP</span><span class="info-val">${p.codigo_postal}</span></div>` : ''}
                    ${p.calle ? `<div class="info-row"><span class="info-key">Dirección</span><span class="info-val">${p.calle}</span></div>` : ''}
                    <div class="info-row"><span class="info-key">Pago</span><span class="info-val">${p.metodo_pago === 'tarjeta' ? iconCard + ' Tarjeta' : iconBank + ' Transferencia'}</span></div>
                    <div class="info-row"><span class="info-key">Costo envío</span><span class="info-val">${p.costo_envio > 0 ? '$' + p.costo_envio.toLocaleString('es-AR') : 'Gratis'}</span></div>
                </div>
            </div>
            <div class="col-12">
                <div class="info-section">
                    <div class="info-section-title">${iconBox} Productos</div>
                    ${itemsHTML}
                    <div class="d-flex justify-content-between mt-3 pt-2" style="border-top:1px solid #1c1f2e;">
                        <span class="fw-bold text-white">Total</span>
                        <span class="fw-bold text-success" style="font-size:1.1rem;">$${p.total.toLocaleString('es-AR')}</span>
                    </div>
                </div>
            </div>
            <div class="col-12" id="modal-estado-section">
                <div class="info-section">
                    <div class="info-section-title">${iconSliders} Cambiar Estado</div>
                    <div class="estado-carousel" id="modal-estado-carousel">${carouselCards}</div>
                    ${trackingHTML}
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" id="btn-modal-aplicar"
                                class="btn btn-sm fw-bold px-4"
                                style="background:#FF3B3B;color:#fff;border:none;border-radius:7px;">
                            Aplicar
                        </button>
                    </div>
                </div>
            </div>
        </div>`;

    document.getElementById('btn-modal-aplicar')?.addEventListener('click', async () => {
        if (!_selectedEstado || !_currentModalPedidoId) return;
        const trackingInput = document.getElementById('input-tracking');
        const codigoSeguimiento = (ESTADOS_CON_SEGUIMIENTO.includes(_selectedEstado) && trackingInput)
            ? trackingInput.value.trim()
            : null;
        await cambiarEstadoBtn(_currentModalPedidoId, _selectedEstado, codigoSeguimiento);
        bootstrap.Modal.getInstance(document.getElementById('modalDetalle'))?.hide();
    });

    const modal = new bootstrap.Modal(document.getElementById('modalDetalle'));
    modal.show();

    if (focusEstado) {
        document.getElementById('modalDetalle').addEventListener('shown.bs.modal', () => {
            document.getElementById('modal-estado-section')?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, { once: true });
    }
}

// ── Cambiar estado ────────────────────────────────────────────────────────
async function cambiarEstadoBtn(id, nuevoEstado, codigoSeguimiento = null) {
    const allBadgeClasses = ['badge-pendiente','badge-confirmado','badge-en-proceso','badge-enviado','badge-en-camino','badge-entregado','badge-completado','badge-cancelado'];
    try {
        const body = { estado: nuevoEstado };
        if (codigoSeguimiento) body.codigo_seguimiento = codigoSeguimiento;

        const res = await fetch(`/admin/pedidos/${id}/estado`, {
            method:  'PATCH',
            headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': CSRF_ADMIN },
            body:    JSON.stringify(body),
        });
        const data = await res.json();
        if (!res.ok) { toastAdmin(data.error ?? 'Error al actualizar el estado', 'error'); return; }

        const label = data.label ?? (ESTADO_META[nuevoEstado]?.label ?? nuevoEstado);

        // Actualizar badge en la tabla
        const badge = document.getElementById('sbadge-' + id);
        if (badge) {
            badge.classList.remove(...allBadgeClasses);
            badge.classList.add('badge-' + nuevoEstado.replace(/_/g, '-'));
            badge.textContent = label;
        }

        // Actualizar carrusel si el modal está abierto para este pedido
        if (_currentModalPedidoId === id) {
            document.querySelectorAll('#modal-estado-carousel .estado-card').forEach(c => {
                c.style.borderColor = ''; c.style.color = ''; c.style.background = '';
            });
            const activeCard = document.querySelector(`#modal-estado-carousel [data-val="${nuevoEstado}"]`);
            if (activeCard && ESTADO_META[nuevoEstado]) {
                const dot = ESTADO_META[nuevoEstado].dot;
                activeCard.style.borderColor = dot;
                activeCard.style.color       = dot;
                activeCard.style.background  = dot + '1a';
            }
        }

        if (PEDIDOS_DATA[id]) {
            PEDIDOS_DATA[id].estado = nuevoEstado;
            if (data.codigo_seguimiento !== undefined && data.codigo_seguimiento !== null) {
                PEDIDOS_DATA[id].codigo_seguimiento = data.codigo_seguimiento;
            }
        }

        toastAdmin('Estado actualizado: ' + label, 'success');

    } catch { toastAdmin('Error de conexión. Intentá de nuevo.', 'error'); }
}

// ── Confirmar pago por transferencia ──────────────────────────────────────
let _cpago_id = null;

function abrirConfirmarPago(id) {
    _cpago_id = id;
    const p = PEDIDOS_DATA[id];
    if (p) {
        document.getElementById('cpago-info').textContent =
            `¿Confirmar que se recibió la transferencia de $${p.total.toLocaleString('es-AR')} del pedido ${p.numero_pedido}?`;
    }
    new bootstrap.Modal(document.getElementById('modalConfirmarPago')).show();
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btn-cpago-ok')?.addEventListener('click', async () => {
        if (_cpago_id === null) return;
        const id = _cpago_id;
        _cpago_id = null;
        bootstrap.Modal.getInstance(document.getElementById('modalConfirmarPago'))?.hide();

        await cambiarEstadoBtn(id, 'en_proceso');

        // Si el modal de detalle está abierto para este pedido, refrescarlo
        // para ocultar el aviso de pago pendiente y reflejar el nuevo estado
        if (_currentModalPedidoId === id) {
            verDetalle(id);
        }
    });

    // ── Filtro de fechas para exportar el registro de ventas ───────────────
    document.querySelectorAll('.pedido-date-wrap').forEach((wrap) => {
        const input = wrap.querySelector('.pedido-date-input');
        const clearBtn = wrap.querySelector('.pedido-date-clear');
        if (!input || !clearBtn) return;

        const syncHasValue = () => wrap.classList.toggle('has-value', !!input.value);
        syncHasValue();

        // Permite abrir el calendario tocando cualquier parte del campo,
        // no solo el ícono nativo
        input.addEventListener('click', () => input.showPicker?.());

        input.addEventListener('change', syncHasValue);

        clearBtn.addEventListener('click', () => {
            input.value = '';
            syncHasValue();
            input.dispatchEvent(new Event('change'));
        });
    });
});

function toastAdmin(msg, tipo = 'info') {
    let container = document.getElementById('admin-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'admin-toast-container';
        container.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column-reverse;gap:8px;pointer-events:none;';
        document.body.appendChild(container);
    }
    const cfg = {
        success: { bg:'rgba(34,197,94,.1)',  border:'rgba(34,197,94,.3)',  color:'#4ade80' },
        error:   { bg:'rgba(239,68,68,.1)',  border:'rgba(239,68,68,.3)',  color:'#f87171' },
        warning: { bg:'rgba(251,191,36,.1)', border:'rgba(251,191,36,.3)', color:'#fbbf24' },
        info:    { bg:'rgba(99,102,241,.1)', border:'rgba(99,102,241,.3)', color:'#818cf8' },
    }[tipo] || {};
    const el = document.createElement('div');
    el.style.cssText = `background:${cfg.bg};border:1px solid ${cfg.border};border-radius:10px;padding:.7rem 1rem;font-size:.83rem;color:${cfg.color};font-weight:600;pointer-events:all;box-shadow:0 4px 20px rgba(0,0,0,.5);min-width:220px;transition:opacity .3s;`;
    el.textContent = msg;
    container.appendChild(el);
    setTimeout(() => { el.style.opacity='0'; setTimeout(() => el.remove(), 300); }, 3500);
}
