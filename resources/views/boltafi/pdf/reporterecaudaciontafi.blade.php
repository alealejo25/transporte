<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Recaudacion - Tafi Viejo</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.75rem;
            font-weight: normal;
            line-height: 0.9;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 3px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.25rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: center;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
    	<!-- <IMG SRC="img\logotlpdf.jpg"> -->
    	 <span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}}</span>
    </div>
 	<h2>Cierre de Caja - La Nueva Fournier - BOLETERIA TAFI VIEJO</h2>

@foreach ($consulta as $datos)
<h3>Usuario: {{$datos->user->name}}</h3>
<h3>Fecha de Cierre: {{date('d-m-Y', strtotime($datos->fecha))}}</h3>
<h3>Observacion: {{$datos->observacion}}</h3>

@endforeach
<br>
	<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Numero</th>
                    <th>Planchas Vendidas</th>
                    <th>Planchas Anuladas</th>
                    <th>Caja Inicial</th>
                    <th>Vta. Abonos Total</th>
                    <th>Gastos</th>
                    <th>Caja Final Abonos</th>
                    <th>Ganancia Abonos</th>
                    <th>Nro Lote</th>
                    <th>Venta de Posnet</th>
                    <th>Caja Abonos/Posnet</th>
                  

                </tr>
            </thead>

            <tbody>
                @foreach ($consulta as $datos)
                <tr>
                  <td >{{$datos->id}}</td>
                  <td >{{$datos->id}}</td>
                  <td >{{$datos->id}}</td>
                  <td align="right">$ {{number_format($datos->caja_inicial,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->venta,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->gastos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->caja_final,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->ganancialnf,2,",",".")}}</td>
                  <td align="right">{{number_format($datos->nrolote)}}</td>
                  <td align="right">$ {{number_format($datos->montolote,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->gananciatotallnf,2,",",".")}}</td>
                  
                  
                  </tr>
            @endforeach                   
            </tbody>
        </table>
    </div>
<br>

<div class="card">
        <div class="row">
            <div  class="Form-group col-lg-3" >

                <h2 align="right">Son: {{$montoenletras}}</h2>

            </div>
    </div>
</div>
    <br><br><br><br><br><br>
   <div class="card">
        <div class="row">
            <div  class="Form-group col-lg-3" >

                <h4 align='center'>--------------------------------------------------------</h4>
                <h4 align='center'>Firma y Aclaracion</h4>
                <h4 align='center'>Encargado Boleteria</h4>
            </div>
        </div>
    </div>
</body>
</html>