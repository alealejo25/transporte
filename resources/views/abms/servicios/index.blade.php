@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Servicios <a href=" servicios/create"><button class="btn btn-success">Nuevo</button></a></h3>
		
	</div>
		@include('abms.servicios.search')
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Numero</th>
					<th>Dia</th>
					<th>Turno</th>
					<th>Toma Servicio</th>
					<th>Deja Servicio</th>
					<th>Opciones</th>

				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->nombre}}</td>
					<td>{{ $dato->numero}}</td>
					<td>{{ $dato->tipo_dia}}</td>
					<td>{{ $dato->turno}}</td>
					<td>{{ $dato->toma}}</td>
					<td>{{ $dato->deja}}</td>
					<td>
						<form method="post" action="{{url('abms/servicios/'.$dato->id) }}">
							<a href="{{url('abms/servicios/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button type="submit" onclick="return confirm('Seguro que desea Borrar?');" class="btn btn-danger">Eliminar</button>
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
