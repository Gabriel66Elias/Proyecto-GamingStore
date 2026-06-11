<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura {{ $pedido->numero_pedido ?? $pedido->id }}</title>
    <style>
        * { font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { color: #1a1a1a; font-size: 12px; }

        /* ── Encabezado ─────────────────────────────── */
        .encabezado { width: 100%; border-bottom: 3px solid #FF3B3B; padding-bottom: 14px; margin-bottom: 18px; }
        .encabezado td { vertical-align: top; }

        .marca-nombre { font-size: 24px; font-weight: bold; letter-spacing: -0.5px; color: #11131A; }
        .marca-nombre span { color: #FF3B3B; }
        .marca-datos { font-size: 9px; color: #666; margin-top: 4px; line-height: 1.5; }

        .factura-titulo { font-size: 20px; font-weight: bold; text-transform: uppercase; color: #11131A; text-align: right; letter-spacing: 1px; }
        .factura-numero { font-size: 12px; font-weight: bold; color: #FF3B3B; text-align: right; margin-top: 4px; }
        .factura-meta { font-size: 9px; color: #666; text-align: right; margin-top: 6px; line-height: 1.6; }

        /* ── Estado badge ───────────────────────────── */
        .badge-estado {
            display: inline-block; margin-top: 3px; padding: 3px 10px; border-radius: 10px;
            font-size: 9px; font-weight: bold; text-transform: uppercase;
            color: #fff; background-color: #4ade80; letter-spacing: .5px;
        }

        /* ── Bloques cliente / envío / pago ─────────── */
        .info-tabla { width: 100%; margin-bottom: 18px; }
        .info-tabla td { vertical-align: top; width: 33.33%; padding-right: 14px; }

        .info-caja { background-color: #f7f7f9; border: 1px solid #e5e5ea; border-radius: 6px; padding: 10px 12px; }
        .info-titulo {
            font-size: 9px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;
            color: #FF3B3B; margin-bottom: 6px; border-bottom: 1px solid #e5e5ea; padding-bottom: 4px;
        }
        .info-linea { font-size: 10.5px; color: #333; line-height: 1.7; }
        .info-linea strong { color: #11131A; }

        /* ── Tabla de productos ─────────────────────── */
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 4px; }
        table.items thead th {
            background-color: #11131A; color: #fff; font-size: 9px; text-transform: uppercase;
            letter-spacing: .5px; padding: 8px 10px; text-align: left;
        }
        table.items tbody td {
            font-size: 10.5px; padding: 8px 10px; border-bottom: 1px solid #ececf0; color: #333;
        }
        table.items tbody tr:nth-child(even) { background-color: #fafafb; }

        .text-end { text-align: right; }
        .text-center { text-align: center; }

        /* ── Totales ─────────────────────────────────── */
        .totales-tabla { width: 100%; margin-top: 10px; }
        .totales-tabla td { padding: 4px 0; font-size: 11px; }
        .totales-tabla .label { color: #666; text-align: right; padding-right: 16px; }
        .totales-tabla .valor { text-align: right; width: 110px; color: #11131A; font-weight: bold; }
        .totales-tabla .total-final td { border-top: 2px solid #11131A; padding-top: 8px; font-size: 14px; }
        .totales-tabla .total-final .valor { color: #FF3B3B; }

        /* ── Footer ──────────────────────────────────── */
        .footer-nota {
            margin-top: 30px; padding-top: 12px; border-top: 1px solid #e5e5ea;
            font-size: 9px; color: #999; text-align: center; line-height: 1.6;
        }
        .footer-gracias { font-size: 12px; font-weight: bold; color: #11131A; text-align: center; margin-top: 24px; }

        .codigo-seguimiento {
            margin-top: 14px; background-color: #f7f7f9; border: 1px dashed #c9c9d4; border-radius: 6px;
            padding: 8px 12px; font-size: 10px; color: #333;
        }
        .codigo-seguimiento strong { color: #FF3B3B; letter-spacing: 1px; }
    </style>
</head>
<body>

    {{-- ENCABEZADO --}}
    <table class="encabezado">
        <tr>
            <td style="width: 60%;">
                <div class="marca-nombre">GAMING<span>STATION</span></div>
                <div class="marca-datos">
                    GamingStation S.R.L. &middot; Titular: Juan Pérez<br>
                    Av. 25 de Mayo 1234, Corrientes, Argentina<br>
                    ventas@gamingstation.com.ar &middot; +54 379 4123456
                </div>
            </td>
            <td style="width: 40%;">
                <div class="factura-titulo">Factura de Compra</div>
                <div class="factura-numero">{{ $pedido->numero_pedido ?? '#' . $pedido->id }}</div>
                <div class="factura-meta">
                    Fecha de emisión: {{ $pedido->fecha_venta?->format('d/m/Y H:i') ?? $pedido->created_at->format('d/m/Y H:i') }}<br>
                    Estado del pedido:<br>
                    <span class="badge-estado">{{ \App\Models\VentaCabecera::estadoLabel($pedido->estado) }}</span>
                </div>
            </td>
        </tr>
    </table>

    {{-- DATOS DEL CLIENTE / ENVÍO / PAGO --}}
    <table class="info-tabla">
        <tr>
            <td>
                <div class="info-caja">
                    <div class="info-titulo">Facturado a</div>
                    <div class="info-linea">
                        <strong>{{ trim(($pedido->nombre_cliente ?? $pedido->usuario?->nombre ?? '—') . ' ' . ($pedido->apellido_cliente ?? '')) }}</strong><br>
                        {{ $pedido->email_cliente ?? $pedido->usuario?->email ?? '—' }}<br>
                        @if($pedido->telefono_cliente)
                            Tel: {{ $pedido->telefono_cliente }}
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="info-caja">
                    <div class="info-titulo">Entrega</div>
                    <div class="info-linea">
                        @if($pedido->tipo_envio === 'retiro')
                            <strong>Retiro en local</strong><br>
                            Av. 25 de Mayo 1234, Corrientes
                        @elseif($pedido->tipo_envio === 'domicilio')
                            <strong>Envío a domicilio</strong>{{ $pedido->transporte ? ' · ' . $pedido->transporte : '' }}<br>
                            @if($pedido->calle)
                                {{ $pedido->calle }}<br>
                                {{ $pedido->localidad }}, {{ $pedido->provincia }}<br>
                                CP: {{ $pedido->codigo_postal }}
                            @endif
                        @else
                            —
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="info-caja">
                    <div class="info-titulo">Pago</div>
                    <div class="info-linea">
                        <strong>
                            @switch($pedido->metodo_pago)
                                @case('tarjeta')
                                    Tarjeta de Crédito / Débito
                                    @break
                                @case('transferencia')
                                    Transferencia Bancaria
                                    @break
                                @default
                                    {{ $pedido->metodo_pago ?? '—' }}
                            @endswitch
                        </strong><br>
                        N° de comprobante:<br>
                        {{ $pedido->numero_pedido ?? '#' . $pedido->id }}
                    </div>
                </div>
            </td>
        </tr>
    </table>

    {{-- DETALLE DE PRODUCTOS --}}
    <table class="items">
        <thead>
            <tr>
                <th style="width: 50%;">Producto</th>
                <th class="text-center" style="width: 12%;">Cant.</th>
                <th class="text-end" style="width: 19%;">Precio Unit.</th>
                <th class="text-end" style="width: 19%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto?->nombre ?? 'Producto no disponible' }}</td>
                <td class="text-center">{{ $detalle->cantidad }}</td>
                <td class="text-end">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                <td class="text-end">${{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTALES --}}
    @php $subtotalProductos = $pedido->detalles->sum('subtotal'); @endphp
    <table class="totales-tabla">
        <tr>
            <td></td>
            <td class="label">Subtotal productos</td>
            <td class="valor">${{ number_format($subtotalProductos, 2, ',', '.') }}</td>
        </tr>
        @if($pedido->costo_envio > 0)
        <tr>
            <td></td>
            <td class="label">Costo de envío</td>
            <td class="valor">${{ number_format($pedido->costo_envio, 2, ',', '.') }}</td>
        </tr>
        @endif
        <tr class="total-final">
            <td></td>
            <td class="label">Total pagado</td>
            <td class="valor">${{ number_format($pedido->total, 2, ',', '.') }}</td>
        </tr>
    </table>

    {{-- CÓDIGO DE SEGUIMIENTO --}}
    @if($pedido->codigo_seguimiento)
    <div class="codigo-seguimiento">
        Código de seguimiento del envío: <strong>{{ $pedido->codigo_seguimiento }}</strong>
    </div>
    @endif

    <div class="footer-gracias">¡Gracias por tu compra en GamingStation!</div>

    <div class="footer-nota">
        Este comprobante fue generado automáticamente y es válido como factura de compra.<br>
        GamingStation &mdash; Documento generado el {{ now()->format('d/m/Y H:i') }}.
    </div>

</body>
</html>
