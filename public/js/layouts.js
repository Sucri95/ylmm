
$('#country').on('change', function (){

  var z = $( "#country option:selected" ).text();
  console.log(z);

  if (z === 'Argentina') {

    $('#argprovince').css('display', 'block');
    $('#departamentos').css('display', 'none');
    $('#selectedcountry').val('Argentina'); 
  
  }else if(z === 'Uruguay'){
  
    $('#departamentos').css('display', 'block');
    $('#argprovince').css('display', 'none');
    $('#selectedcountry').val('Uruguay');
  }

});


$('#argprovince').on('change', function (){

  var y = $( "#argprovince option:selected" ).text();

    $('#selectedprovince').val(y); 
  

});

$('#departamentos').on('change', function (){

  var x = $( "#departamentos option:selected" ).text();

    $('#selectedprovince').val(x);

});

$('.fan').on('click', function () {
  $('#type').val('F');
  $('.fan').css('opacity', '1');
  $('.musico').css('opacity', '0.5');
});
$('.musico').on('click', function () {
  $('#type').val('B'); 
  $('.musico').css('opacity', '1');
  $('.fan').css('opacity', '0.5');
});

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

    $(".slider-row").slick({
          dots: false,
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3,
          responsive: [{
            breakpoint: 960,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
              dots: false,

            }
          }]
    });


    $(".slider-row3").slick({
      dots: false,
      autoplay: false,
      slidesToShow: 6,
      slidesToScroll: 6,
      infinite: true,
      draggable: false,
              
      responsive: [{
        breakpoint: 960,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      }]
    });


    $('.slider-row2').slick({
      dots: true,    
      arrows : false,
      autoplay: true,
      cssEase: 'linear',
      variableWidth: true,
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

  function onLike(id_video)
  {
    $.get('/users/fan/addlike?id_video='+id_video, function (response) {
      if (response == 1) {
        console.log('¡Video Likeado!');
      }else{
        console.log(response);
      }
    })
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