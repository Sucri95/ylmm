@extends('layouts.battles')

<style type="text/css">

  nav .items ul li:not(:last-child) ul.user-sub-menu {
    margin-top: 7px!important;
  }

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
    padding: 0 2em;
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
    
</style>

@section('content')

  <h1 class="battles-title">Batalla de Bandas</h1>

  <div class="container-video">
    <ul class="list-container">
      @foreach($videos as $video)
        <li>
          <div class="video">
            <div class="slider-video">
              <?php if (is_null($video->id_user)) { ?>
                <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">
              <?php }else{ 
                $user_wall = DB::table('users')->where('id_musician', $video->id_user)->first(); ?>
                <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_user}}">
              <?php } ?>
              <img src="">
                <?php $query = explode('=', $video->url); ?>
                  <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=0">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
            </div>
            <div class="info-bottom">
              <ul class="ul-info">
                <li class="li-info">
                <?php $vinfo = explode('-', $video->name_video); 

                  if (is_null($video->id_user)) { ?>

                  <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}" style="color: black;">
                    <p class="my-left">{{ $vinfo[0] }}</p><br>
                  </a>
                  <a href="/bands/comments?id={{$video->id_band}}" style="color: black;">
                    <h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
                  </a>

                <?php }else{ 

                $user_wall = DB::table('users')->where('id_musician', $video->id_user)->first(); ?>

                  <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_user}}" style="color: black;">
                    <p class="my-left">{{ $vinfo[0] }}</p><br>
                  </a>
                  <a href="/users/wall?id={{$user_wall->id_wall}}" style="color: black;">
                    <h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
                  </a>

                <?php } ?>

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
    </ul>
  </div>


@stop

@section('jsfunctions')

<script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop