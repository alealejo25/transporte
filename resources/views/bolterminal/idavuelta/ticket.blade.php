<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    
    
        <script src="https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.min.js"></script>

    <style>
        #ticket {
            width: 300px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .titulo {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div id="ticket">
        <div class="titulo">🧾 Ticket de Compra</div>
        <div>Producto A ............... $100</div>
        <div>Producto B ............... $150</div>
        <hr>
        <div class="total">TOTAL: $250</div>
        <div class="titulo">¡Gracias por su compra!</div>
    </div>

    <button onclick="imprimirComoHTML()">🖨️ Imprimir estilo PDF</button>

<script>
    function imprimirComoHTML() {
        const contenidoHTML = document.getElementById("ticket").outerHTML;

        if (!qz.websocket.isActive()) {
            qz.websocket.connect().then(() => imprimirTicketHTML(contenidoHTML));
        } else {
            imprimirTicketHTML(contenidoHTML);
        }
    }

    function imprimirTicketHTML(htmlContent) {
    const impresoraNombre = "EPSON L355 Series"; // tu impresora exacta

    const config = qz.configs.create(impresoraNombre, {
        copies: 1,
        colorType: 'color',
        density: 'default',
        duplex: false
    });

    // ENVIAR COMO TEXTO, NO COMO BYTES
    qz.print(config, [{ type: 'html', format: 'plain', data: htmlContent }])
    .then(() => {
        console.log("✅ Impreso correctamente como HTML plano");
        qz.websocket.disconnect();
    })
    .catch(err => {
        console.error("❌ Error al imprimir:", err);
        alert("Error: " + err.message);
    });
}
</script>

</body>
</html>