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

    @foreach($lineas as $linea => $items)
        <h4>Línea: {{ $linea }}</h4>

        @php
            $itemsPorFecha = $items->groupBy('fecha');
            $totalLineaJub = 0;
            $totalLineaAbono = 0;
        @endphp

        @foreach($itemsPorFecha as $fecha => $boletosDelDia)
            <h4>Fecha: {{ $fecha }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Abonos Jubilados</th>
                        <th>Abonos Comunes</th>
                        <th>Total por Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDiaJub = 0;
                        $totalDiaAbono = 0;
                    @endphp

                    @foreach($boletosDelDia as $boleto)
                        @php
                            $totalDiaJub += $boleto->abonojubilado;
                            $totalDiaAbono += $boleto->abono;
                            $totalLineaJub += $boleto->abonojubilado;
                            $totalLineaAbono += $boleto->abono;
                        @endphp
                        <tr>
                            <td>
                                {{ optional($boleto->servicioReporte)->numero ?? 'N°' }} -
                                {{ optional($boleto->servicioReporte->ramalReporte)->nombre ?? 'Sin ramal' }} -
                                {{ optional($boleto->servicioReporte->turnoReporte)->nombre ?? 'Sin turno' }}
                            </td>
                            <td>{{ $boleto->abonojubilado }}</td>
                            <td>{{ $boleto->abono }}</td>
                            <td>{{ $boleto->abonojubilado + $boleto->abono }}</td>
                        </tr>
                    @endforeach

                    <tr class="totales-dia">
                        <td>Total Día</td>
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
