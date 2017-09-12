@extends('layouts.walls')

<script src="../../js/jquery-2.2.4.min.js" ></script>
<link rel="stylesheet" type="text/css" href="../../css/bandsedit.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<style type="text/css">	
	.select2-search__field,
	.select2-container {
		width: 100%!important;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
		width: auto!important;
		padding: 0.4em 0.5em!important;
	}

	.btn-edit-member{
		right: 0;
	    float: right;
	    border: none;
	    color: white;
	    cursor: pointer;
	    font-size: 12px;
	    letter-spacing: 1px;
	    background: -webkit-linear-gradient(-45deg, #e42693 , #6e39a6);
	    font-weight: bold;
	    position: absolute;
	    text-transform: uppercase;
	    padding: 0.4em 1em 0.4em 1em;
	}

	.select2-container--default .select2-selection--multiple {
    	padding-top: 0.54em;
	 	background: rgba(165, 165, 165, 0.5)!important;
   }

   .select2-container--default.select2-container--focus .select2-selection--multiple {
   	    border: solid #fff1f1 1px;
   }
@media all and (-ms-high-contrast:none)
 {
   .select2-container--default .select2-search--inline .select2-search__field{
    	color: white!important;
   }
 }
@-moz-document url-prefix() {

	.container-register select{
		text-indent: 3px!important;
	}
}
input.placeholder-color::-moz-placeholder { 
	color:white!important; background-color:rgba(0,0,0,0.5);  
    opacity: 1;
}

#about-container{
	padding-top: 0; 
	margin-bottom: 15em; 
	margin-top: -1.5em;
}

@media(max-width: 650px){
	#about-container{
		margin-top: -3.5em;
	}	
}

</style>


@section('content')


<div id="about-container" class="container">

	<?php if (isset($_GET['idmusic'])) {
      $id = $_GET['idmusic'];
	    $musician = DB::table('musicians')->find($id);
      $merge[] = '';
	}?>
	<div class="inner my-text-center">
		<div class="inner-top">
				<div class="login-green-bar my-center"></div>
		        	<div class="social-container bands-informacion">
		                <?php if (!is_null($musician->about)) { ?>

			                <div class="text-band-container">
			                  
			                   	<p class="text-band">
			                      	<span class="show-about">{{$musician->about}}</span> 
			                 
					                <?php if (Auth::user()->id_musician == $musician->id) { ?>
					                    <div class="btn-edit"></div>
					                <?php } ?>
					            </p>
			                  
			                 
			                </div>

		                <?php }else{ ?>

							<?php if ($musician->id == Auth::user()->id_musician) { ?>
							
							<div class="edit-about">
				            <p><span>Comentanos sobre tus inicios</span></p>
			                    <form id="about-set" action="{{ action('MusicianController@setAbout')}}" method="post">
				                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				                    <input type="hidden" name="id_music" value="{{ $musician->id }}">
				                    <div class="create-coment" style="height: 10.4em; width: 100%;">
				                       <textarea class="user-post-area" id="setabout" name="setabout"></textarea>
				                       <button class="submit_btn btn-setabout" type="submit">Finalizar</button>
				                    </div>
				                </form>
			                </div>
			                
			                <?php } ?>

		                <?php } ?>

                		<?php if ($musician->id == Auth::user()->id_musician) { ?>

			                <div class="edit-about hidden">
				            <p><span>Comentanos sobre tus inicios</span></p>
			                    <form id="about-set" action="{{ action('MusicianController@setAbout')}}" method="post">
				                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				                    <input type="hidden" name="id_music" value="{{ $musician->id }}">
				                    <div class="create-coment" style="height: 10.4em; width: 100%;">
				                       <textarea class="user-post-area" id="setabout" name="setabout">{{$musician->about}}</textarea>
				                       <button class="submit_btn btn-setabout" type="submit">Finalizar</button>
				                    </div>
				                </form>
			                </div>

                		<?php } ?>

		            </div>


					<?php $roles = unserialize($musician->role);
						$countrol = count($roles);
							if ($countrol == 1) { ?>

								<h4><b class="about-title">Instrumento</b></h4>

							<?php }else{ ?>

								<h4><b class="about-title">Instrumentos</b></h4>

							<?php } ?>

							<div class="text-band-container instrumentos" style="margin-bottom: 2%;">
								<p class="text-band roles">
						        	@foreach($roles as $rol)
							           	<?php if ($rol != '0') { ?>
							       			<span class="show-role">{{$rol}} -</span> 
							           	<?php } ?>
							       	@endforeach
							      	<br>
									
									<?php if (Auth::user()->id_musician == $musician->id) { ?>
								    	<div class="btn-edit-role"></div>
									<?php } ?>


							    </p>
								
							
						        <?php if ($musician->id == Auth::user()->id_musician) { ?>
						        	<form id="editRolesForm" class="editRoles hidden" action="{{ action('MusicianController@editInstruments')}}" method="post">
							            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							            <input type="hidden" name="id_musician" value="{{ $musician->id }}">
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

					                      	<input class="input-type-1 input-type-4"  style="display: none; width: 100%;" id="cuerda" name="cuerda" placeholder="¿Qué tipo de cuerda?">
								            <input class="input-type-1 input-type-4"  style="display: none; width: 100%;" id="viento" name="viento" placeholder="¿Qué tipo de viento?">
								            <input class="input-type-1 input-type-4"  style="display: none; width: 100%;" id="otro" name="otro" placeholder="¿Cuál?">
							                      	
							                <button id="editRoleButton" class="btn-edit-member">FINALIZAR</button>

						            </form>
					            <?php } ?>
					        </div>

					<?php $genre = unserialize($musician->genres);
						$countgenre = count($genre);
						if ($countgenre == 2) { ?>
							<h4><b class="about-title">Género</b></h4>
						<?php }else{ ?>
							<h4><b class="about-title">Géneros</b></h4>
						<?php } ?>

						<div class="text-band-container genres">
							<div class="social-container genres">
								<span class="show-genres">
									@foreach($genre as $g)
										<?php if ($g != '0') { ?>
									    	{{$g}} -
									     <?php } ?>
								    @endforeach
							
							    </span>

								<?php if (Auth::user()->id_musician == $musician->id) { ?>
									<div class="btn-edit-genre"></div>
								<?php } ?>

							</div>
							<?php if ($musician->id == Auth::user()->id_musician) { ?>
								<form id="EditGenresForm" class="editGenres hidden" action="{{ action('MusicianController@editGenreMusician')}}" method="post" style="width: 40em; float: none; margin: 0 auto;">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								    <input type="hidden" name="id_musician" value="{{ $musician->id }}">
								    <select class="js-example-basic-multiple" multiple="multiple" data-type="string" id="register-genero" name="id_genre[]" style="margin-top: 1.3em; font-size: 14px;">
								        <?php $genres = DB::table('genres')->get(); ?>
								        	@foreach($genres as $genero)
								                <option value="{{ $genero->name }}">{{ $genero->name }}</option>                   
								            @endforeach
								            	<option value="OTRO">OTRO</option>
								    </select>
								    <br>
								    <input class="input-type-1 input-type-4"  style="display: none; width: 100%;" id="other" name="other" placeholder="¿Cuál?">
								    <button id="EditGenreButton" class="btn-edit-member" type="button">FINALIZAR</button>
							    </form>
						    <?php } ?>
						</div>
    	</div>
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
  			placeholder: "Géneros musicales",
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
//---------------------Submit Form ---------------------------//

$(document).on('click', '#buttonAbout', function(e) {
        e.preventDefault();
        var texto = $('#about').val();

        if (texto != '') {
            $('#EditAboutForm').submit();
        }
});

$(document).on('click', '#EditGenreButton', function(e) {
        e.preventDefault();

        var select = $('.select2-selection__choice').text();

        if (select != '') {
			
			$('#EditGenresForm').submit();

        }
});

$(document).on('click', '#editRoleButton', function(e) {
        e.preventDefault();
        
        var select = $('.select2-selection__choice').text();

        if (select != '') {
			
			$('#editRolesForm').submit();

        }
});
//---------------------Submit Form ---------------------------//


//---------------------Edit About ---------------------------//
/*
   $('.social-container.bands-informacion').on('mouseenter', function(){

      $('.btn-edit').css("display", "block");

    })
   .on('mouseleave',function(){
      $('.btn-edit').css("display", "none");
   });*/

   $('.btn-edit').on('click', function (){
     $('.edit-about').toggleClass('hidden');
     $('.show-about').toggleClass('hidden');
   });
//---------------------Edit About ---------------------------//

//---------------------Edit Role ---------------------------//
/*
    $('.text-band-container.instrumentos').on('mouseenter', function(){

      $('.btn-edit-role').css("display", "block");

    })
   .on('mouseleave',function(){
      $('.btn-edit-role').css("display", "none");
   }); */

    $('.btn-edit-role').on('click', function (){
    	$('.text-band.roles').toggleClass('hidden');
    	$('.editRoles').toggleClass('hidden');

    	if ($('.select2-container--default .select2-selection--multiple .select2-selection__rendered li').text() == '') {
        	$('.select2-container--default .select2-selection--multiple .select2-selection__rendered li').css("cssText", "width: 100% !important;");
    	}
   });

//---------------------Edit Role ---------------------------//

//---------------------Edit Genres ---------------------------//
/*
    $('.text-band-container.genres').on('mouseenter', function(){

      $('.btn-edit-genre').css("display", "block");

    })
   .on('mouseleave',function(){
      $('.btn-edit-genre').css("display", "none");
   });
*/
    $('.btn-edit-genre').on('click', function (){
    	$('.show-genres').toggleClass('hidden');
    	$('.editGenres').toggleClass('hidden');
   });

//---------------------Edit Genres ---------------------------//

//---------------------Display role options ----------------//
  $("#register-rol").on("change", function () {

  	$('.select2-container--default .select2-selection--multiple .select2-selection__rendered li').css("cssText", "width: auto !important;");


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
//---------------------Display role options----------------//

//---------------------Display genres options ----------------//
  $("#register-genero").on("change", function () {

  	$('.select2-container--default .select2-selection--multiple .select2-selection__rendered li').css("cssText", "width: auto !important;");

  	
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
//---------------------Display genres options ----------------//

/*-------------------------Delete Tags----------------------------*/
	$(document).on('click', '.select2-selection__choice' ,function() {

		var title = $(this).text();
		title = title.split("×");

		if (title[1] === 'OTRO') {

			$('#other').css('display', 'none');
			$('#other').val('');

		}


		if (title[1] === 'Otro') {

			$('#otro').css('display', 'none');
			$('#otro').val('');

		}


		if (title[1] === 'Cuerda') {

			$('#cuerda').css('display', 'none');
			$('#cuerda').val('');

		}


		if (title[1] === 'Viento') {

			$('#viento').css('display', 'none');
			$('#viento').val('');

		}
		
	});
/*-------------------------Delete Tags----------------------------*/
</script>

<script type="text/javascript" src="../../js/bandsedit.js"></script>

@stop
