@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Carrocerias <a href="carroceria/create"> 
        @can('coches_nuevo')

                 <button class="btn btn-success">Nuevo</button></a></h3>
		@endcan 
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->nombre}}</td>
					<td>
					<form method="post" action="{{url('abms/carroceria/'.$dato->id) }}">
							@can('coches_editar')
								<a href="{{url('abms/carroceria/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>        @endcan 
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