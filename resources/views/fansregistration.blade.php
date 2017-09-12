@extends('layouts.layout')
<style type="text/css">
	    
    input.error,
    select.error  {
      border: 1px solid #ff3131!important;
    }

    input.success,
    select.success {
      border: 1px solid #6bff6b!important;
    }

    body > div.super-container.bg-photo-3 > div.container-register > h3 {
    	margin-bottom: 6em;
    }

    .container-register {
    	top: 39%!important;
    }

  
	nav .items,
	footer {
		display: none;
	}

	.btn-green-1 {
		height: 40px!important;
	}



</style>

@section('content')

<div class="super-container bg-photo-3">	
	<!-- Opacidad -->
	<div class="black-overlay"></div>
	<!-- Opacidad -->
	
	<div class="container-register" style="margin-top:0;">
		
		<h3 style="font-size: 15px;">Registro <b>YLMM</b></h3>
		
            <form class="form-register" id="form-register" action="{{ action('AdminController@setPasswordFan')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" id="selectedcountry" name="selectedcountry" value="">
			  <input type="hidden" id="selectedprovince" name="selectedprovince" value="">
              
         		<select class="input-type-1 select-type-1" required="required" data-type="string" id="country" name="country" style="margin-top: -0.5em;">
	                  <option value disabled selected>País</option>
	                  <option value="Argentina">Argentina</option>
	                  <option value="Uruguay">Uruguay</option>
	              </select><br>
	              
	              <select class="input-type-1 select-type-1 hidden" required="required" data-type="string" id="argprovince" name="argprovince" >
	                  <option value disabled selected>Provincia</option>
	                  <option value="Buenos Aires">Buenos Aires</option>
	                  <option value="Buenos Aires-GBA">Buenos Aires-GBA</option>
	                  <option value="Capital Federal">Capital Federal</option>
	                  <option value="Catamarca">Catamarca</option>
	                  <option value="Chaco">Chaco</option>
	                  <option value="Chubut">Chubut</option>
	                  <option value="Córdoba">Córdoba</option>
	                  <option value="Corrientes">Corrientes</option>
	                  <option value="Entre Ríos">Entre Ríos</option>
	                  <option value="Formosa">Formosa</option>
	                  <option value="Jujuy">Jujuy</option>
	                  <option value="La Pampa">La Pampa</option>
	                  <option value="La Rioja">La Rioja</option>
	                  <option value="Mendoza">Mendoza</option>
	                  <option value="Misiones">Misiones</option>
	                  <option value="Neuquén">Neuquén</option>
	                  <option value="Río Negro">Río Negro</option>
	                  <option value="Salta">Salta</option>
	                  <option value="San Juan">San Juan</option>
	                  <option value="San Luis">San Luis</option>
	                  <option value="Santa Cruz">Santa Cruz</option>
	                  <option value="Santa Fe">Santa Fe</option>
	                  <option value="Santiago del Estero">Santiago del Estero</option>
	                  <option value="Tierra del Fuego">Tierra del Fuego</option>
	                  <option value="Tucumán">Tucumán</option>
	              </select>
	              
	              <select class="input-type-1 select-type-1 hidden" required="required" data-type="string" id="departamentos" name="departamentos" >
	                  <option value disabled selected hidden>Departamentos</option>
	                  <option value="Artigas">Artigas</option>
	                  <option value="Canelones">Canelones</option>
	                  <option value="Cerro Largo">Cerro Largo</option>
	                  <option value="Colonia">Colonia</option>
	                  <option value="Durazno">Durazno</option>
	                  <option value="Flores">Flores</option>
	                  <option value="Florida">Florida</option>
	                  <option value="Lavalleja">Lavalleja</option>
	                  <option value="Maldonado">Maldonado</option>
	                  <option value="Montevideo">Montevideo</option>
	                  <option value="Paysandú">Paysandú</option>
	                  <option value="Río Negro">Río Negro</option>
	                  <option value="Rivera">Rivera</option>
	                  <option value="Rocha">Rocha</option>
	                  <option value="Salto">Salto</option>
	                  <option value="San José">San José</option>
	                  <option value="Soriano">Soriano</option>
	                  <option value="Tacuarembó">Tacuarembó</option>
	                  <option value="Treinta y Tres">Treinta y Tres</option>
	              </select>

              <button class="btn-green-1 fans-registration" type="button" name="ingresar" style="font-size: 12px;"><b>FINALIZAR</b></button>
            </form>

	</div>
</div>

@stop
@section('jsfunctions')
	<script type="text/javascript" src="../../js/registro.js"></script>
	<script type="text/javascript" src="../../js/general.js"></script>
@stop
