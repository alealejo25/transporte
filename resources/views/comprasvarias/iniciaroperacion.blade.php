@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Iniciar operacion de Compras Varias</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	

 			{!!Form::open(array('url'=>'comprasvarias/ingresarcomprasvarias','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 



			{{Form::token()}}
			<div class="Form-group">
				<label for="montolnf">Dinero a entregar de la Caja LA NUEVA FOURNIER</label>
				<input type="number" step=0.01 name="montolnf" class="form-control {{$errors->has('montolnf')?'is-invalid':''}}" placeholder="Monto para realizar compras..." value="{{old('montolnf')}}">
				{!! $errors->first('montolnf','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>

			<div class="Form-group">
				<label for="montol" background-color: lightgrey>Dinero a entregar de la Caja LEAGAS</label>
				<input type="number" step=0.01 name="montol" class="form-control {{$errors->has('montol')?'is-invalid':''}}" placeholder="Monto para realizar compras..." value="{{old('montol')}}">
				{!! $errors->first('montol','<div class="invalid-feedback">:message</div>')!!}
			</div>
		<div id="Selector">
        <input type="file" name="foto" id="foto" class="SubirFoto" accept="image/*" capture="camera" />
        <label for="foto"><figure><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Envía una foto...</span></label>
    </div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Iniciar Operacion</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/movimientoscajas/iniciar"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection