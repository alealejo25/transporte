@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Choferes <a href="choferesleagaslnf/create"><button class="btn btn-success">Nuevo</button></a></h3>
		
	</div>
		@include('abms.choferes.search')
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Legajo</th>
					<th>Nombre</th>
					<th class="border px-4 py-2">Apellido</th>
					<th>DNI</th>
					<th>CUIL</th>
					<th>Nro Telefono</th>
					<th>Fec. Ingreso</th>
					<th>Empresa</th>
					<th>Categoria</th>
					<th>Tipo Contrato</th>
					<!--<th>Foto</th>-->
					<th>Opciones</th>
				</thead>
               @foreach ($choferes as $chofer)
				<tr>
					<td >{{ $chofer->legajo}}</td>
					<td>{{ $chofer->nombre}}</td>
					<td>{{ $chofer->apellido}}</td>
					<td>{{ $chofer->dni}}</td>
					<td>{{ $chofer->cuil}}</td>
					<td>{{ $chofer->nrocelular}}</td>
					<td>{{ date("d/m/Y",strtotime($chofer->fechaingreso))}}</td>
					<td>{{ $chofer->empresa->denominacion}}</td>
					<td>{{ $chofer->categoriachofer->nombre}}</td>
					<td>{{ $chofer->tipocontratacion->nombre}}</td>
					<!-- <td class="border px-4 py-2">
						<img src="/imagen/{{$chofer->foto}}" width="60%">
					</td> -->
					<td>
						
							<a href="{{url('abms/choferesleagaslnf/'.$chofer->id.'/edit')}}"><input type="button" value="Editar" class="btn btn-info">	</a>
							<a href="{{url('abms/choferesleagaslnf/'.$chofer->id.'/desactivar')}}"><input type="button" value="Desactivar" class="btn btn-info">	</a>


						
													
							{{csrf_field()}}
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$choferes->render()}}
	</div>
</div>

@endsection

