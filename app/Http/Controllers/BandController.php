<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Request;
use App\Bands;
use Auth;
use Table;
use View;
use Hash;
use Mail;
use Redirect;
use App\User;
use App\Sponsors;
use App\Members;
use App\Videos;
use App\Battles;
use App\Notifications;
use App\PVBands;
use App\PVUserVideo;
use App\Activities;
use App\Favorites;
use App\Genres;
use App\Musicians;

class BandController extends Controller
{

    public function showFollowers()
    {
         if (Auth::check()) {

            $sponsors = $this->takeSponsors();


            $id = $_GET['id'];

            $bands = DB::table('bands')->where('id', $id)->first();

                $favorites = DB::table('favorites')
                ->where('id_band', $bands->id)
                ->get();


            $users = User::all();

                return View::make('bands.followers', array('sponsors' => $sponsors, 'favorites' => $favorites, 'users' => $users));

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }


	public function editNameBand(){

        if (Auth::check()) {

        	$name = Input::get('name');

            $band = DB::table('bands')->where('id', Auth::user()->id_band)->first();

            DB::table('bands')->where('id', $band->id)->update(['name' => $name]);

            $battles = DB::table('battles')->where('id_band', $band->id)->get();
            $videos = DB::table('videos')->where('id_band', $band->id)->get();

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

            return Redirect::to('bands/comments?id='.Auth::user()->id_band.'');

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

            $saver               = $files->move('images/fotosperfil/', $name);
            $path                = '../../images/fotosperfil/';
            $profile_pic = $path . $name;
            

            DB::table('bands')->where('id', Auth::user()->id_band)->update(['profile_pic' => $profile_pic]);

            if (Auth::user()->user_level == 5) {

                DB::table('users')->where('id', Auth::user()->id)->update(['profile_pic' => $profile_pic]);
            }

            return Redirect::to('/bands/comments?id='.Auth::user()->id_band.'');

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

            $saver               = $files->move('images/fotosperfil/', $name);
            $path                = '../../images/fotosperfil/';
            $profile_pic = $path . $name;
            $back_y = Input::get('back_Y');
            $back_x = Input::get('back_X');
            
            DB::table('bands')->where('id', Auth::user()->id_band)->update(['back_y' => $back_y]);
            DB::table('bands')->where('id', Auth::user()->id_band)->update(['back_x' => $back_x]);
            

            DB::table('bands')->where('id', Auth::user()->id_band)->update(['background_pic' => $profile_pic]);

            if (Auth::user()->user_level == 5) {

                DB::table('users')->where('id', Auth::user()->id)->update(['background_pic' => $profile_pic]);
            }

            
            }else{


                $back_x = Input::get('back_X');
                $back_y = Input::get('back_Y');
                DB::table('bands')->where('id', Auth::user()->id_band)->update(['back_x' => $back_x]);
                DB::table('bands')->where('id', Auth::user()->id_band)->update(['back_y' => $back_y]);  
            
            }

            return Redirect::to('/bands/comments?id='.Auth::user()->id_band.'');
            

        }else{

            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

	 public function membersValidator()
    {
        $token = $_GET['token'];

        $id = $_GET['id'];

        $idband = $_GET['idband'];

        $role = $_GET['role'];

        $user = User::find($id);
        $band = Bands::find($idband);
        $password = Hash::check($user->email, $token);

        if ($password == true) {

        	$members = new Members;
        	$members->verified = 'Y';
        	$members->id_user = $user->id;
        	$members->id_band = $band->id;
        	$members->role = $role;

        	$members->save();
            
            DB::table('users')->where('id', $members->id_user)->update(['id_band' => $members->id_band]);
            DB::table('users')->where('id', $members->id_user)->update(['user_level' => '3']);

            $user = DB::table('users')->where('id', $members->id_user)->first();

            if (is_null($user->id_musician)) {
                $musician = new Musicians;
                $musician->artistic_name = $user->name;
                $musician->role = $role;
                $musician->genres = $band->id_genre;
                $musician->id_user = $user->id;
                $musician->save();

                DB::table('users')->where('id', $members->id_user)->update(['id_musician' => $musician->id]);
            }

            $notification = new Notifications;
        	$notification->comment = '¡Te has unido a una banda!';
        	$notification->id_user = $user->id;
        	$notification->id_band = $band->id;
        	$notification->seen = 'N';
        	$notification->save();

        	$noto = DB::table('users')->where('id', '<>', $user->id)->where('id_band', $band->id)->first();

        	$notification = new Notifications;
        	$notification->comment = '¡'.$user->name.' ha aceptado la solicitud para unirse a tu banda!';
            $notification->href    = '/users/wall?id='.$user->id.'';
        	$notification->id_user = $noto->id;
        	$notification->id_band = $band->id;
        	$notification->seen = 'N';
        	$notification->save();

            return Redirect::to('/bands/comments?id='.$band->id.'&msg=¡SOS PARTE DE UNA BANDA! Bienvenido a You Love My Music');
       }else{

        return Redirect::to('/?msg=Ha ocurrido un error, por favor intente de nuevo');
       }
   }
    
     public function addmember()
    {
        if (Auth::check()) {

            $users = DB::table('users')->where('email',  Input::get('id_user'))->first();

            $very = Members::where('id_user',  $users->id)->count();
            $idband = Input::get('id_band');

        if ($very > 0){
            
            return Redirect::to('/bands/about?id='.$idband.'&msg='.utf8_encode("Integrante ya pertenece a una banda").'&titulo='.utf8_encode('Información'));
        
        	}else{

        	$bands = DB::table('bands')->find(Input::get('id_band'));

        	$notification = new Notifications;
        	$notification->comment = '¡Has enviado una solicitud para agregar un integrante a tu banda!';
        	$notification->id_user = Auth::user()->id;
        	$notification->id_band = Auth::user()->id_band;
        	$notification->seen = 'N';
        	$notification->save();

            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' te ha enviado un email de invitación a su banda!';
            $notification->href    = '/users/wall?id='.Auth::user()->id.'';
            $notification->id_user = $users->id;
            $notification->id_band = Auth::user()->id_band;
            $notification->seen = 'N';
            $notification->save();

            $topica['especificaciones'] = Hash::make($users->email);
                
                $user = $users;
                $band = $bands->id;
                $role = serialize(Input::get('role'));
                $admin = Auth::user()->name;
                $data = ['user' => $user, 'topica' => $topica, 'band' => $band, 'role' => $role, 'admin' => $admin];

                if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

                    Mail::send('members', $data, function($message) use ($topica, $user)
                        {
                            $message->to($user->email)->subject('YLMM - Te han invitado a formar parte de una banda');
                        });
        
        		}
    		}
            
            return Redirect::to('/bands/about?id='.$idband.'&msg=7');
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
       
	}

    public function addmemberview()
    {
        if (Auth::check()) {
            $sponsors = $this->takeSponsors();
            return View::make('bands.addmember', array('sponsors' => $sponsors));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function login()
    {
        if (Auth::check()) {
            $sponsors = $this->takeSponsors();
            return View::make('bands.login', array('sponsors' => $sponsors));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function bandlogin()
    {
        if (Auth::check()) {

            $band = DB::table('bands')->where('email', Input::get('email'))->first();

            if ($band != null) {

            	$password = Hash::check(Input::get('password'), $band->password);
           
			        if ($password == true) {
			               
			               $sponsors = $this->takeSponsors();

			                return Redirect::to('/bands/addmember?idband='.$band->id.'');

			           }else{

			                return Redirect::to('/bands/login?msg='.utf8_encode("Los datos ingresados son incorrectos").'&titulo='.utf8_encode('Información'));
			           
			           }
            }else{

            	return Redirect::to('/bands/login?msg='.utf8_encode("Los datos ingresados son incorrectos").'&titulo='.utf8_encode('Información'));
            }

        
        }else{

             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }

    }

    public function about()
    {
        if (Auth::check()) {
            $sponsors = $this->takeSponsors();
            return View::make('bands.about', array('sponsors' => $sponsors));
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    	
    }

    public function editAbout()
    {
       if (Auth::check()) {

            $bands = Bands::find(Input::get('id_band'));

            DB::table('bands')->where('id', $bands->id)->update(['about' => Input::get('about')]);

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function setBandAbout()
    {
       if (Auth::check()) {

            $bands = Bands::find(Input::get('id_band'));

            DB::table('bands')->where('id', $bands->id)->update(['about' => Input::get('setabout')]);

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function editMember()
    {
       if (Auth::check()) {

            $members = Members::find(Input::get('id_member'));

             $roles = Input::get(''.$members->id.'_role');

             if (!is_null($roles)) {
             	
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

	            DB::table('members')->where('id', $members->id)->update(['role' => $role]);
             }

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function editGenre()
    {
        if (Auth::check()) {

            $band = Bands::find(Input::get('id_band'));

            $genres = Input::get('id_genre');

            if (Input::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Input::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);

            $genre = serialize($mgenre);

            DB::table('bands')->where('id', $band->id)->update(['id_genre' => $genre]);

            return back();
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function deleteMember()
    {
       if (Auth::check()) {

            $member = Members::find(Request::get('id'));

            $user = User::find(Request::get('id_user'));

            $band = Bands::find($member->id_band);

            DB::table('users')->where('id', $user->id)->update(['id_band' => null]);
            DB::table('users')->where('id', $user->id)->update(['user_level' => '5']);


            $member->delete();

            $members = Members::all();

            $very = 0;

            foreach ($members as $member) {
                if ($member->id_band == $band->id) {
                    $very = 1;
                }
            }

            if ($very == 1) {

               return "Integrante eliminado";

            }else{

                $battles = DB::table('battles')->where('id_band', $band->id)->get();
                $videos = DB::table('videos')->where('id_band', $band->id)->get();

                if (!is_null($battles)) {

                   foreach ($battles as $battle) {

                   		$video = Battles::find($battle->id);

                        $video->delete();

                    }
                }

                if (!is_null($videos)) {
                    
                   foreach ($videos as $video) {

		           		$video1 = Videos::find($video->id);

		                $video1->delete();

                    }
                }

                $band->delete();


               return Request::get('id_user');
            
            }
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function comments()
    {
        if (Auth::check()) {

        $id = $_GET['id'];

        $comments = DB::table('comments')
            ->where('id_band', $id)
            ->whereNull('id_comment')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $vi =  DB::table('battles')->where('id_band', $id)
         		->orderBy('votes', 'desc')
                ->get();

        $sponsors = $this->takeSponsors();       

         return View::make('bands.comments', array('sponsors' => $sponsors, 'comments' => $comments, 'videos' => $vi));
       
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
       
    }
    
    public function home_band()
    {
        if (Auth::check()) {

            $id = $_GET['idband'];
            $banda = DB::table('bands')->find($id);
            $videos = DB::table('videos')->where('id_band', $banda->id)->orderBy('upload_date', 'desc')->get();
            $sponsors = $this->takeSponsors();
            
            
            return View::make('bands.home_band', array('sponsors' => $sponsors, 'videos' => $videos, 'banda' => $banda));
       
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function band_comments()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $banda = Bands::find(1);
        
        return View::make('bands.band_comments', array('sponsors' => $sponsors, 'banda' => $banda));
        

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

    public function takeBands()
    {
        return DB::table('bands')->where('id','=', '1')->get();
    }

      public function make_bands()
    {
        if (Auth::check()) {

        $sponsors =$this->takeSponsors();
        $genres = $this->takeGenres();

        return View::make('/bandsregistration', array('sponsors' => $sponsors, 'genres' => $genres));

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

   public function creator()
    {
        if (Auth::check()) {

        $band = new Bands;

        $counter = Input::get('number_array') - 1;
        $user_array = Input::get('user_array');
        $members = explode('__', $user_array);
        $very = 0;
        

        $band->name = Input::get('name');
        $genres = Input::get('id_genre');

            if (Input::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Input::get('other')));
            }
            
        $mgenre[] = '';

        $mgenre = array_merge($mgenre, $genres);

        $band->id_genre = serialize($mgenre);

        $band->status      = 'A';
        $band->admin      = Auth::user()->id;
        $band->profile_pic = '../../images/avatar.jpg';

        $band->save();



        for ($i=0; $i <= $counter; $i++) {
        

            $users = DB::table('users')->where('email', $members[$i])->first();

            if ($users->id == Auth::user()->id) {
                $very = 1;
            }

            $topica['especificaciones'] = Hash::make($users->email);
                
                $user = $users;
                $idband = $band->id;
                $roles = Input::get('role_'.$i.'');

                if (Input::get('cuerda_'.$i.'') != '') {

                    $roles = array_diff($roles, ["cuerda"]);

                    array_push($roles, Input::get('cuerda_'.$i.''));
                }
                if (Input::get('viento_'.$i.'') != '') {

                    $roles = array_diff($roles, ["viento"]);

                    array_push($roles, Input::get('viento_'.$i.''));
                }
                if (Input::get('otro_'.$i.'') != '') {

                    $roles = array_diff($roles, ["otro"]);

                    array_push($roles, Input::get('otro_'.$i.''));
                }

            $role = serialize($roles);

            $admin = Auth::user()->name;

            $data = ['user' => $user, 'topica' => $topica, 'band' => $idband, 'role' => $role, 'admin' => $admin];

                if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

                    Mail::send('members', $data, function($message) use ($topica, $user)
                        {
                            $message->to($user->email)->subject('YLMM - Te han invitado a formar parte de una banda');
                        });
        
                }
        }



        if ($band->name == '') {

            return Redirect::to('/bandsregistration?msg='.utf8_encode("Debe llenar todos los campos").'&titulo='.utf8_encode('ALERTA').'&cl=gritter-rojo');    
        
        }else{

            DB::table('users')->where('id', Auth::user()->id)->update(['id_band' => $band->id]);
            DB::table('users')->where('id', Auth::user()->id)->update(['user_level' => '3']);

            $members = new Members;
	        $members->verified = 'Y';
	        $members->id_user = Auth::user()->id;
	        /*Find Musician Role*/

	        	$musician = DB::table('musicians')->where('id', Auth::user()->id_musician)->first();

	        /*-----*/
	        $members->id_band = $band->id;
	        $members->role = $musician->role;

	        $members->save();       

            $notification = new Notifications;
            $notification->comment = '¡Has creado tu banda!';
            $notification->id_user = Auth::user()->id;
            $notification->id_band = $band->id;
            $notification->seen = 'N';
            $notification->save();

            $notification = new Notifications;
            $notification->comment = '¡Has enviado solicitudes para formar parte de tu banda!';
            $notification->id_user = Auth::user()->id;
            $notification->id_band = $band->id;
            $notification->seen = 'N';
            $notification->save();
            
            return Redirect::to('/bands/comments?id='.$band->id.'&msg=7');
        
        };

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function verifyFavorite($id_band)
    {

        $favorite = DB::table('favorites')->where('id_user', Auth::user()->id)->where('id_band', $id_band)->first();

        if (is_null($favorite)) {

            return false;

        }else{
            
            return $favorite->id;
        }
    }

    public function addFan()
    {

        $relation = $this->verifyFavorite(Request::get('id_band'));
  
        if($relation != false)
        {

            $band = Bands::find(Request::get('id_band'));

            if ($band->favorite == 0) {

                $band->favorite = 0;
                $band->save();
                $rela = Favorites::find($relation);
                $rela->delete();

            }else{

                $band->favorite = $band->favorite - 1;
                $band->save();
                $rela = Favorites::find($relation);
                $rela->delete();
            }

        }else{


            $band = Bands::find(Request::get('id_band'));
            $band->favorite = $band->favorite + 1;
            $band->save();

            $uv = new Favorites;
            $uv->id_band = Request::get('id_band');
            $uv->id_user = Auth::user()->id;
            $uv->save();


            $user = DB::table('users')->where('id_band', $band->id)->first();
            

            if ($user->id != Auth::user()->id) {
                
                $notification = new Notifications;
                $notification->comment = '¡'.Auth::user()->name.' marcó tu banda como favorita!';
                $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                $notification->id_user = $user->id;
                $notification->id_band = $band->id;
                $notification->seen = 'N';
                $notification->save();
                    
            }

                DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Marcó banda como favorita';
                $activity->save();

        }

    }

    
    public function videoLike()
    {

        $relation = $this->verifyLikes(Request::get('id_video'));
  
        if($relation != false)
        {

            $videos = Videos::find(Request::get('id_video'));
            $videosBattles = Battles::find(Request::get('id_video'));

            if ($videos->likes == 0) {

                $videos->likes = 0;
                $videos->save();
                $videosBattles->likes = 0;
                $videosBattles->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();

            }else{

                $videos->likes = $videos->likes - 1;
                $videos->save();
                $videosBattles->likes = $videosBattles->likes - 1;
                $videosBattles->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();
            }

            return 0;

        }else{


            $videos = Videos::find(Request::get('id_video'));
            $videosBattles = Battles::find(Request::get('id_video'));

            $videos->likes = $videos->likes + 1;
            $videos->save();
            $videosBattles->likes = $videosBattles->likes + 1;
            $videosBattles->save();

            $concurso = DB::table('battles')->where('id_video', Request::get('id_video'))->first();
            $votos = $concurso->votes + 1;
            DB::table('battles')->where('id_video', Request::get('id_video'))->update(['votes' => $votos]);
            DB::table('battles')->where('id_video', Request::get('id_video'))->update(['likes' => $videosBattles->likes]);
            
            $uv = new PVUserVideo;
            $uv->id_video = Request::get('id_video');
            $uv->id_user = Auth::user()->id;
            $uv->save();


            if (is_null($videos->id_musician)) {
                $user = DB::table('users')->where('id_band', $videos->id_band)->first();
            }else{
                $user = DB::table('users')->where('id_musician', $videos->id_musician)->first();
            }
            

            if ($user->id != Auth::user()->id) {
                
                $notification = new Notifications;
                $notification->comment = '¡A '.Auth::user()->name.' le gusta tu video!';
                $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                $notification->type = 'like';
                $notification->id_user = $user->id;
                if (is_null($videos->id_musician)) {
                    $notification->id_band = $videos->id_band;
                }else{
                    $notification->id_musician = $videos->id_musician;
                }
                
                $notification->id_video = $videos->id;
                $notification->seen = 'N';
                $notification->save();
                    
            }
                DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Like video';
                $activity->save();

            return 1;
        }

    }

    public function verifyLikes($id_video)
    {

        $pvuservideo = DB::table('pv_uservideo')->where('id_user', Auth::user()->id)->where('id_video', $id_video)->first();

        if (is_null($pvuservideo)) {

            return false;

        }else{
            
            return $pvuservideo->id;
        }
    }

}
