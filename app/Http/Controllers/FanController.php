<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Sponsors;
use App\Videos;
use App\Genres;
use App\Bands;
use App\Notifications;
use App\PVVideoView;
use App\Activities;
use App\Favorites;
use Request;
use Redirect;
use Hash;
class FanController extends Controller
{

    public function editNameUser(){

        if (Auth::check()) {

            $name = Input::get('name');

            $user = DB::table('users')->where('id', Auth::user()->id)->first();

            DB::table('users')->where('id', $user->id)->update(['name' => $name]);
            DB::table('musicians')->where('id', $user->id_musician)->update(['artistic_name' => $name]);

            if (!is_null($user->id_musician)) {
                
                $battles = DB::table('battles')->where('id_user', $user->id_musician)->get();
                $videos = DB::table('videos')->where('id_musician', $user->id_musician)->get();

                if (!is_null($battles)) {

                   foreach ($battles as $video) {

                        $oldname = explode('-', $video->name_video);

                        $newname = $oldname[0] .' - '. $name;

                        DB::table('battles')->where('id', $video->id)->update(['name_video' => $newname]);

                    }
                }

                if (!is_null($videos)) {
                    
                   foreach ($videos as $video) {

                        $oldname = explode('-', $video->name);

                        $newname = $oldname[0] .' - '. $name;

                        DB::table('videos')->where('id', $video->id)->update(['name' => $newname]);

                    }
                }

                
            }


            return Redirect::to('/users/wall?id='.Auth::user()->id.'');

        }else{

            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function update_profile(){

        if (Auth::check()) {

            $files = Input::file('picture-avatar');
            $getext = $files->getClientOriginalName();
            $exploder = explode('.', $getext);

            $rand = str_random(10);

            $name = Auth::user()->id.''.$rand .'.'. $exploder[1];

            $saver               = $files->move('images/fotosperfil', $name);
            $path                = '../../images/fotosperfil/';
            $profile_pic = $path . $name;
            

            DB::table('users')->where('id', Auth::user()->id)->update(['profile_pic' => $profile_pic]);

            if (!is_null(Auth::user()->id_musician)) {

                DB::table('musicians')->where('id_user', Auth::user()->id)->update(['profile_pic' => $profile_pic]);
            }

            return Redirect::to('/users/wall?id='.Auth::user()->id.'');

        }else{

            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function update_background(){

        if (Auth::check()) {

            $files = Input::file('picture-background');

            if (!is_null($files)) {

            $getext = $files->getClientOriginalName();
            $exploder = explode('.', $getext);

            $rand = str_random(10);

            $name = Auth::user()->id.''.$rand .'.'. $exploder[1];

            $saver               = $files->move('images/fotosperfil', $name);
            $path                = '../../images/fotosperfil/';
            $profile_pic = $path . $name;
            $back_y = Input::get('back_Y');
            $back_x = Input::get('back_X');
            

            DB::table('users')->where('id', Auth::user()->id)->update(['background_pic' => $profile_pic]);
            DB::table('users')->where('id', Auth::user()->id)->update(['back_y' => $back_y]);
            DB::table('users')->where('id', Auth::user()->id)->update(['back_x' => $back_x]);
            
            }else{

                $back_y = Input::get('back_Y');
                $back_x = Input::get('back_X');
                DB::table('users')->where('id', Auth::user()->id)->update(['back_y' => $back_y]);
                DB::table('users')->where('id', Auth::user()->id)->update(['back_x' => $back_x]);

            }

            return Redirect::to('/users/wall?id='.Auth::user()->id.'');

        }else{

            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function yourFavorites()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $user = DB::table('users')->find($id);
        }
        $vi = DB::table('pv_uservideo')->where('pv_uservideo.id_user', $user->id)
                    ->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
                    ->select('videos.*')
                    ->orderBy('pv_uservideo.created_at', 'desc')
                    ->get();       
        return View::make('users.yourfavorites', array('sponsors' => $sponsors, 'favorites' => $vi));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function wall()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();

        $id = $_GET['id'];

        $comments = DB::table('comments')
            ->where('id_wall', $id)
            ->whereNull('id_comment')
            ->orderBy('created_at', 'desc')
            ->get();

        $user = DB::table('users')->where('id', $id)->first();

        $vi =  DB::table('pv_uservideo')->where('pv_uservideo.id_user', $id)
                ->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
                ->select('videos.*')
                ->orderBy('videos.name', 'asc')
                ->get();
 

            return View::make('users.wall', array('sponsors' => $sponsors, 'comments' => $comments,  'vi' => $vi));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function generalWall()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();

        $id = $_GET['id'];

        $comments = DB::table('comments')
            ->where('id_wall', $id)
            ->whereNull('id_comment')
            ->orderBy('created_at', 'desc')
            ->get();

        $user = DB::table('users')->where('id', $id)->first();


        $following = DB::table('favorites')
        ->where('id_user', $user->id)
        ->get();


        $commentArray = array();

        foreach ($comments as $c) {

            $commentArray[$c->id]['id']       = $c->id;
            $commentArray[$c->id]['id_user']  = $c->id_user;
            $commentArray[$c->id]['comment']  = $c->comment;
            $commentArray[$c->id]['title']    = $c->title;
            $commentArray[$c->id]['like']     = $c->like;
            $commentArray[$c->id]['type']     = $c->type;
            $commentArray[$c->id]['id_album'] = $c->id_album;
            $commentArray[$c->id]['date']     = $c->created_at;
            $commentArray[$c->id]['id_wall']  = $c->id_wall;
            $commentArray[$c->id]['id_band']  = null;

            /*

            $response = DB::table('comments')
                ->where('id_comment', $c->id)
                ->orderBy('created_at', 'asc')
                ->get();

            $responsesArray = array();

            foreach ($response as $resp) {

                $responsesArray[$resp->id]['id']       = $resp->id;
                $responsesArray[$resp->id]['id_user']  = $resp->id_user;
                $responsesArray[$resp->id]['response'] = $resp->comment;
                $responsesArray[$resp->id]['title']    = $resp->title;
                $responsesArray[$resp->id]['like']     = $resp->like;
                $responsesArray[$resp->id]['type']     = $resp->type;
                $responsesArray[$resp->id]['id_album'] = $resp->id_album;
                $commentArray[$resp->id]['date']       = $resp->created_at;

            }

            $commentArray[$c->id]['responses'] = $responsesArray;
            
            */
        }

        foreach ($following as $f) {

            if (!is_null($f->id_musician)) {

                $musician = DB::table('users')->where('id_musician', $f->id_musician)->first();

                $comments = DB::table('comments')
                ->where('id_wall', $musician->id_wall)
                ->whereNull('id_comment')
                ->orderBy('created_at', 'desc')
                ->get();

                foreach ($comments as $c) {

                    $commentArray[$c->id]['id']       = $c->id;
                    $commentArray[$c->id]['id_user']  = $c->id_user;
                    $commentArray[$c->id]['comment']  = $c->comment;
                    $commentArray[$c->id]['title']    = $c->title;
                    $commentArray[$c->id]['like']     = $c->like;
                    $commentArray[$c->id]['type']     = $c->type;
                    $commentArray[$c->id]['id_album'] = $c->id_album;
                    $commentArray[$c->id]['date']     = $c->created_at;
                    $commentArray[$c->id]['id_wall']  = $c->id_wall;
                    $commentArray[$c->id]['id_band']  = null;

                    /*

                    $response = DB::table('comments')
                        ->where('id_comment', $c->id)
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $responsesArray = array();

                    foreach ($response as $resp) {

                        $responsesArray[$resp->id]['id']       = $resp->id;
                        $responsesArray[$resp->id]['id_user']  = $resp->id_user;
                        $responsesArray[$resp->id]['response'] = $resp->comment;
                        $responsesArray[$resp->id]['title']    = $resp->title;
                        $responsesArray[$resp->id]['like']     = $resp->like;
                        $responsesArray[$resp->id]['type']     = $resp->type;
                        $responsesArray[$resp->id]['id_album'] = $resp->id_album;
                        $commentArray[$resp->id]['date']       = $resp->created_at;

                    }

                    $commentArray[$c->id]['responses'] = $responsesArray;
                    
                    */
                }
            }

            if (!is_null($f->id_band)) {

                $band = DB::table('bands')->where('id', $f->id_band)->first();

                $comments = DB::table('comments')
                ->where('id_band', $band->id)
                ->whereNull('id_comment')
                ->orderBy('created_at', 'desc')
                ->get();

                foreach ($comments as $c) {

                    $commentArray[$c->id]['id']       = $c->id;
                    $commentArray[$c->id]['id_user']  = $c->id_user;
                    $commentArray[$c->id]['comment']  = $c->comment;
                    $commentArray[$c->id]['title']    = $c->title;
                    $commentArray[$c->id]['like']     = $c->like;
                    $commentArray[$c->id]['type']     = $c->type;
                    $commentArray[$c->id]['id_album'] = $c->id_album;
                    $commentArray[$c->id]['date']     = $c->created_at;
                    $commentArray[$c->id]['id_band']  = $c->id_band;
                    $commentArray[$c->id]['id_wall']  = null;

                    /*

                    $response = DB::table('comments')
                        ->where('id_comment', $c->id)
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $responsesArray = array();

                    foreach ($response as $resp) {

                        $responsesArray[$resp->id]['id']       = $resp->id;
                        $responsesArray[$resp->id]['id_user']  = $resp->id_user;
                        $responsesArray[$resp->id]['response'] = $resp->comment;
                        $responsesArray[$resp->id]['title']    = $resp->title;
                        $responsesArray[$resp->id]['like']     = $resp->like;
                        $responsesArray[$resp->id]['type']     = $resp->type;
                        $responsesArray[$resp->id]['id_album'] = $resp->id_album;
                        $commentArray[$resp->id]['date']       = $resp->created_at;

                    }

                    $commentArray[$c->id]['responses'] = $responsesArray;
                    
                    */
                }
            }

            if (!is_null($f->id_fan)) {

                $fan = DB::table('users')->where('id', $f->id_fan)->first();

                $comments = DB::table('comments')
                ->where('id_wall', $fan->id_wall)
                ->whereNull('id_comment')
                ->orderBy('created_at', 'desc')
                ->get();

                foreach ($comments as $c) {

                    $commentArray[$c->id]['id']       = $c->id;
                    $commentArray[$c->id]['id_user']  = $c->id_user;
                    $commentArray[$c->id]['comment']  = $c->comment;
                    $commentArray[$c->id]['title']    = $c->title;
                    $commentArray[$c->id]['like']     = $c->like;
                    $commentArray[$c->id]['type']     = $c->type;
                    $commentArray[$c->id]['id_album'] = $c->id_album;
                    $commentArray[$c->id]['date']     = $c->created_at;
                    $commentArray[$c->id]['id_wall']  = $c->id_wall;
                    $commentArray[$c->id]['id_band']  = null;

                    /*

                    $response = DB::table('comments')
                        ->where('id_comment', $c->id)
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $responsesArray = array();

                    foreach ($response as $resp) {

                        $responsesArray[$resp->id]['id']       = $resp->id;
                        $responsesArray[$resp->id]['id_user']  = $resp->id_user;
                        $responsesArray[$resp->id]['response'] = $resp->comment;
                        $responsesArray[$resp->id]['title']    = $resp->title;
                        $responsesArray[$resp->id]['like']     = $resp->like;
                        $responsesArray[$resp->id]['type']     = $resp->type;
                        $responsesArray[$resp->id]['id_album'] = $resp->id_album;
                        $commentArray[$resp->id]['date']       = $resp->created_at;

                    }

                    $commentArray[$c->id]['responses'] = $responsesArray;
                    
                    */
                }
            }
        }



        $merged = array();
        
        foreach ($commentArray as $sp) {
                $merged[] = $sp;

        }

        $vi =  DB::table('pv_uservideo')->where('pv_uservideo.id_user', $id)
                ->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
                ->select('videos.*')
                ->orderBy('videos.name', 'asc')
                ->get();
 

            return View::make('walls.wall', array('sponsors' => $sponsors, 'comments' => $merged,  'vi' => $vi));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }

    }

      public function home_fan()
    {
         if (Auth::check()) {

            $blues = DB::table('videos')->where('id_genre', '1')->get();
            $country = DB::table('videos')->where('id_genre', '2')->get();
            $electronic = DB::table('videos')->where('id_genre', '3')->get();
            $folk = DB::table('videos')->where('id_genre', '4')->get();
            $hiphop = DB::table('videos')->where('id_genre', '5')->get();
            $jazz = DB::table('videos')->where('id_genre', '6')->get();
            $latin = DB::table('videos')->where('id_genre', '7')->get();
            $pop = DB::table('videos')->where('id_genre', '8')->get();
            $soul = DB::table('videos')->where('id_genre', '9')->get();
            $rock = DB::table('videos')->where('id_genre', '10')->get();

            $lastweek = date("d-m-Y", strtotime("last week monday")); 
            $thisweek = date("d-m-Y", strtotime("this week monday"));

            $semana = DB::table('videos')->whereBetween('upload_date', [$lastweek, $thisweek])->first();

            $vistas = DB::table('videos')->orderBy('views', 'desc')->take(9)->get();

            $vi = DB::table('videos')
            ->join('bands', 'bands.id', '=', 'videos.id_band')->where('favorite', '>', '0')
            ->select('bands.name', 'videos.*')
            ->take(9)
            ->get();

            $today = DB::table('videos')->orderBy('id', 'desc')->take(9)->get();

            $generos = $this->takeGenres();
            $sponsors = $this->takeSponsors();


             if (is_null($semana)) {

                $weeks = DB::table('videos')->orderBy('id', 'desc')->take(9)->get();
                return View::make('users.home_fan', array('sponsors' => $sponsors, 'generos' => $generos, 'weeks' => $weeks, 'vistas' => $vistas, 'vi' => $vi, 'today' => $today, 'blues' => $blues, 'country' => $country, 'electronic' => $electronic, 'folk' => $folk, 'hiphop' => $hiphop, 'jazz' => $jazz, 'latin' => $latin, 'pop' => $pop, 'soul' => $soul, 'rock' => $rock));

            }else{
                  
                $weeks = DB::table('videos')->whereBetween('upload_date', [$lastweek, $thisweek])->take(9)->get();
                return View::make('users.home_fan', array('sponsors' => $sponsors, 'generos' => $generos, 'weeks' => $weeks, 'vistas' => $vistas, 'vi' => $vi, 'today' => $today, 'blues' => $blues, 'country' => $country, 'electronic' => $electronic, 'folk' => $folk, 'hiphop' => $hiphop, 'jazz' => $jazz, 'latin' => $latin, 'pop' => $pop, 'soul' => $soul, 'rock' => $rock));

            }
       

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }
    public function takeVideos()
    {
        return Videos::all();
    }

    public function takeGenres()
    {
        return Genres::all();
    }

    public function takeSponsors()
    {
        return Sponsors::all();
    }
    public function createfan()
    {
         if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        return View('users.create_fan', array('sponsors' => $sponsors));
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

  /* public function addView()
    {
    	try {
    		$video = DB::table('videos')->find(Request::get('id'));
    		$video->views = $video->views + 1;

            DB::table('videos')->where('id', Request::get('id'))->update(['views' => $video->views]);
            DB::table('battles')->where('id_video', Request::get('id'))->update(['views' => $video->views]);

    		return 1;

    	} catch (\Exception $e) {
    		return $e;
    	}
    }

*/

    public function addView()
    {

        $relation = $this->verifyView(Request::get('id'));
  
        if($relation != false)
        {

            $video = Videos::find(Request::get('id'));

            if ($video->views == 0) {

                $video->views = 0;
                $video->save();

            }else{

                $video->views = $video->views;
                $video->save();
            }


        }else{

            $video = DB::table('videos')->find(Request::get('id'));
            $video->views = $video->views + 1;

            DB::table('videos')->where('id', Request::get('id'))->update(['views' => $video->views]);
            DB::table('battles')->where('id_video', Request::get('id'))->update(['views' => $video->views]);

            $uv = new PVVideoView;
            $uv->id_video = Request::get('id');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            if (is_null($video->id_musician)) {
                $user = DB::table('users')->where('id_band', $video->id_band)->first();
            }else{
                $user = DB::table('users')->where('id_musician', $video->id_musician)->first();
            }
            

            if ($user->id != Auth::user()->id) {
                
                $notification = new Notifications;
                $notification->comment = '¡'.Auth::user()->name.' ha visto tu video!';
                $notification->type = 'view';
                $notification->id_user = $user->id;
                $notification->id_band = $video->id_band;
                $notification->id_video = $video->id;
                $notification->seen = 'N';
                $notification->save();
                    
            }

            return 1;

        }

    }

    public function verifyView($id_video)
    {

        $pvuservideo = DB::table('pv_videoview')->where('id_user', Auth::user()->id)->where('id_video', $id_video)->first();

        if (is_null($pvuservideo)) {

            return false;

        }else{
            
            return $pvuservideo->id;
        }
    }


     public function mostviews()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $vistas = DB::table('videos')->orderBy('name', 'asc')->get();
        return View::make('users.mostviews', array('sponsors' => $sponsors, 'vistas' => $vistas));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }


    }

    public function thisweek()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $lastweek = date("d-m-Y", strtotime("last week monday")); 
        $thisweek = date("d-m-Y", strtotime("this week monday"));

        $semana = DB::table('videos')->whereBetween('upload_date', [$lastweek, $thisweek])->first();

           if (is_null($semana)) {

                $weeks = DB::table('videos')->orderBy('name', 'asc')->take(9)->get();
                
                return View::make('users.thisweek', array('sponsors' => $sponsors, 'weeks' => $weeks));

            }else{
                  
                $weeks = DB::table('videos')
                ->whereBetween('upload_date', [$lastweek, $thisweek])
                ->orderBy('name', 'asc')
                ->get();

                return View::make('users.thisweek', array('sponsors' => $sponsors, 'weeks' => $weeks));

            }
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function lastadded()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $today = DB::table('videos')->orderBy('name', 'asc')->take(9)->get();
        return View::make('users.lastadded', array('sponsors' => $sponsors, 'today' => $today));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function favorites()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $vi = DB::table('videos')
            ->join('bands', 'bands.id', '=', 'videos.id_band')->where('favorite', '>', '0')
            ->select('bands.name', 'videos.*')
            ->orderBy('videos.name', 'asc')
            ->get();
        return View::make('users.favorites', array('sponsors' => $sponsors, 'vi' => $vi));
        

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }
    
    public function verifyFollowerFan($iduser)
    {

        $favorite = DB::table('favorites')->where('id_user', Auth::user()->id)->where('id_fan', $iduser)->first();

        if (is_null($favorite)) {

            return false;

        }else{
            
            return $favorite->id;
        }
    }

    public function addFollowerFan()
    {

        $relation = $this->verifyFollowerFan(Request::get('iduser'));

  
        if($relation != false)
        {

            $fan = User::find(Request::get('iduser'));

            if ($fan->followers == 0) {

                $fan->followers = 0;
                $fan->save();
                $rela = Favorites::find($relation);
                $rela->delete();

            }else{

                $fan->followers = $fan->followers - 1;
                $fan->save();
                $rela = Favorites::find($relation);
                $rela->delete();
            }

        }else{


            $fan = User::find(Request::get('iduser'));
            $fan->followers = $fan->followers + 1;
            $fan->save();

            $uv = new Favorites;
            $uv->id_fan = Request::get('iduser');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            $noto = DB::table('users')->where('id', $fan->id)->first();
                $notification2 = new Notifications;
                $notification2->comment = '¡'.Auth::user()->name.' te ha comenzado a seguir!';
                $notification2->id_user = $noto->id;
                $notification2->seen = 'N';
                $notification2->save();


            $user = User::find(Auth::user()->id);
                $user->activity_count = $user->activity_count + 1;
                $user->save();

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Follow fan';
                $activity->save();

            return 1;

        }


    }
}
