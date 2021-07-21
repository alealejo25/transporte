@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Registro de Cuentas Bancarias Proveedores</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			
			
			{!!Form::model($cuentasbancariasproveedores,['method'=>'PATCH','route'=>['cuentasbancariasproveedores.update',$cuentasbancariasproveedores->id]])!!}


			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="alias_cbu">Dominio</label> -->
				{{Form::label('cbu', 'Cbu')}}
				<input type="text" class="form-control {{$errors->has('cbu')?'is-invalid':''}}" placeholder="Cbu..." name="cbu" id="cbu"  value="{{$cuentasbancariasproveedores->cbu}}" disabled>
				{!! $errors->first('cbu','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<label for="alias_cbu">Alias CBU</label>
				<input type="text" name="alias_cbu" class="form-control {{$errors->has('alias_cbu')?'is-invalid':''}}" placeholder="Alias CBU..." value="{{$cuentasbancariasproveedores->alias_cbu}}">
				{!! $errors->first('alias_cbu','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="titular">Titular</label>
				<input type="text" name="titular" class="form-control {{$errors->has('titular')?'is-invalid':''}}" placeholder="Titular..." value="{{$cuentasbancariasproveedores->titular}}">
				{!! $errors->first('titular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="text" name="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{$cuentasbancariasproveedores->dni}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="identificacion_tributaria">Identificacion Tributaria</label>
				<input type="text" name="identificacion_tributaria" class="form-control {{$errors->has('identificacion_tributaria')?'is-invalid':''}}" placeholder="Identificacion Tributaria..." value="{{$cuentasbancariasproveedores->identificacion_tributaria}}">
				{!! $errors->first('identificacion_tributaria','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="tipo">Tipo</label>
				<input type="text" name="tipo" class="form-control {{$errors->has('tipo')?'is-invalid':''}}" placeholder="Tipo ..." value="{{$cuentasbancariasproveedores->tipo}}">
				{!! $errors->first('tipo','<div class="invalid-feedback">:message</div>')!!}
			</div>


			<div class="Form-group">
				<label for="proveedor_id">Proveedor</label>
				{!!Form::select('proveedor_id',$proveedores,$cuentasbancariasproveedores->proveedor->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}

				{!! $errors->first('proveedor_id','<div class="invalid-feedback">:message</div>')!!}
			</div>
			

			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Editar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/cuentasbancariasproveedores"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection