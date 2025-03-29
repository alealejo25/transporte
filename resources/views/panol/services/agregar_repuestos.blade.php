@extends('layouts.admin')
@section('contenido')
<div class="container">
    <h2>Agregar Repuestos al Service #{{ $service->id }}</h2>
    <form action="{{ route('services.storeRepuestos', $service->id) }}" method="POST">
        @csrf
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
        
        <button type="submit" class="btn btn-success">Guardar Repuestos</button>
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
