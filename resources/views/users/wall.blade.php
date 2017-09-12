@extends('layouts.walls')
<meta http-equiv="X-UA-Compatible" content="IE=11">
<link rel="stylesheet" type="text/css" href="../../css/bands_comment.css">
<link rel="stylesheet" type="text/css" href="../../css/contactList.css">

<style type="text/css">
    
  *, html, body {
    padding: 0;
    margin: 0;
    outline: none;
    box-sizing: border-box;
    list-style-type: none;
    text-decoration: none;
    font-family: 'Montserrat', sans-serif;
  }


  .wall-container {
    width: 100%;
    height: auto;
    float: left;
    position: relative;
  }

  .wall-container .inner-container {
    width: 850px;
    height: auto;
    float: none;
    margin: 0 auto;
    min-height: 20em;
  }

  .wall-area,
  .video-area {
    
    border: 1px solid #ebebe7;
    min-height: 20em;
  }

  .wall-area{
    float: left;
    width: 530px;
  }

  .wall-area .main-post{
    width: 100%;
    height: auto;
    float: left;
  }


  .wall-area .main-post .top{
    width: 100%;
    height: 3em;
    padding: 0.9em;
    background: #f6f7f9;
    border-bottom: 1px solid #ebebe7;
  }

  .wall-area .main-post .top ul{
    width: 100%;
    display: inline-block;
  }
  .wall-area .main-post .top ul li{
    float: right;
    padding: 0 0.4em;
    position: relative;
  } 

  .wall-area .main-post .top ul li:not(:first-child):after{
    content: '';
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background: #ebebe7;
    position: absolute;
  }

  .wall-area .main-post .top ul li a{ 
    color: #afaaaa;
  }

  .wall-area .main-post .post-area  {
    width: 100%;
    height: auto;
    float: left;
    border-bottom: 1px solid #ebebe7;

  }

  .wall-area .main-post .post-area .user-area{
    width: 20%;
    height: 7em;
    float: left;
    border-right: 1px solid #ebebe7;
    position: relative;
  }

  .wall-area .main-post .post-area .user-area .avatar{ 
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    transform: translate(-50%,-50%);
    position: absolute;
    border: 1px solid #ebebe7;
    background: url(http://ell.h-cdn.co/assets/cm/14/52/549b4f3aefb5a_-_elle-ed-sheeran-v-elv.jpg)no-repeat;
    background-size: cover;
  }

  .wall-area .main-post .post-area .input-area{
    width: 80%;
    height: 7em;
    float: left;
    border: 1px solid #ebebe7;
  }

  .wall-area .main-post .post-area .input-area textarea{ 
    width: 100%;
    height: 100%;
    resize:  none;
    outline: none;
    padding: 0.5em;
    border: 1px solid white;
  }

  .wall-area .main-post .post-area .tool-bar{
    width: 100%;
    height: 3em;
    float: left;
    padding: 0.8em;
    box-shadow: none;
    background: #f6f7f9;
    
  }
  .wall-area .main-post .post-area .tool-bar button.btn-publicar{ 
    width: 80px;
    height: 25px;
    color: white;
    border: none;
    float: right;
    cursor: pointer;
    background: -webkit-linear-gradient(-45deg, #e42693 , #6e39a6);
  }

  .wall-area .history-post {
    width: 100%;
    height: auto;
    float: left;
    margin-top: 1em;
    /*min-height: 30em;*/
  }

  .wall-area .history-post .post-item {
    width: 100%;
    float: left;
    height: auto;
    min-height: 6em;
    background: #f6f7f9;
  }

  .wall-area .history-post .post-item .user-area {
    width: 100%;
    height: 5em;
    float: left;
    padding: 0.7em 1em 1em 1.2em;
    background: #f6f7f9;  
    position: relative;
  }

  .wall-area .history-post .post-item .user-area .avatar {
    width: 60px;
    height: 60px;
    float: left;
    background: url(http://ell.h-cdn.co/assets/cm/14/52/549b4f3aefb5a_-_elle-ed-sheeran-v-elv.jpg)no-repeat;
    background-size: cover;
  }

  .wall-area .history-post .post-item .user-area .data {
    float: left;
    padding-left: 1em;
  }

  .wall-area .history-post .post-item .user-area .data h1 a{
    color: #01b1e6;
    font-size: 18px;
    font-weight: 100;
  }

  .wall-area .history-post .post-item .user-area .data p  {
    color: #afaaaa;
  }

  .wall-area .history-post .post-item .user-post {
    width: 100%;
    float: left;
    min-height: 4em;
    border-top: 1px solid #e2e2e2;
  }

  .wall-area .history-post .post-item .user-post .post-content{ 
    width: 100%;
    border-bottom: 1px solid #e2e2e2;
    padding: 1em;
  }
  .wall-area .history-post .post-item .user-post .post-content span{
    line-height: 22px;
  }


  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar,
  .wall-area .history-post .post-item .user-post .tool-bar{
    width: 100%;
    height: 3em;
    float: left;
    padding: 0.8em;
    box-shadow: none;
    background: #f6f7f9;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul,
  .wall-area .history-post .post-item .user-post .tool-bar ul{
    width: 100%;
    display: inline-block;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul li,
  .wall-area .history-post .post-item .user-post .tool-bar ul li{
    float: right;
    padding: 0 0.4em;
    position: relative;
  } 

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul li a,
  .wall-area .history-post .post-item .user-post .tool-bar ul li a {
    color: #afaaaa;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul li:not(:first-child):after,
  .wall-area .history-post .post-item .user-post .tool-bar ul li:not(:first-child):after{
    content: '';
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    position: absolute;
  }

  .wall-area .history-post .post-item .user-post .list-comment {
    width: 100%;
    height: auto;
    min-height: 3em;
    float: left;
    background: #ebebe7;
    margin-bottom: 2em;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li{
    width: 100%;
    height: auto;
    float: left;
    /*padding: 0.8em 0.5em;*/
    border: 1px solid white;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li .avatar{
    width: 60px;
    height: 60px;
    float: left;
    margin: 0.5em;
    background: url(http://ell.h-cdn.co/assets/cm/14/52/549b4f3aefb5a_-_elle-ed-sheeran-v-elv.jpg)no-repeat;
    background-size: cover;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li span a{
    color: #01b1e6;
    float: left;
    font-size: 14px;
    margin-left: 0em;
  }
  .wall-area .history-post .post-item .user-post .list-comment  ul li span {
    font-size: 12px;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area {
    height: auto;
    float: left;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .text-area {
    width: 26.8em;
    height: 4em;
    float: left;
    margin-top: 0.4em;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .text-area textarea{ 
    width: 100%;
    height: 100%;
    border: none;
    resize: none;
    outline: none;
    padding: 0.5em;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul li {
    width: auto;
    border: none;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar ul li a{ 
    width: 80px;
      height: 25px;
      color: white;
      border: none;
      float: right;
      cursor: pointer;
      background: tomato;
      line-height: 26px;
      font-size: 12px;
      text-align: center;
  }

  .wall-area .history-post .post-item .user-post .list-comment  ul li.comment-post-area .tool-bar {
    padding: 0.5em 0;
    background: transparent;
    border-top: 1px solid #ebebe7;
  }
  
  .wall-area .history-post .post-item .user-post .list-comment  ul li .media-post{
    width: 100%;
    height: 262px;
    float: left;
    color: white;
    text-align: center;
    background: tomato;   
  }

  .tool-bar.comment {
    padding: 0!important;
    margin-top: 1em;
  }

  .tool-bar.comment ul li {
    float: right!important;
    width: auto!important;
    border: none!important;
  }

    .comments-options {
      width: 10px;
      height: 10px;
      position: absolute;
      right: 10px;
      top: 10px;
      cursor: pointer; 
      position: absolute;
      background: url('../../images/arrow-bottom.png');
      background-size: cover;
    }

    .comments-options ul{
        top: 15px;
        right: 0;
        width: auto;
        min-width: 8em;
        position: absolute;
        padding: 1em 0em;
        background: white;
        display: none;
        box-shadow: 1px 1px 1px 1px #ebebe7;
    }

    .comments-options.active ul{
      display: block;
    }

    .comments-options.active ul a{
      color: black;
    }

    .comments-options ul li{
      padding: 0.5em 0;
      text-align: center;
      cursor: pointer;
    }

    .comments-options ul li:hover {
      background: #ebebe7;
    }
    .comments-options ul li:hover a {
      color: #e42693;
    }

    .comments-options ul li:not(:last-child){
      border-bottom: 1px solid #ebebe7;
    }

  /*------------------------------------------------------------*/

  .video-area{
      width: 300px;
      height: 366px;
      float: right;
      padding: 1em;
      /*max-height: 44em;*/
      /*overflow: hidden;*/
      background: white;
      box-shadow: 2px 1px 2px 0px #9c9c9c;
    }

    .video-area .header{
      width: 100%;
      height: 20px; 
      text-align: center;
      margin-bottom: 1em;
    }

    .video-area .header p{ 
      text-align: center;
      padding-bottom: 0.8em;
      border-bottom: 1px solid #ebebe7;
      font-size: 15px;
    }

    .video-area .video-container {
      width: 100%;
      height: auto;
      padding: 0 0.5em;
      margin-top: 1em;
      min-height: 10em;
       
      overflow: hidden;
    }


    /* -------------------------------------------------------------------------------- */

    .swiper-container {
          width: 100%;
          height: 100%;
          margin-left: auto;
          margin-right: auto;
      }
      .swiper-slide {
        height: 125px!important;
          text-align: center;
          font-size: 18px;
          background: #fff;
           
          /* Center slide text vertically */
          display: -webkit-box;
          display: -ms-flexbox;
          display: -webkit-flex;
          display: flex;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          -webkit-justify-content: center;
          justify-content: center;
          -webkit-box-align: center;
          -ms-flex-align: center;
          -webkit-align-items: center;
          align-items: center;
          position: relative;
          padding: 3.9em;
          border-bottom: 1px solid #ebebe7;
        
      }

      .thumb-video {
        top: 0;
        width: 100%;
        height: 100%;
        max-height: 23em;
        position: absolute;
      }

      .thumb-video-area {
        width: 130px;
        height: 94px;
        float: left;
      }
      .thumb-toolbar-area {
        width: 190px;
        height: 50px;
        float: left;
      }

      .thumb-toolbar-area .video-info {
        width: 200px;
        height: 100%;
        float: left;
        text-align: left;
        padding: 0.3em 0 0 0.5em;
        font-size: 15px;
      }

      .thumb-toolbar-area .video-like{
        width: 30px;
        height: 27px;
        float: right;
        cursor: pointer;
         
      } 
    .like-comment{
      background: url(../../images/resources/like_off.png)no-repeat!important; 
      background-size: 100% 100%!important;
    }


    .like-comment.active{
      background: url(../../images/resources/like_on.png)no-repeat!important; 
      background-size: 100% 100%!important;
    }

    .video-like{
      background: url(../../images/resources/like_off.png)no-repeat!important; 
      background-size: 100% 100%!important;
    }

    .video-like.active{
      background: url(../../images/resources/like_on.png)no-repeat!important; 
      background-size: 100% 100%!important;
    }

    .share-icon{
      background: url(../../images/share.png)no-repeat!important; 
      background-size: 100% 100%!important;
    }

  .edit-a{  
    font-size: 12px;
    color: white!important;
    text-align: center;
  }

.video-container{
    margin-top: 2%;
    background: url(../../images/resources/thumbnail_video.png)no-repeat;
    background-size: 100% auto;
  }

  .controls button[data-state="play"] {
     background-image: none;
  }

@media all and (-ms-high-contrast:none)
 {
   .edit-a{
    transform: translate(-50%, 0%)!important;
   }
 }

  
.text-area.responses{
 /* width: 88%;*/
}
.post-new-coment{
  padding: 0em 0em!important;
}

@supports (overflow:-webkit-marquee) and (justify-content:inherit) {
  
  textarea.edit-post {
    width: 99.7%;
    margin-left: 6px;  
  }


  @media(max-width: 450px) {
    
    textarea.edit-post {
      width: 97.8%; 
    }

  }

  @media(max-width: 380px) {
    
    textarea.edit-post {
      width: 97.1%; 
    }


  }

  @media(max-width: 350px) {
    
  
    textarea.edit-post {
      width: 97%; 
    }

  }

}

.post-area{
  position: relative;
}
</style>

@section('content')

  <?php if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = DB::table('users')->find($id);
  }?>

<div class="overlay">
  <div class="container">
    <div class="close-v"></div>
    <h4>Cargar Video</h4>
     <form id="validateSubmitForm" action="{{ action('CommentController@videoWall')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
        <input type="hidden" name="id_wall" value="{{ $user->id }}">
          
            <input class="input-type-1" type="text" name="title" id="title" placeholder="Escribí el título del/ los video/ s..." autocomplete="off" style="width: 100%;">
            <div class="video-container"></div>
            <div class="timer">
              <div class="loader">
            <svg class="circular-loader" viewBox="25 25 50 50" >
                <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#e42693" stroke-width="2" />
            </svg>
              </div>
            </div>
            <input type="text" id="array_video" name="array_video" style="display: none;">

            <input class="load_vid" id="upload_video" type="file" accept="video/*" name="video" style="display: none;" size="20"><br/>

            <button class="submit_btn image" type="submit" disabled="disabled" id="btn-sub-vid">publicar</button>

      </form>
  </div>
</div>


<div class="overlay-img">
  <div class="container">
    <div class="close"></div>
      <h4>Cargar Imágenes</h4>
        <form method="POST" action="/multipictures" enctype="multipart/form-data">
          {{ csrf_field() }}
            <input type="hidden" name="id_wall" value="{{ $user->id }}">
            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
            <input class="input-type-1" type="text" name="title" id="title" placeholder="Escribí el título de la/ s imágen/ es..." autocomplete="off" style="width: 100%;">
            <div class="img-container"></div>
              <div class="timer">
                <div class="loader">
          <svg class="circular-loader"viewBox="25 25 50 50" >
            <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#e42693" stroke-width="2" />
          </svg>
                </div>
              </div>
            <input type="text" id="array" name="array" style="display: none;">
            <input class="load_img" type="file" id="load_img" accept="image/*" name="picture[]" multiple style="display: none;" size="20"><br/>
          <button class="submit_btn image" type="submit" disabled="disabled" id="btn-sub-img">publicar</button>
        </form>
  </div>
</div>

<div class="wall-container">
  <div class="inner-container">
    <div class="wall-area">
      <!-- Main Post Top Area --> 
      <div class="main-post">
        <div class="top">
          <ul>
          <li class="upload-images"><a href="javascript:;">IMÁGENES</a></li>
          <li class="upload-videos"><a href="javascript:;">VIDEOS</a></li>
          </ul>
        </div>
        <div class="post-area">
          
          <div class="user-area">
            <div class="avatar" style="background-image: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
            <input id="profile_pic" class="hidden" value="{{Auth::user()->profile_pic}}">
          </div>
          <div class="text-area responses">
            <div class="input-text main-textarea" contenteditable="true" style="outline:0px;" name="comment"></div>
          </div>

        <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
        <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
        <input type="hidden" id="username" name="username" value="{{ Auth::user()->name }}">
        <input type="hidden" id="userArray" name="userArray">
            
          <div class="tool-bar">
            <button class="btn-publicar">PUBLICAR</button>
          </div>
          
        </div>
      </div>
      <!-- Main Post Top Area --> 
    
      <!-- Historial de Publicaciones -->
      <?php $showedalbums = []; ?>
      @foreach($comments as $comment)
        <?php $usuario = DB::table('users')
                                    ->where('id', $comment->id_user)
                                    ->first();
                      $response = DB::table('comments')
                          ->where('id_comment', $comment->id)
                          ->where('id_wall', $user->id_wall)
                          ->whereNull('id_response')
                          ->orderBy('created_at', 'asc')
                          ->get();
                      $count_responses = count($response); ?>
                    
                    <?php  if ($comment->type == 'com') { ?>
                    <div class="history-post" id="history-list-{{$comment->id}}">
                      <div class="post-item" id="{{$comment->id}}">
                        <div class="user-area">
                          <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_wall == $comment->id_wall) { ?>
                      
                          <div class="comment-options">
                            <ul>
                                @if (Auth::user()->id == $comment->id_user)
                                  <li><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                                @else
                                  <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                                @endif
                              <li><a href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar</a></li>
                            </ul>
                          </div>

                        <?php } ?>
                          <div class="avatar" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                          <div class="data class-{{$comment->id}}">
                            <h1><a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}</a></h1>
                            <p>{{$comment->created_at}}</p>
                          </div>
                        </div>

                      <div class="user-post">
                        <div class="post-content">
                          <span id="{{$comment->id}}">{!! $comment->comment !!}</span>
                        </div>

                          <div class="tool-bar">
                            <span class="reply-counter">Respuestas: {{$count_responses}}</span>
                            <ul>
                              <li><a class="share-band" href="javascript:;"> </a></li>
                              <li><a class="create-comment" href="javascript:;"></a></li>
                              <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $comment->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                if (is_null($very)){ ?>
                                  <li><a class="like-band like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php }else{ ?>
                                  <li><a class="like-band active like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php } ?>
                                <li><a class="comment-like counter-like-{{$comment->id}}" href="javascript:;"> {{$comment->like}} </a></li>
                                <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>

                            </ul>
                          </div>

                        <div class="list-comment">
                        <ul>
                        <?php if (count($response) > 0){ ?>
                              @foreach($response as $res)
                                  <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                                    <li class="response_id_{{$res->id}}">

                                    <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_wall == $comment->id_wall) { ?>
                                      <div class="comment-options responses">
                                        <ul>
                                          @if (Auth::user()->id == $res->id_user)
                                            <li><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                          @else
                                            <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                          @endif
                                          <li><a href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar</a></li>
                                        </ul>
                                      </div>

                                    <?php } ?>
                                    <div class="avatar" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                                    <span class="name_user"><a href="/users/wall?id={{$resuser->id}}">{{$resuser->name}}</a></span>
                                    <span class="data_response" id="{{$res->id}}">{!! $res->comment !!}</span> 
                                    <div class="tool-bar comment">
                                      <ul>
                                        <li><a class="share-band" href="javascript:;"> </a></li>
                                        <li><a class="create-comment" href="javascript:;"></a></li>
                                          <?php $very = DB::table('pv_usercomment')
                                                      ->where('id_comment', $res->id)
                                                      ->where('id_user', Auth::user()->id)
                                                      ->first(); 
                                        if (is_null($very)){ ?>
                                          <li><a class="like-band like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                          
                                        <?php }else{ ?>
                                          <li><a class="like-band active like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                          
                                        <?php } ?>
                                        <li><a class="comment-like counter-like-{{$res->id}}" href="javascript:;"> {{$res->like}} </a></li>
                                        
                                        <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>
                                      </ul>
                                    </div>
                                  </li>
                              @endforeach
                              <li class="comment-post-area post-area">
                                <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                  <div class="text-area responses">
                                    <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                  </div>
                                  <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                  <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                  <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                                 <div class="tool-bar">
                                    <ul>
                                      <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                   </ul>
                                </div>
                              </li>
                <?php }else{ ?>
                        <li class="comment-post-area post-area">
                  
                          <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                            <div class="text-area responses">
                              <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                            </div>
                            <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                            <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                            <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                            <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                           <div class="tool-bar">
                              <ul>
                                <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                             </ul>
                          </div>
                        </li>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>  
      </div>

          <?php }if ($comment->type == 'pic') { ?>
            <div class="history-post" id="history-list-{{$comment->id}}">
                <div class="post-item" id="{{$comment->id}}">
                    <div class="user-area">
                    <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_wall == $comment->id_wall) { ?>
                    
                      <div class="comment-options">
                        <ul>
                          @if (Auth::user()->id == $comment->id_user)
                            <li><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @else
                            <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @endif
                          <li><a href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar</a></li>
                        </ul>
                      </div>

                    <?php } ?>
                      <div class="avatar" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                      <div class="data class-{{$comment->id}}">
                    
                    <?php if (is_null($comment->title)) { ?>
                      
                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}</a><span class="span-edit" style="font-size: 14px;"></span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>

                    <?php }else{ ?>

                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}: </a><span class="span-edit" style="font-size: 14px;">{{$comment->title}}</span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>
                  
                    <?php } ?>

                        <p>{{$comment->created_at}}</p>
                      </div>
                    </div>

                    <div class="user-post">
                      <div class="media-post">
                        <img src="{{$comment->comment}}" style="width: 100%; height: auto;">
                      </div>
                          <div class="tool-bar">
                          <span class="reply-counter">Comentarios: {{$count_responses}}</span>
                            <ul>
                              <li><a class="share-band" href="javascript:;"> </a></li>
                              <li><a class="create-comment" href="javascript:;"></a></li>
                              <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $comment->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                if (is_null($very)){ ?>
                                  <li><a class="like-band like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php }else{ ?>
                                  <li><a class="like-band active like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php } ?>
                                <li><a class="comment-like counter-like-{{$comment->id}}" href="javascript:;"> {{$comment->like}} </a></li>
                                <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>

                            </ul>
                          </div>
                      <div class="list-comment" style="width: 100%;">
                        <ul>
                        <?php if (count($response) > 0){ ?>
                          @foreach($response as $res)
                              <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                                <li class="response_id_{{$res->id}}">

                                <?php if (Auth::user()->id == $res->id_user || Auth::user()->id_wall == $res->id_wall) { ?>
                                  <div class="comment-options responses">
                                    <ul>
                                      @if (Auth::user()->id == $res->id_user)
                                        <li><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                      @else
                                        <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                      @endif
                                      <li><a href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar</a></li>
                                    </ul>
                                  </div>

                                <?php } ?>
                                <div class="avatar" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                                <span class="name_user"><a href="/users/wall?id={{$resuser->id}}">{{$resuser->name}}</a></span>
                                <span class="data_response" id="{{$res->id}}">{!! $res->comment !!}</span> 
                                <div class="tool-bar comment">
                                  <ul>
                                    <li><a class="share-band" href="javascript:;"> </a></li>
                                    <li><a class="create-comment" href="javascript:;"></a></li>
                                      <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $res->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                    if (is_null($very)){ ?>
                                      <li><a class="like-band like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                      
                                    <?php }else{ ?>
                                      <li><a class="like-band active like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                      
                                    <?php } ?>
                                    <li><a class="comment-like counter-like-{{$res->id}}" href="javascript:;"> {{$res->like}} </a></li>
                                    
                                    <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>
                                  </ul>
                                </div>
                              </li>
                              @endforeach
                              <li class="comment-post-area">
                              <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                <div class="text-area responses">
                                  <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                </div>
                                <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                               <div class="tool-bar">
                                  <ul>
                                    <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                 </ul>
                              </div>
                          </li>
                        <?php }else{ ?>
                        <li class="comment-post-area">
                                  <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                  <div class="text-area responses">
                                    <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                  </div>
                                  <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                  <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                  <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                                    <div class="tool-bar">
                                      <ul>
                                        <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                      </ul>
                                    </div>
                                </li>
                        <?php } ?>
                            </ul>
                        </div>
                      </div>
                    </div>  
                  </div>

          <?php }if ($comment->type == 'video') { ?>

          <div class="history-post" id="history-list-{{$comment->id}}">
            <div class="post-item" id="{{$comment->id}}">
                    <div class="user-area">
                    <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_wall == $comment->id_wall) { ?>
                     
                      <div class="comment-options">
                        <ul>
                          @if (Auth::user()->id == $comment->id_user)
                            <li><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @else
                            <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @endif
                          <li><a href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar</a></li>
                        </ul>
                      </div>

                    <?php } ?>
                      <div class="avatar" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                      <div class="data class-{{$comment->id}}">
                    <?php if (is_null($comment->title)) { ?>
                      
                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}</a><span class="span-edit" style="font-size: 14px;"></span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>

                    <?php }else{ ?>

                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}: </a><span class="span-edit" style="font-size: 14px;">{{$comment->title}}</span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>
                  
                    <?php } ?>
                        <p>{{$comment->created_at}}</p>
                      </div>
                    </div>

                    <div class="user-post">
                            
                          <div class="media-post">
                            <div class="media-post-content">
                            
                              <div class="overlay-icon-play">
                              <div class="icon-play"></div>
                          </div> 
                                
                                <video id="video_{{$comment->id}}" width="100%">
                                  <source src="{{$comment->comment}}" type="video/mp4">
                                </video>
                              
                              </div>
                          </div>

                          <div class="tool-bar">
                          <span class="reply-counter">Comentarios: {{$count_responses}}</span>
                            <ul>
                              <li><a class="share-band" href="javascript:;"> </a></li>
                              <li><a class="create-comment" href="javascript:;"></a></li>
                              <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $comment->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                if (is_null($very)){ ?>
                                  <li><a class="like-band like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php }else{ ?>
                                  <li><a class="like-band active like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php } ?>
                                <li><a class="comment-like counter-like-{{$comment->id}}" href="javascript:;"> {{$comment->like}} </a></li>
                                <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>

                            </ul>
                          </div>

                        <div class="list-comment" style="width: 100%;">
                        <ul>
                        <?php if (count($response) > 0){ ?>
                          @foreach($response as $res)
                              <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                                <li class="response_id_{{$res->id}}">

                                <?php if (Auth::user()->id == $res->id_user || Auth::user()->id_wall == $res->id_wall) { ?>
                                  <div class="comment-options responses">
                                    <ul>
                                      @if (Auth::user()->id == $res->id_user)
                                        <li><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                      @else
                                        <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                      @endif
                                      <li><a href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar</a></li>
                                    </ul>
                                  </div>

                                <?php } ?>
                                <div class="avatar" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                                <span class="name_user"><a href="/users/wall?id={{$resuser->id}}">{{$resuser->name}}</a></span>
                                <span class="data_response" id="{{$res->id}}">{!! $res->comment !!}</span> 
                                <div class="tool-bar comment">
                                  <ul>
                                    <li><a class="share-band" href="javascript:;"> </a></li>
                                    <li><a class="create-comment" href="javascript:;"></a></li>
                                      <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $res->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                    if (is_null($very)){ ?>
                                      <li><a class="like-band like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                      
                                    <?php }else{ ?>
                                      <li><a class="like-band active like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                      
                                    <?php } ?>
                                    <li><a class="comment-like counter-like-{{$res->id}}" href="javascript:;"> {{$res->like}} </a></li>
                                    
                                    <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>
                                  </ul>
                                </div>
                              </li>
                          @endforeach
                          <li class="comment-post-area">
                          
                            <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                              <div class="text-area responses">
                                <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                              </div>
                              <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                              <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                              <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                              <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                             <div class="tool-bar">
                                <ul>
                                  <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                               </ul>
                            </div>
                        </li>
                      <?php }else{ ?>
                        <li class="comment-post-area">
                                  <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                  <div class="text-area responses">
                                    <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                  </div>
                                  <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                  <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                  <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                                    <div class="tool-bar">
                                      <ul>
                                        <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                      </ul>
                                    </div>
                                </li>
                      <?php } ?>
                            </ul>
                    </div>
                        </div>
                    </div>  
                  </div>
          <?php } if ($comment->type == 'album' && !in_array($comment->id_album, $showedalbums)) {

              $showedalbums[] = array_push($showedalbums, $comment->id_album);
                          
                              $pictures = DB::table('comments')
                                    ->where('id_album', $comment->id_album)
                                    ->where('type', 'album')
                                    ->get(); 
                                  
                              $album = DB::table('albums')
                                    ->where('id_wall', $comment->id_wall)
                                    ->where('id', $comment->id_album)
                                    ->first();
                                  
                              $picId = DB::table('comments')
                                          ->where('id_album', $comment->id_album)
                                          ->where('type', 'album')
                                          ->first();
                              $count = count($pictures);
                              $i=0
                  ?>

          <div class="history-post" id="history-list-{{$comment->id}}">
              <div class="post-item" id="{{$comment->id}}">
                <div class="user-area">
                  <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_wall == $comment->id_wall) { ?>
                    
                      <div class="comment-options">
                        <ul>
                          @if (Auth::user()->id == $comment->id_user)
                            <li><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @else
                            <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$comment->id}})">Editar</a></li>
                          @endif
                          <li><a href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar</a></li>
                        </ul>
                      </div>

                    <?php } ?>
                  <div class="avatar" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                  <div class="data class-{{$comment->id}}">
                    <?php if (is_null($album->name)) { ?>
                      
                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}</a><span class="span-edit" style="font-size: 14px;"></span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>

                    <?php }else{ ?>

                      <h1>
                        <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}: </a><span class="span-edit" style="font-size: 14px;">{{$album->name}}</span>
                        <input type="hidden" class="input-edit" name="title">
                      </h1>
                  
                    <?php } ?>
                        <p>{{$comment->created_at}}</p>
                      </div>
                    </div>

                    <div class="user-post">
                            
                          <div class="media-post">
                            <div class="media-post-content">
                                  <ul class="multi-image" style="text-align: center;">
                                  @foreach($pictures as $pic)
                                     <img src="{{$pic->comment}}" style="width: 40%; height: auto;">
                                  @endforeach
                                  </ul>
                                </div>
                          </div>
                          <div class="tool-bar">
                          <span class="reply-counter">Comentarios: {{$count_responses}}</span>
                            <ul>
                              <li><a class="share-band" href="javascript:;"> </a></li>
                              <li><a class="create-comment" href="javascript:;"></a></li>
                              <?php $very = DB::table('pv_usercomment')
                                                  ->where('id_comment', $comment->id)
                                                  ->where('id_user', Auth::user()->id)
                                                  ->first(); 
                                if (is_null($very)){ ?>
                                  <li><a class="like-band like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php }else{ ?>
                                  <li><a class="like-band active like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a></li>
                                  
                                <?php } ?>
                                <li><a class="comment-like counter-like-{{$comment->id}}" href="javascript:;"> {{$comment->like}} </a></li>
                                <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>

                            </ul>
                          </div>
                        <div class="list-comment" style="width: 100%;">
                        <ul>
                        <?php if (count($response) > 0){ ?>
                            @foreach($response as $res)
                                <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                                  <li class="response_id_{{$res->id}}">

                                  <?php if (Auth::user()->id == $res->id_user || Auth::user()->id_wall == $res->id_wall) { ?>
                                    <div class="comment-options responses">
                                      <ul>
                                        @if (Auth::user()->id == $res->id_user)
                                          <li><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                        @else
                                          <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                        @endif
                                        <li><a href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar</a></li>
                                      </ul>
                                    </div>

                                  <?php } ?>
                                  <div class="avatar" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                                  <span class="name_user"><a href="/users/wall?id={{$resuser->id}}">{{$resuser->name}}</a></span>
                                  <span class="data_response" id="{{$res->id}}">{!! $res->comment !!}</span> 
                                  <div class="tool-bar comment">
                                    <ul>
                                      <li><a class="share-band" href="javascript:;"> </a></li>
                                      <li><a class="create-comment" href="javascript:;"></a></li>
                                        <?php $very = DB::table('pv_usercomment')
                                                    ->where('id_comment', $res->id)
                                                    ->where('id_user', Auth::user()->id)
                                                    ->first(); 
                                      if (is_null($very)){ ?>
                                        <li><a class="like-band like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                        
                                      <?php }else{ ?>
                                        <li><a class="like-band active like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a></li>
                                        
                                      <?php } ?>
                                      <li><a class="comment-like counter-like-{{$res->id}}" href="javascript:;"> {{$res->like}} </a></li>
                                      
                                      <li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>
                                    </ul>
                                  </div>
                                </li>
                            @endforeach
                             <li class="comment-post-area">

                               <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                  <div class="text-area responses">
                                    <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                  </div>
                                  <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                  <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                  <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                                 <div class="tool-bar">
                                    <ul>
                                      <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                   </ul>
                                </div>
                            </li>
                      <?php }else{ ?>
                        <li class="comment-post-area">
                                  <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                                  <div class="text-area responses">
                                    <div class="input-text" contenteditable="true" style="outline:0px;"></div>
                                  </div>
                                  <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="id_wall" name="id_wall" value="{{ $user->id }}">
                                  <input type="hidden" class="username" name="username" value="{{ Auth::user()->name }}">
                                  <input type="hidden" class="id_comment" name="id_comment" value="{{ $comment->id }}">
                                    <div class="tool-bar">
                                      <ul>
                                        <li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>
                                      </ul>
                                    </div>
                                </li>
                      <?php } ?>
                            </ul>
                    </div>
                        </div>
                    </div>  
                  </div>

          <?php } ?>
      @endforeach  

      <!-- Historial de Publicaciones -->
  </div>
  <div class="video-area" style="margin-left: 20px;">
      <div class="header">
        <p>MI MÚSICA FAVORITA</p>
      </div>

      <div class="related-area" style="width: 100%;">
          <ul>
          <?php $count = 0; ?>
            @foreach($vi as $video) 
              
              <?php if (is_null($video->id_musician)) { ?>

                <li class="video-section">
                
                  <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">
              
                    <?php $query = explode('=', $video->url); ?>

                      <span class="thrumb" style="background: url('//img.youtube.com/vi/{{$query[1]}}/0.jpg'); background-size: cover;">
                    
                      </span>
                  
                      <div class="info">

                          <?php $vinfo = explode('-', $video->name); ?>

                            <a class="video-info" href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">

                              <h3>{{ $vinfo[0] }}</h3>

                            </a>
                            <a class="video-info" href="/bands/comments?id={{$video->id_band}}">

                              <p>{{ $vinfo[1] }}</p>

                            </a>
                            
                            <small>Vistas: {{ $video->views }}</small>
                        
                      </div>
                  </a>
                
                </li>

              <?php }else{ ?>

              <li class="video-section">
                
                  <?php $user_wall = DB::table('users')->where('id_musician', $video->id_musician)->first();

                      $query = explode('=', $video->url); ?>
                
                        <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}">

                      <span class="thrumb" style="background: url('//img.youtube.com/vi/{{$query[1]}}/0.jpg'); background-size: cover;">
                    
                      </span>
                  
                      <div class="info">

                          <?php $vinfo = explode('-', $video->name); ?>

                            <a class="video-info" href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}">

                              <h3>{{ $vinfo[0] }}</h3>

                            </a>
                            <a class="video-info" href="/users/wall?id={{$user_wall->id_wall}}">

                              <p>{{ $vinfo[1] }}</p>

                            </a>
                            
                            <small>Vistas: {{ $video->views }}</small>
                        
                      </div>
                  </a>
                
                </li>
              
              <?php } ?>

              <?php $count++;
                if ($count == 10) { 
                    break;
                } 
              ?>
            @endforeach
           

            <!-- Ultimo Item de la lista, para visualizar mas videos -->
              <?php if (count($vi) > 9) { ?>

                <li class="last-item-video" id="user_{{$user->id}}">

                  <button class="show-more"><a style="color: black;" href="/wall/yourfavorites?id={{$user->id}}">VER MÁS</a></button>
                
                </li>
              
              <?php }else{ ?>
              
                <li class="last-item-video">
              
                </li>
              
              <?php } ?>
            <!-- Ultimo Item de la lista, para visualizar mas videos --> 

          </ul>
        </div>

  </div>

</div>

<?php $users = DB::table('users')->get(); ?>


@stop

@section('jsfunctions')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
<script type="text/javascript" src="../../js/tag.js"></script>


<script type="text/javascript">
  
var not = <?php echo $vi; ?> ;
var users = <?php echo $users; ?> ;

  $('.show-more').on('click',function(){

    var id = $(this).parent('.last-item-video').attr('id').split('_').pop();

    window.location.href = "http://www.youlovemymusic.com/wall/yourfavorites?id="+id;

/*
    var numchild = $('.video-section').length
      , maxnumchild = numchild + 10;

    var concatenar = '';

    for(var i = numchild; i <= maxnumchild; i++) {
    
      if(not[i]) {
        if (not[i].id_musician == null) {
        var img = not[i].url
        , name = not[i].name;

          img = img.split('=').pop();
          name = name.split('-');
          
          concatenar += '<li class="video-section">'+
                          '<a href="/bands/band_comments?idvideo='+not[i].id+'&idband='+not[i].id_band+'">'+
                            '<span class="thrumb" style="background: url(//img.youtube.com/vi/'+img+'/0.jpg); background-size: cover;"></span>'+
                              '<div class="info">'+
                                '<a class="video-info" href="/bands/band_comments?idvideo='+not[i].id+'&idband='+not[i].id_band+'">'+
                                  '<h3>'+name[0]+'</h3>'+
                                '</a>'+
                                '<a class="video-info" href="/bands/comments?id='+not[i].id_band+'">'+
                                 ' <p>'+name[1]+'</p>'+
                                '</a>'+
                               ' <small>Vistas: '+not[i].views+'</small>'+
                              '</div>'+
                            '</a>'+
                          '</li>'
      }else{

         var img = not[i].url
        , name = not[i].name;

          img = img.split('=').pop();
          name = name.split('-');

          var result = $.grep(users, function(e){ return e.id_musician == not[i].id_musician; });
          
          concatenar += '<li class="video-section">'+
                          '<a href="/musician/musician_comments?id='+result.id_wall+'&idvideo='+not[i].id+'&idmusic='+not[i].id_musician+'">'+
                            '<span class="thrumb" style="background: url("//img.youtube.com/vi/'+img+'/0.jpg"); background-size: cover;"></span>'+
                              '<div class="info">'+
                                '<a class="video-info" href="/musician/musician_comments?id='+result.id_wall+'&idvideo='+not[i].id+'&idmusic='+not[i].id_musician+'">'+
                                  '<h3>'+name[0]+'</h3>'+
                                '</a>'+
                                '<a class="video-info" href="/users/wall?id='+result.id_wall+'">'+
                                 ' <p>'+name[1]+'</p>'+
                                '</a>'+
                               ' <small>Vistas: '+not[i].views+'</small>'+
                              '</div>'+
                            '</a>'+
                          '</li>'

        }
      }
    }

    setTimeout(function(){
      $(concatenar).insertBefore('.last-item-video').last();
    },400);
  */
  });

</script>



<script type="text/javascript">

$( document ).ready(function() { 
  
  var url = window.location.href;
  var comment = url.split('id_comment=').pop();

 });

  $('.comments-options').on('click',function(){
    $(this).toggleClass('active')
  });


  var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 15,
        mousewheelControl: true
    });

  $('.comments-options ul li:first-child').on('click',function(){
  
    var postedText =  $(this).parents('.comments-options').siblings('.text-post');
    var textToEdit = $(postedText).children('p');
    var toolbar = $(postedText).children('.text-post-toolbar');

    $(textToEdit).fadeOut();
    $(toolbar).fadeOut();
    
    /* Append Edit area en area seleccionada */
    $('.text-post').prepend(
      $('<div/>', {'class': 'comment-post edit-area'}).append(
        $('<textarea/>', {'class': 'text-post-edit', 'name': 'edit_comment'}),
        $('<div/>', {'class': 'button-area'}).append(
          $('<button/>', {'class': 'btn-edit-comment edit-a', text: 'FINALIZAR'})
        )
      )
    );  
    /* Append Edit area en area seleccionada */


    var textboxArea = $(textToEdit).prev('.comment-post.edit-area').children('.text-post-edit');
    $(textboxArea).val($(textToEdit).text().replace(/\s+/g, ' ')).fadeIn();
    $(textboxArea).height($(textToEdit).height());
  });


  /* Publicar post Editado */
  $(document).on('click','.btn-edit-comment',function() {

    var textArea = $(this).parent('.button-area').prev('.text-post-edit');
    var textToEdit = $(textArea).parent('.comment-post.edit-area').siblings('p');

    var toolbar =  $(textToEdit).siblings('.text-post-toolbar');
    var editArea =  $(textArea).parent('.comment-post.edit-area');
    
    var idComment = $(textToEdit).attr('id');
    var nameComment = $(textArea).attr('name');

    var postcomment = $(textArea).val();

    // var formData = postcomment.serialize();
    var formData = { 'id_comment': idComment, 'edit_comment': postcomment} ;
    
    $.get('/editcomment?id='+idComment+'&comment='+postcomment, function (response) {
      if (response == 1) {
        console.log('¡commentario Editado!');
      }else{
        console.log(response);
      }
    })


    $(editArea).remove();
    $(textToEdit).text(postcomment).fadeIn();
    $(toolbar).fadeIn();

  });


$( document ).ready(function() {  

  $('.thumb-video-area').each(function(index, item){
      var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
  });
});


  $('.thumb-video-area').on('click',function() {
        var item = $(this).children('a').children('input').val(),
        iframe = $(this).children('a').children('iframe').addClass('my-visible').attr('src', item);
      
        $(this).children('a').children('img').addClass('not-visible');  
        $(this).children('a').children('div').addClass('not-visible');  
    });


  $(document).on('click','.create-comment',function(){
    $(this).closest('.tool-bar').next('.list-comment').toggleClass('active').find('textarea').val('');
  });


  $(document).on('click', 'nav .logo a', function() {
      $('html, body').animate({
          scrollTop: $('html, body').offset().top - 400
      }, 2200);

  });

</script>

@stop