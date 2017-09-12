<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Sponsors;
use App\Battles;
use App\Bands;
use App\Musicians;
use App\Notifications;
use App\Activities;
use View;
use DB;
use Hash;
use Input;
use Redirect;
use App\PVUserVotes;

class BattleController extends Controller
{

    public function elections()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        
        $fav1 = Input::get('fav1');
        $fav2 = Input::get('fav2');
        $fav3 = Input::get('fav3');
        $fav4 = Input::get('fav4');
        $fav5 = Input::get('fav5');
        $fav6 = Input::get('fav6');
        $fav7 = Input::get('fav7');
        $fav8 = Input::get('fav8');
        $fav9 = Input::get('fav9');
        $fav10 = Input::get('fav10');

            if ($fav1 == '' || $fav2 == '' || $fav3 == '' || $fav4 == '' || $fav5 == '' || $fav6 == '' || $fav7 == '' || $fav8 == '' || $fav9 == '' || $fav10 == '') {
                    
                   return Redirect::to('/battles/firstkey?msg=1');
            }else{


                $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
                $sumfav1 = $favbattle->votes + 1;
                
                DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

                    if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                    }else{

                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                    }

                    if ($user->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user->id;
                        $notification->id_video = $favbattle->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle->votes > 5) {
                    DB::table('battles')->where('id', $favbattle->id)->update(['llave' => '2']);
                }

            
                $favbattle2 = DB::table('battles')->where('id_video', $fav2)->first();
                $sumfav2 = $favbattle2->votes + 1;
                DB::table('battles')->where('id', $favbattle2->id)->update(['votes' => $sumfav2]);


                    if (is_null($favbattle2->id_user)) {

                        $user2 = DB::table('users')->where('id_band', $favbattle2->id_band)->first();

                    }else{

                        $user2 = DB::table('users')->where('id_musician', $favbattle2->id_user)->first();
                    }

                    if ($user2->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user2->id;
                        $notification->id_video = $favbattle2->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle2->votes > 5) {
                    DB::table('battles')->where('id', $favbattle2->id)->update(['llave' => '2']);
                }

            
                $favbattle3 = DB::table('battles')->where('id_video', $fav3)->first();
                $sumfav3 = $favbattle3->votes + 1;
                DB::table('battles')->where('id', $favbattle3->id)->update(['votes' => $sumfav3]);


                    if (is_null($favbattle3->id_user)) {

                        $user3 = DB::table('users')->where('id_band', $favbattle3->id_band)->first();

                    }else{

                        $user3 = DB::table('users')->where('id_musician', $favbattle3->id_user)->first();
                    }

                    if ($user3->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user3->id;
                        $notification->id_video = $favbattle3->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle3->votes > 5) {
                    DB::table('battles')->where('id', $favbattle3->id)->update(['llave' => '2']);
                }

            
                $favbattle4 = DB::table('battles')->where('id_video', $fav4)->first();
                $sumfav4 = $favbattle4->votes + 1;
                DB::table('battles')->where('id', $favbattle4->id)->update(['votes' => $sumfav4]);


                    if (is_null($favbattle4->id_user)) {

                        $user4 = DB::table('users')->where('id_band', $favbattle4->id_band)->first();

                    }else{

                        $user4 = DB::table('users')->where('id_musician', $favbattle4->id_user)->first();
                    }

                    if ($user4->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user4->id;
                        $notification->id_video = $favbattle4->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle4->votes > 5) {
                    DB::table('battles')->where('id', $favbattle4->id)->update(['llave' => '2']);
                }

            
                $favbattle5 = DB::table('battles')->where('id_video', $fav5)->first();
                $sumfav5 = $favbattle5->votes + 1;
                DB::table('battles')->where('id', $favbattle5->id)->update(['votes' => $sumfav5]);


                    if (is_null($favbattle5->id_user)) {

                        $user5 = DB::table('users')->where('id_band', $favbattle5->id_band)->first();

                    }else{

                        $user5 = DB::table('users')->where('id_musician', $favbattle5->id_user)->first();
                    }

                    if ($user5->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user5->id;
                        $notification->id_video = $favbattle5->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle5->votes > 5) {
                    DB::table('battles')->where('id', $favbattle5->id)->update(['llave' => '2']);
                }
             
                $favbattle6 = DB::table('battles')->where('id_video', $fav6)->first();
                $sumfav6 = $favbattle6->votes + 1;
                DB::table('battles')->where('id', $favbattle6->id)->update(['votes' => $sumfav6]);


                    if (is_null($favbattle6->id_user)) {

                        $user6 = DB::table('users')->where('id_band', $favbattle6->id_band)->first();

                    }else{

                        $user6 = DB::table('users')->where('id_musician', $favbattle6->id_user)->first();
                    }

                    if ($user6->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user6->id;
                        $notification->id_video = $favbattle6->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle6->votes > 5) {
                    DB::table('battles')->where('id', $favbattle6->id)->update(['llave' => '2']);
                }
             
                $favbattle7 = DB::table('battles')->where('id_video', $fav7)->first();
                $sumfav7 = $favbattle7->votes + 1;
                DB::table('battles')->where('id', $favbattle7->id)->update(['votes' => $sumfav7]);


                    if (is_null($favbattle7->id_user)) {

                        $user7 = DB::table('users')->where('id_band', $favbattle7->id_band)->first();

                    }else{

                        $user7 = DB::table('users')->where('id_musician', $favbattle7->id_user)->first();
                    }

                    if ($user7->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user7->id;
                        $notification->id_video = $favbattle7->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle7->votes > 5) {
                    DB::table('battles')->where('id', $favbattle7->id)->update(['llave' => '2']);
                }
             
                $favbattle8 = DB::table('battles')->where('id_video', $fav8)->first();
                $sumfav8 = $favbattle8->votes + 1;
                DB::table('battles')->where('id', $favbattle8->id)->update(['votes' => $sumfav8]);


                    if (is_null($favbattle8->id_user)) {

                        $user8 = DB::table('users')->where('id_band', $favbattle8->id_band)->first();

                    }else{

                        $user8 = DB::table('users')->where('id_musician', $favbattle8->id_user)->first();
                    }

                    if ($user8->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user8->id;
                        $notification->id_video = $favbattle8->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle8->votes > 5) {
                    DB::table('battles')->where('id', $favbattle8->id)->update(['llave' => '2']);
                }
             
                $favbattle9 = DB::table('battles')->where('id_video', $fav9)->first();
                $sumfav9 = $favbattle9->votes + 1;
                DB::table('battles')->where('id', $favbattle9->id)->update(['votes' => $sumfav9]);


                    if (is_null($favbattle9->id_user)) {

                        $user9 = DB::table('users')->where('id_band', $favbattle9->id_band)->first();

                    }else{

                        $user9 = DB::table('users')->where('id_musician', $favbattle9->id_user)->first();
                    }

                    if ($user9->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user9->id;
                        $notification->id_video = $favbattle9->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle9->votes > 5) {
                    DB::table('battles')->where('id', $favbattle9->id)->update(['llave' => '2']);
                }
             
                $favbattle10 = DB::table('battles')->where('id_video', $fav10)->first();
                $sumfav10 = $favbattle10->votes + 1;
                DB::table('battles')->where('id', $favbattle10->id)->update(['votes' => $sumfav10]);


                    if (is_null($favbattle10->id_user)) {

                        $user10 = DB::table('users')->where('id_band', $favbattle10->id_band)->first();

                    }else{

                        $user10 = DB::table('users')->where('id_musician', $favbattle10->id_user)->first();
                    }

                    if ($user10->id != Auth::user()->id) {
                        
                        $notification = new Notifications;
                        $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                        $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                        $notification->id_user = $user10->id;
                        $notification->id_video = $favbattle10->id;
                        $notification->type = 'votes';
                        $notification->seen = 'N';
                        $notification->save();
                            
                    }

                if ($favbattle10->votes > 5) {
                    DB::table('battles')->where('id', $favbattle10->id)->update(['llave' => '2']);
                }


            $pvotes = new PVUserVotes;
                $pvotes->id_battle = $favbattle->id;
                $pvotes->id_user = Auth::user()->id;
                $pvotes->llave = 1;
                $pvotes->save();
            

                DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Votación';
                $activity->save();

            return  Redirect::to('/battles/key');

        }

        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function firstkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '1')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        return View('battles.firstkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function secondkey_votes()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $fav1 = Input::get('fav1');
        $fav2 = Input::get('fav2');
        $fav3 = Input::get('fav3');
        $fav4 = Input::get('fav4');
        $fav5 = Input::get('fav5');

            if ($fav1 == '' || $fav2 == '' || $fav3 == '' || $fav4 == '' || $fav5 == '' ) {
                    
                   return Redirect::to('/battles/secondkey?msg=1');
            }else{


            $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
            $sumfav1 = $favbattle->votes + 1;
            DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

                if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                }else{
        
                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                }

                if ($user->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user->id;
                    $notification->id_video = $favbattle->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle->votes > 10) {
                DB::table('battles')->where('id', $favbattle->id)->update(['llave' => '2']);
            }

            $favbattle2 = DB::table('battles')->where('id_video', $fav2)->first();
            $sumfav2 = $favbattle2->votes + 1;
            DB::table('battles')->where('id', $favbattle2->id)->update(['votes' => $sumfav2]);

                if (is_null($favbattle2->id_user)) {

                        $user2 = DB::table('users')->where('id_band', $favbattle2->id_band)->first();

                }else{
        
                        $user2 = DB::table('users')->where('id_musician', $favbattle2->id_user)->first();
                }

                if ($user2->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user2->id;
                    $notification->id_video = $favbattle2->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle2->votes > 10) {
                DB::table('battles')->where('id', $favbattle2->id)->update(['llave' => '2']);
            }

            $favbattle3 = DB::table('battles')->where('id_video', $fav3)->first();
            $sumfav3 = $favbattle3->votes + 1;
            DB::table('battles')->where('id', $favbattle3->id)->update(['votes' => $sumfav3]);

            if (is_null($favbattle3->id_user)) {

                        $user3 = DB::table('users')->where('id_band', $favbattle3->id_band)->first();

                }else{
        
                        $user3 = DB::table('users')->where('id_musician', $favbattle3->id_user)->first();
                }

                if ($user3->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user3->id;
                    $notification->id_video = $favbattle3->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle3->votes > 10) {
                DB::table('battles')->where('id', $favbattle3->id)->update(['llave' => '2']);
            }

            $favbattle4 = DB::table('battles')->where('id_video', $fav4)->first();
            $sumfav4 = $favbattle4->votes + 1;
            DB::table('battles')->where('id', $favbattle4->id)->update(['votes' => $sumfav4]);

            if (is_null($favbattle4->id_user)) {

                        $user4 = DB::table('users')->where('id_band', $favbattle4->id_band)->first();

                }else{
        
                        $user4 = DB::table('users')->where('id_musician', $favbattle4->id_user)->first();
                }

                if ($user4->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user4->id;
                    $notification->id_video = $favbattle4->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle4->votes > 10) {
                DB::table('battles')->where('id', $favbattle4->id)->update(['llave' => '2']);
            }

            $favbattle5 = DB::table('battles')->where('id_video', $fav5)->first();
            $sumfav5 = $favbattle5->votes + 1;
            DB::table('battles')->where('id', $favbattle5->id)->update(['votes' => $sumfav5]);

                if (is_null($favbattle5->id_user)) {

                        $user5 = DB::table('users')->where('id_band', $favbattle5->id_band)->first();

                }else{
        
                        $user5 = DB::table('users')->where('id_musician', $favbattle5->id_user)->first();
                }

                if ($user5->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user5->id;
                    $notification->id_video = $favbattle5->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle5->votes > 10) {
                DB::table('battles')->where('id', $favbattle5->id)->update(['llave' => '2']);
            }

            $pvotes = new PVUserVotes;
                $pvotes->id_battle = $favbattle->id;
                $pvotes->id_user = Auth::user()->id;
                $pvotes->llave = $favbattle->llave;
                $pvotes->save();


           
                DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

                $activity          = new Activities;
                $activity->id_user = Auth::user()->id;
                $activity->type    = 'Votación';
                $activity->save();
            
            return  Redirect::to('/battles/key');
                

        }
        
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function secondkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '2')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        
        return View('battles.secondkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function thirdkey_votes()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $fav1 = Input::get('fav1');
        $fav2 = Input::get('fav2');
        $fav3 = Input::get('fav3');
        $fav4 = Input::get('fav4');

            if ($fav1 == '' || $fav2 == '' || $fav3 == '' || $fav4 == '') {
                    
                   return Redirect::to('/battles/thirdkey?msg=1');
            }else{

            $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
            $sumfav1 = $favbattle->votes + 1;
            DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

                if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                }else{
        
                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                }

                if ($user->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user->id;
                    $notification->id_video = $favbattle->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle->votes > 15) {
                DB::table('battles')->where('id', $favbattle->id)->update(['llave' => '4']);
            }

            $favbattle2 = DB::table('battles')->where('id_video', $fav2)->first();
            $sumfav2 = $favbattle2->votes + 1;
            DB::table('battles')->where('id', $favbattle2->id)->update(['votes' => $sumfav2]);

            if (is_null($favbattle2->id_user)) {

                        $user2 = DB::table('users')->where('id_band', $favbattle2->id_band)->first();

                }else{
        
                        $user2 = DB::table('users')->where('id_musician', $favbattle2->id_user)->first();
                }

                if ($user2->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user2->id;
                    $notification->id_video = $favbattle2->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle2->votes > 15) {
                DB::table('battles')->where('id', $favbattle2->id)->update(['llave' => '4']);
            }

            $favbattle3 = DB::table('battles')->where('id_video', $fav3)->first();
            $sumfav3 = $favbattle3->votes + 1;
            DB::table('battles')->where('id', $favbattle3->id)->update(['votes' => $sumfav3]);

                if (is_null($favbattle3->id_user)) {

                        $user3 = DB::table('users')->where('id_band', $favbattle3->id_band)->first();

                }else{
        
                        $user3 = DB::table('users')->where('id_musician', $favbattle3->id_user)->first();
                }

                if ($user3->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user3->id;
                    $notification->id_video = $favbattle3->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle3->votes > 15) {
                DB::table('battles')->where('id', $favbattle3->id)->update(['llave' => '4']);
            }

            $favbattle4 = DB::table('battles')->where('id_video', $fav4)->first();
            $sumfav4 = $favbattle4->votes + 1;
            DB::table('battles')->where('id', $favbattle4->id)->update(['votes' => $sumfav4]);

            if (is_null($favbattle4->id_user)) {

                        $user4 = DB::table('users')->where('id_band', $favbattle4->id_band)->first();

                }else{
        
                        $user4 = DB::table('users')->where('id_musician', $favbattle4->id_user)->first();
                }

                if ($user4->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user4->id;
                    $notification->id_video = $favbattle4->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle4->votes > 15) {
                DB::table('battles')->where('id', $favbattle4->id)->update(['llave' => '4']);
            }

        $pvotes = new PVUserVotes;
            $pvotes->id_battle = $favbattle->id;
            $pvotes->id_user = Auth::user()->id;
            $pvotes->llave = $favbattle->llave;
            $pvotes->save();



            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Votación';
            $activity->save();

        return  Redirect::to('/battles/key');

        
           }
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function thirdkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '3')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        
        return View('battles.thirdkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function fourthkey_votes()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $fav1 = Input::get('fav1');
        $fav2 = Input::get('fav2');
        $fav3 = Input::get('fav3');

         if ($fav1 == '' || $fav2 == '' || $fav3 == '') {
                    
                   return Redirect::to('/battles/fourthkey?msg=1');
        }else{

            $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
            $sumfav1 = $favbattle->votes + 1;
            DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

                if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                }else{
        
                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                }

                if ($user->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user->id;
                    $notification->id_video = $favbattle->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle->votes > 20) {
                DB::table('battles')->where('id', $favbattle->id)->update(['llave' => '5']);
            }

            $favbattle2 = DB::table('battles')->where('id_video', $fav2)->first();
            $sumfav2 = $favbattle2->votes + 1;
            DB::table('battles')->where('id', $favbattle2->id)->update(['votes' => $sumfav2]);

            if (is_null($favbattle2->id_user)) {

                        $user2 = DB::table('users')->where('id_band', $favbattle2->id_band)->first();

                }else{
        
                        $user2 = DB::table('users')->where('id_musician', $favbattle2->id_user)->first();
                }

                if ($user2->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user2->id;
                    $notification->id_video = $favbattle2->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle2->votes > 20) {
                DB::table('battles')->where('id', $favbattle2->id)->update(['llave' => '5']);
            }

            $favbattle3 = DB::table('battles')->where('id_video', $fav3)->first();
            $sumfav3 = $favbattle3->votes + 1;
            DB::table('battles')->where('id', $favbattle3->id)->update(['votes' => $sumfav3]);

            if (is_null($favbattle3->id_user)) {

                        $user3 = DB::table('users')->where('id_band', $favbattle3->id_band)->first();

                }else{
        
                        $user3 = DB::table('users')->where('id_musician', $favbattle3->id_user)->first();
                }

                if ($user3->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user3->id;
                    $notification->id_video = $favbattle3->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle3->votes > 15) {
                DB::table('battles')->where('id', $favbattle3->id)->update(['llave' => '4']);
            }

        $pvotes = new PVUserVotes;
            $pvotes->id_battle = $favbattle->id;
            $pvotes->id_user = Auth::user()->id;
            $pvotes->llave = $favbattle->llave;
            $pvotes->save();
        

            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Votación';
            $activity->save();

        return  Redirect::to('/battles/key');
            
        
        }
    
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function fourthkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '4')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        
        return View('battles.fourthkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function fifthkey_votes()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        
        $fav1 = Input::get('fav1');
        $fav2 = Input::get('fav2');

         if ($fav1 == '' || $fav2 == '') {
                    
                   return Redirect::to('/battles/fifthkey?msg=1');
        }else{

            $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
            $sumfav1 = $favbattle->votes + 1;
            DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

            if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                }else{
        
                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                }

                if ($user->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user->id;
                    $notification->id_video = $favbattle->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle->votes > 30) {
                DB::table('battles')->where('id', $favbattle->id)->update(['llave' => '6']);
            }

            $favbattle2 = DB::table('battles')->where('id_video', $fav2)->first();
            $sumfav2 = $favbattle2->votes + 1;
            DB::table('battles')->where('id', $favbattle2->id)->update(['votes' => $sumfav2]);

            if (is_null($favbattle2->id_user)) {

                        $user2 = DB::table('users')->where('id_band', $favbattle2->id_band)->first();

                }else{
        
                        $user2 = DB::table('users')->where('id_musician', $favbattle2->id_user)->first();
                }

                if ($user2->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user2->id;
                    $notification->id_video = $favbattle2->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

            if ($favbattle2->votes > 30) {
                DB::table('battles')->where('id', $favbattle2->id)->update(['llave' => '6']);
            }

        $pvotes = new PVUserVotes;
            $pvotes->id_battle = $favbattle->id;
            $pvotes->id_user = Auth::user()->id;
            $pvotes->llave = $favbattle->llave;
            $pvotes->save();


            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Votación';
            $activity->save();
        
        return  Redirect::to('/battles/key');
        
        }
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function fifthkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '5')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        
        return View('battles.fifthkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function sixthkey_votes()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();

        
        $fav1 = Input::get('fav1');

         if ($fav1 == '') {
                    
                   return Redirect::to('/battles/sixthkey?msg=1');
        }else{
        
            $favbattle = DB::table('battles')->where('id_video', $fav1)->first();
            $sumfav1 = $favbattle->votes + 1;
            DB::table('battles')->where('id', $favbattle->id)->update(['votes' => $sumfav1]);

            if (is_null($favbattle->id_user)) {

                        $user = DB::table('users')->where('id_band', $favbattle->id_band)->first();

                }else{
        
                        $user = DB::table('users')->where('id_musician', $favbattle->id_user)->first();
                }

                if ($user->id != Auth::user()->id) {
                    
                    $notification = new Notifications;
                    $notification->comment = '¡'.Auth::user()->name.' ha votado por tu video!';
                    $notification->href    = '/users/wall?id='.Auth::user()->id.'';
                    $notification->id_user = $user->id;
                    $notification->id_video = $favbattle->id;
                    $notification->type = 'votes';
                    $notification->seen = 'N';
                    $notification->save();
                            
                }

        $pvotes = new PVUserVotes;
            $pvotes->id_battle = $favbattle->id;
            $pvotes->id_user = Auth::user()->id;
            $pvotes->llave = $favbattle->llave;
            $pvotes->save();



            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Votación';
            $activity->save();
        
        return  Redirect::to('/battles/key');
        
        }
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function sixthkey_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')->where('battles.llave', '6')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->get();
        
        return View('battles.sixthkey', array('sponsors' => $sponsors, 'videos' => $videos));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }
    public function key_view()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        return View('battles.key', array('sponsors' => $sponsors));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }
     public function creator()
    {  
        if (Auth::check()) {

            $battle = DB::table('battles')->where('id_band', Auth::user()->id_band)->first();

            if (!is_null($battle)) {
                
                return Redirect::to('/battles?msg="Ya estás inscrito en la batalla"');
            }else{

            $battles = new Battles;

            $battles->id_band = Input::get('id_band');
            $battles->date = date('d/m/Y');
            $battles->status = 'A';
            $battles->llave = '1';
            $battles->votes = '0';
            $battles->id_video = Input::get('id_video');

            $video = DB::table('videos')->where('id', $battles->id_video)->first();

            $battles->name_video = $video->name;
            $battles->date_added = $video->upload_date;
            $battles->views = $video->views;


            $battles->save();

            DB::table('bands')->where('id', $battles->id_band)->update(['id_battle' => $battles->id]);
            DB::table('videos')->where('id', $battles->id_video)->update(['id_battle' => $battles->id]);

             $notification = new Notifications;
                $notification->comment = '¡Te has unido a la batalla YLMM!';
                $notification->id_user = Auth::user()->id;
                $notification->id_band =  $battles->id_band;
                $notification->seen = 'N';
                $notification->save();
            
                return Redirect::to('/battles?msg=Te has inscrito exitósamente&título=SUCCESS');
            }

        }else{

                 return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }     
        
        
    }


     public function videoVote()
    {

        $relation = $this->verifyLikes(Request::get('id_video'));
  
        if($relation != false)
        {

            $videos = Videos::find(Request::get('id_video'));

            if ($videos->loves == 0) {

                $videos->loves = 0;
                $videos->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();

            }else{

                $videos->loves = $videos->loves - 1;
                $videos->save();
                $rela = PVUserVideo::find($relation);
                $rela->delete();
            }

        }else{


            $videos = Videos::find(Request::get('id_video'));
            $videos->loves = $videos->loves + 1;
            $videos->save();
            $uv = new PVUserVideo;
            $uv->id_video = Request::get('id_video');
            $uv->id_user = Auth::user()->id;
            $uv->save();

            $notification = new Notifications;
                $notification->comment = '¡Has votado por una banda en la batalla YLMM!';
                $notification->id_user = Auth::user()->id;
                $notification->id_band =  $videos->id_band;
                $notification->seen = 'N';
                $notification->save();


            DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

            $activity          = new Activities;
            $activity->id_user = Auth::user()->id;
            $activity->type    = 'Votación';
            $activity->save();



        }

    }

    public function verifyVotes($id_video)
    {

        $pvuservideo = DB::table('pv_uservideo')->where('id_user', Auth::user()->id)->where('id_video', $id_video)->where('id_battle', $id_battle)->first();

        if (is_null($pvuservideo)) {

            return false;

        }else{
            
            return $pvuservideo->id;
        }
    }
	public function takeSponsors()
    {
        return Sponsors::all();
    }

    public function battle()
    {
    	if (Auth::check()) {

        $sponsors = $this->takeSponsors();

        //---------------------Concurso 1 - Music Performance -----------------------------//
            
            $performancevideos = DB::table('battles')
                        ->orderBy('votes', 'desc')
                        ->get();

        //---------------------Concurso 2 - 10 clasificated songs -----------------------------//
            
            $videos_clasif = DB::table('battles')
        				->where('llave', '2')
        				->orderBy('votes', 'desc')
        				->groupBy('id_band')
        				->take(10)
        				->get();

        //---------------------Concurso 3 - 10 most voted musicians/bands -----------------------------//
       	$bands = DB::table('bands')->get();
       	$musicians = DB::table('musicians')->get();

       	foreach ($musicians as $m) {
       		$contestants[] = $m;
       	}

       	foreach ($bands as $b) {
       		$contestants[] = $b;
       	}

		foreach ($contestants as $contestant) {
			
			if(is_null($contestant->id_user)){

				$vi = DB::table('battles')->where('id_band', $contestant->id)->orderBy('votes', 'desc')->groupBy('id_band')->get();
				foreach ($vi as $v) {
					$video_contest[] = $v; 
				}
			}else{

				$vi2 = DB::table('battles')->where('id_user', $contestant->id_user)->orderBy('votes', 'desc')->groupBy('id_user')->get();
				foreach ($vi2 as $v2) {
					$video_contest[] = $v2; 
				}
			}

		}

        foreach($video_contest as $contest){
            if (is_null($contest->id_user)) {
                $contest->votes = Battles::where('id_band', $contest->id_band)->sum('votes');
            }else{
                 $contest->votes = Battles::where('id_user', $contest->id_user)->sum('votes');
            }
        }

            usort($video_contest, function($a, $b) {
                return $b->votes - $a->votes;
            });

        //Nota: return $grouped types 

        //---------------------Concurso 4: Musicians/Bands Clasificated -----------------------------//

        foreach ($videos_clasif as $video) {

            if(is_null($video->id_user)){

                $vi = DB::table('bands')->where('id', $video->id_band)->get();
                foreach ($vi as $v) {
                    $clasificated_contestants[] = $v; 
                }
            }else{

                $vi2 = DB::table('musicians')->where('id', $video->id_user)->get();
        
                foreach ($vi2 as $v2) {
                    $clasificated_contestants[] = $v2; 
                }
            }
        }

        //Nota: no esta completo, falta sumar los votos de cada participante y ordenarlos de manera descendiente

        //---------------------Concurso 5: Más followers -----------------------------//

            $followeds =   $contestants;
            usort($followeds, function($a, $b) {
                return $b->favorite - $a->favorite;
            });


        //---------------------Concurso 6: Fans con mayor actividad -----------------------------//
            $fans = DB::table('users')->where('user_level', '4')->orderBy('activity_count', 'desc')->take(10)->get();

            $array_musicians = DB::table('musicians')->get();

                return View('battles.wall', array('sponsors' => $sponsors,'performancevideos' => $performancevideos,'fans' => $fans, 'followeds' => $followeds, 'videos_clasif' => $videos_clasif, 'contest' => $video_contest, 'contestants' => $clasificated_contestants, 'array_musicians' => $array_musicians, 'bands_array' => $bands));
        
        }else{
            
            return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function performance_search() {

        $name = $_GET['performance'];

        $bands = DB::table('bands')->where('name', 'LIKE', '%'.$name.'%')->get();
        $musicians = DB::table('musicians')->where('artistic_name', 'LIKE', '%'.$name.'%')->get();
        /*$bandsmusician = DB::table('battles')
                        ->where('name_video', 'LIKE', '%'.$name.'%') 
                        ->orderBy('votes', 'desc')
                        ->get();*/
      
        return array(/*'bandsmusician' => $bandsmusician, */'bands' => $bands, 'musicians' => $musicians);
    }

    public function createbattle()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $banda = DB::table('bands')->where('id', Auth::user()->id_band)->first();
        return View('battles.createbattle', array('sponsors' => $sponsors, 'banda' => $banda));
        
        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function battle_comment()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        return View::make('battles.battle_comment', array('sponsors' => $sponsors));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }


    }
    
    public function views()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
         $videos = DB::table('battles')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->orderBy('battles.views', 'desc')
                  ->get();
        return View::make('battles.views', array('sponsors' => $sponsors, 'videos' => $videos));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }


    }

    public function letters()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->orderBy('battles.name_video', 'asc')
                  ->get();
        return View::make('battles.letters', array('sponsors' => $sponsors, 'videos' => $videos));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function llaves()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        return View::make('battles.llaves', array('sponsors' => $sponsors));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function lastadded()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->orderBy('battles.created_at', 'desc')
                  ->get();
        return View::make('battles.lastadded', array('sponsors' => $sponsors, 'videos' => $videos));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function mostvoted()
    {
        if (Auth::check()) {

        $sponsors = $this->takeSponsors();
        $videos = DB::table('battles')
                  ->join('videos', 'videos.id', '=', 'battles.id_video')
                  ->select('videos.url', 'videos.id_band', 'videos.id', 'battles.*')
                  ->orderBy('battles.votes', 'desc')
                  ->get();

        return View::make('battles.mostvoted', array('sponsors' => $sponsors, 'videos' => $videos));
        

        }else{
            
             return  Redirect::to('/?msg=6&Necesita Iniciar Sesión para Realizar esta acción');
        }
    }

    public function addVote()
    {
        try {
            $idvideo = $_GET['id'];
            $video = DB::table('battles')->find($idvideo);
            $sum = $video->votes + 1;

            DB::table('battles')->where('id', $idvideo)->update(['votes' => $sum]);


            return 1;

        } catch (\Exception $e) {
            return $e;
        }
    }


}
