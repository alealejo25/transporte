
<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" href="{{asset('assets/print/style.css')}}">
         
    </head>
    <body>
        <div class="ticket">
            <p class="centrado">---------------------------
            	<br>
            	<br>
            	<br>
            	<br>
            	<br>Alejandro GIanuzzi
                <br>New New York
                <br>23/08/2017 08:22 a.m.</p>
            <table>
                <thead>
                    <tr>
                        <th class="cantidad">CANT</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="precio">$$</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cantidad">1.00</td>
                        <td class="producto">CHEETOS VERDES 80 G</td>
                        <td class="precio">$8.50</td>
                    </tr>
                    <tr>
                        <td class="cantidad">2.00</td>
                        <td class="producto">KINDER DELICE</td>
                        <td class="precio">$10.00</td>
                    </tr>
                    <tr>
                        <td class="cantidad">1.00</td>
                        <td class="producto">COCA COLA 600 ML</td>
                        <td class="precio">$10.00</td>
                    </tr>
                    <tr>
                        <td class="cantidad"></td>
                        <td class="producto">TOTAL</td>
                        <td class="precio">$28.50</td>
                    </tr>
                </tbody>
            </table>
            <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
                <br>
                <br>
                <br>
                <br>

                <p>----------------------------------</p>
                <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
        </div>
    </body>

 <script>
function imprimir() {
  window.print();
}
    </script>
</html>
