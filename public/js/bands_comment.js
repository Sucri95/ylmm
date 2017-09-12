/*	
  		$('.show-more').on('click',function(){

  			var moreVideos = '<li>'+
							'<a href="">'+
								'<span class="thrumb"></span>'+
								'<div class="info">'+
									'<h3>Pleiadian Friend (ambient / psychill / psybient mix)</h3>'+
									'<p>Fil Far</p>'+
									'<small>20,487 views</small>'+
								'</div>'+
							'</a>'+
						'</li>';

			$(moreVideos).insertBefore('.related-area ul li:last-child');
		});
*/
//-----------------------------------------------------------------------------------------------------------------
  		/* Comentar un comentario existente */
  		$(document).on('click','.create-comment', function(){

  				var  id_user = $(this).parent('li').parent('ul').siblings('.id_user').val()
				, id_band = $(this).parent('li').parent('ul').siblings('.id_band').val()
				, id_video = $(this).parent('li').parent('ul').siblings('.id_video').val()
				, id_comment = $(this).parent('li').parent('ul').siblings('.id_comment').val()
				, userName = $('#username').val()
				, profile_pic = avatar = $('#profile_pic').val();

  			var newPost = '<div class="comment-area post-area" style="border: 0px!important;">'+
							'<div class="avatar" style="background: url('+profile_pic+'); background-size: cover;"></div>'+
							'<div class="text-area responses text-replay"><div class="input-text" contenteditable="true" style="outline:0px;"></div></div>'+
							'<div class="toolbox">'+
								'<ul class="right options-icons">'+
									'<input type="hidden" class="id_video" name="id_video" value="'+id_video+'">'+
	                                '<input type="hidden" class="id_band" name="id_band" value="'+id_band+'">'+
	                                '<input type="hidden" class="id_comment" name="id_comment" value="'+id_comment+'">'+
	                                '<input type="hidden" class="id_user" name="id_user" value="'+id_user+'">'+
	                                '<input type="hidden" id="profile_pic" name="profile_pic" value="'+profile_pic+'">'+
									'<li class="li-addreplay"><button class="addreplay">Publicar</button></li>'+
								'</ul>'+
							'</div>'+
						'</div>';

			$(this).parents('.toolbox').children('.comment-area').remove();
			$(this).parent('li').parent('ul').parent('.toolbox').append(newPost);
			$(this).parent('li').parent('ul').parent('.toolbox').css("cssText", "width: 100% !important;");

  		});

//-----------------------------------------------------------------------------------------------------------------
		
		/* Crear Respuesta */
		$(document).on('click','.addreplay', function(){

			var text = $(this).parents('.toolbox').prev('.text-area').children('.input-text').html()
			var  id_user = $(this).parent('li').siblings('.id_user').val()
				, id_band = $(this).parent('li').siblings('.id_band').val()
				, id_video = $(this).parent('li').siblings('.id_video').val()
				, id_comment = $(this).parent('li').siblings('.id_comment').val()
				, avatar = $('#profile_pic').val()
				, userName = $('#username').val()
				, f = new Date()
				,   users = $('#userArray').val();

			  	if (users != '') {
				    
				    var check = 'true',
				    findCount = users.indexOf(',');

				    if (findCount > 0) {
				    
				      var findUser = users.split(',')
				      ,   number = findUser.length;
				    
				    }else{

				      var number = 1;

				    }

				}else{
				    
				    var check = 'false';

				}
		$.ajax({

		  url: 'http://www.youlovemymusic.com/bands/band_comments/videos',
		  type: 'POST',
		  dataType: 'json',
		  contentType: "application/json",
		  data:  JSON.stringify({
		    comment   : text,
		    id_user   : id_user,
		    id_video  : id_video,
		    check     : check, 
		    count     : number,
		    user      : users,
		    id_comment: id_comment
		  }),

		  success: function(response) {


			var newPost = '<div class="replay-area" id="replay-area_'+response+'">'+
			'<div class="avatar" style="background: url(\''+avatar+'\'); background-size: cover;"></div>'+
			'<div class="comment-options">'+
			'<ul>'+
			' <li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
			'<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
			'</ul>'+
			'</div>'+
			'<p><b><a href="javascript:;">'+userName+'</a></b><br><small>'+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'</small> </p>'+
			'<p>'+text+' </p>'+
			'<div class="toolbox">'+
			'<input type="hidden" class="id_video" name="id_video" value="'+id_video+'">'+
			'<input type="hidden" class="id_band" name="id_band" value="'+id_band+'">'+
			'<input type="hidden" class="id_comment" name="id_comment" value="'+response+'">'+
			'<input type="hidden" class="id_user" name="id_user" value="'+id_user+'">'+
			'<input type="hidden" id="profile_pic" name="profile_pic" value="'+avatar+'">'+
			'<ul class="right options-icons">'+
			'<li style="position: relative;"><a class="share-band" style="" href="javascript:;"> </a></li>'+
			'<li><button class="create-comment" style="margin-top: 0px!important;"></button></li>'+
			'<li><a class="like-band like-band-'+response+' like-comments" href="javascript:;" onclick="onLike('+response+')"> </a></li>'+
			'<li><a class="comment-like counter-like-'+response+'" href="javascript:;"> 0 </a></li>'+
			'<li style="float: left;"></li>'+
			'</ul>'+
			'</div>'+
			'</div>'+
			'</div>';

			var areaAppend = $('.addreplay').parent('li').parent('ul').parent('div').parent('div').parent('div').parent('div').children('.replay-area:last-child');

			$(newPost).insertAfter(areaAppend);

			$('.addreplay').parents('.toolbox').prev('.text-area').children('.input-text').html('');

			$('.addreplay').parent('li').parent('ul').parent('div.toolbox').parent('div.comment-area').remove();
		    $('.main-textarea').html("");
		    $('#userArray').val('');
		    console.log('¡Respuesta Publicada!');

		  }
		});
				
		
		});



//-----------------------------------------------------------------------------------------------------------------

		// Crear nuevo comentario en la publicacion.
		$('.top-publicacion').on('click', function(){
			
			var text =  $(this).parents('.toolbox').prev('.text-area').children('.input-text').html()
				, avatar = $('#profile_pic').val()
				, id_user = $(this).parent('li').siblings('.id_user').val()
				, id_band = $(this).parent('li').siblings('.id_band').val()
				, id_video = $(this).parent('li').siblings('.id_video').val()
				, userName = $('#username').val()
				, f = new Date()
				, users = $('#userArray').val();
		  	
		  	if (users != '') {
			    
			    var check = 'true',
			    findCount = users.indexOf(',');

			    if (findCount > 0) {
			    
			      var findUser = users.split(',')
			      ,   number = findUser.length;
			    
			    }else{

			      var number = 1;

			    }

			}else{
			    
			    var check = 'false';
			    
			}


			if(text != '') {

				console.log('Texto : '+text+' id_user : ' +id_user+ ' id_video : '+id_video+ ' check : ' +check+ ' count : ' +number+ 'user '+users+ ' id_comment');
			
		$.ajax({

		  url: 'http://www.youlovemymusic.com/bands/band_comments/videos',
		  type: 'POST',
		  dataType: 'json',
		  contentType: "application/json",
		  data:  JSON.stringify({
		    comment   : text,
		    id_user   : id_user,
		    id_video  : id_video,
		    check     : check, 
		    count     : number,
		    user      : users,
		    id_comment: ''
		  }),

		  success: function(response) {

		    var  newPost  = 
		    '<div class="comment-history-list" id="history-list-'+response+'">'+
		    '<div class="parent-comment">'+
		    '<div class="top-comment">'+
		    '<div class="avatar" style="background: url(\''+avatar+'\'); background-size: cover;"></div>'+
		    '<div class="comment-options">'+
		    '<ul>'+
		    '<li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
		    '<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
		    '</ul>'+
		    '</div>'+

		    '<p><b><a href="users/wall?id='+id_user+'">'+userName+'</a></b><br><small>'+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'</small> </p>'+
		    '<p class="text-comment" id="'+response+'"> '+text+' </p>'+
		    '<div class="toolbox">'+
		    '<input type="hidden" class="id_video" name="id_video" value="'+id_video+'">'+
		    '<input type="hidden" class="id_band" name="id_band" value="'+id_band+'">'+
		    '<input type="hidden" class="id_comment" name="id_comment" value="'+response+'">'+
		    '<input type="hidden" class="id_user" name="id_user" value="'+id_user+'">'+
		    '<input type="hidden" id="profile_pic" name="profile_pic" value="'+avatar+'">'+

		    '<ul class="right options-icons">'+
		    '<li style="position: relative;"><a class="share-band" style="" href="javascript:;"> </a></li>'+
		    '<li><button class="create-comment" style="margin-top: 0px!important;"></button></li>'+
		    '<li><a class="like-band like-band-'+response+' like-comments" href="javascript:;" onclick="onLike('+response+')"> </a></li>'+
		    '<li><a class="comment-like counter-like-'+response+'" href="javascript:;"> 0 </a></li>'+
		    '<li style="float: left;"></li>'+
		    '</ul>'+
		    '</div>'+
		    '<div class="replay-area"></div>'+
		    '</div>'+
		    '</div>';

		    $(newPost).insertBefore('.video-comment-content > .comment-history-list:nth-child(3)');
		    var numComment = parseInt($('.video-comment-content .header h2').text().split(' ').pop()) + 1;
		    $('.video-comment-content .header h2').empty().append('<b>Comentarios </b>'+numComment);
		    $('.input-text').html("");
		    $('#userArray').val('');
		    console.log('¡Comentario Publicado!');

		  }
		});

			}

		});


//------------------------------------------------Editar comentarios -----------------------------------------------------------------


$(document).on('click','.comment-options ul li:nth-child(1)',function(){

  var avatar = $('#profile_pic').val()
  ,   user = $(this).parent('ul').parent('div.comment-options').siblings('p').children('b').children('a').text()
  ,   data = $(this).parent('ul').parent('div.comment-options').siblings('p.text-comment')
  ,   tool = $(this).parent('ul').parent('div.comment-options').siblings('div.toolbox')

  $(data).addClass('hidde');
  $(tool).addClass('hidde');

   $(data).after( '<textarea class="edit-post">'+$(data).text().trim('  ')+'</textarea>'+
        '<div class="tool-bar"><ul><li class="btn-edit-post" style="margin-top: 5px!important; font-size: 11px!important;">'+
        '<a class="edit-a" href="javascript:;" style="position: inherit; line-height: 20px;">Finalizar</a></li></ul></div>');    

});


$(document).on('click','.btn-edit-post', function(){

  var data = $(this).parent('ul').parent('div.tool-bar').siblings('.edit-post')
  ,   tool = $(this).parent('ul').parent('div.tool-bar')
  ,   span = $(this).parent('ul').parent('div.tool-bar').siblings('p.text-comment')
  ,   visible_tool = $(this).parent('ul').parent('div.tool-bar').siblings('.toolbox')
  
   
    var idComment = $(span).attr('id');

    var postcomment = $(data).val();


    $.get('/editcomment?id='+idComment+'&comment='+postcomment, function (response) {
      if (response == 1) {
        console.log('¡Comentario Editado!');
      }else{
        console.log(response);
      }
    });

  $(visible_tool).removeClass('hidde');
  $(span).removeClass('hidde').text($(data).val());
  $(data).remove();
  $(tool).remove();

});

$(document).on('click', '.img-view', function() {

	var vote = $('.view-counter');
	var vote1 = parseInt($(vote).text()) + 1;      
	$(vote).text(vote1);

});

//---------------------------------------------------------------------------------