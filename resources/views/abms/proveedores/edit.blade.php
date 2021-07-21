@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Registro de Proveedor</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::model($proveedores,['method'=>'PATCH','route'=>['proveedores.update',$proveedores->id]])!!}
			{{Form::token()}}
			
			
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{$proveedores->nombre}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('direccion', 'Direccion')}}
				<input type="text" class="form-control {{$errors->has('direccion')?'is-invalid':''}}" placeholder="Direccion..." name="direccion" id="direccion"  value="{{$proveedores->direccion}}">
				{!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('telefono', 'Telefono')}}
				<input type="text" class="form-control {{$errors->has('telefono')?'is-invalid':''}}" placeholder="Telefono..." name="telefono" id="telefono"  value="{{$proveedores->telefono}}">
				{!! $errors->first('telefono','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('email1', 'Email')}}
				<input type="email1" class="form-control {{$errors->has('email1')?'is-invalid':''}}" placeholder="Email..." name="email1" id="email1"  value="{{$proveedores->email1}}">
				{!! $errors->first('email1','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('contacto', 'Contacto')}}
				<input type="text" class="form-control {{$errors->has('contacto')?'is-invalid':''}}" placeholder="Contacto..." name="contacto" id="contacto"  value="{{$proveedores->contacto}}">
				{!! $errors->first('contacto','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('telefono_contacto', 'Telefono de Contacto')}}
				<input type="text" class="form-control {{$errors->has('telefono_contacto')?'is-invalid':''}}" placeholder="Telefono de Contacto..." name="telefono_contacto" id="telefono_contacto"  value="{{$proveedores->telefono_contacto}}">
				{!! $errors->first('telefono_contacto','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('cuit', 'Cuit')}}
				<input type="text" class="form-control {{$errors->has('cuit')?'is-invalid':''}}" placeholder="Cuit..." name="cuit" id="cuit"  value="{{$proveedores->cuit}}">
				{!! $errors->first('cuit','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('saldolnf', 'Saldo La Nueva Fournier')}}
				<input type="text" class="form-control {{$errors->has('saldolnf')?'is-invalid':''}}" placeholder="Saldo ..." name="saldolnf" id="saldolnf"  value="{{$proveedores->saldolnf}}">
				{!! $errors->first('saldolnf','<div class="invalid-feedback">:message</div>')!!}
				
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('saldol', 'Saldo Leagas')}}
				<input type="text" class="form-control {{$errors->has('saldol')?'is-invalid':''}}" placeholder="Saldo ..." name="saldol" id="saldol"  value="{{$proveedores->saldol}}">
				{!! $errors->first('saldol','<div class="invalid-feedback">:message</div>')!!}
				
			</div>
			

			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Editar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/proveedores"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection