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
					<th>Usuario Anulacion</th>
					<th>Motivo</th>
					<th>Abonado</th>
					
					
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->numero}}</td>
					<td>{{ $dato->estado}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fechacarga))}}</td>
					<td>{{date('d-m-Y', strtotime($dato->fechaanulacion))}}</td>
					<td>{{ $dato->user_anulacion}}</td>
					<td>{{ $dato->motivo}}</td>
					<td>{{ $dato->abonado->nombre}}</td>

					<td>
						<!-- <form method="post" action="{{url('abms/abonados/'.$dato->id) }}">
							@can('acoplados_edit')
							<a href="{{url('abms/abonados/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							@endcan
							@can('acoplados_destroy')
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button type="submit" onclick="return confirm('Seguro que desea Borrar?');" class="btn btn-danger">Eliminar</button>
							@endcan

						</form> -->
						
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$datos->render()}}
	</div>

</div>

@endsection