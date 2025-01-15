<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Stock de Repuestos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Informe de Stock de Repuestos</h1>
    <form action="/panol/repuestos/generarinformerepuestos" method="GET" target="_blank" class="mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-3">
                    <label for="filtro" class="form-label">Filtrar por</label>
                    <select id="filtro" name="filtro" class="form-select">
                        <option value="todos">Todos</option>
                        <option value="marca">Marca</option>
                        <option value="nombre">Nombre</option>
                    </select>
                </div>
                <div id="valorFiltro" class="mb-3" style="display: none;">
                    <label for="valor" class="form-label">Ingrese el valor</label>
                    <input type="text" id="valor" name="valor" class="form-control" placeholder="Ingrese valor">
                </div>
                <button type="submit" class="btn btn-primary w-100">Generar PDF</button>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('filtro').addEventListener('change', function () {
        const filtro = this.value;
        const valorFiltro = document.getElementById('valorFiltro');
        if (filtro === 'marca' || filtro === 'nombre') {
            valorFiltro.style.display = 'block';
        } else {
            valorFiltro.style.display = 'none';
        }
    });
</script>
</body>
</html>
