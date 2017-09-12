$(document).ready(function(){


var auxArroba = 0,
    input = $('.input-text'),
    linkUser = $('.linkUser');

    var $textArea = $('textarea');

/* ------------------------------------------------------- */

function setCaret(hrefId) {
    var el = hrefId;
    var range = document.createRange();
    var sel = window.getSelection();
    range.setStart(el.childNodes[0], 1);
    range.collapse(true);
    sel.removeAllRanges();
    sel.addRange(range);
    el.focus();
}

/* ------------------------------------------------------- */

$(document).on('click', '.li-font', function() {

    var aux = ''
    ,   aux2 = ''
    ,   userArray = $('#userArray');

    checkArroba = 0;
    $this = "@"+$(this).text().trim();

    $("#user-" + auxArroba).text($this);

    $thisId = $(this).attr('id');

    var user = $('#user-' + auxArroba);
    var url = 'http://www.youlovemymusic.com/users/wall?id=' + $thisId + '';
    var $auxtextArea = $textArea.val();
    var $auxtextInput = userArray.val();

    user.attr('href', url);

    ($auxtextInput === '') ? 
    	$auxtextInput = $thisId : 
    	$auxtextInput = $auxtextInput + ',' + $thisId;
    

    auxArroba = auxArroba + 1;
    userArray.val($auxtextInput);


    $(this).parents('ul').parents('.contactList').removeClass('active');

});

 
/* ------------------------------------------------------- */

$(document).on('keyup', '.input-text', function(evt) {

    var $myInput = $(this);

    $('.text-area.responses').css('position', 'relative');
   
    var $this = $myInput.html();
    var user = $('#user-' + auxArroba);
    var findArroba = $this[$this.length - 1];

    var padre = $myInput.parents('.post-area');
 	padre.children('.contactList').remove();
    
    var appendList = '<div class="contactList active"><ul class="full-width to-left"></ul></div>';
    padre.append(appendList);
    

    if (findArroba === '@') {

        var elm = $this.slice(0, -1);
        var link = '<a class="taged" id="user-' + auxArroba + '" href="">@&nbsp;</a>';

        $myInput.html(elm + link);

        var hrefId = document.getElementById("user-" + auxArroba);

        hrefId.focus();
        setCaret(hrefId);
    }


    if (user.length > 0) {

        var result = user.html().slice(1, -1)
        tagsService(result);


    }

});

/* ------------------------------------------------------- */

function tagsService(search) {

    $.get('http://www.youlovemymusic.com/search?search=' + search, function(data) {
        var cont = 0;
        $('.contactList ul li').remove();
        $.each(data, function(index, item) {
            $.each(item, function(index2, item2) {
                if (cont <= 4) {
                    var url = '',
                        type = '',
                        name = '',
                        image = '',
                        level = '';

                    if (index === 'user') {

                        type = 'User';
                        img = item2.profile_pic;
                        name = item2.name;
                        level = item2.user_level;

                        console.log(item2.id);

                        if (level === '3' || level === '5') {

                            url = 'http://www.youlovemymusic.com/users/wall?id=' + item2.id + '';

                            $('.contactList ul').append(
                                '<li class="to-left full-width li-font" id="' + item2.id + '">' +
                                '<div class="image img-rounded to-left search-image" style="background: url(' + img + '); background-size: cover;">' +
                                '</div>' +
                                '<div class="info-area to-left search-info-div">' +
                                '<h2>' + name + '</h2>' +
                                '</div>' +
                                '</li>'
                            );

                        } else {

                            url = 'http://www.youlovemymusic.com/users/wall?id=' + item2.id + '';

                            $('.contactList ul').append(
                                '<li class="to-left full-width li-font" id="' + item2.id + '">' +
                                '<div class="image img-rounded to-left search-image" style="background: url(' + img + '); background-size: cover;">' +
                                '</div>' +
                                '<div class="info-area to-left search-info-div">' +
                                '<h2>' + name + '</h2>' +
                                '</div>' +
                                '</li>'
                            );

                        }

                    }
                    cont = cont + 1;
                }
            });

        });

    });
}





});