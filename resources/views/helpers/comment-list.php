  <style type="text/css">

    div.area-comment {
    width: 100%; 
    height: 2em;
  }

  ul.comment {
    width: auto;
      float: right;
    margin-right: 1em;
      display: inline-flex;
      list-style-type: none;
    text-decoration: none;
    }

  ul.comment li:not(:last-child) {
    padding-right: 0.5em;
  }
  ul.comment li:not(:first-child) {
    padding-left: 0.5em;
    border-left: 1px solid #84847f;
  }

  ul.comment li a {
    color: black;
    text-decoration: none;
  }

  ul.comment li a:hover {
    color: #68bd45;
    transition: 1s;
  }


  .submit_btn.image{
    border: none;
      color: black;
      cursor: pointer;
      font-size: 16px;
      letter-spacing: 1px;
      background: #68bd45;
      font-weight: bold;
      text-transform: uppercase;
      padding: 0.4em 1em 0.4em 1em;
      width: 100%;
      position: relative;
      float: none;
      margin: 0 auto;
  }

  .coments-container .create-coment  textarea{
    height: 6em!important;
  }

  .coments-container .coment-list .coment-post{
    height: auto!important;
  }


  .coments-container .create-coment{
    height: 8em;
  }

  input[type="file"] {
    display: none;
  } 

  .overlay,
  .overlay-img {
    width: 100%;
      height: 100%;
      position: fixed;
      display: none;
      background: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      margin-top: -3em;
  }

  .overlay .container,
  .overlay-img .container {
    top: 50%;
      left: 50%;
      width: 30em;
      height: auto;
      padding: 2em 2em 1em 2em;
      position: relative;
      background: white;
      transform: translate(-50%,-50%);
  }

  .overlay.active,
  .overlay-img.active {
    display: block!important;
  }

  body > div.overlay.active > div > h4{
    margin-bottom: 1em;
  }
 
.like-band {
    top: 1.7em!important;
    width: 1.5em!important;
    height: 1.7em!important;
    cursor: pointer!important;
    position: absolute!important;
    background: url(../../images/resources/like_off.png)no-repeat!important;
    background-size: 100% 100%!important;
    margin-top: 0.5em!important;
}
.like-band.active {
    background: url(../../images/resources/like_on.png)no-repeat!important;
    background-size: 100% 100%!important;
}

.share-band {
    top: 1.7em!important;
    width: 1.5em!important;
    height: 1.5em!important;
    cursor: pointer!important;
    position: absolute!important;
    background: url(../../images/share.png)no-repeat!important;
    background-size: 100% 100%!important;
    margin-left: 3em!important;
    margin-top: 0.7em!important;
}

  .overlay .container,
  .overlay-img .container {
    position: relative;
  }

  .overlay .container .close,
  .overlay-img .container .close {
      
      top: 5px;
      right: 5px;
      width: 30px;
      height: 30px;
      color: gray;
      padding-top: 5px;
      font-size: 16px;
      text-align: center;
      position: absolute;
      cursor: pointer;
      background: url(../../images/close.png)no-repeat;
      background-size: cover;
  }

  .img-container{
    width: 100%;
    height: 100%;
    max-height: 15em;
    border: 1px solid #ebebe7;
    padding: 1em;
    overflow-y: scroll;
    display: none;
  } 

  .img-container img {
    float: left;
    margin: 10px;
  }

  .submit_btn{
      right: 0;
      bottom: 0;
      float: right;
      border: none;
      color: black;
      cursor: pointer;
      font-size: 16px;
      letter-spacing: 1px;
      background: #68bd45;
      font-weight: bold;
      position: absolute;
      text-transform: uppercase;
      padding: 0.4em 1em 0.4em 1em;
  
  }

  body > div.coments-container.my-center > div > div > div.post-data > div.slider-video > a > img{
    width: 480px!important;
    height: 360px!important;
    opacity: 0.5;
  }

  body > div.coments-container.my-center > div > div > div.post-data > div.slider-video > a > img.icon-play{
    width: 80px;
    height: 80px;
    background: url(../../images/play1.png)no-repeat;
    background-size: cover;
    position: absolute;
    left: 23%;
    top: 38%;
  }

  iframe{
    width: 480px;
    height: 360px;
      
  } 

  div.upload-more {
    width: 10em;
    height: 10em;
    float: left;
    margin: 10px;
    cursor: pointer;
    background: white;
    position: relative;
    border: 6px #ebebe7 dotted;
  }

  div.upload-more .icon-plus {
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    background: url(../../images/plus-icon.png) no-repeat;
    background-size: cover;
    position: absolute;
    transform: translate(-50%,-50%);
  }

  .icon-play{
    top: 50%;
    left: 49%;
    width: 80px;
    height: 80px;
    background: url(../../images/play1.png)no-repeat;
    background-size: cover;
    position: absolute;
    transform: translate(-50%, -50%);
  }

  .legend{
    
    font-size: 8px; 
    font-size: 9px; 
    margin-top: 6px; 
    margin-bottom: 26px; 
    letter-spacing: 1px; 
    line-height: 14px;
  }

  body > div.coments-container.my-center > div:nth-child(6) > div > div.post-data > div.slider-video > a > iframe,
  body > div.coments-container.my-center > div:nth-child(6) > div > div.post-data > div.slider-video > a > img,
  body > div.coments-container.my-center > div:nth-child(4) > div > div.post-data > img{

    width: 480px;
    height: 377px;
    margin-top: 3em

  }

 #respuesta2 > div,
 #respuestacomentario > div{
  margin-top: 4em;
    margin-left: 4.5em;

  }
#respuesta2 > div > textarea,
#respuestacomentario > div > textarea{
  width: 67em;
}
#respuesta2 > div > button,
#respuestacomentario > div > button{
  left: 59.5em;
}

.addthis_inline_share_toolbox.active{
  display: block;
  margin-left: 11em!important;
}
.addthis_inline_share_toolbox{
  display: none;
  margin-left: 11em!important;
}

.avatar-area{

  height: auto!important;
    margin-right: 1em!important;

}
body > div.coments-container.my-center > div > div > div.post-data{
  height: auto!important;
    width: auto!important;
}

#\31 01_1{
  margin-left: 6em;
}

.iframecontaner{
    width: 480;
    height: 360;
    position: relative;
    margin-left: 5em;
}

.overlay-icon-play {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.5);
  position: absolute;
}
.boton{
    bottom: -3px;
    width: 1em;
    height: 1em;
    color: #68bd45;
    cursor: pointer;
    position: absolute;
    text-align: center;
    background: url(../../images/arrow-bottom.png)no-repeat;
    background-size: cover;
    transform: translate(-50%,-50%);
    padding-top: 0.3em;
    right: 0;
}

.dropdown-options{

    right: 3px;
    top: 17px;
    display: none;
    list-style-type: none;
    padding: 0 4px;
    border: 1px solid #dedede;
    width: 92px;
    height: 58px;
    z-index: 9999;
    text-align: left;
    margin: 0em 0 0 1em;
    position: absolute;
    box-shadow: 1px 1px 1px 1px #ebebe7;
}

.dropdown-options.active{
  display: block;
}


.dropdown-options li{
  text-align: left;
  padding-top: 2px;
  padding-left: 6px;

}
.dropdown-options li:not(:last-child){
  border-bottom: 1px solid #ebebe7;
}

.dropdown-options li:hover a {
  color: #6ac146;
}

.dropdown-options li a{
  color: black;
  text-decoration: none;
  line-height: 25px;
  font-size: 12px;
}

.options{

  position: relative;
}

.edit-comment {
  display: none;
}

.edit-comment.active {
  display: block;
}

.hidde {
  display: none;
}

</style>

<form id="validateSubmitForm" action="<?php action('CommentController@commentband') ?>" method="post">
      <input type="hidden" name="_token" value="<?php echo csrf_token()  ?>">
      <input type="hidden" name="id_band" value="<?php echo $banda->id  ?>">
      <input type="hidden" name="id_user" value="<?php echo Auth::user()->id  ?>">
      <div class="area-comment">
        <ul class="comment">
          <li><a href="javascript:;">IMAGEN</a></li>
          <li><a href="javascript:;">VIDEO</a></li>
        </ul>
      </div>
      <div class="create-coment"  style="margin-top: 0!important;">
        <img src="<?php echo Auth::user()->profile_pic ?>">
        <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
        <button class="submit_btn" type="submit">publicar</button>
      </div>
  </form>

<?php $showedalbums = []; ?>

  <?php foreach($comments as $comment){ ?>

    <?php $usuario = DB::table('users')
                    ->where('id', $comment->id_user)
                    ->first();
          
          $response = DB::table('comments')
            ->where('id_band', $banda->id)
            ->where('id_comment', $comment->id)
            ->orderBy('created_at', 'asc')
            ->get(); ?>

      <div class="coment-list">
        <div class="coment-post" id="coment-post-<?php echo $comment->id ?>">      
          <div class="avatar-area">
            <img src="<?php echo $usuario->profile_pic ?>">
          </div>

          <div class="post-data">

            <?php if ($comment->type == 'com') { ?>

            <p>
              <span><?php echo $usuario->name ?>:  </span><span class="commentario" style="color: black; margin-left: 1em; position: relative;"><?php echo  $comment->comment  ?>
              </span>
            </p>
                  <div class="boton btn-dropdown">
                    <div class="options">
                      <ul class="dropdown-options">
                        <li><a href="javascript:;" onclick="onEdit(<?php echo $comment->id ?>)">Editar...</a></li>
                        <li><a href="javascript:;" onclick="onDelete(<?php echo $comment->id ?>)">Eliminar...</a></li>
                      </ul>
                    </div>
                  </div>

            <div class="footer-post">
              <?php if ($comment->like == 0){ ?>
                <i class="like-band" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
              <?php }else{ ?>
                <i class="like-band active" href="" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
              <?php } ?>
                <i class="share-band compartir" href="javascript:;"> </i>
                <div class="addthis_inline_share_toolbox"></div>
            </div>
               
            
            <?php }if ($comment->type == 'pic') { ?>

                <p style="margin-bottom: 3em!important;"><span><?php echo $usuario->name ?>:    </span>
                  <?php if(!is_null($comment->title)){ ?>
                    <strong><?php echo $comment->title ?></strong>
                  <?php } ?>
                </p>
                <img src="<?php echo $comment->comment ?>" style="width: auto; height: 360px; margin-left: 5em;">

                  <div class="boton btn-dropdown">
                    <div class="options">
                      <ul class="dropdown-options">
                        <li><a href="javascript:;" onclick="onEdit(<?php echo $comment->id ?>)">Editar...</a></li>
                        <li><a href="javascript:;" onclick="onDelete(<?php echo $comment->id ?>)">Eliminar...</a></li>
                      </ul>
                    </div>
                  </div>

              <div class="footer-post">
                <?php if ($comment->like == 0){ ?>
                  <i class="like-band" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
                <?php }else{ ?>
                  <i class="like-band active" href="" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
                <?php } ?>
                  <i class="share-band compartir" href="javascript:;"> </i>
                  <div class="addthis_inline_share_toolbox"></div>
              </div>

            <?php }if ($comment->type == 'video') { ?>

                <p style="margin-bottom: 3em!important;"><span><?php echo $usuario->name ?>:    </span></p>
                  <div class="slider-video">
                    <a href="javascript:;">
                      <div class="iframecontaner ">
                        <img src="">
                          <div class="overlay-icon-play">
                              <div class="icon-play"></div>
                          </div>
                      </div>
                
                      <?php $query = explode('=', $comment->comment); ?>
                        <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/<?php echo $query[1] ?>?autoplay=1">
                        <iframe src="" frameborder="0" allowfullscreen style="margin-left: 5em;"></iframe>
                    </a>
                  </div>

                  <div class="boton btn-dropdown">
                    <div class="options">
                      <ul class="dropdown-options">
                        <li><a href="javascript:;" onclick="onEdit(<?php echo $comment->id ?>)">Editar...</a></li>
                        <li><a href="javascript:;" onclick="onDelete(<?php echo $comment->id ?>)">Eliminar...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="footer-post">
                    <?php if ($comment->like == 0){ ?>
                      <i class="like-band" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
                    <?php }else{ ?>
                      <i class="like-band active" href="" onclick="onLike(<?php echo $comment->id ?>)" style="margin-left: 6em;"> </i>
                    <?php } ?>
                      <i class="share-band compartir" href="javascript:;"> </i>
                      <div class="addthis_inline_share_toolbox"></div>
                  </div>

              <?php } if ($comment->type == 'album' && !in_array($comment->id_album, $showedalbums)) {
                      
                  $showedalbums[] = array_push($showedalbums, $comment->id_album);
                
                  $pictures = DB::table('comments')
                        ->where('id_album', $comment->id_album)
                        ->where('type', 'album')
                        ->get(); 
                      
                      $album = DB::table('albums')
                        ->where('id_band', $comment->id_band)
                        ->where('id', $comment->id_album)
                        ->first();
                      
                      $picId = DB::table('comments')
                              ->where('id_album', $comment->id_album)
                              ->where('type', 'album')
                              ->first();
                      
                      $count = count($pictures);
                      $i=0;

                    ?>
                     <div class="boton btn-dropdown">
                      <div class="options">
                        <ul class="dropdown-options">
                          <li><a href="javascript:;" onclick="onEdit(<?php echo $picId->id ?>)">Editar...</a></li>
                          <li><a href="javascript:;" onclick="onDelete(<?php echo $picId->id ?>)">Eliminar...</a></li>
                        </ul>
                      </div>
                    </div>
                
                <p style="margin-bottom: 3em!important;"><span><?php echo $usuario->name ?>:   </span>

                  <?php if(!is_null($album->name)){ ?>

                    <strong><?php echo $album->name ?></strong>

                  <?php } ?>

                </p>

                <br>

                  <?php foreach($pictures as $pic){ ?>
                    <img src="<?php echo $pic->comment ?>" id="<?php echo $pic->id ?>" style="height: 240px; width: auto; ">
                  }
                  <?php } ?>

                  <div class="footer-post">
                    <?php if ($picId->like == 0){ ?>
                      <i class="like-band" onclick="onLike(<?php echo $picId->id ?>)" style="margin-left: 6em;"> </i>
                    <?php }else{ ?>
                      <i class="like-band active" href="" onclick="onLike(<?php echo $picId->id ?>)" style="margin-left: 6em;"> </i>
                    <?php } ?>
                      <i class="share-band compartir" href="javascript:;"> </i>
                      <div class="addthis_inline_share_toolbox"></div>
                  </div> 


              <?php } ?>
          </div>
        </div>

        <form class="edit-comment hidden" action="<?php action('CommentController@editComment') ?>" method="post">
            <input type="hidden" name="_token" value="<?php echo  csrf_token()  ?>">
            <input type="hidden" name="id_comment" value="<?php echo  $comment->id  ?>">
            <input type="hidden" name="id_comment" id="id_comment_<?php echo $comment->id ?>" value="<?php echo $comment->id ?>">

            <div class="create-coment">
                <img src="<?php echo Auth::user()->profile_pic ?>">
                <textarea class="user-post-area"  id="edit_comment" name="edit_comment" placeholder="<?php echo $comment->comment ?>"></textarea>
                <button class="submit_btn" type="submit">editar</button>
            </div>
        </form>
      </div>
      
      <?php if (count($response) > 0){ ?>
        <?php foreach($response as $res){ ?>
          <?php $resuser = DB::table('users')->where('id', $res->id_user)->first();?>
            <div class="coment-list"  style="margin-left: 4em; margin-top: 4em;">
              <div class="coment-post" id="coment-post-<?php echo $comment->id ?>" style="margin-left: 0.5em;">
                <div class="avatar-area">
                  <img src="<?php echo $resuser->profile_pic ?>">
                </div>
              
                <div class="post-data">

                  <p>
                  <span><?php echo  $resuser->name ?>:  </span>     
                  <span class="commentario" style="color: black; margin-left: 1em; position: relative;">

                    <?php echo  $res->comment  ?>

                    <?php if ($resuser->id == Auth::user()->id) { ?>

                    <div class="boton btn-dropdown" style="right: 4em!important;">
                      <div class="options">
                        <ul class="dropdown-options">
                          <li><a href="javascript:;" onclick="onEditResponse(<?php echo $res->id ?>)">Editar...</a></li>
                          <li><a href="javascript:;" onclick="onDelete(<?php echo $res->id ?>)">Eliminar...</a></li>
                        </ul>
                      </div>
                    </div>

                    <?php } ?>

                  </span>
                  </p>
                    <div class="footer-post">
                      <?php if ($res->like == 0){ ?>
                        <i class="like-band" href="" onclick="onLike(<?php echo $res->id ?>)" > </i>
                      <?php }else{ ?>
                        <i class="like-band active" href="" onclick="onLike(<?php echo $res->id ?>)" > </i>
                      <?php } ?>
                         <i class="share-band compartir" href="javascript:;"> </i>
                         <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>
              </div>

                <form class="edit-response hidden" id="editresponse" action="<?php action('CommentController@editComment') ?>" method="post">
                  <input type="hidden" name="_token" value="<?php echo  csrf_token()  ?>">
                  <input type="hidden" name="id_comment" value="<?php echo  $res->id  ?>">
                  <input type="hidden" name="id_comment" id="id_comment_<?php echo $res->id ?>" value="<?php echo $res->id ?>">

                  <div class="create-coment">
                      <img src="<?php echo Auth::user()->profile_pic ?>">
                      <textarea class="user-post-area"  id="edit_comment" name="edit_comment" placeholder="<?php echo $res->comment ?>"></textarea>
                      <button class="submit_btn" type="submit">editar</button>
                  </div>
              </form>
            </div>

          <?php } ?>

          <form id="respuesta2_<?php echo $comment->id ?>" onsubmit="event.preventDefault(); formsubmit(this);" action="<?php action('CommentController@commentband') ?>"  method="post">
            <input type="hidden" name="_token" value="<?php echo  csrf_token()  ?>">
            <input type="hidden" name="id_band" value="<?php echo  $banda->id  ?>">
            <input type="hidden" name="id_user" value="<?php echo  Auth::user()->id  ?>">
             <input type="hidden" name="id_comment" id="id_comment_<?php echo $comment->id ?>" value="<?php echo $comment->id ?>">
              
            <div class="create-coment">
              <img src="<?php echo Auth::user()->profile_pic ?>">
              <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
            </div>
            <button type="submit" style="float: right;">publicar</button>
          </form>

        <?php }else{ ?>

          <form id="respuestacomentario_<?php echo $comment->id ?>" onsubmit="event.preventDefault(); formsubmit(this);" action="<?php action('CommentController@commentband') ?>"  method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token()  ?>">
            <input type="hidden" name="id_band" value="<?php echo $banda->id  ?>">
            <input type="hidden" name="id_user" value="<?php echo Auth::user()->id  ?>">
            <input type="hidden" name="id_comment" id="id_comment_<?php echo $comment->id ?>" value="<?php echo $comment->id ?>">
            
            <div class="create-coment">
              <img src="<?php echo Auth::user()->profile_pic ?>">
              <textarea class="user-post-area" name="comment" placeholder="Escribir comentario..."></textarea>
              <button class="submit_btn" type="submit">publicar</button>
            </div>

          </form>

        <?php } ?>

  <?php } ?>

  </div>