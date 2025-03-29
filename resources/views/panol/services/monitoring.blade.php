<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoreo de Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #222;
            color: white;
            font-size: 1.2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            width: 100vw;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columnas */
            grid-template-rows: repeat(2, 1fr); /* 2 filas */
            gap: 15px;
            padding: 20px;
        }
        .service-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            min-height: 100%;
        }
        .card {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 15px;
            text-align: center;
            overflow: hidden;
            word-wrap: break-word;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-text {
            font-size: 1.3rem;
            word-wrap: break-word;
            white-space: normal;
            overflow: hidden;
        }
        .badge {
            font-size: 1.5rem;
            padding: 10px 15px;
            text-align: center;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container" id="servicesContainer">
    </div>

    <script>
    let offset = 0;
    const limit = 6;

    function fetchServices() {
        $.ajax({
            url: '{{ route('services.monitoring') }}?offset=' + offset + '&limit=' + limit,
            type: 'GET',
            cache: false,
            success: function(response) {
                if(response.trim() !== "") {
                    $('#servicesContainer').html(response);
                }
                offset += limit;
                if (offset >= 30) {
                    offset = 0;
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la carga de datos: ", error);
            }
        });
    }

    fetchServices();
    setInterval(fetchServices, 10000); // Refresca cada 2 segundos
    </script>
</body>
</html>



