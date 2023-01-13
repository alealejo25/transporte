@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Registro de Coches</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			<!-- {!!Form::model($coches,['method'=>'POST','route'=>['guardaredicioncoche','autocomplete'=>'off','enctype'=>'multipart/form-data']])!!}-->
 			 {!!Form::open(array('url'=>'abms/cocheleagaslnf/guardaredicioncoche','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}

			<div class="Form-group">
				
				
				<input type="hidden" name="id" id="id"  value="{{$coches->id}}">
				

			</div>

			<div class="Form-group">
				<label for="interno">Interno</label>
				<input type="number" name="interno" class="form-control {{$errors->has('interno')?'is-invalid':''}}" placeholder="Ingrese el Interno del Coche..." value="{{$coches->interno}}">
				{!! $errors->first('interno','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nroempresa">Numero de Linea</label>
				<input type="number" name="nroempresa" class="form-control {{$errors->has('nroempresa')?'is-invalid':''}}" placeholder="Ingrese el Numero de Linea del Coche..." value="{{$coches->nroempresa}}">
				{!! $errors->first('nroempresa','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('patente', 'Patente')}}
				<input type="text" class="form-control {{$errors->has('patente')?'is-invalid':''}}" placeholder="Ingrese la patente del Coche..." name="patente" id="patente"  value="{{$coches->patente}}">
				{!! $errors->first('patente','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="año">Año</label>
				<input type="number" name="año" id="año" class="form-control {{$errors->has('año')?'is-invalid':''}}" placeholder="Año..." value="{{$coches->año}}">
				{!! $errors->first('año','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="motor">Motor</label>
				<input type="text" name="motor" id="motor" class="form-control {{$errors->has('motor')?'is-invalid':''}}" placeholder="Motor..." value="{{$coches->motor}}">
				{!! $errors->first('motor','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="chasis">Chasis</label>
				<input type="text" name="chasis" id="chasis" class="form-control {{$errors->has('chasis')?'is-invalid':''}}" placeholder="Chasis..." value="{{$coches->chasis}}">
				{!! $errors->first('chasis','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nroasientos">Numero de Asientos</label>
				<input type="number" name="nroasientos" id="nroasientos" class="form-control {{$errors->has('nroasientos')?'is-invalid':''}}" placeholder="Numero de Asientos..." value="{{$coches->nroasientos}}">
				{!! $errors->first('nroasientos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="km">Kilometros</label>
				<input type="number" name="km" id="km" class="form-control {{$errors->has('km')?'is-invalid':''}}" placeholder="Cantidad de Kms..." value="{{$coches->km}}">
				{!! $errors->first('km','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="fecha_ingreso">Fecha de Ingreso</label>
				<input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control {{$errors->has('fecha_ingreso')?'is-invalid':''}}" placeholder="Fecha de Ingreso..." value="{{$coches->fecha_ingreso}}">
				{!! $errors->first('fecha_ingreso','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="valor">Valor</label>
				<input type="number" name="valor" id="valor" class="form-control {{$errors->has('valor')?'is-invalid':''}}" placeholder="Valor..." value="{{$coches->valor}}">
				{!! $errors->first('valor','<div class="invalid-feedback">:message</div>')!!}
			</div>
			
			<div class="Form-group">
				<label for="carroceria_id"> Carroceria </label>
				{!!Form::select('carroceria_id',$carrocerias,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="modelo_id"> Modelo </label>
				{!!Form::select('modelo_id',$modelos,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="marca_id"> Marca </label>
				{!!Form::select('marca_id',$marcas,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			
			<div class="Form-group">
				<label for="empresa_id"> Empresa </label>
				{!!Form::select('empresa_id',$empresas,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			
			<div class="grid grid-cols-1 mt-5 mx-7">
					<img id="imagenSeleccionada" style="max-height: 300px;">
			</div>
			<div>
					<img src="{{$coches->foto}}" width="300">
					<p>{{$coches->foto}}</p>
				<input type='file' name="foto" id="foto" accept="image/*" >
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/cocheleagaslnf"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection
