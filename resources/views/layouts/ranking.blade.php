<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <title>YLMM</title>

  <link rel="icon" type="image/png" href="../../images/favicon.ico" sizes="32x32" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/slick.css">
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="../../css/general.css">
  <link rel="stylesheet" type="text/css" href="../../css/home_usuario.css">
  <link rel="stylesheet" type="text/css" href="../../css/login.css">
  <link rel="stylesheet" type="text/css" href="../../css/my-index.css">
  <link rel="stylesheet" type="text/css" href="../../css/my-login.css">
  <link rel="stylesheet" type="text/css" href="../../css/registro.css">
  <link rel="stylesheet" type="text/css" href="../../css/video.css">
  <link rel="stylesheet" type="text/css" href="../../css/ylmm.css">
  <link rel="stylesheet" type="text/css" href="../../css/components.css">
  <link rel="stylesheet" type="text/css" href="../../css/general.css">
  <link rel="stylesheet" type="text/css" href="../../css/genres.css">
  <link rel="stylesheet" type="text/css" href="../../css/search_style.css">
  <link rel="stylesheet" type="text/css" href="../../css/plantilla.css">
  <link rel="stylesheet" type="text/css" href="../../css/plantilla2.css">
	<link rel="stylesheet" type="text/css" href="../../css/loader.css">
  <link rel="stylesheet" type="text/css" href="../../css/notificaciones.css">
  <link rel="stylesheet" type="text/css" href="../../css/responsive-menu.css">
  <link rel="stylesheet" type="text/css" href="../../css/ylmm-media.css">


  
  <script src="../../js/jquery-2.2.4.min.js" ></script>
  <script type="text/javascript" src="../../js/slick.min.js"></script>

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
  }
  .messages .container p{
    color: white;
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

  nav .items ul li:nth-child(2) ul.user-sub-menu {
      margin-top: 2.5px;  
  }


  </style>

</head>

<body class="body-gray">

<?php if (isset($_GET['msg'])) { ?>
<?php $msg = $_GET['msg'];
if ($msg == 4) { ?>
<div class="messages">
  <div class="container">
    <div class="close-messages"></div>
      <p style="text-align: center;">¡Su email ha sido validado exitósamente!</p>
      <div class="message-image">
        <img  src="../../images/resources/logo_sm.png">
    </div>
  </div>
 </div>
 <?php } ?>
<?php } ?>

<div class="share-overlay">
  <div class="container">
    <div class="close-share"></div>
    <div class="addthis_inline_share_toolbox active"></div>
  </div>
</div>

 <!-- Nav area -->
  <nav>
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
                  <?php } ?>


                  <?php if (Auth::user()->user_level == '5') { ?>
                      <li><a href="/bandsregistration">Crear Banda</a></li>
                  <?php } ?>


                  <li><a href="/battles">Concurso</a></li>
                  <li><a href="/">Inicio</a></li>
                  <li><a href="/logout">Cerrar Sesión</a></li>
                
            </ul>
        
        </li>

        <li>
          <?php $notification = DB::table('notifications')
                          ->where('id_user', Auth::user()->id)
                          ->where('seen', 'N')
                          ->orderBy('created_at', 'desc')
                          ->get(); 

              $counter = count($notification); ?>
              
          <div class="notification">

            <?php if ($counter > 0) { ?>
              
              <div class="msj">{{$counter}}</div>

            <?php } ?>

            <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
          </div>

          <ul class="user-sub-menu">  
            <?php $notification = DB::table('notifications')
            ->where('id_user', Auth::user()->id)
            ->where('seen', 'N')
            ->orderBy('created_at', 'desc')
            ->take(3)->get(); ?>
            
            <?php if ($notification == '[]') { ?>
              
                <li><a href="javascript:;">No tiene notificaciones nuevas</a></li>
            
            <?php }else{ ?>
            
                @foreach($notification as $not)

                  @if ($not->type == 'post')
                    <li><a href="/users/wall?id={{Auth::user()->id}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif

                  @if ($not->type == 'tag')
                    <li><a href="{{$not->href}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif
                  
                  @if ($not->type == '')
                    <li><a href="javascript:;" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif

                  @if ($not->type == 'video' || $not->type == 'votes' || $not->type == 'view' || $not->type == 'like')
                    
                    <?php $video = DB::table('videos')->where('id', $not->id_video)->first();

                        if (!is_null($video->id_band)) { ?>

                          <li><a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>

                        <?php }else{
                          
                          $wall = DB::table('users')->where('id_musician', $video->id_musician)->first();

                        ?>

                          <li><a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>

                        <?php } ?>

                  @endif
                  
                @endforeach
            
            <?php } ?>
                                    
            <li class="last">
                <a href="/notifications">VER MÁS</a>
            </li>
          </ul>

        </li>
      </ul> 

      <?php if (Auth::check()) { ?>
    
        <ul class="main-menu mobile">
          <li class="open-right-menu">
            <div class="notification">
              <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
            </div>
          </li>

          <?php $notification = DB::table('notifications')
                          ->where('id_user', Auth::user()->id)
                          ->where('seen', 'N')
                          ->orderBy('created_at', 'desc')
                          ->get(); 

              $counter = count($notification); ?>

          <li class="open-notification-menu">
            
            <div class="notification">

            	<?php if ($counter > 0) { ?>
            		<div class="msj">{{$counter}}</div>
            	<?php } ?>
              <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
              
            </div>

          </li> 
        </ul>  

    <?php } ?>

    <?php if (!Auth::check()) { ?>

      <ul class="main-menu mobile unlogin">
        <li class="open-right-menu box-menu">
          <div class="notification">
            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
          </div>
        </li>
      </ul>  

    <?php } ?>


    </div>
  </nav>

  <div class="top-sub-menu">
    <div class="top-sub-menu-container">
      <ul>
        <li><a href="/">Login</a></li>
        <li><a class="btn-green" href="/registro">Registro</a></li>
      </ul>
    </div>
   </div>

   <div class="modal-search">
    <div class="search-area">
      <form>
    
        <input id="input-buscador-mobile" autocomplete="off" type="text" name="search" placeholder="Buscar en YLMM">
         <div class="buscador" style="box-shadow: 0px 2px 1px 0px transparent!important;">
              <ul class="user-sub-menu buscador" style="box-shadow: 0px 2px 1px 0px transparent!important; border-top: 1px solid transparent;"></ul>
          </div>
    <!--      <button class="btn-cancel">Cancelar</button>-->
    
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
            <?php $notification = DB::table('notifications')
            ->where('id_user', Auth::user()->id)
            ->where('seen', 'N')
            ->orderBy('created_at', 'desc')
            ->take(3)->get(); ?>
            
            <?php if ($notification == '[]') { ?>
              
                <li><a href="javascript:;">No tiene notificaciones nuevas</a></li>
            
            <?php }else{ ?>
            
                @foreach($notification as $not)

                  @if ($not->type == 'post')
                    <li><a href="/users/wall?id={{Auth::user()->id}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif

                  @if ($not->type == 'tag')
                    <li><a href="{{$not->href}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif
                  
                  @if ($not->type == '')
                    <li><a href="javascript:;" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>
                  @endif

                  @if ($not->type == 'video' || $not->type == 'votes' || $not->type == 'view' || $not->type == 'like')
                    
                    <?php $video = DB::table('videos')->where('id', $not->id_video)->first();

                        if (!is_null($video->id_band)) { ?>

                          <li><a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>

                        <?php }else{
                          
                          $wall = DB::table('users')->where('id_musician', $video->id_musician)->first();

                        ?>

                          <li><a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a></li>

                        <?php } ?>

                  @endif
                  
                @endforeach
            
            <?php } ?>
          <li class="last">
            <a href="/notifications">VER MÁS</a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>

  <ul class="mobile-right-menu">
    <li><a href="/users/wall?id={{Auth::user()->id_wall}}"><div>{{Auth::user()->name}}</div></a></li>
    	<?php if (Auth::user()->user_level == '4' || Auth::user()->user_level == '1') { ?>
            <li><a href="/musicianregistration"><div>¿Sos Músico?</div></a></li>
        <?php } ?>
        
        <?php if (Auth::user()->user_level == '5') { ?>
            <li><a href="/bandsregistration"><div>Crear Banda</div></a></li>
        <?php } ?>
    <li class="search" ><a href="javascript:;"><div>Buscador</div></a></li>
    <li><a href="/"><div>Inicio</div></a></li>
    <li><a href="/battles"><div>Concurso</div></a></li>
    <li><a href="/logout"><div>Cerrar Sesión</div></a></li>
  </ul>


  <!-- Nav area -->

	<div class="container-chart" >
    <div class="slider-type-2" style="padding: 0px;">
        <div class="image-3">
        	<div class="container-title">
	    		<h1>ESTADÍSTICAS GENERALES DEL CONCURSO</h1>
	      		<h3>ASÍ SEAS FAN, MÚSICO O TENGAS UNA BANDA</h3>
        	</div>
        </div>
    </div>
  </div>

@yield('content')


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

@yield('jsfunctions')
  
  <script type="text/javascript" src="../../js/genres.js"></script>
  <script type="text/javascript" src="../../js/lib.js"></script>
  
    <script type="text/javascript">
      $('.close-messages').on('click', function () {
        $('.messages').css('display', 'none');
      });
    </script> 

</body>
</html>
