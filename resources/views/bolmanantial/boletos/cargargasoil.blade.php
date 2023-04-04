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
            
            {!!Form::open(array('url'=>'bolmanantial/boletos/guardarcargagasoil','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}
            <div class="Form-group">
                <input type="hidden" name="id" id="id"  value="{{$servicios->id}}">
            </div>
            <div class="form-group col-lg-6 col-md-4 col-sm-12">
                    <label for="linea_id">Gasoil</label>
                    <input type="number" name="gasoil" id="gasoil" class="form-control {{$errors->has('gasoil')?'is-invalid':''}}" placeholder="Carga Gasoil..." value="{{old('gasoil')}}">
                    {!! $errors->first('gasoil','<div class="invalid-feedback">:message</div>')!!}
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