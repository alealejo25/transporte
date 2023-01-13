<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Articulos</title>
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
   		<h1 align="center">Informe de Coche</h1>
    	<center><img src={{$foto}} width="250"></center>
        

    </div>
        <br>
    <br>
        <br>
    <br>
	<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>N° Interno</th>
                    <th>N° Linea</th>
                    <th>Empresa</th>
                    <th>En servicio</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->interno}}</td>
                    <td>{{$dato->nroempresa}}</td>
                    <td>{{$dato->empresa->denominacion}}</td>
                    <td>{{$dato->activo}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Carroceria</th>
                    <th>Año</th>
                    <th>Chasis</th>
                    <th>Motor</th>
                    <th>N° Asientos</th>

                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->patente}}</td>
                    <td>{{$dato->marca->nombre}}</td>
                    <td>{{$dato->modelo->nombre}}</td>
                    <td>{{$dato->carroceria->nombre}}</td>
                    <td>{{$dato->año}}</td>
                    <td>{{$dato->chasis}}</td>
                    <td>{{$dato->motor}}</td>
                    <td>{{$dato->nroasientos}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div> 
    <br>
    <br>
    <div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                    <th>Kms</th>
                    <th>Ultimo Service</th>
                    <th>Fecha Ing</th>
                    <th>Fecha VTV</th>
                    <th>Venc VTV</th>
                    <th>Estado VTV</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->km}}</td>

                    <td>{{date('d-m-Y', strtotime($dato->ultimoservice))}}</td>
                     <td>{{date('d-m-Y', strtotime($dato->fecha_ingreso))}}</td>
                      <td>{{date('d-m-Y', strtotime($dato->fechavtv))}}</td>
                      <td>{{date('d-m-Y', strtotime($dato->vencimientovtv))}}</td>

                    <td>Vencido</td>
                    
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
        <span class="derecha">Fecha de Informe  {{now()->format('d-m-Y')}}</span>

    
   
</body>
</html>