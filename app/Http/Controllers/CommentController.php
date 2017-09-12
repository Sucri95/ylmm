<?php

namespace App\Http\Controllers;

use Request;
use App\Comments;
use App\Sponsors;
use Input;
use View;
use Redirect;
use Auth;
use DB;
use Image;
use Validator;
use Session;
use App\Responses;
use App\Notifications;
use App\Activities;
use App\Albums;
use App\PvUserComment;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function takeSponsors()
    {
        return Sponsors::all();
    }

    public function commentuser(Request $request)
    {
         if (Auth::check()) {

        
        $comentario           = new Comments;           
        $comentario->id_user  = Request::get('id_user');
        $comentario->id_wall  = Request::get('id_wall');
        $comentario->type = 'com';

        $user = DB::table('users')->find($comentario->id_user);

        $comentario->comment  = Request::get('comment');
        
        if (Request::get('id_comment') != null) {

            $comentario->id_comment = Request::get('id_comment');
        }      
                
        $comentario->save();

        if ($comentario->id_wall != Auth::user()->id_wall) {

            $user = DB::table('users')->where('id_wall', $comentario->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->type = 'post';
            $notification->seen = 'N';
            $notification->save();

            $check = Request::get('check');

            if ($check == 'true') {

                $tagsNumber = Request::get('count');

                if ($tagsNumber == 1) {

                    $notification = new Notifications;

                    if (is_null($comentario->id_comment)) {
                        
                        $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';

                    }else{

                        $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                    }

                    $notification->href = '/users/wall?id='.$comentario->id_user.'&idcomment='.$comentario->id.'';
                    $notification->id_user = Request::get('user');
                    $notification->id_comment = $comentario->id;
                    $notification->type = 'tag';
                    $notification->seen = 'N';
                    $notification->save();
                
                }else{

                    $users = explode(',', Request::get('user'));

                        for ($i=0; $i < count($users); $i++) { 
                            $notification = new Notifications;

                        if (is_null($comentario->id_comment)) {
                            
                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';
                            
                        }else{

                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                        }

                        $notification->href = '/users/wall?id='.$comentario->id_user.'&idcomment='.$comentario->id.'';
                        $notification->id_user = $users[$i];
                        $notification->id_comment = $comentario->id;
                        $notification->type = 'tag';
                        $notification->seen = 'N';
                        $notification->save();

                    }


                }

            }
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Comentario';
        $activity->save(); 

        return $comentario->id;       

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function commentresponsewall()
    {
         if (Auth::check()) {

        
        $comentario           = new Comments;           
        $comentario->id_user  = $_GET['id_user'];
        $comentario->id_wall  = $_GET['id_wall'];
        $comentario->type = 'com';
        $comentario->id_response = $_GET['id_response'];

        $user = DB::table('users')->find($comentario->id_user);

        $comentario->comment  = $_GET['comment'];

        
        if ($_GET['id_comment'] != null) {

            $comentario->id_comment = $_GET['id_comment'];
        }      
                
        $comentario->save();

        if ($comentario->id_wall != Auth::user()->id_wall) {

            $user = DB::table('users')->where('id_wall', $comentario->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha respondido tu publicación!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->type = 'post';
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Respuesta';
        $activity->save(); 

        return $comentario->id;       

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function createcomment(Request $request)
    {
        if (Auth::check()) {

        $comentario           = new Comments;           
        $comentario->comment  = Request::get('comment');//Comment
        $comentario->id_user  = Request::get('id_user');//Made the comment
        $comentario->id_video = Request::get('id_video'); 
        $comentario->type = 'com';
        $type = '';

        $video = DB::table('videos')->where('id', Request::get('id_video'))->first();

        if (is_null($video->id_band)) {

            $musician = DB::table('musicians')->where('id', $video->id_musician)->first();
            $user = DB::table('users')->where('id_musician', $musician->id)->first();
            $type = 'M';

        }else{

            $band = DB::table('bands')->where('id', $video->id_band)->first();
            $user = DB::table('users')->where('id_band', $band->id)->first();
            $type = 'B';
        }

        
        if (Request::get('id_comment') != null) {
            $comentario->id_comment = Request::get('id_comment');
        }

        if ($user->id != Auth::user()->id) {
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha comentado tu video!';
            if ($type == 'M') {
                $notification->href = '/musician/musician_comments?id='.$user->id_wall.'&idvideo='.$video->id.'&idmusic='.$video->id_musician.'';
            }else{
                $notification->href = '/bands/band_comments?idvideo='.$video->id.'&idband='.$video->id_band.'';

            }
            $notification->id_user = $user->id;
            $notification->id_video = Request::get('id_video');
            $notification->id_comment = $comentario->id;
            $notification->type = 'video';
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Comentario';
        $activity->save();      
                
        $comentario->save();

                    $check = Request::get('check');

            if ($check == 'true') {

                    $tagsNumber = Request::get('count');

                    if ($tagsNumber == 1) {

                        $notification = new Notifications;

                        if (is_null($comentario->id_comment)) {
                            
                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';

                        }else{

                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                        }
                        if ($type == 'M') {
                            $notification->href = '/musician/musician_comments?id='.$user->id_wall.'&idvideo='.$video->id.'&idmusic='.$video->id_musician.'&idcomment='.$comentario->id.'';
                        }else{
                            $notification->href = '/bands/band_comments?idvideo='.$video->id.'&idband='.$video->id_band.'&idcomment='.$comentario->id.'';

                        }
                        $notification->id_user = Request::get('user');
                        $notification->id_comment = $comentario->id;
                        $notification->type = 'tag';
                        $notification->seen = 'N';
                        $notification->save();
                    
                    }else{

                        $users = explode(',', Request::get('user'));

                            for ($i=0; $i < count($users); $i++) { 
                                $notification = new Notifications;

                            if (is_null($comentario->id_comment)) {
                                
                                $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';
                                
                            }else{

                                $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                            }

                            if ($type == 'M') {
                                $notification->href = '/musician/musician_comments?id='.$user->id_wall.'&idvideo='.$video->id.'&idmusic='.$video->id_musician.'&idcomment='.$comentario->id.'';
                            }else{
                                $notification->href = '/bands/band_comments?idvideo='.$video->id.'&idband='.$video->id_band.'&idcomment='.$comentario->id.'';

                            }
                            $notification->id_user = $users[$i];
                            $notification->id_comment = $comentario->id;
                            $notification->type = 'tag';
                            $notification->seen = 'N';
                            $notification->save();

                        }


                    }

            }
            
        return $comentario->id;   

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }       
    }

    public function commentband(Request $request)
    {
         if (Auth::check()) {

        
        $comentario           = new Comments;           
        $comentario->id_user  = Request::get('id_user');
        $comentario->id_band  = Request::get('id_band');
        $comentario->comment  = Request::get('comment');
        $comentario->type = 'com';
        $rand = substr(md5(microtime()),rand(0,26),5);

        
        if (Request::get('id_comment') != null) {
            $comentario->id_comment = Request::get('id_comment');
        }      
                
        $comentario->save();

        if ($comentario->id_band != Auth::user()->id_band) {

            $user = DB::table('users')->where('id_band', $comentario->id_band)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro de banda!';
            $notification->href    = '/bands/comments?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->type = 'post';
            $notification->seen = 'N';
            $notification->save();

            $check = Request::get('check');

            if ($check == 'true') {

                $tagsNumber = Request::get('count');

                if ($tagsNumber == 1) {

                    $notification = new Notifications;

                    if (is_null($comentario->id_comment)) {
                        
                        $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';

                    }else{

                        $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                    }

                    $notification->href = '/bands/comments?id='.$comentario->id_band.'&idcomment='.$comentario->id.'';
                    $notification->id_user = Request::get('user');
                    $notification->id_comment = $comentario->id;
                    $notification->type = 'tag';
                    $notification->seen = 'N';
                    $notification->save();
                
                }else{

                    $users = explode(',', Request::get('user'));

                        for ($i=0; $i < count($users); $i++) { 
                            $notification = new Notifications;

                        if (is_null($comentario->id_comment)) {
                            
                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';
                            
                        }else{

                            $notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

                        }

                        $notification->href = '/bands/comments?id='.$comentario->id_band.'&idcomment='.$comentario->id.'';
                        $notification->id_user = $users[$i];
                        $notification->id_comment = $comentario->id;
                        $notification->type = 'tag';
                        $notification->seen = 'N';
                        $notification->save();

                    }


                }

            }
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Comentario';
        $activity->save(); 
            
        return $comentario->id;    

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function commentresponseband()
    {
         if (Auth::check()) {

        
        $comentario           = new Comments;           
        $comentario->id_user  = $_GET['id_user'];
        $comentario->id_band = $_GET['id_band'];
        $comentario->comment = $_GET['comment'];
        $comentario->type = 'com';
        $comentario->id_response = $_GET['id_response'];

        
        if (Input::get('id_comment') != null) {
            $comentario->id_comment = $_GET['id_comment'];
        }      
                
        $comentario->save();

        if ($comentario->id_band != Auth::user()->id_band) {

            $user = DB::table('users')->where('id_band', $comentario->id_band)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha respondido tu publicación!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->type = 'post';
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Comentario';
        $activity->save(); 
            
        return $comentario->id;    

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }
    
    public function verifyLikesComment($id_comment)
    {

        $pvusercomment = DB::table('pv_usercomment')->where('id_user', Auth::user()->id)->where('id_comment', $id_comment)->first();

        if (is_null($pvusercomment)) {

            return false;

        }else{
            
            return $pvusercomment->id;
        }
    }

    public function addLike()
    {

        $relation = $this->verifyLikesComment(Request::get('id'));
  
        if($relation != false)
        {

            $comment = Comments::find(Request::get('id'));

            if ($comment->like == 0) {

                $comment->like = 0;
                $comment->save();
                $rela = PvUserComment::find($relation);
                $rela->delete();

            }else{

                $comment->like = $comment->like - 1;
                $comment->save();
                $rela = PvUserComment::find($relation);
                $rela->delete();
            }

            return 0;

        }else{

            $comment = Comments::find(Request::get('id'));
            $comment->like = $comment->like + 1;
            $comment->save();

            $uv = new PvUserComment;
            $uv->id_comment = Request::get('id');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            if ($comment->id_user != Auth::user()->id) {

                $user = DB::table('users')->where('id', $comment->id_user)->first();
                
                $notification = new Notifications;
                $notification->comment = '¡A '.Auth::user()->name.' le gusta tu publicación!';
                $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                $notification->id_user = $user->id;
                $notification->id_comment = $comment->id;
                $notification->type = 'post';
                $notification->seen = 'N';
                $notification->save();
                    
            }
            


            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Me gusta';
            $activity->save(); 

            return 1;

        }

    }


    public function uploadPic()
    {
        
        $image64 = Input::get('array');

        $exploder = explode('__', $image64);

        $count = count($exploder);

        $aux = 0;

        $idalbum = str_random(5); 

        if ($count == 1) {

            $pictures = new Comments;           
                    
            $pictures->id_user = Input::get('id_user');
            $pictures->id_band = Input::get('id_band');
            $rand = str_random(10);
            
            $findextension = explode('image/', $image64);

            $ext = explode(';', $findextension[1]);
            
            $name = $rand .'.' .$ext[0];

            $path = 'uploads/'.$name;

            $image = Image::make($image64)->save($path);
            
            $path               = '../../uploads/';
            $pictures->comment  = $path . $name;
            $pictures->type    = 'pic';

            if (Input::get('title') != '') {
                    
                $pictures->title = Input::get('title');
            
            }
            
            $pictures->save();

            if ($pictures->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $pictures->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->type = 'post';
            $notification->id_comment = $pictures->id;
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de imágenes';
        $activity->save(); 
        
     	return Redirect::to('/bands/comments?id='.$pictures->id_band.'');


        }else{

            $album = new Albums;

             if (Input::get('title') != '') {
                
                $album->name = Input::get('title');
            }
            
            $album->id_user = Input::get('id_user');
            $album->id_band = Input::get('id_band');
    
            if (Input::get('title') != '') {
            
                $album->name = Input::get('title');
            }

            $album->save();

            foreach($exploder as $file) {

               $pictures = new Comments;           
                
                $pictures->id_user = Input::get('id_user');
                $pictures->id_band = Input::get('id_band');



                $rand = str_random(10);
            
                $findextension = explode('image/', $file);

                $ext = explode(';', $findextension[1]);
                
                $name = $rand .'.' .$ext[0];

                $path = 'uploads/'.$name;

                $image = Image::make($file)->save($path);
                
                $path               = '../../uploads/';
                $pictures->comment  = $path . $name;
                $pictures->type    = 'album';
                $pictures->id_album = $album->id;

                $pictures->save();
                
                $aux ++;


            }


    }

    if($aux == $count){



        if ($pictures->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $pictures->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->type = 'post';
            $notification->id_comment = $pictures->id;
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de imágenes';
        $activity->save(); 
        
     return Redirect::to('/bands/comments?id='.$pictures->id_band.'');
    
    }


    }

    public function uploadVideo()
    {
        $files = Input::file('video');
        $getext = $files->getClientOriginalName();
        $exploder = explode('.', $getext);

        $rand = str_random(10);

        $name = Auth::user()->id.''.$rand .'.'. $exploder[1];

        $saver               = $files->move('uploads', $name);
        $path                = '../../uploads/';
        $route = $path . $name;
        
        $comentario          = new Comments;           
        $comentario->id_user = Input::get('id_user');
        $comentario->id_band = Input::get('id_band');
        $comentario->comment = $route;
        if (Input::get('title') != '') {
                
            $comentario->title = Input::get('title');
        }
        $comentario->type = 'video';
        $comentario->save();

        if ($comentario->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_band', $comentario->id_band)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en el muro de tu banda!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $user->id;
            $notification->type = 'post';
            $notification->id_band = $comentario->id_band;
            $notification->id_comment = $comentario->id;
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de video';
        $activity->save(); 


        return Redirect::to('/bands/comments?id='.$comentario->id_band.'');
    }

       public function pictureWall()
    {
        
        
        $comentario          = new Comments;           
        $comentario->id_user = Input::get('id_user');
        $comentario->id_wall = Input::get('id_wall');
        $saver = request()->file('picture')->store('uploads/');
        $exploder = explode('//', $saver);
        $path = '../../uploads/';
        $comentario->comment = $path . $exploder[1];
        $comentario->type = 'pic';
        $comentario->save();

        if ($comentario->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $comentario->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->type = 'post';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->seen = 'N';
            $notification->save();
                
        }

        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de imágenes';
        $activity->save();  
        


       return  Redirect::to('/users/wall?id='.$comentario->id_wall.'');
    }

    public function videoWall()
    {
       
        $files = Input::file('video');
        $getext = $files->getClientOriginalName();
        $exploder = explode('.', $getext);

        $rand = str_random(10);

        $name = Auth::user()->id.''.$rand .'.'. $exploder[1];

        $saver               = $files->move('uploads', $name);
        $path                = '../../uploads/';
        $route = $path . $name;

        $comentario          = new Comments;           
        $comentario->id_user = Input::get('id_user');
        $comentario->id_wall = Input::get('id_wall');
        if (Input::get('title') != '') {
                
            $comentario->title = Input::get('title');
        
        }
        $comentario->comment = $route;
        $comentario->type = 'video';
        $comentario->save();

        if ($comentario->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $comentario->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->type = 'post';
            $notification->id_user = $user->id;
            $notification->id_comment = $comentario->id;
            $notification->seen = 'N';
            $notification->save();
                
        }

        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de video';
        $activity->save();  
        

        return  Redirect::to('/users/wall?id='.$comentario->id_wall.'');
    }

    public function delete()
    {

        $comment = Comments::find(Request::get('id'));
        
        if ($comment->type == 'com' || $comment->type == 'pic' || $comment->type == 'video') {

           $responses = DB::table('comments')
                ->where('id_comment', $comment->id)
                ->get();

            if (count($responses) > 0){ 

                foreach ($responses as $response) {

                    $res = Comments::find($response->id);

                    $res->delete();
                }
            }

            $comment->delete();

            return 1;
        }

        if ($comment->type == 'album') {
 
            $album = DB::table('albums')->where('id', $comment->id_album)->first();
            
            $pictures = DB::table('comments')->where('id_album', $comment->id_album)->get();
            $idresponse = DB::table('comments')->where('id_album', $comment->id_album)->first();

            $responses = DB::table('comments')
                ->where('id_comment', $idresponse->id)
                ->get();

            if (count($responses) > 0){ 

                foreach ($responses as $response) {

                    $res = Comments::find($response->id);

                    $res->delete();
                }
            }

            if (count($pictures) > 0){ 

                foreach ($pictures as $pic) {

                    $dpic = Comments::find($pic->id);

                    $dpic->delete();
                }
            }

          
            $idalbum = Albums::find($album->id);

            $idalbum->delete();
            
            return 1;

    }

}

    public function editComment()
    {

       try {

            $comment = DB::table('comments')->find(Request::get('id'));

            DB::table('comments')->where('id', $comment->id)->update(['comment' => Request::get('comment')]);

            return $comment->id;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function editTitle()
    {

       try {

            $comment = DB::table('comments')->find(Request::get('id'));

            if ($comment->type == 'pic' || $comment->type == 'video') {
                
                DB::table('comments')->where('id', $comment->id)->update(['title' => Request::get('title')]);

            }

            if ($comment->type == 'album') {

                $album = DB::table('albums')->where('id', $comment->id_album)->first();

                DB::table('albums')->where('id', $comment->id_album)->update(['name' => Request::get('title')]);
            }


            return $comment->id;

        } catch (\Exception $e) {
            return $e;
        }
    }



    public function multiple_upload() {

    $image64 = Input::get('array');

    $exploder = explode('__', $image64);

    $count = count($exploder);

    $aux = 0;

    $idalbum = str_random(5); 

    if ($count == 1) {

        $pictures = new Comments;           
                
        $pictures->id_user = Input::get('id_user');
        $pictures->id_wall = Input::get('id_wall');
        $rand = str_random(10);
        
        $findextension = explode('image/', $image64);

        $ext = explode(';', $findextension[1]);
        
        $name = $rand .'.' .$ext[0];

        $path = 'uploads/'.$name;

        $image = Image::make($image64)->save($path);
        
        $path               = '../../uploads/';
        $pictures->comment  = $path . $name;
        $pictures->type    = 'pic';

        if (Input::get('title') != '') {
                
            $pictures->title = Input::get('title');
        
        }
        
        $pictures->save();
        
        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de imágenes';
        $activity->save();

        if ($pictures->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $pictures->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->type = 'post';
            $notification->id_user = $user->id;
            $notification->id_comment = $pictures->id;
            $notification->seen = 'N';
            $notification->save();
                
        }

       return  Redirect::to('/users/wall?id='.$pictures->id_wall.'');

    }else{

        $album = new Albums;

        $album->name = $idalbum;
        $album->id_user = Input::get('id_user');
        $album->id_wall = Input::get('id_wall');
        if (Input::get('title') != '') {
                    
            $album->name = Input::get('title');
            
            }

        $album->save();

        foreach($exploder as $file) {

           $pictures = new Comments;           
            
            $pictures->id_user = Input::get('id_user');
            $pictures->id_wall = Input::get('id_wall');
            $rand = str_random(10);

            $findextension = explode('image/', $file);

            $ext = explode(';', $findextension[1]);
            
            $name = $rand .'.' .$ext[0];

            $path = 'uploads/'.$name;

            $image = Image::make($file)->save($path);
            
            $path               = '../../uploads/';
            $pictures->comment  = $path . $name;
            $pictures->type     = 'album';
            $pictures->id_album = $album->id;

            $pictures->save();
            
            $aux ++;


        }


    }

    if($aux == $count){

        if ($pictures->id_user != Auth::user()->id) {

            $user = DB::table('users')->where('id_wall', $pictures->id_wall)->first();
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->type = 'post';
            $notification->id_user = $user->id;
            $notification->id_comment = $pictures->id;
            $notification->seen = 'N';
            $notification->save();
                
        }


        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Publicación de imágenes';
        $activity->save(); 
    
      return  Redirect::to('/users/wall?id='.$pictures->id_wall.'');
    
    }

  }

  public function test()
  {
    $sponsors = $this->takeSponsors();
    return View::make('test',array('sponsors' => $sponsors));
  }

  public function testhtml()
    {
         $sponsors = $this->takeSponsors();
         $band = Request::get('id');
         return View::make('helpers.comment-list', array('sponsors' => $sponsors, 'band' => $band));  
    }

 public function commenthelper()
    {
         $sponsors = $this->takeSponsors();
         $wall = Request::get('id');
         return View::make('helpers.comment-list-wall', array('sponsors' => $sponsors, 'wall' => $wall));  
    }

}

     