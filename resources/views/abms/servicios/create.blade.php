@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Nuevo Registro de Punto</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'abms/servicios','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('numero', 'Numero de Servicio')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Numero de servicio..." name="numero" id="numero"  value="{{old('numero')}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">

				{{Form::label('descripcion', 'Descripcion del Servicio')}}
				<input type="text" class="form-control {{$errors->has('descripcion')?'is-invalid':''}}" placeholder="Descripcion del servicio. Ejemplo Tuc/Arenales" name="descripcion" id="descripcion"  value="{{old('descripcion')}}">
				{!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="tipo_dia">Selecccione Tipo de día</label>
				<select name="tipo_dia" id="tipo_dia" class="form-control">
							<option value="">Selecccione un Tipo Día</option>
							<option value="HABIL">Habil</option>
							<option value="SABADO">Sabado</option>
							<option value="FERIADO">Feriado/Domingo</option>
				</select>
			</div>

			<div class="Form-group">
				<label for="turno">Selecccione el Turno</label>
				<select name="turno" id="turno" class="form-control">
							<option value="">Selecccione el Turno</option>
							<option value="MAÑANA">Mañana</option>
							<option value="TARDE">Tarde</option>
							<option value="NOCHE">Noche</option>
				</select>
			</div>
			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('horat', 'Hora que toma el servicio')}}
				<input type="number" min="00" max="23"class="form-control {{$errors->has('horat')?'is-invalid':''}}" placeholder="Hora que toma el  servicio..." name="horat" id="horat"  value="{{old('horat')}}">
				{!! $errors->first('horat','<div class="invalid-feedback">:message</div>')!!}
				{{Form::label('minutost', 'Minutos que toma el servicio')}}
				<input type="number" min="0" max="60"class="form-control {{$errors->has('minutost')?'is-invalid':''}}" placeholder="Minuto que toma el servicio.." name="minutost" id="minutost"  value="{{old('minutost')}}">
				{!! $errors->first('minutost','<div class="invalid-feedback">:message</div>')!!}

			</div>

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('horad', 'Hora que toma el servicio')}}
				<input type="number" min="00" max="23"class="form-control {{$errors->has('horad')?'is-invalid':''}}" placeholder="Hora que deja el  servicio..." name="horad" id="horad"  value="{{old('horad')}}">
				{!! $errors->first('horad','<div class="invalid-feedback">:message</div>')!!}
				{{Form::label('minutosd', 'Minutos que toma el servicio')}}
				<input type="number" min="0" max="60"class="form-control {{$errors->has('minutosd')?'is-invalid':''}}" placeholder="Minutos que deja el servicio.." name="minutosd" id="minutosd"  value="{{old('minutosd')}}">
				{!! $errors->first('minutosd','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">

				{{Form::label('descripcion', 'Descripcion del Servicio')}}
				<input type="text" class="form-control {{$errors->has('descripcion')?'is-invalid':''}}" placeholder="Descripcion del servicio. Ejemplo Tuc/Arenales" name="descripcion" id="descripcion"  value="{{ Auth::user()->id }}">
				{!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/puntos"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection