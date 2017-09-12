<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>YLMM</title>

    <link rel="icon" type="image/png" href="../../images/favicon.ico" sizes="32x32" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.8/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.8/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="../../css/general.css">
    <link rel="stylesheet" type="text/css" href="../../css/home_usuario.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="stylesheet" type="text/css" href="../../css/my-index.css">
    <link rel="stylesheet" type="text/css" href="../../css/my-login.css">
    <link rel="stylesheet" type="text/css" href="../../css/registro.css">
    <link rel="stylesheet" type="text/css" href="../../css/video.css">
    <link rel="stylesheet" type="text/css" href="../../css/ylmm.css">
    <link rel="stylesheet" type="text/css" href="../../css/components.css">
    <link rel="stylesheet" type="text/css" href="../../css/layouts.css">
    
    <?php if (Auth::check()) { ?>
     <link rel="stylesheet" type="text/css" href="../../css/plantilla2.css">
    <?php } ?>

    <link rel="stylesheet" type="text/css" href="../../css/plantilla.css">
    <link rel="stylesheet" type="text/css" href="../../css/bands_comment.css">
    <link rel="stylesheet" type="text/css" href="../../css/responsive-menu.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom-slider.css">
    <link rel="stylesheet" type="text/css" href="../../css/ylmm-media.css">
    <style type="text/css">
    .messages {width: 100%; height: 100%; position: fixed; display: block; background: rgba(0, 0, 0, 0.5); z-index: 9999;}
    .messages .container {top: 50%; left: 50%; width: 30em; height: auto; padding: 2em; position: relative; background: black;transform: translate(-50%, -50%); border: 1px solid white; }
    .messages .container .close-messages { top: 5px; right: 5px; width: 30px; height: 30px; color: gray; padding-top: 5px; font-size: 16px; text-align: center; position: absolute; cursor: pointer; background: url(../../images/close.png)no-repeat;background-size: cover;}
    .messages .container .message-image {width: 100%; height: auto; margin-top: 1em; text-align: center; }
    .messages .container .message-image img {width: auto; }
    .messages .container p {color: white; margin-top: 1em; font-size: 15px; }
    nav .logo a .img-logo {width: 63%; height: 43px; text-align: center; background: url(../../images/resources/logo_bg.png)no-repeat; background-size: cover; margin: 6px 0 0 12px;}
    .main-menu.mobile.unlogin {width: 3em; float: right; position: relative; }
    .responsive-register {top: 0; width: 100%; height: 44px; padding: 1em 0.5em; float: left; transition: .5s ease-in-out; position: absolute; z-index: 3; background: rgba(255, 255, 255, 0.9); }
    .responsive-register.active {top: 3.5em; }
    .responsive-register ul {float: right; font-size: 12px; }
    .responsive-register ul li {display: inline-block; }
    .responsive-register ul li:first-child {margin-right: 0.5em; }
    .responsive-register ul li:first-child a {color: black; }
    .responsive-register ul li:hover:first-child a {color: pink; }
    .slider-tittle {font-size: 15px;}
    .home-img-overlay {width: 100%; height: 100%; position: absolute; display: block; background: rgba(0, 0, 0, 0.3); z-index: 1; }
    nav .items ul li:nth-child(2) ul.user-sub-menu {margin-top: 2.5px;}
    @media(max-width: 800px) { .nav-register{ display: none; } }
    @-moz-document url-prefix() { nav .items ul.main-menu li: nth-child(1) ul.user-sub-menu { margin-top: 6.5px!important; } }
    <?php if (!Auth::check()) { ?>@media (max-width: 900px){ nav ul { margin-right: 0em!important; } } <?php } ?>
  </style>
</head>
<body>

<?php if (isset($_GET['msg'])) { $msg = $_GET['msg']; if ($msg == 1) { ?>
<div class="messages">
  <div class="container">
    <div class="close-messages"></div>
    <p style="text-align: center;">Acabamos de enviarte un email, hacé click en el enlace para activar tu cuenta. <br></p>
    <div class="message-image">
      <img  src="../../images/resources/logo_sm.png">
    </div>
  </div>
</div>
 <?php }if ($msg == 6) { ?>
<div class="messages">
  <div class="container">
    <div class="close-messages"></div>
    <p style="text-align: center;">Necesita iniciar sesión para realizar esta acción</p>
    <div class="message-image">
      <img src="../../images/resources/logo_sm.png">
    </div>
  </div>
</div>
 <?php }if ($msg == 7) { ?>
<div class="messages">
  <div class="container">
    <div class="close-messages"></div>
    <p style="text-align: center;">¡Muchas gracias por visitarnos!</p>
 <div class="message-image">
      <img  src="../../images/resources/logo_sm.png">
    </div>
  </div>
</div>
<?php } } if (Auth::check()) { ?>

<!-- Nav area -->
  <nav class="nav-logeado">
    <div class="logo">
      <a href="javascript:;">
        <div class="img-logo"></div>
      </a>
    </div>
    <div class="items">
      <ul class="main-menu ">
        <li>
          <input id="input-buscador" type="text"  placeholder="Buscar..." autocomplete="off">
           <div class="buscador">
              <ul class="user-sub-menu buscador"></ul>
          </div>
        </li>
        <li>
          <a class="my-inline profile-info" href="/users/wall?id={{Auth::user()->id_wall}}">
            <?php if(Auth::check()) { ?>
              <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}')no-repeat; background-size: cover"></div>
              <div class="info">
                <p>{{Auth::user()->name}}</p>
              </div>
            <?php  } ?>
          </a>
            <ul class="user-sub-menu">
              <?php if (Auth::user()->user_level == '4' || Auth::user()->user_level == '1') { ?>
                <li><a href="/musicianregistration">¿Sos Músico?</a></li>
              <?php } if (Auth::user()->user_level == '5') { ?>
                      <li><a href="/bandsregistration">Crear Banda</a></li>
              <?php } ?>
                <li><a href="/battles">Concurso</a></li>
                <li><a href="/">Inicio</a></li>
                <li><a href="/logout">Cerrar Sesión</a></li>
            </ul>
        </li>
        <li>
        <?php $notification = DB::table('notifications')->where('id_user', Auth::user()->id)->where('seen', 'N')->orderBy('created_at', 'desc')->get(); $counter = count($notification); ?>
          <div class="notification">
          	<?php if ($counter > 0) { ?>
          		<div class="msj">{{$counter}}</div>
          	<?php } ?>
            <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
          </div>

          <ul class="user-sub-menu">  
            <?php $notification = DB::table('notifications')->where('id_user', Auth::user()->id)->where('seen', 'N')->orderBy('created_at', 'desc')->take(3)->get(); if ($notification == '[]') { ?>
                <li><a href="javascript:;">No tiene notificaciones nuevas</a></li>
            <?php }else{ ?>
            @foreach($notification as $not)
              @if ($not->type == 'post')
                <li><a href="/users/wall?id={{Auth::user()->id}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              @endif
              @if ($not->type == '')
                <li><a href="javascript:;" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              @endif
              @if ($not->type == 'video' || $not->type == 'votes' || $not->type == 'view' || $not->type == 'like')
              <?php $video = DB::table('videos')->where('id', $not->id_video)->first();
                if (!is_null($video->id_band)) { ?>
                  <li><a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              <?php }else{ $wall = DB::table('users')->where('id_musician', $video->id_musician)->first(); ?>
                  <li><a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              <?php } ?>
              @endif    
              @endforeach
              <?php } ?>
              <li class="last"><a href="/notifications">VER MÁS</a></li>
          </ul>
        </li>
      </ul> 
      <ul class="main-menu mobile">
        <li class="open-right-menu">
          <div class="notification">
            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
          </div>
        </li>
        <?php $notification = DB::table('notifications')->where('id_user', Auth::user()->id)->where('seen', 'N')->orderBy('created_at', 'desc')->get(); $counter = count($notification); ?>
        <li class="open-notification-menu">
          <div class="notification">
            <?php if ($counter > 0) { ?><div class="msj">{{$counter}}</div><?php } ?>
              <i class="fa fa-bell fa-2x" aria-hidden="true"></i>             
          </div>
        </li> 
      </ul>  
    </div>
  </nav>
  <div class="modal-search">
    <div class="search-area">
      <form>  
        <input id="input-buscador-mobile" type="text" name="search" placeholder="Buscar en YLMM">
         <div class="buscador" style="box-shadow: 0px 2px 1px 0px transparent!important; border-top: 1px solid transparent;">
              <ul class="user-sub-menu buscador" style="box-shadow: 0px 2px 1px 0px transparent!important; border-top: 1px solid transparent;"></ul>
          </div>
      </form>
    </div>
  </div>
  <div class="modal-notificacion">
    <div class="modal-area">
      <div class="header">
        <p>Notificaciones</p>
      </div>
      <div class="notification-list">
        <ul>
        <?php $notification = DB::table('notifications')->where('id_user', Auth::user()->id)->where('seen', 'N')->orderBy('created_at', 'desc')->take(3)->get(); if ($notification == '[]') { ?>
            <li><a href="javascript:;">No tiene notificaciones nuevas</a></li>
        <?php }else{ ?>
          @foreach($notification as $not)
            @if ($not->type == 'post')
              <li><a href="/users/wall?id={{Auth::user()->id}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
            @endif
            @if ($not->type == '')
              <li><a href="javascript:;" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
            @endif
            @if ($not->type == 'video' || $not->type == 'votes' || $not->type == 'view' || $not->type == 'like')
              <?php $video = DB::table('videos')->where('id', $not->id_video)->first(); if (!is_null($video->id_band)) { ?>
                <li><a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              <?php }else{ $wall = DB::table('users')->where('id_musician', $video->id_musician)->first(); ?>
                <li><a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
              <?php } ?>
            @endif
          @endforeach 
          <?php } ?>
          <li class="last"><a href="/notifications">VER MÁS</a></li>       
        </ul>
      </div>
    </div>
  </div>
  <ul class="mobile-right-menu">
    <li><a href="/users/wall?id={{Auth::user()->id_wall}}"><div>{{Auth::user()->name}}</div></a></li>
    	<?php if (Auth::user()->user_level == '4' || Auth::user()->user_level == '1') { ?>
        <li><a href="/musicianregistration"><div>¿Sos Músico?</div></a></li>
      <?php } if (Auth::user()->user_level == '5') { ?>
        <li><a href="/bandsregistration"><div>Crear Banda</div></a></li>
      <?php } ?>
    <li class="search" ><a href="javascript:;"><div>Buscador</div></a></li>
    <li><a href="/"><div>Inicio</div></a></li>
    <li><a href="/battles"><div>Concurso</div></a></li>
    <li><a href="/logout"><div>Cerrar Sesión</div></a></li>
  </ul>
  <!-- Nav area -->
<?php }else { ?>
<nav class="nav-noLogeada" style="background: black;">
  <div class="logo my-left">
    <a href="javascript:;">
      <div class="img-logo"></div>
    </a>
  </div>
  <!-- Barra menu cuando no estas logeado-->
  <ul class="main-menu mobile unlogin">
    <li class="open-right-menu box-menu responsive-item">
      <div class="notification">
        <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
      </div>
    </li>
  </ul>
  <!-- opciones  -->
  <ul class="nav-register my-inline my-right" style="margin-top: 1.2em; margin-right: 2em;">
    <li style="margin-right: 12px;"><a class="login-tag" style="font-size: 12px;" href="/login?var=0" >LOG IN</a></li>
    <li><a style="font-size: 12px;" href="/registro" class="btn-green">REGISTRO</a></li>
  </ul>
</nav> 
<?php } ?>
<div class="responsive-register">
 <ul><li><a href="/login?var=0"> Login</a></li><li><a href="/registro" class="btn-green"> Registrarse </a></li></ul>
</div>
<!--Fin de opciones del menu  -->
<div class="my-jumbotron img-home my-text-center">
  <div class="home-img-overlay">
    <div class="content" style="margin-top: 8em;">
      <img src="../../images/resources/logo_bg.png">
      <h2 style="font-size: 17px;" class="">Una red social para encontrar a tus <br> nuevas bandas favoritas.</h2>
        <ul class="my-inline">
          <li><a href="javascript:;"><img src="../../images/resources/Appstore.png" title="Próximamente..."></a></li>
            <li><a href="javascript:;"><img src="../../images/resources/Playstore.png" title="Próximamente..."></a></li>
        </ul>
      <h2 style="font-size: 12px;">¡Descargá la App para tu celular!</h2>
    </div>
  </div>
</div>
<section class="home-section-1">
  <h2 style="font-size: 15px;"><b class="b-tag-safari">Es muy fácil ser parte</b></h2>
    <ul class="my-inline">
      <li>
        <?php if (!Auth::check()) { ?>
          <a href="/login?var=0" class="home-link"><img src="../../images/resources/fan-icon.png"></a>
          <h1><b class="b-tag-safari" style="font-size: 15px;">¿SOS FAN?</b></h1>
          <p style="font-size: 12px;"><b class="b-tag-safari">Descubrí</b> nueva música. <b class="b-tag-safari">Encontrá</b> y seguí a las <br> bandas que te interesen. <b class="b-tag-safari">Votá</b> por ellos y <br> ayudalos a convertirse en una gran banda.</p>
        <?php }else{ ?>
          <a href="javascript:;" style="cursor: default;" class="home-link"><img src="../../images/resources/fan-icon.png"></a>
          <h1><b class="b-tag-safari" style="font-size: 15px;">¿SOS FAN?</b></h1>
          <p style="font-size: 12px;"><b class="b-tag-safari">Descubrí</b> nueva música. <b class="b-tag-safari">Encontrá</b> y seguí a las <br> bandas que te interesen. <b class="b-tag-safari">Votá</b> por ellos y <br> ayudalos a convertirse en una gran banda.</p>
        <?php } ?>
      </li>
      <li>
        <?php if (!Auth::check()) { ?>
          <a href="/login?var=1" class="home-link"><img src="../../images/resources/musico-icon.png"></a>
          <h1><b class="b-tag-safari" style="font-size: 15px;">¿SOS MÚSICO?</b></h1>
          <p style="font-size: 12px;"><b class="b-tag-safari">Creá</b> tu página de banda. Podés <b class="b-tag-safari">compartir tu <br> música, interactuar</b>  con tus fans y participar por el<br> <b class="b-tag-safari">gran premio</b> de You Love My Music.</p>
        <?php }else { 
        if (is_null(Auth::user()->id_musician)) { ?>
          <a href="/musicianregistration" class="home-link">
            <?php }else{ ?><a href="javascript:;" style="cursor: default;" class="home-link"><?php } ?>
            <img src="../../images/resources/musico-icon.png">
          </a>
          <h1><b class="b-tag-safari" style="font-size: 15px;">¿SOS MÚSICO?</b></h1>
          <p style="font-size: 12px;"><b class="b-tag-safari">Creá</b> tu página de banda. Podés <b class="b-tag-safari">compartir tu <br> música, interactuar</b> con tus fans y participar por el<br> <b class="b-tag-safari">gran premio</b> de You Love My Music.</p>
        <?php } ?>
      </li>
    </ul>
</section>
<section class="home-section-2">
  <div class="content-2">
    <h1>VIVÍ LA EXPERIENCIA YLMM</h1>
    <p>DESCUBRÍ NUEVAS BANDAS, VOTÁ POR TU FAVORITA Y PARTICIPÁ POR INCREÍBLES PREMIOS</p>
    <?php if (!Auth::check()) { ?>
      <a href="/login?var=0"><button class="btn-white-2" style="font-size: 17px;">INGRESAR</button></a>
    <?php }else{ ?>
      <a href="javascript:;"><button class="btn-white-2" style="font-size: 17px; cursor: default;">INGRESAR</button></a>
    <?php } ?>
  </div>
</section>
<section class="home-section-3" style="background: white;">
  <h1 class="slider-tittle"> Novedades </h1>
    <div class="slick-slider">
    @foreach($today as $last)
		  @if(!Auth::check())
      <div>
			  <div class="slick-slider__slide slider-video">
			    <a href="javascript:;">
			      <img src="" class="img-slider">
	         <?php $query = explode('=', $last->url); ?>
	          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
	          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
	         </div> 
	       </a>
	    </div>
		  @else
      @if($last->id_band == null)
				<div>
				  <div class="slick-slider__slide slider-video">
				    <?php $user_wall = DB::table('users')->where('id_musician', $last->id_musician)->first(); ?>
				      <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$last->id}}&idmusic={{$last->id_musician}}">
				        <img src="" class="img-slider">
		              <?php $query = explode('=', $last->url); ?>
		              <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		              <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		            </div> 
		          </a>
		      </div>
			@else
      <div>
			  <div class="slick-slider__slide slider-video">
			    <a href="/bands/band_comments?idvideo={{$last->id}}&idband={{$last->id_band}}">
			      <img src="" class="img-slider">
		          <?php $query = explode('=', $last->url); ?>
		          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		        </div> 
		      </a>
		    </div>
      @endif
		@endif
  @endforeach
</div>
</div>
<h1 class="slider-tittle"> Lo más escuchado </h1>
<div class="slick-slider">
	@foreach($vistas as $last)
		@if(!Auth::check())
			<div>
			  <div class="slick-slider__slide slider-video">
			    <a href="javascript:;">
			      <img src="" class="img-slider">
	          <?php $query = explode('=', $last->url); ?>
	          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
	          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
	          </div> 
	        </a>
	     </div>
		@else	
    @if($last->id_band == null)
      <div>
			  <div class="slick-slider__slide slider-video">
			  <?php $user_wall = DB::table('users')->where('id_musician', $last->id_user)->first(); ?>
			    <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$last->id_video}}&idmusic={{$last->id_user}}">
			      <img src="" class="img-slider">
		          <?php $query = explode('=', $last->url); ?>
		          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		          </div> 
		      </a>
		    </div>
    @else
    <div>
      <div class="slick-slider__slide slider-video">
			  <a href="/bands/band_comments?idvideo={{$last->id_video}}&idband={{$last->id_band}}">
			    <img src="" class="img-slider">
		        <?php $query = explode('=', $last->url); ?>
		        <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		        <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		      </div> 
		    </a>
		  </div>
    @endif
	@endif
@endforeach
</div>
</div>
<h1 class="slider-tittle"> Descubrimientos de la semana </h1>
  <div class="slick-slider">
    @foreach($weeks as $last)
      @if(!Auth::check())
        <div>
			    <div class="slick-slider__slide slider-video">
			      <a href="javascript:;">
			      <img src="" class="img-slider">
	          <?php $query = explode('=', $last->url); ?>
	              <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
	              <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
	            </div> 
	          </a>
	        </div>
		  @else
      @if($last->id_band == null)
        <div>
				  <div class="slick-slider__slide slider-video">
				  <?php $user_wall = DB::table('users')->where('id_musician', $last->id_user)->first(); ?>
				    <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$last->id}}&idmusic={{$last->id_user}}">
				      <img src="" class="img-slider">
		          <?php $query = explode('=', $last->url); ?>
		          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		          </div> 
		        </a>
		      </div>
			@else
			<div>
			  <div class="slick-slider__slide slider-video">
			    <a href="/bands/band_comments?idvideo={{$last->id}}&idband={{$last->id_band}}">
			      <img src="" class="img-slider">
		        <?php $query = explode('=', $last->url); ?>
		          <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
		          <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
		        </div> 
		      </a>
		    </div>
			@endif
		@endif
  @endforeach
</div>
</div>
</section>
<!-- Nuevo Footer -->
<footer>
  <div class="sponsors">
    <div class="logos">
        <ul class="sponsors-list">
        @foreach($sponsors as $sponsor)
          <li><a href="{{$sponsor->url}}" target="_blank"><img class="logo" src="../..{{$sponsor->image}}" alt=" " /></a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <p>© YLMM -You Love My Music- <script>document.write(new Date().getFullYear())</script>. Contacto info@youlovemymusic.com </p>
</footer>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script type="text/javascript" src="../../js/custom.js"></script>
<script type="text/javascript" src="../../js/lib.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.5.8/slick.min.js"></script>
<script type="text/javascript">
  $(document).on('ready change', function() {
    setTimeout(function(){
      var arrowHeight = $('.img-slider').height()/2 - $('.slick-arrow').height()/2;
      $('.slick-prev.slick-arrow').css({'top': arrowHeight, 'margin-top' : 0});
      $('.slick-next.slick-arrow').css({'top': arrowHeight, 'margin-top' : 0});
	 }, 600);
  });
  $(window).resize(function() {
    var arrowHeight = $('.img-slider').height()/2 - $('.slick-arrow').height()/2;
		$('.slick-prev.slick-arrow').css({'top': arrowHeight, 'margin-top' : 0});
		$('.slick-next.slick-arrow').css({'top': arrowHeight, 'margin-top' : 0});
  });
  $('.slider-video').on('click',function() {
    var item = $(this).children('a').children('input').val(),
        iframe = $(this).children('a').children('iframe').addClass('my-visible').attr('src', item);
    var imgSliderHeight = $(this).children('a').children('img').height();
    $(this).children('a').children('img').addClass('not-visible');  
    $(this).children('a').children('div').addClass('not-visible');
    imgSliderHeight = imgSliderHeight + 20;
    iframe.css('max-height', imgSliderHeight+'px');
  });
  $('.slick-slider__slide').each(function(index, item){
    var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
    $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
  });
  function onSeen(id){ $.get('/seen?id='+id, function(response){});}
  $("nav .items ul.main-menu li:nth-child(1) input").keyup(function (e) { e.preventDefault(); nav_search(0); });
  $("nav .items ul.main-menu li:nth-child(1) input ").focusin(function (e) { e.preventDefault(); nav_search(0); });
  $("nav .items ul.main-menu li:nth-child(1) input").focusout(function(){ 
    setTimeout(function(){ $('.user-sub-menu.buscador').empty();},400);
  });
  $(".search-area form input").keyup(function (e) { e.preventDefault(); nav_search(1); });
  $(".search-area form input ").focusin(function (e) { e.preventDefault(); nav_search(1); });
  $(".search-area form input").focusout(function(){
    setTimeout(function(){ $('.user-sub-menu.buscador').empty(); },400);
  });
 function nav_search(num) {
  if(num == 1) {
    var search = $(".modal-search.active form input ").val();
  } else {
    var search = $("nav .items ul.main-menu li:nth-child(1) input").val();
  }
  $.get('http://localhost:8000/search?search='+ search, function (data) {
    var cont = 0;
    $('.user-sub-menu.buscador li').remove();
      $.each(data, function(index, item) {
        $.each(item, function(index2, item2) { 
          if (cont <= 4) {
            var url = ''
              , type = ''
              , name = ''
              , image = ''
              , level = '';

              if(index === 'bands') {
                url =  'http://localhost:8000/bands/comments?id='+item2.id;
                type = 'band';
                img =  item2.profile_pic;
                name = item2.name;

                $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '<div class="user-item">'+
                     '<div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '<div class="user-info">'+
                       '<h1>'+name+'</h1>'+
                        '<p>Banda</p>'+
                       '</div>'+
                     '</div>'+
                   '</a>'+
                  '</li>'
                );
            }
            if(index === 'user') {
              url =  'http://localhost:8000/users/wall?id='+item2.id;
              type = 'User';
              img =  item2.profile_pic;
              name = item2.name;
              level = item2.user_level;
                if (level === '3' || level === '5') {
                  $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '<div class="user-item">'+
                     '<div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '<div class="user-info">'+
                       '<h1>'+name+'</h1>'+
                        '<p>Músico</p>'+
                       '</div>'+
                     '</div>'+
                   '</a>'+
                  '</li>'
                  );
                }else{
                  $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '<div class="user-item">'+
                     '<div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '<div class="user-info">'+
                       '<h1>'+name+'</h1>'+
                        '<p>Fan</p>'+
                       '</div>'+
                     '</div>'+
                   '</a>'+
                  '</li>'
                  );
                }
              }
              if(index === 'videos') {
                if (item2.id_musician === ' ' ) {
                  url =  'http://localhost:8000/bands/band_comments?idvideo='+item2.id+'&idband='+item2.id_band;
                }else{
                  url =  'http://localhost:8000/musician/musician_comments?id='+item2.id_user+'&idvideo='+item2.id+'&idmusic='+item2.id_musician;
                }
                type = 'band';
                name = item2.name;
                var link =  item2.url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';             
                  $('.user-sub-menu.buscador').append(
                    '<li>'+
                      '<a href="'+url+'">'+
                        '<div class="user-item">'+
                        '<div class="avatar" style="background:url('+link+')no-repeat;background-size:cover;"></div>'+
                          '<div class="user-info">'+
                            '<h1>'+name+'</h1>'+
                            '<p>Video</p>'+
                          '</div>'+
                        '</div>'+
                      '</a>'+
                  '</li>'
                  );
              }
            cont = cont + 1;
          }
        });
      });
    });
  }
$('.close-messages').on('click', function () { $('.messages').css('display', 'none'); });
</script>
</body>
</html>
