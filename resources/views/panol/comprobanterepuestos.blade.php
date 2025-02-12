@extends('layouts.admin')
@section('contenido')
<div class="container mt-5">
    <h2>Ingreso de Comprobante</h2>
    <form id="comprobanteForm">
        <!-- Datos del Comprobante -->
    <div class="row g-3">
        <div class="col-md-6">
            <label for="nrocomprobante" class="form-label">Nro Comprobante</label>
            <input type="text" id="nrocomprobante" name="nrocomprobante" class="form-control" placeholder="Ingrese el Nro de Comprobante" required>
        </div>

        <div class="col-md-6">
            <label for="tipocomprobante" class="form-label">Tipo de Comprobante</label>
            <select id="tipocomprobante" name="tipocomprobante" class="form-select" required>
                <option value="">Seleccione el tipo de comprobante</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="proveedor" class="form-label">Proveedor</label>
            <select id="proveedor" name="proveedor" class="form-select" required>
                <option value="">Seleccione el proveedor</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="turnopañol" class="form-label">Turno Pañol</label>
            <select id="turnopañol" name="turnopañol" class="form-select" required>
                <option value="">Seleccione el turno</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="fecharecepcion" class="form-label">Fecha Recepción</label>
            <input type="date" id="fecharecepcion" name="fecharecepcion" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="fechacomprobante" class="form-label">Fecha Comprobante</label>
            <input type="date" id="fechacomprobante" name="fechacomprobante" class="form-control" required>
        </div>


    </div>
        <!-- Repuestos y Cantidades -->
        <h3>Agregar Repuestos</h3>
        <div id="repuestosContainer">
            <div class="row align-items-end mb-3">
                <div class="col-md-6">
                    <label for="repuesto_0" class="form-label">Repuesto</label>
                    <select id="repuesto_0" name="repuestos[0][id]" class="form-select repuesto-select" required>
                        <option value="">Seleccione un repuesto</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_0" class="form-label">Cantidad</label>
                    <input type="number" id="cantidad_0" name="repuestos[0][cantidad]" class="form-control" placeholder="Cantidad" required>
                </div>
                
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-repuesto-btn" disabled>-</button>
                </div>
            </div>
        </div>
        <button type="button" id="addRepuestoBtn" class="btn btn-success">+ Agregar Repuesto</button>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Guardar Comprobante</button>
    </form>
</div>

<script>
$(document).ready(function () {
    let repuestoIndex = 0;

    // Configurar la cabecera CSRF para todas las solicitudes AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Cargar datos dinámicos para los select
    loadDropdownData('#tipocomprobante', "{{ route('cargartipocomprabante') }}");
    loadDropdownData('#turnopañol', "{{ route('cargarturnopañol') }}");
    loadDropdownData('#proveedor', "{{ route('cargarproveedor') }}");
    loadDropdownData('.repuesto-select', "{{ route('cargarrepuesto') }}");

    // Agregar un nuevo repuesto
    $('#addRepuestoBtn').click(function () {
        repuestoIndex++;
        const newRepuesto = `
            <div class="row align-items-end mb-3" id="repuestoRow_${repuestoIndex}">
                <div class="col-md-6">
                    <label for="repuesto_${repuestoIndex}" class="form-label">Repuesto</label>
                    <select id="repuesto_${repuestoIndex}" name="repuestos[${repuestoIndex}][id]" class="form-select repuesto-select" required>
                        <option value="">Seleccione un repuesto</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_${repuestoIndex}" class="form-label">Cantidad</label>
                    <input type="number" id="cantidad_${repuestoIndex}" name="repuestos[${repuestoIndex}][cantidad]" class="form-control" placeholder="Cantidad" required>
                </div>


                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-repuesto-btn" data-row-id="repuestoRow_${repuestoIndex}">-</button>
                </div>
            </div>
        `;
        $('#repuestosContainer').append(newRepuesto);
        loadDropdownData(`#repuesto_${repuestoIndex}`, "{{ route('cargarrepuesto') }}");
    });

    // Eliminar un repuesto
    $(document).on('click', '.remove-repuesto-btn', function () {
        const rowId = $(this).data('row-id');
        $(`#${rowId}`).remove();
    });

    // Manejar el envío del formulario
    $('#comprobanteForm').submit(function (e) {
        e.preventDefault(); // Evitar el envío tradicional del formulario
        const formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: '/panol/guardarcomprobante', // Ruta para guardar el comprobante
            method: 'POST',
            data: formData,
            success: function (response) {
                alert('Comprobante guardado con éxito');
                $('#comprobanteForm')[0].reset(); // Reiniciar el formulario
                $('#repuestosContainer').html(''); // Limpiar repuestos
                repuestoIndex = 0; // Reiniciar el índice
                $('#addRepuestoBtn').trigger('click'); // Agregar el primer repuesto nuevamente
            },
            error: function (xhr) {
                alert('Ocurrió un error al guardar el comprobante.');
            }
        });
    });
});

// Función para cargar datos en dropdowns
function loadDropdownData(selector, url) {
    $.getJSON(url, function (data) {
        $(selector).each(function () {
            const currentSelect = $(this);
            currentSelect.append(
                data.map(item => `<option value="${item.id}">${item.nombre}</option>`)
            );
        });
    });
}
</script>
</body>
</html>
@endsection