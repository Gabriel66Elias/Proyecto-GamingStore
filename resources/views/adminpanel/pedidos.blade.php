@extends('layout.main')
@section('titulo', 'Gestor de Pedidos — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        <div class="admin-page-header">
            <h1 class="admin-page-title">Gestor de Pedidos</h1>
            <p class="admin-page-subtitle">Seguimiento y gestión de órdenes de compra</p>
        </div>

        <div class="admin-table-wrapper">
            <div class="admin-empty-state">
                <div class="admin-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.761V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.35a1.5 1.5 0 0 1-.857 1.355l-6.65 2.66a1.5 1.5 0 0 1-1.086 0l-6.65-2.66A1.5 1.5 0 0 1 0 11.85V3.5a.5.5 0 0 1 .314-.464z"/>
                    </svg>
                </div>
                <p class="text-white fw-semibold mb-1">No hay pedidos registrados</p>
                <p class="text-secondary small mb-0">Los pedidos completados por los clientes aparecerán aquí con su estado y detalle.</p>
            </div>
        </div>

    </div>
</div>
@endsection
