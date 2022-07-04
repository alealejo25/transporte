@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			<h3>Anular Plancha - Boleteria Tafi Viejo</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/planchastafi/anularplancha','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}
			<div class="Form-group">
				{{Form::label('numero', 'Numero de Plancha para anular')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Numero de Plancha para anular" name="numero" id="numero"  value="{{old('numero')}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="motivo">Motivo de la Anulacion</label>
				<input type="text" name="motivo" class="form-control {{$errors->has('motivo')?'is-invalid':''}}" value="{{old('motivo')}}" placeholder="Ingrese motivo de anulacion"> 
				{!! $errors->first('motivo','<div class="invalid-feedback">:message</div>')!!}
			</div>
				<div class="Form-group">
	
				<input type="text" class="form-control"  name="user_anulacion" id="user_anulacion" style="visibility:hidden"  value="{{ Auth::user()->name }}">
				
				
			</div>
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/finanzas/chequespropios"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection