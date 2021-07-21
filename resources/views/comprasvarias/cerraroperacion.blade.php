@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>CERRAR operacion de Compras Varias</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	

 			{!!Form::open(array('url'=>'comprasvarias/ingresarcerraroperacion','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 



			{{Form::token()}}
			<div class="Form-group">
				<label for="montolnf">Dinero devuelto de Caja LA NUEVA FOURNIER</label>
				<input type="number" step=0.01 name="montolnf" class="form-control {{$errors->has('montolnf')?'is-invalid':''}}" placeholder="Monto para realizar compras..." value="{{old('montolnf')}}">
				{!! $errors->first('montolnf','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>

			<div class="Form-group">
				<label for="montol" background-color: lightgrey>Dinero devuelto de Caja LEAGAS</label>
				<input type="number" step=0.01 name="montol" class="form-control {{$errors->has('montol')?'is-invalid':''}}" placeholder="Monto para realizar compras..." value="{{old('montol')}}">
				{!! $errors->first('montol','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>
			<div class="Form-group">
				<label for="observacion">Observacion</label>
				<input type="text" name="observacion" class="form-control {{$errors->has('observacion')?'is-invalid':''}}" value="{{old('observacion')}}"> 
				{!! $errors->first('observacion','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Cerrar Operacion</button>
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