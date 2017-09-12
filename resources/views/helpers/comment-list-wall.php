  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <style type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css"></style>

<style type="text/css">
    
    *, 
    html,
    body {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      list-style-type: none;
      outline: none;
    /*   */
    }

    .wall-container {
      width: 100%;
      height: 100%;
      float: left;
      padding-top: 2em;
       
      background: #dedede;
    }

    .wall-inner-container {
      width: 1020px;
      float: none;
      margin: auto;
      min-height: 20em;
      position: relative;
    }

    .wall-inner-container .post-area{
      width: 59%;
      height: auto;
      float: left;
      padding: 1em;
      background: white;
      box-shadow: 2px 1px 2px 0px #9c9c9c;
    }

    .wall-inner-container .post-area .header-area ul{
      float: right;
      display: inline-flex;
    }
    
    .wall-inner-container .post-area .header-area ul li{
      padding: 0 .5em;
      cursor: pointer;
    }


    .wall-inner-container .post-area .header-area ul li:first-child {
      border-right: 1px solid;
    } 

    .list-post-area,
    .wall-inner-container .post-area .comment-area {
      width: 100%;
      height: auto;
       
      float: left;
      margin-top: 1em;
      padding: 0.5em;
      position: relative;
    }



    .list-post-area .header-post .image-area,
    .wall-inner-container .post-area .comment-area .image-area{
      float: left;
      width: 62px;
      height: 62px;
       
    }

    .wall-inner-container .post-area .comment-area .input-area {
      width: 464px;
      height: 62px;
      float: right;
       
    }

    .wall-inner-container .post-area .comment-area .input-area textarea{ 
      width: 100%;
      height: 100%;
    }

    .wall-inner-container .post-area .comment-area .button-area {
      width: 100%;
      height: auto;
       
      float: right;
      padding: 0.5em 0;
    }

    .wall-inner-container .post-area .comment-area .button-area button {
      float: right;
      color: black;
      border: none;
      padding: 1em;
      cursor: pointer;
      background: #68bd45;
    }


    .list-post-area .header-post{
      width: 100%;
      height: auto;
      float: left;
       
      position: relative;
    }

    .list-post-area .header-post .user-info {
      width: 86%;
      float: left;
      height: 62px;
      padding: 0.5em;
    }

    .list-post-area .header-post .media-post,
    .list-post-area .header-post .text-post {
      width: 100%;
      float: left;
      height: auto;
      padding: 0.5em;
      margin-top: 1em;
    }

    .list-post-area .header-post .comments-options {
      top: 0px;
      right: 0px;
      width: 15px;
      height: 15px;
      cursor: pointer;
       
      position: absolute;
      background: url('../../images/arrow-bottom.png');
      background-size: cover;
    }

    .list-post-area .header-post .comments-options ul{
      top: 15px;
      right: 0;
        width: auto;
        min-width: 8em;
        position: absolute;
        padding: 1em 0em;
        background: white;
        display: none;
      box-shadow: 1px 1px 1px 1px #ebebe7;
    }

    .list-post-area .header-post .comments-options.active ul{
      display: block;
    }

    .list-post-area .header-post .comments-options ul li{
      padding: 0.5em 0;
      text-align: center;
      cursor: pointer;
    }

    .list-post-area .header-post .comments-options ul li:hover {
      background: #ebebe7;
    }

    .list-post-area .header-post .comments-options ul li:not(:last-child){
      border-bottom: 1px solid #ebebe7;
    }

    .list-post-area .header-post .media-post {

    }

    .list-post-area .header-post .media-post .media-post-content {
      width: 480px;
      height: 360px;
      float: none;
      margin: auto; 
    }

    .list-post-area .header-post .media-post .media-post-content ul.multi-image{
      width: 100%;
      height: auto;
      float: left;
    }
    
    .list-post-area .header-post .media-post .media-post-content ul.multi-image li{
      width: 50%;
      height: 180px;
      float: left;
      cursor: pointer;
    }

    .list-post-area .header-post .media-post .media-post-content ul.multi-image li .more{
      width: 100%;
      height: 180px;
      cursor: pointer;
      text-align: center;
      background: rgba(0,0,0,0.5);
      position: relative;

    }
    .list-post-area .header-post .media-post .media-post-content ul.multi-image li .more p{
      top: 50%;
      left: 50%;
      color: white;
      font-size: 40px;
      transform: translate(-50%,-50%);
      position: absolute;
    } 

    .list-post-area .header-post .text-post .text-post-toolbar,
    .list-post-area .header-post .media-post .media-post-toolbar  {
      width: 100%;
      height: 30px;
      margin-top: 0.5em;
    }

    .list-post-area .header-post .text-post .text-post-toolbar ul,
    .list-post-area .header-post .media-post .media-post-toolbar ul{
      float: right;
    }

    .list-post-area .header-post .text-post .text-post-toolbar ul li,
    .list-post-area .header-post .media-post .media-post-toolbar ul li{
      width: 30px;
      height: 30px;
      float: right;
       
      cursor: pointer;
    }

    .list-post-area .header-post .text-post .text-post-toolbar  ul li:not(:last-child),
    .list-post-area .header-post .media-post .media-post-toolbar ul li:not(:last-child) {
      margin-left: 0.5em;
    }
    
    /* --------------------------------------------------------------------------------- */
    
    .wall-inner-container .video-area{
      width: 40%;
      height: auto;
      float: right;
      padding: 1em;
      max-height: 44em;
      overflow: hidden;
      background: white;
      box-shadow: 2px 1px 2px 0px #9c9c9c;
    }

    .wall-inner-container .video-area .header{
      width: 100%;
      height: 20px;
       
      text-align: center;
    }

    .wall-inner-container .video-area .video-container {
      width: 100%;
      height: auto;
      padding: 0 3em;
      margin-top: 1em;
      min-height: 10em;
       
      overflow: hidden;
    }


    /* -------------------------------------------------------------------------------- */

    .swiper-container {
          width: 100%;
          height: 100%;
          margin-left: auto;
          margin-right: auto;
      }
      .swiper-slide {
        height: 256px!important;
          text-align: center;
          font-size: 18px;
          background: #fff;
           
          /* Center slide text vertically */
          display: -webkit-box;
          display: -ms-flexbox;
          display: -webkit-flex;
          display: flex;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          -webkit-justify-content: center;
          justify-content: center;
          -webkit-box-align: center;
          -ms-flex-align: center;
          -webkit-align-items: center;
          align-items: center;
        position: relative;
      }

      .thumb-video {
        top: 0;
        width: 100%;
        height: 100%;
        max-height: 23em;
        position: absolute;
      }

      .thumb-video-area {
        width: 100%;
        height:  201px;
        float: left;
      }
      .thumb-toolbar-area {
        width: 100%;
        height: 50px;
        float: left;
        margin-top: 0.6em
      }

      .thumb-toolbar-area .video-info {
        width: 200px;
        height: 100%;
        float: left;
        text-align: left;
        padding: 0.3em 0 0 0.5em;
        font-size: 15px;
      }

      .thumb-toolbar-area .video-like{
        width: 30px;
        height: 30px;
        float: right;
        cursor: pointer;
         
      } 


      .comment-post {
        width: 100%;
        float: left;
        margin-top: 1em;
      }

      .comment-post .input-area{ 
        width: 415px!important;
      }


      .footer {
        width: 100%;
        height: 20em;
        float: left;
        margin-top: 3em;
        background: black;
      }

      .comment-post.edit-area {
        width: 100%;
        height: auto;
        float: left;
      }

      .list-post-area .header-post .text-post-edit  {
      display: block;
      min-height: 5em;
      text-align: left;
      width: 100%;
    }
  
</style>

<div id="list-post-area" class="list-post-area"> 
  <?php $showedalbums = []; ?>

          <?php foreach($comments as $comment){

           $usuario = DB::table('users')
                            ->where('id', $comment->id_user)
                            ->first();

                  $response = DB::table('comments')
                  ->where('id_comment', $comment->id)
                  ->where('id_wall', $user->id_wall)
                  ->orderBy('created_at', 'asc')
                  ->get(); ?>
            
            <?php  if ($comment->type == 'com') { ?>

              <div class="header-post">
                <div class="comments-options">
                  <ul>
                    <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onEdit({{$comment->id}})">Editar...</a></li>
                    <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar...</a></li>
                  </ul> 
                </div>

                <div class="image-area" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                <div class="user-info">
                  <p>{{$usuario->name}}</p>
                  <p><small>{{$comment->created_at}}</small></p>
                </div>

                <div class="text-post">
                  <p id="{{$comment->id}}">{{$comment->comment}}</p>
                    <div class="text-post-toolbar">
                      <ul>
                        <?php if ($comment->like == 0){ ?>
                        <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_off.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                        <?php }else{ ?>
                        <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_on.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                        <?php } ?>
                        <li style="background: url(../../images/share.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                        <div class="addthis_inline_share_toolbox"></div>
                      </ul>
                    </div>
                </div>
              </div>

            <?php }if ($comment->type == 'pic') { ?>

            <div class="header-post">
              <div class="comments-options">
                <ul>
                  <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar...</a></li>
                </ul> 
              </div>

              <div class="image-area" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
              <div class="user-info">
                <p>{{$usuario->name}}</p>
                <p><small>{{$comment->created_at}}</small></p>
              </div>

              <?php if (!is_null($comment->title)) { ?>
                <div class="text-post">
                  <p>{{$comment->title}}</p>
                </div>
              <?php } ?>                     

              <div class="media-post"> 
                <div class="media-post-content"> <img src="{{$comment->comment}}" style="width: 100%; height: auto;"></div>
                <div class="media-post-toolbar">
                  <ul>
                  <?php if ($comment->like == 0){ ?>
                  <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_off.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                  <?php }else{ ?>
                  <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_on.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                  <?php } ?>
                    <li style="background: url(../../images/share.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                    <div class="addthis_inline_share_toolbox"></div>
                  </ul>
                </div>
              </div>               
            </div> 

            <?php }if ($comment->type == 'video') { ?>

            <div class="header-post">
              <div class="comments-options">
                <ul>
                  <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar...</a></li>
                </ul> 
              </div>

              <div class="image-area" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
              <div class="user-info">
                <p>{{$usuario->name}}</p>
                <p><small>{{$comment->created_at}}</small></p>
              </div>

              <?php if (!is_null($comment->title)) { ?>
                <div class="text-post">
                  <p>{{$comment->title}}</p>
                </div>
              <?php } ?>                     

              <div class="media-post"> 
                <div class="media-post-content"> 
                  <div class="slider-video">
                    <a href="javascript:;">
                      <div class="iframecontaner">
                        <img src="">
                          <div class="overlay-icon-play">
                              <div class="icon-play"></div>
                          </div>
                      </div>
                
                      <?php $query = explode('=', $comment->comment); ?>
                        <input style="display: none;" type="text" class="ruta-video" value="https://www.youtube.com/embed/{{$query[1]}}?autoplay=1">
                        <iframe src="" frameborder="0" allowfullscreen style="height: 100%; width: 100%;"></iframe>
                    </a>
                  </div>
                </div>
                <div class="media-post-toolbar">
                  <ul>
                  <?php if ($comment->like == 0){ ?>
                  <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_off.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                  <?php }else{ ?>
                  <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_on.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                  <?php } ?>
                    <li style="background: url(../../images/share.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                    <div class="addthis_inline_share_toolbox"></div>
                  </ul>
                </div>
              </div>
            </div> 

            <?php } if ($comment->type == 'album' && !in_array($comment->id_album, $showedalbums)) {

               $showedalbums[] = array_push($showedalbums, $comment->id_album);
                  
                    $pictures = DB::table('comments')
                          ->where('id_album', $comment->id_album)
                          ->where('type', 'album')
                          ->get(); 
                        
                    $album = DB::table('albums')
                          ->where('id_wall', $comment->id_wall)
                          ->where('id', $comment->id_album)
                          ->first();
                        
                    $picId = DB::table('comments')
                                ->where('id_album', $comment->id_album)
                                ->where('type', 'album')
                                ->first();
                    $count = count($pictures);
                    $i=0
              ?>
              <div class="header-post">
                <div class="comments-options">
                  <ul>
                    <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onDelete({{$comment->id}})">Eliminar...</a></li>
                  </ul> 
                </div>

                <div class="image-area" style="background: url('{{$usuario->profile_pic}}'); background-size: cover;"></div>
                  <div class="user-info">
                    <p>{{$usuario->name}}</p>
                    <p><small>{{$album->created_at}}</small></p>
                  </div>

                  <?php if (!is_null($album->name)) { ?>
                    <div class="text-post">
                      <p>{{$album->name}}</p>
                    </div>
                  <?php } ?>                     

                  <div class="media-post"> 
                    <div class="media-post-content">
                      <ul class="multi-image">
                      <?php for ($i=0; $i < 3 ; $i++) { ?>
                         <li style="background: url('{{$pictures[$i]->comment}}'); background-size: cover;" id="{{$pictures[$i]->id}}"></li>
                      <?php } ?>
                      <?php if ($count > 3) { ?>
                        <li>
                          <div class="more">
                          <?php $rest = $count - 3; ?>
                            <p>+{{$rest}}</p> 
                          </div> 
                        </li>
                      <?php } ?>
                      </ul>
                    </div>

                    <div class="media-post-toolbar">
                      <ul>
                        <?php if ($comment->like == 0){ ?>
                          <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_off.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                        <?php }else{ ?>
                          <li onclick="onLike({{$comment->id}})" style="background: url(../../images/resources/like_on.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                        <?php } ?>
                          <li style="background: url(../../images/share.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                          <div class="addthis_inline_share_toolbox"></div>
                      </ul>
                    </div>

                  </div>

                </div> 

            <?php } ?>

          <?php if (count($response) > 0){ ?>
            <?php foreach($response as $res) { ?>
              <?php $resuser = DB::table('users')->where('id', $res->id_user)->first(); ?>
                <div class="header-post">
                  <div class="comments-options">
                    <ul>
                      <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onEdit({{$res->id}})">Editar...</a></li>
                      <li><a style="text-decoration: none; color: black;" href="javascript:;" onclick="onDelete({{$res->id}})">Eliminar...</a></li>
                    </ul> 
                  </div>

                  <div class="image-area" style="background: url('{{$resuser->profile_pic}}'); background-size: cover;"></div>
                  <div class="user-info">
                    <p>{{$resuser->name}}</p>
                    <p><small>{{$res->created_at}}</small></p>
                  </div>

                  <div class="text-post">
                    <p id="{{$res->id}}">{{$res->comment}}</p>
                      <div class="text-post-toolbar">
                        <ul>
                          <?php if ($res->like == 0){ ?>
                          <li onclick="onLike({{$res->id}})" style="background: url(../../images/resources/like_off.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                          <?php }else{ ?>
                          <li onclick="onLike({{$res->id}})" style="background: url(../../images/resources/like_on.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                          <?php } ?>
                          <li style="background: url(../../images/share.png)no-repeat!important; background-size: 100% 100%!important;"></li>
                          <div class="addthis_inline_share_toolbox"></div>
                        </ul>
                      </div>
                  </div>
                </div>
            }

            <?php } ?>

            <form id="respuesta2_{{$comment->id}}" class="respuesta2" onsubmit="event.preventDefault(); formsubmit(this);" action="{{ action('CommentController@commentuser')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_wall" value="{{ $user->id }}">
              <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
              <input type="hidden" name="id_comment" id="id_comment_{{$comment->id}}" value="{{$comment->id}}">
                <div class="comment-area">

                  <div class="image-area"  style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                  <div class="input-area">
                    <textarea name="comment"></textarea>
                  </div>
                  
                  <div class="button-area">
                    <button>PUBLICAR</button>
                  </div>
              

              </div>  
            </form>

          <?php }else{ ?>

            <?php if ($comment->type == 'album') { ?>


            <?php }else{ ?>

              <form id="respuestacommentario_{{$comment->id}}" class="respuestacommentario" onsubmit="event.preventDefault(); formsubmit(this);" action="{{ action('CommentController@commentuser')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_wall" value="{{ $user->id }}">
                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                <input type="hidden" name="id_comment" id="id_comment_{{$comment->id}}" value="{{$comment->id}}">
                
                <div class="comment-area">
                    <div class="image-area"  style="background: url('{{Auth::user()->profile_pic}}'); background-size: cover;"></div>
                    <div class="input-area">
                      <textarea name="comment"></textarea>
                    </div>
                    
                    <div class="button-area">
                      <button>PUBLICAR</button>
                    </div>
                </div> 
              </form>

            <?php } ?>
            
          
          <?php } ?>

       <?php } ?>
    </div> 

    <!-- Publication's history -->
</div>