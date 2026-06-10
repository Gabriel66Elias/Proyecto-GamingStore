@extends('layout.main')
@section('titulo', 'Editar Producto — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
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

        @include('adminpanel.partials.producto-form', [
            'producto' => $producto,
            'categorias' => $categorias,
            'formAction' => route('admin.productos.update', $producto->id),
            'formMethod' => 'PUT',
            'submitLabel' => 'Guardar Cambios',
            'cancelRoute' => route('admin.productos'),
        ])

    </div>
@endsection
