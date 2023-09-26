@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Servicios - LEAGAS <a href="boletosleagas/create"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true" title="Nuevo Servicio"></i></button></i></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive ">
			<table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Num Planilla</th>
					<th>Fecha</th>
					<th>Chofer</th>
					<th>Linea</th>
					<th>Interno</th>
					<th>Serv.</th>
					<th>Turno</th>
					<th>Pax</th>
					<th>Recaudacion</th>
					<th>horaT</th>
					<th>horaS</th>
					<th>HoraA</th>
					<th>Cambio</th>
					

					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->num}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
					<td style="width:230px;">{{$dato->apellido}}, {{ $dato->nombrechofer}} </td>
					<td style="width:50px;">{{ $dato->linea->numero}}</td>
					<td style="width:50px;">{{ $dato->interno}}</td>
					<td style="width:50px;">{{ $dato->numero}}</td>
					<td style="width:135px;">{{ $dato->nombre}}</td>
					<td align="right">{{ $dato->cantpasajes}}</td>
					<td style="width:105px;" align="right">$ {{number_format($dato->recaudacion,2,",",".")}}</td>
					<!--<td align="right">{{ $dato->horainicio}}</td>
					<td align="right">{{ $dato->horafin}}</td>-->
					<td align="right">{{ $dato->horastotal}}</td>
					<td align="right">{{ $dato->horassobrantes}}</td>
						<td align="right">{{ $dato->horastotalalargue}}</td>
						<td style="width:50px;">{{ $dato->motivo_cambio}}</td>
<td>
						
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/modificarservicio')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" title="Modificar Servicio"></i></button></a>
						
						<a href="{{url('bolmanantial/boletos/'.$dato->id_boleto.'/cargargasoil')}}"><button class="btn btn-success"><i class="fa fa-bus" aria-hidden="true" title="Cargar Gasoil"></i></button></a>
						@can('borrarservicio')
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/modificarservicio')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" title="Modificar Servicio"></i></button></a>
						@endcan
						<!-- <a href="{{url('bolmanantial/boletos/'.$dato->id_boleto.'/cargargasoil')}}"><button class="btn btn-success"><i class="fa fa-bus" aria-hidden="true" title="Cargar Gasoil"></i></button></a> -->
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/informeboletoleagas')}}"><button class="btn btn-danger"><i class="fa fa-print" aria-hidden="true" title="Imprimir servicio"></i></button></a>
					</td>
						
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		
						<button class="print">Imprimir Documento</button>
	</div>
	
</div>
<script>
$(".print").click(function() {
  window.print();
});
</script>
@endsection


