
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Table</title>
 <style>
        table {
            border-collapse: collapse;

        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 1px;
            height: 25px; /* Alto fijo */
            width: 72px;
            font-size: 11px; /* Tamaño base */
        }
        th {
            background-color: #f2f2f2;
        }
        .titulo {
            width: 150px;
        }
    </style>
</head>
<body>
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
        </tbody>
    </table>

<br>
<br>
<br>
<br>





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