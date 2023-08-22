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

        <h1>Reporte Horas trabajadas x Chofer - Central Manantial</h1>


 

<h3>Desde el {{date('d-m-Y', strtotime($fi))}} hasta el {{date('d-m-Y', strtotime($ff))}}</h3>
<br>
	<div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th>Legajo</th>
                    <th>Chofer</th>
                    <th>Fecha</th>
                    <th>Nro Servicio</th>
                    <th>Total Pax</th>
                    <th>Hs Trab.</th>
                    <th>Hs Sobr.</th>
                    <th>A</th>
                    <th>Hs Alargue</th>
                    <th>C</th>
                    <th>DN</th>
                    <th>N</th>
                    
                 </tr>
            </thead>
             <tbody>
  			@foreach ($datos as $dato)
                <tr>
                  <td>{{$dato->legajo}}</td> 
                  <td>{{$dato->apellido}}, {{$dato->nombre}}</td> 
				  <td align="right" >{{date("d/m/Y",strtotime($dato->fecha))}}
				  <td align="right">{{$dato->numero}}</td> 
				  <td align="right">{{$dato->pasajestotal}}</td>
                  <td align="right">{{$dato->horastotal}}</td>
                  <td align="right">{{$dato->horassobrantes}}</td> 
                  <td align="right">{{$dato->alargue}}</td> 
                  <td align="right">{{$dato->horastotalalargue}}</td> 
                  <td align="right">{{$dato->cortado}}</td> 
                  <td align="right">{{$dato->doblenegro}}</td> 
                  <td align="right">{{$dato->normal}}</td> 
				  
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