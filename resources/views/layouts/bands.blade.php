<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <title>YLMM</title>

  <link rel="icon" type="image/png" href="../../images/favicon.ico" sizes="32x32" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="../../css/select2.min.css">
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
  <link rel="stylesheet" type="text/css" href="../../css/bandwall.css">
  <link rel="stylesheet" type="text/css" href="../../css/comments.css">
  <link rel="stylesheet" type="text/css" href="../../css/plantilla.css">
  <link rel="stylesheet" type="text/css" href="../../css/plantilla2.css">
  <link rel="stylesheet" type="text/css" href="../../css/loader.css">
  <link rel="stylesheet" type="text/css" href="../../css/responsive-menu.css">
  <link rel="stylesheet" type="text/css" href="../../css/ylmm-media.css">

  <style type="text/css">
    
    @supports (overflow:-webkit-marquee) and (justify-content:inherit) {
      
      nav .items ul li:nth-child(2) ul.user-sub-menu {
        margin-top: 6.5px !important;
      }

      .band-name-type-1{
        font-weight: 400!important;
      }
      
    }

  </style>


  <script type="text/javascript">
  
    function resizeImageToArea($imagen) {
        var imgWidth = $imagen.prop('width')
        ,   imgHieght = $imagen.prop('height');
    
        (imgWidth >= imgHieght) ?
          $imagen.css({'height': '100%','width': 'auto'}) :
          $imagen.css({'height': 'auto','width': '100%'});
    }

  </script>

  <script src="../../js/jquery-2.2.4.min.js" ></script>
  <script type="text/javascript" src="../../js/slick.min.js"></script>

  <style type="text/css">
    @media(max-width: 450px) {

      .twitter-widget {
          margin-bottom: 1em;
      }

    }
  </style>

</head>

<body class="body-gray">

<?php if (isset($_GET['msg'])) { ?>
  <?php $msg = $_GET['msg'];
  if ($msg == 7) { ?>
  <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
        <p style="text-align: center;">Las solicitudes para formar parte de tu banda ya han sido enviadas y se encuentran pendientes de confirmación.</p>
       <div class="message-image">
          <img src="../../images/resources/logo_sm.png">
      </div>
    </div>
   </div>
   <?php }if ($msg == 8) { ?>
  <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
        <p style="text-align: center;">Este video ya está participando.</p>
        <div class="message-image">
          <img src="../../images/resources/logo_sm.png">
      </div>
    </div>
   </div>
   <?php }if ($msg == 9) { ?>
  <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
        <p style="text-align: center;">Debe llenar todos los campos.</p>
       <div class="message-image">
          <img src="../../images/resources/logo_sm.png">
      </div>
    </div>
   </div>
   <?php }if ($msg == 10) { ?>
  <div class="messages">
    <div class="container">
      <div class="close-messages"></div>
        <p style="text-align: center;">¡Felicitaciones, estás participando en el concurso!</p>
        <div class="message-image">
            <img src="../../images/resources/logo_sm.png">
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
                        ->take(3)->get(); 

                  if ($notification == '[]') { ?>

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

                          <li>
                            <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a>
                          </li>

                        <?php }else{

                          $wall = DB::table('users')->where('id_musician', $video->id_musician)->first(); ?>

                          <li>
                            <a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}" onclick="onSeen({{$not->id}})">{{$not->comment}}</a>
                          </li>

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
    
        <input id="input-buscador-mobile" type="text" name="search" placeholder="Buscar en YLMM">
         <div class="buscador" style="box-shadow: 0px 2px 1px 0px transparent!important; border-top: 1px solid transparent;">
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

<div class="container">

  <div class="slider-type-2" style="padding: 0px;">

    <?php if (Auth::user()->id_band == $banda->id) { ?>

      <h1 class="band-name-type-1" style="cursor: pointer;">{{ $banda->name }}</h1>
    
    <?php }else{ ?>
      
      <h1 class="band-name-type-1" style="cursor: default;">{{ $banda->name }}</h1>

    <?php } ?>

    <form id="name_edit" method="POST" action="/bands/edit/name" enctype="multipart/form-data">

      {{ csrf_field() }}
      
      <input class="input-type-1" type="text" id="name" name="name" data-type="string" required="required" placeholder="Nombre" value="{{ $banda->name }}">
      <button class="btn-white-2" style="font-size: 12px;">Finalizar</button>
    
    </form>

    <button class="save-position-image">Finalizar</button>

    <?php if (is_null($banda->background_pic)) { ?>

      <img  class="image-1" id="image-1">

    <?php }else{ ?>

      <img  class="image-1" id="image-1" src="{{$banda->background_pic}}" style="top: {{$banda->back_y}};" data-type="{{$banda->back_x}}">

      <button class="save-position-image">Finalizar</button>

    <?php } ?>

    <?php if (Auth::user()->id_band == $banda->id) { ?>

      <div class="update-background">
        
        <img src="../../images/white_camara.png">
        
        <p>Actualizar foto de portada</p>
      
      </div>
      
      <div class="background-legend">
      
        <p>La foto debe terner como mínimo de 1024px de ancho</p>
      
      </div>

    <?php } ?>

    <?php if (Auth::user()->id_band != $banda->id) { 

      $favorites = DB::table('favorites')
                ->where('id_user', Auth::user()->id)
                ->where('id_band', $banda->id)
                ->first();

      if (is_null($favorites)) { ?>

        <div class="container-follow active">
          
          <a href="javascript:;" class="btn-follow" onclick="makeFan({{$banda->id}});"><div class="icon-follow"></div></a>
        
        </div>

      <?php }else { ?> 

        <div class="container-follow">
          
          <a href="javascript:;" class="btn-follow active" onclick="makeFan({{$banda->id}});"><div class="icon-follow"></div></a>
        
        </div>

      <?php } ?>
    
    <?php } ?>

  </div>

</div>

  <div class="top-profile-menu" >
  

  <!-- User inner menu -->
  <div class="twitter-widget">

    <div class="stats cf in-left" style="float: left;">

      <a href="/bands/comments?id={{$banda->id}}" class="stat" >MURO</a>

      <?php if (Auth::user()->id_band == $banda->id) { ?>
      <div class="dropwall">
       <ul>
          <li><a href="/users/wall?id={{Auth::user()->id_wall}}">MI MURO</a></li>
          <li><a href="/bands/comments?id={{$banda->id}}">MURO DE BANDA</a></li>
       </ul>
      </div>
      <?php } ?>

        
        <a href="/bands/home_band?idband={{$banda->id}}" class="stat" >MÚSICA</a>

        <a href="/bands/about?id={{$banda->id}}" class="stat">INFORMACIÓN</a>
 
    </div>

    <div class="stats cf follow-container" >

        <a href="/bands/followers?id={{$banda->id}}" class="stat followers" id="count-followers">FOLLOWERS: {{$banda->favorite}}</a>

         <?php if (Auth::user()->id_band != $banda->id) { 

              $favorites = DB::table('favorites')
                          ->where('id_user', Auth::user()->id)
                          ->where('id_band', $banda->id)
                          ->first(); 

              if (is_null($favorites)) { ?>
                
                <a href="javascript:;" onclick="makeFan({{$banda->id}});" class="btn-green dark my-right btn-sosfan">FOLLOW</a>

              <?php }else { ?> 
                
                <a href="javascript:;" onclick="makeFan({{$banda->id}});" class="btn-green dark my-right btn-sosfan active">UNFOLLOW</a>
         
              <?php } ?>

        <?php } ?>
    </div>


    <div class="mobile-submenu">
      <!--
        <div class="mobile-arrow"></div> -->
        
       
    </div>

    <ul class="submenu-menu-mobile">
		<?php if (Auth::user()->id_band == $banda->id) { ?>
		<li><a href="/users/wall?id={{Auth::user()->id}}">MI MURO</a></li>
		<li><a href="/bands/comments?id={{$banda->id}}">MURO DE BANDA</a></li>
		<?php }else{ ?>
		<li><a href="/bands/comments?id={{$banda->id}}">MURO</a></li>
		<?php } ?>
        <li><a href="/bands/home_band?idband={{$banda->id}}">MÚSICA</a></li>
        <li><a href="/bands/about?id={{$banda->id}}">INFORMACIÓN</a></li>
    </ul>  


  </div>
  <!-- User inner menu -->
  

<!--
    <ul class="my-inline my-left">
      <li><a href="/bands/comments?id={{$banda->id}}">MURO</a></li>
        <?php if (Auth::user()->id_band == $banda->id) { ?>
      <div class="dropwall">
       <ul>
          <li><a href="/users/wall?id={{Auth::user()->id_wall}}">MI MURO</a></li>
          <li><a href="/bands/comments?id={{$banda->id}}">MURO DE BANDA</a></li>
       </ul>
      </div>
      <?php } ?>
      <li><a class="active" href="/bands/home_band?idband={{$banda->id}}">MÚSICA</a></li>
      <li><a href="/bands/about?id={{$banda->id}}">INFORMACIÓN</a></li> 
    </ul>
-->
    <a href="javascript:;" class="my-center avatar-profile">
      <div class="edit-avatar">
        <?php if (Auth::user()->id_band != $banda->id) { ?>
          <img  id="img-avatar" onload="resizeImageToArea($('img#img-avatar'))" src="{{ $banda->profile_pic }}" alt="" style="cursor: default;">
        <?php } ?>

        <?php if (Auth::user()->id_band == $banda->id) { ?>
          <img  id="img-avatar" onload="resizeImageToArea($('img#img-avatar'))" src="{{ $banda->profile_pic }} " alt="">-
          <div style="width: 10em; height: 10em; border: 1px solid blue;"></div>
          <div class="container-avatar">
              <div class="edit-avatar image"></div>
          </div>
        
        <?php } ?>

        <form id="profile-pic" method="POST" action="/bands/update_profile" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="file" name="picture-avatar" class="file-avatar" style="display: none;"> 
       
      </form>

      <form id="background-pic" method="POST" action="/bands/update_background" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="img-coordenadasY-back" type="text" name="back_Y">
            <input class="img-coordenadasX-back" type="text" name="back_X">
            <input type="file" name="picture-background" class="file-background" style="display: none;">

      </form>
        
        
    
      </div>
        
        
    </a> 
        
  </div>

<?php if (Auth::user()->id_band == $banda->id) { ?>
    <input type="hidden" name="id_confirmation" id="id_confirmation" value="YES">
<?php } ?>

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
  
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d14bef0f66d9fe"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script type="text/javascript" src="../../js/commentjs.js" ></script>
  <script type="text/javascript" src="../../js/bandwall.js" ></script>


  <script type="text/javascript" src="../../js/lib.js"></script>

  <script type="text/javascript">
  
 $(document).ready(function(){

        var wrapperOffset = $(".slider-type-2").offset();
        
          var defaultImg = $('.slider-type-2 .image-1').attr('src');
        // Drag Background Image.


        // Verificar imagen por defecto.
        
        if(defaultImg) {
            $('.slider-type-2 .image-1').css('height', 'auto');
        } else {
          $('.slider-type-2 .image-1').css('height', '100%');
        }
        
        if ($('#id_confirmation').val() == 'YES') {

          $('.slider-type-2 .image-1').css('cursor', 'pointer');
        
          $('.slider-type-2 .image-1').draggable({
             axis: "y",
             cursor: "move",
            containment: [
                wrapperOffset.left,
                wrapperOffset.top - 400,
                wrapperOffset.left,
                wrapperOffset.top 
            ],
            drag:function(event,ui) {
              var offset =  $('.slider-type-2 .image-1').css('top');
              var wWidth = $(window).width();
              $('.img-coordenadasY-back').val(offset);
              $('.img-coordenadasX-back').val(wWidth);
              $('.update-background, .background-legend').removeClass('active');
              $('.save-position-image').addClass('active');
            },
            drop:function(event, ui){
              var offset =  $('.slider-type-2 .image-1').css('top');
              var wWidth = $(window).width();

              $('.img-coordenadasY-back').val(offset);
              $('.img-coordenadasX-back').val(wWidth);
              $('.update-background, .background-legend').removeClass('active');
              $('.save-position-image').addClass('active');
            }


          });
        } 

      // Hacé click acá para finalizar
      $('.save-position-image').on('click',function(){
        
        $('#background-pic').submit();
      });
        

  

});



   

   
</script>
    

</body>

</html>
