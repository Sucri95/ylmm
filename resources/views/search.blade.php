@extends('layouts.layout')

@section('content')
<style type="text/css">
 
  .slider-row3.genero .slick-slide img {
    display: block;
    width: 100%;
    height: 110px;
}

</style>
<div class="container">
</div>
@stop
@section('jsfunctions')

<script type="text/javascript">
 

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
  




</script>

@stop