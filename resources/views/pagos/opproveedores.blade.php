@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Generar OP para Proveedores</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 		<!--	{!!Form::open(array('url'=>'guardartransferencia','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} -->
				{!!Form::open(['route' => 'generaropproveedor','method'=>'POST'])!!}
			{{Form::token()}}


			<div class="Form-group">
				<label for="proveedor_id">Seleccione Proveedor</label>
				{!!Form::select('proveedor_id',$proveedores,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="empresa_id">Selecccione la EMPRESA para asignar la compra</label>
				{!!Form::select('empresa_id',$empresas,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Generar y Continuar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/pagos/pagoefectivo"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection