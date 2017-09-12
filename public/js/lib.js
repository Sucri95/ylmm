$(document).ready(function() {
    var OimgTop = 0;
    $('.messages').on('click', function() {
        $(this).css('display', 'none');
    });
    $(document).on('click', 'nav .logo a', function() {
        $('html, body').animate({
            scrollTop: $('html, body').offset().top - 40
        }, 2200);
    });
    $(document).on('click', '.share-overlay.active', function() {
        $(this).removeClass('active');
    });
    $('.share-overlay.active').on('click', function() {
        $(this).removeClass('active');
        $(this).css("cssText", "display: none !important;");
    });
    $(document).on('click', '.overlay.active', function(event) {
        if (!$(event.target).hasClass('input-type-1') && !$(event.target).hasClass('container') && !$(event.target).hasClass('btn-green-1')) {
            $('.overlay').removeClass('active');
        }
    });
    $('.open-notification-menu').on('click', function() {
        $('.modal-notificacion').addClass('active');
    });
    $('.main-menu.mobile.unlogin li').on('click', function() {
        $('.responsive-register').toggleClass('active');
    });
    $('.mobile-submenu').on('click', function() {
        var $both = $('.mobile-submenu, .twitter-widget ul.submenu-menu-mobile');
        ($both.hasClass('active')) ? $both.removeClass('active'): $both.addClass('active');
    });
    $('.mobile-right-menu .search, .btn-cancel').on('click', function() {
        $('.modal-search').toggleClass('active');
        $('#input-buscador-mobile').val('');
    });
    $('#input-buscador, #input-buscador-mobile').on('click', function() {
        $('.buscador').css('display', 'block');
    });
    $(document).on('click', '.share-band', function() {
        $('.share-overlay').toggleClass('active');
    });
    $(document).on('click', '.close-share', function() {
        $('.share-overlay').remove('active');
    });
    $('.band-name-type-1').on('click', function() {
        var permission = $('#id_confirmation').val();
        if (permission === 'YES') {
            $('#name_edit').addClass('active');
            $('.band-name-type-1').addClass('hidden');
        }
    });
    $('#name_edit .btn-white-2').on('click', function() {
        $('#name_edit').removeClass('active');
        $('.band-name-type-1').removeClass('hidden');
    });
    $('.modal-notificacion, .open-notification-menu, .modal-search').on('click', function(event) {
        (!$(event.target).is("input")) ? $(this).toggleClass('active'): void(0);
    });
    $('video').on('click', function() {
        this.pause();
        $(this).prev('.overlay-icon-play').css('display', 'block');
    });
    $('.overlay-icon-play').on('click', function() {
        var video = $(this).next('video').attr('id');
        video = document.getElementById(video);
        video.play();
        $(this).css('display', 'none');
    });
    $(document).on('click', '.container-follow', function() {
        ($(this).hasClass('active')) ? $(this).removeClass('active'): $(this).addClass('active');
    });
    $(document).on('click', 'body', function(event) {
        if ($(event.target).hasClass('fa-bars') || $(event.target).hasClass('open-right-menu')) {
            ($('.mobile-right-menu').hasClass('active')) ? $('.mobile-right-menu').removeClass('active'): $('.mobile-right-menu').addClass('active');
        } else {
            $('.mobile-right-menu').removeClass('active')
        }
    });
    $(document).on('click', '.btn-finalizar', function(e) {
        e.preventDefault();
        var texto = $('#about').val();
        if (texto != '') {
            $('form').submit();
        }
    });
    $(document).on('click', '.btn-setabout', function(e) {
        e.preventDefault();
        var texto = $('#setabout').val();
        if (texto != '') {
            $('#about-set').submit();
        }
    });
    if ($('#image-1').length > 0) {
        OimgTop = $('#image-1').css('top').replace('px', '');
    }
    var scrolltrue = 0

    function init() {
        var wWidth = $(window).width(),
            slickImg = $('.slider-video a img'),
            slickVideo = $('.slider-video a iframe');
        if ($("section.home-section-3").length && $('.nav-logeado').length) {
            setTimeout(function() {
                if (scrolltrue == 0) {
                    $('html, body').animate({
                        scrollTop: $("section.home-section-3").offset().top - 40
                    }, 2200);
                    scrolltrue = 1;
                }
            }, 600);
        }
        if ($('#image-1').length > 0) {
            var imgWidth = $('#image-1').attr('data-type');
            var imgNewTop = (wWidth * OimgTop) / imgWidth;
            $('#image-1').css('top', imgNewTop + 'px');
        }
        setTimeout(changeIframeSize, 2000);
    }

    function changeIframeSize() {
        var slickImg = $('.slider-video a img'),
            slickVideo = $('.slider-video a iframe');
        if (slickImg.length > 0 && slickImg.height() > 0) {
            slickVideo.height(slickImg.height());
        } else {
            if (slickImg.length > 0) {
                changeIframeSize();
            }
        }
    }
    init();
    $(window).resize(function() {
        init();
    });
});
$(document).on('click', '.btn-sosfan, .container-follow', function() {
    var likes = $('#count-followers');
    var countlikes = $('#count-followers').text();
    countlikes = countlikes.split(':');
    like = countlikes[1];
    var num = parseInt(like);
    ($(this).hasClass('active')) ? likes.text('FOLLOWERS: ' + (num + 1)): likes.text('FOLLOWERS: ' + (num - 1));
});

function addfollower(iduser) {
    $.get('/addfollower?iduser=' + iduser, function(response) {
        if (response == 1) {
            $('.btn-green.dark.my-right.btn-sosfan').on('click', function() {
                $(this).addClass('active').text('UNFOLLOW');
            });
            console.log('¡SOS FAN!');
        } else {
            $('.btn-green.dark.my-right.btn-sosfan').on('click', function() {
                $(this).removeClass('active').text('FOLLOW');
            });
            console.log('YA NO SOS FAN');
        }
    })
}

function onDelete(id) {
    $.get('/deletecomment?id=' + id, function(response) {
        if (response == 1) {
            var counter = $('.response_id_' + id).parent('ul').parent('.list-comment.active').prev('.tool-bar').children('span');
            var num = parseInt(counter.text().split(': ').pop()) - 1;
            counter.text('Respuestas: ' + num);
            $('li.response_id_' + id).addClass('hidden');
            $('#history-list-' + id).addClass('hidden');
            $('#replay-area_' + id).addClass('hidden');
            $('li.response_id_' + id).siblings('.comment-post-area').removeClass('hidde');
            var numComment = parseInt($('.video-comment-content .header h2').text().split(' ').pop()) - 1;
            $('.video-comment-content .header h2').empty().append('<b>Comentarios </b>' + numComment);
            console.log('¡Comentario Eliminado!');
        } else {
            console.log(response);
        }
    });
}
$('.btn-edit-role').on('click', function() {
    $(this).children('.dropdown-edit').toggleClass('active');
});
$(document).on('click', '.open-notification-menu', function() {
    setTimeout(function() {
        $.get('/notifications/seen', function(response) {
            if (response == 'done') {
                console.log('done');
            } else {
                console.log('error');
            }
        });
    }, 400);
});