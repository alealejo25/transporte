@extends('layouts.admin')


@section('contenido')
<div class="container">
    <h2 class="mb-4">📅 Generar reporte de abonos</h2>
    <form method="POST" action="{{ route('bolmanantial.reportes.abonos.reporteabonos') }}">
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
        <button type="submit" class="btn btn-primary">📄 Generar PDF</button>
    </form>
</div>
@endsection
