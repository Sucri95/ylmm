

// Crear Publicacion
$('.btn-publicar').on('click',function(){
	
	var data = $('.main-textarea').val()
	, avatar = $('.post-area .user-area .avatar').css('background-image').split('"')[1];

	if (data != '') {

		
		var newPost = '<div class="history-post">'+
				'<div class="post-item">'+
					'<div class="user-area">'+
					'<div class="comment-options">'+
							'<ul>'+
								'<li><a href="javascript:;">Editar</a></li>'+
								'<li><a href="javascript:;">Eliminar</a></li>'+
							'</ul>'+
						'</div>'+	
						'<div class="avatar" style="background: url('+avatar+')no-repeat cover;"></div>'+
						'<div class="data">'+
							'<h1><a href="">Ed Sheeran</a></h1>'+
							'<p>14hs</p>'+
						'</div>'+
					'</div>'+
					'<div class="user-post">'+
						'<div class="post-content">'+
							'<span>'+data+'</span>'+
						'</div>'+
						'<div class="tool-bar">'+
							'<ul>'+
								'<li><a href="">Compartir</a></li>'+
								'<li><a href="">Comentar</a></li>'+
							'</ul>'+
						'</div>'+
						'<div class="list-comment">'+
							'<ul>'+
								'<li class="comment-post-area">'+
									'<div class="avatar"></div>'+
									'<div class="text-area">'+
										'<textarea></textarea>'+
									'</div>'+
									'<div class="tool-bar">'+
										'<ul>'+
											'<li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>'+
										'</ul>'+
									'</div>'+
								'</li>'+
								'</ul>'+
								'</div>';

		
		$('.main-post').after(newPost);
		$('.main-textarea').val("");
	} 
});

//---------------------------------------------------------------------------------

// Menu de opciones en publicaciones
$(document).on('click','.comment-options',function(){
	$(this).children('ul').toggleClass('active');
});

//---------------------------------------------------------------------------------

// Eliminar publicacion.
$(document).on('click','.comment-options ul li:nth-child(2)',function(){
	$(this).parents().eq(4).remove();

});

//---------------------------------------------------------------------------------

// Editar publicacion.
$(document).on('click','.comment-options ul li:nth-child(1)',function(){

	var avatar = $(this).parents().eq(1).next('.avatar').css('background-image').split('"')[1]
	, 	user = $(this).parents().eq(1).siblings('.data').children('h1').children('a').text()
	, 	data = $(this).parents().eq(2).siblings('.user-post').children('.post-content').children('span')
	, 	tool = $(this).parents().eq(2).siblings('.user-post').children('.tool-bar');

	$(data).addClass('hidde');
	$(tool).addClass('hidde');

	$(data).after( '<textarea class="edit-post"></textarea>'+
				'<div class="tool-bar"><ul><li class="btn-edit-post"><a href="javascript:;">Editar</a></li></ul></div>');	

    $(this).parents().eq(2).siblings('.user-post').children('.post-content').children('.edit-post').val($(data).text());

});

//---------------------------------------------------------------------------------


$(document).on('click','.btn-edit-post', function(){

	var data = $(this).parents().eq(3).children('.post-content').children('.edit-post')
	, 	tool = $(this).parents().eq(3).children('.post-content').children('.tool-bar')
	, 	span = $(this).parents().eq(3).children('.post-content').children('span.hidde')
	, 	visible_tool = $(this).parents().eq(3).children('.tool-bar.hidde');
	

	$(visible_tool).removeClass('hidde');
	$(span).removeClass('hidde').text($(data).val());
	$(data).remove();
	$(tool).remove();

});

//---------------------------------------------------------------------------------


$(document).on('click','.post-new-coment',function() {
	
	var avatar = $(this).parents().eq(2).children('.avatar').css('background-image').split('"')[1]
	, 	data = $(this).parents().eq(2).children('.text-area').children('textarea').val()
 	,	appende =($(this).parents().eq(3).children('li:last-child'));

	var newPost = '<li>'+
			'<div class="comment-options">'+
				'<ul>'+
					'<li class="edit-posted-comment"><a href="javascript:;">Editar</a></li>'+
					'<li><a href="javascript:;">Eliminar</a></li>'+
				'</ul>'+
			'</div>'+	
			'<div class="avatar" style="background: url('+avatar+')no-repeat cover;"></div>'+
			'<span><a href="">Ed Sheeran </a></span>'+
			'<span> '+data+' </span>'+
			'<div class="tool-bar comment">'+
				'<ul>'+
					'<li><a href="javascript:;">Compartir</a></li>'+
					'<li><a href="javascript:;">Comentar</a></li>'+
				'</ul>'+
			'</div>'+
		'</li>';


		$(appende).before(newPost);
		$(this).parents().eq(2).children('.text-area').children('textarea').val('');
		
});

//---------------------------------------------------------------------------------

$(document).on('click', '.edit-posted-comment',function(){

	var avatar = $(this).parents().eq(2).children('.avatar').css('background-image').split('"')[1]
	,	name = $('.edit-posted-comment').parents(2).children('span')
	,	data = $('.edit-posted-comment').parents(2).children('span');


	

/*
	$(data).after( '<textarea class="edit-post"></textarea>'+
				'<div class="tool-bar"><ul><li class="btn-edit-post"><a href="javascript:;">Editar</a></li></ul></div>');*/

});

//---------------------------------------------------------------------------------
