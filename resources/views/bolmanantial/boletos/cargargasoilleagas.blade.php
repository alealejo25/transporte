@extends('layouts.admin')
@section('contenido')
<div class="row">
        <div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
            <h3>Cargar Gasoil Leagas</h3>
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
	{!!Form::open(array('url'=>'bolmanantial/boletos/guardarcargagasoilleagas','method'=>'PATCH','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
            {{Form::token()}}
	<div class="row pt-4">
		<div class="col-sm-12 col-md-3 col-lg-3 pb-4">
			<div class="card">
  				<div class="card-body">
					<label for="fecha">Fecha</label>
                	<input type="date" step=0.01 name="fecha" class="form-control" value="" required> 
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
						<h4>LINEA 10</h4>
	  				</div>
				</div>
			</div>
	</div><!--- ./row" -->

	<div class="row pt-4">
		@foreach ($linea10 as $l10)
			<div class="col-sm-12 col-md-2 col-lg-1 pb-4">
				<div class="card">
	  				<div class="card-body">
						{{Form::label('linea10', $l10->interno)}}
	                    <input type="text" class="form-control {{$errors->has($l10->id)?'is-invalid':''}}" placeholder="Int. {{$l10->interno}}..." name="linea10[{{$l10->interno}}]" id="{{$l10->id}}"  value="{{old($l10->id)}}">
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
						<h4>LINEA 142</h4>
	  				</div>
				</div>
			</div>
	</div><!--- ./row" -->

	<div class="row pt-4">
		@foreach ($linea142 as $l142)
			<div class="col-sm-12 col-md-2 col-lg-1 pb-4">
				<div class="card">
	  				<div class="card-body">
						{{Form::label('l142',$l142->interno)}}
	                    <input type="text" class="form-control {{$errors->has($l142->id)?'is-invalid':''}}" placeholder="Int. {{$l142->interno}}..." name="linea142[{{$l142->interno}}]" id="{{$l142->id}}"  value="{{old($l142->id)}}">
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
						<h4>LINEA 110</h4>
	  				</div>
				</div>
			</div>
	</div><!--- ./row" -->

	<div class="row pt-4">
		@foreach ($linea110 as $l110)
			<div class="col-sm-12 col-md-2 col-lg-1 pb-4">
				<div class="card">
	  				<div class="card-body">
					 {{Form::label('l110',$l110->interno)}}
                    <input type="text" class="form-control {{$errors->has($l110->id)?'is-invalid':''}}" placeholder="Int. {{$l110->interno}}..." name="linea110[{{$l110->interno}}]" id="{{$l110->id}}"  value="{{old($l110->id)}}">
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
