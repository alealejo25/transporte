
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLANILLA H2</title>
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
            width: 100%; /* La tabla ocupa el 100% del ancho disponible */

        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 1px;
            height: 18px; /* Alto fijo */
            width: 72px;
            font-size: 11px; /* Tamaño base */
            word-wrap: break-word; /* Ajusta texto largo */
        }
        td.dynamic {
            width: calc(100% / auto); /* Ajusta dinámicamente el ancho */
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
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
<div class="content">
	<div class="inline">
        <h3>HOJA DE RUTA  - {{$empresa1}} / {{$empresa2}} || Serv: {{$codigoserv}} - H2 - Linea: TUC/RAPELLI - Turno:M- FEC SERV: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
        <h4> CHOFER: <strong>{{$choferapellido}}, {{$chofernombre}}</strong> - Legajo: <strong>{{$choferlegajo}}</strong> || INTERNO: <strong>{{$cocheinterno}}</strong> - PATENTE: <strong>{{$cochepatente}}</strong><span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} || Usuario: {{$usuario}} || Planilla Nro: <strong>{{$nroplanilla}}</strong> || HOJA: <strong>1</strong></span></h4>
        

    </div>
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
                <td class='titulo'>11:25 SALE TUCUMAN </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>11:35 PTE L CORDOBA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>11:45 KM 9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>11:50 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>12:00 CANCHAESPINIL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>12:10 MASTIL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> 
            </tr>
            <tr>
                <td>12:20 SAN PATRICIO </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>12:40 CEM. V.B.ARAOZ</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>12:50 CRUCE </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:00 SAL BURRUYACU</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:10 EL TRIUNFO </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:20 GARMENDIA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>13:45 RAPELLI</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:00 RAPELLI </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:25 GARMENDIA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:35 EL TRIUNFO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>14:50 CRUCE</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:00 SAL BURRUYACU</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:10 CEM. V.B.ARAOZ</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:30 SAN PATRICIO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:40 SAL RAMADA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:50 SAL MACOMITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:40 SAL RAMADA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>15:50 SAL MACOMITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:00 CANCHAESPINIL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:10 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:25 AUTOPISTA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>16:35 TUCUMAN</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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
                 <td class="dynamic">6A {{$dato->inicialcod6a}}</td>
                @endif
                @if($dato->inicialcod6b!=0)
                 <td class="dynamic">6B {{$dato->inicialcod6b}}</td> 

                @endif
                @if($dato->inicialcod7a!=0)
                 <td class="dynamic">7A {{$dato->inicialcod7a}}</td> 

                @endif
                @if($dato->inicialcod7b!=0)
                 <td class="dynamic">7B {{$dato->inicialcod7b}}</td> 
                @endif
                @if($dato->inicialcod8a!=0)
                 <td class="dynamic">8A {{$dato->inicialcod8a}}</td> 
                @endif
                @if($dato->inicialcod8b!=0)
                 <td class="dynamic">8B {{$dato->inicialcod8b}}</td> 
                @endif
                @if($dato->inicialcod10a!=0)
                 <td class="dynamic">10A {{$dato->inicialcod10a}}</td> 
                @endif
                @if($dato->inicialcod10b!=0)
                 <td class="dynamic">10B {{$dato->inicialcod10b}}</td> 
                @endif
                @if($dato->inicialcod12a!=0)
                 <td class="dynamic">12A {{$dato->inicialcod12a}}</td> 
                @endif
                @if($dato->inicialcod12b!=0)
                 <td class="dynamic">12B {{$dato->inicialcod12b}}</td> 
                @endif
                @if($dato->inicialcod14a!=0)
                 <td class="dynamic">14A {{$dato->inicialcod14a}}</td> 
                @endif
                @if($dato->inicialcod14b!=0)
                 <td class="dynamic">14B {{$dato->inicialcod14b}}</td> 
                @endif
                @if($dato->inicialcod15a!=0)
                 <td class="dynamic">15A {{$dato->inicialcod15a}}</td> 
                @endif
                @if($dato->inicialcod15b!=0)
                 <td class="dynamic">15B {{$dato->inicialcod15b}}</td> 
                @endif
                @if($dato->inicialcod18a!=0)
                 <td class="dynamic">18A {{$dato->inicialcod18a}}</td> 
                @endif
                @if($dato->inicialcod18b!=0)
                 <td class="dynamic">18B {{$dato->inicialcod18b}}</td> 
                @endif
                @if($dato->inicialcod21a!=0)
                 <td class="dynamic">21A {{$dato->inicialcod21a}}</td> 
                @endif
                @if($dato->inicialcod21b!=0)
                 <td class="dynamic">21B {{$dato->inicialcod21b}}</td> 
                @endif
                @if($dato->inicialcod23a!=0)
                 <td class="dynamic">23A {{$dato->inicialcod23a}}</td> 
                @endif
                @if($dato->inicialcod23b!=0)
                 <td class="dynamic">23B {{$dato->inicialcod23b}}</td> 
                @endif
                @if($dato->inicialcod27a!=0)
                 <td class="dynamic">27A {{$dato->inicialcod27a}}</td> 
                @endif
                @if($dato->inicialcod27b!=0)
                 <td class="dynamic">27B {{$dato->inicialcod27b}}</td> 
                @endif
                @if($dato->inicialcod30a!=0)
                 <td class="dynamic">30A {{$dato->inicialcod30a}}</td> 
                @endif
                @if($dato->inicialcod30b!=0)
                 <td class="dynamic">30B {{$dato->inicialcod30b}}</td> 
                @endif
                @if($dato->inicialcod32a!=0)
                 <td class="dynamic">32A {{$dato->inicialcod32a}}</td> 
                @endif
                @if($dato->inicialcod32b!=0)
                 <td class="dynamic">32B {{$dato->inicialcod32b}}</td> 
                @endif
                @if($dato->inicialabonoa!=0)
                 <td class="dynamic">AboA {{$dato->inicialabonoa}}</td> 
                @endif
                @if($dato->inicialabonob!=0)
                 <td class="dynamic">AboB {{$dato->inicialabonob}}</td> 
                @endif
			 </tr>

                <tr>
                @if($dato->inicialcod6a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod6b!=0)
                 <td class="dynamic"></td> 

                @endif
                @if($dato->inicialcod7a!=0)
               <td class="dynamic"> </td> 

                @endif
                @if($dato->inicialcod7b!=0)
                <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod8a!=0)
               <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod8b!=0)
               <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod10a!=0)
                <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod10b!=0)
              <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod12a!=0)
           <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod12b!=0)
                <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod14a!=0)
               <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod14b!=0)
                <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod15a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod15b!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod18a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod18b!=0)
                 <td class="dynamic"></td>  
                @endif
                @if($dato->inicialcod21a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod21b!=0)
                 <td class="dynamic"></td>  
                @endif
                @if($dato->inicialcod23a!=0)
                 <td class="dynamic"></td>  
                @endif
                @if($dato->inicialcod23b!=0)
                 <td class="dynamic"></td>  
                @endif
                @if($dato->inicialcod27a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod27b!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod30a!=0)
                 <td class="dynamic"></td>  
                @endif
                @if($dato->inicialcod30b!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod32a!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialcod32b!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialabonoa!=0)
                 <td class="dynamic"></td> 
                @endif
                @if($dato->inicialabonob!=0)
                 <td class="dynamic"></td> 
                @endif

                 </tr>
            @endforeach            
                          

        </table>
    </div>

</div>



<div class="content">
    <div class="inline">
        <h3>HOJA DE RUTA  - {{$empresa1}} / {{$empresa2}} || Serv: {{$codigoserv}} - H2 - Linea: TUC/PUEST V2 - Turno:T - FEC SERV: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
        <h4> CHOFER: <strong>{{$choferapellido}}, {{$chofernombre}}</strong> - Legajo: <strong>{{$choferlegajo}}</strong> || INTERNO: <strong>{{$cocheinterno}}</strong> - PATENTE: <strong>{{$cochepatente}}</strong><span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} || Usuario: {{$usuario}} || Planilla Nro: <strong>{{$nroplanilla}}</strong> || HOJA: <strong>2</strong></span></h4>
        

    </div>
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
                <td class='titulo'>17:40 SALE TUCUMAN </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>17:50 PTE L.CORDOBA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>18:00 KM9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>18:10 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>18:20 CAN ESPINILLO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>18:40 MASTIL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> 
            </tr>
            <tr>
                <td>18:55 SAN PATRICIO  </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>19:15 CEM. V.B.ARAOZ </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>19:25 CRUCE  </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>19:35 SANTA MARIA   </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>19:45 PUEST ABAJO   </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>19:55 LLEGA P.   </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:00 SALE P.</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:10 PUESTO ABAJO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:20 STA MARIA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:30 BURRUY/TRASBO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:40 SAL BURRUYACU</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>20:50 CEM V.B.ARAOZ</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:10 SAN PATRICIO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:20 SAL RAMADA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:25 SAL MACOMITA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:30 CAN ESPINILLO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:40 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>21:55 PTE L.CORDOBA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>22:05 LLEGA TUCUMAN</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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
                        <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>
   
</div>
<div class="content">
    <div class="inline">
        <h3>HOJA DE RUTA  - {{$empresa1}} / {{$empresa2}} || Serv: {{$codigoserv}} - H2 - Linea: TUC/GARM V3 - Turno:N - FEC SERV: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
        <h4> CHOFER: <strong>{{$choferapellido}}, {{$chofernombre}}</strong> - Legajo: <strong>{{$choferlegajo}}</strong> || INTERNO: <strong>{{$cocheinterno}}</strong> - PATENTE: <strong>{{$cochepatente}}</strong><span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} || Usuario: {{$usuario}} || Planilla Nro: <strong>{{$nroplanilla}}</strong> || HOJA: <strong>3</strong></span></h4>
        

    </div>
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
                <td class='titulo'>23:15 SALE TUCUMAN </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>23:25 PTE. L CODOBA </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>23:35 KM9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>23:45 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>23:50 CANCHA ESPINILLO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>00:00 MASTIL </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> 
            </tr>
            <tr>
                <td>00:10 SAN PATRICIO </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>00:30 C. V.B AROAZ </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>00:40 CRUCE</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>01:00 EL TRIUNFO </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>01:10 LLEGA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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
   
</div>
<div class="content">
    <div class="inline">
        <h3>HOJA DE RUTA  - {{$empresa1}} / {{$empresa2}} || Serv: {{$codigoserv}} - H2 - Linea: GAR/TUC V3-2 - Turno:M - FEC SERV: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
        <h4> CHOFER: <strong>{{$choferapellido}}, {{$chofernombre}}</strong> - Legajo: <strong>{{$choferlegajo}}</strong> || INTERNO: <strong>{{$cocheinterno}}</strong> - PATENTE: <strong>{{$cochepatente}}</strong><span class="derecha">Fecha de Emision {{now()->format('d-m-Y')}} || Usuario: {{$usuario}} || Planilla Nro: <strong>{{$nroplanilla}}</strong> || HOJA: <strong>4</strong></span></h4>
        

    </div>
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
                <td class='titulo'>05:30 SALE GARMENDIA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>05:40 EL TRIUNFO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>05:50 CRUCE</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>06:00 SAL BURRUYACU</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>06:10 CEM. VB ARAOZ</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>06:30 SAN PATRICIO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> 
            </tr>
            <tr>
                <td>06:40 SAL RAMADA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>06:45 SAL MACOMITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>06:50 CANCHA ESPINILLO</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>07:05 LAS PIEDRITAS</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>07:20 PTE. L CORDOBA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td>07:30 LLEGA TUCUMAN</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
                        <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>
   
</div>
</body>
</html>
