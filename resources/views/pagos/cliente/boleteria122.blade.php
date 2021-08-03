@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Detalle de recaudaciones de abonos lineas 122 y Metropolitana</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'pagos/cliente/ingresar122','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}
			<div class="Form-group col-lg-4">
					<div><label for="responsable">Responsable</label></div>
					<div><input type="text" class="form-control {{$errors->has('responsable')?'is-invalid':''}}" placeholder="Responsable..." name="responsable" id="responsable"  value="{{old('responsable')}}" required>
					{!! $errors->first('responsable','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<div class="Form-group col-lg-4">
					<div><label for="fechapresentacion">Fecha</label></div>
					<div><input type="date" name="fechapresentacion" id="fechapresentacion" class="form-control {{$errors->has('fechapresentacion')?'is-invalid':''}}" placeholder="Fecha Final..." value="{{old('fechapresentacion')}}" required>
					{!! $errors->first('fechapresentacion','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>

			<div class="Form-group col-lg-4">
					<div><label for="pv">Punto de Ventas</label></div>
					<div><input type="text" name="pv" id="pv" class="form-control {{$errors->has('pv')?'is-invalid':''}}" value="Alderetes" readonly>
					{!! $errors->first('pv','<div class="invalid-feedback">:message</div>')!!}</div>
					<br>
			</div>
			<div class="Form-group col-lg-12">
					<div><label for="observacion">Observaciones</label></div>
					<div><input type="text" class="form-control {{$errors->has('observacion')?'is-invalid':''}}" placeholder="Observaciones..." name="observacion" id="observaciones"  value="{{old('observacion')}}">
					{!! $errors->first('observacion','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<label for="fecha">_______________________________________________________________________________________</label>
			<div id="listas">

				 <div class="Form-group col-lg-6 col-lg-6">
						<label for="fecha">Dia</label>
						<input type="date" name="fecha[]" id="fecha" class="form-control {{$errors->has('fecha')?'is-invalid':''}}" placeholder="Fecha Inicio..." value="{{old('fecha')}}" required>
						{!! $errors->first('fecha','<div class="invalid-feedback">:message</div>')!!}
											<br>
				</div>
				 <div class="Form-group col-lg-12">
					<div><label for="pv">ABONOS 122 POR PLANCA (10 UNIDADES)</label></div>
				 </div>

				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendirp">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendirp[]" class="form-control {{$errors->has('totalarendirp')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendirp')}}"> {!! $errors->first('totalarendir','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="abonodesdep">Abonos Desde</label>
					<input type="number" name="abonodesdep[]" id="abonodesdep" class="form-control {{$errors->has('abonodesdep')?'is-invalid':''}}" placeholder="Abonos desde..." value="{{old('abonodesdep')}}">
					{!! $errors->first('abonosdesdpe','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="col-lg-4 col-lg-4">
					<label for="abonohastap">Abonos Hasta</label>
					<input type="number" name="abonohastap[]" id="abonohastap" class="form-control {{$errors->has('abonohastap')?'is-invalid':''}}" placeholder="Abonos hasta..." value="{{old('abonohastap')}}">
					{!! $errors->first('abonohastap','<div class="invalid-feedback">:message</div>')!!}
										<br>
				</div>


				<div class="Form-group col-lg-12">
					<div><label for="pv">ABONOS POR UNIDAD</label></div>
				 </div>
				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendiru">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendiru[]" class="form-control {{$errors->has('totalarendiru')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendiru')}}"> {!! $errors->first('totalarendiru','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="abonodesdeu">Abonos Desde</label>
					<input type="number" name="abonodesdeu[]" id="abonodesdeu" class="form-control {{$errors->has('abonodesdeu')?'is-invalid':''}}" placeholder="Abonos desde..." value="{{old('abonodesdeu')}}">
					{!! $errors->first('abonodedeu','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="col-lg-4 col-lg-4">
					<label for="abonohastau">Abonos Hasta</label>
					<input type="number" name="abonohastau[]" id="abonohastau" class="form-control {{$errors->has('abonohastau')?'is-invalid':''}}" placeholder="Abonos hasta..." value="{{old('abonohastau')}}">
					{!! $errors->first('abonohastau','<div class="invalid-feedback">:message</div>')!!}
					<br>
				</div>


				<div class="Form-group col-lg-12">
					<div><label for="pv">CIERRE DE VTAS METROPOLITANA</label></div>
				 </div>
				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendirm">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendirm[]" class="form-control {{$errors->has('totalarendirm')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendirm')}}"> {!! $errors->first('totalarendirm','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="cierrelote">Cierre de lote</label>
					<input type="number" name="cierrelote[]" id="cierrelote" class="form-control {{$errors->has('cierrelote')?'is-invalid':''}}" placeholder="Cierre de Lote..." value="{{old('cierrelote')}}">
					{!! $errors->first('cierrelote','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<label for="fecha">_______________________________________________________________________________________</label>
			


			</div>



			<br>
			<div class="Form-group col-lg-12 col-lg-12">
					<input type="button" id="add_field" value="Agregar Dia" class="btn btn-primary">
			</div>
			
			<div class="Form-group col-lg-12 col-lg-12">
					<br>
					<button class="btn btn-success" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>

			</div>
			{!!Form::close()!!}
			
		
		</div>
	</div> 
@endsection
