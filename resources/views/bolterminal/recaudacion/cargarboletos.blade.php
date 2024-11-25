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
				<h3>Carga de Vela</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/guardarcargarboletos','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			{{Form::token()}}

			<div class="col-lg-6">
				<label for="codigo"> Codigo</label>
				<select name="codigo" id="codigo" class="form-control">
					<option value="">Selecccione un Codigo</option>
					<option value="cod6">6</option>
					<option value="cod7">7</option>
					<option value="cod8">8</option>
					<option value="cod10">10</option>
					<option value="cod12">12</option>
					<option value="cod14">14</option>
					<option value="cod15">15</option>
					<option value="cod18">18</option>
					<option value="cod21">21</option>
					<option value="cod23">23</option>
					<option value="cod27">27</option>
					<option value="cod30">30</option>
					<option value="cod32">32</option>
					<option value="abono">Abono</option>
				</select>
			</div>
			<div class="col-lg-12">
				<label for="serie"> Serie</label>
				<input type="number" min="1" max="99" placeholder="Cantidad..."  name="serie" id="serie"  value="{{old('serie')}}" >
				{!! $errors->first('serie','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="col-lg-6">
				{{Form::label('inicio', 'Inicio')}}
				<input type="number" class="form-control {{$errors->has('inicio')?'is-invalid':''}}" placeholder="Cantidad..." name="inicio" id="inicio"  value="{{old('inicio')}}" min="1" max="99999">
				{!! $errors->first('inicio','<div class="invalid-feedback">:message</div>')!!}
			</div>
			


			<div class="Form-group">
				<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
			</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="guardar">Cargar</button>
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
    $(document).ready(function () {
        $("#serie").on("input", function () {
            let value = parseInt($(this).val(), 10);

            // Si el valor está fuera de rango, ajustarlo
            if (value < 1) {
                $(this).val(1);
            } else if (value > 99) {
                $(this).val(99);
            }
        });

        $("#inicio").on("input", function () {
            let value = $(this).val();

            // Si el valor tiene más de 5 cifras, recortarlo
            if (value.length > 5) {
                $(this).val(value.slice(0, 5));
            }
        });
    });
</script>
@endsection