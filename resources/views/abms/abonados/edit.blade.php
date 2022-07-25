@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Registro de Abonado</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			
			


		{!!Form::open(array('url'=>'boltafi/abonados/guardareditarabonado','method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}

			<div class="Form-group">
				
				
				<input type="hidden" name="id" id="id"  value="{{$abonados->id}}">
				

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Dominio..." name="nombre" id="nombre"  value="{{$abonados->nombre}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" class="form-control {{$errors->has('apellido')?'is-invalid':''}}" placeholder="Apellido..." value="{{$abonados->apellido}}">
				{!! $errors->first('apellido','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control {{$errors->has('direccion')?'is-invalid':''}}" placeholder="Direccion..." value="{{$abonados->direccion}}">
				{!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="dni">DNI</label>
				<input type="text" name="dni" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="DNI..." value="{{$abonados->dni}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="nrocelular">Nro de Celular</label>
				<input type="text" name="nrocelular" class="form-control {{$errors->has('nrocelular')?'is-invalid':''}}" placeholder="Nro de Celular..." value="{{$abonados->nrocelular}}">
				{!! $errors->first('nrocelular','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="colegio_empresa">Colegio/Empresa</label>
				<input type="text" name="colegio_empresa" class="form-control {{$errors->has('colegio_empresa')?'is-invalid':''}}" placeholder="Colegio/Empresa..." value="{{$abonados->colegio_empresa}}">
				{!! $errors->first('colegio_empresa','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="desde">Desde</label>
				<input type="text" name="desde" class="form-control {{$errors->has('desde')?'is-invalid':''}}"  placeholder="Desde..." value="{{$abonados->desde}}">
				{!! $errors->first('desde','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="hasta">Hasta</label>
				<input type="text" name="hasta" class="form-control {{$errors->has('hasta')?'is-invalid':''}}"  placeholder="Hasta..." value="{{$abonados->hasta}}">
				{!! $errors->first('hasta','<div class="invalid-feedback">:message</div>')!!}
			</div>


			<div class="Form-group">
				<label for="categoria_id">Categoria</label>
				{!!Form::select('tipo_abono_id',$tiposdeabonos,$abonados->tipoabono->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				{!! $errors->first('tipo_abono_id','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="boleto"> Boleto</label>
							<select name="boleto" id="boleto" class="form-control">
										<option value="{{$abonados->boleto}}">{{$abonados->boleto}}</option>
										<option value="100">100</option>
										<option value="101">101</option>
										<option value="103">103</option>
							</select>
				{!! $errors->first('boleto','<div class="invalid-feedback">:message</div>')!!}
			</div>

			
			

			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Editar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/acoplados"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection