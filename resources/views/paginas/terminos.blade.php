@extends('layout.main')
@section('titulo', 'Términos y Usos | GamingStation')

@push('styles')
<style>
    /* Aumenta el tamaño del texto solo en celulares (Bootstrap sm y xs) */
    @media (max-width: 767.98px) {
        .termino-text, .ip-muted {
            font-size: 1.15rem !important;
            line-height: 1.6;
        }
        /* Opcional: Reduce un poco el tamaño de los números para que no queden gigantes en el celu */
        .termino-numero {
            transform: scale(0.9);
        }
    }
</style>
@endpush

@section('contenido')
<div class="container mt-5 mb-5">

    <div class="mb-4">
        <a href="/" class="ip-back-link">
            <img src="{{ asset('assets/caret-left.svg') }}" alt="" style="width:16px;height:16px;filter:invert(0.6);">
            Volver al inicio
        </a>
    </div>

    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="text-white fw-black display-5 tracking-tighter mb-3">TÉRMINOS Y USOS</h1>
            <p class="ip-muted mb-0">Políticas claras para una experiencia de compra segura y transparente.</p>
            <div class="ip-title-line"></div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card card-contacto shadow-lg border-0">
                <div class="card-body p-4 p-md-5">

                    <div class="termino-seccion mb-4">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">1</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Introducción y Uso del Sitio</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Bienvenido a GamingStation. Al acceder a nuestro sitio web y realizar compras, aceptás cumplir con los siguientes términos. Nuestro sitio está destinado exclusivamente a mayores de 18 años. Al utilizarlo, garantizás que toda la información proporcionada para la facturación y envío es precisa y actual.
                        </p>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin: 0.5rem 0 1.5rem;">

                    <div class="termino-seccion mb-4">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">2</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Compras, Precios y Stock</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Nos esforzamos por mantener el inventario de consolas y hardware actualizado en tiempo real. Sin embargo, debido a la alta demanda, un producto agregado al carrito no garantiza su reserva hasta que el pago sea confirmado. Nos reservamos el derecho de cancelar pedidos en caso de errores de sistema o falta de stock, reintegrando el 100% del dinero de forma inmediata.
                        </p>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin: 0.5rem 0 1.5rem;">

                    <div class="termino-seccion mb-4">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">3</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Formas de Entrega y Tiempos</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Realizamos envíos a todo el país. Los tiempos de entrega estimados son de 2 a 5 días hábiles dependiendo de tu ubicación. Todo el hardware delicado (monitores, placas de video, consolas) se despacha con embalaje de alta protección y seguro de traslado. Una vez despachado, recibirás por email tu número de seguimiento.
                        </p>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin: 0.5rem 0 1.5rem;">

                    <div class="termino-seccion mb-4">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">4</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Garantías y Soporte Postventa</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Todos nuestros productos cuentan con garantía oficial del fabricante (mínimo 6 meses). Si un componente presenta fallas de fábrica, nuestro equipo de soporte técnico te guiará en el proceso de RMA (Autorización de Retorno de Mercancía). La garantía queda anulada si el hardware presenta daños físicos, quemaduras por sobretensión o modificaciones no autorizadas (overclocking extremo).
                        </p>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin: 0.5rem 0 1.5rem;">

                    <div class="termino-seccion mb-4">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">5</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Política de Devoluciones</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Tenés 10 días corridos desde la recepción del pedido para solicitar la devolución por arrepentimiento de compra.
                            El producto debe estar en las mismas condiciones en las que fue entregado: cajas selladas, manuales intactos y sin uso.
                            <strong style="color:#e2e8f0;">Importante:</strong> por cuestiones de derechos de autor, no se aceptan devoluciones por arrepentimiento de videojuegos físicos desprecintados.
                            <em style="color:#94a3b8;">Si el juego presenta una falla de lectura de fábrica, el cambio se gestionará a través de la garantía (Punto 4).</em>
                        </p>
                    </div>

                    <hr style="border-color:#1f222e; opacity:1; margin: 0.5rem 0 1.5rem;">

                    <div class="termino-seccion">
                        <div class="d-flex align-items-center mb-3 gap-3">
                            <span class="termino-numero">6</span>
                            <h4 class="text-white fw-bold mb-0" style="font-size:1.2rem;">Ley Aplicable</h4>
                        </div>
                        <p class="termino-text ms-md-5 mb-0">
                            Estos términos se rigen por las leyes de la República Argentina. Cualquier disputa será sometida a la jurisdicción exclusiva de los tribunales competentes de la ciudad de Corrientes.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
