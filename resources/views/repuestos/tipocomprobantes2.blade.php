@extends('layouts.admin')
@section('contenido')
  <div class="container mt-1">
        <!-- Tabla de Ejemplo: TipoComprobantes -->
        <h3>TipoComprobantes</h3>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTipoComprobante">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tipocomprobantesTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar TipoComprobante -->
        <div class="modal fade" id="modalTipoComprobante" tabindex="-1" aria-labelledby="modalTipoComprobanteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTipoComprobanteLabel">Agregar TipoComprobante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTipoComprobante">
                            <input type="hidden" id="tipoComprobanteId">
                            <div class="mb-3">
                                <label for="tipoComprobanteNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="tipoComprobanteNombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cargar TipoComprobantes
        function loadTipoComprobantes() {
            $.get('/tipocomprobantes', function(data) {
                let rows = '';
                data.forEach(tc => {
                    rows += `<tr>
                                <td>${tc.id}</td>
                                <td>${tc.nombre}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editTipoComprobante(${tc.id}, '${tc.nombre}')">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTipoComprobante(${tc.id})">Eliminar</button>
                                </td>
                            </tr>`;
                });
                $('#tipocomprobantesTable').html(rows);
            });
        }

        // Guardar o Editar TipoComprobante
        $('#formTipoComprobante').submit(function(e) {

            e.preventDefault();
            const id = $('#tipoComprobanteId').val();
            const nombre = $('#tipoComprobanteNombre').val();
            const method = id ? 'PUT' : 'POST';
            const url = id ? `/tipocomprobantes/${id}` : '/tipocomprobantes';

            $.ajax({
                url: url,
                method: method,
                data: { nombre },
                success: function() {
                    $('#modalTipoComprobante').modal('hide');
                    loadTipoComprobantes();
                }
            });
        });

        // Editar TipoComprobante
        function editTipoComprobante(id, nombre) {
            $('#tipoComprobanteId').val(id);
            $('#tipoComprobanteNombre').val(nombre);
            $('#modalTipoComprobante').modal('show');
        }

        // Eliminar TipoComprobante
        function deleteTipoComprobante(id) {
            if (confirm('¿Estás seguro de eliminar este registro?')) {
                $.ajax({
                    url: `/tipocomprobantes/${id}`,
                    method: 'DELETE',
                    success: function() {
                        loadTipoComprobantes();
                    }
                });
            }
        }

        // Inicializar
        $(document).ready(function() {
            loadTipoComprobantes();
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        });
    </script>
@endsection
