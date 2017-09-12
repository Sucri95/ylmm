
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../../css/registrations.css">

@extends('layouts.layout')


<style type="text/css">

  #validateSubmitForm > div > section > div > div.form-login.registro.my-center > div > div > span,
  #validateSubmitForm > div > section > div > div.form-login.registro.my-center > span:nth-child(3),
  .btn-purple {
    width: 422px!important;
  }
  
  .btn-purple{
    margin: 1px 0 1em 0!important;
  }
 
  .select2-container--default.select2-container--focus .select2-selection--multiple {
    height: auto;
    min-height: 55px;
    border: 1px solid white;
    padding-bottom: 1em;
      
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
  }


  .select2-container--default .select2-selection--multiple .select2-selection__choice {
      color: white;
      border: none;
      border-radius: 0px;
      background: -webkit-linear-gradient(-45deg, #e42693, #6e39a6);
  }

  .select2-selection__rendered{
    margin-left: -8px!important;
  }

  nav .items ul.main-menu  li:nth-child(1) ul.user-sub-menu{
    margin-top: 6.5px!important;
  }

  .inputs-hidden{
    margin: 0px 0px 0px 0px;
    display: none; 
    float: right;
  }



  @media(max-width: 650px) {

  .inner.my-text-center.formulario {
    width: 80%;
  }

    .input-type-1 {
      height: 47px!important;
    }

    .btn-purple {
      width: 100%!important;
    }


    #validateSubmitForm > div > section > div > div.form-login.registro.my-center > div > div > span,
    #validateSubmitForm > div > section > div > div.form-login.registro.my-center > span:nth-child(3){
      width: 100%!important;
      margin-bottom: 0.5em;
    }

    .buscador {
      width: 100%!important;
    }    

  }

  footer {
	    display: none;
	}


  .buscador {
    bottom: 0;
  }

 .main-menu  .buscador {
  top: 25px;
  bottom: auto;
 }

  .buscador ul{ 
    width: 100%;
    float: left;
    background: white!important;
    position: absolute;
    
  } 

.form-login.registro.my-center .integrante .buscador.buscador-integrantes {
    bottom: 5%!important;
    transform: translateY(-20%);
    z-index: 9999;
}

.inner.my-text-center.formulario {
  top: 42%;
  left: 50%;
  margin: 0!important;
  position: absolute;
  transform: translate(-50%,-50%);
}

.boton {
  top: 0%;
  transform: translate(-56%,-284%);
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    font-size: 12px!important;
    width: auto!important;
    margin: 0.2em 0.5em!important;
    border-radius: 4px!important;
    padding-right: 2em!important;
}

  .select2-container--default .select2-search--inline .select2-search__field,
  .input-type-1{
    caret-color: transparent;
  }

  input::-moz-placeholder { 
    color:white!important; background-color:rgba(0,0,0,0);  
    opacity: 1;
  }
  input#input-buscador::-moz-placeholder { 
    color:#757575!important; background-color:white;  
      opacity: 1;
  }
</style>



@section('content')

<form id="validateSubmitForm" class="form-horizontal margin-none" action="{{ action('BandController@creator') }}" method="post" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="rolcontaner" value="">
<input type="text" id="user_array" name="user_array" style="display: none;">
<input type="text" id="qcuerdas" name="qcuerdas" style="display: none;">
<input type="text" id="qvientos" name="qvientos" style="display: none;">
<input type="text" id="qotros" name="qotros" style="display: none;">
<input type="text" id="number_array" name="number_array" style="display: none;">
<input type="hidden" id="selectedcountry" name="selectedcountry" value="">
<input type="hidden" id="selectedprovince" name="selectedprovince" value="">
<div class="container" style="position: relative;">

<section class="login bands" style="position: relative;">
  <div class="inner my-text-center formulario" >
      <div class="inner-top">
        <h1 style="font-size: 15px;">Registro de Bandas <b>YLMM</b></h1>
        <div class="login-green-bar my-center"></div>
      </div>

          <div class="form-login registro my-center" style="padding-top:0px!important; width: 28%;">

              <input class="input-type-1" type="text" id="name" name="name" data-type="string" required="required" placeholder="Nombre de Banda">

               <select class="js-example-basic-multiple" multiple="multiple" data-type="string" id="register-genero" name="id_genre[]" style="margin-top: 1.3em; font-size: 14px;">
                  @foreach($genres as $genero)
                    <option value="{{ $genero->name }}">{{ $genero->name }}</option>                   
                  @endforeach
                    <option value="OTRO">OTRO</option>
              </select>
              <br>

              <input class="input-type-1 input-type-4"  style="display: none;" id="other" name="other" placeholder="¿Cuál?">
              <br>

              
              <div id="integrante" class="integrante" style="font-size: 14px;"> </div>
              
              <button class="btn-purple" type="button" name="ingresar" onclick="submit();"><b>FINALIZAR</b></button>
              </br></br></br>

          </div>
  </div>
</section>
</div>
</form>
@stop
@section('jsfunctions')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script type="text/javascript" src="../../js/registrations.js"></script>
  <script type="text/javascript" src="../../js/general.js"></script>

@stop