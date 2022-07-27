@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Planchas
		@can('acoplados_create')
		<a href="create"><button class="btn btn-success">Cargar Planchas</button></a>
		@endcan
		<a href="acoplados/listarPdf"><button  class="btn btn-primary">Reporte PDF</button></a></h3>
	</div>
				<!-- BUSCADOR DE aCOPLADO-->
			{!!Form::open(['route'=>'boltafi.planchastafi','method'=>'GET','class'=>'navbar-form pull-right'])!!}
				<div class="input-group">

					{!! Form::text('name',null,['class'=>'form-control','placelholder'=>'Buscar plancha..','aria-describedby'=>'search'])!!}
					<span class="input-group-addon"  id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
				</div>
			{!!Form::close()!!}
 			<!-- FIN DEL BUSCADOR-->	
	
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>#</th>
					<th>Fecha Rec.</th>
					<th>Desde</th>
					<th>Hasta</th>
					<th>Venta Abono</th>
					<th>Abono 50%</th>
					<th>Posnet</th>
					<th>Total Ventas</th>
					<th>Monto neto</th>
					<th>Fisico</th>
					<th>Diferencia</th>
					<th>Planchas Vend.</th>
					<th>Planchas Anuladas</th>
					<th>Observacion</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
					<td>{{date('d-m-Y', strtotime($dato->desde))}}</td>
					<td>{{date('d-m-Y', strtotime($dato->hasta))}}</td>

					<td>$ {{number_format($dato->abono,2,",",".")}}</td>
					<td>$ {{number_format($dato->abono50,2,",",".")}}</td>
					<td>$ {{number_format($dato->posnet,2,",",".")}}</td>
					<td>$ {{number_format($dato->totalingresos,2,",",".")}}</td>
					<td>$ {{number_format($dato->montoneto,2,",",".")}}</td>
					<td>$ {{number_format($dato->fisico,2,",",".")}}</td>
					<td>$ {{number_format($dato->diferencia,2,",",".")}}</td>
					<td>{{ $dato->planchasvendidas}}</td>
					<td>{{ $dato->planchasanuladas}}</td>
					<td>{{ $dato->observacion}}</td>
					<td>
						<form method="post" action="{{url('abms/abonados/'.$dato->id) }}">
							@can('boltafi')
							<a href="{{url('abms/abonados/'.$dato->id.'/edit')}}"><input type="button" value="Imprimir" class="btn btn-info">	</a>
							@endcan
							

						</form> 
						
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$datos->render()}}
	</div>

</div>

@endsection