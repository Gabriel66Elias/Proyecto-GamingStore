@extends('layout.main')
@section('titulo', 'Gestión de Consultas — Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.adminpanel.css') }}">
@endpush

@section('contenido')
<div class="admin-wrapper">

    @include('adminpanel.partials.sidebar')

    <div class="admin-content">

        <div class="admin-page-header">
            <h1 class="admin-page-title">Gestión de Consultas</h1>
            <p class="admin-page-subtitle">Mensajes recibidos desde el formulario de contacto</p>
        </div>

        <div class="admin-table-wrapper">
            <div class="admin-empty-state">
                <div class="admin-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="rgba(255,59,59,0.5)" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    </svg>
                </div>
                <p class="text-white fw-semibold mb-1">Sin consultas por el momento</p>
                <p class="text-secondary small mb-0">Cuando los usuarios envíen mensajes desde el formulario de contacto, aparecerán aquí.</p>
            </div>
        </div>

    </div>
</div>
@endsection
