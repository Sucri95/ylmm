@extends('layouts.layout')

@section('content')

<div class="container">

  <div class="slider-type-1" style="overflow: hidden;">
    <div class="slider-row2 my-center" style="text-align: center;">
        
          <div>
              <a href="#">
                <div class="info-text"> 
                  <h1>CONCURSO DE BANDAS 1</h1>
                  <h2>VOTÁ POR TU FAVORITA Y PARTICIPÁ POR INCREIBLES PREMIOS</h2>
                </div>
                <img src="../../images/resources/banners3.png" alt="">
              </a>
          </div>
        
        <div>
              <a href="#">
                <div class="info-text"> 
                  <h1>CONCURSO DE BANDAS 2</h1>
                  <h2>VOTÁ POR TU FAVORITA Y PARTICIPÁ POR INCREIBLES PREMIOS</h2>
                </div>
                <img src="../../images/resources/banners3.png" alt="">
              </a>
          </div>
        
          <div>
              <a href="#">
                <div class="info-text"> 
                  <h1>CONCURSO DE BANDAS 3</h1>
                  <h2>VOTÁ POR TU FAVORITA Y PARTICIPÁ POR INCREIBLES PREMIOS</h2>
                </div>
                <img src="../../images/resources/banners3.png" alt="">
              </a>
          </div>
        
        

   </div>
 </div>

  <div class="video-container">

      <span>
        <h1> Tus bandas favoritas </h1>
        <a href="/users/favorites">VER TODAS</a>
      </span>
      <div class="slider-row my-center">
      @foreach($vi as $video)
        <div>
          <div class="slider-video">
              <a href="javascript:;">
              <img src="" onclick="onView({{$video->id}})">
              <?php $query = explode('=', $video->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
              <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
              </a>
          </div>
          <div class="info-bottom">
              <?php $vinfo = explode('-', $video->name) ?>
              <p  class="my-left">
              <a class="datainfo" href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">{{$vinfo[0]}}</a>
              <br> 
              <a class="datainfo" href="/bands/comments?id={{$video->id_band}}"><b>{{$vinfo[1]}}</b></a>
              </p>
              <br>
              <h5 class="my-left"><b></b></h5>
              <a  class="my-right">
               <?php $likes = DB::table('pv_uservideo')
                        ->where('id_user', Auth::user()->id)
                        ->where('id_video', $video->id)
                        ->first(); ?>

          <?php if (is_null($likes)) { ?>
                <i class="like-band" onclick="onLike({{$video->id}});"></i>
              <?php }else { ?> 
                <i class="like-band active" onclick="onLike({{$video->id}});"></i>
              <?php } ?>
              </a>
          </div>
        </div>
      @endforeach
    </div>

       <span>
        <h1> Lo último </h1>
        <a href="/users/lastadded">VER TODAS</a>
      </span>
      <div class="slider-row my-center">
         @foreach($today as $last)
          <div>
            <div class="slider-video">
                <a href="javascript:;">
                  <img src="" onclick="onView({{$last->id}})">
                  <?php $query = explode('=', $last->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
            </div>
            <div class="info-bottom">
                <?php $vinfo = explode('-', $last->name) ?>
                  <p  class="my-left">
              <a class="datainfo" href="/bands/band_comments?idvideo={{$last->id}}&idband={{$last->id_band}}">{{$vinfo[0]}}</a>
              <br> 
              <a class="datainfo" href="/bands/comments?id={{$last->id_band}}"><b>{{$vinfo[1]}}</b></a>
              </p>
              <br>
                <h5 class="my-left"><b></b></h5>
                <a  class="my-right">
                <?php $likes = DB::table('pv_uservideo')
                            ->where('id_user', Auth::user()->id)
                            ->where('id_video', $last->id)
                            ->first(); ?>

              <?php if (is_null($likes)) { ?>
                    <i class="like-band" onclick="onLike({{$last->id}});"></i>
                  <?php }else { ?> 
                    <i class="like-band active" onclick="onLike({{$last->id}});"></i>
                  <?php } ?>
                  </a>
            </div>
          </div>
          @endforeach
    </div>
    
      <span>
        <h1> Los más escuchados</h1>
        <a href="/users/mostviews">VER TODAS</a>
      </span>
      <div class="slider-row my-center">
           @foreach($vistas as $vis)
            <div>
              <div class="slider-video">
                <a href="javascript:;">
                  <img src="" onclick="onView({{$vis->id}})">
                  <?php $query = explode('=', $vis->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
              </div>
             
              <div class="info-bottom">
              <?php $vinfo = explode('-', $vis->name) ?>
                  <p  class="my-left">
              <a class="datainfo" href="/bands/band_comments?idvideo={{$vis->id}}&idband={{$vis->id_band}}">{{$vinfo[0]}}</a>
              <br> 
              <a class="datainfo" href="/bands/comments?id={{$vis->id_band}}"><b>{{$vinfo[1]}}</b></a>
              </p>
              <br>
                <h5 class="my-left"><b></b></h5>
                <a  class="my-right">
                  <?php $likes = DB::table('pv_uservideo')
                        ->where('id_user', Auth::user()->id)
                        ->where('id_video', $vis->id)
                        ->first(); ?>

                    <?php if (is_null($likes)) { ?>
                      <i class="like-band" onclick="onLike({{$vis->id}});"></i>
                    <?php }else { ?> 
                      <i class="like-band active" onclick="onLike({{$vis->id}});"></i>
                    <?php } ?>
                </a>
              </div>
            </div>
          @endforeach
      </div>
      
     <span>
        <h1> Descubrimientos de la semana</h1>
        <a href="/users/thisweek">VER TODAS</a>
      </span>
      <div class="slider-row my-center">
         @foreach($weeks as $week)
          <div>
            <div class="slider-video">
                <a href="javascript:;">
                  <img src="" onclick="onView({{$week->id}})">
                  <?php $query = explode('=', $week->url); ?>
                  <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
            </div>
            
            <div class="info-bottom">
                <?php $vinfo = explode('-', $week->name) ?>
                  <p  class="my-left">
              <a class="datainfo" href="/bands/band_comments?idvideo={{$week->id}}&idband={{$week->id_band}}">{{$vinfo[0]}}</a>
              <br> 
              <a class="datainfo" href="/bands/comments?id={{$week->id_band}}"><b>{{$vinfo[1]}}</b></a>
              </p>
              <br>
                <h5 class="my-left"><b></b></h5>
                <a  class="my-right">
                  <?php $likes = DB::table('pv_uservideo')
                        ->where('id_user', Auth::user()->id)
                        ->where('id_video', $week->id)
                        ->first(); ?>

                  <?php if (is_null($likes)) { ?>
                    <i class="like-band" onclick="onLike({{$week->id}});"></i>
                  <?php }else { ?> 
                    <i class="like-band active" onclick="onLike({{$week->id}});"></i>
                  <?php } ?>
                </a>
              </div>
            </div>
          @endforeach
     </div>
 
    <h1>Explorá por género</h1>

     <div class="slider-row3 genero my-center">
        @foreach($generos as $genero)
        <div>
           <a href="/videos/genre?id_genre={{$genero->id}}">
             <img src="{{ $genero->image }}" alt="">
             <div class="{{ $genero->color }}">
                <p>{{ $genero->name }}</p>
             </div>
           </a>
        </div>
        @endforeach
      </div>
  </div>

</div>
@stop
@section('jsfunctions')

<script type="text/javascript">

var fav        =  <?php echo $vi; ?> ;
var lasts      =  <?php echo $today; ?> ;
var vis        =  <?php echo $vistas; ?> ;
var sem        =  <?php echo $weeks; ?> ;
var blues      =  <?php echo $blues; ?> ;
var country    =  <?php echo $country; ?> ;
var electronic =  <?php echo $electronic; ?> ;
var folk       =  <?php echo $folk; ?> ;
var hiphop     =  <?php echo $hiphop; ?> ;
var jazz       =  <?php echo $jazz; ?> ;
var latin      =  <?php echo $latin; ?> ;
var pop        =  <?php echo $pop; ?> ;
var soul       =  <?php echo $soul; ?> ;
var rock       =  <?php echo $rock; ?> ;

//1 - Videos, bandas favoritas 2 - Ultimos videos agregados 3 - Videos mas vistos 4 - Videos subidos esta semana 5 - Videos Genero Blues 
//6 - Videos Genero Country 7 - Videos Genero Electronic 8 - Videos Genero Folk 9 - Videos Genero Hip Hop 9 - Videos Genero Jazz
//10 - Videos Genero Latin 11 - Videos Genero Pop 12 - Videos Genero Soul 13 - Videos Genero Rock
var array = [fav, lasts, vis, sem, blues, country, electronic, folk, hiphop, jazz, latin, pop, soul, rock];


</script>

@stop