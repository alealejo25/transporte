@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
            <h3>Cargar Gasoil La Nueva Fournier</h3>

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
            {!!Form::open(array('url'=>'bolmanantial/boletos/guardarcargagasoillnf','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}

        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="" required> 
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" id="numero" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-9 col-md-4 col-sm-12">
                    <label for="responsable">Responsable </label>
                    <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Responsable...">
            </div>
            <h3>Tanque 1</h3>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1apertura">Apertura</label>
                    <input type="number" name="t1apertura" id="t1apertura" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1cierre">Cierre</label>
                    <input type="number" name="t1cierre" id="t1cierre" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1diferencia">Diferencia</label>
                    <input type="number" name="t1diferencia" id="t1diferencia" class="form-control" placeholder="Numero..." required>
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1nivel">Nivel</label>
                    <input type="number" name="t1nivel" id="t1nivel" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1consumo">Consumo</label>
                    <input type="number" name="t1consumo" id="t1consumo" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1saldo">Saldo</label>
                    <input type="number" name="t1saldo" id="t1saldo" class="form-control" placeholder="Numero..." required>
            </div>
             <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t1ingreso">Ingreso</label>
                    <input type="number" name="t1ingreso" id="t1ingreso" class="form-control" placeholder="Numero..." required>
            </div>
        </div>
     <div class="row">
         <h3>Tanque 2</h3>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2apertura">Apertura</label>
                    <input type="number" name="t2apertura" id="t2apertura" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2cierre">Cierre</label>
                    <input type="number" name="t2cierre" id="t2cierre" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2diferencia">Diferencia</label>
                    <input type="number" name="t2diferencia" id="t2diferencia" class="form-control" placeholder="Numero..." required>
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2nivel">Nivel</label>
                    <input type="number" name="t2nivel" id="t2nivel" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2consumo">Consumo</label>
                    <input type="number" name="t2consumo" id="t2consumo" class="form-control" placeholder="Numero..." required>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2saldo">Saldo</label>
                    <input type="number" name="t2saldo" id="t2saldo" class="form-control" placeholder="Numero..." required>
            </div>
             <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="t2ingreso">Ingreso</label>
                    <input type="number" name="t2ingreso" id="t2ingreso" class="form-control" placeholder="Numero..." required>
            </div>
        </div>
              <h3>Linea 118</h3>
            @foreach ($linea118 as $l118)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('linea118', $l118->interno)}}
                    <input type="text" class="form-control {{$errors->has($l118->id)?'is-invalid':''}}" placeholder="interno {{$l118->interno}}..." name="linea118[{{$l118->interno}}]" id="{{$l118->id}}"  value="{{old($l118->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
            <br>
              <h3>Linea 121</h3>
            @foreach ($linea121 as $l121)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l121',$l121->interno)}}
                    <input type="text" class="form-control {{$errors->has($l121->id)?'is-invalid':''}}" placeholder="interno {{$l121->interno}}..." name="linea121[{{$l121->interno}}]" id="{{$l121->id}}"  value="{{old($l121->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
  
            <h3>Linea 122</h3>
  
            @foreach ($linea122 as $l122)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l122',$l122->interno)}}
                    <input type="text" class="form-control {{$errors->has($l122->id)?'is-invalid':''}}" placeholder="interno {{$l122->interno}}..." name="linea122[{{$l122->interno}}]" id="{{$l122->id}}"  value="{{old($l122->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            
       
            @endforeach
            <h3>Linea 131</h3>
  
            @foreach ($linea131 as $l131)
            <tr>
                <div class="form-group col-lg-6 col-md-2 col-sm-2">
                    <!-- <label for="nombre">Dominio</label> -->
                    {{Form::label('l131',$l131->interno)}}
                    <input type="text" class="form-control {{$errors->has($l131->id)?'is-invalid':''}}" placeholder="interno {{$l131->interno}}..." name="linea131[{{$l131->interno}}]" id="{{$l131->id}}"  value="{{old($l131->id)}}">
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}

                </div>

            </tr>
            

       
            @endforeach
            <div class="Form-group">
                    <input type="hidden" class="form-control"  name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            </div>
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