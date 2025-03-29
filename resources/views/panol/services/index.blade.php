@extends('layouts.admin')
@section('contenido')
<div class="container">
    <h2>Gestión de Services</h2>
    
    <table id="tabla" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Coche</th>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->coche->patente }}</td>
                <td>{{ $service->empleado->nombre }} {{ $service->empleado->apellido }}</td>
                <td>{{ $service->fecha_service }}</td>
                <td>
                    <div class="estado-container">
                        <button class="btn btn-sm cambiarEstado {{ $service->estado == 'Pendiente' ? 'btn-warning' : 'btn-light' }}" data-id="{{ $service->id }}" data-estado="Pendiente" title="Pendiente" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                            <i class="fas fa-clock"></i>
                        </button>
                        <button class="btn btn-sm cambiarEstado {{ $service->estado == 'En Proceso' ? 'btn-primary' : 'btn-light' }}" data-id="{{ $service->id }}" data-estado="En Proceso" title="En Proceso" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                            <i class="fas fa-spinner"></i>
                        </button>
                        <button class="btn btn-sm cambiarEstado {{ $service->estado == 'Cancelado' ? 'btn-danger' : 'btn-light' }}" data-id="{{ $service->id }}" data-estado="Cancelado" title="Cancelado" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm agregarRepuestos" data-id="{{ $service->id }}" title="Agregar Repuestos" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                        <i class="fas fa-tools"></i>
                    </button>
                    <button class="btn btn-danger btn-sm eliminarRepuestos" data-id="{{ $service->id }}" title="Eliminar Repuestos" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-info btn-sm generarInforme" data-id="{{ $service->id }}" title="Generar Informe">
                        <i class="fas fa-file-alt"></i>
                    </button>
                    <button class="btn btn-success btn-sm finalizarService" data-id="{{ $service->id }}" title="Finalizar Service" {{ $service->estado == 'Finalizado' ? 'disabled' : '' }}>
                        <i class="fas fa-check-circle"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Cambiar estado del service
    $('.cambiarEstado').click(function() {
        if ($(this).attr('disabled')) return;

        let serviceId = $(this).data('id');
        let nuevoEstado = $(this).data('estado');

        $.ajax({
            url: '/services/' + serviceId + '/updateEstado/',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                estado: nuevoEstado
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            }
        });
    });

    // Agregar repuestos al service
    $('.agregarRepuestos').click(function() {
        if ($(this).attr('disabled')) return;
        let serviceId = $(this).data('id');
        window.location.href = '/services/' + serviceId + '/agregar-repuestos';
    });

    // Eliminar repuestos del service
    $('.eliminarRepuestos').click(function() {
        if ($(this).attr('disabled')) return;
        let serviceId = $(this).data('id');
        window.location.href = '/services/' + serviceId + '/eliminar-repuestos';
    });

    // Generar informe
    $('.generarInforme').click(function() {
        let serviceId = $(this).data('id');
        window.location.href = '/services/' + serviceId + '/informe';
    });
    
    // Finalizar service
    $('.finalizarService').click(function() {
        if ($(this).attr('disabled')) return;
        let serviceId = $(this).data('id');
        if (confirm('¿Está seguro de finalizar este servicio?')) {
            $.ajax({
                url: '/services/' + serviceId + '/finalizar',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                }
            });
        }
    });
});
</script>

<!-- Agregar FontAwesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


@endsection
