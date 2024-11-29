
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Table</title>
 <style>
 		@page {
            margin: 4mm; /* Configura márgenes a cero */
        }
        body {
            margin: 0;
            padding: 0;
        }
        .content {
            width: 100%;
            height: 100%;
            
        }
        table {
            border-collapse: collapse;

        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 1px;
            height: 20px; /* Alto fijo */
            width: 72px;
            font-size: 11px; /* Tamaño base */
        }
        th {
            background-color: #f2f2f2;
        }
        .titulo {
            width: 150px;
        }
        .cabecera {
            width: 300px;
            height: 15px; /* Alto fijo */
            font-size: 12px; /* Tamaño base */
            background-color: lightgray; /* Ejemplo de fondo para verificar bordes */
        }
        .coche {
            width: 150px;
            height: 15px; /* Alto fijo */
            font-size: 12px; /* Tamaño base */
        }

        .inline {
            display: flex; /* Coloca los elementos en línea */
            align-items: center; /* Alinea verticalmente los textos */
        }
        .inline h3, .inline h4 {
            margin: 0; /* Elimina márgenes por defecto */
        }
        h4 {
            margin-left: 10px; /* Espacio entre el h1 y h4 */
            font-weight: normal; /* Opcional: cambia el grosor de h4 para diferenciarlos */
        }
    </style>
</head>
<body>
<div class="content">
	<div class="inline">
		<span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} | Usuario: {{$usuario}}</span>
		<h3>HOJA DE RUTA  - {{$empresa1}} / {{$empresa2}} | Serv, {{$codigoserv}} - H1 - Linea: TUC/RAMADA DE ABAJO - Fec Serv: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
		<h4> Chofer: {{$choferapellido}}, {{$chofernombre}} - Legajo: {{$choferlegajo}} | Interno: {{$cocheinterno}} - Patente: {{$cochepatente}}</h4>
		

	</div>
    <table>
    	<tbody>
    		<tr>
				<td class='coche'> HOJA DE RUTA</td>1
    			<td class='cabecera'> CHOFER</td>1
				<td class='coche'> COCHE</td>1
				<td class='coche'> {{$empresa1}}</td>1
				<td class='cabecera'> CODIGO SERVICIO {{$codigoserv}}</td>1
				<td class='coche'> FECHA SERVICIO {{$fechaserv}}</td>1

    		</tr>
    		<tr>
    			<td class='coche'> </td>
    			<td class='cabecera'> Apellido y Nombre: {{$choferapellido}}, {{$chofernombre}}</td>1
    			<td class='coche'> Interno: {{$cocheinterno}}</td>1
    			<td class='coche'> {{$empresa2}}</td>1
    			<td class='cabecera'> Linea: TUC/RAMADA DE ABAJO</td>1
    			<td class='coche'> Fecha emision {{now()->format('d-m-Y')}} </td>
    			
    		</tr>
    		<tr>
    			<td class='coche'> </td>
    			<td class='cabecera'> Legajo: {{$choferlegajo}}</td>
    			<td class='coche'> Patente: {{$cochepatente}}</td>
    			<td class='coche'> </td>
    			<td class='cabecera'> Servicio: H1</td>
    			<td class='coche'> Usuario {{$usuario}} </td>
    			
    		</tr>
    		<tr>
    			<td class='coche'> </td>
    			<td class='cabecera'> Firma</td>
    			<td class='coche'> </td>
    			<td class='coche'> </td>
    			 <td class='cabecera'> Turno</td>
    			 <td class='coche'> </td>
    			 
    		</tr>
    		
    	</tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>10</td>
                <td>12</td>
                <td>14</td>
                <td>15</td>
                <td>18</td>
                <td>21</td>
                <td>23</td>
                <td>27</td>
                <td>30</td>
                <td>32</td>
                <td>ABONO</td>
                <td>INSPECTOR </td>
            </tr>
            <tr>
                <td class='titulo'>13:30 SALE TUCUMAN </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:40 PTE L CORDOBA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:50 KM 9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:55 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:10 CHAÑAR - YIYI</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:20 ESC. TAQUELLO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> 
            </tr>
            <tr>
                <td>14:15 TACO PALTA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:30 LLEGA LA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:45 SAN JOSE </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:50 SAN JOSE</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:10 SALE LA MARTA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:20 TACO PALTA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:40 CHAÑAR YIYI</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:50 LAS PIEDRITAS </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>17:10 PTE L CORDOBA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>17:25 LLEGA TUCUMAN </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>

        </tbody>
    </table>


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

</div>
</body>
</html>
