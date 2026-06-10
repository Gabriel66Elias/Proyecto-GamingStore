// Preview de imagen
document.getElementById('img-input').addEventListener('change', function () {
    const preview = document.getElementById('img-preview');
    const zone = document.getElementById('upload-zone');
    const placeholder = document.getElementById('upload-placeholder');
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
            if (zone) zone.classList.add('has-image');
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Dropdown categoría
document.querySelectorAll('.admin-cat-item').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        const val   = this.dataset.value;
        const label = this.dataset.label;
        document.getElementById('cat_id_input').value = val;
        document.getElementById('cat_label').textContent = label;
        const btn = document.getElementById('dropdownCategoria');
        btn.classList.remove('placeholder-active');
        document.querySelectorAll('.admin-cat-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
    });
});

// Agregar especificación
document.getElementById('btn-add-spec').addEventListener('click', function () {
    const container = document.getElementById('specs-container');
    const item = document.createElement('div');
    item.className = 'spec-item';
    item.innerHTML = `
        <input type="text" name="specs[]" placeholder="Ej: Boost Clock: 2.5 GHz">
        <button type="button" class="btn-remove-spec" onclick="this.closest('.spec-item').remove()">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </button>`;
    container.appendChild(item);
    item.querySelector('input').focus();
});
