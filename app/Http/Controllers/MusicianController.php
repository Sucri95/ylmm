<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use View;
use DB;
use Input;
use Socialite;
use Redirect;
use Hash;
use App\User;
use App\Videos;
use App\Sponsors;
use App\Genres;
use App\Bands;
use App\Battles;
use App\Musicians;
use App\Notifications;
use App\Activities;
use App\Favorites;

class MusicianController extends Controller
{
    public function verifyFavoriteMusician($idmusic)
    {

        $favorite = DB::table('favorites')->where('id_user', Auth::user()->id)->where('id_musician', $idmusic)->first();

        if (is_null($favorite)) {

            return false;

        }else{
            
            return $favorite->id;
        }
    }

    public function addFanMusician()
    {

        $relation = $this->verifyFavoriteMusician(Request::get('idmusic'));

  
        if($relation != false)
        {

            $musician = Musicians::find(Request::get('idmusic'));

            if ($musician->favorite == 0) {

                $musician->favorite = 0;
                $musician->save();
                $rela = Favorites::find($relation);
                $rela->delete();

            }else{

                $musician->favorite = $musician->favorite - 1;
                $musician->save();
                $rela = Favorites::find($relation);
                $rela->delete();
            }

        }else{


            $musician = Musicians::find(Request::get('idmusic'));
            $musician->favorite = $musician->favorite + 1;
            $musician->save();

            $uv = new Favorites;
            $uv->id_musician = Request::get('idmusic');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            $noto = DB::table('users')->where('id_musician', $musician->id)->first();
                $notification2 = new Notifications;
                $notification2->comment = '¡'.Auth::user()->name.' te ha empezado a seguir!';
                $notification2->id_user = $noto->id;
                $notification2->seen = 'N';
                $notification2->save();


            $user = User::find(Auth::user()->id);
                $user->activity_count = $user->activity_count + 1;
                $user->save();

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Marcó un músico como favorito';
                $activity->save();

            return 1;

        }


    }

    public function editInstruments()
    {
       if (Auth::check()) {

            $musician = Musicians::find(Input::get('id_musician'));

             $roles = Input::get('role');

                if (Input::get('cuerda') != '') {

                    $roles = array_diff($roles, ["CUERDA"]);

                    array_push($roles, Input::get('cuerda'));
                }
                if (Input::get('viento') != '') {

                    $roles = array_diff($roles, ["VIENTO"]);

                    array_push($roles, Input::get('viento'));
                }
                if (Input::get('otro') != '') {

                    $roles = array_diff($roles, ["OTRO"]);

                    array_push($roles, Input::get('otro'));
                }

            $role = serialize($roles);


            DB::table('musicians')->where('id', $musician->id)->update(['role' => $role]);

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function editGenreMusician()
    {
        if (Auth::check()) {

            $musician = Musicians::find(Input::get('id_musician'));

            $genres = Input::get('id_genre');

            if (Input::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Input::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);

            $genre = serialize($mgenre);

            DB::table('musicians')->where('id', $musician->id)->update(['genres' => $genre]);

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

	public function editAbout()
    {

      if (Auth::check()) {

            $musician = Musicians::find(Input::get('id_music'));
                
                DB::table('musicians')->where('id', $musician->id)->update(['about' => Input::get('about')]);

                return Redirect::to('/musician/about?id='.$musician->id_user.'&idmusic='.$musician->id.'');  

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function setAbout()
    {
       if (Auth::check()) {

            $musician = Musicians::find(Input::get('id_music'));
                
                DB::table('musicians')->where('id', $musician->id)->update(['about' => Input::get('setabout')]);

                return Redirect::to('/musician/about?id='.$musician->id_user.'&idmusic='.$musician->id.'');  

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

	public function musicianView()
    {
        if (Auth::check()) {
            $sponsors = $this->takeSponsors();
            $genres = $this->takeGenres();
            return View::make('musicians.musicianregistration', array('sponsors' => $sponsors, 'genres' => $genres));
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
   }

   public function aboutMusician()
    {
        if (Auth::check()) {
            $sponsors = $this->takeSponsors();
            $genres = $this->takeGenres();
            return View::make('musicians.about', array('sponsors' => $sponsors, 'genres' => $genres));
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
   }

	public function musicianRegistration()
    {
        if (Auth::check()) {

           $user = User::find(Auth::user()->id);

           $musician = new Musicians;

            $musician->artistic_name = Input::get('name');

            $genres = Input::get('id_genre');

            if (Input::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Input::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);

            $musician->genres = serialize($mgenre);
            
            $roles = Input::get('role');

                if (Input::get('cuerda') != '') {

                    $roles = array_diff($roles, ["CUERDA"]);

                    array_push($roles, strtoupper(Input::get('cuerda')));
                }
                if (Input::get('viento') != '') {

                    $roles = array_diff($roles, ["VIENTO"]);

                    array_push($roles, strtoupper(Input::get('viento')));
                }
                if (Input::get('otro') != '') {

                    $roles = array_diff($roles, ["OTRO"]);

                    array_push($roles, strtoupper(Input::get('otro')));
                }

            $merge[] = '';

            $merge = array_merge($merge, $roles);

            $role = serialize($merge);

            $musician->role = $role;
            $musician->id_user = Auth::user()->id;
            $musician->profile_pic = Auth::user()->profile_pic;
            $musician->save();

            DB::table('users')->where('id', Auth::user()->id)->update(['user_level' => '5']);
            DB::table('users')->where('id', Auth::user()->id)->update(['name' => $musician->artistic_name]);
            DB::table('users')->where('id', Auth::user()->id)->update(['id_musician' => $musician->id]);

            $country = Input::get('selectedcountry');
            $province = Input::get('selectedprovince');

            if (!is_null($country) && !is_null($province)) {
                
                DB::table('users')->where('id', Auth::user()->id)->update(['country' => $country]);
                DB::table('users')->where('id', Auth::user()->id)->update(['province' => $province]);   
            }
            
            DB::table('users')->where('id', Auth::user()->id)->update(['verified' => '1']);

            $notification = new Notifications;
                $notification->comment = '¡Has actualizado tus datos!';
                $notification->id_user = Auth::user()->id;
                $notification->seen = 'N';
                $notification->save();

            return Redirect::to('/users/wall?id='.Auth::user()->id.'');

        }else{

            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');

        }
    }

	public function comments_view()
	{
		if (Auth::check()) {

			$sponsors = $this->takeSponsors();
        	$genres = $this->takeGenres();
        	return View::make('musicians.videos_comments', array('sponsors' => $sponsors, 'genres' => $genres));
 		
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

	public function videos_view()
	{
		if (Auth::check()) {

			$idmusic = $_GET['idmusic'];

			$musician = DB::table('musicians')->find($idmusic);
			$videos = DB::table('videos')->where('id_musician', $musician->id)->get();

			$sponsors = $this->takeSponsors();
        	$genres = $this->takeGenres();
        	return View::make('musicians.videos_musician', array('sponsors' => $sponsors, 'genres' => $genres, 'musician' => $musician, 'videos' => $videos));
 		
 		}else{

 			return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción'); 

 		}
	}
    public function creator_music()
    {
        if (Auth::check()) {
        
        $idmusic = Input::get('idmusic');
        $video = new Videos;
        $very = Videos::where('url','=',  Input::get('url'))->count();
        
        if ($very > 0){
            
            return Redirect::to('/musician/videos?id='.Auth::user()->id.'&idmusic='.$idmusic.'&msg=6');  
        
        }else{      
            
            $video->url = Input::get('url');
        
        }

        $video->upload_date = date('d/m/Y');
        $video->id_genre    = Input::get('id_genre');
        $video->id_user     = Auth::user()->id;
        $video->id_musician = Auth::user()->id_musician;
        $videoname = Input::get('name');
        $bandname = Auth::user()->name;
        $video->name = $videoname.' - '.$bandname;

        if ($video->name == '' || $video->url == '' ) {

            return Redirect::to('/musician/videos?id='.Auth::user()->id.'&idmusic='.$idmusic.'&msg=7');    
        
        }else{

            $video->save();

            $battles = new Battles;

            $battles->id_user = Auth::user()->id_musician;
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

            DB::table('users')->where('id', Auth::user()->id)->update(['id_battle' => $battles->id]);
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
                $notification->id_band = Auth::user()->id_musician;
                $notification->seen = 'N';
                $notification->save();
            
            return Redirect::to('/musician/videos?id='.Auth::user()->id.'&idmusic='.$idmusic.'&msg=9');
        
        };
        
        }else{

             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');

        }
    }
}
