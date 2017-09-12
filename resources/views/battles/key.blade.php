@extends('layouts.battles')

<style type="text/css">
	.titlekey{
      text-indent: 0px!important;
	    text-align: center;
	    color: #fff!important;
      width: 100%;
      font-size: 20px!important;
	}

	.statuskey{
    width: 100%;
		font-size: 12px;
	}
  .key-container{
    position: relative;
    margin: 0 4.5em;
  }
  .info-text {
    padding: 4em 4em!important;
    color: white;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>

@section('content')

<div class="title-battles"><h1 class="battles-title">Batalla de Bandas</h1></div>
    <div class="video-container my-text-center" style="float: left; margin-bottom: 4em;">
      <div class="slider-row profile my-center content-llaves" style="float: none!important; margin: 3em auto 0 auto!important; width: 90%;">
 		<?php $very = DB::table('pv_uservotes')
              				->where('id_user', Auth::user()->id)
              				->where('llave', '1')
              				->get(); 
        if ($very == '[]') { ?>
         <a href="/battles/firstkey">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 1</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave1.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;" style="cursor: default;">
         <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 1</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Ingresá a las otras y ayudá a elegir al ganador.</h2>
            </div>
            <img class="img-battle-key"  src="../../images/llave1.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
        <?php $very = DB::table('pv_uservotes')
              				->where('id_user', Auth::user()->id)
              				->where('llave', '2')
              				->get(); 
        if ($very == '[]') { ?>
        <a href="javascript:;" style="cursor: default;">
         <!--<a href="/battles/secondkey">-->
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 2</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave2.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 2</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Ingresá a las otras y ayudá a elegir al ganador.</h2>
            </div>
            <img class="img-battle-key"  src="../../images/llave2.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
        <?php $very = DB::table('pv_uservotes')
              				->where('id_user', Auth::user()->id)
              				->where('llave', '3')
              				->get(); 
        if ($very == '[]') { ?>
        <a href="javascript:;" style="cursor: default;">
         <!--<a href="/battles/thirdkey">-->
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 3</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave3.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 3</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Ingresá a las otras y ayudá a elegir al ganador.</h2>
            </div>
            <img class="img-battle-key" src="../../images/llave3.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
        		<?php $very = DB::table('pv_uservotes')
              				->where('id_user', Auth::user()->id)
              				->where('llave', '4')
              				->get(); 
        if ($very == '[]') { ?>
        <a href="javascript:;" style="cursor: default;">
         <!--<a href="/battles/fourthkey">-->
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 4</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave4.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 4</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Ingresá a las otras y ayudá a elegir al ganador.</h2>
            </div>
            <img class="img-battle-key"  src="../../images/llave4.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
 		<?php $very = DB::table('pv_uservotes')
      				->where('id_user', Auth::user()->id)
      				->where('llave', '5')
      				->get(); 
        if ($very == '[]') { ?>
        <a href="javascript:;" style="cursor: default;">
         <!--<a href="/battles/fifthkey">-->
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 5</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave5.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 5</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Ingresá a las otras y ayudá a elegir al ganador.</h2>
            </div>
            <img class="img-battle-key" src="../../images/llave5.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
 		<?php $very = DB::table('pv_uservotes')
      				->where('id_user', Auth::user()->id)
      				->where('llave', '6')
      				->get(); 
        if ($very == '[]') { ?>
        <a href="javascript:;" style="cursor: default;">
         <!--<a href="/battles/sixthkey">-->
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 6</h1>
              	<h2 class="statuskey"></h2>	
            </div>
            <img class="img-battle-key"  src="../../images/llave6.png" alt="">
          </div>
        </a>
        </br>  	
		<?php }else{ ?>
		<a href="javascript:;">
          <div class="key-container">
            <div class="info-text"> 
              <h1 class="titlekey">LLAVE 6</h1>
              <h2 class="statuskey">Ya votaste a las bandas de esta llave. Esperá para conocer el ganador.</h2>
            </div>
            <img class="img-battle-key" src="../../images/llave6.png" alt="">
          </div>
        </a>
        </br>
        <?php } ?>
      </div>
    </div>

@stop

@section('jsfunctions')

<script type="text/javascript">
/*
$( window ).resize(function() {
	
	var windowsize = $(window).width();

  if (windowsize < 850) {

    $(".statuskey").each(function(index) {
      
      if ($(this).text().trim()) {

        $(this).siblings(".titlekey").css("cssText", "font-size: 15px !important;");
        $(this).css("cssText", "font-size: 9px !important;");
        $(this).parent(".info-text").css("cssText", "padding: 3em 3em !important;");
      
      }else{
        
        $(this).parents('.info-text').css("cssText", "padding: 2em 1em !important;");
        $(this).prev().css("cssText", "font-size: 15px !important;");
        $(this).css("cssText", "font-size: 8px !important;");

      }
    });

  }else{

    $(".statuskey").each(function(index) {
      
      if ($(this).text().trim()) {

        $(this).siblings(".titlekey").css("cssText", "font-size: 20px !important;");
        $(this).css("cssText", "font-size: 12px !important;");
        $(this).parent(".info-text").css("cssText", "padding: 1em 2em !important;");
      
      }else{

        $(this).parents('.info-text').css("cssText", "padding: 3em 1em !important;");

      }
    });

  }

});
*/
$(document).ready(function() {

 var windowsize = $(window).width();

  if (windowsize < 850) {

    $(".statuskey").each(function(index) {
      
      if ($(this).text().trim()) {

        $(this).siblings(".titlekey").css("cssText", "font-size: 15px !important;");
        $(this).css("cssText", "font-size: 9px !important;");
        $(this).parent(".info-text").css("cssText", "padding: 1em 3em !important;");
      
      }else{
        
        $(this).parents('.info-text').css("cssText", "padding: 2em 1em !important;");
        $(this).prev().css("cssText", "font-size: 15px !important;");
        $(this).css("cssText", "font-size: 8px !important;");

      }
    });

  }else{

    $(".statuskey").each(function(index) {
      
      if ($(this).text().trim()) {

        $(this).siblings(".titlekey").css("cssText", "font-size: 20px !important;");
        $(this).css("cssText", "font-size: 12px !important;");
        $(this).parent(".info-text").css("cssText", "padding: 3em 2em !important;");
      
      }else{

        $(this).parents('.info-text').css("cssText", "padding: 4em 1em !important;");

      }
    });

  }
});

</script>

<script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop