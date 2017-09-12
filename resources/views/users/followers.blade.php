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
			background: -ms-linear-gradient(-45deg, #6e39a6, #e42693);

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
		div.artist-song > h2{
			color: #01b1e6;
		}

		div.artist-song h2 p{
			font-size: 10px;
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
			<h2 style="padding-top: 1.7em;"> <span>Followers</span> </h2>
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
				<?php $follower = DB::table('users')->where('id', $favorite->id_user)->first(); ?>
				<div class="section">
					<!-- Main Section -->
					<div class="main">
						<div class="artist-avatar followers" style="background: url('{{$follower->profile_pic}}');">
	                        <a href="/users/wall?id={{$follower->id}}"></a>
	                    </div>
						<div class="artist-song">
							<h2 class="h2-notifications">
								<a href="/users/wall?id={{$follower->id}}">{{$follower->name}}</a>
								@if($follower->id_musician == null)
									<p>Fan</p>
								@else
									<p>Músico</p>
								@endif
							</h2>
						</div>
					</div>
					<!-- Main Section -->	
				</div>
				
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



$('.section.view-more button').on('click',function(){

		var numchild = $('.container-chart .section').length
		, 	maxnumchild = numchild + 10
		, 	concatenar = '';


		favorites.forEach(function(fav, index){
			
			users.forEach(function(usr, index2){
				
				if(index2 > numchild && index2 < maxnumchild) {
					if (fav.id_user == usr.id) {
						
					concatenar += '<div class="section">'+
						'<div class="main">'+
							'<div class="artist-avatar followers" style="background: url('+usr.profile_pic+');">'+
		                        '<a href="/users/wall?id='+usr.id+'"></a>'+
		                    '</div>'+
							'<div class="artist-song">'+
								'<h2 class="h2-notifications">'+
								'	<a href="/users/wall?id='+usr.id+'">'+usr.name+'</a>'+
								'</h2>'+
							'</div>'+
						'</div>'+
					'</div>';

					}
				}
			});
		});


		$(concatenar).insertBefore('.section.view-more').last();

	
	});

</script>
@stop