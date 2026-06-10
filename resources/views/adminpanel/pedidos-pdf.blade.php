<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de ventas</title>
    <style>
        * { font-family: Helvetica, Arial, sans-serif; }
        body { color: #1a1a1a; font-size: 11px; }

        h1 { font-size: 18px; margin: 0 0 4px; }
        .subtitulo { font-size: 11px; color: #555; margin: 0 0 16px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 6px 8px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f0f0f0; font-size: 10px; text-transform: uppercase; }
        td { font-size: 10px; }

        .text-end { text-align: right; }
        .text-center { text-align: center; }

        tfoot td { font-weight: bold; background-color: #f7f7f7; }

        .footer-nota { margin-top: 14px; font-size: 9px; color: #777; }
    </style>
</head>
<body>
    <h1>Registro de ventas</h1>
    <p class="subtitulo">
        Generado el {{ now()->format('d/m/Y H:i') }}
        @if($desde || $hasta)
            &middot; Período:
            {{ $desde ? \Carbon\Carbon::parse($desde)->format('d/m/Y') : 'inicio' }}
            al
            {{ $hasta ? \Carbon\Carbon::parse($hasta)->format('d/m/Y') : 'hoy' }}
        @endif
        @if($estado)
            &middot; Estado: {{ \App\Models\VentaCabecera::estadoLabel($estado) }}
        @endif
        &middot; {{ $pedidos->count() }} pedido{{ $pedidos->count() !== 1 ? 's' : '' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>N° Pedido</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Items</th>
                <th>Estado</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->numero_pedido ?? '#' . $pedido->id }}</td>
                <td>{{ $pedido->fecha_venta?->format('d/m/Y H:i') ?? $pedido->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ trim(($pedido->nombre_cliente ?? $pedido->usuario?->nombre ?? '—') . ' ' . ($pedido->apellido_cliente ?? '')) }}</td>
                <td class="text-center">{{ $pedido->detalles->count() }}</td>
                <td>{{ \App\Models\VentaCabecera::estadoLabel($pedido->estado) }}</td>
                <td class="text-end">${{ number_format($pedido->total, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No se encontraron ventas para los filtros seleccionados.</td>
            </tr>
            @endforelse
        </tbody>
        @if($pedidos->isNotEmpty())
        <tfoot>
            <tr>
                <td colspan="5" class="text-end">Total general</td>
                <td class="text-end">${{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <p class="footer-nota">Gaming Store &mdash; Reporte generado automáticamente desde el panel de administración.</p>
</body>
</html>
