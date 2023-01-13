@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Registro de Choferes</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
			
 			{!!Form::model($choferes,['method'=>'PATCH','route'=>['guardardesactivar']])!!}
			{{Form::token()}}
			<div class="Form-group">
				
				
				<input type="hidden" name="id" id="id"  value="{{$choferes->id}}">
				

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('legajo', 'Legajo')}}
				<input type="text" class="form-control {{$errors->has('legajo')?'is-invalid':''}}" placeholder="Legajo..." name="legajo" id="legajo"  value="{{$choferes->legajo}}" disabled>
				{!! $errors->first('legajo','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{$choferes->nombre}}" disabled>
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" class="form-control {{$errors->has('apellido')?'is-invalid':''}}" placeholder="Apellido..." value="{{$choferes->apellido}}" disabled>
				{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="text" name="dni" id="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{$choferes->dni}}" disabled>
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="motivodesactivar">Motivo</label>
				<input type="text" name="motivodesactivar" id="motivodesactivar" class="form-control {{$errors->has('motivodesactivar')?'is-invalid':''}}" placeholder="Motivo ..." value="{{old('motivodesactivar')}}">
				{!! $errors->first('motivodesactivar','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="fechaactivohasta">Fecha de Nac.</label>
				<input type="date" name="fechaactivohasta" id="fechaactivohasta" class="form-control {{$errors->has('fechaactivohasta')?'is-invalid':''}}" placeholder="Fecha de activo hasta..." value="{{old('fechaactivohasta')}}">
				{!! $errors->first('fechaactivohasta','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Desactivar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/choferesleagaslnf"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection