
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLANILLA S1</title>
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
        <h3>RECAUDACION  - {{$empresa1}} / {{$empresa2}} || Serv: {{$codigoserv}} - S1 - FEC SERV: {{date('d-m-Y', strtotime($fechaserv))}}</h3>
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
                <td>Codigos</td>
                <td>N° Inicio</td>
                <td>N° Final</td>
                <td>Cant. Vend.</td>
                <td>Importe Unitario</td>
                <td>Importe Vendido</td>
                <td>Finalizado</td>
            </tr>

            @foreach ($datos as $dato)
              
                @if($dato->inicialcod6a!=0)
                 <tr>
                 	<td>Codigo 6_A </td>
                 	<td>{{$dato->inicialcod6a}}</td>
                 	<td>{{$dato->fincod6a}}</td>
                 	<td>{{$dato->fincod6a-$dato->inicialcod6a}}</td>
                 	@if(($dato->fincod6a-$dato->inicialcod6a)!=0)
                 	 <td align="right">$ {{number_format($dato->cod6a/($dato->fincod6a-$dato->inicialcod6a),2,",",".")}}</td>
                 	</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod6a,2,",",".")}}
                 	@if($dato->fincod6a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
                @endif
                @if($dato->inicialcod6b!=0)
                 <tr>
                 	<td>Codigo 6_B </td>
                 	<td>{{$dato->inicialcod6b}}</td>
                 	<td>{{$dato->fincod6b}}</td>
                 	<td>{{$dato->fincod6b-$dato->inicialcod6b}}</td>
                 	@if(($dato->fincod6b-$dato->inicialcod6b)!=0)
                 	 <td align="right">$ {{number_format($dato->cod6b/($dato->fincod6b-$dato->inicialcod6b),2,",",".")}}</td>
					</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod6b,2,",",".")}}</td>
                 	@if($dato->fincod6b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
                @endif
                @if($dato->inicialcod7a!=0)
                 <tr>
                 	<td>Codigo 7_A </td>
                 	<td>{{$dato->inicialcod7a}}</td>
                 	<td>{{$dato->fincod7a}}</td>
                 	<td>{{$dato->fincod7a-$dato->inicialcod7a}}</td>
                 	@if(($dato->fincod7a-$dato->inicialcod7a)!=0)
                 	<td>$ {{number_format($dato->cod7a/($dato->fincod7a-$dato->inicialcod7a),2,",",".")}}</td>
                 	 @else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod7a,2,",",".")}}</td>
                 	@if($dato->fincod7a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
                @endif
                @if($dato->inicialcod7b!=0)
				<tr>
                 	<td>Codigo 7_B </td>
                 	<td>{{$dato->inicialcod7b}}</td>
                 	<td>{{$dato->fincod7b}}</td>
                 	<td>{{$dato->fincod7b-$dato->inicialcod7b}}</td>
                 	@if(($dato->fincod7b-$dato->inicialcod7b)!=0)
                 	<td>$ {{number_format($dato->cod7b/($dato->fincod7b-$dato->inicialcod7b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod7b,2,",",".")}}</td>
                 	@if($dato->fincod7b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod8a!=0)
				<tr>
                 	<td>Codigo 8_A </td>
                 	<td>{{$dato->inicialcod8a}}</td>
                 	<td>{{$dato->fincod8a}}</td>
                 	<td>{{$dato->fincod8a-$dato->inicialcod8a}}</td>
                 	@if(($dato->fincod8a-$dato->inicialcod8a)!=0)
                 	<td>$ {{number_format($dato->cod8a/($dato->fincod8a-$dato->inicialcod8a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod8a,2,",",".")}}</td>
                 	@if($dato->fincod8a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod8b!=0)
				<tr>
                 	<td>Codigo 8_B </td>
                 	<td>{{$dato->inicialcod8b}}</td>
                 	<td>{{$dato->fincod8b}}</td>
                 	<td>{{$dato->fincod8b-$dato->inicialcod8b}}</td>
                 	@if(($dato->fincod8b-$dato->inicialcod8b)!=0)
                 	<td>$ {{number_format($dato->cod8b/($dato->fincod8b-$dato->inicialcod8b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod8b,2,",",".")}}</td>
                 	@if($dato->fincod8b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod10a!=0)
				<tr>
                 	<td>Codigo 10_A </td>
                 	<td>{{$dato->inicialcod10a}}</td>
                 	<td>{{$dato->fincod10a}}</td>
                 	<td>{{$dato->fincod10a-$dato->inicialcod10a}}</td>
                 	@if(($dato->fincod10a-$dato->inicialcod10a)!=0)
                 	<td>$ {{number_format($dato->cod10a/($dato->fincod10a-$dato->inicialcod10a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod10a,2,",",".")}}</td>
                 	@if($dato->fincod10a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod10b!=0)
				<tr>
                 	<td>Codigo 10_B </td>
                 	<td>{{$dato->inicialcod10b}}</td>
                 	<td>{{$dato->fincod10b}}</td>
                 	<td>{{$dato->fincod10b-$dato->inicialcod10b}}</td>
                 	@if(($dato->fincod10b-$dato->inicialcod10b)!=0)
                 	<td>$ {{number_format($dato->cod10b/($dato->fincod10b-$dato->inicialcod10b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod10b,2,",",".")}}</td>
                 	@if($dato->fincod10b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod12a!=0)
				<tr>
                 	<td>Codigo 12_A </td>
                 	<td>{{$dato->inicialcod12a}}</td>
                 	<td>{{$dato->fincod12a}}</td>
                 	<td>{{$dato->fincod12a-$dato->inicialcod12a}}</td>
                 	@if(($dato->fincod12a-$dato->inicialcod12a)!=0)
                 	<td>$ {{number_format($dato->cod12a/($dato->fincod12a-$dato->inicialcod12a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod12a,2,",",".")}}</td>
                 	@if($dato->fincod12a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod12b!=0)
				<tr>
                 	<td>Codigo 12_B </td>
                 	<td>{{$dato->inicialcod12b}}</td>
                 	<td>{{$dato->fincod12b}}</td>
                 	<td>{{$dato->fincod12b-$dato->inicialcod12b}}</td>
                 	@if(($dato->fincod12b-$dato->inicialcod12b)!=0)
                 	<td>$ {{number_format($dato->cod12b/($dato->fincod12b-$dato->inicialcod12b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod12b,2,",",".")}}</td>
                 	@if($dato->fincod12b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod14a!=0)
				<tr>
                 	<td>Codigo 14_A </td>
                 	<td>{{$dato->inicialcod14a}}</td>
                 	<td>{{$dato->fincod14a}}</td>
                 	<td>{{$dato->fincod14a-$dato->inicialcod14a}}</td>
                 	@if(($dato->fincod14a-$dato->inicialcod14a)!=0)
                 	<td>$ {{number_format($dato->cod14a/($dato->fincod14a-$dato->inicialcod14a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod14a,2,",",".")}}</td>
                 	@if($dato->fincod14a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod14b!=0)
				<tr>
                 	<td>Codigo 14_B </td>
                 	<td>{{$dato->inicialcod14b}}</td>
                 	<td>{{$dato->fincod14b}}</td>
                 	<td>{{$dato->fincod14b-$dato->inicialcod14b}}</td>
                 	@if(($dato->fincod14b-$dato->inicialcod14b)!=0)
                 	<td>$ {{number_format($dato->cod14b/($dato->fincod14b-$dato->inicialcod14b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod14b,2,",",".")}}</td>
                 	@if($dato->fincod14b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod15a!=0)
				<tr>
                 	<td>Codigo 15_A </td>
                 	<td>{{$dato->inicialcod15a}}</td>
                 	<td>{{$dato->fincod15a}}</td>
                 	<td>{{$dato->fincod15a-$dato->inicialcod15a}}</td>
                 	@if(($dato->fincod15a-$dato->inicialcod15a)!=0)
                 	<td>$ {{number_format($dato->cod15a/($dato->fincod15a-$dato->inicialcod15a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod15a,2,",",".")}}</td>
                 	@if($dato->fincod15a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod15b!=0)
				<tr>
                 	<td>Codigo 15_B </td>
                 	<td>{{$dato->inicialcod15b}}</td>
                 	<td>{{$dato->fincod15b}}</td>
                 	<td>{{$dato->fincod15b-$dato->inicialcod15b}}</td>
                 	@if(($dato->fincod15b-$dato->inicialcod15b)!=0)
                 	<td>$ {{number_format($dato->cod15b/($dato->fincod15b-$dato->inicialcod15b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod15b,2,",",".")}}</td>
                 	@if($dato->fincod15b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod18a!=0)
				<tr>
                 	<td>Codigo 18_A </td>
                 	<td>{{$dato->inicialcod18a}}</td>
                 	<td>{{$dato->fincod18a}}</td>
                 	<td>{{$dato->fincod18a-$dato->inicialcod18a}}</td>
                 	@if(($dato->fincod18a-$dato->inicialcod18a)!=0)
                 	<td>$ {{number_format($dato->cod18a/($dato->fincod18a-$dato->inicialcod18a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod18a,2,",",".")}}</td>
                 	@if($dato->fincod18a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod18b!=0)
				<tr>
                 	<td>Codigo 18_B </td>
                 	<td>{{$dato->inicialcod18b}}</td>
                 	<td>{{$dato->fincod18b}}</td>
                 	<td>{{$dato->fincod18b-$dato->inicialcod18b}}</td>
                 	@if(($dato->fincod18b-$dato->inicialcod18b)!=0)
                 	<td>$ {{number_format($dato->cod18b/($dato->fincod18b-$dato->inicialcod18b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod18b,2,",",".")}}</td>
                 	@if($dato->fincod18b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod21a!=0)
				<tr>
                 	<td>Codigo 21_A </td>
                 	<td>{{$dato->inicialcod21a}}</td>
                 	<td>{{$dato->fincod21a}}</td>
                 	<td>{{$dato->fincod21a-$dato->inicialcod21a}}</td>
                 	@if(($dato->fincod21a-$dato->inicialcod21a)!=0)
                 	<td>$ {{number_format($dato->cod21a/($dato->fincod21a-$dato->inicialcod21a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod21a,2,",",".")}}</td>
                 	@if($dato->fincod21a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod21b!=0)
				<tr>
                 	<td>Codigo 21_B </td>
                 	<td>{{$dato->inicialcod21b}}</td>
                 	<td>{{$dato->fincod21b}}</td>
                 	<td>{{$dato->fincod21b-$dato->inicialcod21b}}</td>
                 	@if(($dato->fincod21b-$dato->inicialcod21b)!=0)
                 	<td>$ {{number_format($dato->cod21b/($dato->fincod21b-$dato->inicialcod21b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod21b,2,",",".")}}</td>
                 	@if($dato->fincod21b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod23a!=0)
				<tr>
                 	<td>Codigo 23_A </td>
                 	<td>{{$dato->inicialcod23a}}</td>
                 	<td>{{$dato->fincod23a}}</td>
                 	<td>{{$dato->fincod23a-$dato->inicialcod23a}}</td>
                 	@if(($dato->fincod23a-$dato->inicialcod23a)!=0)
                 	<td>$ {{number_format($dato->cod23a/($dato->fincod23a-$dato->inicialcod23a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod23a,2,",",".")}}</td>
                 	@if($dato->fincod23a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod27a!=0)
				<tr>
                 	<td>Codigo 27_A </td>
                 	<td>{{$dato->inicialcod27a}}</td>
                 	<td>{{$dato->fincod27a}}</td>
                 	<td>{{$dato->fincod27a-$dato->inicialcod27a}}</td>
                 	@if(($dato->fincod27a-$dato->inicialcod27a)!=0)
                 	<td>$ {{number_format($dato->cod27a/($dato->fincod27a-$dato->inicialcod27a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod27a,2,",",".")}}</td>
                 	@if($dato->fincod27a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod27b!=0)
				<tr>
                 	<td>Codigo 27_B </td>
                 	<td>{{$dato->inicialcod27b}}</td>
                 	<td>{{$dato->fincod27b}}</td>
                 	<td>{{$dato->fincod27b-$dato->inicialcod27b}}</td>
                 	@if(($dato->fincod27b-$dato->inicialcod27b)!=0)
                 	<td>$ {{number_format($dato->cod27b/($dato->fincod27b-$dato->inicialcod27b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod27b,2,",",".")}}</td>
                 	@if($dato->fincod27b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod30a!=0)
				<tr>
                 	<td>Codigo 30_A </td>
                 	<td>{{$dato->inicialcod30a}}</td>
                 	<td>{{$dato->fincod30a}}</td>
                 	<td>{{$dato->fincod30a-$dato->inicialcod30a}}</td>
                 	@if(($dato->fincod30a-$dato->inicialcod30a)!=0)
                 	<td>$ {{number_format($dato->cod30a/($dato->fincod30a-$dato->inicialcod30a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod30a,2,",",".")}}</td>
                 	@if($dato->fincod30a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod30b!=0)
				<tr>
                 	<td>Codigo 30_B </td>
                 	<td>{{$dato->inicialcod30b}}</td>
                 	<td>{{$dato->fincod30b}}</td>
                 	<td>{{$dato->fincod30b-$dato->inicialcod30b}}</td>
                 	@if(($dato->fincod30b-$dato->inicialcod30b)!=0)
                 	<td>$ {{number_format($dato->cod30b/($dato->fincod30b-$dato->inicialcod30b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod30b,2,",",".")}}</td>
                 	@if($dato->fincod30b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod32a!=0)
				<tr>
                 	<td>Codigo 32_A </td>
                 	<td>{{$dato->inicialcod32a}}</td>
                 	<td>{{$dato->fincod32a}}</td>
                 	<td>{{$dato->fincod32a-$dato->inicialcod32a}}</td>
                 	@if(($dato->fincod32a-$dato->inicialcod32a)!=0)
                 	<td>$ {{number_format($dato->cod32a/($dato->fincod32a-$dato->inicialcod32a),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod32a,2,",",".")}}</td>
                 	@if($dato->fincod32a%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialcod32b!=0)
				<tr>
                 	<td>Codigo 32_B </td>
                 	<td>{{$dato->inicialcod32b}}</td>
                 	<td>{{$dato->fincod32b}}</td>
                 	<td>{{$dato->fincod32b-$dato->inicialcod32b}}</td>
                 	@if(($dato->fincod32b-$dato->inicialcod32b)!=0)
						<td>$ {{number_format($dato->cod32b/($dato->fincod32b-$dato->inicialcod32b),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->cod32b,2,",",".")}}</td>
                 	@if($dato->fincod32b%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialabonoa!=0)
				<tr>
                 	<td>Codigo ABONO_A </td>
                 	<td>{{$dato->inicialabonoa}}</td>
                 	<td>{{$dato->finabonoa}}</td>
                 	<td>{{$dato->finabonoa-$dato->inicialabonoa}}</td>
                 	@if(($dato->finabonoa-$dato->inicialabonoa)!=0)
                 	<td>$ {{number_format($dato->abonosa/($dato->finabonoa-$dato->inicialabonoa),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->abonoa,2,",",".")}}</td>
                 	@if($dato->finabonoa%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
				@endif
                @if($dato->inicialabonob!=0)
				<tr>
                 	<td>Codigo ABONO_B </td>
                 	<td>{{$dato->inicialabonob}}</td>
                 	<td>{{$dato->finabonob}}</td>
                 	<td>{{$dato->finabonob-$dato->inicialabonob}}</td>
                 	@if(($dato->finabonob-$dato->inicialabonob)!=0)
                 	<td>$ {{number_format($dato->abonosb/($dato->finabonob-$dato->inicialabonob),2,",",".")}}</td>
                 	@else
                 		<td></td>
                 	@endif
                 	<td align="right">$ {{number_format($dato->abonob,2,",",".")}}</td>
                 	@if($dato->finabonob%500===0)
                 	<td>SI</td>
                 	@else
                 	<td>NO</td>
                 	@endif
                 </tr>
                 @endif
                 <tr>
                 	<td> </td>
                 	<td> </td>
                 	<td>Total Boletos</td>
                 	<td>{{$dato->fincod6a-$dato->inicialcod6a+$dato->fincod6b-$dato->inicialcod6b+$dato->fincod7a-$dato->inicialcod7a+$dato->fincod7b-$dato->inicialcod7b+$dato->fincod8a-$dato->inicialcod8a+$dato->fincod8b-$dato->inicialcod8b+$dato->fincod10a-$dato->inicialcod10a+$dato->fincod10b-$dato->inicialcod10b+$dato->fincod12a-$dato->inicialcod12a+$dato->fincod12b-$dato->inicialcod12b+$dato->fincod14a-$dato->inicialcod14a+$dato->fincod14b-$dato->inicialcod14b+$dato->fincod15a-$dato->inicialcod15a+$dato->fincod15b-$dato->inicialcod15b+$dato->fincod18a-$dato->inicialcod18a+$dato->fincod18b-$dato->inicialcod18b+$dato->fincod21a-$dato->inicialcod21a+$dato->fincod21b-$dato->inicialcod21b+$dato->fincod23a-$dato->inicialcod23a+$dato->fincod23b-$dato->inicialcod23b+$dato->fincod27a-$dato->inicialcod27a+$dato->fincod27b-$dato->inicialcod27b+$dato->fincod30a-$dato->inicialcod30a+$dato->fincod30b-$dato->inicialcod30b+$dato->fincod32a-$dato->inicialcod32a+$dato->fincod32b-$dato->inicialcod32b+$dato->finabonoa-$dato->inicialabonoa+$dato->finabonob-$dato->inicialabonob}}</td>
                 	<td>TOTAL RECAUDADO</td>
                 	<td>$ {{number_format($dato->cod6a+$dato->cod6b+$dato->cod7a+$dato->cod7b+$dato->cod8a+$dato->cod8b+$dato->cod10a+$dato->cod10b+$dato->cod12a+$dato->cod12b+$dato->cod14a+$dato->cod14b+$dato->cod15a+$dato->cod15b+$dato->cod18a+$dato->cod18b+$dato->cod21a+$dato->cod21b+$dato->cod23a+$dato->cod23b+$dato->cod27a+$dato->cod27b+$dato->cod30a+$dato->cod30b+$dato->cod32a+$dato->cod32b+$dato->abonoa+$dato->abonob,2,",",".")}}</td>
                 	<td></td>
                 	
                 </tr>

			 </tr>    
             @endforeach 


        </tbody>
    </table>


 </div>





   



</body>
</html>