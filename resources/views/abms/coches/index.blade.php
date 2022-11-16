@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Coches <a href="cocheleagaslnf/create"><button class="btn btn-success">Nuevo</button></a></h3>
		
	</div>
				{!!Form::open(['url'=>'abms/cocheleagaslnf/','method'=>'GET','class'=>'navbar-form pull-right'])!!}
				<div class="input-group">

					{!! Form::text('interno',null,['class'=>'form-control','placelholder'=>'Buscar Articulos..','aria-describedby'=>'search'])!!}
					<span class="input-group-addon"  id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
				</div>
			{!!Form::close()!!}
 			<!-- FIN DEL BUSCADOR-->

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Interno</th>
					<th>Linea</th>
					<th class="border px-4 py-2">Empresa</th>
					<th>Patente</th>
					<th>Motor</th>
					<th>Chasis</th>
					<th>VencimientoVTV</th>
					<th>KMs</th>
					<th>Carroceria</th>
					<th>Modelo</th>
					<th>Foto</th>
					<th>Opciones</th>
				</thead>
               @foreach ($coches as $dato)
				<tr>
					<td >{{$dato->interno}}</td>
					<td>{{ $dato->nroempresa}}</td>
					<td>{{ $dato->empresa->denominacion}}</td>
					<td>{{ $dato->patente}}</td>
					<td>{{ $dato->motor}}</td>
					<td>{{ $dato->chasis}}</td>
					<td>{{ date("d/m/Y",strtotime($dato->vencimientovtv))}}</td>
					<td>{{ $dato->km}}</td>
					<td>{{ $dato->carroceria->nombre}}</td>
					<td>{{ $dato->modelo->nombre}}</td>
					
					<td class="border px-4 py-2">
						<a title="Interno {{$dato->interno}}" href="{{url('abms/cocheleagaslnf/'.$dato->id.'/informecoche')}}"><img src="{{$dato->foto}}" width="100"></a>
					</td>

					
					<td>
							<a href="{{url('abms/cocheleagaslnf/'.$dato->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							<a href="{{url('abms/cocheleagaslnf/'.$dato->id.'/desactivar')}}"><input type="button" value="Desactivar" class="btn btn-info">	</a>


						
													
							{{csrf_field()}}
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$coches->render()}}
	</div>
</div>

@endsection

