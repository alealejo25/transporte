@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Servicios <a href="boletosleagas/create"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></i></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive ">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>#</th>
					<th>Fecha</th>
					<th>Chofer</th>
					<th>Servicio</th>
					<th>Turno</th>
					<th>Interno</th>
					<th>Inicio</th>
					<th>Cierre</th>
					<th>Cant. Pax</th>
					<th>Recaudacion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
					<td>{{ $dato->choferleagaslnf->nombre}}, {{$dato->choferleagaslnf->apellido}}</td>
					<td>{{ $dato->servicioleagaslnf->nombre}}</td>
					<td>{{ $dato->turno->nombre}}</td>
					<td align="right">{{ $dato->coche->interno}}</td>
					<td align="right">{{ $dato->iniciotarjeta}}</td>
					<td align="right">{{ $dato->fintarjeta}}</td>
					<td align="right">{{ $dato->cantpasajes}}</td>
					<td align="right">$ {{number_format($dato->recaudacion,2,",",".")}}</td>

					<td>
					<form method="post">
						<a href="{{url('datos/anticipos/'.$dato->id.'/finalizardato')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
						<a href="{{url('datos/anticipos/'.$dato->id.'/finalizardato')}}"><button class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i></button></a>

						
					</form>


					</td>
						
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$datos->render()}}
						<button class="print">Imprimir Documento</button>
	</div>
	
</div>
<script>
$(".print").click(function() {
  window.print();
});
</script>
@endsection


