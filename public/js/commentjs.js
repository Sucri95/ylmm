
  var upload_type = 0;

  $('.comentarioprincipal').on('click', function(){

      $(this).parent('.footer-post').parent('.post-data').parent('.coment-post').empty();
  
  });

  function onLike(id)
  {

  $.get('/bands/band_comments/addLike?id='+id, function (response) {

    if (response == 1) {

      $('.like-band-'+id).addClass('active');

      var like = $('.counter-like-'+id);
      var likeSum = parseInt($(like).text()) + 1;      
      $(like).text(likeSum);

      console.log('¡Comentario Likeado!');

    }else{

      $('.like-band-'+id).removeClass('active');

      var like = $('.counter-like-'+id);
      var likeSum = parseInt($(like).text()) - 1;      
      $(like).text(likeSum);

      console.log(response);
    }
    
  });
  }


  function videoLike(id_video)
  {
  $.get('/videos/addLike?id_video='+id_video, function (response) {

    if (response == 1) {

      $('.like-band-'+id_video).addClass('active');

      var like = $('.vlike-counter-'+id_video);
      var likeSum = parseInt($(like).text()) + 1;      
      $(like).text(likeSum);

      console.log('¡Video Likeado!');

    }else{


      $('.like-band-'+id_video).removeClass('active');

      var like = $('.vlike-counter-'+id_video);
      var likeSum = parseInt($(like).text()) - 1;      
      $(like).text(likeSum);


      console.log(response);
    }
  })
  }

/* --------------------------------------------------------------------------- */

   function onEdit(id) {

      var $getTexto = $('.data.class-'+id+ '')
      ,   $span =  $('.data.class-'+id+ ' h1 span')
      ,   $input =  $('.data.class-'+id+ ' h1 input')
      ,   $avatar = $('.data.class-'+id+ '').siblings('.avatar');


      $input.attr('type', 'text');
      $span.addClass('hidden');
      $avatar.css('display', 'none');


      $input.val($span.text());


    }



    $('input.input-edit').on('keyup',function(ev){

            var $input = $(this);
            var $span =  $(this).prev('span');
            var id = $(this).parent('h1').parent('div').attr('class').split(' ').pop().split('-').pop();
            var avatar = $(this).parent('h1').parent('div').siblings('.avatar');
            var toolBar = $(this).parent('h1').parent('div').parent('.user-area').siblings('.user-post').children('.tool-bar');



            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
 

            if (keycode == '13') {
               
               $span.text($input.val()).removeClass('hidden');
               $input.attr('type','hidden');
               avatar.css('display', 'block');
               $(toolBar).removeClass('hidde');
               var title = $input.val();



               $.get('/edittitle?id='+id+'&title='+title, function (response) {
			      if (response == 1) {
			        console.log('¡Comentario Editado!');
			      }else{
			        console.log(response);
			      }
			    });
            
            }



    });


    /* --------------------------------------------------------------------------- */


     $('.btn-dropdown').on('click', function(){
        $(this).find('.dropdown-options').toggleClass('active');
    });

    /* --------------------------------------------------------------------------- */


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


    $('.slider-video').on('click',function() {
        var item = $(this).children('a').children('input').val(),
        iframe = $(this).children('a').children('iframe').addClass('my-visible').attr('src', item);
      
        $(this).children('a').children('img').addClass('not-visible');  
        $(this).children('a').children('div').addClass('not-visible');  
    });

   $('.slider-video').each(function(index, item){
        var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
        $(item).children('a').children('div').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
    });

    $('.ingresar').on('click', function(){

      $('.input.respuesta').val('1');

    });


    $.fn.enterKey = function (fnc) {
      
      return this.each(function () {
    
        $(this).keypress(function (ev) {
          var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
              fnc.call(this, ev);
            }
        });
      
      });

    }


    $(".user-post-area").enterKey(function () {

      $('.user-post-input').val($(this).val());
      $('.user-post-input').trigger('click');
    });

    $('.coment-post').each(function(index,item) {
      $(item).children('div.avatar-area').height($(item).height());
    });


  function handleFiles(files) {

  var ext = $("#document").val().split('.').pop(); // Obtengo la extensión

  if((ext == "jpg") || (ext == "jpeg") || (ext == "png"))
  {
    for (var i = 0; i < files.length; i++) {
     
      var file    = files[i];
      var imageType   = /image.*/;
      var img     = document.createElement("img");

      img.classList.add("obj");
      img.classList.add("thumbnail");
      img.classList.add("config_img");
      img.file    = file;
      
      $("#image").html(img);
      
      var reader    = new FileReader();
      reader.onload   = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
      reader.readAsDataURL(file);
    }
  }

}

$('.yt-url').on('change',function(){
 });


$(".yt-url").on('keyup',function(e) { 
    
    e.preventDefault(); 
    
    var keyCode = e.keyCode || e.which; 
    var iframe_src =  $(this).val();
    var youtube_video_id = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
   
    if (youtube_video_id.length == 11) {
        var video_thumbnail = $('<img src="//img.youtube.com/vi/'+youtube_video_id+'/0.jpg">');
        $('.img-yt').css('display', 'block').attr('src',video_thumbnail[0].src);
        $('.login').css({
          'height': '56em',
          'padding-top': '4em'

        });
    }
 
});

// Al hacer click sobre el item de imagenes lanza un trigger al input de archivos.
$('.upload-images, .close').on('click',function(){
  $('.overlay-img').toggleClass('active');
  $('.img-container').empty();
});

$('.upload-images').on('click',function(){
  $('.load_img').trigger('click');
});


$('.close').on('click',function(){
  $(this).closest('.active').removeClass('active');
});

$('.upload-videos').on('click',function(){
  $('.load_vid').trigger('click');
});

$('.upload-videos, .close-v').on('click', function () {
  $('#url').val('');
  $('.overlay').toggleClass('active');
  $('.overlay .active > .container').empty();
  $('#validateSubmitForm > div > .img-yt').attr('src', '').css('display', 'none');
});

$('.load_vid').on('change',function(){

  $('.video-container').css({
    'background': 'white', 
    'background-size': '100% auto'
  });

      setTimeout(function(){

        $('.video-container').addClass('active');
        $('.timer').css('display', 'block');

      },400);

    setTimeout(function(){

     $('.video-container').css({
        'background': 'url(../../images/resources/thumbnail_video.png)no-repeat', 
        'background-size': '100% auto'
      });    
      $('.timer').css('display', 'none');
      $('#btn-sub-vid').attr('disabled', false);   
          
    },4000);

});

$(document.body).on('click', '.upload-more' ,function(){
  upload_type = 1;
  $('.load_img').trigger('click');
});


var aux = 0;

function showMyImage(fileInput) {

  var files = fileInput.files;

  $('.img-container').css('display','block');

  setTimeout(function(){
  
  for (var i = 0; i < files.length; i++) {           

    var file = files[i];

    var imageType = /image.*/;         

    $('.img-container')
    .append('<div style="width: 10em; height: 10em; overflow: hidden; float: left; margin: 0.8em;">'+
    '<img id="images-'+aux+'"  src="" style="width: 100%; height: auto; margin: 0;"></div>');

    var img = document.getElementById("images-"+aux);      

    img.file = file;    
    var reader = new FileReader();
      reader.onload = (function(aImg) { 

      return function(e) { 
        aImg.src = e.target.result; 
      };

      })(img);

    reader.readAsDataURL(file);

    aux += 1;
    }    

    if (!($('.upload-more')[0])) {
      $('.img-container div')
      .before('<div class="upload-more onclick="loadMoreImages()"><div class="icon-plus"></div></div>');
    }

  },4000);

}

var array = [];

$(".load_img").change(function(){
  
  upload_type = 0;
  showMyImage(this);
  var image_array = '';

  setTimeout(function(){

    var imgs = $('body > div.overlay-img.active > div > form > div > div > img');     

    imgs.each(function(index,item){

    if(image_array === '') {
      image_array = $(item).attr('src');
    } else {
      image_array = image_array+"__"+$(item).attr('src');
    }

  });

  $('#array').val('');
  $('#array').val(image_array);

  },8000);

  $('.timer').css('display', 'block');

  setTimeout(function(){

  $('.timer').css('display', 'none');
  $('#btn-sub-img').attr('disabled', false);      

  },8000);

});

/* --------------------------------------------------------------------------------------------------------------------- */
/* JS Wall Pedro */
/*---------------------*/

// Crear Publicacion
$('.btn-publicar').on('click',function(){
  
  var text = $('.main-textarea').html()
  , avatar = $('#profile_pic').val()
  , id_user = $(this).parent('.tool-bar').siblings('.id_user').val()
  , id_band = $(this).parent('.tool-bar').siblings('.id_band').val()
  , userName = $('#username').val()
  , f = new Date()
  , users = $('#userArray').val();

  if (users != '') {
    
    var check = 'true'
    ,   findCount = users.indexOf(',');

    if (findCount > 0) {
    
      var findUser = users.split(',')
      ,   number = findUser.length;
      
    }else{

      var number = 1;

    }

  }else{
    
    var check = 'false';

  }

  if (text != '') {

    console.log('Texto : '+text+' id_user : ' +id_user+ ' id_band : '+id_band+ ' check : ' +check+ ' count : ' +number+ 'user '+users+ ' id_comment');

    /*  Post Comment dd */
    $.ajax({

          url: 'http://www.youlovemymusic.com/bands/wall/comment',
          type: 'POST',
          dataType: 'json',
          contentType: "application/json",
          data:  JSON.stringify({
            comment   : text,
            id_user   : id_user,
            id_band   : id_band,
            check     : check, 
            count     : number,
            user      : users,
            id_comment: ''
          }),

          success: function(response) {

            console.log(response);

              var newPost = '<div class="history-post" id="history-list-'+response+'">'+
              '<div class="post-item" id="'+response+'">'+
              '<div class="user-area">'+
              '<div class="comment-options">'+
              '<ul>'+
              '<li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
              '<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
              '</ul>'+
              '</div>'+ 
              '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
              '<div class="data">'+
              '<h1><a href="javascript:;">'+userName+'</a></h1>'+
              '<p>'+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'</p>'+
              '</div>'+
              '</div>'+
              '<div class="user-post">'+
              '<div class="post-content">'+
              '<span id="'+response+'">'+text+'</span>'+
              '</div>'+
              '<div class="tool-bar">'+
              '<span class="reply-counter">Respuestas: 0</span>'+
              '<ul>'+
              '<li><a class="share-band" href="javascript:;"> </a></li>'+
              '<li><a class="create-comment" href="javascript:;"></a></li>'+
              '<li><a class="like-band like-band-'+response+'" href="javascript:;" onclick="onLike('+response+')"> </a></li>'+
              '<li><a class="comment-like counter-like-'+response+'" href="javascript:;"> 0 </a></li>'+
              '<li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>'+
              '</ul>'+
              '</div>'+
              '<div class="list-comment">'+

              '<ul>'+
              '<li class="comment-post-area">'+
              '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
              '<div class="text-area responses">'+
              '<div class="input-text" contenteditable="true" style="outline:0px;"></div>'+
              '</div>'+
              '<input type="hidden" class="id_user" name="id_user" value="'+id_user+'">'+
              '<input type="hidden" class="id_band" name="id_band" value="'+id_band+'">'+
              '<input type="hidden" class="username" name="username" value="'+userName+'">'+
              '<input type="hidden" class="id_comment" name="id_comment" value="'+response+'">'+

              '<div class="tool-bar">'+
              '<ul>'+
              '<li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>'+
              '</ul>'+
              '</div>'+
              '</li>'+
              '</ul>'+
              '</div>';

        
              $('.main-post').after(newPost);
              $('.main-textarea').html("");
              $('#userArray').val('');

              }
    });

    /*$.get('/bands/wall/comment?comment='+data+'&id_user='+id_user+'&id_band='+id_band+'&id_comment= ', function (response) {
        
      if (response) {
        
        var newPost = '<div class="history-post" id="history-list-'+response+'">'+
        '<div class="post-item" id="'+response+'">'+
          '<div class="user-area">'+
          '<div class="comment-options">'+
              '<ul>'+
                '<li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
                '<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
              '</ul>'+
            '</div>'+ 
            '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
            '<div class="data">'+
              '<h1><a href="javascript:;">'+userName+'</a></h1>'+
              '<p>'+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'</p>'+
            '</div>'+
          '</div>'+
          '<div class="user-post">'+
            '<div class="post-content">'+
              '<span id="'+response+'">'+data+'</span>'+
            '</div>'+
            '<div class="tool-bar">'+
              '<span class="reply-counter">Respuestas: 0</span>'+
              '<ul>'+
                '<li><a class="share-band" href="javascript:;"> </a></li>'+
                '<li><a class="create-comment" href="javascript:;"></a></li>'+
                '<li><a class="like-band like-band-'+response+'" href="javascript:;" onclick="onLike('+response+')"> </a></li>'+
                '<li><a class="comment-like counter-like-'+response+'" href="javascript:;"> 0 </a></li>'+
                '<li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>'+
              '</ul>'+
            '</div>'+
            '<div class="list-comment">'+

              '<ul>'+
                '<li class="comment-post-area">'+
                  '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
                  '<div class="text-area responses">'+
                    '<textarea></textarea>'+
                  '</div>'+
                  '<input type="hidden" class="id_user" name="id_user" value="'+id_user+'">'+
                  '<input type="hidden" class="id_band" name="id_band" value="'+id_band+'">'+
                  '<input type="hidden" class="username" name="username" value="'+userName+'">'+
                  '<input type="hidden" class="id_comment" name="id_comment" value="'+response+'">'+

                  '<div class="tool-bar">'+
                    '<ul>'+
                      '<li class="post-new-coment"><a href="javascript:;">PUBLICAR</a></li>'+
                    '</ul>'+
                  '</div>'+
                '</li>'+
                '</ul>'+
                '</div>';

      
        $('.main-post').after(newPost);
        $('textarea').val("");

          console.log('¡Comentario Publicado!');
      
      }else{
      
          console.log(response);
      }
    });*/
    
    /*  Post Comment dd */



  } 
});

//---------------------------------------------------------------------------------

// Menu de opciones en publicaciones
$(document).on('click','.comment-options',function(){
  $(this).children('ul').toggleClass('active');
});

//---------------------------------------------------------------------------------
/*
// Eliminar publicacion.
$(document).on('click','.comment-options ul li:nth-child(2)',function(){
  $(this).parents().eq(4).remove();
});
*/
//---------------------------------------------------------------------------------

// Editar publicacion.
$(document).on('click','.comment-options ul li:nth-child(1)',function(){

  var avatar = $('#profile_pic').val()
  ,   user = $(this).parents().eq(1).siblings('.data').children('h1').children('a').text()
  ,   data = $(this).parents().eq(2).siblings('.user-post').children('.post-content').children('span')
  ,   tool = $(this).parents().eq(2).siblings('.user-post').children('.tool-bar');

  $(data).addClass('hidde');
  $(tool).addClass('hidde');

   $(data).after( '<textarea class="edit-post"></textarea>'+
        '<div class="tool-bar"><ul class="ul-edit-post"><li class="btn-edit-post"><a class="edit-a" href="javascript:;">FINALIZAR</a></li></ul></div>'); 

    $(this).parents().eq(2).siblings('.user-post').children('.post-content').children('.edit-post').val($(data).text());
    

});

//---------------------------------------------------------------------------------

// Editar publicacion Principal
$(document).on('click','.btn-edit-post', function(){

  var data = $(this).parents().eq(3).children('.post-content').children('.edit-post')
  ,   tool = $(this).parents().eq(3).children('.post-content').children('.tool-bar')
  ,   span = $(this).parents().eq(3).children('.post-content').children('span')
  ,   visible_tool = $(this).parents().eq(3).children('.tool-bar.hidde')
  ,   avatar = $(this).parent('ul').parent('.tool-bar').parent('.post-content').parent('.user-post').siblings('.avatar');
  
    
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
  $(avatar).css('display', 'block');
  $(span).removeClass('hidde').text($(data).val());
  $(data).remove();
  $(tool).remove();

});

//---------------------------------------------------------------------------------

// Crear Publicacion
$(document).on('click','.post-new-coment',function() {
  

  var avatar = $('#profile_pic').val()
  ,   text = $(this).parents().eq(2).children('.text-area').children('.input-text').html()
  ,   appende =($(this).parents().eq(3).children('li:last-child'))
  ,   id_user = $(this).parent('ul').parent('.tool-bar').siblings('.id_user').val()
  ,   id_band = $(this).parent('ul').parent('.tool-bar').siblings('.id_band').val()
  ,   id_comment = $(this).parent('ul').parent('.tool-bar').siblings('.id_comment').val()
  ,   userName = $(this).parent('ul').parent('.tool-bar').siblings('.username').val();

  var counter = $(this).parents('.list-comment.active').prev('.tool-bar').children('span');
  var num = parseInt(counter.text().split(': ').pop()) + 1;
  var users = $('#userArray').val();

  if (users != '') {
    
    var check = 'true'
    ,   findCount = users.indexOf(',');

    if (findCount > 0) {
    
      var findUser = users.split(',')
      ,   number = findUser.length;
      
    }else{

      var number = 1;

    }

  }else{
    
    var check = 'false';

  }


  /*  Post Comment dd */
  if (text != '') {

        $.ajax({

          url: 'http://www.youlovemymusic.com/bands/wall/comment',
          type: 'POST',
          dataType: 'json',
          contentType: "application/json",
          data:  JSON.stringify({
            comment   : text,
            id_user   : id_user,
            id_band   : id_band,
            check     : check, 
            count     : number,
            user      : users,
            id_comment: id_comment
          }),

          success: function(response) {

            var newPost = '<li class="response_id_'+response+'">'+
            '<div class="comment-options responses">'+
            '<ul>'+
            '<li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
            '<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
            '</ul>'+
            '</div>'+ 
            '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
            '<span class="name_user"><a href="javascript:;">'+userName+'</a></span>'+
            '<span class="data_response" id="'+response+'"> '+text+' </span>'+
            '<div class="tool-bar comment">'+
            '<ul>'+
            '<li><a class="share-band" href="javascript:;"> </a></li>'+
            '<li><a class="create-comment" href="javascript:;"></a></li>'+
            '<li><a class="like-band like-band-'+response+'" href="javascript:;" onclick="onLike('+response+')"> </a></li>'+
            '<li><a class="comment-like counter-like-'+response+'" href="javascript:;"> 0 </a></li>'+
            '<li style="float: left;"><div class="addthis_inline_share_toolbox"></div></li>'+
            '</ul>'+
            '</div>'+
            '</li>';

            $(appende).before(newPost);
            $(this).parents().eq(2).children('.text-area').children('.input-text').html('');
            $('.input-text').html('');
            console.log('¡Respuesta Publicado!');
            counter.text('Respuestas: '+num);
            $('#userArray').val('');

              }
          }); 

    }

  /*  Post Comment dd */

});

//---------------------------------------------------------------------------------

// Editar comentario de publicacion
$(document).on('click', '.edit-posted-comment',function(){
  var avatar = $('#profile_pic').val()
  , name = $('.edit-posted-comment').parents(2).children('span')
  , data = $('.edit-posted-comment').parents(2).children('span');

});


/* --------------------------------------------------------------------------------------------------------------------- */


/*-------------------------------Edit responses---------------------------------------*/

$(document).on('click', '.comment-options.responses ul li:nth-child(1)', function() {

   var avatar = $('#profile_pic').val()
  ,   user = $(this).parent('ul').parent('.comment-options.responses').siblings('.name_user').children('a').text()
  ,   divUser =  $(this).parent('ul').parent('.comment-options.responses').siblings('.name_user')
  ,   data = $(this).parent('ul').parent('.comment-options.responses').siblings('.data_response')
  ,   tool = $(this).parent('ul').parent('.comment-options.responses').siblings('.tool-bar.comment');

  $(data).addClass('hidde');
  $(tool).addClass('hidde');
  $(divUser).addClass('hidde');

  $(this).parent('ul').parent('.comment-options.responses').parent('li').siblings('.comment-post-area').addClass('hidde');

  $(data).after( '<textarea class="edit-post text-edit">'+$(data).text().trim('  ')+'</textarea>'+
        '<div class="tool-bar"><ul><li class="btn-edit-response btn-radius"><a class="edit-a" href="javascript:;">FINALIZAR</a></li></ul></div>'); 

    $(this).parents().eq(2).siblings('.data_response').children('.edit-post').val($(data).text());
  
});

$(document).on('click','.btn-edit-response', function(){

  var data = $(this).parent('ul').parent('.tool-bar').siblings('.edit-post')
  ,   tool = $(this).parent('ul').parent('.tool-bar')
  ,   span = $(this).parent('ul').parent('.tool-bar').siblings('.edit-post').siblings('.data_response')
  ,   user = $(this).parent('ul').parent('.tool-bar').siblings('.edit-post').siblings('.name_user.hidde')
  ,   visible_tool = $(this).parent('ul').parent('.tool-bar').siblings('.tool-bar.comment.hidde');
  
    
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
  $(user).removeClass('hidde');
  $('li.response_id_'+idComment).siblings('.comment-post-area').removeClass('hidde');
  $(span).removeClass('hidde').text($(data).val());
  $(data).remove();
  $(tool).remove();

});


//---------------------------------------------------------------------------------

// Editar publicacion Principal
$(document).on('click','.btn-edit-post.edit-media', function(){

  var data = $(this).parents().eq(3).children('.post-content').children('.edit-post')
  ,   tool = $(this).parents().eq(3).children('.post-content').children('.tool-bar')
  ,   span = $(this).parents().eq(3).children('.post-content').children('span')
  ,   visible_tool = $(this).parents().eq(3).children('.tool-bar.hidde');
  
    
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
/*--------------End Edit Media Title-------------------*/