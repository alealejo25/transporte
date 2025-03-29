@foreach($servicesToShow as $service)
<div class="service-card">
    <div class="card {{ $service->estado == 'Pendiente' ? 'bg-warning text-dark' : ($service->estado == 'En Proceso' ? 'bg-primary text-white' : ($service->estado == 'Finalizado' ? 'bg-success text-white' : 'bg-danger text-white')) }}">
        <div class="card-body">
            <h2 class="card-title">{{ $service->coche->patente }}</h2>
            <p class="card-text">{{ $service->empleado->nombre }} {{ $service->empleado->apellido }}</p>
            <p class="card-text"><strong>Trabajo:</strong> {{ $service->observaciones }}</p>
            <p class="card-text"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($service->fecha_service)->format('d/m/Y') }}</p>
            <div class="text-center">
                <span class="badge {{ $service->estado == 'Pendiente' ? 'bg-dark' : ($service->estado == 'En Proceso' ? 'bg-light text-dark' : ($service->estado == 'Finalizado' ? 'bg-success' : 'bg-danger')) }}">
                    {{ $service->estado }}
                </span>
            </div>
        </div>
    </div>
</div>
@endforeach
