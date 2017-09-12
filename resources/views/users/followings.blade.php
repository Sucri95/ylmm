@extends('layouts.layout')

<link rel="stylesheet" type="text/css" href="../../css/ranking.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../css/search_style.css">

<style type="text/css">

		.chart-ylmm{
			margin-top: 7em;
    		margin-bottom: 3em;
    		float: left;
		    height: auto;
		}


		.chart-ylmm .container-chart .section.view-more {
			height: 3em;
			padding: 0;
		}
		.chart-ylmm .container-chart .section.view-more button {
			width: 100%;
			height: 3.5em;
			float: left;
			color: white;
			outline: none;
			border: none;
			cursor: pointer;
			margin-top: 4em;
			background: -webkit-linear-gradient(-45deg, #e42693 , #6e39a6);

		}

		.chart-ylmm .container-chart .section.view-more button:hover {
			background: -webkit-linear-gradient(-45deg, #6e39a6, #e42693);
			background: -ms-linear-gradient(-45deg, #6e39a6, #e42693);
		}
		.chart-ylmm .container-chart .section:hover{
			background: -webkit-linear-gradient(45deg, #e42693 , #6e39a6);
			background: -ms-linear-gradient(45deg, #6e39a6, #e42693);
		}
		.chart-ylmm .container-chart .section:hover .main .artist-song h2 > a{
			color: white;
			
		}
		.chart-ylmm .container-chart .section .main .artist-song h2 > a{
			transition: 0s;
		}

		.chart-ylmm .container-chart .section{
			height: 5.5em; 
		}

		.h2-notifications{

			margin-left: 2em;
			font-size: 12px;

		}
		.chart-ylmm .container-chart .section .main{
			width: 100%;
			padding: 3px;
		}

		.chart-ylmm >  .container-chart .section .main:before, .chart-ylmm >  .container-chart .section .vote:before {
			background: transparent;
		}

		.section.view-more {
			height: 5em!important;
			position: relative;
		}
		
		.section.view-more:hover {
			background: white!important;
		}

		.section.view-more button{
			position: absolute;
			bottom: 0;
		}

		.artist-avatar.followers{
			width: 45px!important;
		    height: 45px!important;
		    margin-left: 2em!important;
		    background-size: cover!important;
		}

		div.artist-song > h2 > p{
			font-size: 11px;
		}

		div.artist-song > h2{
			color: #01b1e6;
		}

		
		@media (max-width: 850px){
			.chart-ylmm .container-chart .section .main {
				width: 100%!important;
				padding: 0!important;
			}
		}



	</style>

@section('content')

<div class="chart-ylmm" id="content">

	<div class="container-chart">
	
		<div class="header">
			<h2 style="padding-top: 1.7em;"> <span>Following</span> </h2>
		</div>
		
		<?php if ($favorites == '[]') { ?>
			<!-- Chart Section  -->
			<div class="section">
				<!-- Main Section -->
				<div class="main">
					<div class="artist-song">
						<h2 class="h2-notifications" style="text-align: center; margin-left: 0em;"><a href="javascript:;">...</a></h2>
					</div>
				</div>
				<!-- Main Section -->	
			</div>
			<!-- Chart Section  -->
		<?php }else{ 

			$count = 0; ?>
			
			@foreach ($favorites as $favorite)

				@if($favorite->id_band != null)

				<?php $following = DB::table('bands')->where('id', $favorite->id_band)->first(); ?>
				<div class="section">
					<!-- Main Section -->
					<div class="main">
						<div class="artist-avatar followers" style="background: url('{{$following->profile_pic}}');">
	                        <a href="/bands/comments?id={{$following->id}}"></a>
	                    </div>
						<div class="artist-song">
							<h2 class="h2-notifications">
								<a href="/bands/comments?id={{$following->id}}">{{$following->name}}</a>
								<p>Banda</p>
							</h2>
						</div>
					</div>
					<!-- Main Section -->	
				</div>

				@endif

				@if($favorite->id_musician != null)
				
				<?php $following = DB::table('users')->where('id_musician', $favorite->id_musician)->first(); ?>
				<div class="section">
					<!-- Main Section -->
					<div class="main">
						<div class="artist-avatar followers" style="background: url('{{$following->profile_pic}}');">
	                        <a href="/users/wall?id={{$following->id}}"></a>
	                    </div>
						<div class="artist-song">
							<h2 class="h2-notifications">
								<a href="/users/wall?id={{$following->id}}">{{$following->name}}</a>
								@if($following->id_musician == null)
									<p>Fan</p>
								@else
									<p>Músico</p>
								@endif
							</h2>
						</div>
					</div>
					<!-- Main Section -->	
				</div>

				@endif

				@if($favorite->id_fan != null)

				<?php $following = DB::table('users')->where('id', $favorite->id_fan)->first(); ?>
				<div class="section">
					<!-- Main Section -->
					<div class="main">
						<div class="artist-avatar followers" style="background: url('{{$following->profile_pic}}');">
	                        <a href="/users/wall?id={{$following->id}}"></a>
	                    </div>
						<div class="artist-song">
							<h2 class="h2-notifications">
								<a href="/users/wall?id={{$following->id}}">{{$following->name}}</a>
								<p>Fan</p>
							</h2>
						</div>
					</div>
					<!-- Main Section -->	
				</div>

				@endif
				
				<?php $count++;
					
					if ($count == 10) { 
						break;

				} ?>

			@endforeach

			<?php if (count($favorites) >= 10 ) { ?>
				<div class="section view-more">
					<button style="height: 100%;">VER MAS</button>
				</div>
			<?php } ?>

		<?php } ?>
	
	</div>
	
</div>


@stop
@section('jsfunctions')

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

<script type="text/javascript">

var favorites = <?php echo $favorites; ?>;
var users = <?php echo $users; ?>;
var bands = <?php echo $bands; ?>;

$('.section.view-more button').on('click',function(){

	var numchild = $('.container-chart .section').length
	, maxnumchild = numchild + 10;

	var concatenar = '';



	for(var i = numchild; i <= maxnumchild; i++) {

		if(favorites[i]) {

			if (favorites[i].id_band != null) {

			for (var k = 0, len = bands.length; k < len; k++) {

				 if (bands[k].id == favorites[i].id_band) {

					var band = bands[k];
				 }
				
			}

				concatenar += '<div class="section">'+
					'<div class="main">'+
						'<div class="artist-avatar followers" style="background: url('+band.profile_pic+');">'+
	                        '<a href="/bands/comments?id='+band.id+'"></a>'+
	                    '</div>'+
						'<div class="artist-song">'+
							'<h2 class="h2-notifications">'+
							'	<a href="/bands/comments?id='+band.id+'">'+band.name+'</a>'+
							'</h2>'+
						'</div>'+
					'</div>'+
				'</div>'
			}

			if (favorites[i].id_musician != null) {
			
				for (var k = 0, len = users.length; k < len; k++) {

				 if (users[k].id_musician == favorites[i].id_musician) {

					var user = users[k];
				 }
				
				}

				concatenar += '<div class="section">'+
					'<div class="main">'+
						'<div class="artist-avatar followers" style="background: url('+user.profile_pic+');">'+
	                        '<a href="/users/wall?id='+user.id+'"></a>'+
	                    '</div>'+
						'<div class="artist-song">'+
							'<h2 class="h2-notifications">'+
							'	<a href="/users/wall?id='+user.id+'">'+user.name+'</a>'+
							'</h2>'+
						'</div>'+
					'</div>'+
				'</div>'
			}

			if (favorites[i].id_fan != null) {

				for (var k = 0, len = users.length; k < len; k++) {

				 if (users[k].id == favorites[i].id_fan) {

					var user = users[k];
				 }
				
				}

				concatenar += '<div class="section">'+
					'<div class="main">'+
						'<div class="artist-avatar followers" style="background: url('+user.profile_pic+');">'+
	                        '<a href="/users/wall?id='+user.id+'"></a>'+
	                    '</div>'+
						'<div class="artist-song">'+
							'<h2 class="h2-notifications">'+
							'	<a href="/users/wall?id='+user.id+'">'+user.name+'</a>'+
							'</h2>'+
						'</div>'+
					'</div>'+
				'</div>'
			}

		}
	}

	setTimeout(function(){

		$(concatenar).insertBefore('.section.view-more').last();

		},400);
	
	});

</script>
@stop