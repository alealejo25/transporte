@extends('layouts.admin')
@section('contenido')

<div class="container">
    <h2>Registrar Nuevo Service</h2>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="coche_id">Coche</label>
                <select class="form-control" id="coche_id" name="coche_id" required>
                    <option value="">Seleccione un coche</option>
                    @foreach($coches as $coche)
                        <option value="{{ $coche->id }}">{{ $coche->patente }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="empleado_id">Empleado</label>
                <select class="form-control" id="empleado_id" name="empleado_id" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->apellido }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="fecha_service">Fecha</label>
                <input type="date" class="form-control" id="fecha_service" name="fecha_service" required>
            </div>
            <div class="col-md-4">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="Pendiente">Pendiente</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="observaciones">
            </div>
        </div>
        
        <h4 class="mt-4">Repuestos</h4>
        <div class="row">
            <div class="col-md-6">
                <label for="repuesto_id">Repuesto</label>
                <select class="form-control" id="repuesto_id">
                    <option value="">Seleccione un repuesto</option>
                    @foreach($repuestos as $repuesto)
                        <option value="{{ $repuesto->id }}" data-stock="{{ $repuesto->cantidad_lnf }}">{{ $repuesto->nombre }} (Stock: {{ $repuesto->cantidad_lnf }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" min="1">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-primary" id="agregarRepuesto">Agregar</button>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Repuesto</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="repuestosTableBody">
            </tbody>
        </table>
        
        <button type="submit" class="btn btn-success">Guardar Service</button>
    </form>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('agregarRepuesto').addEventListener('click', function() {
        let repuestoSelect = document.getElementById('repuesto_id');
        let cantidad = document.getElementById('cantidad').value;
        let repuestoId = repuestoSelect.value;
        let repuestoNombre = repuestoSelect.options[repuestoSelect.selectedIndex].text;
        let stock = parseInt(repuestoSelect.options[repuestoSelect.selectedIndex].dataset.stock);
        
        if (!repuestoId || cantidad <= 0 || cantidad > stock) {
            alert('Seleccione un repuesto válido y una cantidad correcta.');
            return;
        }

        let tbody = document.getElementById('repuestosTableBody');
        let row = `<tr>
                    <td>${repuestoNombre}</td>
                    <td>${cantidad}</td>
                    <td>
                        <input type='hidden' name='repuestos[${repuestoId}][id]' value='${repuestoId}'>
                        <input type='hidden' name='repuestos[${repuestoId}][cantidad]' value='${cantidad}'>
                        <button type='button' class='btn btn-danger btn-sm' onclick='eliminarFila(this)'>Eliminar</button>
                    </td>
                   </tr>`;
        tbody.insertAdjacentHTML('beforeend', row);
    });

    window.eliminarFila = function(button) {
        button.closest('tr').remove();
    };
});
</script>


@endsection