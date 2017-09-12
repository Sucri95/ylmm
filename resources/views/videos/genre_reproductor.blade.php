@extends('layouts.genres')
<style type="text/css">
    .submit_btn{
    right: 2px;
    bottom: -40px;
    float: right;
      border: none;
      color: black;
      cursor: pointer;
      font-size: 16px;
      letter-spacing: 1px;
      background: #68bd45;
      font-weight: bold;
      position: absolute;
      text-transform: uppercase;
      padding: 0.4em 1em 0.4em 1em;
  
  }

  .coments-container {
    padding: 2.5em 1em!important;
}

i.like-comment,
  i.comentarioprincipal,
  i.compartir{
    cursor: pointer;
  }

  i.like-comment,
  i.comentarioprincipal{
    padding-right: 12px;
    border-right: 1px solid gray;
   }

  i.like-comment.active,
  i.like-comment:hover,
  i.compartir:hover,
  i.comentarioprincipal:hover{
    color: #68bd45;
    transition: 1s;
  }
  
    .coments-container .coment-list .coment-post {
      height: auto!important;
    }

    #respuestacomentario > div > textarea,
    #respuesta2 > div > textarea{
      width: 67.3em;
    }

    #respuestacomentario,
    #respuesta2 {
      margin-left: 4.5em;
    }


</style>

@section('content')

  <?php if (isset($_GET['idvideo'])) {
    $id = $_GET['idvideo'];
    $video = DB::table('videos')->find($id);
  }?>

  <?php $banda = DB::table('bands')->where('id', $video->id_band)->first(); ?>

  <h1 class="band-name-type-1">{{ $banda->name }}</h1>

    <div class="video-container my-text-center">
      <div class="slider-row profile my-center">
        <div class="video video-100 my-center">
          <div class="slider-video">
          <a href="javascript:;">
            <img src="" onclick="onView({{$video->id}})">
              <?php $query = explode('=', $video->url); ?>
              <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
              <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
            </a>
          </div>
           <div class="info-bottom">
             <?php $vinfo = explode('-', $video->name) ?>
                <h2 class="my-left">{{ $vinfo[0] }}</h2><br>
                <a style="right: 368px;" class="my-right like-check" href="javascript:;">
                  <?php $likes = DB::table('pv_uservideo')
                                ->where('id_user', Auth::user()->id)
                                ->where('id_video', $video->id)
                                ->first(); ?>

                  <?php if (is_null($likes)) { ?>

                    <i class="love-band" style="width: 10em;" onclick="videoLike({{$video->id}});"></i>

                  <?php }else{ ?>
            
                    <i class="love-band active" style="width: 10em;" onclick="videoLike({{$video->id}});"></i>
                    
                  <?php } ?>
                </a>
             <?php $favorites = DB::table('favorites')->where('id_user', Auth::user()->id)->where('id_band', $banda->id)->first(); ?>
     			    <?php if (is_null($favorites)) { ?>
            		<a href="javascript:;" style="width: 12em; top: -1px; right: -88px; line-height: 12px;" onclick="makeFan({{$banda->id}});" class="btn-green dark my-right btn-sosfan">HACETE FAN</a>
             	<?php }else { ?> 
                  	<a href="javascript:;" style="width: 12em; top: -1px; right: -88px; line-height: 12px;" onclick="makeFan({{$banda->id}});" class="btn-green dark my-right btn-sosfan active">YA SOS FAN</a>
             	<?php } ?>
          </div>
        </div>
      </div>
    </div>

 <div class="coments-container my-center">

 <form id="validateSubmitForm" action="{{ action('CommentController@createcomment')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_video" value="{{ $video->id }}">
       <input type="hidden" name="id_band" value="{{ $banda->id }}">
      <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
      <div class="create-coment">
              <img src="{{Auth::user()->profile_pic}}">
              <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
              <button class="submit_btn" type="submit">publicar</button>
            </div>
  </form>
  
  <?php $comments = DB::table('comments')
            ->where('id_video', $video->id)
            ->whereNull('id_comment')
            ->orderBy('created_at', 'asc')
            ->get(); ?>
  @foreach($comments as $comment)
    <?php $usuario = DB::table('users')->where('id', $comment->id_user)->first(); ?>
    <?php $response = DB::table('comments')
            ->where('id_video', $video->id)
            ->where('id_comment','=', $comment->id)
            ->orderBy('created_at', 'asc')
            ->get(); ?>

    <div class="coment-list">
      <div class="coment-post">      
        <div class="avatar-area">
          <img src="{{$usuario->profile_pic}}">
        </div>
      
        <div class="post-data">
          <p><span>{{$usuario->name}}    </span>     {{ $comment->comment }}</p>   
            <div class="footer-post">
              <?php if ($comment->like == 0){ ?>
                <i class="like-comment" href="" onclick="onLike({{$comment->id}})" >Me gusta</i>
              <?php }else{ ?>
                <i class="like-comment active" href="" onclick="onLike({{$comment->id}})" >Me gusta</i>
              <?php } ?>
                <i class="comentarioprincipal" href="" onclick="onDelete({{$comment->id}})">Eliminar</i>
                <i class="compartir" href="javascript:;" >Compartir</i>
            </div>
        </div>
      </div>
    </div>
               
    <?php if (count($response) > 0){ ?>
    @foreach($response as $res)
      <?php $user = DB::table('users')->where('id', $res->id_user)->first();?>
        <div class="coment-list"  style="margin-left: 4em;">
          <div class="coment-post">
            <div class="avatar-area">
              <img src="{{$usuario->profile_pic}}">
            </div>
          
            <div class="post-data">
              <p><span>{{$user->name}}    </span>     {{ $res->comment }}</p>   
                <div class="footer-post">
                  <?php if ($res->like == 0){ ?>
                    <i class="like-comment" href="" onclick="onLike({{$res->id}})" >Me gusta</i>
                  <?php }else{ ?>
                    <i class="like-comment active" href="" onclick="onLike({{$res->id}})" >Me gusta</i>
                  <?php } ?>
                    <i class="comentarioprincipal" href="" onclick="onDelete({{$res->id}})">Eliminar</i>
                    <i class="compartir" href="javascript:;" >Compartir</i>
                </div>
            </div>
          </div>
        </div>

      @endforeach

        
        <form id="respuesta2" action="{{ action('CommentController@createcomment')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_video" value="{{ $video->id }}">
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
           <input type="hidden" name="id_band" value="{{ $banda->id }}">
           <input type="hidden" name="id_comment" id="id_comment_{{$comment->id}}" value="{{$comment->id}}">
            
          <div class="create-coment">
              <img src="{{Auth::user()->profile_pic}}">
              <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
              <button class="submit_btn" type="submit">publicar</button>
            </div>
        </form>

    <?php }else{ ?>

        <form id="respuestacomentario" action="{{ action('CommentController@createcomment')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_video" value="{{ $video->id }}">
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
          <input type="hidden" name="id_band" value="{{ $banda->id }}">
          <input type="hidden" name="id_comment" id="id_comment_{{$comment->id}}" value="{{$comment->id}}">
            
         <div class="create-coment">
              <img src="{{Auth::user()->profile_pic}}">
              <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
              <button class="submit_btn" type="submit">publicar</button>
            </div>
        </form>

    <?php } ?>

    
    @endforeach
  </div>

@stop

@section('jsfunctions')

<script type="text/javascript">

$('.comentarioprincipal').on('click', function(){

      $(this).parent('.footer-post').parent('.post-data').parent('.coment-post').empty();
  
  });

  function onDelete(id)
    {
   

     $('#id_comment_'+id).parent('#respuestacomentario').empty();
      
      

      $.get('/deletecomment?id='+id, function (response) {

        if (response == 1) {

          console.log('¡Comentario Eliminado!');

        }else{

          console.log(response);
        }
      });


    }

  function makeFan(id_band)
  {
    
    $.get('/makefan?id_band='+id_band, function (response) {

      if (response == 1) {

        console.log('¡SOS FAN!');

      }else{

        console.log(response);
      }
    })
  }

function onView(id)
  {
    $.get('/users/fan/addView?id='+id, function (response) {
      if (response == 1) {
        console.log('¡Video Visto!');
      }else{
        console.log(response);
      }
    })
  }

function videoLike(id_video)
    {
      $.get('/videos/addLike?id_video='+id_video, function (response) {

        if (response == 1) {

          console.log('¡Video Likeado!');

        }else{

          console.log(response);
        }
      })
    }

  function onLike(id)
  {
 
    $.get('/bands/band_comments/addLike?id='+id, function (response) {

      if (response == 1) {

        console.log('¡Comentario Likeado!');

      }else{

        console.log(response);
      }
    });
  }
  
  $('.slider-video').on('click',function() {
      var item = $(this).children('a').children('input').val(),
      iframe = $(this).children('a').children('iframe').addClass('my-visible').attr('src', item);
    
      $(this).children('a').children('img').addClass('not-visible');  
      $(this).children('a').children('div').addClass('not-visible');  
  });

  $('.slider-video').each(function(index, item){
      var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
  });


  $('.ingresar').on('click', function(){

    $('.input.respuesta').val('1');

  });

  $.fn.enterKey = function (fnc) {

    return this.each(function () {
    $(this).keypress(function (ev) {
      var keycode = (ev.keyCode ? ev.keyCode : ev.which);
        if (keycode == '13') {
          fnc.call(this, ev);
        }
      })
    })
  }

$(".user-post-area").enterKey(function () {

    $('.user-post-input').val($(this).val());
    $('.user-post-input').trigger('click');
});

$('.coment-post').each(function(index,item) {
  $(item).children('div.avatar-area').height($(item).height());
});

    $('.btn-sosfan').on('click', function(){
    
      if ($(this).hasClass('active')){

        $(this).removeClass('active').text('HACETE FAN');

      }else{

       $(this).addClass('active').text('YA SOS FAN'); 
      }

  });

  $('.love-band').on('click', function(){

      $(this).toggleClass('active');

    });
   $('.like-comment').on('click', function(){

      $(this).toggleClass('active');

    });
</script>

@stop