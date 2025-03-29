@extends('layouts.admin')
@section('contenido')


<div class="container">
    <h2>Eliminar Repuestos del Service #{{ $service->id }}</h2>
    <form action="{{ route('services.destroyRepuestos', $service->id) }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Repuesto</th>
                        <th>Cantidad Disponible</th>
                        <th>Cantidad a Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repuestos as $repuesto)
                        <tr>
                            <td>
                                <input type="checkbox" name="repuestos[{{ $repuesto->repuesto_id }}][id]" value="{{ $repuesto->repuesto_id }}">
                            </td>
                            <td>{{ $repuesto->repuesto->nombre }}</td>
                            <td>{{ $repuesto->cantidad }}</td>
                            <td>
                                <input type="number" class="form-control" name="repuestos[{{ $repuesto->repuesto_id }}][cantidad]" min="1" max="{{ $repuesto->cantidad }}" value="1">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar Repuestos</button>
    </form>
</div>
@endsection
