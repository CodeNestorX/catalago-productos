<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Movimientos - {{ $fecha }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f8f9fa; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 12px; }
        .badge-success { background-color: #28a745; color: white; }
        .badge-danger { background-color: #dc3545; color: white; }
        .header { margin-bottom: 20px; }
        .summary { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Movimientos</h2>
        <p>Fecha: {{ $fecha }}</p>
    </div>

    <div class="summary">
        <p><strong>Total Entradas:</strong> {{ $resumen->total_entradas }}</p>
        <p><strong>Total Salidas:</strong> {{ $resumen->total_salidas }}</p>
        <p><strong>Productos Afectados:</strong> {{ $resumen->productos_afectados }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Hora</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Stock Final</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $movimiento)
            <tr>
                <td>{{ $movimiento->created_at->format('H:i') }}</td>
                <td>{{ $movimiento->producto->nombre }}</td>
                <td>{{ $movimiento->producto->categoria->nombre }}</td>
                <td>
                    @if($movimiento->tipo_movimiento === 'entrada')
                        <span class="badge badge-success">Entrada</span>
                    @else
                        <span class="badge badge-danger">Salida</span>
                    @endif
                </td>
                <td>{{ $movimiento->cantidad }}</td>
                <td>{{ $movimiento->stock_resultante }}</td>
                <td>{{ $movimiento->motivo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
