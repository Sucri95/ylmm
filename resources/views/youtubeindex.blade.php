@extends('layouts.layout')

@section('content')
<div class="container">
    <form action="{{ action('YoutubeController@search') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-12">
            <label class="form-control col-md-4">Buscar</label>
            <div class="col-md-8"><input class="form-control" placeholder="Buscar..." name="search"></div>
            <button type="submit" class="btn btn-default">Buscar</button>
        </div>
    </form>

    <div class="video-container">       
      <h1> Resultados </h1>
      <div class="slider-row my-center">
      @if(isset($videos))
          @foreach($videos as $video)
          <div class="col-sm-6 col-md-6">
            <div class="thumbnail">
                <!-- Mostrmamos la fotos mediana del video -->
                <img src="{{$video->snippet->thumbnails->medium->url}}">
                <div class="caption">
                    <!-- Mostrmamos el titulo del video -->
                    <h3><a href="https://www.youtube.com/watch?v={{$video->id->videoId}}">
                        {{$video->snippet->title}}</a></h3>
                </div>
            </div>
         </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
@stop