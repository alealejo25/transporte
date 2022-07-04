@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			<h3>Nuevo Registro de Abonados</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/abonados/store','method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{old('nombre')}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" class="form-control {{$errors->has('apellido')?'is-invalid':''}}" placeholder="Apellido..." value="{{old('apellido')}}">
				{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control {{$errors->has('direccion')?'is-invalid':''}}"  placeholder="Direccion..." value="{{old('direccion')}}">
				{!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="number" step=0 name="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{old('dni')}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nrocelular">Nro de Celular</label>
				<input type="text" name="nrocelular" class="form-control {{$errors->has('nrocelular')?'is-invalid':''}}"  placeholder="Nro de Celular..." value="{{old('nrocelular')}}">
				{!! $errors->first('nrocelular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="colegio_empresa">Colegio / Empresa</label>
				<input type="text" name="colegio_empresa" class="form-control {{$errors->has('colegio_empresa')?'is-invalid':''}}"  placeholder="Colegio / Empresa..." value="{{old('colegio_empresa')}}">
				{!! $errors->first('colegio_empresa','<div class="invalid-feedback">:message</div>')!!}
			</div>
			
			<div class="Form-group">
				<label for="turno"> Turno</label>
							<select name="turno" id="turno" class="form-control">
										<option value="">Selecccione un Turno</option>
										<option value="MAÑANA">MAÑANA</option>
										<option value="TARDE">TARDE</option>
										<option value="NOCHE">NOCHE</option>
							</select>
				{!! $errors->first('turno','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="Form-group">
				<label for="desde">Desde</label>
				<input type="text" name="desde" class="form-control {{$errors->has('desde')?'is-invalid':''}}"  placeholder="Desde..." value="{{old('desde')}}">
				{!! $errors->first('desde','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="hasta">Hasta</label>
				<input type="text" name="hasta" class="form-control {{$errors->has('hasta')?'is-invalid':''}}"  placeholder="Hasta..." value="{{old('hasta')}}">
				{!! $errors->first('hasta','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="tipo_abono_id">Tipo de Abono</label>
				{!!Form::select('tipo_abono_id',$datos,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<div class="Form-group">
				<label for="boleto"> Boleto</label>
							<select name="boleto" id="boleto" class="form-control">
										<option value="">Selecccione un Boleto</option>
										<option value="100">100</option>
										<option value="101">101</option>
										<option value="103">103</option>
							</select>
				{!! $errors->first('boleto','<div class="invalid-feedback">:message</div>')!!}
			</div>
			

			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/abonados"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection