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
				<h3>Asignar Boletos</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/guardarasignarboletos','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			{{Form::token()}}

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div class="Form-group col-lg-10" >
				<label for="">Chofer</label>
				<select name="chofer_id" id="chofer_id" class="form-control" required>
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
			<div class="Form-group col-lg-10" >
				<label for="">Boletos</label>
				<select name="boleto_id" id="boleto_id" class="form-control" required>
					<option value="">Seleccione un Boleto</option>
	        		@foreach ($stockboletos as $datos)
	            			<option value="{{$datos->id}}" >{{$datos->codigo}} - {{$datos->inicio}} - {{$datos->fin}}</option>                    
	        		@endforeach
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
				<a href="/finanzas/chequespropios"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 

<script>
        window.onload = function() {
            document.getElementById("codigo").focus();
        };
    </script>
@endsection
