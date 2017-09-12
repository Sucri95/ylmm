@extends('layouts.layout')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../css/registro.css">
<link rel="stylesheet" type="text/css" href="../../css/custom-select.css">
<style type="text/css">
    input.error,
    select.error  {
      border: 1px solid #ff3131!important;
    }

    input.success,
    select.success {
      border: 1px solid #6bff6b!important;
    }

	footer {
	    display: none;
	}

	.select2.select2-container.select2-container--default{
		font-size: 12px;
	}

	.container-register{
		top: 0!important;
	    left: 0!important;
	    float: none!important;
	    transform: none!important;
	    float: none!important;
	    margin: 4em auto!important;
	    position: relative!important;
	}
	.select2-selection__rendered{
		margin-left: 0!important;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    	font-size: 12px!important;
    	width: 100%;
    	margin: 0.2em 0.5em!important;
    	border-radius: 4px!important;
    	padding-right: 2em!important;
	}

  .select2-container--default .select2-search--inline .select2-search__field,
  .input-type-1{
    caret-color: transparent;
  }
  
  .select2-container--default .select2-selection--multiple,
  .select2-container--default.select2-container--focus .select2-selection--multiple {
  	margin-top: 0px!important;
  }

  input::-moz-placeholder { 
    color:white!important; background-color:rgba(0,0,0,0);  
    opacity: 1;
  }
  input#input-buscador::-moz-placeholder { 
    color:#757575!important; background-color:white;  
      opacity: 1;
  }

  @-moz-document url-prefix() {

	nav .items ul.main-menu li:nth-child(1) ul.user-sub-menu{
		margin-top: 7.5px!important;
	}
  }
</style>

@section('content')
 <?php $genres = DB::table('genres')->get(); ?>


	<div class="super-container bg-photo-3">	
		<!-- Opacidad -->
		<div class="black-overlay"></div>
		<!-- Opacidad -->
		
		<div class="container-register">
			
			<h3 style="font-size: 15px;">Registro de Músico <b>YLMM</b></h3>
			
			<form class="form-register" action="{{ action('MusicianController@musicianRegistration') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" id="selectedcountry" name="selectedcountry" value="">
			<input type="hidden" id="selectedprovince" name="selectedprovince" value="">
				
				<input type="text" name="name" placeholder="Nombre Artistico" data-type="string" value="{{Auth::user()->name}}">
	
				<select class="js-example-disabled-results" id="register-genero" name="id_genre[]" multiple="multiple" data-type="string">
                  @foreach($genres as $genero)
                    <option value="{{ $genero->name }}">{{ $genero->name }}</option>                   
                  @endforeach
                  	<option value="OTRO">OTRO</option>
				</select>

				<input class="input-type-1 input-type-4"  style="display: none;" id="other" name="other" placeholder="¿Cuál?">

				<select class="js-example-disabled-results" id="register-rol" multiple="multiple" name="role[]" data-type="string">
					<option value="VOZ">Voz</option>
	                  <option value="CORO">Coro</option>
	                  <option value="PIANO">Piano</option>
	                  <option value="TECLADOS">Teclados</option>
	                  <option value="GUITARRA">Guitarra</option>
	                  <option value="BAJO">Bajo</option>
	                  <option value="BATERÍA">Batería</option>
	                  <option value="PERCUSIÓN">Percusión</option>
	                  <option value="CUERDA">Cuerda</option>
	                  <option value="VIENTO">Viento</option>
	                  <option value="OTRO">Otro</option>
	                  <option value="PRODUCTOR MUSICAL">Productor musical</option>
				</select>

				<input class="input-type-1 input-type-4"  style="display: none;" id="cuerda" name="cuerda" placeholder="¿Qué tipo de cuerda?">
                <input class="input-type-1 input-type-4"  style="display: none;" id="viento" name="viento" placeholder="¿Qué tipo de viento?">
                <input class="input-type-1 input-type-4"  style="display: none;" id="otro" name="otro" placeholder="¿Cuál?">

                <?php if (is_null(Auth::user()->country) && is_null(Auth::user()->province)) { ?>

                <select class="js-example-disabled-results" id="register-pais" data-type="string">
				 	<option value="" disabled selected>Pais</option>
					<option value="Argentina">Argentina</option>
					<option value="Uruguay">Uruguay</option>
				</select>

				<select class="js-example-disabled-results hidden" id="register-provincia" data-type="string" name="argprovince">
				 	<option value="" disabled selected>Provincia</option>
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

				<select class="js-example-disabled-results hidden" id="departamentos" name="departamentos" data-type="string">
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
               
	
                <?php } ?>
              
				<button class="btn-purple">REGISTRARME</button>

			</form>


		</div>
	</div>

@stop
@section('jsfunctions')


<script
  	src="https://code.jquery.com/jquery-3.2.1.min.js"
  	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  	crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  	<script type="text/javascript" src="../../js/general.js"></script>
  	

  	<script type="text/javascript">

  		$('select#register-genero').select2({
  			placeholder: "Género Musicales",
  			//maximumSelectionLength: 1,
  			allowClear: true
  		});

  		$('select#register-rol').select2({
  			placeholder: "Instrumentos",
  			//maximumSelectionLength: 1,
  			allowClear: true
  		});
  	
  	</script>


<script type="text/javascript">

$(document).on('ready', function() {
	
	$('.select2-search__field').mousedown(function(e){
	  e.preventDefault();
	  $(this).blur();
	  return false;
	});

});

	$("#register-rol").on("change", function () {

		$(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-selection__choice').css("cssText", "width: auto !important;");

		$(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-search.select2-search--inline').css("cssText", "width: auto !important;");


	    var z = $(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-search').children('.select2-search__field');

	    var li = $(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-selection__choice');

	    if ($(li).length > 0) {

	      $(z).css("cssText", "display: none !important;");

	    }else{

	      $(z).css("cssText", "display: block !important;");
	    }
	  
	  setTimeout(function(){
	  
	  var j = $(".select2-selection__choice");
	      $(j).each( function(index, item) {

	        var yu = $(item).text();
	         var yus = yu.split("×");

	         if (yus[1] === 'Cuerda') {
	              
	              $('#cuerda').css('display', 'block');
	              
	              if ($('#viento').val() === '') {

	                $('#viento').css('display', 'none');

	              }
	              if ($('#otro').val() === '') {

	                $('#otro').css('display', 'none');
	                
	              }

	              
	            }

	             if (yus[1] === 'Viento') {

	              $('#viento').css('display', 'block');

	              if ($('#otro').val() === '') {

	                $('#otro').css('display', 'none');
	                
	              }
	              if ($('#cuerda').val() === '') {

	                $('#cuerda').css('display', 'none');
	                
	              }
	            }

	             if (yus[1] === 'Otro') {
	              $('#otro').css('display', 'block');
	              
	              if ($('#viento').val() === '') {

	                $('#viento').css('display', 'none');

	              }
	              
	              if ($('#cuerda').val() === '') {

	                $('#cuerda').css('display', 'none');
	                
	              }
	            }
	      });

	 }, 300);
	});

	$("#register-genero").on("change", function () {

		$(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-selection__choice').css("cssText", "width: auto !important;");

		$(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-search.select2-search--inline').css("cssText", "width: auto !important;");

		
	    var z = $(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-search').children('.select2-search__field');

	    var li = $(this).siblings('.select2').children('.selection').children('.select2-selection').children('.select2-selection__rendered').children('.select2-selection__choice');

	    if ($(li).length > 0) {

	      $(z).css("cssText", "display: none !important;");

	    }else{

	      $(z).css("cssText", "display: block !important;");
	    }
	  
	  setTimeout(function(){
	  
	  var j = $(".select2-selection__choice");
	      $(j).each( function(index, item) {

	        var yu = $(item).text();
	         var yus = yu.split("×");


	             if (yus[1] === 'OTRO') {
	              $('#other').css('display', 'block');
	              
	            }
	      });

	 }, 300);
	});
	
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript" src="../../js/registrations.js"></script>
@stop