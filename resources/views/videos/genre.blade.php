@extends('layouts.genres')

@section('content')

  <h1  style="margin: 14em -1em 2em -1em; text-align: center;">{{$genres->name}}</h1>

   <?php if ($videos == '[]') { ?>

        <p  style="text-align: center; margin-bottom: 5em;">No hay videos disponibles para éste género musical</p>

      <?php }else{ ?>

    <div class="video-container my-text-center">
      <div class="slider-row profile my-center">
        @foreach($videos as $video)
          <div class="video">
            <div class="slider-video">
              <a href="/videos/genre_reproductor?idvideo={{$video->id}}">
                <img src="">
                <?php $query = explode('=', $video->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
              </a>
            </div>
            <div class="info-bottom">
             <?php $vinfo = explode('-', $video->name) ?>
                <p class="my-left">{{ $vinfo[0] }}</p><br>
                <h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
                <a style="right: 155px;" class="my-right like-check" href="javascript:;">
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
            </div>
          </div>
        @endforeach
      </div>
    </div>
  <?php } ?>
  
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