<style type="text/css">
  
  nav .items,
  footer {
    display: none;
  }


  @media(max-width: 650px) {
    .super-container {
        min-height: 48em!important;
    }
  
  }

  
</style>


@extends('layouts.layout')

@section('content')





  <div class="super-container bg-photo-2" style="margin-bottom: 0;">  
    <!-- Opacidad -->
    <div class="black-overlay"></div>
    <!-- Opacidad -->
    
    <div class="container-register" style="width: 1250px;">
      
        <h3>Actualizá tus datos</h3>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" id="type" name="type" value="">
              
              <section class="home-section-1" style="background: none;">
                <ul class="my-inline">
                  <li>
                    <a class="fan" href="/fansregistration">
                      <img src="../../images/resources/fan-icon.png">
                    </a>
                      <h1 style="color: #fff;"><b>¿SOS FAN?</b></h1>
                      <p style="color: #fff;"><b>Descubrí</b> nueva música. <b>Encontrá</b> y seguí a las <br> bandas que te interesen. <b>Votá</b> por ellos y <br> ayudalos a convertirse en una gran banda.</p>
                  </li>
                  <li>
                    <a class="musico" href="/musicianregistration">
                      <img src="../../images/resources/musico-icon.png">
                    </a>
                      <h1 style="color: #fff;"><b>¿SOS MÚSICO?</b></h1>
                      <p style="color: #fff;"><b>Creá</b> tu página de banda. Podés <b>compartir tu <br> música, interactuar</b> con tus fans y participar por el<br> <b>gran premio</b> de You Love My Music.</p>
                  </li>
                </ul>
              </section>
      </div>

    </div>
  </div>


@stop
@section('jsfunctions')

@stop