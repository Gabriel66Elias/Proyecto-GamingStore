// Toggle de favoritos: delega el click en cualquier botón .btn-favorito
// (las tarjetas de producto se repiten en home y catálogo)
document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-favorito');
    if (!btn) return;

    e.preventDefault();
    e.stopPropagation();

    const productoId = btn.dataset.productoId;

    try {
        const res = await fetch(`/favoritos/${productoId}/toggle`, {
            method:  'POST',
            headers: headersJSON,
        });

        if (res.status === 401) { window.location.href = '/login'; return; }
        if (!res.ok) return;

        const data = await res.json();

        // En el perfil, al quitar un favorito se elimina la fila de la lista
        if (!data.favorito && btn.classList.contains('btn-favorito-quitar')) {
            const item = btn.closest('.favorito-item');
            item?.remove();
            return;
        }

        btn.classList.toggle('is-favorito', data.favorito);
        btn.title = data.favorito ? 'Quitar de favoritos' : 'Agregar a favoritos';
    } catch {
        // Silencioso: si falla la conexión no rompemos la navegación de la card
    }
});
