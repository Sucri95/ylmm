@extends('layouts.walls')

  <link rel="stylesheet" type="text/css" href="../../css/search_style.css">
 
  <link rel="stylesheet" type="text/css" href="../../css/notificaciones.css">

  <link rel="stylesheet" type="text/css" href="../../css/responsive-menu.css">

  <style type="text/css">

    .buscador .search-list ul li .data-area{
      width: 19.8em;
    }

    .slider-row.profile.my-center{
    	width: 100%;
    }

    .video-container1.my-text-center{
   		float: left;
    	width: 100%;
    	margin-top: -2em;
    }

    .video-container1.my-text-center .slider-row.profile.my-center.myfavorites{
    	margin: 1em 0px 3em 0px!important;
    }

    .slider-row.profile.my-center div.video{
    	float: none!important;
    }
    .buscador .search-list ul li{
    	min-height: 4em!important;
    }

    @media(max-width: 650px){
    	.video-container1.my-text-center.myfavorites{
    		max-width: 84em;
    		margin-top: -3em!important;
		}

		.video-container1.my-text-center .slider-row.profile.my-center.myfavorites {
    		margin: 0px auto 2em 2px!important;
		}
    }

    @media(max-width: 1600px) {
    	#artists_searcher{
    	/*	margin: auto 359px!important;*/
    	}

    }
    	
    

  </style>


@section('content')

    <div class="video-container1 my-text-center myfavorites">
      <div class="slider-row profile my-center myfavorites">
         <div class="chart-ylmm">

          <!-- Music Performance -->

          <?php if (isset($_GET['id'])) {
			    $id = $_GET['id'];
			    $user = DB::table('users')->find($id);
			}

			if (Auth::user()->id == $user->id) { ?>

          	<div class="container-1" style="float: left; width: 100%; height: auto; margin-bottom: 2em;">
          		
	 			<div id="artists_searcher" class="container-chart">
	                  <div class="header">
	                      <h2><span>Encontrá a tus artístas favoritos</span></h2>
	                  </div>

	                  <div class="container-clasificados container-buscador" style="min-height: 5em;">
	                      <div class="buscador" style="display: block;">
	                          
	                          <form accept-charset="UTF-8" action="/" id="site-search-form" class="site-search-form" method="post" autocomplete="off">
	                              <input class="search-text-input" maxlength="128" name="search_block_form" placeholder="Buscar" size="0" type="text" value="" style="z-index: 999;">
	                              <button class="form-submit" name="op" disabled="disabled">
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


          	</div>

          	<?php } ?>

             

          <!-- Music Performance -->
      	
          @foreach($favorites as $favorite)
          <div class="video row">
              <div class="slider-video">
                <?php if (!is_null($favorite->id_band)) { ?>
                  <a href="/bands/band_comments?idvideo={{$favorite->id}}&idband={{$favorite->id_band}}">
                <?php }else{ 
                	$musician = DB::table('users')->where('id_musician', $favorite->id_musician)->first();  ?>
                  <a href="/musician/musician_comments?id={{$musician->id_wall}}&idvideo={{$favorite->id}}&idmusic={{$favorite->id_musician}}">
                <?php } ?>

                  <img src="">
                  <?php $query = explode('=', $favorite->url); ?><input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=0">
                  <iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
                </a>
              </div>
              <div class="info-bottom">
                <ul>
                <?php $vinfo = explode('-', $favorite->name) ?>
	                <li>

					<?php if (!is_null($favorite->id_band)) { ?>
						
						<a href="/bands/band_comments?idvideo={{$favorite->id}}&idband={{$favorite->id_band}}" style="color: black;">
		                	<p class="my-left">{{ $vinfo[0] }}</p>
		                </a><br>
		               	<a href="/bands/comments?id={{$favorite->id_band}}" style="color: black;">
	                  		<h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
	                  	</a>

					<?php }else{

						$musician = DB::table('users')->where('id_musician', $favorite->id_musician)->first();  ?>

						<a href="/musician/musician_comments?id={{$musician->id_wall}}&idvideo={{$favorite->id}}&idmusic={{$favorite->id_musician}}" style="color: black;">
		                	<p class="my-left">{{ $vinfo[0] }}</p>
		                </a><br>
		               	<a href="/users/wall?id={{$musician->id_wall}}" style="color: black;">
	                  		<h5 class="my-left"><b>{{ $vinfo[1] }}</b></h5>
	                  	</a>

					<?php } ?>

	                </li>
                </ul>

                <ul style="float: right;">
                	
                	<li><a class="comment-like vlike-counter-{{$favorite->id}}" href="javascript:;"> {{$favorite->likes}} </a></li>              
                  
                	<?php $likes = DB::table('pv_uservideo')->where('id_user', Auth::user()->id)->where('id_video', $favorite->id)->first();
                
                	if (is_null($likes)) { ?>
                    	<li><a class="love-band like-band-{{$favorite->id}}" href="javascript:;"  onclick="videoLike({{$favorite->id}});"> </a></li>
                  	<?php }else{ ?>
                    	<li><a class="love-band active like-band-{{$favorite->id}}" href="javascript:;"  onclick="videoLike({{$favorite->id}});"> </a></li>
                  	<?php } ?>
                    
                    <li><a class="share-band" href="javascript:;" > </a></li>
                </ul>
              </div>
          </div>
          @endforeach
          </div>
      </div>
    </div>

@stop

@section('jsfunctions')

	<script type="text/javascript" src="../../js/bandbattle.js" ></script>
	<script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
	<script type="text/javascript">

	$(document).on('click', '.love-band', function() {
		$(this).toggleClass('active');
	});

	    $(".search-text-input").keyup(function (e) {
	        e.preventDefault();
	        search_artists();
	    });

	    $(".search-text-input").focusin(function (e) {
	        e.preventDefault();
	        search_artists();
	    });

	 $(".search-text-input").focusout(function(){
	      setTimeout(function(){
          	$('.search-list ul').empty();
	      },400);
	   });

	    $('.search-text-input').keypress(function(e) {
	        if (e.keyCode == 13) {
	            e.preventDefault();
	        }
	    });

	  function search_artists() {

	        var search = $(".search-text-input").val();
	        
	        $.get('http://localhost:8000/battles/search_musicians?performance='+ search, function (data) { 
	          var cont = 0;

	          $('.search-list ul li').remove();

	          $.each(data, function(index, item) {
	            cont = 0;
	            $.each(item, function(index2, item2) { 
	              if (cont < 3) {
	              
	              var url = ''
	                , type = ''
	                , name = ''
	                , image = ''
	                , level = '';


	                if (index === 'bands') {


	                    
	                    url =  'http://localhost:8000/bands/comments?id='+item2.id;
	                    name = item2.name;
	                    image = item2.profile_pic;

	                  $('.search-list ul').append('<li class="lisearch">'+
	                  					'<a href="'+url+'">'+
	                  					'<div class="avatar-area">'+
	                  					'<div class="image-area" style="background: url('+image+'); background-size: cover;">'+
	                  					'</div></div><div class="data-area"><h2>'+name+'</h2><p>Banda</p></div></a></li>');

	                }

	                if (index === 'musicians') {

	                    url =  'http://localhost:8000/users/wall?id='+item2.id_user;
	                    name = item2.artistic_name;
	                    image = item2.profile_pic;

	                  $('.search-list ul').append('<li class="lisearch">'+
	                  					'<a href="'+url+'">'+
	                  					'<div class="avatar-area">'+
	                  					'<div class="image-area" style="background: white;">'+
	                  					'<img style="height: 100%;" src="'+image+'"></div></div>'+
	                  					'<div class="data-area"><h2>'+name+'</h2><p>Músico</p></div></a></li>');
	                }

	              cont = cont + 1;
	            }
	           });
	            
	          });
	        
	        
	        });
	    
	    }

	</script>

@stop