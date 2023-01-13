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
 			
 			{!!Form::open(array('url'=>'abms/choferesleagaslnf/update','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}
			<div class="Form-group">
				<input type="hidden" name="id" id="id"  value="{{$choferes->id}}">
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('legajo', 'Legajo')}}
				<input type="text" class="form-control {{$errors->has('legajo')?'is-invalid':''}}" placeholder="Legajo..." name="legajo" id="legajo"  value="{{$choferes->legajo}}">
				{!! $errors->first('legajo','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{$choferes->nombre}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" class="form-control {{$errors->has('apellido')?'is-invalid':''}}" placeholder="Apellido..." value="{{$choferes->apellido}}">
				{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="text" name="dni" id="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{$choferes->dni}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="cuil">CUIL</label>
				<input type="text" name="cuil" id="cuil" class="form-control {{$errors->has('cuil')?'is-invalid':''}}" placeholder="CUIL..." value="{{$choferes->cuil}}">
				{!! $errors->first('cuil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" class="form-control {{$errors->has('direccion')?'is-invalid':''}}"  placeholder="Dirección..." value="{{$choferes->direccion}}">
				{!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="codpos">Codigo Postal</label>
				<input type="number" name="codpos" class="form-control {{$errors->has('codpos')?'is-invalid':''}}" placeholder="Ingrese el Codigo Postal..." value="{{$choferes->codpos}}">
				{!! $errors->first('codpos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="localidad_id">Localidad</label>
				{!!Form::select('localidad_id',$localidades,$choferes->localidad->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="nrocelular">Numero Celular</label>
				<input type="number" name="nrocelular" id="nrocelular" class="form-control {{$errors->has('nrocelular')?'is-invalid':''}}" placeholder="Ingrese el numero de celular..." value="{{$choferes->nrocelular}}">
				{!! $errors->first('nrocelular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nrofijo">Numero Fijo</label>
				<input type="number" name="nrofijo" id="nrofijo" class="form-control {{$errors->has('nrofijo')?'is-invalid':''}}" placeholder="Ingrese el numero fijo ..." value="{{$choferes->nrofijo}}">
				{!! $errors->first('nrofijo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				@if($choferes->sexo == 1)
				<label for="sexo"> Sexo</label>
							<select name="sexo" id="sexo" class="form-control">
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>
							</select>
				{!! $errors->first('sexo','<div class="invalid-feedback">:message</div>')!!}
				@else
				<label for="sexo"> Sexo</label>
							<select name="sexo" id="sexo" class="form-control">
										<option value="2">Femenino</option>
										<option value="1">Masculino</option>
							</select>
				{!! $errors->first('sexo','<div class="invalid-feedback">:message</div>')!!}

				@endif
			</div>
			<div class="Form-group">
				<label for="fechanac">Fecha de Nac.</label>
				<input type="date" name="fechanac" id="fechanac" class="form-control {{$errors->has('fechanac')?'is-invalid':''}}" placeholder="Fecha de Nacimiento..." value="{{$choferes->fechanac}}">
				{!! $errors->first('fechanac','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nacionalidad">Nacionalidad</label>
				<input type="text" name="nacionalidad" id="nacionalidad" class="form-control {{$errors->has('nacionalidad')?'is-invalid':''}}" placeholder="Nacionalidad..." value="{{$choferes->nacionalidad}}">
				{!! $errors->first('nacionalidad','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('email', 'Email')}}
				<input type="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" placeholder="Email..." name="email" id="email"  value="{{$choferes->email}}">
				{!! $errors->first('email','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="fechaingreso">Fecha de Ingreso</label>
				<input type="date" name="fechaingreso" id="fechaingreso" class="form-control {{$errors->has('fechaingreso')?'is-invalid':''}}" placeholder="Fecha de Ingreso..." value="{{$choferes->fechaingreso}}">
				{!! $errors->first('fechaingreso','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="obrasocial_id">Obra Social</label>
				{!!Form::select('obrasocial_id',$obrasociales,$choferes->obrasocial->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="empresa_id">Empresa</label>
				{!!Form::select('empresa_id',$empresas,$choferes->empresa->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}

			</div>

			<div class="Form-group">
				<label for="gremio_id">Gremio</label>
				{!!Form::select('gremio_id',$gremios,$choferes->gremio->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="categoriachofer_id">Categoria Chofer</label>
				{!!Form::select('categoriachofer_id',$categoriaschofer,$choferes->categoriachofer->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="tipocontratacion_id">Tipo de Contratacion</label>
				{!!Form::select('tipocontratacion_id',$tiposcontratacion,$choferes->tipocontratacion->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="grid grid-cols-1 mt-5 mx-7">
				<img id="imagenSeleccionada" style="max-height: 300px;">
			</div>
			<div>
				<img src="{{$choferes->foto}}" width="300">
				<p>{{$choferes->foto}}</p>
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
				<a href="/abms/choferes"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection