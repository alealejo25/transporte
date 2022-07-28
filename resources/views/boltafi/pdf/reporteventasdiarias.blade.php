<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas Diarias</title>
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
    <h2>Informe de Ventas -  La Nueva Fournier - BOLETERIA TAFI VIEJO</h2>

<!-- @foreach ($consulta as $datos)
<h3>Usuario: {{$datos->user->name}}</h3>
<h3>Fecha de Cierre: {{date('d-m-Y', strtotime($datos->fecha))}}</h3>
<h3>Observacion: {{$datos->observacion}}</h3>

@endforeach -->
<br>
    <div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Abonado</th> 
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Plancha</th>
                    <th>Codigo</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Monto</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($consulta as $datos)
                <tr>
                  <td >{{$datos->abonado->apellido}},{{$datos->abonado->nombre}}</td>
                  <td >{{date('d-m-Y', strtotime($datos->fecha))}}</td>
                  <td >{{$datos->cantidad}}</td>
                  <td >{{$datos->numero}}</td>
                  <td >{{$datos->boleto}}</td>
                  <td >{{$datos->desde}}</td>
                  <td >{{$datos->hasta}}</td>
                  <td >{{$datos->user->name}}</td>
                  @if($datos->anulado==1)
                      <td >ANULADO</td>
                    @else
                      <td >Vendido</td>
                    @endif

                  <td align="right">$ {{number_format($datos->montototal,2,",",".")}}</td>
                  
                  </tr>
            @endforeach                   
            </tbody>
        </table>
    </div>
<br>
<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
             
            </thead>

            <tbody>
           
                <tr>
 
                  <td align="right">Total : $ {{number_format($consultasuma,2,",",".")}}</td>
                  
                  </tr>
           
            </tbody>
        </table>
    </div>
<div class="card">
        <div class="row">
            <div  class="Form-group col-lg-3" >

                <h2 align="right">Son: {{$montoenletras}}</h2>

            </div>
    </div>
</div>

   
</body>
</html>