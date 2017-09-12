<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <title>YLMM</title>
  <link rel="icon" type="image/png" href="../../images/favicon.ico" sizes="32x32" />
  <link rel="stylesheet" type="text/css" href="../../css/plantilla.css">
  <link rel="stylesheet" type="text/css" href="../../css/loader.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  
  <link rel="stylesheet" type="text/css" href="../../css/plantilla2.css">
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

  .container-medium{
      top: 0!important;
      left: 0!important;
      float: none!important;
      transform: none!important;
      float: none!important;
      margin: 4em auto!important;
      position: relative!important;
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

  @supports (overflow:-webkit-marquee) and (justify-content:inherit) {
  	h4{
  		font-weight: 400;
  	}
  }

 </style>

</head>
<body>

<?php $sponsors = DB::table('sponsors')->get(); ?>
  <?php if (isset($_GET['var'])) {
    $var = $_GET['var'];
  }?>

<?php if (isset($_GET['msg'])) { ?>

<?php $msg = $_GET['msg'];
if ($msg == 7) { ?>
  <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
      <p style="text-align: center;">Usuario o clave inválida<br></p>
      <div class="message-image">
        <img  src="../../images/resources/logo_sm.png">
      </div>
    </div>
  </div>
 <?php }if ($msg == 8) { ?>
   <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
      <p style="text-align: center;">Su email no ha sido verificado, por favor dirígase a su correo electrónico.<br></p>
      <div class="message-image">
        <img  src="../../images/resources/logo_sm.png">
      </div>
    </div>
  </div>
 <?php }
 if ($msg == 9) { ?>
   <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
      <p style="text-align: center;">La configuración de tu cuenta de Facebook no permite el registro en YLMM. Por favor, intentá configurarla o registrate directamente.<br></p>
      <div class="message-image">
        <img  src="../../images/resources/logo_sm.png">
      </div>
    </div>
  </div>
 <?php } ?>

<?php } ?>

  <nav>
    <div class="logo">
      <a href="javascript:;">
        <div class="img-logo"></div>
      </a>
    </div>
  </nav>
  
  <div class="nav-area"></div>


  <div class="super-container bg-photo">  
    <!-- Opacidad -->
    <div class="black-overlay"></div>
    <!-- Opacidad -->
    
    <div class="container-medium">
      <h3>Accedé a tu cuenta</h3>
      <!-- -->
      <div class="login-box left">
      
        <!-- Facebook Connect -->
        <div class="social-container ">
          <div class="social-inner-container">
            <input type="hidden" name="type" value="{{ $var }}">
              <h4>LOG IN VIA <b>FACEBOOK</b></h4>
              <a class="btn-social btn-fb" href="redirect/facebook">
                  <span> Sign in with Facebook</span>
              </a>
          </div>
        </div>
        <!-- Facebook Connect -->
      

        <!-- Google Connect -->
        <div class="social-container ">
          <div class="social-inner-container">
            <input type="hidden" name="type" value="{{ $var }}">
              <h4>LOG IN VIA <b>GOOGLE</b></h4>
              <a class="btn-social btn-google" href="redirect/google">
                <span> Sign in with Google Plus</span>
              </a>
            </div>
        </div>
        <!-- Google Connect -->
        
      </div>
      <!-- -->
      
      <!-- Area de Ingreso a YLMM -->
      <div class="login-box right">
        <h4>LOG IN VIA <b>YLMM</b></h4>
        <form action="{{ action('HomeController@login')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="type" value="{{ $var }}">
          <input type="text" name="email" placeholder="EMAIL" class="placeholder-color">
          <input type="password" name="password" placeholder="CLAVE" class="placeholder-color">
          <button class="btn-purple btn-register" type="submit" name="ingresar">INGRESAR</button>
          <p style="font-size: 12px;">¿No tenés cuenta? <a href="/registro">REGISTRATE</a></p>
        </form>
      </div>
      <!-- Area de Ingreso a YLMM -->

      <div class="bottom-back" style="position: relative;">
        <div class="arrow-back">
          
        </div>
      </div>
      
    </div>
  </div>


  <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>

<script type="text/javascript" src="../../js/form-validator.js"></script>

<script type="text/javascript">


$('.close-messages').on('click', function () {
  $('.messages').css('display', 'none');
});

$('.bottom-back').on('click', function () {
  window.location.href = "http://localhost:8000/";
});
</script>


</body>
</html>