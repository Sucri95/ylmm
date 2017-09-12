@extends('layouts.battles')

@section('content')
<form class="form-horizontal margin-none" action="{{ action('BattleController@creator') }}" method="post" role="form">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id_band" value="{{ $banda->id }}">

<div class="container">

<section class="login" style="margin-top: -3em; height: 47em;">
  <div class="inner my-text-center">
      <div class="inner-top">
        <h1>Registro en la Batalla <b>YLMM</b></h1>
        <div class="login-green-bar my-center"></div>
      </div>
          <div class="form-login registro my-center" style="padding-top:0px; ">
          
              <input class="input-type-1" type="text" id="name" name="name" required="required" placeholder="{{$banda->name}}" readonly>
                
              <?php $videos = DB::table('videos')
              					->where('id_band', $banda->id)
              					->where('id_battle', null)
              					->get(); ?>
               <select class="input-type-1 select-type-1" required="required" name="id_video">
                  <option value disabled selected hidden>Selecciona un video para la batalla</option>
                  <option value="">Elegir..</option>
                  @foreach($videos as $video)
                  <?php $explode = explode('-', $video->name); ?>
                  <option value="{{$video->id}}">{{$explode[0]}}</option>
                  @endforeach
              </select>

              <button class="btn-green-1" type="button" name="ingresar" onclick="submit();"><b>¡Listo para la batalla!</b></button>

              <a href="/">Volver</a>

          </div>
  </div>
</section>
</div>

@stop

@section('jsfunctions')


@stop