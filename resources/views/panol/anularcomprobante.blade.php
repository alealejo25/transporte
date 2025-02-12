@extends('layouts.admin')
@section('contenido')

<div class="container mt-4">
    <h3>Anulación de Comprobantes</h3>
    <form id="anulacionForm">
        <div class="row g-3">
            <!-- Seleccionar Comprobante -->
            <div class="col-md-6">
                <label for="comprobante" class="form-label">Comprobante</label>
                <select id="comprobante" name="comprobanterepuesto_id" class="form-select" required>
                    <option value="" selected disabled>Seleccione el comprobante</option>
                    <!-- Opciones dinámicas cargadas desde el backend -->
                </select>
            </div>

            <!-- Detalles del Comprobante Seleccionado -->
            <div id="detalleComprobante" class="col-md-12 mt-3" style="display: none;">
                <h5>Detalles del Comprobante</h5>
                <ul id="detalleLista" class="list-group">
                    <!-- Detalles dinámicos del comprobante -->
                </ul>
            </div>

            <!-- Motivo de Anulación -->
            <div class="col-md-12">
                <label for="motivo" class="form-label">Motivo de Anulación</label>
                <textarea id="motivo" name="motivo" class="form-control" rows="3" required></textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-danger">Anular Comprobante</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        // Poblar el combo de comprobantes al cargar la página
        function cargarComprobantes() {
            $.get('/panol/obtenercomprobantes', function (data) {
                const comprobanteSelect = $('#comprobante');
                comprobanteSelect.empty();
                comprobanteSelect.append('<option value="" selected disabled>Seleccione el comprobante</option>');
                data.forEach(comprobante => {
                    comprobanteSelect.append(`<option value="${comprobante.id}">
                        Comprobante: ${comprobante.nrocomprobante} - ${comprobante.proveedor_nombre}
                    </option>`);
                });
            }).fail(function () {
                alert('Error al cargar los comprobantes.');
            });
        }

        // Mostrar detalles del comprobante seleccionado
        $('#comprobante').change(function () {
            const comprobanteId = $(this).val();
            if (comprobanteId) {
                $.get(`/panol/detallecomprobante/${comprobanteId}`, function (data) {
                    const detalleLista = $('#detalleLista');
                    detalleLista.empty();
                    data.detalles.forEach(item => {
                        detalleLista.append(`<li class="list-group-item">
                            Repuesto: ${item.nombre_repuesto} - Marca: ${item.marca} - Cantidad: ${item.cantidad}
                        </li>`);
                    });
                    $('#detalleComprobante').show();
                }).fail(function () {
                    alert('Error al obtener los detalles del comprobante.');
                });
            } else {
                $('#detalleComprobante').hide();
            }
        });

        // Cargar comprobantes al cargar la página
        cargarComprobantes();

        // Manejar el envío del formulario de anulación
        $('#anulacionForm').submit(function (e) {
            e.preventDefault();

            const data = {
                comprobanterepuesto_id: $('#comprobante').val(),
                motivo: $('#motivo').val(),
            };

            $.ajax({
                url: '/panol/anularcomprobante',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error: ' + (xhr.responseJSON.error || 'Error inesperado.'));
                },
            });
        });
    });
</script>

@endsection