@extends('layouts.ranking')

@section('content')

<div class="chart-ylmm">

<!-- Music Performance -->

    <div id="artists_searcher" class="container-chart">
        <div class="header">
            <h2><span>Conocé la performance de los artistas</span></h2>
        </div>

        <div class="container-clasificados container-buscador" style="min-height: 5em;">
            <div class="buscador">
                
                <form accept-charset="UTF-8" action="/" id="site-search-form" class="site-search-form" method="post" autocomplete="off">
                    <input class="search-text-input" maxlength="128" name="search_block_form" placeholder="Buscar..." size="0" type="text" value="">
                    <button class="form-submit" name="op" type="submit" disabled="disabled">
                        <i class="fa fa-search"></i>
                    </button>
                    <input name="form_id" type="hidden" value="search_block_form">
                </form>
                <div class="search-list">
                    <ul>

                    </ul>
                </div>
            </div>
        </div>
    </div>
<!-- Music Performance -->

<!-- Clasificated Artists -->
    <div id="artistas_clasificados" class="container-chart" style="margin-top: 2%;">
    
      <div class="header">
            <h2><span> Artistas clasificados</span></h2>
        </div>

        <div class="container-chart-clasificados">
            <ul>
                <li class="clasificados" style="margin-right: 2%;">
                    <div>
                        <h2>Artistas <br> clasificados</h2>
                    </div>  
                </li>
                <li style="border-right: 1px solid #ebebe7;">
                    <div>
                        <h2>Corte X</h2>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<!-- Clasificated Artists -->

<!-- Top 10 Clasificated Songs -->
    <div class="container-chart" style="margin-top: 2%;">
    
        <div class="header">
            <h2> <span>Las 10 canciones clasificadas</span> </h2>
        </div>
        <?php $vcounter = 1 ; ?>
        @foreach($videos_clasif as $v)

        <!-- Chart Section  -->
        <div class="section">
            
            <!-- Info Section -->
            <div class="info">
                <span class="chart-position">{{$vcounter}}</span>
                <span class="chart-time">Posición</spant>
            </div>
            <!-- Info Section -->

            
              <!-- Main Section -->
              <?php if(is_null($v->id_user)){ ?>
               <div class="main">
                
                <?php $idurl = explode('=', $v->url); ?>
                    
                    <div class="artist-avatar performance" style="background: url('//img.youtube.com/vi/{{$idurl[1]}}/0.jpg'); background-size: cover;">
                        <a href="/bands/band_comments?idvideo={{$v->id_video}}&idband={{$v->id_band}}" target="_blank"></a>
                    </div>
                    
                    <div class="artist-song">
                        <?php $nameband = explode('-', $v->name_video); ?>
                        <h2>
                            <a href="/bands/band_comments?idvideo={{$v->id_video}}&idband={{$v->id_band}}">{{$nameband[0]}}</a>
                            
                        </h2>
                    </div>

                    <div class="artist-name">
                        <p><a href="/bands/comments?id={{$v->id_band}}">{{$nameband[1]}}</a></p> 
                        <span>Puesto {{$vcounter}}</span>
                    </div>
                
                </div>
               
                <?php }else{ ?>

                <div class="main">
                    
                    <div class="artist-avatar">
                        <a href="/musician/musician_comments?id={{$v->id_user}}&idvideo={{$v->id_video}}&idmusic={{$v->id_user}}" target="_blank"></a>
                    </div>

                    <div class="artist-song">
                        <?php $nameband = explode('-', $v->name_video); ?>
                        <h2>
                            <a href="/musician/musician_comments?id={{$v->id_user}}&idvideo={{$v->id_video}}&idmusic={{$v->id_user}}">{{$nameband[0]}}</a>
                             
                        </h2>
                    </div>
                    
                    <div class="artist-name">
                        <p><a href="/users/wall?id={{$v->id_user}}">{{$nameband[1]}}</a></p> 
                        <span>Puesto {{$vcounter}}</span>
                    </div>

                </div>
                
                <?php } ?>
                <!-- Main Section -->
            
            <!-- Vote Section -->
            <div class="vote">
                <div class="artist-vote-description">
                    <h4>Nª VOTOS</h4>
                </div>
                <div class="artist-vote-number">
                    <h4>{{$v->votes}}</h4>
                </div>

                <div class="artist-vote-btn">
                    <button onclick="onVote({{$v->id}})" >Votá</button>
                </div>
                    
            
            </div>
            <!-- Vote Section -->
        </div>
        <?php $vcounter = $vcounter + 1; ?>
        @endforeach
    </div>
<!-- Top 10 Clasificated Songs -->

<!--Top 10-->
    <div class="container-chart" style="margin-top: 2%;">
    
        <div class="header">
            <h2> <span>Top 10 de artistas</span> </h2>
        </div>
        <?php $ccounter = 1 ; ?>
        @foreach($contest as $c)

        <!-- Chart Section  -->
        <div class="section">
            
            <!-- Info Section -->
            <div class="info">
                <span class="chart-position">{{$ccounter}}</span>
                <span class="chart-time">Posición</spant>
            </div>
            <!-- Info Section -->

            
            <!-- Main Section -->

              <?php  if(is_null($c->id_user)){ 
                
                    $band = DB::table('bands')->where('id', $c->id_band)->first(); ?>
                       
                       <div class="main">
                            <div class="artist-avatar" style="background: url('{{$band->profile_pic}}'); background-size: cover;">

                                <a href="/bands/band_comments?idvideo={{$c->id_video}}&idband={{$band->id}}" target="_blank"></a>

                            </div>
                            
                            <div class="artist-song">
                                    <h2><a href="/bands/comments?id={{$band->id}}">{{$band->name}}</a></h2>
                                    <span>Puesto {{$ccounter}}</span>
                            </div>
                        
                        </div>
                   
                <?php }else{ 
                    
                    $user_wall = DB::table('users')->where('id_musician', $c->id_user)->first();
                    $musician = DB::table('musicians')->where('id', $c->id_user)->first(); ?>

                    <div class="main">
                        <div class="artist-avatar" style="background: url('{{$musician->profile_pic}}'); background-size: cover;">

                            <a href="/musician/musician_comments?id={{$user_wall->id_wall}}&idvideo={{$c->id_video}}&idmusic={{$musician->id}}" target="_blank"></a>

                        </div>
                    
                        <div class="artist-song">
                                <h2><a href="/users/wall?id={{$user_wall->id_wall}}">{{$musician->artistic_name}}</a></h2>
                                <span>Puesto {{$ccounter}}</span>
                        </div>
                    
                    </div>
                
                <?php } ?>
           
            <!-- Main Section -->
            
            <!-- Vote Section -->
            <div class="vote">
                <div class="artist-vote-description">
                    <h4>Nª VOTOS</h4>
                </div>
                <div class="artist-vote-number">
                    <h4>{{$c->votes}}</h4>
                </div>

                <div class="artist-vote-btn">
                    <button onclick="onVote({{$c->id}})" >Votá</button>
                </div>
                    
            
            </div>
            <!-- Vote Section -->
        </div>
        <?php $ccounter = $ccounter + 1;
        if ($ccounter == 11) {
            break;
        } ?>
        @endforeach
    </div>
<!--Top 10-->

<!-- Artists con mas followers -->
    <div class="container-chart" style="margin-top: 2%;">
        <div class="header">
            <h2><span> Top 10 de followers </span></h2>
        </div>
        
        <div class="top-follows">
            <ul>
            <?php $breaker = 1 ; ?>
            @foreach($followeds as $f)
                <li>
                    <div class="avatar" style="background: url('{{$f->profile_pic}}'); background-size: cover;"></div>
                        <?php if(is_null($f->id_user)){ ?>
                         <div class="art-name">
                            <a href="/bands/comments?id={{$f->id}}"><h6>{{$f->name}}</h6></a>
                        </div>
                        <?php }else{
                            $wall = DB::table('users')->where('id', $f->id_user)->first();
                        ?>
                         <div class="art-name">
                            <a href="/users/wall?id={{$wall->id_wall}}"><h6>{{$f->artistic_name}}</h6></a>
                        </div>
                        <?php } ?> 
                    <div class="num-follows">
                        <h5>{{$f->favorite}} <span>followers</span></h5>
                    </div> 
                </li>
                <?php $breaker = $breaker + 1;
                if ($breaker == 11) {
                    break;
                } ?>
            @endforeach
            <?php if (!is_null(Auth::user()->id_band)) { 
                $band = DB::table('bands')->where('id', Auth::user()->id_band)->first(); ?>
                    <li>
                        <div class="avatar" style="background: url('{{$band->profile_pic}}'); background-size: cover;"></div>
                            <div class="art-name">
                                <a href="/bands/comments?id={{$band->id}}"><h6>{{$band->name}}</h6></a>
                            </div>
                        <div class="num-follows">
                            <h5>{{$band->favorite}} <span>followers</span></h5>
                        </div> 
                    </li>
            <?php } ?>
              <?php if (!is_null(Auth::user()->id_musician)) { 
                $musician = DB::table('musicians')->where('id', Auth::user()->id_musician)->first();
                $user_wall = DB::table('users')->where('id', Auth::user()->id)->first(); ?>
                    <li>
                        <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                            <div class="art-name">
                                <a href="/users/wall?id={{$user_wall->id_wall}}"><h6>{{$musician->artistic_name}}</h6></a>
                            </div>
                        <div class="num-follows">
                            <h5>{{$musician->favorite}} <span>followers</span></h5>
                        </div> 
                    </li>
            <?php } ?>
            </ul>
        </div>
    </div>
<!-- Artists con mas followers -->

<!-- Fans con mas followers -->
    <div class="container-chart" style="margin-bottom: 4%; margin-top: 2%;">
        <div class="header">
            <h2><span> Top 10 de fans </span></h2>
        </div>
        
        <div class="top-follows">
            <ul>
            <?php $breakerfans = 1 ; ?>
            @foreach($fans as $f)
                <li>
                    <div class="avatar" style="background: url('{{$f->profile_pic}}'); background-size: cover;"></div>
                   
                    <div class="art-name">
                        <a href="/users/wall?id={{$f->id}}"><h6>{{$f->name}}</h6></a>
                    </div>
                </li>
                <?php $breakerfans = $breakerfans + 1;
                if ($breakerfans == 11) {
                    break;
                } ?>
            @endforeach
            <?php if (Auth::user()->user_level == '4' && !is_null(Auth::user()->id_band) && !is_null(Auth::user()->id_musician) ) { ?>
                 <li>
                    <div class="avatar" style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                   
                    <div class="art-name">
                        <a href="/users/wall?id={{Auth::user()->id}}"><h6>{{Auth::user()->name}}</h6></a>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
<!-- Fans con mas followers -->

</div>
<!-- YLMM Top Chart -->
    
@stop

@section('jsfunctions')

<script type="text/javascript">
    var clasifArtists = <?php echo $videos_clasif; ?>;
    var videos_array = <?php echo $performancevideos; ?> ;
    var array_musicians = <?php echo $array_musicians; ?> ;
    var bands_array = <?php echo $bands_array; ?> ;
</script>

<script type="text/javascript" src="../../js/ranking.js" ></script>
<script type="text/javascript" src="../../js/bandbattle.js" ></script>

@stop