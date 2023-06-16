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
 			{!!Form::open(array('url'=>'bolmanantial/boletosleagas/store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'enviar();'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}


		<!-------------------------------------------------------------->
		<div class="row">
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="fecha">Fecha</label>
					<input type="date" step=0.01 name="fecha" class="form-control" required> 
					
				</div>
				<div class="form-group col-lg-4 col-md-8 col-sm-12">
					<label for="tipo">Tipo de Servicio</label>
					<select name="tiposervicio" id="tiposervicio" class="form-control" required>
						<option value="">Seleccione una opcion</option>
						<option value="NORMAL">NORMAL</option>
						<option value="ALARGUE">ALARGUE</option>
						<option value="CORTADO">CORTADO</option>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-8 col-sm-12">
					<label for="dia">Dia</label>
					<select name="dia" id="dia" class="form-control" required>
						<option value="">Seleccione una opcion</option>
						<option value="kmsemana">SEMANA</option>
						<option value="kmsabado">SABADO</option>
						<option value="kmdomingo">DOMINGO</option>
					</select>
				</div>
			</div>

						<!-------------------------------------------------------------->
			<hr size="8px">
			<!-------------------------------------------------------------->
			<div class="row">

			<div class="Form-group col-lg-12" >
				<label for="">Chofer</label>
				<select name="chofer_id" id="chofer" class="form-control" required>
					  		<option value="">Seleccione un Chofer</option>
	        		@foreach ($choferleagaslnf as $datos)
	            			<option value="{{$datos->id}}" >Legajo: {{$datos->legajo}} - {{$datos->apellido}}, {{$datos->nombre}}</option>                    
	        
					@endforeach
				</select>
			</div>

				<div>
					<div class="Form-group col-lg-4" >
						<label for="linea_id">Linea</label>
							<select name="linea_id" id="linea_id" required>
							  <option value="">Seleccione una Linea</option>
									@foreach ($linea as $item)
								<option value="{{$item->id}}">{{$item->numero}}</option>
									@endforeach
							</select>
						</div>
					</div>
					<div>
						<div class="Form-group col-lg-8" >
							<label for="servicio_id">Servicio</label>
								<select name="servicio_id" id="servicios" required>
									<option value="">Seleccione un Servicio</option>
								</select>
						</div>
				</div>
								

			</div>

			
		
			<!-------------------------------------------------------------->
			<hr size="8px">
			<!-------------------------------------------------------------->
			<div class="row">
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="linea_id">Hora de Inicio</label>
					<input type="time" name="horainicio" id="horainicio" class="form-control" placeholder="Hora Inicio..." required>
					
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="linea_id">Hora de Fin</label>
					<input type="time" name="horafin" id="horafin" class="form-control" placeholder="Hora Fin..." required>
					
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="linea_id">Toques de Anden</label>
					<input type="number" name="toquesanden" id="toquesanden" class="form-control" placeholder="Toques de anden..." required>
				</div>
				
			</div>

							<!-------------------------------------------------------------->
			<hr size="8px">
			<!-------------------------------------------------------------->
<div id='TextBoxesGroup'>
  <div id="TextBoxDiv1">
			<div class="row">
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="servicio">Coche</label>
						<select name="coche_id[]" id="coche" class="form-control" required>
							<option value="">Seleccione un Coche</option>
							@foreach ($coche as $datos) 
							<option value="{{ $datos->id }}">Interno: {{$datos->interno}} - {{$datos->patente}}
							</option>
							@endforeach
						</select>

								</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="iniciotarjeta">Inicio Tarjeta</label>
					<input type="number" step=0 name="iniciotarjeta[]" id="iniciotarjeta" class="form-control" placeholder="Inicio Tarjeta..." required>
					
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="fintarjeta">Fin Tarjeta</label>
					<input type="number" step=0 name="fintarjeta[]" id="fintarjeta" class="form-control" placeholder="Fin Tarjeta..." required>
					
				</div>
			</div>
					<div class="row">
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="cantpasajes">Cantidad de Pasajes</label>
					<input type="number" step=0.01 name="cantpasajes[]" id="cantpasajes" class="form-control" placeholder="Cantidad de Pasajes..." readonly onmousedown="return false;">

				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="recaudacion">Recaudacion $</label>
					<input type="number" step=0.01 name="recaudacion[]" id="recaudacion" class="form-control" placeholder="Recaudacion..." readonly onmousedown="return false;" >
					
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12">
					<label for="km">KMS $</label>
					<input type="number" step=0.01 name="km[]" id="km" class="form-control" placeholder="Kilometros...">
					
				</div>
					<div class="form-group col-lg-6 col-md-4 col-sm-12">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-3 col-md-4 col-sm-12">
					<label for="">Entro al Taller?</label>
									<select name="taller[]" id="taller" class="form-control" required>
										<option value="" required>Seleccione una opcion</option>
										<option value="SI">SI</option>
										<option value="NO">NO</option>
										
									</select>
				</div>

				<div class="form-group col-lg-9 col-md-4 col-sm-12">
					<label for="linea_id">Observaciones taller </label>
					<input type="text" name="motivo_cambio[]" id="motivo_cambio" class="form-control" placeholder="Observacion de ingreso al taller...">
					
				</div>
			</div>
				<hr size="8px">
	</div>
</div>

<input type='button' value='Agregar Cambio de Coche' id='addButton'/>
<input type='button' value='Eliminar Cambio de Coche' id='removeButton'/>

			<div class="Form-group">
					<input type="hidden" class="form-control"  name="user_id" id="user_id" value="{{ Auth::user()->id }}">
			</div>
				

			<br>


			<div class="row">
				<div class="form-group col-lg-12 col-md-4 col-sm-12">
					<button id="btn" class="btn btn-primary" type="submit">Guardar</button>
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
</div>
	

<script>
		
   function enviar(){
		
    var btn = document.getElementById('btn');
    btn.setAttribute('disabled','');
    
  }

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
  					if(resta<0){
  						alert("LA CANTIDAD DE PASAJES NO PUEDE SER NEGATIVA");
  						$("#iniciotarjeta").focus();
						$("#iniciotarjeta").val("");
						$("#fintarjeta").val("");
  					}
  					else{
  						recaudacion=resta*101.52;
						$("#cantpasajes").val(resta);
						$("#recaudacion").val(recaudacion);
  					}
  				}
  			}
		});

		$('#servicios').on('change', function() {
			$.ajax({
				url : "/bolmanantial/boletosleagas/buscarkms",
				type : "POST",
				data : {
					servicio : $("#servicios").val(),
					dia : $("#dia").val(),
					_token : $('input[name="_token"]').val()
						},
						success: function(data) {

                			if (data.length!=0 && data!=0)
							{
								$("#km").val(data);
							}else{
								alert('Debe seleccionar el dia');
								$("#dia").focus();
							}
		            	},
		            error: function (error) { 
		                 $("#dia").focus();
		            }

					})
				});

$(".print").click(function() {
  window.print();
});



        var counter = 2;
        $("#addButton").click(function () {
            if (counter > 3) {
                alert("Solo se puede agregar 3 cambios");
                return false;
            }
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div class="form-group col-lg-4 col-md-4 col-sm-12"><label for="servicio">Coche</label><select name="coche_id[]" id="coche" class="form-control" required><option value="">Seleccione un Coche</option>@foreach ($coche as $datos)<option value="{{ $datos->id }}">Interno: {{$datos->interno}} - {{$datos->patente}}</option>@endforeach</select></div>'+
            	'<div class="form-group col-lg-4 col-md-4 col-sm-12"><label for="iniciotarjeta">Inicio Tarjeta</label><input type="number" step=0 name="iniciotarjeta[]" id="iniciotarjeta" class="form-control" placeholder="Inicio Tarjeta..." required></div>'+
            	'<div class="form-group col-lg-4 col-md-4 col-sm-12"><label for="fintarjeta">Fin Tarjeta</label><input type="number" step=0 name="fintarjeta[]" id="fintarjeta" class="form-control" placeholder="Fin Tarjeta..." required></div>'+
            	'<div class="form-group col-lg-6 col-md-4 col-sm-12"><label for="cantpasajes">Cantidad de Pasajes</label><input type="number" step=0.01 name="cantpasajes[]" id="cantpasajes" class="form-control" placeholder="Cantidad de Pasajes..." readonly onmousedown="return false;"></div>'+
            	'<div class="form-group col-lg-6 col-md-4 col-sm-12"><label for="recaudacion">Recaudacion $</label><input type="number" step=0.01 name="recaudacion[]" id="recaudacion" class="form-control" placeholder="Recaudacion..." readonly onmousedown="return false;" ></div>'+
            	'<div class="row"><div class="form-group col-lg-3 col-md-4 col-sm-12"><label for="">Entro al Taller?</label><select name="taller[]" id="taller" class="form-control" required><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option></select></div><div class="form-group col-lg-9 col-md-4 col-sm-12"><label for="linea_id">Obsevaciones taller </label><input type="text" name="motivo_cambio[]" id="motivo_cambio" class="form-control {{$errors->has("motivo_cambio")?"is-invalid":""}}" placeholder="Observacion de ingreso al taller..." value="{{old("motivo_cambio[]")}}"></div></div>'+'<hr size="8px">');
            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
        });
        $("#removeButton").click(function () {
            if (counter == 1) {
                alert("No more textbox to remove");
                return false;
            }
            counter--;
            $("#TextBoxDiv" + counter).remove();
        });
        $("#getButtonValue").click(function () {
            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });



 


	})
</script>
@endsection

