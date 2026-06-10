let toastTimer = null;
let progressEl = null;

function updateForgotBtn() {
    const btn = document.getElementById('forgot-btn');
    const email = document.getElementById('email').value.trim();
    if (email) {
        btn.classList.replace('disabled', 'enabled');
    } else {
        btn.classList.replace('enabled', 'disabled');
    }
}

function forgotPassword() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();

    if (!email) {
        emailInput.classList.add('shake');
        emailInput.focus();
        setTimeout(() => emailInput.classList.remove('shake'), 500);
        return;
    }

    // Mostrar toast
    const toast = document.getElementById('toast-recovery');
    document.getElementById('toast-msg').textContent =
        'Te enviamos un código a ' + email + '. Revisá tu bandeja de entrada.';

    // Reiniciar la barra de progreso
    progressEl = document.getElementById('toast-progress');
    progressEl.style.animation = 'none';
    progressEl.offsetHeight; // reflow
    progressEl.style.animation = '';

    toast.classList.add('show');

    clearTimeout(toastTimer);
    toastTimer = setTimeout(closeToast, 4500);
}

function closeToast() {
    clearTimeout(toastTimer);
    const toast = document.getElementById('toast-recovery');
    toast.classList.remove('show');
}

// Inicializar estado del botón si el campo ya tiene valor (ej: old input)
document.addEventListener('DOMContentLoaded', updateForgotBtn);
