function formsubmit(laforma)
{
  var postcomment = $(" #"+laforma.id)
  var formData = postcomment.serialize();
  $.ajax({
          url: '/users/wall',
          type: 'POST',
          data: formData,
          success: function(data) {
            reloadmaximun();
          },
      });

}

  function reloadmaximun(){
    $.get('/users/commenthtml?id=<?php echo $id; ?>',function(response){
      document.getElementById('coments-container').innerHTML= response;
    });
  }

  $('.comentarioprincipal').on('click', function(){
    $(this).parent('.footer-post').parent('.post-data').parent('.coment-post').empty();
  });


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

            var $input  = $(this);
            var $span   =  $(this).prev('span');
            var $avatar = $(this).parent('h1').parent('div').siblings('.avatar');
            var id      = $(this).parent('h1').parent('div').attr('class').split(' ').pop().split('-').pop();
            var avatar = $(this).parent('h1').parent('div').siblings('.avatar');
            var toolBar = $(this).parent('h1').parent('div').parent('.user-area').siblings('.user-post').children('.tool-bar');



            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
 

            if (keycode == '13') {
               
               $span.text($input.val()).removeClass('hidden');
               $input.attr('type','hidden');
               avatar.css('display', 'block');
               $(toolBar).removeClass('hidde');               
               var title = $input.val();
               
               var postItem = document.getElementById(id);
               $(postItem).children('.user-post').children('.tool-bar').removeClass('hidde');

              $.get('/edittitle?id='+id+'&title='+title, function (response) {
              
                if (response == 1) {
                  console.log('¡Comentario Editado!');
                }else{
                  console.log(response);
                }
              
              });
            
            }



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

    function onEditResponse(id) {

    var auxID = id - 1;
    $('input#id_comment_'+auxID).parent('#respuesta2').addClass('hidde');
    $('#coment-post-'+id).next('form.edit-response').addClass('active');
    
    }


   function makefanmusician(idmusic) {
      
      $.get('/makefanmusician?idmusic='+idmusic+'', function (response) {

        if (response == 1) {

          $('.btn-green.dark.my-right.btn-sosfan').on('click', function(){
            
            $(this).addClass('active').text('UNFOLLOW');
    
          });

          console.log('¡SOS FAN!');

        }else{

          $('.btn-green.dark.my-right.btn-sosfan').on('click', function(){

            $(this).removeClass('active').text('FOLLOW');
            
          });

          console.log('YA NO SOS FAN');
        }
      });
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

    $('.video-like').on('click', function(){

      $(this).toggleClass('active');

    });


  $('.btn-green.dark.my-right.btn-sosfan').on('click', function(){
    
    if ($(this).hasClass('active')){

        $(this).removeClass('active').text('FOLLOW');

    }else{

       $(this).addClass('active').text('UNFOLLOW'); 
    
    }

  });
    

    $('.btn-dropdown').on('click', function(){
         $(this).find('.dropdown-options').toggleClass('active');
   
    });



    $.fn.enterKey = function (fnc) {
      
      return this.each(function () {
        $(this).keypress(function (ev) {
          var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
              fnc.call(this, ev);
            }
        })
      })
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

$('.upload-videos').on('click',function(){
  $('.load_vid').trigger('click');
});

$('.upload-videos, .close-v').on('click', function () {
  $('#url').val('');
  $('.overlay').toggleClass('active');
  $('.overlay .active > .container').empty();
  $('.video-container').css({
    'background': 'white', 
    'background-size': '100% auto'
  });
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

  function showMyVideo(fileInput) {

        var files = fileInput.files;

        $('.video-container').css('display','block');
            
            var videoType = /video.*/;     
            /*
            if (!file.type.match(videoType)) {
                continue;
            }           
          */

          //  $('.video-container').append('<video id="video-upload" src="" style="width: 10em; height: 10em;""></video>');
           
           var video = document.getElementById("video-upload");      

            video.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 

                return function(e) { 
                  console.log(e.target.result);
                  aImg.src = e.target.result; 
                };

            })(video);

            reader.readAsDataURL(file);     
        
    }


$('.close-messages').on('click', function () {    
    $('.messages').css('display', 'none');
});

$('body > div.top-profile-menu > a > div > img, .container-avatar')
   .on('mouseenter', function(){
      $('.container-avatar').addClass('active');
   })
   .on('mouseleave',function(){
      $('.container-avatar').removeClass('active');
   });


 $('.slider-type-2 .image-1, .update-background')
   .on('mouseenter', function(){
      $('.update-background').addClass('active');
      $('.background-legend').addClass('active');
   })
   .on('mouseleave',function(){
      $('.update-background').removeClass('active');
      $('.background-legend').removeClass('active');
   });

   $('.update-background').on('click',function(){
      $('.file-background').trigger('click');
   });

   $('.file-background').change(function(){
      loadOneImage(this, "image-1", 1)
      $('.save-position-image').addClass('active');
   });

   $('.container-avatar').on('click',function(){
     $('.file-avatar').trigger('click');
   });

   $('.file-avatar').change(function(){
      loadOneImage(this, "img-avatar",0)
   });


   function loadOneImage(elm, itemId,type) {
        
        var files = elm.files;

       for (var i = 0; i < files.length; i++) {           
            
            var file = files[i];
            
            var imageType = /image.*/;     
            
            if (!file.type.match(imageType)) {
                continue;
            }           
           
           var img=document.getElementById(itemId);      

            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
              return function(e) { 
         
                var img_width = img.clientWidth;
                var img_height = img.clientHeight;

                if(type === 1) {

                    //Asigna la imagen de portada
                    $('.'+itemId).attr('src', e.target.result);

                    if(e.target.result.indexOf('resources/portada.png') > 0){
                      $('.slider-type-2 .image-1').css('height', '100%');
                    } else {
                      $('.slider-type-2 .image-1').css('height', 'auto');
                    }



                    //$('#background-pic').submit();

                  
                    // Verifica que la imagen sea del tamaña solicitado.
                    if (img_width < 1024 || img_height <768) {
                   //     alert("Imagen muy pequeña");
                    } else {

                    }

                } else {
                    //Carga la imagen del avatar del usuario
                    aImg.src = e.target.result;
                    $('#profile-pic').submit();
                }
              
              }; 
            })(img);

            reader.readAsDataURL(file);
        
        }   
        
   }

    function resizeImageToArea($imagen) {

      var imgWidth = $imagen.prop('width')
      ,   imgHieght = $imagen.prop('height');
  
      (imgWidth >= imgHieght) ?
        $imagen.css({'height': '100%','width': 'auto'}) :
        $imagen.css({'height': 'auto','width': '100%'});
    }

      $('div.stats.cf.in-left > a:nth-child(1)').hover(function(){
        $('.dropwall').addClass('active');
      });

      $('.dropwall').mouseleave(function(){
        $('.dropwall').removeClass('active');
      });

      $('.profile-info').hover(function(){
        $('.drop-down-menu').addClass('active');
      });

      $('.drop-down-menu').mouseleave(function(){
        $('.drop-down-menu').removeClass('active');
      });

      $('.notification').hover(function(){
        $('.drop-down-menu2').addClass('active');
      });

      $('.drop-down-menu2').mouseleave(function(){
        $('.drop-down-menu2').removeClass('active');
      }); 

    $(".input-type-search").keyup(function (e) {
        e.preventDefault();
        nav_search();
    });

  $("nav .items ul.main-menu li:nth-child(1) input").keyup(function (e) {
        e.preventDefault();
        nav_search(0);
    });

    $("nav .items ul.main-menu li:nth-child(1) input ").focusin(function (e) {
        e.preventDefault();
        nav_search(0);
    });


    $("nav .items ul.main-menu li:nth-child(1) input").focusout(function(){
      setTimeout(function(){
          //$('.user-sub-menu.buscador').empty();
      },400);
      
    });

     $("nav .items ul.main-menu li:nth-child(1) input").keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });


    $(".search-area form input").keyup(function (e) {
        e.preventDefault();
        nav_search(1);
    });

    $(".search-area form input ").focusin(function (e) {
        e.preventDefault();
        nav_search(1);
    });


    $(".search-area form input").focusout(function(){
      setTimeout(function(){
        $('.user-sub-menu.buscador').empty();
      },400);
      
    });
    
    $(".search-area form input").keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });





 function nav_search(num) {
  
        if(num == 1) {
           var search = $(".modal-search.active form input ").val();
        } else {
          var search = $("nav .items ul.main-menu li:nth-child(1) input").val();
        }
        
        $.get('http://www.youlovemymusic.com/search?search='+ search, function (data) { 
          var cont = 0;

          $('.user-sub-menu.buscador li').remove();

          cont = 0;

          $.each(data, function(index, item) {
           
            $.each(item, function(index2, item2) { 
              if (cont <= 4) {
              
              var url = ''
                , type = ''
                , name = ''
                , image = ''
                , level = '';


              /*- ----------------------------------- */
              
              if(index === 'bands') {
                url =  'http://www.youlovemymusic.com/bands/comments?id='+item2.id;
                type = 'band';
                img =  item2.profile_pic;
                name = item2.name;
                
               // $('.buscador ul').append('<li> <a href="'+url+'"> <div class="img-section"><img src="'+img+'"></div><div class="data-section"><p>'+name+'</p><span>Banda</span></div></a></li>');

                $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '  <div class="user-item">'+
                     '   <div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '  <div class="user-info">'+
                       '   <h1>'+name+'</h1>'+
                        '  <p>Banda</p>'+
                       ' </div>'+
                     ' </div>'+
                   ' </a>'+
                  '</li>'

                );
              }

              /*- ----------------------------------- */
              
              if(index === 'user') {
                url =  'http://www.youlovemymusic.com/users/wall?id='+item2.id;
                type = 'User';
                img =  item2.profile_pic;
                name = item2.name;
                level = item2.user_level;
            
                if (level === '3' || level === '5') {

                  //$('.buscador ul').append('<li> <a href="'+url+'"> <div class="img-section"><img src="'+img+'"></div><div class="data-section"><p>'+name+'</p><span>Músico</span></div></a></li>');

                  $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '  <div class="user-item">'+
                     '   <div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '  <div class="user-info">'+
                       '   <h1>'+name+'</h1>'+
                        '  <p>Músico</p>'+
                       ' </div>'+
                     ' </div>'+
                   ' </a>'+
                  '</li>'

                );
       
                }else{

                 // $('.buscador ul').append('<li> <a href="'+url+'"> <div class="img-section"><img src="'+img+'"></div><div class="data-section"><p>'+name+'</p><span>Fan</span></div></a></li>');

                  $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '  <div class="user-item">'+
                     '   <div class="avatar" style="background:url('+img+')no-repeat;background-size:cover;"></div>'+
                      '  <div class="user-info">'+
                       '   <h1>'+name+'</h1>'+
                        '  <p>Fan</p>'+
                       ' </div>'+
                     ' </div>'+
                   ' </a>'+
                  '</li>'

                );


                }

              }

              /*- ----------------------------------- */

              if(index === 'videos') {  
                  
                  if (item2.id_musician === ' ' ) {
                    url =  'http://www.youlovemymusic.com/bands/band_comments?idvideo='+item2.id+'&idband='+item2.id_band;
                  }else{
                    url =  'http://www.youlovemymusic.com/musician/musician_comments?id='+item2.id_user+'&idvideo='+item2.id+'&idmusic='+item2.id_musician;
                  }

                  type = 'band';
                  name = item2.name;

                var link =  item2.url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';
             
                $('.user-sub-menu.buscador').append(
                  '<li>'+
                    '<a href="'+url+'">'+
                    '  <div class="user-item">'+
                     '   <div class="avatar" style="background:url('+link+')no-repeat;background-size:cover;"></div>'+
                      '  <div class="user-info">'+
                       '   <h1>'+name+'</h1>'+
                        '  <p>Video</p>'+
                       ' </div>'+
                     ' </div>'+
                   ' </a>'+
                  '</li>'
                );
              }
              /*- ----------------------------------- */

     
              cont = cont + 1;
            }

           });
            
          });
/*
           $('.buscador ul').append(
          '<li class="last-item"> <a href="http://www.youlovemymusic.com/searchresults?search='+search+'"> '+
          ' <div><p>Ver Todos</p></div> '+
          '</a></li>');
        */
        
        });
    }

  function onView(id)
  {
    $.get('/users/fan/addView?id='+id, function (response) {
      if (response == 1) {
        console.log('¡Video Visto!');
      }else{
        console.log(response);
      }
    })
  }

/* --------------------------------------------------------------------------------------------------------------------- */

// Crear Publicacion
$('.btn-publicar').on('click',function(){
  
  var text = $('.main-textarea').html()
  , id_user = $(this).parent('.tool-bar').siblings('.id_user').val()
  , id_wall = $(this).parent('.tool-bar').siblings('.id_wall').val()
  , userName = $('#username').val()
  , avatar = $('#profile_pic').val()
  , f = new Date();

  var users = $('#userArray').val();

  if (users != '') {
    
    var check = 'true';

    var findCount = users.indexOf(',');

    if (findCount > 0) {
    
      var findUser = users.split(',');  
      var number = findUser.length;
      console.log(findUser);
      console.log(number);
    
    }else{

      var number = 1;

      console.log(users);

    }

  }else{
    var check = 'false';
  }


  if (text != '') {

    //console.log('Texto : '+text+' id_user : ' +id_user+ ' id_wall : '+id_wall+ ' check : ' +check+ ' count : ' +number+ 'user '+users+ ' id_comment');

  $.ajax({

          url: 'http://www.youlovemymusic.com/users/wall/comment',
          type: 'POST',
          dataType: 'json',
          contentType: "application/json",
          data:  JSON.stringify({
            comment   : text,
            id_user   : id_user,
            id_wall   : id_wall,
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
              '<input type="hidden" class="id_wall" name="id_wall" value="'+id_wall+'">'+
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
 /* $(this).parents().eq(4).remove();*/
});

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
  ,   divAvatar = $(this).parents().eq(3).siblings('.user-area').children('.avatar');
  
    
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
  $(divAvatar).css('display', 'block');

});

//---------------------------------------------------------------------------------

// Crear Publicacion
$(document).on('click','.post-new-coment',function() {
  


  var avatar = $('#profile_pic').val()
  ,   text = $(this).parents().eq(2).children('.text-area').children('.input-text').html()
  ,   appende =($(this).parents().eq(3).children('li:last-child'))
  ,   id_user = $(this).parent('ul').parent('.tool-bar').siblings('.id_user').val()
  ,   id_wall = $(this).parent('ul').parent('.tool-bar').siblings('.id_wall').val()
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

          url: 'http://www.youlovemymusic.com/users/wall/comment',
          type: 'POST',
          dataType: 'json',
          contentType: "application/json",
          data:  JSON.stringify({
            comment   : text,
            id_user   : id_user,
            id_wall   : id_wall,
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

//Respuesta de una respuesta

$(document).on('click','.post-new-response',function() {
  


  var avatar = $('#profile_pic').val()
  ,   data = $(this).parents().eq(2).children('.text-area').children('textarea').val()
  ,   appende =($(this).parents().eq(3).children('li:last-child'))
  ,   id_user = $(this).parent('ul').parent('.tool-bar').siblings('.id_user').val()
  ,   id_wall = $(this).parent('ul').parent('.tool-bar').siblings('.id_wall').val()
  ,   id_comment = $(this).parent('ul').parent('.tool-bar').siblings('.id_comment').val()
  ,   id_response = $(this).parent('ul').parent('.tool-bar').siblings('.id_response').val()
  ,   userName = $(this).parent('ul').parent('.tool-bar').siblings('.username').val();

  var counter = $(this).parents('.list-comment.active').prev('.tool-bar').children('span');
  var num = parseInt(counter.text().split(': ').pop()) + 1;
  
  /*  Post Comment dd */
  if (data != '') {


    $.get('/walls/response?comment='+data+'&id_user='+id_user+'&id_wall='+id_wall+'&id_comment='+id_comment+'&id_response='+id_response, function (response) {
        if (response) {
            var newPost = '<li class="response_id_'+response+'">'+
            '<div class="comment-options responses">'+
              '<ul>'+
                '<li><a href="javascript:;" onclick="onEdit('+response+')">Editar</a></li>'+
                '<li><a href="javascript:;" onclick="onDelete('+response+')">Eliminar</a></li>'+
              '</ul>'+
            '</div>'+ 
            '<div class="avatar" style="background: url('+avatar+')no-repeat; background-size: cover;"></div>'+
            '<span class="name_user"><a href="javascript:;">'+userName+'</a></span>'+
            '<span class="data_response" id="'+response+'"> '+data+' </span>'+
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
        $(this).parents().eq(2).children('.text-area').children('textarea').val('');
        $('textarea').val('');
          console.log('¡Respuesta Publicada!');
          counter.text('Respuestas: '+num);

        }else{
          console.log(response);
        }

       



    });


  }

  /*  Post Comment dd */
    
});


/*-------------------------------Edit responses---------------------------------------*/

$(document).on('click', '.comment-options.responses ul li:nth-child(1)', function() {

   var avatar = $('#profile_pic').val()
  ,   user = $(this).parent('ul').parent('.comment-options.responses').siblings('.name_user').children('a').text()
  ,   divUser = $(this).parent('ul').parent('.comment-options.responses').siblings('.name_user')
  ,   data = $(this).parent('ul').parent('.comment-options.responses').siblings('.data_response')
  ,   tool = $(this).parent('ul').parent('.comment-options.responses').siblings('.tool-bar.comment');

  $(data).addClass('hidde');
  $(tool).addClass('hidde');
  $(divUser).addClass('hidde');

  $(this).parent('ul').parent('.comment-options.responses').parent('li').siblings('.comment-post-area').addClass('hidde');

  $(data).after( '<textarea class="edit-post text-edit">'+$(data).text().trim('  ')+'</textarea>'+
        '<div class="tool-bar"><ul><li class="btn-edit-response"><a class="edit-a" href="javascript:;">FINALIZAR</a></li></ul></div>'); 

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