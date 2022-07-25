



@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			<h3>Nuevo Registro de Abonados</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/abonados/guardardocumentacion','method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			
			<div class="Form-group">
				<label for="documentacion">Ingrese el tipo de documentacion Presentada</label>
				<input type="text" name="documentacion" class="form-control {{$errors->has('documentacion')?'is-invalid':''}}"  placeholder="Ingrese el tipo de documentacion Presentada..." value="{{old('documentacion')}}">
				{!! $errors->first('documentacion','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="row">
                           	<div class="col-sm-12 col-md-12 col-lg-12">Seleccione Abonado
	                            <select name="abonado_id" id="dato" class="form-control">
										<option value="">Selecccione un Abonado</option>
										@foreach ($datos as $dato) 
											<option value="{{ $dato->id }}">{{$dato->apellido}}, {{$dato->nombre}} - {{$dato->dni}}</option>
										@endforeach
									</select>
                            </div>
                         </div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/abms/abonados"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection
