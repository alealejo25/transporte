@extends('layouts.admin')
@section('contenido')
<div class="row">
        <div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
            <h3>Cargar Gasoil LNF</h3>
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
<div class="container-fluid">
    {!!Form::open(array('url'=>'bolmanantial/boletos/guardarcargagasoillnf','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}
    <div class="row pt-4">
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="" required> 
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                
                <div class="card-body">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" id="numero" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                
                <div class="card-body">
                     <label for="responsable">Responsable </label>
                    <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Responsable...">
                </div>
            </div>
        </div>
        
    </div><!--- ./row" -->
    <br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Tanque 1</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t2apertura">Apertura</label>
                    <input type="number" name="t2apertura" id="t2apertura" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                   <label for="t2cierre">Cierre</label>
                    <input type="number" name="t2cierre" id="t2cierre" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                     <label for="t2diferencia">Diferencia</label>
                    <input type="number" name="t2diferencia" id="t2diferencia" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>

    </div><!--- ./row" -->

    <div class="row pt-4">
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                     <label for="t2nivel">Nivel</label>
                    <input type="number" name="t2nivel" id="t2nivel" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t2consumo">Consumo</label>
                    <input type="number" name="t2consumo" id="t2consumo" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t2saldo">Saldo</label>
                    <input type="number" name="t2saldo" id="t2saldo" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                     <label for="t2ingreso">Ingreso</label>
                    <input type="number" name="t2ingreso" id="t2ingreso" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
    </div><!--- ./row" -->
    <br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Tanque 2</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                      <label for="t1apertura">Apertura</label>
                    <input type="number" name="t1apertura" id="t1apertura" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                     <label for="t1cierre">Cierre</label>
                    <input type="number" name="t1cierre" id="t1cierre" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                     <label for="t1diferencia">Diferencia</label>
                    <input type="number" name="t1diferencia" id="t1diferencia" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>

    </div><!--- ./row" -->

    <div class="row pt-4">
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t1nivel">Nivel</label>
                    <input type="number" name="t1nivel" id="t1nivel" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t1consumo">Consumo</label>
                    <input type="number" name="t1consumo" id="t1consumo" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t1saldo">Saldo</label>
                    <input type="number" name="t1saldo" id="t1saldo" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 pb-4">
            <div class="card">
                <div class="card-body">
                    <label for="t1ingreso">Ingreso</label>
                    <input type="number" name="t1ingreso" id="t1ingreso" class="form-control" placeholder="Numero..." required>
                </div>
            </div>
        </div>
    </div><!--- ./row" -->
<br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>LINEA 118</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
        @foreach ($linea118 as $l118)
            <div class="col-sm-12 col-md-2 col-lg-1 pb-4">
                <div class="card">
                    <div class="card-body">
                        {{Form::label('linea118', $l118->interno)}}
                        <input type="text" class="form-control {{$errors->has($l118->id)?'is-invalid':''}}" placeholder="Int. {{$l118->interno}}..." name="linea118[{{$l118->interno}}]" id="{{$l118->id}}"  value="{{old($l118->id)}}">
                        {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--- ./row" -->
    <br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>LINEA 121</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
        @foreach ($linea121 as $l121)
            <div class="col-sm-12 col-md-2 col-lg-1 pb-4">
                <div class="card">
                    <div class="card-body">
                        {{Form::label('l121',$l121->interno)}}
                        <input type="text" class="form-control {{$errors->has($l121->id)?'is-invalid':''}}" placeholder="Int. {{$l121->interno}}..." name="linea121[{{$l121->interno}}]" id="{{$l121->id}}"  value="{{old($l121->id)}}">
                        {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--- ./row" -->

    <br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>LINEA 122</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
        @foreach ($linea122 as $l122)
            <div class="col-sm-12 col-md-2 col-lg-1 pb-4">
                <div class="card">
                    <div class="card-body">
                      {{Form::label('l122',$l122->interno)}}
                        <input type="text" class="form-control {{$errors->has($l122->id)?'is-invalid':''}}" placeholder="Int. {{$l122->interno}}..." name="linea122[{{$l122->interno}}]" id="{{$l122->id}}"  value="{{old($l122->id)}}">
                        {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--- ./row" -->

    <br>
    <div class="row pt-4">
            <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>LINEA 131</h4>
                    </div>
                </div>
            </div>
    </div><!--- ./row" -->

    <div class="row pt-4">
      @foreach ($linea131 as $l131)
            <div class="col-sm-12 col-md-2 col-lg-1 pb-4">
                <div class="card">
                    <div class="card-body">
                      {{Form::label('l131',$l131->interno)}}
                        <input type="text" class="form-control {{$errors->has($l131->id)?'is-invalid':''}}" placeholder="interno {{$l131->interno}}..." name="linea131[{{$l131->interno}}]" id="{{$l131->id}}"  value="{{old($l131->id)}}">
                        {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>')!!}
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--- ./row" -->


<br>
    <div class="row pt-4">
        <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 pb-4">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" class="form-control"  name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                </div>
            </div>
        </div>
    </div><!--- ./row" -->
    {!!Form::close()!!}
            
    <div class="Form-group">
        <br/>
        <a href="/bolmanantial/boletos/servicios"><button class="btn btn-success">Regresar</button></a>
    </div>


</div> <!--- ./container_fluid" -->
 

@endsection
