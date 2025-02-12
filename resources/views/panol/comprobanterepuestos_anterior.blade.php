@extends('layouts.admin')
@section('contenido')

<div class="container mt-5">
    <h2>Ingreso de Comprobante y Movimientos</h2>
    <form id="comprobanteForm">
        <div class="mb-3">
            <label for="nrocomprobante" class="form-label">Número de Comprobante</label>
            <input type="text" id="nrocomprobante" name="nrocomprobante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tipocomprobante_id" class="form-label">Tipo de Comprobante</label>
            <select id="tipocomprobante_id" name="tipocomprobante_id" class="form-control" required>
                <option value="">Seleccione un tipo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="turnopañol_id" class="form-label">Turno Pañol</label>
            <select id="turnopañol_id" name="turnopañol_id" class="form-control" required>
                <option value="">Seleccione un turno</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecharecepcion" class="form-label">Fecha de Recepción</label>
            <input type="date" id="fecharecepcion" name="fecharecepcion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fechacomprobante" class="form-label">Fecha del Comprobante</label>
            <input type="date" id="fechacomprobante" name="fechacomprobante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select id="proveedor_id" name="proveedor_id" class="form-control" required>
                <option value="">Seleccione un proveedor</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Movimientos</label>
            <table class="table" id="movimientosTable">
                <thead>
                <tr>
                    <th>Repuesto</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" id="addMovimiento" class="btn btn-primary">Agregar Movimiento</button>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const baseUrl = '/panol'; // Cambia esto según tu ruta base de API

        // Función para cargar datos en los select
        async function loadSelectData(url, selectId) {
            const response = await fetch(url);
            const data = await response.json();
            const select = document.getElementById(selectId);
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.nombre || item.descripcion || item.tipo; // Adapta según la estructura de datos
                select.appendChild(option);
            });
        }

        // Cargar opciones dinámicas
        loadSelectData(`${baseUrl}/cargartipocomprabante`, 'tipocomprobante_id');
        loadSelectData(`${baseUrl}/cargarturnopañol`, 'turnopañol_id');
        loadSelectData(`${baseUrl}/cargarproveedor`, 'proveedor_id');
        

        // Añadir movimiento
        document.getElementById('addMovimiento').addEventListener('click', () => {
            const tableBody = document.getElementById('movimientosTable').querySelector('tbody');
            const row = `
                <tr>
                    <td><select class="form-control" name="movimientos[][repuesto_id]" required></select></td>
                    <td><input type="number" class="form-control" name="movimientos[][cantidad]" required></td>
                    <td><input type="text" class="form-control" name="movimientos[][descripcion]"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">Eliminar</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);

            // Cargar repuestos dinámicos en el nuevo select
            const newRow = tableBody.lastElementChild;
            loadSelectData(`${baseUrl}/cargarrepuesto`, newRow.querySelector('select').id);
        });

        // Eliminar fila de movimiento
        document.getElementById('movimientosTable').addEventListener('click', (event) => {
            if (event.target.classList.contains('removeRow')) {
                event.target.closest('tr').remove();
            }
        });

        // Enviar formulario
        document.getElementById('comprobanteForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());
            data.movimientos = Array.from(document.querySelectorAll('#movimientosTable tbody tr')).map(row => {
                return {
                    repuesto_id: row.querySelector('[name="movimientos[][repuesto_id]"]').value,
                    cantidad: row.querySelector('[name="movimientos[][cantidad]"]').value,
                    descripcion: row.querySelector('[name="movimientos[][descripcion]"]').value,
                };
            });

            const response = await fetch('/comprobante-repuestos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                alert('Comprobante guardado exitosamente');
                event.target.reset();
                document.querySelector('#movimientosTable tbody').innerHTML = '';
            } else {
                alert('Error al guardar el comprobante');
            }
        });
    });
</script>
@endsection