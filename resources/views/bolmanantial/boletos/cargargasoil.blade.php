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
            

         </div>
    </div> 


 <div class="row">
            {!!Form::open(array('url'=>'bolmanantial/boletos/guardarcargagasoil','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}
            @foreach ($linea10 as $l110)
            <tr>
                <div class="form-group col-lg-2 col-md-4 col-sm-6">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('linea10', $l110->interno)}}
                    <input type="text" class="form-control {{$errors->has($l110->id)?'is-invalid':''}}" placeholder="interno {{$l110->id}}..." name="{{$l110->id}}" iid="{{$l110->id}}"  value="{{old($l110->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
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
@endsection