@extends('layouts.walls')


<style type="text/css">

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style-type: none;
}
 .container-video {
    width: 100%;
    height: auto;
    display: block;
    text-align: center;
    padding: 2em 2em;
    margin-top: -4em;
    float: left;
  }

.container-video ul.list-container {
  width: 100%;
  list-style-type: none;
  margin-top: 1em;
  padding: 0 1.5em;
}

.container-video ul li {
  width: 480px;
  height: 400px;
  display: inline-block;
  margin: 1em 1em;
}

.info-bottom{
  width: 100%;
  height: 3.7em;
  left: 0;
  right: 0;
  bottom: 0;
  float: left;
  position: relative;
  background: #fff;
  padding: 5px 10px 0px 10px;
}

.ul-info{
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.li-info{
  float: left;
  min-width: 1.3em;
  min-height: 1.3em;
  padding: 0px 0px;
  position: relative;
  margin: 9px!important;
  max-height: 3.7em;
}

.container-video ul li:first-child {
  height: 21.5em;
}

</style>
<style type="text/css" src="../../css/components.css"></style>
@section('content')
<?php if (isset($_GET['idmusic'])) {
    $id = $_GET['idmusic'];
  }?>
  <?php if (isset($_GET['id'])) {
    $id_wall = $_GET['id'];
  }?>
<div class="overlay">
  <div class="container">
    <div class="close"></div>
    <h4 style="margin-bottom: 1em;">Cargar Video</h4>
    <form class="form-horizontal margin-none" id="form-signup_v2" action="{{ action('MusicianController@creator_music') }}" method="post" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="idmusic" value="{{ $id }}">
              <img class="img-yt" style="width: 413.333px; height: 300px; float: none; margin: 0 auto;  display: none;" src="">
              <input class="input-type-1 yt-url" type="text" name="url" id="url" placeholder="Link del Video">
              <p style="font-size: 8px; font-size: 9px; margin-top: 6px; letter-spacing: 1px; line-height: 14px;">Por favor, para cargar correctamente el video seleccioná el link de YouTube <br>luego de ver el aviso publicitario. Saludos, <strong style="color: #e42693;">YLMM</strong></p>
              <input class="input-type-1" type="text" name="name" id="name" placeholder="Nombre del Video">

              <button class="btn-green-1" name="ingresar" disabled style="width: 23em;"><b>PUBLICAR</b></button><br>
            </div>
    </form>
  </div>
 </div>
 
<div class="container-video">
    <ul class="list-container home-band">
    
      <?php if (Auth::user()->id_musician == $musician->id) { ?>
        <li class="upload-li">
          <div class="video uploadmore">
            <div class="icon-plus"></div>
          </div>
        </li>
      <?php } ?>

       @foreach($videos as $video)
        <li>
          <div class="video">
            <div class="slider-video">
             <a href="/musician/musician_comments?id={{$id_wall}}&idvideo={{$videos[0]->id}}&idmusic={{$musician->id}}">
                <img src="">
                <?php $query = explode('=', $video->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=0">
                <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
              </a>
            </div>
            <div class="info-bottom">
              <ul class="ul-info">
                <li class="li-info">
                <?php $vinfo = explode('-', $video->name); ?>

                  <a href="/musician/musician_comments?id={{$id_wall}}&idvideo={{$videos[0]->id}}&idmusic={{$musician->id}}" style="color: black;">
                    <p class="my-left">{{ $vinfo[0] }}</p>
                  </a><br>
                  
                  <a href="/users/wall?id={{$id_wall}}" style="color: black;">
                    <h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
                  </a>

                </li>
              </ul>
              <ul class="ul-options">
                <li class="li-info"><a class="comment-like vlike-counter-{{$video->id}}" href="javascript:;"> {{$video->likes}} </a></li>

                  <?php $likes = DB::table('pv_uservideo')
                              ->where('id_user', Auth::user()->id)
                              ->where('id_video', $video->id)
                              ->first();
                  
                  if (is_null($likes)) { ?>
                  
                    <li><a class="love-band like-band-{{$video->id}}" href="javascript:;"  onclick="videoLike({{$video->id}});"> </a></li>
                  
                  <?php }else{ ?>
                  
                    <li><a class="love-band active like-band-{{$video->id}}" href="javascript:;"  onclick="videoLike({{$video->id}});"> </a></li>
                  
                  <?php } ?>
                    
                    <li><a class="share-band" href="javascript:;" > </a></li>
              </ul>
            </div>
          </div>
        </li>
      @endforeach
    </li>

    </ul>
  </div>

@stop

@section('jsfunctions')




<script type="text/javascript" src="../../js/bandwall.js" ></script>

<script type="text/javascript">


  $('.btn-green.dark.my-right.btn-sosfan').on('click', function(){
    
    if ($(this).hasClass('active')){

        $(this).removeClass('active').text('FOLLOW');

    }else{

       $(this).addClass('active').text('UNFOLLOW'); 
    
    }

  });

 function deleteVideo(id) {

    $('#video_'+id).addClass('hidden');
      
      $.get('/videos/delete?id='+id, function (response) {

        if (response == 1) {

          console.log('¡Video Eliminado!');

        }else{

          console.log(response);
        }
      });

  }

  $('#url').on('change', function () {

    var inputUrl = $(this).val();

    var urlType = inputUrl.split('v=').pop()
    , urlType2 = inputUrl.split('/').pop()
    , aux = '';

    if (urlType.indexOf('/') == -1 && urlType.length == 11) {


      aux = urlType;
      var url = "https://www.googleapis.com/youtube/v3/videos";
      var videoId = "id="+aux;
      var apiKey = "key=AIzaSyADcD5dZ4hk6YkcGytR2sgAEFty8trhDzA";
      var part = "part=snippet";

      $.get(url + "?" + apiKey + "&" + videoId + "&" + part, function(response) {
          
          if (response.pageInfo.totalResults == 1) {

            var inputUrl = $('#url').val('');
            var inputUrl = $('#url').val('https://www.youtube.com/watch?v='+aux);

            $('.btn-green-1').removeAttr('disabled');
              
          
          }else{
            
            $('.btn-green-1').attr('disabled', true);
            alert("El video está truncado")
          
          }
      });

    }else{


        aux = urlType2;
        var url = "https://www.googleapis.com/youtube/v3/videos";
        var videoId = "id="+aux;
        var apiKey = "key=AIzaSyADcD5dZ4hk6YkcGytR2sgAEFty8trhDzA";
        var part = "part=snippet";

        $.get(url + "?" + apiKey + "&" + videoId + "&" + part, function(response) {
            
            if (response.pageInfo.totalResults == 1) {

              var inputUrl = $('#url').val('');
              var inputUrl = $('#url').val('https://www.youtube.com/watch?v='+aux); 

              $('.btn-green-1').removeAttr('disabled'); 
            
            }else{
              
              $('.btn-green-1').attr('disabled', true);
              alert("El video está truncado")
            
            }
        });
    }

  });

  

  $(document).on('click', '.btn-green-1', function() {

  	var url = $('#url').val();
  	var name = $('#name').val();

  	console.log(url);
	console.log(name);

  	if (url != '' && name != '') {

  		$('.btn-green-1').removeAttr('disabled');
  		$('#form-signup_v2').submit();

  	}

  });

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

</script>


@stop



