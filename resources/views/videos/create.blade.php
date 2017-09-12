@extends('layouts.layout')

@section('content')
<form class="form-horizontal margin-none" id="form-signup_v2" action="{{ action('VideoController@creator') }}" method="post" role="form">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="container">

  <section class="login" style="height: 41em; padding-top: 8em;">
      <div class="inner my-text-center">
        <div class="inner-top">
          <h1>Cargar <b>Video</b></h1>
          <div class="login-green-bar my-center"></div>
        </div>

        <div class="form-login my-center" style="padding-top:0px; ">
       

          <img class="img-yt" style="width: 413.333px; height: 300px; float: none; margin: 0 auto;  display: none;" src="">
          <input class="input-type-1 yt-url" type="text" name="url" id="url" placeholder="Link de Video">
          <p style="font-size: 8px; font-size: 9px; margin-top: 6px; letter-spacing: 1px; line-height: 14px;">Por favor, para cargar correctamente el video seleccioná el link de YouTube <br>luego de ver el aviso publicitario. Saludos, <strong style="color: #68bd45;">YLMM</strong></p>
          <input class="input-type-1" type="text" name="name" id="name" placeholder="Nombre del Video">

          <button class="btn-green-1" type="submit" name="ingresar" style="width: 23em;"><b>GUARDAR</b></button><br>
          <a href="/bands/home_band" style="text-decoration: underline;">Volver</a>
        </div>
      </div>
    </section>
  </div>
</form>

<script type="text/javascript">

$('.yt-url').on('change',function(){
 });


$(".yt-url").on('keydown',function(e) { 
  var keyCode = e.keyCode || e.which; 

  if (keyCode == 9) { 
   
    e.preventDefault(); 

    var iframe_src =  $(this).val();
    var youtube_video_id = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
   
    if (youtube_video_id.length == 11) {
        var video_thumbnail = $('<img src="//img.youtube.com/vi/'+youtube_video_id+'/0.jpg">');
        $('.img-yt').css('display', 'block').attr('src',video_thumbnail[0].src);
        $('.login').css({
          'height': '56em',
          'padding-top': '4em'

        });
    }

  } 
});


</script>
@stop