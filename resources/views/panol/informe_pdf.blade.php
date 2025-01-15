<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Stock de Repuestos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Informe de Stock de Repuestos</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Cantidad Actual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repuestos as $repuesto)
                <tr>
                    <td>{{ $repuesto->codigo }}</td>
                    <td>{{ $repuesto->nombre }}</td>
                    <td>{{ $repuesto->marca }}</td>
                    <td>{{ $repuesto->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>