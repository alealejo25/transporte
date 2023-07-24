<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Servicios</title>
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
    @if($empresa==2)
        <h1>Nomina de Choferes Leagas</h1>
    @else
        <h1>Nomina de Choferes La Nueva Fournier</h1>
    @endif

<br>
	<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th>Legajo</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>CUIL</th>
                    <th>Direccion</th>
                    <th>Cod Pos.</th>
                    <th>Tel. Cel.</th>
                    <th>Tel. Fijo</th>
                    <th>Fec Nac.</th>
                     <th>Tipo Contr.</th>
                     <th>Fec Ingreso.</th>
                     <th>Cat Chofer</th>
                 </tr>
            </thead>
             <tbody>
  			@foreach ($datos as $dato)
                <tr>
                  <td align="right" >{{$dato->legajo}}</td> 
                  <td>{{$dato->apellido}}</td> 
                  <td>{{$dato->nombre}}</td> 
				  <td align="right" >{{$dato->dni}}</td> 
                  <td align="right" >{{$dato->cuil}}</td> 
                  <td>{{$dato->direccion}}</td> 
                  <td align="right" >{{$dato->codpos}}</td> 
                  <td align="right" >{{$dato->nrocelular}}</td> 
                  <td align="right" >{{$dato->nrofijo}}</td> 
                  <td align="right" >{{date("d/m/Y",strtotime($dato->fechanac))}}</td> 
                  <td>{{$dato->tipocontratacion->nombre}}</td> 
                  <td align="right" >{{date("d/m/Y",strtotime($dato->fechaingreso))}}</td> 
                  <td>{{$dato->categoriachofer->nombre}}</td> 
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

            </div>
        </div>
    </div>
</body>
</html>