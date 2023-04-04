<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Boletos Leagas</title>
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
   		<h2>Informe de Servicio - La Nueva Fournier <span class="derecha">Fecha de Emision: {{now()->format('d-m-Y')}}</span></h2>
    </div>
        <br>
    <br>
        <br>
    <br>
    @foreach ($datos as $dato)
		<h3>Fecha {{date('d-m-Y', strtotime($dato->fecha))}} - Chofer: {{$dato->choferleagaslnf->nombre}}</h3>
		<h3>Linea: {{$dato->linea->numero}} - Interno: {{$dato->coche->interno}} - Turno: {{$dato->nombre}} - Servicio: {{$dato->servicioleagaslnf->numero}}</h3>
	@endforeach
	<div>
		<h3>Datos de Venta de Boletos</h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Fecha</th>
                    <th>Inicio de tarjeta</th>
                    <th>Fin de tarjeta</th>
                    <th>Cantidad de Pax</th>
                    <th>Recaudacion</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
                    <td align="right">{{$dato->iniciotarjeta}}</td>
                    <td align="right">{{$dato->fintarjeta}}</td>
                    <td align="right">{{$dato->cantpasajes}}</td>
                    <td align="right">$ {{$dato->recaudacion}}</td>
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
                    <td>{{$dato->horastotal}}</td>
                    <td>{{$dato->horassobrantes}}</td>
                    <td align="right">$ {{$dato->valorhorasrestantes}}</td>
                    
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
                    <th>GasOil</th>
                    <th>Toques de Anden</th>
                    <th>Valor de Toques</th>
                    <th>Observaciones</th>
                    <th>Usuario Responsable</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td align="right"> {{$dato->gasoil}}</td>
                    <td align="right">{{$dato->toquesanden}}</td>
                    <td align="right">$ {{$dato->valortoquesanden}}</td>
					<td>{{$dato->observaciones}}</td>
					<td>{{$dato->user->name}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div>
    @if($taller=='SI')
    
    <div>
        <h3>TALLER</h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Observacion de entrada al taller</th>
                                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td> {{$dato->observaciones}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div> 
    @endif
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