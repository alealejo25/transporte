@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Servicios a Recaudar</h3>
		
	</div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id Serv</th>
					<th>Fecha Servicio</th>
					<th class="border px-4 py-2">Codigo</th>
					<th>Legajo Chofer</th>
					<th>Chofer</th>
					<th>Usuario</th>
									
					<th>Opciones</th>
				</thead>
               @foreach ($servicios as $datos)
				<tr>
					<td >{{ $datos->idserv}}</td>
					<td>{{ date("d/m/Y",strtotime($datos->fechaservicio))}}
					<td>{{ $datos->codigoservicio}}</td>
					<td>{{ $datos->choferlegajo}}</td>
					<td>{{ $datos->choferapellido}},{{ $datos->chofernombre}}</td>
					<td>{{ $datos->usuarionombre}}</td>
					
</td>


					<td>
						<a href="{{url('bolterminal/recaudar/'.$datos->idserv.'/recaudarservicio')}}"><button class="btn btn-success"><i class="fa fa-usd" aria-hidden="true"></i></button></a>
						<a href="{{url('abms/choferesleagaslnf/'.$datos->id.'/edit')}}"><button class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>
						<a href="{{url('abms/choferesleagaslnf/'.$datos->id.'/desactivar')}}"><button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
						{{csrf_field()}}
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>

	</div>
	 
</div>

@endsection
