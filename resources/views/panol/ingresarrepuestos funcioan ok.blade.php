<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Repuestos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2>Ingreso de Repuestos</h2>

    <!-- Ingreso de remito -->
    <div class="mb-3">
        <label for="remito" class="form-label">Número de Remito</label>
        <input type="text" id="remito" class="form-control" placeholder="Ingrese número de remito">
    </div>

    <!-- Selección de repuesto y cantidad -->
    <div class="mb-3">
        <label for="repuesto" class="form-label">Repuesto</label>
        <select id="repuesto" class="form-select">
            <option value="">Cargando repuestos...</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" id="cantidad" class="form-control" min="1" placeholder="Ingrese la cantidad">
    </div>
    <button class="btn btn-primary" id="agregar">Agregar</button>

    <!-- Tabla de movimientos -->
    <h3 class="mt-4">Movimientos</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Repuesto</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="movimientos">
        <!-- Filas generadas dinámicamente -->
        </tbody>
    </table>

    <!-- Botón para guardar -->
    <button class="btn btn-success mt-3" id="guardar">Guardar</button>
</div>

<script>
    let movimientos = [];

    // Cargar los repuestos desde el backend usando AJAX
    function cargarRepuestos() {
        $.ajax({
            url: '/panol/cargarrepuestos', // Asegúrate de que esta ruta sea la correcta
            method: 'GET',
            success: function (data) {
                const repuestoSelect = $('#repuesto');
                repuestoSelect.empty();
                repuestoSelect.append('<option value="">Seleccione un repuesto</option>');

                data.forEach(repuesto => {
                    repuestoSelect.append( `<option value="${repuesto.id}" 
                             data-codigo="${repuesto.codigo}" 
                             data-marca="${repuesto.marca}" 
                             data-cantidad="${repuesto.cantidad}">
                        ${repuesto.nombre} (Cód: ${repuesto.codigo}, Marca: ${repuesto.marca} Cant. Actual: ${repuesto.cantidad})
                    </option>`);
                });
            },
            error: function () {
                alert('Error al cargar los repuestos');
            }
        });
    }

    $(document).ready(function () {
        cargarRepuestos();

        // Agregar movimiento
        $('#agregar').on('click', function () {
            const repuestoId = $('#repuesto').val();
            const repuestoNombre = $('#repuesto option:selected').text();
            const cantidad = parseInt($('#cantidad').val());

            if (!repuestoId || !cantidad || cantidad <= 0) {
                alert('Complete todos los campos correctamente');
                return;
            }

            movimientos.push({ repuestoId, repuestoNombre, cantidad });
            actualizarTabla();
        });

        // Guardar datos
        $('#guardar').on('click', function () {
            const remito = $('#remito').val();

            if (!remito || movimientos.length === 0) {
                alert('Complete el número de remito y agregue al menos un movimiento');
                return;
            }
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
            $.ajax({
                url: '/guardar-ingreso',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: 'application/json',
                data: JSON.stringify({ remito, movimientos }),
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function () {
                    alert('Error al guardar el ingreso');
                }
            });
        });
    });

    // Actualizar tabla de movimientos
    function actualizarTabla() {
        const tbody = $('#movimientos');
        tbody.empty();

        movimientos.forEach((movimiento, index) => {
            const row = `
                <tr>
                    <td>${movimiento.repuestoNombre}</td>
                    <td>${movimiento.cantidad}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="eliminarMovimiento(${index})">Eliminar</button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Eliminar movimiento
    window.eliminarMovimiento = (index) => {
        movimientos.splice(index, 1);
        actualizarTabla();
    };
</script>
</body>
</html>