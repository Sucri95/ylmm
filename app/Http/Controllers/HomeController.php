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
use Image;
use App\User;
use App\Videos;
use App\Sponsors;
use App\Genres;
use App\Bands;
use App\Notifications;


class HomeController extends Controller
{

    public function home_view()
    {
        $lastweek = date("d-m-Y", strtotime("last week sunday")); 
        $thisweek = date("d-m-Y", strtotime("this week sunday"));

        $semana = DB::table('battles')
                    ->orderBy('votes', 'desc')
                    ->whereBetween('date', [$lastweek, $thisweek])
                    ->take(10)
                    ->get();
                    
        $vistas = DB::table('battles')
                    ->where('llave', '2')
                    ->orderBy('votes', 'desc')
                    ->take(10)
                    ->get();

        $today = DB::table('videos')->orderBy('created_at', 'desc')->take(10)->get();
        
        $generos = $this->takeGenres();
        $sponsors = $this->takeSponsors();


         if ($semana == '[]') {

            $weeks = DB::table('battles')
                    ->orderBy('votes', 'desc')
                    ->take(10)
                    ->get();

            return View::make('/home', array('generos' => $generos, 'sponsors' => $sponsors, 'weeks' => $weeks, 'vistas' => $vistas, 'today' => $today));

        }else{
              
            $weeks = DB::table('battles')
                    ->orderBy('votes', 'desc')
                    ->take(10)
                    ->get();

            return View::make('/home', array('generos' => $generos, 'sponsors' => $sponsors, 'weeks' => $weeks, 'vistas' => $vistas, 'today' => $today));

        }
    }

    public function makeResults()
    {
        if (Auth::check()) {
            
            $sponsors =$this->takeSponsors();
            $name = $_GET['search'];

                $band = DB::table('bands')
                ->select('id', 'name', 'profile_pic')
                ->where('name', 'LIKE', '%'.$name.'%')
                ->get();

                $user = DB::table('users')
                ->select('id','name', 'profile_pic', 'user_level')
                ->where('name', 'LIKE', '%'.$name.'%')
                ->get();

                $videos = DB::table('videos')
                ->select('id','name', 'url', 'id_band')
                ->where('name', 'LIKE', '%'.$name.'%')
                ->get();
      
                    return View::make('/searchresults', array('bands' => $band, 'user' => $user, 'videos' => $videos, 'sponsors' => $sponsors));
        }else{

              return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function search_get() {

        $name = $_GET['search'];

        $band   = DB::table('bands')->select('id', 'name', 'profile_pic')->where('name', 'LIKE', '%'.$name.'%')->get();
		$user   = DB::table('users')->select('id','name', 'profile_pic', 'user_level')->where('name', 'LIKE', '%'.$name.'%')->get();
		$videos = DB::table('videos')->select('id','name', 'url', 'id_band', 'id_musician', 'id_user')->where('name', 'LIKE', '%'.$name.'%')->get();
      
        return array('bands' => $band, 'user' => $user, 'videos' => $videos);
    }

   public function search_members() {

        $name = $_GET['members'];

       
        $user   = DB::table('users')
        		->select('id','name', 'profile_pic', 'user_level', 'email')
        		->where('name', 'LIKE', '%'.$name.'%')
        		->where('id_band', null)
        		->get();
       
      
        return array('user' => $user);
    }

    public function make_login()
    {
        $sponsors = $this->takeSponsors();
        return View::make('login', array('sponsors' => $sponsors));
    }
    public function registro()
    {
        $sponsors =$this->takeSponsors();
        return View::make('registro', array('sponsors' => $sponsors));
    }
    public function home()
    {
        return View::make('home');
    }

    public function logout()
    {
        Auth::logout();
        
        $videos =  $this->takeVideos();
        $sponsors = $this->takeSponsors();

        return Redirect::to('/?msg=7');

    }

    public function redirectToProvider()
    {
        return Socialite::with('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $very = 0;
        $veryq = User::where('email', '=', $user->email)->get();
        $very = count($veryq);
        $rand = str_random(10);
        $name = $rand .'.jpg';

        $path = 'images/fotosperfil/'.$name;

        $image = Image::make($user->avatar)->save($path);

            if($very == 0){

                $userdata = new User;
                $userdata->name = $user->name;
                $userdata->email = $user->email;
                $userdata->password = $user->id;
                $userdata->profile_pic ='../../images/fotosperfil/'. $name;
                $userdata->save();

                DB::table('users')->where('id', $userdata->id)->update(['id_wall' => $userdata->id]);
                DB::table('users')->where('id', $userdata->id)->update(['status' => 'A']);

                Auth::loginUsingId($userdata->id);

                return Redirect::to('/dataupdate');

        }else{

            Auth::loginUsingId($veryq[0]->id);

                if ($veryq[0]->verified == 0) {

                   return Redirect::to('/dataupdate');

                }else{

                    if ($veryq[0]->user_level == '4' || $veryq[0]->user_level == '1' || $veryq[0]->user_level == '5') {
                
                        return Redirect::to('/users/wall?id='.$veryq[0]->id.'&msg=5');
                
                    }
                    
                    if ($veryq[0]->user_level == '3') {
                    
                        return Redirect::to('/bands/comments?id='.$veryq[0]->id_band.'&msg=5&¡Bienvenido!&título=SUCCESS');
                
                    }

                }
        }        
        
    }

     public function redirectToProviderFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        if (is_null($user->email)) {
           return Redirect::to('/login?var=0&msg=9'); 
        }

        $very = 0;
        $veryq = User::where('email', '=', $user->email)->get();
        $very = count($veryq);

        $rand = str_random(10);
        $name = $rand .'.jpg';

        $path = 'images/fotosperfil/'.$name;

        $image = Image::make($user->avatar)->save($path);

            if($very == 0){

                $userdata = new User;
                $userdata->name = $user->name;
                $userdata->email = $user->email;
                $userdata->password = $user->id;
                $userdata->profile_pic ='../../images/fotosperfil/'. $name;
                $userdata->save();

                DB::table('users')->where('id', $userdata->id)->update(['id_wall' => $userdata->id]);
                DB::table('users')->where('id', $userdata->id)->update(['status' => 'A']);

                Auth::loginUsingId($userdata->id);

                return Redirect::to('/dataupdate');

        }else{

            Auth::loginUsingId($veryq[0]->id);

                if ($veryq[0]->verified == 0) {

                   return Redirect::to('/dataupdate');

                }else{

                    if ($veryq[0]->user_level == '4' || $veryq[0]->user_level == '1' || $veryq[0]->user_level == '5') {
                
                        return Redirect::to('/users/wall?id='.$veryq[0]->id.'&msg=5');
                
                    }
                    
                    if ($veryq[0]->user_level == '3') {
                    
                        return Redirect::to('/bands/comments?id='.$veryq[0]->id_band.'&msg=5');
                
                    }

                }
        }        
    }

    public function takeVideos()
    {
        return Videos::all();
    }

    public function takeSponsors()
    {
        return Sponsors::all();
    }
    
    public function takeGenres()
    {
        return Genres::all();
    }

    public function index()
    {
        return view('/');
    }

    public function login()
    {
        $videos = $this->takeVideos();
        $sponsors =$this->takeSponsors();
        $var = Input::get('type');

        $user = DB::table('users')->where('email', Input::get('email'))->first();

        if (is_null($user)) {
           return Redirect::to('/login?var=0&msg=7&Usuario o clave inválida&título=ERROR'); 
        }

        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
             );

        if ($user->verified == '0') {

             if ($var == 0) {
                    
                    return Redirect::to('/login?var=0&msg=8?¡Su email no ha sido verificado, por favor dirígase a su correo electrónico y verifique su email!&título=ERROR');

                }else{

                    return Redirect::to('/login?var=1&msg=8?¡Su email no ha sido verificado, por favor dirígase a su correo electrónico y verifique su email!&título=ERROR');

                }    

        }else{
       
            if(Auth::attempt($userdata)){

                return Redirect::to('/wall?id='.$user->id.'&msg=5&¡Bienvenido!&título=SUCCESS');

            }else{

               return Redirect::to('/login?var=0&msg=7&Usuario o clave inválida&título=ERROR'); 
            }
        }
    }
}
