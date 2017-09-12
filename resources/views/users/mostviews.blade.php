@extends('layouts.genres')

@section('content')

  <h1  style="margin: 14em -1em 2em -1em; text-align: center;">VER TODAS LOS MÁS ESCUCHADOS</h1>
    <div class="video-container my-text-center">
      <div class="slider-row profile my-center">
        @foreach($vistas as $video)
          <div class="video">
            <div class="slider-video">
              <a href="javascript:;">
                <img src="" onclick="onView({{$video->id}})">
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

@stop

@section('jsfunctions')

  <script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop