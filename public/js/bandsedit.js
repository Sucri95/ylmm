function onDeleteMember(id, id_user)
    {   

    $('#member_'+id_user).empty();   

      $.get('/bands/delete/member?id='+id+'&id_user='+id_user, function (response) {

        if (response == 'Integrante eliminado') {

          console.log('¡Integrante eliminado!');

        }else{

          window.location.href = "http://www.youlovemymusic.com/users/wall?id="+response;

        }
      });


    }


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
