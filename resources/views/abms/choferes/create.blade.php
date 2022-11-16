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
 			{!!Form::open(array('url'=>'abms/choferesleagaslnf/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			@csrf

			{{Form::token()}}
			<div class="Form-group">
				<label for="legajo">Legajo</label>
				<input type="number" name="legajo" class="form-control {{$errors->has('legajo')?'is-invalid':''}}" placeholder="Ingrese el legajo del Chofer..." value="{{old('legajo')}}">
				{!! $errors->first('legajo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{old('nombre')}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" class="form-control {{$errors->has('apellido')?'is-invalid':''}}" placeholder="Apellido..." value="{{old('apellido')}}">
				{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="number" name="dni" id="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{old('dni')}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="cuil">CUIL</label>
				<input type="number" name="cuil" id="cuil" class="form-control {{$errors->has('cuil')?'is-invalid':''}}" placeholder="CUIL..." value="{{old('cuil')}}">
				{!! $errors->first('cuil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" class="form-control {{$errors->has('direccion')?'is-invalid':''}}"  placeholder="Dirección..." value="{{old('direccion')}}">
				{!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="codpos">Codigo Postal</label>
				<input type="number" name="codpos" class="form-control {{$errors->has('codpos')?'is-invalid':''}}" placeholder="Ingrese el Codigo Postal..." value="{{old('codpos')}}">
				{!! $errors->first('codpos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="localidad_id">Localidad</label>
				{!!Form::select('localidad_id',$localidades,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="nrocelular">Numero Celular</label>
				<input type="number" name="nrocelular" id="nrocelular" class="form-control {{$errors->has('nrocelular')?'is-invalid':''}}" placeholder="Ingrese el numero de celular..." value="{{old('nrocelular')}}">
				{!! $errors->first('nrocelular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nrofijo">Numero Fijo</label>
				<input type="number" name="nrofijo" id="nrofijo" class="form-control {{$errors->has('nrofijo')?'is-invalid':''}}" placeholder="Ingrese el numero fijo ..." value="{{old('nrofijo')}}">
				{!! $errors->first('nrofijo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="sexo"> Sexo</label>
							<select name="sexo" id="sexo" class="form-control">
										<option value="">Selecccione sexo del chofer</option>
										<option value="2">Femenino</option>
										<option value="1">Masculino</option>
										
							</select>
				{!! $errors->first('sexo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="estadocivil"> Estado Civil</label>
							<select name="estadocivil" id="estadocivil" class="form-control">
										<option value="">Selecccione el estado civil del chofer</option>
										<option value="CASADO">Casado</option>
										<option value="SOLTERO">Soltero</option>
										<option value="DIVORCIADO">Divorciado</option>
										<option value="SEPARADO">Separado</option>
										<option value="OTRO">Otro</option>
										
							</select>
				{!! $errors->first('estadocivil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="fechanac">Fecha de Nac.</label>
				<input type="date" name="fechanac" id="fechanac" class="form-control {{$errors->has('fechanac')?'is-invalid':''}}" placeholder="Fecha de Nacimiento..." value="{{old('fechanac')}}">
				{!! $errors->first('fechanac','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nacionalidad">Nacionalidad</label>
				<input type="text" name="nacionalidad" id="nacionalidad" class="form-control {{$errors->has('nacionalidad')?'is-invalid':''}}" placeholder="Nacionalidad..." value="{{old('nacionalidad')}}">
				{!! $errors->first('nacionalidad','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('email', 'Email')}}
				<input type="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" placeholder="Email..." name="email" id="email"  value="{{old('email')}}">
				{!! $errors->first('email','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="fechaingreso">Fecha de Ingreso</label>
				<input type="date" name="fechaingreso" id="fechaingreso" class="form-control {{$errors->has('fechaingreso')?'is-invalid':''}}" placeholder="Fecha de Ingreso..." value="{{old('fechaingreso')}}">
				{!! $errors->first('fechaingreso','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="obrasocial_id">Obra Social</label>
				{!!Form::select('obrasocial_id',$obrasociales,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="empresa_id">Empresa</label>
				{!!Form::select('empresa_id',$empresas,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="gremio_id">Gremio</label>
				{!!Form::select('gremio_id',$gremios,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="categoriachofer_id">Categoria Chofer</label>
				{!!Form::select('categoriachofer_id',$categoriaschofer,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="tipocontratacion_id">Tipo de Contratacion</label>
				{!!Form::select('tipocontratacion_id',$tiposcontratacion,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="grid grid-cols-1 mt-5 mx-7">
					<img id="imagenSeleccionada" style="max-height: 300px;">
			</div>
			<div class="grid grid-cols-1 mt-5 mx-7">
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