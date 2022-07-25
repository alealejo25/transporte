@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Abonados
			@can('abonados_create')
			<a href="abonados/create"><button class="btn btn-success">Nuevo</button></a>
			@endcan
			<a href="abonados/listarPdf"><button  class="btn btn-primary">Reporte PDF</button></a>
		</h3>
	</div>
				<!-- BUSCADOR DE CLIENTE-->
			{!!Form::open(['url'=>'boltafi/abonados/','method'=>'GET','class'=>'navbar-form pull-right'])!!}
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
					<th>Nombre</th>
					<th>Apellido</th>
					<th>DNI</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Col/Empresa</th>
					<th>Turno</th>
					<th>Desde</th>
					<th>Hasta</th>
					<!--  -->
					<th>Tipo de Abono</th>
					<th>Boleto</th>
					<th>Codigo</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{ $dato->id}}</td>
					<td>{{ $dato->nombre}}</td>
					<td>{{ $dato->apellido}}</td>
					<td>{{ $dato->dni}}</td>
					<td>{{ $dato->direccion}}</td>
					<td>{{ $dato->nrocelular}}</td>
					<td>{{ $dato->colegio_empresa}}</td>
					<td>{{ $dato->turno}}</td>
					<td>{{ $dato->desde}}</td>
					<td>{{ $dato->hasta}}</td>
					<!--<td>{{ $dato->codigo}}</td>-->
					<td>{{ $dato->tipoabono->tipo}}</td>
					<td>{{ $dato->tipoabono->cantidad}}</td>
					<td>{{ $dato->boleto}}</td>
					<td>
						<form method="post" action="{{url('boltafi/abonados/'.$dato->id) }}">
							@can('abonados_edit')
							<a href="{{url('boltafi/abonados/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							@endcan
							<!--@can('abonados_destroy')
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button type="submit" onclick="return confirm('Seguro que desea Borrar?');" class="btn btn-danger">Eliminar</button>
							@endcan-->

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