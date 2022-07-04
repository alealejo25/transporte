@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			<h3>Nuevo Registro de Tipos de Abonos</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/tiposdeabonos/store','method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('tipo', 'Tipo')}}
				<input type="text" class="form-control {{$errors->has('tipo')?'is-invalid':''}}" placeholder="Tipo..." name="tipo" id="tipo"  value="{{old('tipo')}}">
				{!! $errors->first('tipo','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="cantidad">Importe</label>
				<input type="number" name="cantidad" class="form-control {{$errors->has('cantidad')?'is-invalid':''}}" placeholder="Cantidad..." value="{{old('cantidad')}}">
				{!! $errors->first('cantidad','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="costo100">Costo 100</label>
				<input type="number" step=0.01 name="costo100" class="form-control {{$errors->has('costo100')?'is-invalid':''}}" placeholder="Costo 100..." value="{{old('costo100')}}">
				{!! $errors->first('costo100','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="costo101">Costo 101</label>
				<input type="number" step=0.01 name="costo101" class="form-control {{$errors->has('costo101')?'is-invalid':''}}" placeholder="Costo 101..." value="{{old('costo101')}}">
				{!! $errors->first('costo101','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="costo103">Costo 103</label>
				<input type="number" step=0.01 name="costo103" class="form-control {{$errors->has('costo103')?'is-invalid':''}}" placeholder="Costo 103..." value="{{old('costo103')}}">
				{!! $errors->first('costo103','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/boltafi/tiposdeabonos"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection