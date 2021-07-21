@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Nuevo Registro de Cuentas Bancarias Proveedores</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'abms/cuentasbancariasproveedores','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('cbu', 'CBU')}}
				<input type="text" class="form-control {{$errors->has('cbu')?'is-invalid':''}}" placeholder="CBU..." name="cbu" id="cbu"  value="{{old('cbu')}}">
				{!! $errors->first('cbu','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<label for="alias_cbu">Alias CBU</label>
				<input type="text" name="alias_cbu" class="form-control {{$errors->has('alias_cbu')?'is-invalid':''}}" placeholder="Alias CBU..." value="{{old('alias_cbu')}}">
				{!! $errors->first('alias_cbu','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="titular">Titular</label>
				<input type="text" name="titular" class="form-control {{$errors->has('titular')?'is-invalid':''}}" placeholder="Titular..." value="{{old('titular')}}">
				{!! $errors->first('titular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="text" name="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{old('dni')}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="identificacion_tributaria">Identificacion Tributaria</label>
				<input type="text" name="identificacion_tributaria" class="form-control {{$errors->has('identificacion_tributaria')?'is-invalid':''}}" placeholder="Identificacion Tributaria..." value="{{old('identificacion_tributaria')}}">
				{!! $errors->first('identificacion_tributaria','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="tipo">Tipo</label>
				<input type="text" name="tipo" class="form-control {{$errors->has('tipo')?'is-invalid':''}}" placeholder="Tipo..." value="{{old('tipo')}}">
				{!! $errors->first('tipo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="proveedor">Proveedor</label>
				{!!Form::select('proveedor_id',$proveedores,null,['class' => 'form-control','multiple','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/articulos"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection