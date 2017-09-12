<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Genres;
use App\Sponsors;
use App\Bands;
use App\Videos;
use App\Activities;
use Redirect;
use Hash;
use Mail;
use App\Notifications;


class AdminController extends Controller
{

	public function makeFollowers()
    {
         if (Auth::check()) {

         	$id = $_GET['id'];

         	$user = DB::table('users')->where('id', $id)->first();

            $sponsors = $this->takeSponsors();

            if (!is_null($user->id_musician)) {

	           	$favorites = DB::table('favorites')
	            ->where('id_musician', $user->id_musician)
	            ->get();

	        }else{

	        	$favorites = DB::table('favorites')
	            ->where('id_fan', $user->id)
	            ->get();

	        }


            $users = User::all();

                return View::make('users.followers', array('sponsors' => $sponsors, 'favorites' => $favorites, 'users' => $users ));

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

   	public function makeFollowings()
    {
         if (Auth::check()) {

            $sponsors = $this->takeSponsors();


         	$id = $_GET['id'];

         	$user = DB::table('users')->where('id', $id)->first();

	        	$favorites = DB::table('favorites')
	            ->where('id_user', $user->id)
	            ->get();


            $users = User::all();

            $bands = Bands::all();

                return View::make('users.followings', array('sponsors' => $sponsors, 'favorites' => $favorites, 'users' => $users, 'bands' => $bands));

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

	public function setPasswordFan()
    {
         if (Auth::check()) {

            $password = Hash::make(Input::get('password'));
            $country = Input::get('selectedcountry');
            $province = Input::get('selectedprovince');

            DB::table('users')->where('id', Auth::user()->id)->update(['country' => $country]);
            DB::table('users')->where('id', Auth::user()->id)->update(['province' => $province]);
            DB::table('users')->where('id', Auth::user()->id)->update(['verified' => '1']);
            if (!is_null(Auth::user()->id_musician)) {
               $mu = DB::table('musicians')->where('id_user', '=', Auth::user()->id)->delete();
            }
            DB::table('users')->where('id', Auth::user()->id)->update(['id_musician' => null]);
            DB::table('users')->where('id', Auth::user()->id)->update(['user_level' => '4']);

            $notification = new Notifications;
                $notification->comment = '¡Has actualizado tus datos!';
                $notification->id_user = Auth::user()->id;
                $notification->seen = 'N';
                $notification->save();

                return Redirect::to('/users/wall?id='.Auth::user()->id.'&msg=5&¡Bienvenido!&título=SUCCESS');

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function makePasswordFan()
    {
         if (Auth::check()) {

            $sponsors = $this->takeSponsors();

                return View::make('fansregistration', array('sponsors' => $sponsors));

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function setPassword()
    {
         if (Auth::check()) {

            $type = Input::get('type');


            if ($type == 'F') {

                DB::table('users')->where('id', Auth::user()->id)->update(['user_level' => '4']);

                return Redirect::to('/fansregistration');

            }else{

                DB::table('users')->where('id', Auth::user()->id)->update(['user_level' => '3']);

                return Redirect::to('/musicianregistration');

            }

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }

    public function makePassword()
    {
         if (Auth::check()) {

            $sponsors = $this->takeSponsors();

                return View::make('setpassword', array('sponsors' => $sponsors));

        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
        
    }
	 public function home_fan()
    {
         if (Auth::check()) {

        $videos = $this->takeVideos();
        $sponsors = $this->takeSponsors();
        return View::make('users.home_fan', array('videos' => $videos), array('sponsors' => $sponsors));

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
    
    public function registro()
    {
        $sponsors =$this->takeSponsors();
        $genres = $this->takeGenres();
        return View::make('registro', array('sponsors' => $sponsors, 'genres' => $genres));
    }

    public function creator()
	{ 

        $fan = new User;
        $very = User::where('email','=',  Input::get('email'))->count();

        if ($very > 0){
            
            return Redirect::to('/registro?msg=2&Mail Rpetido&título=ERROR'); 
        
        }else{      

            $fan->email = Input::get('email');

        }

        $fan->name        = Input::get('name');
        $fan->password    = Hash::make(Input::get('password'));
        $fan->country     = Input::get('selectedcountry');
        $fan->province    = Input::get('selectedprovince');
        $fan->zipcode     = Input::get('zipcode');
        $fan->profile_pic = '../../images/avatar.jpg';
        $fan->status      = 'A';

        if (Input::get('type') == 'B') {
            
            $fan->user_level  = '5';
        
        }else{

            $fan->user_level  = '4';

        }
        
        $fan->verified    = '0';
        $fan->email_token = Hash::make($fan->password);
        
        $genres = Input::get('id_genre');
        $fan->id_genre = serialize($genres);        

        if ($fan->name == '' || $fan->password == '' || $fan->province == '' || $fan->email == '' ) {

            return Redirect::to('/registro?msg=3&Debe llenar todos los campos&título=ERROR');    
        
        }else{
            
           $fan->id_wall = $fan->id;
           $fan->save();

            $topica['especificaciones'] = $fan->email_token;
                
                $user = $fan;
                $data = ['user' => $user, 'topica' => $topica];

                if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

                    Mail::send('mail', $data, function($message) use ($topica, $user)
                        {
                            $message->to($user->email)->subject('YLMM - Validación de Email');
                        });
                    
                    }
                
                return Redirect::to('/?msg=1&¡Ud ha sido registrado! Por favor, confirme su email para ingresar a YLMM');
         }
    }

    public function emailValidator()
    {

        $token = $_GET['token'];

        $id = $_GET['id'];

        $user = User::find($id);
        $user->id_wall = $_GET['id'];
        $user->verified = '1';
        $user->save();
        

        if ($user->email_token == $token) {

            $userdata = array(
            'email' => $user->email,
            'password' => $user->password
             );

            Auth::loginUsingId($user->id);

             $notification = new Notifications;
                $notification->comment = '¡Gracias por registrarte en YLMM!';
                $notification->id_user = $user->id;
                $notification->seen = 'N';
                $notification->save();
            
            if ($user->user_level == '5') {
                
                return Redirect::to('/musicianregistration');
            
            }else{
            
                return Redirect::to('/users/wall?id='.$user->id_wall.'&msg=4&¡Su email ha sido validado exitósamente! Bienvenido a You Love My Music');    
            }
            
       }else{

        return Redirect::to('/?msg=Tu email no ha sido validado');
       }
    }

    public function mailBlade()
    {
        return View::make('test');
    }

}
