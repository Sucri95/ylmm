@extends('layouts.walls')

<link rel="stylesheet" type="text/css" href="../../css/bands_comment.css">
<link rel="stylesheet" type="text/css" href="../../css/contactList.css">

<style type="text/css">
  .video-comment-content .comment-history-list .parent-comment .toolbox .right.options-icons,
  .toolbox{
    width: 8em!important;
  }
  
  .toolbox .right li,
  .right-items li{
    float: left;
      position: relative;
      min-width: 1.3em!important;
      min-height: 1.3em!important;
      margin: 0 8%;
  }

  .toolbox{
    float: right!important;
  }

  .video-comment-content .comment-history-list .parent-comment .toolbox ul.right li{
    
    padding: 0;
    width: 1.3em;
    height: 1.3em;
  
  }

  .video-comment-content .comment-history-list .parent-comment .toolbox ul.right li button{
    width: 100%!important;
  }

  .toolbox .right li a,
  .right-items li a{
    position: absolute;
    width: 1.3em;
  }

  .comment-like{
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 10px!important;
    color: gray!important;
  }

  div.replay-area > div > div.toolbox > ul > li:nth-child(2) {
    width: 1.3em!important;
    margin-top: 0.2em!important;
}

.video-area {
    box-shadow: none!important;
}

.video-toolbar.main-toolbar{
  padding: 0.5em 0.1em!important;
}

.comment-history-list .toolbox ul li:first-child{

  margin-right: 0;

}

.replay-area .toolbox ul li:first-child{

  margin-right: 0;

}

.replay-area div{
  padding: 0 0!important;
}

.comment-options{
	top: 0px!important;
	right: 0px!important;
}

@media all and (-ms-high-contrast:none)
{
  .comment-options.responses{
    top: 0px;
    right: 0px;
  }
}

iframe{
  min-height: 480px;
}

@media(max-width: 650px) {
  
  iframe{
    min-height: 270px;
  }

}
.post-area{
  position: relative;
}
</style>

@section('content')

  <?php if (isset($_GET['idvideo'])) {
    $id = $_GET['idvideo'];
    $video = DB::table('videos')->find($id);
    $id_wall = $_GET['id'];
  }?>

  <?php if (isset($_GET['idmusic'])) {
    $idmusic = $_GET['idmusic'];
    $musician = DB::table('musicians')->find($idmusic);
    $user = DB::table('users')->where('id_musician', $musician->id)->first();
  }?>

    <div class="super-container"> 
    <div class="inner">
      <div class="main-inner-container bands-video">
        <div class="video-area">

          <div class="video-content">
          <div class="slider-video">
          <a href="javascript:;">
          <?php $views = DB::table('pv_videoview')
                                ->where('id_user', Auth::user()->id)
                                ->where('id_video', $video->id)
                                ->first();
            if (is_null($views)) { ?>
                <img src="" style="height: 100%;" onclick="onView({{$video->id}})" class="img-view">
            <?php }else{ ?>
                <img src="" style="height: 100%;">
            <?php } ?>
              <?php $query = explode('=', $video->url); ?>
              <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
              <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
            </a>
          </div>
          </div> 

          <!-- Area de informacion del video (nombre, usuario, vistas, etc.)  -->
          <div class="video-info-content">
            <div class="video-data">
              
              <div class="title">
              <?php $vinfo = explode('-', $video->name); ?>
                <span style="float: left;">{{$vinfo[0]}}</span>
              </div>

              <div class="user-info">
                <div class="avatar" style="background: url('{{$musician->profile_pic}}'); background-size: cover;"></div>
                <input id="profile_pic" class="hidden" value="{{Auth::user()->profile_pic}}">
                <div class="info-content">
                  <h4>{{$vinfo[1]}}</h4>
                </div>
                <div class="views">
                <?php if (is_null($video->views)) { ?>
                  <span>Vistas: </span><span class="view-counter">0</span>
                <?php }else{ ?>
                  <span>Vistas: </span><span class="view-counter">{{$video->views}}</span>
                <?php } ?>
                </div>
              </div>
            </div>
            <div class="video-toolbar main-toolbar">
              
              <ul class="left-items">
                
              </ul>

              <ul class="right-items right-items-main">
              
              <li><a class="comment-like vlike-counter-{{$video->id}}" href="javascript:;" style="height: 100%;"> {{$video->likes}} </a></li>              
              
              <?php $likes = DB::table('pv_uservideo')
                                ->where('id_user', Auth::user()->id)
                                ->where('id_video', $video->id)
                                ->first();
              

              if (is_null($likes)) { ?>
                <li>
                  <a class="like-band like-band-{{$video->id}}" href="javascript:;" onclick="videoLike({{$video->id}});"> </a>
                </li>
              <?php }else{ ?>
                <li>
                  <a class="like-band active like-band-{{$video->id}}" href="javascript:;" onclick="videoLike({{$video->id}});"> </a>
                </li>
              <?php } ?>

                <li>
                  <a class="share-band" href="javascript:;"> </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Area de informacion del video (nombre, usuario, vistas, etc.)  -->
        

          <!-- Area de descripcion del video -->
          <div class="video-description-content hidden">
          </div>
          <!-- Area de descripcion del video -->
        

          <!-- Area de commentarios del video  -->
          <div class="video-comment-content">
            <div class="header">
            <?php $comments = DB::table('comments')
                ->where('id_video', $video->id)
                ->whereNull('id_comment')
                ->orderBy('created_at', 'desc')
                ->get(); ?>
              <h2><b>Comentarios</b> <?php echo count($comments); ?></h2>
              <span></span>
            </div>

            <!-- Area para crear un nuevo post   -->
            <div class="comment-area post-area">
              <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                <div class="text-area responses"><div class="input-text" contenteditable="true" style="outline:0px;"></div></div>
                  <div class="toolbox">
                    <ul class="right">

                    <input type="hidden" class="id_video" name="id_video" value="{{ $video->id }}">
                    <input type="hidden" class="id_musician" name="id_musician" value="{{ $musician->id }}">
                    <input type="hidden" class="id_user" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="username" name="username" value="{{ Auth::user()->name }}">
                    <input type="hidden" id="userArray" name="userArray">
                    <li class="li-top"><button class="top-publicacion">Publicar</button></li>                  
                  </ul>
                </div>
            </div>
            <!-- Area para crear un nuevo post-->   
            <div class="comment-history-list">
              <div class="parent-comment">
                <div class="top-comment">
                </div>
              </div>
            </div>

  <!-- Lista de commentarios Existentes -->
  @foreach($comments as $comment)
  <?php $usuario = DB::table('users')
                ->where('id', $comment->id_user)
                ->first();
            $response = DB::table('comments')
                ->where('id_comment', $comment->id)
                ->where('id_video', $video->id)
                ->orderBy('created_at', 'asc')
                ->get(); ?>
        <div class="comment-history-list" id="history-list-{{$comment->id}}">
          <div class="parent-comment">
            <div class="top-comment">
             <div class="avatar" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>

              <?php if (Auth::user()->id == $comment->id_user || Auth::user()->id_musician == $musician->id) { ?>
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

              <p>
                <b>
                  <a href="/users/wall?id={{$usuario->id}}">{{$usuario->name}}</a>
                </b><br>
                  <small>{{$comment->created_at}}</small>
              </p>

              <p class="text-comment" id="{{$comment->id}}">
                {!! $comment->comment !!}
              </p>


              <div class="toolbox">
                
                <input type="hidden" name="id_user" class="id_user" value="{{Auth::user()->id}}">
                <input type="hidden" name="id_band" class="id_band" value="{{$musician->id}}">
                <input type="hidden" name="id_video" class="id_video" value="{{$video->id}}">
                <input type="hidden" name="id_comment" class="id_comment" value="{{$comment->id}}">

                <ul class="right options-icons">
                  <li style="position: relative;"><a class="share-band" style="" href="javascript:;"> </a></li>
                  <li><button class="create-comment" style="margin-top: 0px!important;"></button></li>
                <?php $very = DB::table('pv_usercomment')
                              ->where('id_comment', $comment->id)
                              ->where('id_user', Auth::user()->id)
                              ->first();

                if (is_null($very)){ ?>
                  <li>
                    <a class="like-band like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a>
                  </li>
                
                <?php }else{ ?>
                
                  <li>
                    <a class="like-band active like-band-{{$comment->id}}" href="javascript:;" onclick="onLike({{$comment->id}})"> </a>
                  </li>
                
                <?php } ?>
                  
                  <li>
                    <a class="comment-like counter-like-{{$comment->id}}" href="javascript:;"> {{$comment->like}} </a>
                  </li>     
                  <li style="float: left;"></li>
                </ul>
              </div>
              <div class="replay-area" style="height: 25px;"></div>

              <!-- Area de Respuestas  -->
                <?php if (count($response) > 0){ ?>
                  @foreach($response as $res)
                    <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                      <div class="replay-area" id="replay-area_{{$res->id}}">
                        <div class="top-comment">
                          <div class="avatar" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                          <?php if (Auth::user()->id == $res->id_user || Auth::user()->id_musician == $musician->id) { ?>
                            <div class="comment-options responses">
                              <ul>
                                @if (Auth::user()->id == $res->id_user)
                                  <li><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                @else
                                  <li style="display: none;"><a href="javascript:;" onclick="onEdit({{$res->id}})">Editar</a></li>
                                @endif
                                <li>
                                  <a href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar</a>
                                </li>
                              </ul>
                            </div>
                          <?php } ?>
                            <p>
                              <b>
                                <a href="/users/wall?id={{$resuser->id}}">{{$resuser->name}}</a>
                              </b><br>
                              <small>{{$res->created_at}}</small>
                            </p>
                            <p class="text-comment" id="{{$res->id}}">
                             {!! $res->comment !!}
                            </p>

                            <div class="toolbox">
                            <input type="hidden" name="id_user" class="id_user" value="{{Auth::user()->id}}">
                            <input type="hidden" name="id_band" class="id_band" value="{{$musician->id}}">
                            <input type="hidden" name="id_video" class="id_video" value="{{$video->id}}">
                            <input type="hidden" name="id_comment" class="id_comment" value="{{$comment->id}}">
                                <ul class="right options-icons">
                                  <li style="position: relative;"><a class="share-band" style="" href="javascript:;"> </a></li>
                                  <li>
                                    <button class="create-comment" style="margin-top: -2px;"></button> 
                                  </li>
                                  <?php $very = DB::table('pv_usercomment')
                                      ->where('id_comment', $res->id)
                                      ->where('id_user', Auth::user()->id)
                                      ->first(); 
                                    
                                  if (is_null($very)){ ?>

                                    <li>
                                      <a class="like-band like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a>
                                    </li>
                                      
                                  <?php }else{ ?>

                                    <li>
                                      <a class="like-band active like-band-{{$res->id}}" href="javascript:;" onclick="onLike({{$res->id}})"> </a>
                                    </li>
                                      
                                  <?php } ?>
                                    <li><a class="comment-like counter-like-{{$res->id}}" href="javascript:;"> {{$res->like}} </a></li> 
                                </ul>
                            </div>
                            <div class="replay-area" style="height: 25px;"></div>
                        </div>
                      </div>
                      @endforeach
                  <?php } ?>
                <!-- Area de Respuestas  -->
              </div>
            </div>
          </div> 
        @endforeach 
        <!-- Lista de commentarios Existentes -->
      </div>
      <!-- Area de commentarios del video  -->
    </div>

    <!-- Videos Relacionados -->
    <div class="related-area">
      <div class="header">
        <p>MÚSICA DEL ARTISTA</p>
      </div>

      <?php $related_videos = DB::table('videos')
                            ->where('id_musician', $musician->id)
                            ->where('id', '<>', $video->id)
                            ->get();

            $count = 0; 
      ?>
        <ul>
          @foreach($related_videos as $rv)
            <li class="video-section">
              <a href="/musician/musician_comments?id={{$user->id_wall}}&idvideo={{$rv->id}}&idmusic={{$rv->id_musician}}">
              <?php $img = explode('=', $rv->url); ?>
                <span class="thrumb" style="background: url('//img.youtube.com/vi/{{$img[1]}}/0.jpg'); background-size: cover;"></span>
                <div class="info">
                <?php $name = explode('-', $rv->name); ?>
                  <h3>{{$name[0]}}</h3>
                  <p>{{$name[1]}}</p><br>
                  <?php if (is_null($rv->views)) { ?>
                  <small>Vistas: 0</small>
                <?php }else{ ?>
                  <small>Vistas: {{$rv->views}}</small>
                <?php } ?>
                  
                </div>
              </a>
            </li>
            <?php $count++;
            if ($count > 10) {
               break;
             } ?>
          @endforeach
          <!-- Ultimo Item de la lista, para visualizar mas videos -->
            <?php if (count($related_videos) > 10) {?>
              
              <li class="last-item-video">
                <button class="show-more">VER MÁS</button>
              </li>
            
            <?php }else{ ?>
            
              <li class="last-item-video"> </li>
            
            <?php } ?>
          <!-- Ultimo Item de la lista, para visualizar mas videos -->
        </ul>
    </div>
    <!-- Videos Relacionados -->
    </div>
  </div>
</div>

@stop

@section('jsfunctions')
<script type="text/javascript" src="../../js/lib.js"></script>
<script type="text/javascript">

$(document).on('click', '.share-band', function() {
    $('.share-overlay').toggleClass('active');
});

$(document).on('click', '.close-share', function() {
    $('.share-overlay').remove('active');
});

function onLike(id)
{

  $.get('/bands/band_comments/addLike?id='+id, function (response) {

    if (response == 1) {

      $('.like-band-'+id).addClass('active');

      var like = $('.counter-like-'+id);
      var likeSum = parseInt($(like).text()) + 1;      
      $(like).text(likeSum);

      console.log('¡Comentario Likeado!');

    }else{

      $('.like-band-'+id).removeClass('active');

      var like = $('.counter-like-'+id);
      var likeSum = parseInt($(like).text()) - 1;      
      $(like).text(likeSum);

      console.log(response);
    }
    
  });
}


function videoLike(id_video)
{
  $.get('/videos/addLike?id_video='+id_video, function (response) {

    if (response == 1) {

      $('.like-band-'+id_video).addClass('active');

      var like = $('.vlike-counter-'+id_video);
      var likeSum = parseInt($(like).text()) + 1;      
      $(like).text(likeSum);

      console.log('¡Video Likeado!');

    }else{


      $('.like-band-'+id_video).removeClass('active');

      var like = $('.vlike-counter-'+id_video);
      var likeSum = parseInt($(like).text()) - 1;      
      $(like).text(likeSum);


      console.log(response);
    }
  })
}


  var video = <?php echo $related_videos; ?> ;
  var wall  = <?php echo $id_wall; ?> ;
  

$('.show-more').on('click',function(){

var numchild = $('.video-section').length
, maxnumchild = numchild + 10;

var concatenar = '';

for(var i = numchild; i <= maxnumchild; i++) {

if(video[i]) {

var img = video[i].url
, name = video[i].name;

img = img.split('=').pop();
name = name.split('-');
          
concatenar += '<li class="video-section">'+
        '<a href="/musician/musician_comments?id="'+wall+'"&idvideo="'+video[i].id+'"&idmusic="'+video[i].id_musician+'"">'+
          '<span class="thrumb" style="background: url(//img.youtube.com/vi/'+img+'/0.jpg); background-size: cover;"></span>'+
            '<div class="info">'+
              '<a class="video-info" href="/bands/band_comments?idvideo='+video[i].id+'&idband='+video[i].id_band+'">'+
                '<h3>'+name[0]+'</h3>'+
              '</a>'+
              '<a class="video-info" href="/bands/comments?id='+video[i].id_band+'">'+
               ' <p>'+name[1]+'</p>'+
              '</a>'+
              '<br>'+
             ' <small>Vistas: '+video[i].views+'</small>'+
            '</div>'+
          '</a>'+
          '</li>'
  }
}

setTimeout(function(){
  $(concatenar).insertBefore('.last-item-video').last();
},400);

});
</script>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script>
<script type="text/javascript" src="../../js/bands_comment.js"></script>
<script type="text/javascript" src="../../js/bandbattle.js"></script>
<script type="text/javascript" src="../../js/tag.js"></script>


@stop