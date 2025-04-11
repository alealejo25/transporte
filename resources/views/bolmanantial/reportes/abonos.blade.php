@extends('layouts.admin')

@section('contenido')
<div class="container">
    <h2 class="mb-4">📅 Generar reporte de abonos</h2>
    <form method="POST" action="{{ route('bolmanantial.reportes.abonos.reporteabonos') }}" id="form-pdf">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label>Desde:</label>
                <input type="date" name="fecha_desde" class="form-control" required>
            </div>
            <div class="col">
                <label>Hasta:</label>
                <input type="date" name="fecha_hasta" class="form-control" required>
            </div>
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="agrupar_linea" id="agrupar_linea" value="1">
            <label class="form-check-label" for="agrupar_linea">
                Agrupar por línea (reporte resumido)
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Generar PDF</button>
    </form>

    <form id="form-export-excel" action="{{ route('bolmanantial.reportes.abonos.exportarexcelabonos') }}" method="GET" style="display: inline;">
        <input type="hidden" name="fecha_desde">
        <input type="hidden" name="fecha_hasta">
        <button type="submit" class="btn btn-success mt-3">📊 Exportar Excel</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formExcel = document.getElementById('form-export-excel');
    const formPDF = document.getElementById('form-pdf');
    const inputDesde = formPDF.querySelector('input[name="fecha_desde"]');
    const inputHasta = formPDF.querySelector('input[name="fecha_hasta"]');

    formExcel.addEventListener('submit', function () {
        formExcel.querySelector('input[name="fecha_desde"]').value = inputDesde.value;
        formExcel.querySelector('input[name="fecha_hasta"]').value = inputHasta.value;
    });
});
</script>
@endsection

