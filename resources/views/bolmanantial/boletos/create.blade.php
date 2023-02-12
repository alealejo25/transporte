@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Cargar Servicio</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'bolmanantial/boletosleagas/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}


		<!-------------------------------------------------------------->
			<div class="row">
				<div>
								<div class="Form-group col-lg-12" >
									<label for="">Chofer</label>
									<select name="chofer_id" id="chofer" class="form-control">
										<option value="">Seleccione un Chofer</option>
										@foreach ($choferleagaslnf as $datos) 
											<option value="{{ $datos->id }}">{{$datos->apellido}}, {{$datos->nombre}}</option>
										@endforeach
									</select>

								</div>
				</div>
				<div>
					<div class="Form-group col-lg-12" >
						<label for="servicio">Linea</label>
							<select name="linea_id" id="linea_id">
							  <option value="">Seleccione una Linea</option>
									@foreach ($linea as $item)
								<option value="{{$item->id}}">{{$item->numero}}</option>
									@endforeach
							</select>
						</div>
					</div>
					<div>
						<div class="Form-group col-lg-12" >
							<label for="linea_id">Servicio</label>
								<select name="servicio_id" id="servicios">
									<option value="">Seleccione un Servicio</option>
								</select>
						</div>
				</div>
								
				<div class="form-group col-lg-12 col-md-4 col-sm-12">
					<label for="servicio">Coche</label>
					
					{!!Form::select('coche_id',$coche,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
				</div>
			</div>
			<!-------------------------------------------------------------->
			<hr size="8px">
			<!-------------------------------------------------------------->
			<div class="row">
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="fecha">Fecha</label>
					<input type="date" step=0.01 name="fecha" class="form-control {{$errors->has('fecha')?'is-invalid':''}}" value="{{old('fecha')}}"> 
					{!! $errors->first('fecha','<div class="invalid-feedback">:message</div>')!!}
				</div>

				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="iniciotarjeta">Inicio Tarjeta</label>
					<input type="number" step=0 name="iniciotarjeta" id="iniciotarjeta" class="form-control {{$errors->has('iniciotarjeta')?'is-invalid':''}}" placeholder="Inicio Tarjeta..." value="{{old('iniciotarjeta')}}">
					{!! $errors->first('iniciotarjeta','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="fintarjeta">Fin Tarjeta</label>
					<input type="number" step=0 name="fintarjeta" id="fintarjeta" class="form-control {{$errors->has('fintarjeta')?'is-invalid':''}}" placeholder="Fin Tarjeta..." value="{{old('fintarjeta')}}" >
					{!! $errors->first('fintarjeta','<div class="invalid-feedback">:message</div>')!!}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="cantpasajes">Cantidad de Pasajes</label>
					<input type="number" step=0.01 name="cantpasajes" id="cantpasajes" class="form-control {{$errors->has('cantpasajes')?'is-invalid':''}}" placeholder="Inicio Tarjeta..." value="{{old('cantpasajes')}}" readonly onmousedown="return false;">
					{!! $errors->first('cantpasajes','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="recaudacion">Recaudacion $</label>
					<input type="number" step=0.01 name="recaudacion" id="recaudacion" class="form-control {{$errors->has('recaudacion')?'is-invalid':''}}" placeholder="Inicio Tarjeta..." value="{{old('recaudacion')}}" readonly onmousedown="return false;" >
					{!! $errors->first('recaudacion','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
				</div>
			</div>
			<!-------------------------------------------------------------->
			<hr size="8px">
			<!-------------------------------------------------------------->
			<div class="row">

				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="linea_id">Hora de Inicio</label>
					<input type="time" name="horainicio" id="horainicio" class="form-control {{$errors->has('horainicio')?'is-invalid':''}}" placeholder="Hora Inicio..." value="{{old('horainicio')}}">
					{!! $errors->first('horainicio','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="linea_id">Hora de Fin</label>
					<input type="time" name="horafin" id="horafin" class="form-control {{$errors->has('horafin')?'is-invalid':''}}" placeholder="Hora Fin..." value="{{old('horafin')}}">
					{!! $errors->first('horafin','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
				</div>
				
			</div>
			<div class="row">

				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="linea_id">Toques de Anden</label>
					<input type="number" name="toquesanden" id="toquesanden" class="form-control {{$errors->has('toquesanden')?'is-invalid':''}}" placeholder="Toques de anden..." value="{{old('toquesanden')}}">
					{!! $errors->first('toquesanden','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="form-group col-lg-6 col-md-4 col-sm-12">
					<label for="linea_id">Gasoil</label>
					<input type="number" name="gasoil" id="gasoil" class="form-control {{$errors->has('gasoil')?'is-invalid':''}}" placeholder="Toques de anden..." value="{{old('gasoil')}}">
					{!! $errors->first('gasoil','<div class="invalid-feedback">:message</div>')!!}
				</div>
							</div>
				<div class="row">
				<div class="form-group col-lg-3 col-md-4 col-sm-12">
					<label for="">Entro al Taller?</label>
									<select name="taller" id="taller" class="form-control">
										<option value="">Seleccione una opcion</option>
										<option value="SI">SI</option>
										<option value="NO">NO</option>
										
									</select>
				</div>

				<div class="form-group col-lg-9 col-md-4 col-sm-12">
					<label for="linea_id">Obsevaciones taller </label>
					<input type="text" name="observaciones" id="observaciones" class="form-control {{$errors->has('observaciones')?'is-invalid':''}}" placeholder="Observacion de ingreso al taller..." value="{{old('observaciones')}}">
					{!! $errors->first('observaciones','<div class="invalid-feedback">:message</div>')!!}
				</div>
			<div class="Form-group">
					<input type="hidden" class="form-control"  name="user_id" id="user_id" value="{{ Auth::user()->id }}">
				</div>
				
			</div>
			<br>


			<div class="row">
				<div class="form-group col-lg-12 col-md-4 col-sm-12">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			</div>
			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/bolmanantial/boletosleagas"><button class="btn btn-success">Regresar</button></a>

			</div>

		</div>
	</div> 

	

<script>
		


	 $(document).ready(function(){
	 	const csrfToken=document.head.querySelector("[name~=csrf-token][content]").content;
		 	$('#linea_id').on('change', function() {
				$.ajax({
					url : "/bolmanantial/boletosleagas/buscarservicios",
					type : "POST",
					data : {
									linea : $("#linea_id").val(),
									_token : $('input[name="_token"]').val()
									}
					}).done( function( data ){
					if (data.length!=0)
					{
						var opciones='<option value="">Seleccione un Servicio</option>';
						for (var i=0; i<data.length ;i++) {
							opciones+='<option value="'+ data[i].id +'">'+data[i].numero+'-'+data[i].ramal.nombre+'-'+data[i].turno.nombre+'</option>';
														
						}
						document.getElementById("servicios").innerHTML=opciones;
					}
					else
					{
						var opciones="";
						opciones+='<option value=" ">No se encontraron servicios cargados</option>';
						document.getElementById("servicios").innerHTML=opciones;
					}


					 });
		 	})
		var x,y,resta,recaudacion;	
		$("#fintarjeta").blur(function(){
		   	x = $("#iniciotarjeta").val();
  			y = $("#fintarjeta").val();
  			resta=y-x;
  			if(x=='')
  			{
  				alert("EL INICIO DE TARJETA NO PUEDE SER VACIO");
  				$("#iniciotarjeta").focus();
  			}
  			else{
  				if(y==''){
  					
					alert("EL FIN DE TARJETA NO PUEDE SER VACIO");
					
  				}
  				else{
  					if(resta<=0){
  						alert("LA CANTIDAD DE PASAJES NO PUEDE SER NEGATIVA");
  						$("#iniciotarjeta").focus();
						$("#iniciotarjeta").val("");
						$("#fintarjeta").val("");
  					}
  					else{
  						recaudacion=resta*42.7;
						$("#cantpasajes").val(resta);
						$("#recaudacion").val(recaudacion);
  					}
  				}
  			}
		});
$(".print").click(function() {
  window.print();
});
	})
</script>
@endsection

