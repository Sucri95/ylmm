@extends('layouts.battles')

<link rel="stylesheet" type="text/css" href="../../css/bandbattle.css">

@section('content')

  <?php if (isset($_GET['idvideo'])) {
    $id = $_GET['idvideo'];
    $video = DB::table('videos')->find($id);
    //$banda = DB::table('bands')->where('id', $video->id_band)->first();
  }?>

  <?php if (isset($_GET['idband'])) {
    $idband = $_GET['idband'];
    if (is_null($video->id_musician)) {
    	$banda = DB::table('bands')->find($idband);
    }else{
    	$banda = DB::table('musicians')->find($idband);
    }
  }?>

  <?php if (is_null($video->id_musician)) { ?>
    <h1 class="band-name-type-1">{{ $banda->name }}</h1>
    <?php }else{ ?>
    	<h1 class="band-name-type-1">{{ $banda->artistic_name }}</h1>
    <?php } ?>

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
            		<a href="javascript:;" style="width: 12em; top: -1px; right: -88px;  line-height: 12px;" onclick="makeFan({{$banda->id}});" class="btn-green dark my-right btn-sosfan">HACETE FAN</a>
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
                <i class="like-band" href="" onclick="onLike({{$comment->id}})" > </i>
              <?php }else{ ?>
                <i class="like-band active" href="" onclick="onLike({{$comment->id}})" > </i>
              <?php } ?>
                <i class="share-band compartir" href="javascript:;"> </i>
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
                    <i class="like-band" href="" onclick="onLike({{$res->id}})" > </i>
                  <?php }else{ ?>
                    <i class="like-band active" href="" onclick="onLike({{$res->id}})" > </i>
                  <?php } ?>
                  
                    <i class="share-band compartir" href="javascript:;"> </i>
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

<script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop