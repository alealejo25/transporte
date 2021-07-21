@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<h3>Cuentas Corrientes Proveedores </h3>
				</div>
		
			<!-- BUSCADOR DE CLIENTE-->
			{!!Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-form pull-right'])!!}
				<div class="input-group">

					{!! Form::text('name',null,['class'=>'form-control','placelholder'=>'Buscar Cliente..','aria-describedby'=>'search'])!!}
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
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Saldo LNF</th>
					<th>Saldo Leagas</th>
					<th>Opciones</th>
				</thead>
               @foreach ($proveedores as $proveedor)
				<tr>
					<td>{{ $proveedor->id}}</td>
					<td>{{ $proveedor->nombre}}</td>
					<td>{{ $proveedor->direccion}}</td>
					<td>{{ $proveedor->telefono}}</td>
					<td align="right">$ {{number_format($proveedor->saldolnf,2,",",".")}}</td>
					<td align="right">$ {{number_format($proveedor->saldol,2,",",".")}}</td>

					<td>
					<form method="post" action="{{url('cuentascorrientes/proveedores/'.$proveedor->id) }}">
							<a href="{{url('cuentascorrientes/proveedores/'.$proveedor->id.'/nuevocomprobante')}}"><input type="button" value="Nuevo Comprobante" class="btn btn-info">	</a>
							<a href="{{url('cuentascorrientes/proveedores/'.$proveedor->id.'/listar')}}"><input type="button" value="Comprobantes LNF" class="btn btn-danger">	</a>
							<a href="{{url('cuentascorrientes/proveedores/'.$proveedor->id.'/listarleagas')}}"><input type="button" value="Comprobantes Leagas" class="btn btn-success">	</a>
							
					</form>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>

@endsection
