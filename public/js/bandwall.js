 function onSeen(id)
    {     

      $.get('/seen?id='+id, function (response) {

        if (response == 1) {

          console.log('¡!');

        }else{

          console.log(response);
        }
      });


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
          $('.user-sub-menu.buscador').empty();
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
                  
                  if (item2.id_musician === null ) {

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

  $('.close-messages').on('click', function () {
    
    $('.messages').css('display', 'none');

  });

   $('.close-upload').on('click', function () {
    
    $('.overlay').toggleClass('active');

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

  $(document).on('click', '.btn-green.dark.my-right.btn-sosfan' , function(){
    
    if ($(this).hasClass('active')){

        $(this).removeClass('active').text('FOLLOW');

    }else{

       $(this).addClass('active').text('UNFOLLOW'); 
    
    }

  });

/*
$('.btn-follow').on('click', function(){

  if ($(this).hasClass('active')){

    $(this).removeClass('active');

  }else{

    $(this).addClass('active');

  }

});*/


$('.love-band').on('click', function(){
  if ($(this).hasClass('active')){
    $(this).removeClass('active');
  }else{
    $(this).addClass('active');
  }
});

  

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

    $('.slider-video').each(function(index, item){
      var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
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



function resizeImageToArea($imagen) {

      var imgWidth = $imagen.prop('width')
      ,   imgHieght = $imagen.prop('height');
  
      (imgWidth >= imgHieght) ?
        $imagen.css({'height': '100%','width': 'auto'}) :
        $imagen.css({'height': 'auto','width': '100%'});
}




$(".video.uploadmore .icon-plus").on('click', function () {
  $('.overlay').toggleClass('active');
})

function onSeen(id)
    {     

      $.get('/seen?id='+id, function (response) {

        if (response == 1) {

          console.log('¡!');

        }else{

          console.log(response);
        }
      });


    }

