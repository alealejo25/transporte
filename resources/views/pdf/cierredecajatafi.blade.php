<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Flete</title>
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
                    <th>Caja Inicial</th>
                    <th>Vta. Abonos Total</th>
                    <th>Gastos</th>
                    <th>Caja Final Abonos</th>
                    <th>Ganancia Abonos</th>
                    <th>Nro Lote</th>
                    <th>Venta de Posnet</th>
                    <th>Caja Abonos/Posnet</th>
                    <th>Caja Final Fisica</th>
                    <th>Diferencia</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($consulta as $datos)
                <tr>
                  <td >{{$datos->id}}</td>
                  <td align="right">$ {{number_format($datos->caja_inicial,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->venta,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->gastos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->caja_final,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->ganancialnf,2,",",".")}}</td>
                  <td align="right">{{number_format($datos->nrolote)}}</td>
                  <td align="right">$ {{number_format($datos->montolote,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->gananciatotallnf,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->caja_final_fisica,2,",",".")}}</td>
                  <td align="right">$ {{number_format($datos->caja_diferencia,2,",",".")}}</td>
                  </tr>
            @endforeach                   
            </tbody>
        </table>
    </div>
<br>
<h3>Cantidad de Billetes</h3>
<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Diez</th>
                    <th>Veinte</th>
                    <th>Cincuenta</th>
                    <th>Cien</th>
                    <th>Doscientos</th>
                    <th>Quinientos</th>
                    <th>Mil</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($consulta as $datos)
                <tr>
                  <td align="right">{{number_format($datos->diez)}}</td>
                  <td align="right">{{number_format($datos->veinte)}}</td>
                  <td align="right">{{number_format($datos->cincuenta)}}</td>
                  <td align="right">{{number_format($datos->cien)}}</td>
                  <td align="right">{{number_format($datos->doscientos)}}</td>
                  <td align="right">{{number_format($datos->quinientos)}}</td>
                  <td align="right">{{number_format($datos->mil)}}</td>
                  <td align="right">{{number_format($cantbilletes)}}</td>
                </tr>

                <div>
        
                </div>
                <tr>
                  <td align="right">$ {{number_format($diez)}}</td>
                  <td align="right">$ {{number_format($veinte)}}</td>
                  <td align="right">$ {{number_format($cincuenta)}}</td>
                  <td align="right">$ {{number_format($cien)}}</td>
                  <td align="right">$ {{number_format($doscientos)}}</td>
                  <td align="right">$ {{number_format($quinientos)}}</td>
                  <td align="right">$ {{number_format($mil)}}</td>
                  <td align="right"><spam>$ {{number_format($totaldinero)}}</spam></td>
                </tr>
            @endforeach                   
            </tbody>
        </table>
    </div>

<div class="card">
        <div class="row">
            <div  class="Form-group col-lg-3" >

                <h2 align="right">Son: {{$montoenletras}}</h2>

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