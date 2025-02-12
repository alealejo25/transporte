@extends('layouts.admin')
@section('contenido')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container mt-5">
    <h2 class="mb-4">Gestión de Repuestos</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#repuestoModal">Agregar Repuesto</button>

    <table id="repuestosTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Cód.</th>
            <th>Nombre</th>
            <th>CantLNF</th>
            <th>CantLeagas</th>
            <th>CantMalebo</th>
            <th>Marca</th>
            <th>Cond.</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="repuestosTableBody">
        <!-- Contenido generado dinámicamente -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="repuestoModal" tabindex="-1" aria-labelledby="repuestoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="repuestoModalLabel">Agregar Repuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="repuestoForm">
                    <input type="hidden" id="repuestoId">
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_lnf" class="form-label">Cantidad LNF</label>
                        <input type="number" class="form-control" id="cantidad_lnf" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_leagas" class="form-label">Cantidad Leagas</label>
                        <input type="number" class="form-control" id="cantidad_leagas" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_malebo" class="form-label">Cantidad Malebo</label>
                        <input type="number" class="form-control" id="cantidad_malebo" required>
                    </div>
                    <div class="mb-3">
                        <label for="marcarepuestos_id" class="form-label">Marca</label>
                        <select class="form-control" id="marcarepuestos_id" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="condicion" class="form-label">Condición</label>
                        <select class="form-control" id="condicion" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    cargarMarcas();
    cargarRepuestos();

    $('#repuestosTable').DataTable({
        language: {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#repuestoForm').on('submit', function (e) {
        e.preventDefault();
        const data = {
            id: $('#repuestoId').val(),
            codigo: $('#codigo').val(),
            nombre: $('#nombre').val(),
            cantidad_lnf: $('#cantidad_lnf').val(),
            cantidad_leagas: $('#cantidad_leagas').val(),
            cantidad_malebo: $('#cantidad_malebo').val(),
            marca_id: $('#marcarepuestos_id').val(),
            condicion: $('#condicion').val()
        };

        $.ajax({
            url: '/abms/repuestos/store',
            type: 'POST',
            data: data,
            success: function () {
                $('#repuestoModal').modal('hide');
                cargarRepuestos();
            },
            error: function (err) {
                alert('Error al guardar el repuesto');
                console.error(err);
            }
        });
    });

    function cargarMarcas() {
        $.get('/abms/repuestos/cargarmarcas', function (data) {
            const combo = $('#marcarepuestos_id');
            combo.empty();
            data.forEach(function (marca) {
                combo.append(`<option value="${marca.id}">${marca.nombre}</option>`);
            });
        });
    }

    function cargarRepuestos() {
        $.get('/abms/repuestos/listar', function (data) {
            const tableBody = $('#repuestosTableBody');
            tableBody.empty();
            data.forEach(function (repuesto) {
                tableBody.append(`
                    <tr>
                        <td>${repuesto.codigo}</td>
                        <td>${repuesto.nombre}</td>
                        <td align='right'>${repuesto.cantidad_lnf}</td>
                        <td align='right'>${repuesto.cantidad_leagas}</td>
                        <td align='right'>${repuesto.cantidad_malebo}</td>
                        <td>${repuesto.marca.nombre}</td>
                        <td>${repuesto.condicion ? 'Activo' : 'Inactivo'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarRepuesto(${repuesto.id})">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarRepuesto(${repuesto.id})">Eliminar</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    window.editarRepuesto = function (id) {
        $.get(`/repuestos/${id}`, function (data) {
            $('#repuestoId').val(data.id);
            $('#codigo').val(data.codigo);
            $('#nombre').val(data.nombre);
            $('#cantidad_lnf').val(data.cantidad_lnf);
            $('#cantidad_leagas').val(data.cantidad_leagas);
            $('#cantidad_malebo').val(data.cantidad_malebo);
            $('#marcarepuestos_id').val(data.marcarepuestos_id);
            $('#condicion').val(data.condicion);
            $('#repuestoModal').modal('show');
        });
    };

    window.eliminarRepuesto = function (id) {
        if (confirm('¿Estás seguro de eliminar este repuesto?')) {
            $.ajax({
                url: `/repuestos/${id}`,
                type: 'DELETE',
                success: function () {
                    cargarRepuestos();
                },
                error: function (err) {
                    alert('Error al eliminar el repuesto');
                    console.error(err);
                }
            });
        }
    };
});

</script>

@endsection