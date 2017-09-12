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

$('.comentarioprincipal').on('click', function(){

      $(this).parent('.footer-post').parent('.post-data').parent('.coment-post').empty();
  
  });


/*
  function onDelete(id)
    {
   

     $('#id_comment_'+id).parent('#respuestacomentario').empty();
      
      

      $.get('/deletecomment?id='+id, function (response) {

        if (response == 1) {

          console.log('¡Comentario Eliminado!');

        }else{

          console.log(response);
        }
      });


    }

*/

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


  $('.slider-video').on('click',function() {
      var item = $(this).children('a').children('input').val(),
      iframe = $(this).children('a').children('iframe').addClass('my-visible').attr('src', item);
    
      $(this).children('a').children('img').addClass('not-visible');  
      $(this).children('a').children('div').addClass('not-visible');  
  });

  $('.slider-video').each(function(index, item){
      var url = $(item).children('a').children('input').val().split('/')[4].split('?')[0];
      $(item).children('a').children('img').attr('src','//img.youtube.com/vi/'+url+'/0.jpg');
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