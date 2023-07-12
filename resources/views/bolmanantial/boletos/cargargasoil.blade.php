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

        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="fecha">Fecha</label>
                <input type="date" step=0.01 name="fecha" class="form-control" value="" required> 
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" id="numero" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-9 col-md-4 col-sm-12">
                    <label for="responsable">Responsable </label>
                    <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Responsable...">
                    
                </div>
        </div>
              <h3>Linea 10</h3>
            @foreach ($linea10 as $l10)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('linea10', $l10->interno)}}
                    <input type="text" class="form-control {{$errors->has($l10->id)?'is-invalid':''}}" placeholder="interno {{$l10->interno}}..." name="cantidad[][{{$l10->id}}]" id="{{$l10->id}}"  value="{{old($l10->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
            <br>
              <h3>Linea 142</h3>
            @foreach ($linea142 as $l142)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l142',$l142->interno)}}
                    <input type="text" class="form-control {{$errors->has($l142->id)?'is-invalid':''}}" placeholder="interno {{$l142->interno}}..." name="{{$l142->id}}" id="{{$l142->id}}"  value="{{old($l142->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
  
            <h3>Linea 110</h3>
  
            @foreach ($linea110 as $l110)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l110',$l110->interno)}}
                    <input type="text" class="form-control {{$errors->has($l110->id)?'is-invalid':''}}" placeholder="interno {{$l110->interno}}..." name="{{$l110->id}}" id="{{$l110->id}}"  value="{{old($l110->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach

            <h3>Linea 118</h3>
                <br>
              @foreach ($linea118 as $l118)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l118',$l118->interno)}}
                    <input type="text" class="form-control {{$errors->has($l118->id)?'is-invalid':''}}" placeholder="interno {{$l118->interno}}..." name="{{$l118->id}}" id="{{$l118->id}}"  value="{{old($l118->id)}}">
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