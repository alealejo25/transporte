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
				<h3>Carga de Boletos</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/guardarrecaudacionchofer','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			{{Form::token()}}
@foreach ($servicios as $dato)
<input name="id" type="text" value="{{$dato->id}}"  style="display: none">
<div class="container my-5">
        <div class="row justify-content-center">
        	@if($dato->inicialcod6a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 6a</label>
                    <div class="contenedor">
                        <input name="inicialcod6a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod6a}}" readonly tabindex="-1" size="4">
                        <input name="fincod6a" class="final" placeholder="Final Codigo 6a" style="text-align:right" type="text" size="4">
                        <input name="cantidad6a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="3">
                        
                        <input name="cod6a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly  tabindex="-1"size="5">
                        <input name="preciocod6" class="precio" type="text" value="{{$preciocod6}}"  style="display: none">
                    </div>
                    </div>
                </div>
            
            @endif
            @if($dato->inicialcod6b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 6b</label>
                    <div class="contenedor">
                        <input name="inicialcod6b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod6b}}" readonly tabindex="-1" size="4">
                        <input name="fincod6b" class="final" placeholder="Final Codigo 6b" style="text-align:right" type="text" size="4">
                        <input name="cantidad6b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod6b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod6" class="precio" type="text" value="{{$preciocod6}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod7a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 7a</label>
                    <div class="contenedor">
                        <input name="inicialcod7a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod7a}}" readonly tabindex="-1" size="4">
                        <input name="fincod7a" class="final" placeholder="Final Codigo 7a" style="text-align:right" type="text" size="4">
                        <input name="cantidad7a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod7a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod7" class="precio" type="text" value="{{$preciocod7}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod7b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 7b</label>
                    <div class="contenedor">
                        <input name="inicialcod7b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod7b}}" readonly tabindex="-1" size="4">
                        <input name="fincod7b" class="final" placeholder="Final Codigo 7b" style="text-align:right" type="text" size="4">
                        <input name="cantidad7b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly  tabindex="-1" size="4">
                        <input name="cod7b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly  tabindex="-1" size="4">
                        <input name="preciocod7" class="precio" type="text" value="{{$preciocod7}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod8a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 8a</label>
                     <div class="contenedor">
                        <input name="inicialcod8a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod8a}}" readonly tabindex="-1" size="4">
                        <input name="fincod8a" class="final" placeholder="Final Codigo 8a" style="text-align:right" type="text" size="4">
                        <input name="cantidad8a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod8a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod8" class="precio" type="text" value="{{$preciocod8}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod8b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 8b</label>
                    <div class="contenedor">
                        <input name="inicialcod8b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod8b}}" readonly tabindex="-1" size="4">
                        <input name="fincod8b" class="final" placeholder="Final Codigo 8b" style="text-align:right" type="text" size="4">
                        <input name="cantidad8b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4"> 
                        <input name="cod8b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod8" class="precio" type="text" value="{{$preciocod8}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod10a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 10a</label>
                    <div class="contenedor">
                        <input name="inicialcod10a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod10a}}" readonly  tabindex="-1" size="4">
                        <input name="fincod10a" class="final" placeholder="Final Codigo 10a" style="text-align:right" type="text" size="4">
                        <input name="cantidad10a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod10a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod10" class="precio" type="text" value="{{$preciocod10}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod10b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 10b</label>
                    <div class="contenedor">
                        <input name="inicialcod10b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod10b}}" readonly tabindex="-1" size="4">
                        <input name="fincod10b" class="final" placeholder="Final Codigo 10b" style="text-align:right" type="text" size="4">
                        <input name="cantidad10b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod10b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod10" class="precio" type="text" value="{{$preciocod10}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod12a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 12a</label>
                    <div class="contenedor">
                        <input name="inicialcod12a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod12a}}" readonly tabindex="-1" size="4">
                        <input name="fincod12a" class="final" placeholder="Final Codigo 12a" style="text-align:right" type="text" size="4">
                        <input name="cantidad12a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod12a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod12" class="precio" type="text" value="{{$preciocod12}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod12b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 12b</label>
                    <div class="contenedor">
                        <input name="inicialcod12b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod12b}}" readonly tabindex="-1" size="4"> 
                        <input name="fincod12b" class="final" placeholder="Final Codigo 12b" style="text-align:right" type="text" size="4">
                        <input name="cantidad12b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod12b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod12" class="precio" type="text" value="{{$preciocod12}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialcod14a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 14a</label>
                    <div class="contenedor">
                        <input name="inicialcod14a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod14a}}" readonly tabindex="-1" size="4">
                        <input name="fincod14a" class="final" placeholder="Final Codigo 14a" style="text-align:right" type="text" size="4">
                        <input name="cantidad14a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod14a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod14" class="precio" type="text" value="{{$preciocod14}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod14b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 14b</label>
                    <div class="contenedor">
                        <input name="inicialcod14b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod14b}}" readonly tabindex="-1" size="4">
                        <input name="fincod14b" class="final" placeholder="Final Codigo 14b" style="text-align:right" type="text" size="4">
                        <input name="cantidad14b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod14b" class="pesos" placeholder="Total Recaudado" tabindex="-1" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod14" class="precio" type="text" value="{{$preciocod14}}"  style="display: none">
                    </div>
                </div>
            </div>
   @endif
            @if($dato->inicialcod15a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 15a</label>
                    <div class="contenedor">
                        <input name="inicialcod15a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod15a}}" readonly tabindex="-1" size="4">
                        <input name="fincod15a" class="final" placeholder="Final Codigo 15a" style="text-align:right" type="text" size="4">
                        <input name="cantidad15a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod15a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly  tabindex="-1" size="4">
                        <input name="preciocod15" class="precio" type="text" value="{{$preciocod15}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod15b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 15b</label>
                    <div class="contenedor">
                        <input name="inicialcod15b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod15b}}" readonly tabindex="-1" size="4">
                        <input name="fincod15b" class="final" placeholder="Final Codigo 15b" style="text-align:right" type="text" size="4">
                        <input name="cantidad15b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod15b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod15" class="precio" type="text" value="{{$preciocod15}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod18a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 18a</label>
                    <div class="contenedor">
                        <input name="inicialcod18a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod18a}}" readonly tabindex="-1" size="4">
                        <input name="fincod18a" class="final" placeholder="Final Codigo 18a" style="text-align:right" type="text" size="4">
                        <input name="cantidad18a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod18a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly  tabindex="-1" size="4">
                        <input name="preciocod18" class="precio" type="text" value="{{$preciocod18}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod18b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 18b</label>
                    <div class="contenedor">
                        <input name="inicialcod18b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod18b}}" readonly tabindex="-1" size="4">
                        <input name="fincod18b" class="final" placeholder="Final Codigo 18b" style="text-align:right" type="text" size="4">
                        <input name="cantidad18b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod18b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod18" class="precio" type="text" value="{{$preciocod18}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod21a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 21a</label>
                    <div class="contenedor">
                        <input name="inicialcod21a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod21a}}" readonly tabindex="-1" size="4">
                        <input name="fincod21a" class="final" placeholder="Final Codigo 21a" style="text-align:right" type="text" size="4">
                        <input name="cantidad21a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod21a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod21" class="precio" type="text" value="{{$preciocod21}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod21b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 21b</label>
                    <div class="contenedor">
                        <input name="inicialcod21b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod21b}}" readonly tabindex="-1" size="4">
                        <input name="fincod21b" class="final" placeholder="Final Codigo 21b" style="text-align:right" type="text" size="4">
                        <input name="cantidad21b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod21b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod21" class="precio" type="text" value="{{$preciocod21}}"  style="display: none">
                    </div>
                </div>
            </div>
  			@endif
            @if($dato->inicialcod23a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 23a</label>
                    <div class="contenedor">
                        <input name="inicialcod23a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod23a}}" readonly tabindex="-1" size="4">
                        <input name="fincod23a" class="final" placeholder="Final Codigo 23a" style="text-align:right" type="text" size="4">
                        <input name="cantidad23a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod23a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly  tabindex="-1" size="4">
                        <input name="preciocod23" class="precio" type="text" value="{{$preciocod23}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod23b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 23b</label>
                    <div class="contenedor">
                        <input name="inicialcod23b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod23b}}" readonly tabindex="-1" size="4">
                        <input name="fincod23b" class="final" placeholder="Final Codigo 23b" style="text-align:right" type="text" size="4">
                        <input name="cantidad23b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod23b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod23" class="precio" type="text" value="{{$preciocod23}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod27a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 27a</label>
                    <div class="contenedor">
                        <input name="inicialcod27a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod27a}}" readonly tabindex="-1" size="4">
                        <input name="fincod27a" class="final" placeholder="Final Codigo 27a" style="text-align:right" type="text" size="4">
                        <input name="cantidad27a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod27a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod27" class="precio" type="text" value="{{$preciocod27}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod27b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 27b</label>
                    <div class="contenedor">
                        <input name="inicialcod27b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod27b}}" readonly tabindex="-1" size="4">
                        <input name="fincod27b" class="final" placeholder="Final Codigo 27b" style="text-align:right" type="text" size="4">
                        <input name="cantidad27b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod27b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod27" class="precio" type="text" value="{{$preciocod27}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod30a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 30a</label>
                    <div class="contenedor">
                        <input name="inicialcod30a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod30a}}" readonly tabindex="-1" size="4">
                        <input name="fincod30a" class="final" placeholder="Final Codigo 30a" style="text-align:right" type="text" size="4">
                        <input name="cantidad30a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod30a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod30" class="precio" type="text" value="{{$preciocod30}}"  style="display: none">
                    </div>
                </div>
            </div>
             @endif
            @if($dato->inicialcod30b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 30b</label>
                    <div class="contenedor">
                        <input name="inicialcod30b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod30b}}" readonly tabindex="-1" size="4">
                        <input name="fincod30b" class="final" placeholder="Final Codigo 30b" style="text-align:right" type="text" size="4">
                        <input name="cantidad30b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod30b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod30" class="precio" type="text" value="{{$preciocod30}}"  style="display: none">
                    </div>
                </div>
            </div>
  			@endif
            @if($dato->inicialcod32a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 32a</label>
                    <div class="contenedor">
                        <input name="inicialcod32a" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod32a}}" readonly tabindex="-1" size="4"> 
                        <input name="fincod32a" class="final" placeholder="Final Codigo 32a" style="text-align:right" type="text" size="4">
                        <input name="cantidad32a" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod32a" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod32" class="precio" type="text" value="{{$preciocod32}}"  style="display: none">
                    </div>
                </div>
            </div> 
            @endif
            @if($dato->inicialcod32b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">COD 32b</label>
                    <div class="contenedor">
                        <input name="inicialcod32b" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialcod32b}}" readonly tabindex="-1" size="4">
                        <input name="fincod32b" class="final" placeholder="Final Codigo 32b" style="text-align:right" type="text" size="4">
                        <input name="cantidad32b" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="cod32b" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="preciocod32" class="precio" type="text" value="{{$preciocod32}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialabonoa!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">ABONOa</label>
                    <div class="contenedor">
                        <input name="inicialabonoa" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialabonoa}}" readonly tabindex="-1" size="4">
                        <input name="finabonoa" class="final" placeholder="Final Codigo abonosa" style="text-align:right" type="text" size="4">
                        <input name="cantidadabonoa" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="abonosa" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="precioabono" class="precio" type="text" value="{{$precioabono}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
            @if($dato->inicialabonob!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">ABONOb</label>
                    <div class="contenedor">
                        <input name="inicialabonob" class="inicial" style="text-align:right" type="text" value="{{$dato->inicialabonob}}" readonly tabindex="-1" size="4">
                        <input name="finabonob" class="final" placeholder="Final Codigo abonosb" style="text-align:right" type="text" size="4">
                        <input name="cantidadabonob" class="resultado" placeholder="Cantidad de Boletos" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="abonosb" class="pesos" placeholder="Total Recaudado" style="text-align:right" type="text" readonly tabindex="-1" size="4">
                        <input name="precioabono" class="precio" type="text" value="{{$precioabono}}"  style="display: none">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

@endforeach
			
            <hr/>
            <div >
                <button class="btn btn-primary" type="button" id="calcular">Calcular Recaudacion</button>
            </div>
            <h3 id="resultado"> </h3>
                        <hr/>
			<div >
                <button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>

			</div>

			<div class="Form-group">
					<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
				</div>
			
			{!!Form::close()!!}

            <a href="/bolterminal/recaudar"><button class="btn btn-success">Regresar</button></a>
    
		</div>
	</div> 

<script>
        $(document).ready(function () {

            function getLastThreeDigits(number) {
           // Convertimos el número a cadena para asegurarnos de poder manipularlo
            let numStr = number.toString();
            // Extraemos los últimos tres caracteres
            return numStr.slice(-3);
            }

            $('#calcular').click(function(){ let suma = 0; $('.contenedor .pesos').each(function() { let valor = parseFloat($(this).val()) || 0; suma += valor; }); 
                $('#resultado').text('Recaudacion a Cobrar: $' + suma +',00');
                $('#guardar').show(); // Mostrar el botón "Cargar"

            });
            $('#guardar').hide(); // Ocultar el botón "Cargar" al cargar la página
            $('.final').on('input', function() { this.value = this.value.replace(/[^0-9]/g, '').slice(0, 7); });


            // Delegar el evento blur a cualquier input con la clase 'final'
            $('.contenedor').on('blur', '.final', function () {
                $('#guardar').hide(); // Ocultar el botón "Cargar" al cargar la
                // Buscar el contenedor padre
                const contenedor = $(this).closest('.contenedor');
                
                // Obtener los valores de los inputs dentro del contenedor actual
                const inicial = parseInt(contenedor.find('.inicial').val(), 10);
                const final = parseInt($(this).val(), 10);
                const precio = parseInt(contenedor.find('.precio').val(), 10);

                    
                // Validar que ambos valores sean números
                if (isNaN(inicial) || isNaN(final)) {
                    contenedor.find('.resultado').val('Error: valores inválidos');
                    return;
                }
                if (inicial > final ) {
                    if(final!=0){
                    alert('Error: El valor inicial no puede ser mayor que el valor final.');
                    contenedor.find('.final').focus();
                    contenedor.find('.final').val(''); // Limpia el resultado
                    contenedor.find('.resultado').val(''); // Limpia el resultado
                    
                    return;
                    }
                }

                //////////////////// para hacer cuando termina el rollo
                if(final==0){
                    numero=getLastThreeDigits(inicial);
                    if(numero>=501){
                        const resto=1001-numero;
                        const total = resto*precio;

                // Escribir el resultado en el campo correspondiente
                        contenedor.find('.resultado').val(resto);
                        contenedor.find('.pesos').val(total);
                    }
                    else{
                        if(numero==000){
                            
                            const resto = 1;
                            const total = resto*precio;
                            // Escribir el resultado en el campo correspondiente
                             contenedor.find('.resultado').val(resto);
                            contenedor.find('.pesos').val(total);
                            
                        }
                        else{
                            if(numero<=500){
                                const resto=501-numero;
                                const total = resto*precio;
                                // Escribir el resultado en el campo correspondiente
                                contenedor.find('.resultado').val(resto);
                                contenedor.find('.pesos').val(total);
                            
                            }
                        }
                    }
                }
                else{
                    const resto = final-inicial;
                    const total = resto*precio;
                    // Escribir el resultado en el campo correspondiente
                    contenedor.find('.resultado').val(resto);
                    contenedor.find('.pesos').val(total);
                }
            });

        });
    </script>
@endsection