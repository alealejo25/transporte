@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Servicios</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			
 			{!!Form::open(array('url'=>'bolmanantial/boletos/guardaredicionservicios','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}
			<div class="Form-group">
				<input type="hidden" name="id" id="id"  value="{{$servicios->id}}">
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('numero', 'Numero')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Numero..." name="numero" id="numero"  value="{{$servicios->numero}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="empresa_id">Empresa</label>
				{!!Form::select('empresa_id',$empresa,$servicios->empresa->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				{!! $errors->first('empresa_id','<div class="invalid-feedback">:message</div>')!!}
			</div>
						<div class="Form-group">
				<label for="turno_id">Turno</label>
				{!!Form::select('turno_id',$turno,$servicios->turno->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				{!! $errors->first('turno_id','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="linea_id">Linea</label>
				{!!Form::select('linea_id',$linea,$servicios->linea->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				{!! $errors->first('linea_id','<div class="invalid-feedback">:message</div>')!!}
			</div>

						<div class="Form-group">
				<label for="ramal_id">Ramal</label>
				{!!Form::select('ramal_id',$ramal,$servicios->ramal->id,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				{!! $errors->first('ramal_id','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('kmsemana', 'KmSemana')}}
				<input type="text" class="form-control {{$errors->has('kmsemana')?'is-invalid':''}}" placeholder="Ingrese los kms del servicio..." name="kmsemana" id="km"  value="{{$servicios->kmsemana}}">
				{!! $errors->first('kmsemana','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('kmsabado', 'KmSabado')}}
				<input type="text" class="form-control {{$errors->has('kmsabado')?'is-invalid':''}}" placeholder="Ingrese los kms del servicio..." name="kmsabado" id="km"  value="{{$servicios->kmsabado}}">
				{!! $errors->first('kmsabado','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('kmdomingo', 'KmDomingo')}}
				<input type="text" class="form-control {{$errors->has('kmdomingo')?'is-invalid':''}}" placeholder="Ingrese los kms del servicio..." name="kmdomingo" id="km"  value="{{$servicios->kmdomingo}}">
				{!! $errors->first('kmdomingo','<div class="invalid-feedback">:message</div>')!!}

			</div>
			
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/bolmanantial/boletos/servicios"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection