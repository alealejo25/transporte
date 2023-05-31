@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Nuevo Registro de Servicio</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'bolmanantial/boletosleagas/storeservicio','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}


			<div class="form-group col-lg-6 col-md-4 col-sm-12">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('numero', 'Numero')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Numero..." name="numero" id="numero"  value="{{old('numero')}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}

			</div>

			 <div class="form-group col-lg-6 col-md-4 col-sm-12">
 					<label for="empresa">Seleccione Empresa</label>
					<select name="empresa" id="empresa" class="form-control">
					<option value="">Selecccione un Empresa</option>
						@foreach ($empresa as $empresas) 
					<option value="{{ $empresas->id }}">{{$empresas->denominacion}}</option>
						@endforeach
					</select>
 				</div>
 				<div class="form-group col-lg-6 col-md-4 col-sm-12">
 					<label for="turno">Seleccione Turno</label>
					<select name="turno" id="turno" class="form-control">
					<option value="">Selecccione un Turno</option>
						@foreach ($turno as $turnos) 
					<option value="{{ $turnos->id }}">{{$turnos->nombre}}</option>
						@endforeach
					</select>
 				</div>
 				<div class="form-group col-lg-6 col-md-4 col-sm-12">
 					<label for="linea">Seleccione Linea</label>
					<select name="linea" id="linea" class="form-control">
					<option value="">Selecccione un Linea</option>
						@foreach ($linea as $lineas) 
					<option value="{{ $lineas->id }}">{{$lineas->numero}}</option>
						@endforeach
					</select>
 				</div>	
 				 <div class="form-group col-lg-6 col-md-4 col-sm-12">
 					<label for="ramal">Seleccione Ramal</label>
					<select name="ramal" id="ramal" class="form-control">
					<option value="">Selecccione un Ramal</option>
						@foreach ($ramal as $ramales) 
					<option value="{{ $ramales->id }}">{{$ramales->nombre}}</option>
						@endforeach
					</select>
 				</div>			
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('km', 'KMs')}}
				<input type="text" class="form-control {{$errors->has('km')?'is-invalid':''}}" placeholder="Ingrese los KMs del servicio..." name="km" id="km"  value="{{old('km')}}">
				{!! $errors->first('km','<div class="invalid-feedback">:message</div>')!!}

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