@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
            <h3>Cargar Gasoil</h3>

            @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif  
            
            {!!Form::open(array('url'=>'bolmanantial/boletos/guardarcambiocoche','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}
            <div class="Form-group">
                <input type="hidden" name="id" id="id"  value="{{$servicios->id}}">
            </div>
            <div class="form-group col-lg-6 col-md-4 col-sm-12">
 					<label for="coche_id_cambio">Seleccione Interno</label>
					<select name="coche_id_cambio" id="coche_id_cambio" class="form-control">
					<option value="">Selecccione Interno</option>
						@foreach ($coche as $coches) 
					<option value="{{ $coches->id }}">{{$coches->interno}}</option>
						@endforeach
					</select>
 				</div>	
 				<div class="form-group col-lg-9 col-md-4 col-sm-12">
					<label for="motivo_cambio">Motivo del cambio</label>
					<input type="text" name="motivo_cambio" id="motivo_cambio" class="form-control {{$errors->has('motivo_cambio')?'is-invalid':''}}" placeholder="Motivo del cambio..." value="{{old('motivo_cambio')}}">
					{!! $errors->first('motivo_cambio','<div class="invalid-feedback">:message</div>')!!}
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