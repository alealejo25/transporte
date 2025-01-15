<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buscar Repuesto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Buscar Repuestos</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-3">
                <label for="campo" class="form-label">Buscar por</label>
                <select id="campo" class="form-select">
                    <option value="codigo">Código</option>
                    <option value="nombre">Nombre</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="query" class="form-label">Valor de búsqueda</label>
                <input type="text" id="query" class="form-control" placeholder="Ingrese valor para buscar">
            </div>
            <button id="buscar" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="mt-4" id="result"></div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#buscar').on('click', function () {
            let campo = $('#campo').val();
            let query = $('#query').val();

            if (query.trim() === '') {
                alert('Ingrese un valor para buscar.');
                return;
            }

            $.ajax({
                url: '/panol/repuestos/buscar',
                method: 'GET',
                data: { campo, query },
                success: function (data) {
                    let html = `
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Cantidad Actual</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                    data.forEach(function (repuesto) {
                        html += `
                            <tr>
                                <td>${repuesto.codigo}</td>
                                <td>${repuesto.nombre}</td>
                                <td>${repuesto.marca}</td>
                                <td>${repuesto.cantidad}</td>
                            </tr>
                        `;
                    });

                    html += `
                                </tbody>
                            </table>
                        </div>
                    `;
                    $('#result').html(html).show();
                },
                error: function (xhr) {
                    if (xhr.status === 404) {
                        $('#result').html('<div class="alert alert-warning text-center">No se encontraron repuestos.</div>').show();
                    } else {
                        $('#result').html('<div class="alert alert-danger text-center">Ocurrió un error al buscar.</div>').show();
                    }
                }
            });
        });
    });
</script>
</body>
</html>