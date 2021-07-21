@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<h3>Listado de Comprobantes LEAGAS - Proveedor: @foreach ($proveedor as $proveedores){{$proveedores->nombre}} 				@endforeach
	</h3>
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
					<th>Tipo de Comprobante</th>
					<th>Nro Comprobante</th>
					<th>Fecha Vencimiento</th>
					<th>Debe</th>
					<th>Haber</th>
					<th>Acumulado</th>
					<th>Estado</th>

				</thead>
               @foreach ($cuentacorrienteproveedor as $cliente)
				<tr>
					<td>{{ $cliente->id}}</td>
					<td>{{ $cliente->tipocomprobante}}</td>
					<td>{{ $cliente->nrocomprobante}}</td>
					<td >{{date('d-m-Y', strtotime($cliente->fechavencimiento))}}</td>
					<td align="right">$ {{number_format($cliente->debe,2,",",".")}}</td>
					<td align="right">$ {{number_format($cliente->haber,2,",",".")}}</td>
                    <td align="right">$ {{number_format($cliente->acumulado,2,",",".")}}</td>
					<td>{{ $cliente->estado}}</td>
					
					
					<td>
				<!-- 	<form method="post" action="{{url('cuentascorrientes/clientes/'.$cliente->id) }}">
							<a href="{{url('cuentascorrientes/clientes/'.$cliente->id.'/nuevocomprobante')}}"><input type="button" value="Nuevo Comprobante" class="btn btn-info">	</a>
							<a href="{{url('cuentascorrientes/clientes/'.$cliente->id.'/listar')}}"><input type="button" value="Comprobantes" class="btn btn-success">	</a>
							
					</form> -->
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$cuentacorrienteproveedor->render()}}
	</div>
</div>

@endsection