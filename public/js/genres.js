
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
 

  $('.btn-green dark.my-right.btn-sosfan').on('click', function(){
    
    if ($(this).hasClass('active')){

        $(this).removeClass('active').text('HACETE FAN');

    }else{

       $(this).addClass('active').text('YA SOS FAN'); 
    
    }

  });

    $('.love-band').on('click', function(){
    
    if ($(this).hasClass('active')){

        $(this).removeClass('active');

    }else{

       $(this).addClass('active'); 
    
    }

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
  $('.close-messages').on('click', function () {
    
    $('.messages').css('display', 'none');

  });