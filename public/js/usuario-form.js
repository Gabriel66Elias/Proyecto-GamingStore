// Dropdown de selección de rol (mismo patrón que el dropdown de categoría)
document.querySelectorAll('.admin-cat-item').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        const val   = this.dataset.value;
        const label = this.dataset.label;
        document.getElementById('rol_id_input').value = val;
        document.getElementById('rol_label').textContent = label;
        const btn = document.getElementById('dropdownRol');
        btn.classList.remove('placeholder-active');
        document.querySelectorAll('.admin-cat-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
    });
});
