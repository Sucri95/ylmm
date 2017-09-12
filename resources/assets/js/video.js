$(document).on('change','#videoid', function() {
	id = $('#videoid').val();
	$('.videothumb').empty();
	$('.videothumb').append('<img src="https://img.youtube.com/vi/'+id+'/hqdefault.jpg">');
});

$(document).on('click','#guardarVideo',function(){
	uploadVideo();
});

function uploadVideo(){
	var titulo = $('#titulo').val();
	var vid = $('#videoid').val();
	var bandaid = localstorage.getItem('uid');
	var dataString="bandaid="+id+"&videoid="+vid+"&titulo="+titulo;
    $.ajax({
        type: "POST",
        url:"http://trendersapps.com/ylmm/services/upload_video.php",
        data: dataString,
        crossDomain: true,
        cache: false,
        success: function(data){
        	if(data == 0){
        		alert('video ya existe');
        	}else if(data == 1){
        		alert('el video ha sido guardado');
        		location.reload();
        	}else{
        		alert('Problema de autenticación, por favor intentá nuevamente');
        	}
        }
    });
    return false;
}