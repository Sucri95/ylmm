
$(document).on('click', '.clasificados', function() {

    

    if ($('#removeitems').hasClass('removeitems')) {

        $('#removeitems').removeClass('removeitems');

        $('#artistas_clasificados #removeitems').remove();
    }

        for (var i = 0, len = clasifArtists.length; i < len; i++) {

        	var position = i + 1 ;

        if (clasifArtists[i].id_band != null && clasifArtists[i].id_user == null){

            var link =  clasifArtists[i].url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';
            var name = clasifArtists[i].name_video.split('-');

            for (var j = 0, len = bands_array.length; j < len; j++) {

            	if (bands_array[j].id == clasifArtists[i].id_band) {
            		
            		var profile_pic = bands_array[j].profile_pic;
            	}

            }


            $('#artistas_clasificados').append('<div id="removeitems" class="container-chart removeitems" style="margin-top: 4%;">'+
                '<!-- Chart Section-->'+
                '<div class="section">'+     
                '<!-- Info Section -->'+
                '<div class="info">'+
                    '<span class="chart-position">'+position+'</span>'+
                    '<span class="chart-time">Posición</spant>'+
                '</div>'+
                '<!-- Info Section -->'+
                '<!-- Main Section -->'+
                   '<div class="main">'+
                        '<div class="artist-avatar performance"><img style="height: 100%" src="'+profile_pic+'"></div>'+
                        '<div class="artist-song">'+
                        	'<h2><a href="/bands/comments?id='+clasifArtists[i].id_band+'">'+name[1]+'</a></h2> '+
                            '<h2><a href="/bands/band_comments?idvideo='+clasifArtists[i].id+'&idband='+clasifArtists[i].id_band+'" style="font-size: 10px; color: #01b1e6;">'+name[0]+'</a></h2>'+
                        '</div>'+
                        '<div class="artist-name">'+
                            '<span>Puesto '+position+'</span>'+
                       ' </div>'+
                    '</div>'+
                '<!-- Main Section -->'+
                '<!-- Vote Section -->'+
                '<div class="vote">'+
                    '<div class="artist-vote-description">'+
                        '<h4>Nª VOTOS</h3>'+
                    '</div>'+
                   ' <div class="artist-vote-number">'+
                        '<h4>'+clasifArtists[i].votes+'</h4>'+
                    '</div>'+
                    '<div class="artist-vote-btn">'+
                        '<button onclick="onVote('+clasifArtists[i].id+')">Votá</button>'+
                    '</div>'+
                '</div>'+
                    '<!-- Vote Section -->'+
                '</div>'+
            '</div>');

        }
        if (clasifArtists[i].id_band == null && clasifArtists[i].id_user != null){
            var link =  clasifArtists[i].url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';
            var name = clasifArtists[i].name_video.split('-');
            
            for (var j = 0, len = array_musicians.length; j < len; j++) {

            	if (array_musicians[j].id == clasifArtists[i].id_user) {
            		
            		var wall_id = array_musicians[j].id_user;

            		var profilePic = array_musicians[j].profile_pic;
            	}

            }


            $('#artists_searcher').append('<div id="todelete" class="container-chart removeitems" style="margin-top: 4%;">'+
                '<!-- Chart Section-->'+
                '<div class="section">'+     
                '<!-- Info Section -->'+
                '<div class="info">'+
                    '<span class="chart-position">'+position+'</span>'+
                    '<span class="chart-time">Posición</spant>'+
                '</div>'+
                '<!-- Info Section -->'+
                '<!-- Main Section -->'+
                   '<div class="main">'+
                        '<div class="artist-avatar performance"><img style="height: 100%" src="'+profilePic+'"></div>'+
                        '<div class="artist-song">'+
                            '<h2><a href="/users/wall?id='+wall_id+'">'+name[1]+'</a></h2> '+
                            '<h2><a href="/musician/musician_comments?id='+wall_id+'&idvideo='+clasifArtists[i].id+'&idmusic='+clasifArtists[i].id_user+'" style="font-size: 10px; color: #01b1e6;">'+name[0]+'</a></h2>'+
                        '</div>'+
                        '<div class="artist-name">'+
                            '<span>Puesto '+position+'</span>'+
                       '</div>'+
                    '</div>'+
                '<!-- Main Section -->'+
                '<!-- Vote Section -->'+
                '<div class="vote">'+
                    '<div class="artist-vote-description">'+
                        '<h4>Nª VOTOS</h3>'+
                    '</div>'+
                   ' <div class="artist-vote-number">'+
                        '<h4>'+clasifArtists[i].votes+'</h4>'+
                    '</div>'+
                    '<div class="artist-vote-btn">'+
                        '<button onclick="onVote('+clasifArtists[i].id+')">Votá</button>'+
                    '</div>'+
                '</div>'+
                    '<!-- Vote Section -->'+
                '</div>'+
            '</div>');

        }
     // Return as soon as the object is found
    }

	});

  function onVote(id)
  {
    $.get('/battles/addVote?id='+id, function (response) {
      if (response == 1) {
        console.log('¡Has votado!');
      
      }else{
        console.log(response);
      }
    });
  }


  $(document).on('click', '.artist-vote-btn button', function() {
    var vote = $(this).parent('.artist-vote-btn').prev('.artist-vote-number').children('h4');
    var vote1 = parseInt($(vote).text()) + 1;
        
    $(vote).text(vote1);
    $(this).prop('disabled', true).text('Votaste');
    $(this).css('background', 'gray');

  });

    $(".search-text-input").keyup(function (e) {
        e.preventDefault();
        search_artists();
    });

    $(".search-text-input").focusin(function (e) {
        e.preventDefault();
        search_artists();
    });

    $(".search-text-input").focusout(function(){
      setTimeout(function(){
       $('.search-list ul').empty();
      },400);
   });

    $('.search-text-input').keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });

  function search_artists() {

        var search = $(".search-text-input").val();
        
        $.get('http://www.youlovemymusic.com/battles/search_musicians?performance='+ search, function (data) { 
          var cont = 0;

          $('.search-list ul li').remove();

          $.each(data, function(index, item) {
            cont = 0;
            $.each(item, function(index2, item2) { 
              if (cont < 3) {
              
              var url = ''
                , type = ''
                , name = ''
                , image = ''
                , level = '';


                if (index === 'bands') {


                    
                    url =  'http://www.youlovemymusic.com/bands/comments?id='+item2.id;
                    name = item2.name;
                    image = item2.profile_pic;
                    type = 'banda';

                  $('.search-list ul').append('<li class="lisearch"> <a onclick=" show_results_artists(\''+item2.id+'\',\''+type+'\')"><div class="avatar-area"><div class="image-area" style="background: url('+image+'); background-size: cover;"></div></div><div class="data-area"><h2>'+name+'</h2><p>Banda</p></div></a></li>');

                }

                if (index === 'musicians') {

                    url =  'http://www.youlovemymusic.com/users/wall?id='+item2.id;
                    name = item2.artistic_name;
                    image = item2.profile_pic;
                    type = 'musician';

                  $('.search-list ul').append('<li class="lisearch"> <a onclick=" show_results_artists(\''+item2.id+'\',\''+type+'\')"><div class="avatar-area"><div class="image-area" style="background: url('+image+'); background-size: cover;"></div></div><div class="data-area"><h2>'+name+'</h2><p>Músico</p></div></a></li>');
                }

              cont = cont + 1;
            }
           });
            
          });
        
        
        });
    
    }

function show_results_artists(id,type) {

        $('#artists_searcher .todelete').remove();

        for (var i = 0, len = videos_array.length; i < len; i++) {

            var position = i + 1 ;

        if (videos_array[i].id_band == id && videos_array[i].id_user == null && type == 'banda'){

            var link =  videos_array[i].url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';
            var name = videos_array[i].name_video.split('-');


            $('#artists_searcher').append('<div class="container-chart todelete" style="margin-top: 4%;">'+
                '<!-- Chart Section-->'+
                '<div class="section">'+     
                '<!-- Info Section -->'+
                '<div class="info">'+
                    '<span class="chart-position">'+position+'</span>'+
                    '<span class="chart-time">Posición</spant>'+
                '</div>'+
                '<!-- Info Section -->'+
                '<!-- Main Section -->'+
                   '<div class="main">'+
                        '<div class="artist-avatar performance"><img style="height: 100%" src="'+link+'"></div>'+
                        '<div class="artist-song">'+
                            '<h2><a href="/bands/band_comments?idvideo='+videos_array[i].id+'&idband='+videos_array[i].id_band+'">'+name[0]+'</a></h2>'+
                        '</div>'+
                        '<div class="artist-name">'+
                            '<p><a href="/bands/comments?id='+videos_array[i].id_band+'">'+name[1]+'</a></p> '+
                            '<span>Puesto '+position+'</span>'+
                       ' </div>'+
                    '</div>'+
                '<!-- Main Section -->'+
                '<!-- Vote Section -->'+
                '<div class="vote">'+
                    '<div class="artist-vote-description">'+
                        '<h4>Nª VOTOS</h3>'+
                    '</div>'+
                   ' <div class="artist-vote-number">'+
                        '<h4>'+videos_array[i].votes+'</h4>'+
                    '</div>'+
                    '<div class="artist-vote-btn">'+
                        '<button onclick="onVote('+videos_array[i].id+')">Votá</button>'+
                    '</div>'+
                '</div>'+
                    '<!-- Vote Section -->'+
                '</div>'+
            '</div>');

        }
        if (videos_array[i].id_user == id && videos_array[i].id_band == null && type == 'musician'){
            var link =  videos_array[i].url.split('=').pop();
                link =  '//img.youtube.com/vi/'+link+'/0.jpg';
            var name = videos_array[i].name_video.split('-');
            
            for (var j = 0, len = array_musicians.length; j < len; j++) {

            	if (array_musicians[j].id == videos_array[i].id_user) {
            		
            		var wall_id = array_musicians[j].id_user;
            	}

            }


            $('#artists_searcher').append('<div class="container-chart todelete" style="margin-top: 4%;">'+
                '<!-- Chart Section-->'+
                '<div class="section">'+     
                '<!-- Info Section -->'+
                '<div class="info">'+
                    '<span class="chart-position">'+position+'</span>'+
                    '<span class="chart-time">Posición</spant>'+
                '</div>'+
                '<!-- Info Section -->'+
                '<!-- Main Section -->'+
                   '<div class="main">'+
                        '<div class="artist-avatar performance"><img style="height: 100%" src="'+link+'"></div>'+
                        '<div class="artist-song">'+
                            '<h2><a href="/musician/musician_comments?id='+wall_id+'&idvideo='+videos_array[i].id+'&idmusic='+videos_array[i].id_user+'">'+name[0]+'</a></h2>'+
                        '</div>'+
                        '<div class="artist-name">'+
                        	'<p><a href="/users/wall?id='+wall_id+'">'+name[1]+'</a></p> '+
                            '<span>Puesto '+position+'</span>'+
                       ' </div>'+
                    '</div>'+
                '<!-- Main Section -->'+
                '<!-- Vote Section -->'+
                '<div class="vote">'+
                    '<div class="artist-vote-description">'+
                        '<h4>Nª VOTOS</h3>'+
                    '</div>'+
                   ' <div class="artist-vote-number">'+
                        '<h4>'+videos_array[i].votes+'</h4>'+
                    '</div>'+
                    '<div class="artist-vote-btn">'+
                        '<button onclick="onVote('+videos_array[i].id+')">Votá</button>'+
                    '</div>'+
                '</div>'+
                    '<!-- Vote Section -->'+
                '</div>'+
            '</div>');

        }
     // Return as soon as the object is found
    }
}