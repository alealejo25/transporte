@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipos de Abonos
			@can('tipoabonos_create')
			<a href="tiposdeabonos/create"><button class="btn btn-success">Nuevo</button></a>
			@endcan
			<a href="tiposdeabonos/listarPdf"><button  class="btn btn-primary">Reporte PDF</button></a>
		</h3>
	</div>
				<!-- BUSCADOR DE CLIENTE-->
			{!!Form::open(['url'=>'boltafi/tiposdeabonos/','method'=>'GET','class'=>'navbar-form pull-right'])!!}
				<div class="input-group">

					{!! Form::text('name',null,['class'=>'form-control','placelholder'=>'Buscar Articulos..','aria-describedby'=>'search'])!!}
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
					<th>Tipo</th>
					<th>Cantidad</th>
					<th>Costo 100</th>
					<th>Costo 101</th>
					<th>Costo 103</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->tipo}}</td>
					<td>{{ $dato->cantidad}}</td>
					<td>{{ $dato->costo100}}</td>
					<td>{{ $dato->costo101}}</td>
					<td>{{ $dato->costo103}}</td>
					<td>
						<form method="post" action="{{url('abms/tiposdeabonos/'.$dato->id) }}">
							@can('tipoabonos_edit')
							<a href="{{url('abms/tiposdeabonos/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							@endcan
							@can('tipoabonos_destroy')
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button type="submit" onclick="return confirm('Seguro que desea Borrar?');" class="btn btn-danger">Eliminar</button>
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