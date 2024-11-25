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
				<h3>Venta de Abonos
				@can('acoplados_create')
				<a href="../abonados/create"><button class="btn btn-success">Nuevo Abonado</button></a>
				@endcan
				</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/idavuelta/guardarventa','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			
			<div class="col-lg-5">
				{{Form::label('cantidad', 'Cantidad de Boletos')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Cantidad..." name="numero" id="numero"  value="{{old('numero')}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group col-lg-7" >
				<label for="">Destino</label>
				<select name="destino_id" id="destino" class="form-control" required>
					<option value="">Seleccione un destino</option>
	        		@foreach ($destinos as $datos)
	            			<option value="{{$datos->id}}" >{{$datos->nombre}} - $ {{$datos->tarifa}}</option>                    
	        
					@endforeach
				</select>
			</div>



			<div class="Form-group">
				<input type="text" class="form-control"  name="user" id="user" style="visibility:hidden"  value="{{ Auth::user()->id }}">
			</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="guardar">VENDER</button>
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
            document.getElementById("numero").focus();
        };
    </script>
@endsection