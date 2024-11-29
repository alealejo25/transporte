@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	

			<div>
				<h3>Asignar Servicio</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/guardarasignarservicios','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			{{Form::token()}}

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div class="Form-group col-lg-7" >
				<label for="">Chofer</label>
				<select name="choferesleagaslnf_id" id="choferesleagaslnf_id" class="form-control" required>
					<option value="">Seleccione un Chofer</option>
	        		@foreach ($choferes as $datos)
	            			<option value="{{$datos->id}}" >{{$datos->nombre}}, {{$datos->apellido}}</option>                    
	        
					@endforeach
				</select>
			</div>
		</div>

	</div>
	 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div class="Form-group col-lg-7" >
				<label for="">Servicios</label>
				<select name="codservicio_id" id="codservicio_id" class="form-control" required>
					<option value="">Seleccione un Boleto</option>
	        		@foreach ($codservicio as $datos)
	            			<option value="{{$datos->id}}" >{{$datos->cod_servicio}} </option>                    
	        		@endforeach
				</select>
			</div>
		</div>

	</div>
		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div class="Form-group col-lg-7" >
				<label for="">Coche</label>
				<select name="coche_id" id="coche_id" class="form-control" required>
					<option value="">Seleccione un Interno</option>
	        		@foreach ($coche as $datos)
	            			<option value="{{$datos->id}}" >{{$datos->interno}} </option>                    
	        		@endforeach
				</select>
			</div>
		</div>

	</div>
	 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<div class="Form-group col-lg-7" >
					<label for="fechaservicio">Fecha del Servicio</label>
					<input type="date" name="fechaservicio" class="form-control" min="2023-11-01" max="2025-12-31"  required> 
					
				</div>
			</div>

		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<div class="Form-group col-lg-7" >
							<label for="dia"> Dia de la Semana</label>
							<select name="dia" id="Dia de " class="form-control">
										<option value="">Selecccione un Codigo</option>
										<option value="L/V">Lunes/Viernes</option>
										<option value="S">Sabados</option>
										<option value="D/F">Domingos/Feriados</option>
										
							</select>
						</div>
			</div>

		</div>

			<div class="Form-group">
				<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
			</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="guardar">Cargar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			<div class="Form-group">
					<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
				</div>
			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 

<script>
        window.onload = function() {
            document.getElementById("codigo").focus();
        };
    </script>
@endsection
