@php
    $catId = old('categoria_id', $producto?->categoria_id);
    $catNom = $catId ? ($categorias->firstWhere('id', (int) $catId)?->nombre ?? null) : null;
    $specs = old('specs', $producto?->especificaciones ?? []);
@endphp

@if($errors->any())
<div class="admin-flash admin-flash-error">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
    </svg>
    Revisá los errores en el formulario antes de continuar.
</div>
@endif

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($formMethod === 'PUT')
    @method('PUT')
    @endif

    <div class="row g-4">

        {{-- ── Columna principal ── --}}
        <div class="col-lg-8">

            {{-- Información básica --}}
            <div class="admin-card mb-4">
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Información básica</p>

                <div class="mb-3">
                    <label class="admin-form-label">Nombre del producto *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $producto?->nombre) }}"
                           class="admin-form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                           placeholder="Ej: NVIDIA RTX 4090">
                    @error('nombre')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3">
                    <label class="admin-form-label">Categoría *</label>
                    <input type="hidden" name="categoria_id" id="cat_id_input" value="{{ $catId }}">
                    <div class="dropdown w-100">
                        <button type="button"
                                id="dropdownCategoria"
                                class="btn w-100 text-start d-flex justify-content-between align-items-center admin-cat-btn {{ $errors->has('categoria_id') ? 'is-invalid-custom' : '' }} {{ !$catNom ? 'placeholder-active' : '' }}"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <span id="cat_label">{{ $catNom ?? 'Seleccioná una categoría' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="opacity:0.5; flex-shrink:0;">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu w-100 admin-cat-menu" aria-labelledby="dropdownCategoria">
                            @foreach($categorias as $cat)
                            <li>
                                <a href="#"
                                   class="dropdown-item admin-cat-item {{ $catId == $cat->id ? 'active' : '' }}"
                                   data-value="{{ $cat->id }}"
                                   data-label="{{ $cat->nombre }}">
                                    {{ $cat->nombre }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @error('categoria_id')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="admin-form-label">Descripción</label>
                    <textarea name="descripcion" class="admin-form-textarea {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                              placeholder="Descripción detallada del producto...">{{ old('descripcion', $producto?->descripcion) }}</textarea>
                    @error('descripcion')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Especificaciones --}}
            <div class="admin-card">
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; color:#FF3B3B; text-transform:uppercase; margin:0 0 0.25rem;">Especificaciones</p>
                <p style="font-size:0.875rem; color:#64748b; margin:0 0 1.25rem;">Cada línea es un ítem de la lista de características del producto.</p>

                <div id="specs-container">
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
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Precios y Stock</p>

                <div class="mb-3">
                    <label class="admin-form-label">Precio de compra ($) *</label>
                    <input type="number" name="precio_compra" value="{{ old('precio_compra', $producto?->precio_compra) }}"
                           class="admin-form-input {{ $errors->has('precio_compra') ? 'is-invalid' : '' }}"
                           step="0.01" min="0" placeholder="0.00">
                    @error('precio_compra')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3">
                    <label class="admin-form-label">Precio de venta ($) *</label>
                    <input type="number" name="precio_venta" value="{{ old('precio_venta', $producto?->precio_venta) }}"
                           class="admin-form-input {{ $errors->has('precio_venta') ? 'is-invalid' : '' }}"
                           step="0.01" min="0" placeholder="0.00">
                    @error('precio_venta')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="admin-form-label">{{ $producto ? 'Stock *' : 'Stock inicial *' }}</label>
                    <input type="number" name="stock" value="{{ old('stock', $producto?->stock ?? 0) }}"
                           class="admin-form-input {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                           min="0" placeholder="0">
                    @error('stock')<p class="admin-field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Imagen --}}
            <div class="admin-card mb-4">
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; color:#FF3B3B; text-transform:uppercase; margin:0 0 1.25rem;">Imagen del producto</p>

                <div class="img-upload-zone {{ $producto?->imagen ? 'has-image' : '' }}" id="upload-zone">
                    <input type="file" name="imagen" id="img-input" accept="image/jpg,image/jpeg,image/png,image/webp">

                    <img id="img-preview"
                         src="{{ $producto?->imagen ? asset('storage/' . $producto->imagen) : '' }}"
                         alt="{{ $producto->nombre ?? 'Preview' }}"
                         style="max-width:100%; max-height:160px; object-fit:contain; border-radius:6px; display:{{ $producto?->imagen ? 'block' : 'none' }}; margin:0 auto; pointer-events:none;">

                    <div class="img-hover-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="mb-1">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                        <p style="margin:0; font-size:0.75rem; color:#94a3b8;">Clic para cambiar imagen</p>
                    </div>

                    <div id="upload-placeholder" {{ $producto?->imagen ? 'style=display:none' : '' }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#3d4659" viewBox="0 0 16 16" class="mb-1">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                        <p style="font-size:0.75rem; color:#64748b; margin:0;">Hacé clic o arrastrá una imagen</p>
                        <p style="font-size:0.72rem; color:#3d4659; margin:4px 0 0;">JPG, PNG, WEBP — máx. 2MB</p>
                    </div>
                </div>
                @error('imagen')<p class="admin-field-error mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- Guardar --}}
            <button type="submit" class="btn btn-mars w-100 py-2 fw-semibold {{ $cancelRoute ? 'mb-2' : '' }}">
                {{ $submitLabel }}
            </button>
            @if($cancelRoute)
            <a href="{{ $cancelRoute }}" class="btn w-100 py-2 fw-semibold"
               style="background:#1a1d27; border:1px solid #1f222e; color:#94a3b8; font-size:0.875rem;">
                Cancelar
            </a>
            @endif

        </div>

    </div>
</form>

@push('scripts')
<script src="{{ asset('js/producto-form.js') }}"></script>
@endpush
