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
 	<h1>Recaudación - La Nueva Fournier - BOLETERIA TAFI VIEJO</h1>

@foreach ($datos as $dato)

<h3>Usuario Responsable: {{$dato->user->name}} - Observacion: {{$dato->observacion}}</h3>
<h3>Fecha de Recaudacion: {{date('d-m-Y', strtotime($dato->fecha))}} - Recaudaciones: Desde el {{date('d-m-Y', strtotime($dato->desde))}} hasta el {{date('d-m-Y', strtotime($dato->hasta))}}</h3>


@endforeach
<br>
	<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th>Planchas Vend.</th>
                    <th>Planchas Anu.</th>
                    <th>Abono 100%</th>
                    <th>Abono 50%</th>
                    <th>Posnet</th>
                    <th>Total Ingresos</th>
                    <th>Tot. Egresos 100%</th>
                    <th>Neto Ganancia</th>
                    <th>Fisico</th>
                    <th>Diferencia</th>
                    
                  

                </tr>
            </thead>
             <tbody>
  			@foreach ($datos as $dato)
                <tr>
                  <td >{{$dato->planchasvendidas}}</td> 
                  <td >{{$dato->planchasanuladas}}</td> 
                  <td align="right">$ {{number_format($dato->abono,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->abono50,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->posnet,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->totalingresos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->egresos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->montoneto,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->fisico,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->diferencia,2,",",".")}}</td>
                </tr>
            @endforeach            
                          
            </tbody>
        </table>
    </div>

<!-- <div class="card">
        <div class="row">
            <div  class="Form-group col-lg-3" >

                <h2 align="right">Son: {{$montonetoenletras}}</h2>

            </div>
    </div>
</div> -->
<h3>BILLETERO</h3>
<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                	<th></th> 
                	<th>Diez</th>
                	<th>Veinte</th>
                	<th>Cincuenta</th>
                	<th>Cien</th>
                	<th>Doscientos</th>
                	<th>Quinientos</th>
                	<th>Mil</th>
                </tr>
            </thead>
            <tbody>
  			@foreach ($datos as $dato)
                <tr>
                  <td >Cantidad</td> 
                  <td align="right">{{$dato->diez}}</td>
                  <td align="right">{{$dato->veinte}}</td>
                  <td align="right">{{$dato->cincuenta}}</td>
                  <td align="right">{{$dato->cien}}</td>
                  <td align="right">{{$dato->doscientos}}</td>
                  <td align="right">{{$dato->quinientos}}</td>
                  <td align="right">{{$dato->mil}}</td>
                  
                </tr>
            @endforeach            
                          
            </tbody>
            <tbody>
  			
                <tr>
                  <td >Monto</td> 
                  <td align="right">$ {{number_format($diez,2,",",".")}}</td>
                  <td align="right">$ {{number_format($veinte,2,",",".")}}</td>
                  <td align="right">$ {{number_format($cincuenta,2,",",".")}}</td>
                  <td align="right">$ {{number_format($cien,2,",",".")}}</td>
                  <td align="right">$ {{number_format($doscientos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($quinientos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($mil,2,",",".")}}</td>
                </tr>
            
                          
            </tbody>
            </table>
    </div>
            <table class="table table-bordered table-striped table-sm">
            	<thead>
  				@foreach ($datos as $dato)
                <tr>
                  <td align="right">Son: {{$montofisicoenletras}} - Total Neto:  $ {{number_format($dato->fisico,2,",",".")}}</td>
                  
                </tr>
            	@endforeach            
                  </thead>        
</table>
<h3>CIERRES</h3>
<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th>Fecha Cierre</th>
                    <th>Abono 100%</th>
                    <th>Gastos 100%</th>
                    <th>Abono Final</th>
                    <th>Abono 50%</th>
                    <th>Lote Posnet</th>
                    <th>Posnet</th>
                    <th>Monto Neto</th>
                    <th>Planchas Vend.</th>
                    <th>Planchas Anu.</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
             <tbody>
  			@foreach ($consultacierretafi as $dato)
                <tr>
                  <td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
                  <td align="right">$ {{number_format($dato->venta,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->gastos,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->caja_final,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->ganancialnf,2,",",".")}}</td>
                  <td align="right">{{$dato->nrolote}}</td>
                  <td align="right">$ {{number_format($dato->montolote,2,",",".")}}</td>
                  <td align="right">$ {{number_format($dato->gananciatotallnf,2,",",".")}}</td>
                  <td >{{$dato->planchasvendidas}}</td> 
                  <td >{{$dato->planchasanuladas}}</td> 
                  <td >{{$dato->observacion}}</td> 
                </tr>
            @endforeach            
                          
            </tbody>
        </table>
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