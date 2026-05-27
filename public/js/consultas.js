/* consultas.js — Interacciones de la página de detalle de producto */

(function () {

    /* ── SELECTOR DE CANTIDAD +/- ─────────────────────────── */
    function cpAdjustQty(delta) {
        const input = document.getElementById('input-cantidad');
        if (!input) return;
        const max = parseInt(input.max, 10) || 99;
        const min = parseInt(input.min, 10) || 1;
        let val = (parseInt(input.value, 10) || 1) + delta;
        if (val < min) val = min;
        if (val > max) val = max;
        input.value = val;
    }

    document.addEventListener('DOMContentLoaded', function () {
        window.cpAdjustQty = cpAdjustQty;
    });

})();
