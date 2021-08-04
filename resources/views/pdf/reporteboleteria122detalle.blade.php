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
    	 <IMG SRC="img\logotlpdf.jpg">
    	 <span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}}</span>
    </div>
 	<h2>Reporte de Planillas Boleteria 122</h2>

	<div>



        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                	<th>Oper.</th> 
                    <th>Responsable</th>
                    <th>Fecha Presentacion</th>

                    <th>Fecha</th>
                    <th>Por plancha</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Por Unidad</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Posnet</th>
                    <th>Cierre Lote</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($consulta as $datos)
                <tr>
                	<td >{{$datos->boleteria122_id}}</td>
                    <td >{{$datos->responsable}}</td>
                    <td >{{date('d-m-Y', strtotime($datos->fecha))}}</td>
                    <td >{{date('d-m-Y', strtotime($datos->dia))}}</td>
                    <td align="right"><b>$ {{number_format($datos->totalarendirp,2,",",".")}}</b></td>
                    <td align="right">{{number_format($datos->abonodesdep)}}</td>
                    <td align="right">{{number_format($datos->abonohastap)}}</td>
                    <td align="right"><b>$ {{number_format($datos->totalarendiru,2,",",".")}}</b></td>
                    <td align="right">{{number_format($datos->abonodesdeu)}}</td>
                    <td align="right">{{number_format($datos->abonohastau)}}</td>
                    <td align="right"><b>$ {{number_format($datos->totalarendirm,2,",",".")}}</b></td>
                    <td align="right">{{number_format($datos->cierrelote)}}</td>
                    
                </tr>
            @endforeach                   
            </tbody>
             <tbody>
                <tr>
                	<td></td>
               
                	<td></td>
                	<td></td>
                    <td></td>
                    <td align="right"><h3><b>$ {{number_format($consultasumarendirp,2,",",".")}}</b></h3></td>
                    <td></td>
                    <td></td>
                    <td align="right"><h3><b>$ {{number_format($consultasumarendiru,2,",",".")}}</b></h3></td>
                    <td></td>
                    <td></td>
                    <td align="right"><h3><b>$ {{number_format($consultasumarendirm,2,",",".")}}</b></h3></td>
                    <td></td>
                </tr>
            
            </tbody>
        </table>



        
    </div>
    <div>
    	<h2 align="right">Total: $ {{number_format($consultasuma,2,",",".")}}</h2>
    </div>


</body>
</html>