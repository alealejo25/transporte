@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Nuevo Registro Ramal</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'bolmanantial/boletosleagas/storeramal','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}


			<div class="form-group col-lg-6 col-md-4 col-sm-12">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('nombre', 'Nombre')}}
				<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" placeholder="Nombre..." name="nombre" id="nombre"  value="{{old('nombre')}}">
				{!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="form-group col-lg-6 col-md-4 col-sm-12">
 				<label for="linea">Seleccione Linea</label>
				<select name="linea_id" id="linea_id" class="form-control">
					<option value="">Selecccione un Linea</option>
						@foreach ($linea as $lineas) 
					<option value="{{ $lineas->id }}">{{$lineas->numero}}</option>
						@endforeach
				</select>
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