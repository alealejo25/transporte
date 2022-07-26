@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			<h3>Carga de Planchas - Boleteria Tafi Viejo</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			<!--{!!Form::open(array('url'=>'boltafi/planchastafi/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'enviar();'))!!} -->
 			{!!Form::open(array('url'=>'boltafi/planchastafi/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}
			<div class="Form-group">
				{{Form::label('numdesde', 'Numero de Plancha de comienzo')}}
				<input type="text" class="form-control {{$errors->has('numdesde')?'is-invalid':''}}" placeholder="Numero de Plancha de comienzo..." name="numdesde" id="numdesde"  value="{{old('numdesde')}}">
				{!! $errors->first('numdesde','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				{{Form::label('numhasta', 'Numero de Plancha final')}}
				<input type="text" class="form-control {{$errors->has('numhasta')?'is-invalid':''}}" placeholder="Numero de Plancha final..." name="numhasta" id="numhasta"  value="{{old('numhasta')}}">
				{!! $errors->first('numhasta','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="color"> Color</label>
							<select name="color" id="color" class="form-control">
										<option value="">Selecccione color de plancha</option>
										<option value="AMARILLO">Amarillo</option>
										<option value="AZUL">Azul</option>
										
							</select>
				{!! $errors->first('color','<div class="invalid-feedback">:message</div>')!!}
			</div>
				<div class="Form-group">
					<input type="text" class="form-control"  name="user" id="user" style="visibility:hidden"  value="{{ Auth::user()->id }}">
				</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="btn">Guardar</button>
				
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/finanzas/chequespropios"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 

	<script>
	var statSend = false;
	function checkSubmit() {
	if (!statSend) {
		statSend = true;
		return true;
	} else {
		alert("El formulario ya se esta enviando...");
		return false;
		}
	}
	</script>
@endsection