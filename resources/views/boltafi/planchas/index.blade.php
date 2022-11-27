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
					<th>Numero</th>
					<th>Estado</th>

					<th style="width:150px">Fecha de Carga</th>
					<th style="width:150px">Fecha de Anulacion</th>
					<th style="width:150px">Fecha de Venta</th>
					<th>Usuario Anulacion</th>
					<th>Motivo</th>
					
					
					
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->numero}}</td>
					<td>{{ $dato->estado}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fechacarga))}}</td>
					@if($dato->fechaanulacion==NULL)
					<td></td>
					@else
					<td>{{date('d-m-Y', strtotime($dato->fechaanulacion))}}</td>
					@endif

					@if($dato->fechaventa==NULL)
					<td></td>
					@else
					<td>{{date('d-m-Y', strtotime($dato->fechaventa))}}</td>
					@endif
				
					@if($dato->user_anulacion==NULL)
					<td></td>
					@else
					<td>{{ $dato->user_anulacion}}</td>
					@endif
					
					<td>{{ $dato->motivo}}</td>
					

				
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$datos->render()}}
	</div>

</div>

@endsection