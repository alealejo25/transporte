<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Repuestos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Repuestos</h1>

        <!-- Campo para el número de remito -->
        <div class="mb-3">
            <label for="remito" class="form-label">Número de remito:</label>
            <input type="text" id="remito" class="form-control" placeholder="Ingrese el número de remito">
        </div>

        <!-- Combo de repuestos -->
        <div class="mb-3">
            <label for="repuestos" class="form-label">Seleccione un repuesto:</label>
            <select id="repuestos" class="form-select">
                <option value="">Cargando repuestos...</option>
            </select>
        </div>

        <!-- Tabla de movimientos -->
        <h3>Movimientos</h3>
        <table id="movimientos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Cantidad Actual</th>
                    <th>Cantidad a Agregar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas dinámicas -->
            </tbody>
        </table>
        <button id="guardar" class="btn btn-primary">Guardar Movimientos</button>
    </div>

    <!-- Modal para ingresar cantidad -->
    <div class="modal fade" id="modalCantidad" tabindex="-1" aria-labelledby="modalCantidadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCantidadLabel">Ingrese la Cantidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCantidad">
                        <div class="mb-3">
                            <label for="cantidadAgregar" class="form-label">Cantidad a Agregar:</label>
                            <input type="number" id="cantidadAgregar" class="form-control" min="1" required>
                        </div>
                        <input type="hidden" id="repuestoSeleccionadoId">
                        <input type="hidden" id="repuestoSeleccionadoNombre">
                        <input type="hidden" id="repuestoSeleccionadoCodigo">
                        <input type="hidden" id="repuestoSeleccionadoMarca">
                        <input type="hidden" id="repuestoSeleccionadoCantidad">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmarCantidad">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para cargar los repuestos desde el servidor
        function cargarRepuestos() {
            $.ajax({
                url: '/panol/cargarrepuestos', // Ruta para obtener los repuestos
                method: 'GET',
                success: function (data) {
                    let comboRepuestos = $('#repuestos');
                    comboRepuestos.empty();
                    comboRepuestos.append('<option value="">Seleccione un repuesto</option>');

                    data.forEach(function (repuesto) {
                        comboRepuestos.append(
                            `<option value="${repuesto.id}" 
                                     data-nombre="${repuesto.nombre}" 
                                     data-codigo="${repuesto.codigo}" 
                                     data-marca="${repuesto.marca}" 
                                     data-cantidad="${repuesto.cantidad}">
                                ${repuesto.nombre} (Código: ${repuesto.codigo}, Marca: ${repuesto.marca})
                            </option>`
                        );
                    });
                },
                error: function () {
                    alert('Error al cargar los repuestos');
                }
            });
        }

        // Evento para mostrar el modal al seleccionar un repuesto
        $('#repuestos').on('change', function () {
            let selectedOption = $(this).find('option:selected');

            let id = selectedOption.val();
            let nombre = selectedOption.data('nombre');
            let codigo = selectedOption.data('codigo');
            let marca = selectedOption.data('marca');
            let cantidadActual = selectedOption.data('cantidad');

            if (id) {
                $('#repuestoSeleccionadoId').val(id);
                $('#repuestoSeleccionadoNombre').val(nombre);
                $('#repuestoSeleccionadoCodigo').val(codigo);
                $('#repuestoSeleccionadoMarca').val(marca);
                $('#repuestoSeleccionadoCantidad').val(cantidadActual);

                $('#modalCantidad').modal('show');
            }
        });

        // Evento para confirmar la cantidad desde el modal
        $('#confirmarCantidad').on('click', function () {
            let id = $('#repuestoSeleccionadoId').val();
            let nombre = $('#repuestoSeleccionadoNombre').val();
            let codigo = $('#repuestoSeleccionadoCodigo').val();
            let marca = $('#repuestoSeleccionadoMarca').val();
            let cantidadActual = $('#repuestoSeleccionadoCantidad').val();
            let cantidadAgregar = $('#cantidadAgregar').val();

            if (cantidadAgregar > 0) {
                // Verifica si el repuesto ya está en la tabla
                if ($('#movimientos tbody tr[data-id="' + id + '"]').length > 0) {
                    alert('Este repuesto ya fue agregado a la tabla.');
                    $('#modalCantidad').modal('hide');
                    return;
                }

                // Agrega una fila a la tabla
                $('#movimientos tbody').append(`
                    <tr data-id="${id}">
                        <td>${nombre}</td>
                        <td>${codigo}</td>
                        <td>${marca}</td>
                        <td>${cantidadActual}</td>
                        <td>${cantidadAgregar}</td>
                        <td><button class="btn btn-danger btn-sm eliminar">Eliminar</button></td>
                    </tr>
                `);

                $('#modalCantidad').modal('hide');
            } else {
                alert('Por favor, ingrese una cantidad válida.');
            }
        });

        // Evento para eliminar una fila de la tabla
        $('#movimientos').on('click', '.eliminar', function () {
            $(this).closest('tr').remove();
        });

//para guardar los datos
         $('#guardar').on('click', function () {
        let nroRemito = $('#remito').val();
        let movimientos = [];

        // Validar que se haya ingresado el número de remito
        if (!nroRemito) {
            alert('Por favor, ingrese el número de remito.');
            return;
        }

        // Recopilar los datos de la tabla de movimientos
        $('#movimientos tbody tr').each(function () {
            let idRepuesto = $(this).data('id');
            let cantidad = $(this).find('td:eq(4)').text();

            movimientos.push({
                id_repuesto: idRepuesto,
                cantidad: cantidad
            });
        });

        // Validar que haya movimientos para guardar
        if (movimientos.length === 0) {
            alert('Por favor, agregue al menos un repuesto a los movimientos.');
            return;
        }

        // Enviar los datos al controlador mediante AJAX
        $.ajax({
            url: '/panol/guardarremito', // Ruta del controlador
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                nro_remito: nroRemito,
                movimientos: movimientos
            }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Para proteger la solicitud
            },
            success: function (response) {
                alert('Remito guardado correctamente.');
                // Limpiar los campos después de guardar
                $('#remito').val('');
                $('#movimientos tbody').empty();
            },
            error: function (xhr, status, error) {
                alert('Ocurrió un error al guardar el remito.');
                console.error(xhr.responseText);
            }
        });
    });


        // Cargar los repuestos al cargar la página
        $(document).ready(function () {
            cargarRepuestos();
        });
    </script>
</body>
</html>

