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
            width: 50%;
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
 	


<h1>Informe Gasoil Diario La Nueva Fournier - Central Manantial</h1>

<h3>Desde el {{date('d-m-Y', strtotime($fi))}} hasta el {{date('d-m-Y', strtotime($ff))}}</h3>


@foreach ($datos as $info)


    <br>
	<div>
        <h2>LINEA 118</h2>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th >Dia</th>
                    <th >Litros Gasoil</th>
                    <th >Interno</th>
                    
                </tr>
            </thead>
             <tbody>

  			@foreach ($linea118 as $dato)

  				@if($dato->fecha == $info->fecha)
                <tr>
                  <td width="200px" >{{$dato->fecha}}</td> 
                  <td align="right" >{{$dato->litros}}</td> 
                  <td align="right" >{{$dato->interno}}</td> 
                </tr>
                @endif
            @endforeach            
                      
            </tbody>
        </table>


       </div>
   

           	<h1>{{$info->l118}}</h1>
@endforeach            


@foreach ($datos as $info)


    <br>
	<div>
        <h2>LINEA 121</h2>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr> 
                	<th >Dia</th>
                    <th >Litros Gasoil</th>
                    <th >Interno</th>
                    
                </tr>
            </thead>
             <tbody>

  			@foreach ($linea121 as $dato)

  				@if($dato->fecha == $info->fecha)
                <tr>
                  <td width="200px" >{{$dato->fecha}}</td> 
                  <td align="right" >{{$dato->litros}}</td> 
                  <td align="right" >{{$dato->interno}}</td> 
                </tr>
                @endif
            @endforeach            
                      
            </tbody>
        </table>


       </div>
   

           	<h1>{{$info->l121total}}</h1>
@endforeach  
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