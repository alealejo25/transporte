<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if($empresa==1)
    <title>Reporte de Boletos La Nueva Fournier</title>
@else
    <title>Reporte de Boletos Leagas</title>
@endif

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.75rem;
            font-weight: normal;
            line-height: 1.1;
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
            border: 1px solid #c2cfd6;
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
            padding: 0.75rem;
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
            text-align: left;
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
        .centrarImagen
			{
			 text-align:center;
			 display:block;
			}
    </style>
</head>
<body>
   <div>
        @if($empresa==1)
        <h2>Informe de Servicio - La Nueva Fournier <span class="derecha">Fecha de Emision: {{now()->format('d-m-Y')}}</span></h2>
        @else
        <h2>Informe de Servicio - Leagas <span class="derecha">Fecha de Emision: {{now()->format('d-m-Y')}}</span></h2>
        @endif

   		
    </div>
        <br>
    <br>
        <br>
    <br>
    @foreach ($datos as $dato)
        @if($dato->alargue==1)
        <h2>Tipo de servicio: ALARGUE</h2>
    @endif
		<h3>Fecha {{date('d-m-Y', strtotime($dato->fecha))}} - Chofer: {{$dato->apellido}}, {{$dato->nombrechofer}}</h3>
		<h3>Linea: {{$dato->linea->numero}} - Turno: {{$dato->nombre}} - Servicio: {{$dato->servicioleagaslnf->numero}}</h3>
	@endforeach
	<div>
		<h3>Datos de Venta de Boletos</h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Fecha</th>
                    <th>Total Pax</th>
                    <th>Total Rec.</th>
                    <th>Toques</th>
                    <th>Valor Toques</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
                    <td align="right">{{$dato->pasajestotal}}</td>
                    <td align="right">$ {{$dato->recaudaciontotal}}</td>
                    <td align="right">{{$dato->toquesanden}}</td>
                    <td align="right">$ {{$dato->valortoquesanden}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div>
    	<h3>Datos de horas trabajadas</h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Horas trabajadas</th>
                    <th>Horas Sobrantes</th>
                    <th>Valor de hora Sobrante</th>
                                      
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->horainicio}}</td>
                    <td>{{$dato->horafin}}</td>
                    @if($dato->alargue==1)
                        <td>{{$dato->horastotalalargue}}</td>
                    @else
                        <td>{{$dato->horastotal}}</td>
                    @endif
                    <td>{{$dato->horassobrantes}}</td>
                    <td>{{$dato->valorhorasrestantes}}</td>
                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div> 
    <br>
    <br>
    <div>
    	<h3>Datos del Servicio</h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Interno</th>
                    <th>Inicio Tarjeta</th>
                    <th>Fin Tarjeta</th>
                    <th>Cant. Pasajes</th>
                    <th>Recaudacion</th>
                    <th>Gasoil</th>
                    <th>Motivo Cambio</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>
                    <td align="right">{{$servicio->interno}}</td>
                    <td align="right">{{$servicio->iniciotarjeta}}</td>
                    <td align="right">{{$servicio->fintarjeta}}</td>
					<td align="right">{{$servicio->cantpasajes}}</td>
					<td align="right">${{$servicio->recaudacion}}</td>
                    <td align="right">{{$servicio->gasoil}}</td>
                    <td>{{$servicio->motivo_cambio}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div>
    
<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <br>
    <br>
    <br>
    <br>
    <br>
      

    
   
</body>
</html>