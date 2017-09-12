tends('layouts.bands')

@section('content')

<div class="container" style="padding-top: 4;">

	<?php if (isset($_GET['id'])) {
	    $id = $_GET['id'];
	    $banda = DB::table('bands')->find($id);
	}?>
	
	<section class="login" >
		<div class="inner my-text-center">
			<div class="inner-top">
				<h1> {{$banda->name}} </h1>
					<div class="login-green-bar my-center"></div>
	      	</div>
	    
	    <div class="inner-bottom my-left">
	        <div class="social-login my-left">
	        	<h4><b>Sobre {{$banda->name}}</b></h4>
	        		<div class="social-container ">
	                    {{$banda->about}}
	                </div>
	        </div>

	        <div class="form-login my-left">
	        	<h4><b>Integrantes</b></h4>
	        	<?php $users = DB::table('users')->where('id_band', $banda->id)->get(); ?>
	        	@foreach($users as $user)
	        		<?php $members = DB::table('members')->where('id_user', $user->id)->get(); ?>
	        		@foreach($members as $member)
	        			<div class="social-container ">
	        				{{$user->name}} - {{$member->role}}
	        			</div>
	        		@endforeach
	        	@endforeach
	        </div>
	     </div>
	  	</div>
	</section>

</div>

@stop

@section('jsfunctions')

<script type="text/javascript">

	function makeFan(id_band)
	{
	    $.get('/makefan?id_band='+id_band, function (response) {

	    	if (response == 1) {

	        	console.log('¡SOS FAN!');

	      	}else{

	        	console.log(response);
	      
	      	}
	    })
  	}

	function videoLike(id_video)
  	{
    	$.get('/videos/addLike?id_video='+id_video, function (response) {

      		if (response == 1) {

        		console.log('¡Video Likeado!');

      		}else{

        		console.log(response);

      		}
    	})
  	}

  	$('.slider-video').each(function(index, item){
      
    	var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      
      	$(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
  	
  	});

  	$('.btn-sosfan').on('click', function(){

  		$(this).toggleClass('active').text('HACETE FAN');

	});

</script>

@stop
