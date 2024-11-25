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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>




         <span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} - Servicio {{$codigoserv}} - Fecha del Servicio {{$fechaserv}}</span>
<br>
	<div>
        <table class="table table-bordered table-striped table-sm">

  			@foreach ($servicios as $dato)
                <tr>
                @if($dato->inicialcod6a!=0)
                 <td>6A {{$dato->inicialcod6a}}</td>
                @endif
                @if($dato->inicialcod6b!=0)
                 <td>6B {{$dato->inicialcod6b}}</td> 

                @endif
                @if($dato->inicialcod7a!=0)
                 <td>7A {{$dato->inicialcod7a}}</td> 

                @endif
                @if($dato->inicialcod7b!=0)
                 <td>7B {{$dato->inicialcod7b}}</td> 
                @endif
                @if($dato->inicialcod8a!=0)
                 <td>8A {{$dato->inicialcod8a}}</td> 
                @endif
                @if($dato->inicialcod8b!=0)
                 <td>8B {{$dato->inicialcod8b}}</td> 
                @endif
                @if($dato->inicialcod10a!=0)
                 <td>10A {{$dato->inicialcod10a}}</td> 
                @endif
                @if($dato->inicialcod10b!=0)
                 <td>10B {{$dato->inicialcod10b}}</td> 
                @endif
                @if($dato->inicialcod12a!=0)
                 <td>12A {{$dato->inicialcod12a}}</td> 
                @endif
                @if($dato->inicialcod12b!=0)
                 <td>12B {{$dato->inicialcod12b}}</td> 
                @endif
                @if($dato->inicialcod14a!=0)
                 <td>14A {{$dato->inicialcod14a}}</td> 
                @endif
                @if($dato->inicialcod14b!=0)
                 <td>14B {{$dato->inicialcod14b}}</td> 
                @endif
                @if($dato->inicialcod15a!=0)
                 <td>15A {{$dato->inicialcod15a}}</td> 
                @endif
                @if($dato->inicialcod15b!=0)
                 <td>15B {{$dato->inicialcod15b}}</td> 
                @endif
                @if($dato->inicialcod18a!=0)
                 <td>18A {{$dato->inicialcod18a}}</td> 
                @endif
                @if($dato->inicialcod18b!=0)
                 <td>18B {{$dato->inicialcod18b}}</td> 
                @endif
                @if($dato->inicialcod21a!=0)
                 <td>21A {{$dato->inicialcod21a}}</td> 
                @endif
                @if($dato->inicialcod21b!=0)
                 <td>21B {{$dato->inicialcod21b}}</td> 
                @endif
                @if($dato->inicialcod23a!=0)
                 <td>23A {{$dato->inicialcod23a}}</td> 
                @endif
                @if($dato->inicialcod23b!=0)
                 <td>23B {{$dato->inicialcod23b}}</td> 
                @endif
                @if($dato->inicialcod27a!=0)
                 <td>27A {{$dato->inicialcod27a}}</td> 
                @endif
                @if($dato->inicialcod27b!=0)
                 <td>27B {{$dato->inicialcod27b}}</td> 
                @endif
                @if($dato->inicialcod30a!=0)
                 <td>30A {{$dato->inicialcod30a}}</td> 
                @endif
                @if($dato->inicialcod30b!=0)
                 <td>30B {{$dato->inicialcod30b}}</td> 
                @endif
                @if($dato->inicialcod32a!=0)
                 <td>32A {{$dato->inicialcod32a}}</td> 
                @endif
                @if($dato->inicialcod32b!=0)
                 <td>32B {{$dato->inicialcod32b}}</td> 
                @endif
                @if($dato->inicialabonoa!=0)
                 <td>AbonoA {{$dato->inicialabonoa}}</td> 
                @endif
                @if($dato->inicialabonob!=0)
                 <td>AbonoB {{$dato->inicialabonob}}</td> 
                @endif
			 </tr>

                <tr style="height: 100px;">
                @if($dato->inicialcod6a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod6b!=0)
                 <td>. </td> 

                @endif
                @if($dato->inicialcod7a!=0)
               <td>. </td> 

                @endif
                @if($dato->inicialcod7b!=0)
                <td>. </td> 
                @endif
                @if($dato->inicialcod8a!=0)
               <td>. </td> 
                @endif
                @if($dato->inicialcod8b!=0)
               <td>. </td> 
                @endif
                @if($dato->inicialcod10a!=0)
                <td>. </td> 
                @endif
                @if($dato->inicialcod10b!=0)
              <td>. </td> 
                @endif
                @if($dato->inicialcod12a!=0)
           <td>. </td> 
                @endif
                @if($dato->inicialcod12b!=0)
                <td>. </td> 
                @endif
                @if($dato->inicialcod14a!=0)
               <td>. </td> 
                @endif
                @if($dato->inicialcod14b!=0)
                <td>. </td> 
                @endif
                @if($dato->inicialcod15a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod15b!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod18a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod18b!=0)
                 <td>. </td>  
                @endif
                @if($dato->inicialcod21a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod21b!=0)
                 <td>. </td>  
                @endif
                @if($dato->inicialcod23a!=0)
                 <td>. </td>  
                @endif
                @if($dato->inicialcod23b!=0)
                 <td> </td>  
                @endif
                @if($dato->inicialcod27a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod27b!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod30a!=0)
                 <td>. </td>  
                @endif
                @if($dato->inicialcod30b!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod32a!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialcod32b!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialabonoa!=0)
                 <td>. </td> 
                @endif
                @if($dato->inicialabonob!=0)
                 <td>. </td> 
                @endif

                 </tr>
            @endforeach            
                          

        </table>
    </div>

    
</body>
</html>