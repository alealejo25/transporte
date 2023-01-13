@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Nuevo Registro de Choferes</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'abms/cocheleagaslnf/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			@csrf

			{{Form::token()}}
			<div class="Form-group">
				<label for="interno">Interno</label>
				<input type="number" name="interno" class="form-control {{$errors->has('interno')?'is-invalid':''}}" placeholder="Ingrese el Interno del Coche..." value="{{old('interno')}}">
				{!! $errors->first('interno','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nroempresa">Numero de Linea</label>
				<input type="number" name="nroempresa" class="form-control {{$errors->has('nroempresa')?'is-invalid':''}}" placeholder="Ingrese el Numero de Linea del Coche..." value="{{old('nroempresa')}}">
				{!! $errors->first('nroempresa','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('patente', 'Patente')}}
				<input type="text" class="form-control {{$errors->has('patente')?'is-invalid':''}}" placeholder="Ingrese la patente del Coche..." name="patente" id="patente"  value="{{old('patente')}}">
				{!! $errors->first('patente','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="año">Año</label>
				<input type="number" name="año" id="año" class="form-control {{$errors->has('año')?'is-invalid':''}}" placeholder="Año..." value="{{old('año')}}">
				{!! $errors->first('año','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="motor">Motor</label>
				<input type="text" name="motor" id="motor" class="form-control {{$errors->has('motor')?'is-invalid':''}}" placeholder="Motor..." value="{{old('motor')}}">
				{!! $errors->first('motor','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="chasis">Chasis</label>
				<input type="text" name="chasis" id="chasis" class="form-control {{$errors->has('chasis')?'is-invalid':''}}" placeholder="Chasis..." value="{{old('cuil')}}">
				{!! $errors->first('chasis','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nroasientos">Numero de Asientos</label>
				<input type="number" name="nroasientos" id="nroasientos" class="form-control {{$errors->has('nroasientos')?'is-invalid':''}}" placeholder="Numero de Asientos..." value="{{old('nroasientos')}}">
				{!! $errors->first('nroasientos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="km">Kilometros</label>
				<input type="number" name="km" id="km" class="form-control {{$errors->has('km')?'is-invalid':''}}" placeholder="Cantidad de Kms..." value="{{old('km')}}">
				{!! $errors->first('km','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="fecha_ingreso">Fecha de Ingreso</label>
				<input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control {{$errors->has('fecha_ingreso')?'is-invalid':''}}" placeholder="Fecha de Ingreso..." value="{{old('fecha_ingreso')}}">
				{!! $errors->first('fecha_ingreso','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="valor">Valor</label>
				<input type="number" name="valor" id="valor" class="form-control {{$errors->has('valor')?'is-invalid':''}}" placeholder="Valor..." value="{{old('valor')}}">
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
			<!-- <div class="grid grid-cols-1 mt-5 mx-7">
				<label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Foto</label>
				<div class='flex items-center justify-center w-full'>
					<label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
						<div class='flex flex-col items-center justify-center pt-7'>
							<svg class="w-10 h-10 text-purple group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="h1">
								<p class='text-sm text-gray-400 group-hover=text-purple-600 pt-1 tracking-wider'> Seleccione la Foto</p>

						</div>
						<input type='file' name="imagen" id="imagen" class="hidden" />
					</label>
				</div>
				
			</div> -->
			<div>
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
				<a href="/abms/choferesleagaslnf"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection
<script>
	$(document).ready(function(e){
		$('#imagen').change(function(){
			let reader = new FileReader();
			reader.onload = (e) =>{
				$('#imagenSeleccionada').attr('src',e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
				
		});
	});
</script>