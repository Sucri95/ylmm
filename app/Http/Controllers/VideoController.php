<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Date;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Sponsors;
use App\Bands;
use App\Battles;
use App\Videos;
use App\Eloquent;
use App\Genres;
use App\PVUserVideo;
use App\Notifications;
use App\Activities;
use Request;
use Redirect;

class VideoController extends Controller
{

    public function verifyVideo($videoID) 
    {

        
        $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v={{$videoID}}&format=json";
        $headers = get_headers($theURL);

        return (substr($headers[0], 9, 3) !== "404");
    }

    public function genre_reproductor()
    {
       if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        return View::make('videos.genre_reproductor', array('sponsors' => $sponsors));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }

    }

    public function genre()
    {
        if (Auth::check()) {

        $id = $_GET['id_genre'];

        $genre = Genres::find($id);

        $videos = DB::table('videos')->where('id_genre', $genre->id)->orderBy('name', 'asc')->get();
        
        $sponsors = $this->takeSponsors();

            return View::make('videos.genre', array('sponsors' => $sponsors, 'genres' => $genre, 'videos' => $videos));       

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }


    }

    public function takeSponsors()
    {
        return Sponsors::all();
    }
    public function takeGenres()
    {
        return Genres::all();
    }

    public function createvideo()
    {
         if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $genres = $this->takeGenres();
        return View::make('videos.create', array('sponsors' => $sponsors), array('genres' => $genres));

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }
    public function creator()
	{
		if (Auth::check()) {
		
        $idband = Input::get('idband');
		$video = new Videos;
		$very = Videos::where('url','=',  Input::get('url'))->count();
		if ($very > 0){
			
			return Redirect::to('/bands/home_band?idband='.$idband.'&msg=8');  
		
		}else{ 		
			
			$video->url = Input::get('url');
		
		}

		$video->upload_date = date('d/m/Y');
		$video->id_genre    = Input::get('id_genre');

        if (is_null(Auth::user()->id_band)) {

            $video->id_user = Auth::user()->id;
            $videoname = Input::get('name');
            $bandname = Auth::user()->name;
            $video->name = $videoname.' - '.$bandname;
            
        }else{

            $video->id_band = Auth::user()->id_band;
            $videoname = Input::get('name');
            $bandaname = DB::table('bands')->select('name')->where('id', Auth::user()->id_band)->first();
            $bandname = $bandaname->name;
            $video->name = $videoname.' - '.$bandname;
        }

		if ($video->name == '' || $video->url == '' ) {

			return Redirect::to('/bands/home_band?idband='.$idband.'&msg=9');    
    	
    	}else{

    		$video->save();

            $battles = new Battles;

            $battles->id_band = $video->id_band;
            $battles->date = date('d/m/Y');
            $battles->status = 'A';
            $battles->llave = '1';
            $battles->votes = '0';
            $battles->id_video = $video->id;

            $battles->name_video = $video->name;
            $battles->date_added = $video->upload_date;
            $battles->views = $video->views;
            $battles->url = Input::get('url');


            $battles->save();

            DB::table('bands')->where('id', $battles->id_band)->update(['id_battle' => $battles->id]);
            DB::table('videos')->where('id', $battles->id_video)->update(['id_battle' => $battles->id]);

             $notification = new Notifications;
                $notification->comment = '¡Te has unido a la batalla YLMM!';
                $notification->id_user = Auth::user()->id;
                $notification->id_band =  $battles->id_band;
                $notification->seen = 'N';
                $notification->save();

              $notification = new Notifications;
                $notification->comment = '¡Has subido un video nuevo!';
                $notification->id_user = Auth::user()->id;
                $notification->id_band = Auth::user()->id_band;
                $notification->id_video = $video->id;
                $notification->seen = 'N';
                $notification->save();
			
			return Redirect::to('/bands/home_band?idband='.$video->id_band.'&msg=10');
    	
    	};
    	
    	}else{

    		 return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');

    	}
	}

	public function deleteVideo()
	{
		$video = Videos::find(Request::get('id'));
		$video_battle = Battles::find(Request::get('id'));       

        $video->delete();
        $video_battle->delete();

        return "1";
	}

    public function addLike()
    {

        $relation = $this->verifyLike(Request::get('id_video'));
  
        if($relation != false)
        {

            $videos = Videos::find(Request::get('id_video'));

            if ($videos->likes == 0) {

                $videos->likes = 0;
                $videos->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();

            }else{

                $videos->likes = $videos->likes - 1;
                $videos->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();
            }

        }else{


            $videos = Videos::find(Request::get('id_video'));
            $videos->likes = $videos->likes + 1;
            $videos->save();

            $concurso = DB::table('battles')->where('id_video', Request::get('id_video'))->first();
            $votos = $concurso->votes + 1;

            DB::table('battles')->where('id_video', Request::get('id_video'))->update(['votes' => $votos]);
            
            $uv = new PVUserVideo;
            $uv->id_video = Request::get('id_video');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Like';
            $activity->save();

            if (is_null($videos->id_musician)) {
                $user = DB::table('users')->where('id_band', $videos->id_band)->first();
            }else{
                $user = DB::table('users')->where('id_musician', $videos->id_musician)->first();
            }
            

            if ($user->id != Auth::user()->id) {
                
                $notification = new Notifications;
                $notification->comment = '¡A '.Auth::user()->name.' le gusta tu video!';
                $notification->type = 'like';
                $notification->id_user = $user->id;
                $notification->id_band = $videos->id_band;
                $notification->id_video = $videos->id;
                $notification->seen = 'N';
                $notification->save();
                    
            }
        }

    }

    public function verifyLike($id_video)
    {

        $pvuservideo = DB::table('pv_uservideo')->where('id_user', Auth::user()->id)->where('id_video', $id_video)->first();

        if (is_null($pvuservideo)) {

            return false;

        }else{
            
            return $pvuservideo->id;
        }
    }
}
