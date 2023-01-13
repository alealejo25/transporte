@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>ASIGNAR ROL</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'guardarpermiso','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}
			<div class="Form-group">
				<label for="permiso">PERMISO</label>
				<input type="text" name="permiso" class="form-control {{$errors->has('permiso')?'is-invalid':''}}" placeholder="Ingrese la descripcion de la mano de obra ..." value="{{old('permiso')}}">
				{!! $errors->first('permiso','<div class="invalid-feedback">:message</div>')!!}
			</div>
									
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection