@extends('layouts.genres')

@section('content')

  <h1  style="margin: 14em -1em 2em -1em; text-align: center;">Resultados de tu búsqueda</h1>
    <div class="video-container my-text-center" style="padding-bottom: 5em; ">
      <h2  style="text-align: center; margin-bottom: 1em;">Fans</h2>
        <?php if ($user == '[]') { ?>

         <h3>No se han encontrado resultados...</h3>

        <?php }else{ ?>

        @foreach($user as $fan)

          <a href="/users/wall?id={{$fan->id}}"><h3>{{$fan->name}}</h3></a>

        @endforeach

        <?php } ?>

      <h2  style="margin-top: 2em; text-align: center; margin-bottom: 1em;">Bandas</h2>
      <?php if ($bands == '[]') { ?>

        <h3>No se han encontrado resultados...</h3>

      <?php }else{ ?>

        @foreach($bands as $banda)
          <a href="/bands/home_band?idband={{$banda->id}}"><h3>{{$banda->name}}</h3></a>
        @endforeach

      <?php } ?>
        
      <h2  style="margin-top: 2em; text-align: center; margin-bottom: 1em;">Videos</h2>
       <?php if ($videos == '[]') { ?>

        <h3>No se han encontrado resultados...</h3>

      <?php }else{ ?>

         @foreach($videos as $video)
          <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}"><h3>{{$video->name}}</h3></a>
        @endforeach

      <?php } ?>
       
   </div> 
   
@stop

@section('jsfunctions')

  <script type="text/javascript">


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

    $('.slider-video').each(function(index, item){
      var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
    });


    $('.love-band').on('click', function(){

      $(this).toggleClass('active');

    });

</script>

@stop