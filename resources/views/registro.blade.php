<!DOCTYPE html>
<html>
<head>
  <title>YLMM</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <link rel="icon" type="image/png" href="../../images/favicon.ico" sizes="32x32" />
  <link rel="stylesheet" type="text/css" href="../../css/plantilla.css">
  <link rel="stylesheet" type="text/css" href="../../css/loader.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/plantilla2.css">
  <link rel="stylesheet" type="text/css" href="../../css/registro.css">
  <link rel="stylesheet" type="text/css" href="../../css/components.css">
  <link rel="stylesheet" type="text/css" href="../../css/general.css">
  <link rel="stylesheet" type="text/css" href="../../css/ylmm-media.css">


  <style type="text/css">

      .messages{
        width: 100%;
        height: 100%;
        position: fixed;
        display: block;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
      }

  .messages .container {
    top: 50%;
      left: 50%;
      width: 30em;
      height: auto;
      padding: 2em;
      position: relative;
      background: black;
      transform: translate(-50%,-50%);
      border: 1px solid white;
  }
 
  .messages .container .close-messages {
      
      top: 5px;
      right: 5px;
      width: 30px;
      height: 30px;
      color: gray;
      padding-top: 5px;
      font-size: 16px;
      text-align: center;
      position: absolute;
      cursor: pointer;
      background: url(../../images/close.png)no-repeat;
      background-size: cover;
  }

  .messages .container .message-image {
    width: 100%;
    height: auto;
    margin-top: 1em;
    text-align: center;
  }

  .messages .container .message-image img{ 
    width: auto;
  }

  .messages .container p{
    color: white; 
    margin-top: 1em;
  }
    
    input.error,
    select.error  {
      border: 1px solid #ff3131;
    }

    input.success,
    select.success {
      border: 1px solid #6bff6b;
    }

    footer {
      display: none;
    }

    .social-container  .btn-social span {
      width: 60%!important;
    }

    .social-container  .btn-social span,
    .social-container  .btn-social {
      text-align: center;
    }

    .arrow-back{
	    text-align: center;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	    width: 2em;
	    height: 2em;
	    cursor: pointer;
	    background: url(../../images/resources/back_a.png);
	    background-size: 100% 100%;
    }

  .arrow-back:hover{
    transition: 1s ease-in-out;
    background: url(../../images/resources/back_b.png);
    background-size: 100% 100%;
  }

    input.placeholder-color::-moz-placeholder { 
    color:white!important; background-color:rgba(0,0,0,0.5);  
      opacity: 1;
  }

  </style>

</head>

<body>
  <nav style="background: black;">
    <div class="logo">
      <a href="javascript:;">
        <div class="img-logo"></div>
      </a>
    </div>
  
  </nav>

<?php if (isset($_GET['msg'])) { ?>
  <?php $msg = $_GET['msg'];
    if ($msg == 3) { ?>
    <div class="messages">
	  <div class="container">
	    <div class="close-messages"></div>
	    <p style="text-align: center;">Debe llenar todos los campos.<br></p>
	    <div class="message-image">
	      <img  src="../../images/resources/logo_sm.png">
	    </div>
	  </div>
	</div>
  <?php }if ($msg == 2) { ?>
     <div class="messages">
	  <div class="container">
	    <div class="close-messages"></div>
	    <p style="text-align: center;">Este Email ya ha sido registrado. Por favor, intente con otro diferente.<br></p>
	    <div class="message-image">
	      <img  src="../../images/resources/logo_sm.png">
	    </div>
	  </div>
	</div>
  <?php } ?>
<?php } ?>

  <div class="super-container bg-photo-2">  
    <!-- Opacidad -->
    <div class="black-overlay"></div>
    <!-- Opacidad -->
    
    <div class="container-register">
      
      <h3>Registro <b>YLMM</b></h3>
      
      <form class="form-register" id="form-register" action="{{ action('AdminController@creator') }}" method="post" role="form" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="selectedcountry" name="selectedcountry" value="">
        <input type="hidden" id="selectedprovince" name="selectedprovince" value="">
        
        <input type="text" name="name" placeholder="Nombre y Apellido" data-type="string" class="placeholder-color">
        <input type="text" name="email" placeholder="Email" data-type="email" class="placeholder-color">
        
        <select data-type="string" name="type">
          <option value="" disabled selected>¿Sos músico o fan?</option>
          <option value="F">Fan</option>
          <option value="B">Músico</option>
        </select>
      
        <select data-type="string" name="id_genre[]">
          <option value="" disabled selected>¿Qué géneros musicales te interesan?</option>
            @foreach($genres as $genero)
              <option value="{{ $genero->id }}">{{ $genero->name }}</option>                   
            @endforeach
        </select>

        <select data-type="string" id="country" name="country">
          <option value="" disabled selected>País</option>
          <option value="Argentina">Argentina</option>
          <option value="Uruguay">Uruguay</option>
        </select>

        <select data-type="string" id="argprovince" name="argprovince" style="display: none;">
          <option value disabled selected hidden>Provincia</option>
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

       <select data-type="string" id="departamentos" name="departamentos" style="display: none;">
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
      	
      	<input type="text" name="zipcode" id="zipcode" placeholder="Código Postal" data-type="number" class="placeholder-color" style="display: none;">
        <input type="password" class="pw1 placeholder-color" name="password" placeholder="Clave" data-type="password">
        <input type="password" class="pw2 placeholder-color" name="confirm_password" placeholder="Repetir Clave" data-type="password">
        
        <button class="btn-purple">REGISTRARME</button>

      </form>

      <div class="login-box left">
      
        <!-- Facebook Connect -->
        <div class="social-container " style="margin: 0!important;">
          <div class="social-inner-container" style="margin-top:0;">
              <a class="btn-social btn-fb" href="redirect/facebook">
                  <span> Sign in with Facebook</span>
              </a>
          </div>
        </div>
        <!-- Facebook Connect -->
      

        <!-- Google Connect -->
        <div class="social-container " style="margin: 0!important;">
          <div class="social-inner-container" style="margin-top:0;">
              <a class="btn-social btn-google" href="redirect/google">
                <span> Sign in with Google Plus</span>
              </a>
            </div>
        </div> 
        <!-- Google Connect -->
<!--
        <div class="bottom-back" style="margin-top:2em;">
          <a href="/">Volver</a>
        </div> -->
      
      <div class="bottom-back" style="position: relative;">
        <div class="arrow-back">
          
        </div>
      </div>

      </div>

    </div>
  </div>

<!-- Nuevo Footer -->
<footer>
  <div class="sponsors">
    <div class="logos">
        <ul class="sponsors-list">
          
          @foreach($sponsors as $sponsor)
          <li>
                <a href="{{$sponsor->url}}" target="_blank">
                  <img class="logo" src="../..{{$sponsor->image}}" alt=" " />
                </a>
          </li>
          @endforeach
   
      </ul>
    
    </div>

  </div>

   <p>© YLMM -You Love My Music- <script>document.write(new Date().getFullYear())</script>. Contacto info@youlovemymusic.com </p>

</footer>

  <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>

    <script type="text/javascript" src="../../js/general.js"></script>

    <script type="text/javascript">

    $('.bottom-back').on('click', function () {
	  window.location.href = "http://localhost:8000/";
	});

    $('#country').on('change', function (){

	  var z = $( "#country option:selected" ).text();

	  if (z === 'Argentina') {

	    $('#argprovince').css('display', 'block');
	    $('#argprovince').toggleClass('hidden');
	    $('#departamentos').css('display', 'none');
	    $('#selectedcountry').val('Argentina'); 
	  
	  }else if(z === 'Uruguay'){
	  
	    $('#departamentos').css('display', 'block');
	    $('#departamentos').toggleClass('hidden');
	    $('#argprovince').css('display', 'none');
	    $('#selectedcountry').val('Uruguay');
	  }

	  $('#zipcode').css('display', 'block');

	});


$('#argprovince').on('change', function (){

  var y = $( "#argprovince option:selected" ).text();

    $('#selectedprovince').val(y); 
  

});

$('#departamentos').on('change', function (){

  var x = $( "#departamentos option:selected" ).text();

    $('#selectedprovince').val(x);

});


$('.close-messages').on('click', function () {
  $('.messages').css('display', 'none');
});
    </script>

</body>
</html>