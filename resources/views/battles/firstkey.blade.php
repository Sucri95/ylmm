@extends('layouts.battles')

<link rel="stylesheet" type="text/css" href="../../css/battles.css">

@section('content')

  <div class="title-battles"><h1 class="battles-title"><b>Batalla de Bandas:</b> Llave 1</h1></div>
    <div class="container" style="margin: 3em auto 0 auto!important;">
      <div class="inner-container">
        <div class="slider-area" style="background: #fff;">
          <h1 class="favorite-select-battle" ><b>TUS 10 FAVORITAS</b></h1>
          <div class="my-right votes">
          <form class="form-register" action="{{ action('BattleController@elections') }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav1" name="fav1">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
               <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav2" name="fav2">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option  class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
               <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav3" name="fav3">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option  class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
               <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav4" name="fav4">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option  class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
               <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav5" name="fav5">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option  class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav6" name="fav6">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option  class="select-purple" value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav7" name="fav7">
                <option value disabled selected hidden>Seleccioná tu favorita</option>
                  @foreach($videos as $video)
                    <option class="select-purple"  value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav8" name="fav8">
                <option value disabled selected hidden>Seleccioná tu favorito</option>
                  @foreach($videos as $video)
                    <option class="select-purple"  value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav9" name="fav9">
                <option value disabled selected hidden>Seleccioná tu favorito</option>
                  @foreach($videos as $video)
                    <option class="select-purple"  value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              <select class="input-type-1 select-type-1 selectvotes" data-type="string" required="required" id="fav10" name="fav10">
                <option value disabled selected hidden>Seleccioná tu favorito</option>
                  @foreach($videos as $video)
                    <option class="select-purple"  value="{{$video->id_video}}">{{$video->name_video}}</option>
                  @endforeach
              </select>
              
              <button class="btn-purple battle-button" type="button" name="ingresar"><b>VOTAR</b></button>
            
            <form>
          </div>
        </div>
        <div class="video-area">
          @foreach($videos as $video)
            <div class="video row keys">
              <div class="slider-video">
                <?php if (is_null($video->id_user)) { ?>

                  <a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">

                <?php }else{ 

                  $user_wall = DB::table('users')->where('id_musician', $video->id_user)->first(); ?>
                
                  <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_user}}">

                <?php }  ?>
                  <img src="" onclick="onView({{$video->id_video}})">
                  <?php $query = explode('=', $video->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
                  <div class="info-bottom" style="position: relative; background: #fff; width: 100%; height: 3.5em;">
                 <?php $vinfo = explode('-', $video->name_video) ?>
                    <p class="my-left" style="padding: 7px;">{{ $vinfo[0] }}</p><br><br>
                    <h5 class="my-left" style="margin: -0.5em auto 1em 0.5em;"><b>{{ $vinfo[1] }}</b></h5>
                    <a style="right: 155px;" class="my-right like-check" href="javascript:;">
                      <?php $likes = DB::table('pv_uservideo')
                                    ->where('id_user', Auth::user()->id)
                                    ->where('id_video', $video->id)
                                    ->first(); ?>
                    </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>    

@stop

@section('jsfunctions')

<script type="text/javascript" src="../../js/general.js"></script>

<script type="text/javascript" src="../../js/battleskey.js"></script>

<script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop