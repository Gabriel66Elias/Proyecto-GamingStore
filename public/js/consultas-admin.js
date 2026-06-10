(function () {
    let formPendiente = null;
    const modalEliminarEl = document.getElementById('modalEliminar');
    if (modalEliminarEl) {
        const modalEliminar = new bootstrap.Modal(modalEliminarEl);

        document.querySelectorAll('[data-confirmar-eliminar]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                formPendiente = document.getElementById(this.dataset.confirmarEliminar);
                document.getElementById('modal-eliminar-title').textContent = this.dataset.titulo || 'Eliminar elemento';
                document.getElementById('modal-eliminar-desc').textContent  = this.dataset.desc   || 'Esta acción no se puede deshacer.';
                modalEliminar.show();
            });
        });

        document.getElementById('btn-confirm-eliminar').addEventListener('click', function () {
            if (formPendiente) { formPendiente.submit(); formPendiente = null; }
        });
    }
})();

(function () {
    const modal = document.getElementById('modalResponder');
    if (!modal) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    modal.addEventListener('show.bs.modal', function (e) {
        const btn     = e.relatedTarget;
        const id      = btn.dataset.id;
        const nombre  = btn.dataset.nombre;
        const email   = btn.dataset.email;
        const mensaje = btn.dataset.mensaje;
        const leida   = btn.dataset.leida === '1';
        const leidaUrl = btn.dataset.leidaUrl;

        // Poblar modal
        document.getElementById('modal-avatar').textContent  = nombre.charAt(0).toUpperCase();
        document.getElementById('modal-nombre').textContent  = nombre;
        document.getElementById('modal-email').textContent   = email;
        document.getElementById('modal-mensaje').textContent = mensaje;

        // Gmail compose URL (abre en el navegador)
        const asunto = encodeURIComponent('Re: Tu consulta en GamingStation');
        const cuerpo = encodeURIComponent(
            'Hola ' + nombre + ',\n\nGracias por comunicarte con GamingStation.\n\n' +
            '---\nTu mensaje original:\n' + mensaje + '\n---\n\n'
        );
        document.getElementById('btn-mailto').href =
            'https://mail.google.com/mail/?view=cm&to=' + encodeURIComponent(email) +
            '&su=' + asunto + '&body=' + cuerpo;

        // Marcar como leída si todavía no lo está
        if (!leida) {
            fetch(leidaUrl, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            }).then(function (res) {
                if (res.ok) {
                    // Quitar badge NUEVO
                    const badge = document.getElementById('badge-' + id);
                    if (badge) badge.remove();

                    // Cambiar estilo de la card
                    const card = document.getElementById('consulta-' + id);
                    if (card) {
                        card.classList.remove('no-leida');
                        card.classList.add('leida');
                    }

                    // Actualizar data attr para que no vuelva a disparar
                    btn.dataset.leida = '1';

                    // Actualizar contador en el subtítulo
                    const sinLeerSpan = document.querySelector('.admin-page-subtitle span[style*="FF3B3B"]');
                    if (sinLeerSpan) {
                        const actual = parseInt(sinLeerSpan.textContent) - 1;
                        if (actual <= 0) {
                            sinLeerSpan.parentElement
                                .querySelector('span[style*="FF3B3B"]')
                                ?.previousSibling?.remove();
                            sinLeerSpan.remove();
                        } else {
                            sinLeerSpan.textContent = actual + ' sin leer';
                        }
                    }
                }
            });
        }
    });
})();
