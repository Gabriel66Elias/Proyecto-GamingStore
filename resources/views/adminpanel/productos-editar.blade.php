@extends('layout.main')
@section('titulo', 'Editar Producto — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="admin-page-title">Editar Producto</h1>
                <p class="admin-page-subtitle">{{ $producto->nombre }}</p>
            </div>
            <a href="{{ route('admin.productos') }}" class="btn-accion d-flex align-items-center gap-2 px-3" style="width:auto; height:36px; font-size:0.8rem; color:#94a3b8; text-decoration:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Volver
            </a>
        </div>

        @if($errors->any())
        <div class="admin-flash admin-flash-error">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
            Revisá los errores en el formulario antes de continuar.
        </div>
        @endif

        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- ── Columna principal ── --}}
                <div class="col-lg-8">

                    {{-- Información básica --}}
                    <div class="admin-card mb-4">
                        <p style="font-size:0.65rem; font-weight:700; letter-spacing:2px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Información básica</p>

                        <div class="mb-3">
                            <label class="admin-form-label">Nombre del producto *</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                                   class="admin-form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                   placeholder="Ej: NVIDIA RTX 4090">
                            @error('nombre')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Categoría *</label>
                            <select name="categoria_id" class="admin-form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }}">
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="admin-form-label">Descripción</label>
                            <textarea name="descripcion" class="admin-form-textarea {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                      placeholder="Descripción detallada del producto...">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Especificaciones --}}
                    <div class="admin-card">
                        <p style="font-size:0.65rem; font-weight:700; letter-spacing:2px; color:#FF3B3B; text-transform:uppercase; margin:0 0 0.25rem;">Especificaciones</p>
                        <p style="font-size:0.78rem; color:#64748b; margin:0 0 1.25rem;">Cada línea es un ítem de la lista de características del producto.</p>

                        <div id="specs-container">
                            @php $specs = old('specs', $producto->especificaciones ?? []); @endphp
                            @if(!empty($specs))
                                @foreach($specs as $spec)
                                    @if(trim($spec) !== '')
                                    <div class="spec-item">
                                        <input type="text" name="specs[]" value="{{ $spec }}" placeholder="Ej: 16 GB GDDR6X">
                                        <button type="button" class="btn-remove-spec" onclick="this.closest('.spec-item').remove()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="spec-item">
                                    <input type="text" name="specs[]" placeholder="Ej: 16 GB GDDR6X">
                                    <button type="button" class="btn-remove-spec" onclick="this.closest('.spec-item').remove()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <button type="button" class="btn-add-spec mt-1" id="btn-add-spec">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg>
                            Agregar especificación
                        </button>
                    </div>

                </div>

                {{-- ── Columna lateral ── --}}
                <div class="col-lg-4">

                    {{-- Precios --}}
                    <div class="admin-card mb-4">
                        <p style="font-size:0.65rem; font-weight:700; letter-spacing:2px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Precios y Stock</p>

                        <div class="mb-3">
                            <label class="admin-form-label">Precio de compra ($) *</label>
                            <input type="number" name="precio_compra" value="{{ old('precio_compra', $producto->precio_compra) }}"
                                   class="admin-form-input {{ $errors->has('precio_compra') ? 'is-invalid' : '' }}"
                                   step="0.01" min="0">
                            @error('precio_compra')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Precio de venta ($) *</label>
                            <input type="number" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta) }}"
                                   class="admin-form-input {{ $errors->has('precio_venta') ? 'is-invalid' : '' }}"
                                   step="0.01" min="0">
                            @error('precio_venta')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="admin-form-label">Stock *</label>
                            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}"
                                   class="admin-form-input {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                   min="0">
                            @error('stock')<p class="admin-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Imagen --}}
                    <div class="admin-card mb-4">
                        <p style="font-size:0.65rem; font-weight:700; letter-spacing:2px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Imagen del producto</p>

                        @if($producto->imagen)
                        <div class="mb-3 text-center">
                            <img id="img-preview" src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual"
                                 style="max-width:100%; max-height:160px; object-fit:contain; border-radius:8px; display:block; margin:0 auto;">
                            <p style="font-size:0.72rem; color:#64748b; margin-top:8px;">Imagen actual — subí una nueva para reemplazarla</p>
                        </div>
                        @else
                        <img id="img-preview" class="img-preview" src="" alt="Preview">
                        @endif

                        <div class="img-upload-zone" id="upload-zone">
                            <input type="file" name="imagen" id="img-input" accept="image/jpg,image/jpeg,image/png,image/webp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#3d4659" viewBox="0 0 16 16" class="mb-1">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                            </svg>
                            <p style="font-size:0.75rem; color:#64748b; margin:0;">{{ $producto->imagen ? 'Subir nueva imagen' : 'Hacé clic o arrastrá una imagen' }}</p>
                        </div>
                        @error('imagen')<p class="admin-field-error mt-2">{{ $message }}</p>@enderror
                    </div>

                    {{-- Guardar --}}
                    <button type="submit" class="btn btn-mars w-100 py-2 fw-semibold mb-2">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('admin.productos') }}" class="btn w-100 py-2 fw-semibold"
                       style="background:#1a1d27; border:1px solid #1f222e; color:#94a3b8; font-size:0.875rem;">
                        Cancelar
                    </a>

                </div>

            </div>
        </form>

    </div>
</div>

<script>
    // Preview al seleccionar nueva imagen
    document.getElementById('img-input').addEventListener('change', function () {
        const preview = document.getElementById('img-preview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Agregar spec
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
</script>
@endsection
