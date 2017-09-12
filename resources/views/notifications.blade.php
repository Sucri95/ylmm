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
			background: -ms-linear-gradient(-45deg, #e42693 , #6e39a6);

		}

		.chart-ylmm .container-chart .section.view-more button:hover {
			background: -webkit-linear-gradient(-45deg, #6e39a6, #e42693);
			background: -ms-linear-gradient(-45deg, #e42693 , #6e39a6);
		}
		.chart-ylmm .container-chart .section:hover{
			background: -webkit-linear-gradient(45deg, #e42693 , #6e39a6);
			background: -ms-linear-gradient(45deg, #e42693 , #6e39a6);
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

		}

		.chart-ylmm >  .container-chart .section .main:before, .chart-ylmm >  .container-chart .section .vote:before {
			background: transparent;
		}
		
		.chart-ylmm >  .container-chart .section .main {
			padding: 0.8em 0;
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

		@supports (overflow:-webkit-marquee) and (justify-content:inherit) {
	      
	      nav .items ul li:nth-child(2) ul.user-sub-menu {
	        margin-top: 6.5px !important;
	      }
	      
	    }



	</style>


@section('content')

<div class="chart-ylmm" id="content">

	<div class="container-chart">
	
		<div class="header">
			<h2 style="padding-top: 1.7em;"> <span>Notificaciones</span> </h2>
		</div>
		
		<?php if (empty($special)) { ?>
			<!-- Chart Section  -->
			<div class="section">
				<!-- Main Section -->
				<div class="main">
					<div class="artist-song">
						<h2 class="h2-notifications"><a href="javascript:;">No tiene notificaciones</a></h2>
					</div>
				</div>
				<!-- Main Section -->	
			</div>
			<!-- Chart Section  -->
		<?php }else{ 

			$count = 0; ?>
			
			@foreach ($special as $noti)
				<div class="section">
					<!-- Main Section -->
					<div class="main">
						<div class="artist-song">

						<?php if ($noti['type'] == 'post') {
							
							$post = DB::table('comments')->where('id', $noti['id'])->first();
							
						?>
							<h2 class="h2-notifications" onclick="onSeen('{{$noti["id_noti"]}}')">
								<a href="/users/wall?id={{Auth::user()->id}}&id_comment={{$noti['id']}}">
									<?php if ($noti['seen'] == 'N') { echo '<b>' ; } ?>
										{{$noti['text']}}
									<?php if ($noti['seen'] == 'N') { echo '</b>'; } ?>
								</a>
							</h2>
							
						<?php } ?>

						<?php if ($noti['type'] == 'video' || $noti['type'] == 'view' || $noti['type'] == 'votes') {

							$video = DB::table('videos')->where('id', $noti['id'] )->first();

							if (!is_null($video->id_band)) { ?>

								<h2 class="h2-notifications" onclick="onSeen('{{$noti["id_noti"]}}')">
									<a href="/bands/band_comments?idvideo={{$video->id}}&idband={{$video->id_band}}">
										<?php if ($noti['seen'] == 'N') { echo '<b>'; } ?>
											{{$noti['text']}}
										<?php if ($noti['seen'] == 'N') { echo '</b>'; } ?>
										
									</a>
								</h2>

							<?php }else{ 

								$wall = DB::table('users')->where('id_musician', $video->id_musician)->first();

							?>

								<h2 class="h2-notifications" onclick="onSeen('{{$noti["id_noti"]}}')">
									<a href="/musician/musician_comments?id={{$wall->id_wall}}&idvideo={{$video->id}}&idmusic={{$video->id_musician}}">
										<?php if ($noti['seen'] == 'N') { echo '<b>' ; } ?>
											{{$noti['text']}}
										<?php if ($noti['seen'] == 'N') { echo '</b>'; } ?>		
									</a>
								</h2>

							<?php } ?>

						<?php } ?>

						<?php if ($noti['type'] == '') { ?>

							<?php if ($noti['href'] != '') { ?>

								<h2 class="h2-notifications" onclick="onSeen('{{$noti["id_noti"]}}')">
									<a href="{{$noti['href']}}">
										<?php if ($noti['seen'] == 'N') { echo '<b>' ; } ?>
											{{$noti['text']}}
										<?php if ($noti['seen'] == 'N') { echo '</b>'; } ?>
									</a>
								</h2>

							<?php }else{ ?>

								<h2 class="h2-notifications" onclick="onSeen('{{$noti["id_noti"]}}')">
									<a href="javascript:;">
										<?php if ($noti['seen'] == 'N') { echo '<b>' ; } ?>
											{{$noti['text']}}
										<?php if ($noti['seen'] == 'N') { echo '</b>'; } ?>
									</a>
								</h2>
							
							<?php } ?>

						<?php } ?>
						</div>
					</div>
					<!-- Main Section -->	
				</div>
				
				<?php $count++;
					
					if ($count == 10) { 
						break;

				} ?>

			@endforeach

			<?php if (count($special) >= 10 ) { ?>
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

$(document).ready( function () {

	setTimeout(function(){

		$.get('/notifications/seen', function(response){
			/*
			if (response == 'done') {

				console.log('done');

			}else{

				console.log('error');
			}
			*/
		 });

	},400);
});

var not = <?php echo json_encode($merged); ?>;
var comments = <?php echo $comments; ?>;
var videos = <?php echo $videos; ?>;
var musicians = <?php echo $musicians; ?>;
var id_user = <?php echo Auth::user()->id; ?>;

$('.section.view-more button').on('click',function(){

	var numchild = $('.container-chart .section').length
	, maxnumchild = numchild + 10;

	var concatenar = '';

	for(var i = numchild; i <= maxnumchild; i++) {

		if(not[i]) {

			if (not[i].type == '') {

				if (not[i].seen == 'N') {

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="javascript:;"><b>"'+not[i].text+'"</b></a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'
				
				}else{

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="javascript:;">"'+not[i].text+'"</a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'

				}
			}

		if (not[i].type == 'votes' || not[i].type == 'video' || not[i].type == 'view'){

		 for (var j = 0, len = videos.length; j < len; j++) {

		  if (videos[j].id == not[i].id) {

			var video = videos[j].id;

			if (videos[j].id_band == null) {

				var artist = videos[j].id_musician;

				for (var k = 0, len = musicians.length; k < len; k++) {

				 if (musicians[k].id == artist) {

					var id_m = musicians[k].id;
				 }
				
				}

				if (not[i].seen == 'N') {

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/musician/musician_comments?id='+id_m+'&idvideo='+video+'&idmusic='+artist+'"><b>"'+not[i].text+'"</b>'+
				'</a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'
				
				}else{

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/musician/musician_comments?id='+id_m+'&idvideo='+video+'&idmusic='+artist+'">"'+not[i].text+'"</a>'+
				'</h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'

				}

			}else{

			var artist = videos[j].id_band;

				if (not[i].seen == 'N') {

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/bands/band_comments?idvideo='+video+'&idband='+artist+'"><b>"'+not[i].text+'"</b></a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'
				
				}else{

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/bands/band_comments?idvideo='+video+'&idband='+artist+'">"'+not[i].text+'"</a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'

				}
			   }
			  }
			}
		   }

		if (not[i].type == 'post'){

			if (not[i].seen == 'N') {

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/users/wall?id='+id_user+'&id_comment='+not[i].id+'"><b>"'+not[i].text+'"</b></a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'
				
				}else{

				concatenar += '<div class="section">'+
				'<!-- Main Section -->'+
				'<div class="main">'+
				'<div class="artist-song">'+
				'<h2 class="h2-notifications" onclick="onSeen("'+not[i].id_noti+'")">'+
				'<a href="/users/wall?id='+id_user+'&id_comment='+not[i].id+'">"'+not[i].text+'"</a></h2>'+
				'</div>'+
				'</div>'+
				'<!-- Main Section -->'+
				'</div>'

				}

		}
	}
}

setTimeout(function(){

	$(concatenar).insertBefore('.section.view-more').last();

	},400);
});

</script>
@stop