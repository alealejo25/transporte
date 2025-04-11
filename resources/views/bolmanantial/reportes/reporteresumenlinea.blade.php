<?php use Illuminate\Support\Str; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Abonos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        header img {
            height: 60px;
            margin-bottom: 5px;
        }

        h1 {
            font-size: 20px;
            margin: 10px 0;
        }

        .info {
            text-align: center;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .empresa {
            background-color: #f0f0f0;
            padding: 8px;
            font-weight: bold;
            margin-top: 25px;
            border-left: 5px solid #1976d2;
        }

        h4 {
            margin: 10px 0 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #1976d2;
            color: white;
            padding: 6px;
            font-size: 12px;
        }

        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }

        .totales-dia {
            font-weight: bold;
            background-color: #e8f5e9;
        }

        .totales-finales {
            background-color: #c8e6c9;
            font-weight: bold;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }

        .firma {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>

<header>
    <h1>Reporte de Abonos por Empresa</h1>
    <div class="info">
        Período: <strong>{{ $request->fecha_desde }}</strong> al <strong>{{ $request->fecha_hasta }}</strong>
    </div>
</header>

@foreach($agrupadoPorEmpresa as $empresa => $lineas)
    <div class="empresa">Empresa: {{ $empresa }}</div>

    @foreach($lineas as $linea => $fechas)
        <h4>Línea: {{ $linea }}</h4>

        @php
            $empresaKey = Str::slug($empresa);
            $lineaKey = Str::slug($linea);
            $chartPath = storage_path("app/public/temp_charts/chart-{$empresaKey}-{$lineaKey}.png");
        @endphp

        @if(file_exists($chartPath))
            @php
                $chartData = base64_encode(file_get_contents($chartPath));
            @endphp
            <div style="text-align:center; margin: 20px 0;">
                <img src="data:image/png;base64,{{ $chartData }}" style="width:100%; max-width:700px;">
            </div>
        @endif

        @php
            $totalLineaJub = 0;
            $totalLineaAbono = 0;
        @endphp

        @foreach($fechas as $fecha => $boletosDelDia)
            @php
                $totalDiaJub = $boletosDelDia->sum('abonojubilado');
                $totalDiaAbono = $boletosDelDia->sum('abono');
                $totalLineaJub += $totalDiaJub;
                $totalLineaAbono += $totalDiaAbono;
            @endphp

            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Abonos Jubilados</th>
                        <th>Abonos Comunes</th>
                        <th>Total Día</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($fecha)->format('d-m-y') }}</td>
                        <td>{{ $totalDiaJub }}</td>
                        <td>{{ $totalDiaAbono }}</td>
                        <td>{{ $totalDiaJub + $totalDiaAbono }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach

        <table>
            <thead>
                <tr class="totales-finales">
                    <th colspan="4">Totales de Línea {{ $linea }}</th>
                </tr>
                <tr>
                    <th>Abonos Jubilados</th>
                    <th>Abonos Comunes</th>
                    <th>Total Línea</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $totalLineaJub }}</td>
                    <td>{{ $totalLineaAbono }}</td>
                    <td>{{ $totalLineaJub + $totalLineaAbono }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endforeach

<h3>Totales Generales</h3>
<table>
    <thead>
        <tr>
            <th>Abonos Jubilados</th>
            <th>Abonos Comunes</th>
            <th>Total General</th>
        </tr>
    </thead>
    <tbody>
        <tr class="totales-finales">
            <td>{{ $totalesGlobales['abonojubilado'] }}</td>
            <td>{{ $totalesGlobales['abono'] }}</td>
            <td>{{ $totalesGlobales['total'] }}</td>
        </tr>
    </tbody>
</table>

<div class="firma">
    ____________________________ <br>
    Firma Responsable
</div>

<footer>
    Generado automáticamente por el sistema - {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
</footer>

</body>
</html>