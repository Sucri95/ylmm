<?php

namespace App\Http\Controllers;

use App\User;
use App\Videos;
use App\Sponsors;
use App\Genres;
use App\Bands;
use App\Notifications;
use App\Musicians;
use App\Members;
use App\Battles;
use App\Comments;
use App\Activities;

use Request;
use Auth;
use View;
use DB;
use Input;
use Socialite;
use Redirect;
use Hash;
use Image;
use Mail;
use stdClass;

class ServicesController extends Controller
{
    public function homeSlidersService()
    {
		$sliders = array();
		$views = array();
		$week = array();
		$todays = array();
		$countv = 0;

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

		 	if ($semana == '[]') {

	            $weeks = DB::table('battles')
	                    ->orderBy('votes', 'desc')
	                    ->take(10)
	                    ->get();

	        }else{
	              
	            $weeks = DB::table('battles')
	                    ->orderBy('votes', 'desc')
	                    ->whereBetween('date', [$lastweek, $thisweek])
	                    ->take(10)
	                    ->get();

	        }

	        foreach ($vistas as $v) {

	        	$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$views[$countv]['id']          = $v->id;
				$views[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$views[$countv]['song']        = $vinfo[0];
				$views[$countv]['artist']      = $vinfo[1];
				$views[$countv]['views']       = $v->views;
				$views[$countv]['likes']       = $v->likes;
				$views[$countv]['id_user']     = $v->id_user;

				if(is_null($v->id_band)){

					$user = DB::table('users')->where('id_musician', $v->id_user)->first();

					$views[$countv]['type']        = 'M';
					$views[$countv]['id_musician'] = $v->id_user;
					$views[$countv]['id_wall']     = $user->id_wall;
					$views[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$views[$countv]['route_art']   = '/mobile_app/profile.html?id='.$user->id.'&type=M';
				}else{
					$views[$countv]['type']      = 'B';
					$views[$countv]['id_band']   = $v->id_band;
					$views[$countv]['route']     = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$views[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;
	        }

	        $countv = 0;

	        foreach ($weeks as $v) {
	        	
	        	$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$week[$countv]['id']          = $v->id;
				$week[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$week[$countv]['song']        = $vinfo[0];
				$week[$countv]['artist']      = $vinfo[1];
				$week[$countv]['views']       = $v->views;
				$week[$countv]['likes']       = $v->likes;
				$week[$countv]['id_user']     = $v->id_user;
				if(is_null($v->id_band)){

					$user = DB::table('users')->where('id_musician', $v->id_user)->first();
					$week[$countv]['type']        = 'M';
					$week[$countv]['id_musician'] = $v->id_user;
					$week[$countv]['id_wall']     = $user->id_wall;
					$week[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$week[$countv]['route_art']  = '/mobile_app/profile.html?id='.$user->id.'&type=M';
				}else{
					$week[$countv]['type']       = 'B';
					$week[$countv]['id_band']    = $v->id_band;
					$week[$countv]['route']      = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$week[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;
	        }
			
			$countv = 0;

	        foreach ($today as $v) {
	        	
	        	$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name);

        		$todays[$countv]['id']          = $v->id;
				$todays[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$todays[$countv]['song']        = $vinfo[0];
				$todays[$countv]['artist']      = $vinfo[1];
				$todays[$countv]['views']       = $v->views;
				$todays[$countv]['likes']       = $v->likes;
				$todays[$countv]['id_user']     = $v->id_user;
				if(is_null($v->id_band)){
					$todays[$countv]['type']        = 'M';
					$todays[$countv]['id_musician'] = $v->id_musician;
					$todays[$countv]['id_wall']     = $v->id_user;
					$todays[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$todays[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
				}else{
					$todays[$countv]['type']     = 'B';
					$todays[$countv]['id_band']  = $v->id_band;
					$todays[$countv]['route']    = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$todays[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;
	        }

	        $sliders['vistas'] = $views; 
	        $sliders['weeks']  = $week;
	        $sliders['today']  = $todays;


	
		    return $sliders;

    }

    public function takeSponsors()
	{
		$sponsors = Sponsors::all();

    	return $sponsors;

	}

	public function takeMusicians()
	{
		$musicians = Musicians::all();
	
    	return $musicians;
	}

	public function takeUsers()
	
	{
		$users = DB::table('users')->where('id_band', null)->where('user_level', '<>', '3')->get();

		$userA = array();
		$count = 0;

		foreach ($users as $u) {
			$userA[$count]['id']    = $u->id;
			$userA[$count]['name']  = $u->name;
			$userA[$count]['email'] = $u->email;

			$count++;
		}

		$response['user'] = $userA;

	    header("Content-Type: application/json", true);
		echo json_encode($response);

	}

	public function takeBands()
	{
		$bands = Bands::all();
	
    	return $bands;

	}
	
	public function takeGenres()
	{
		$genres = Genres::all();
	
    	return $genres;

	}

	public function getauthuser()
	{
		if (Auth::check()) {

			$authuser = DB::table('users')->where('id', Auth::user()->id)->first();
			
			header("Content-Type: application/json", true);
			$response = $authuser;
			echo json_encode($response);

		}
	}

	public function getUserWall()
	{
		if (Auth::check()) {

			$id_wall = $_GET['id'];

			$walluser = DB::table('users')->where('id_wall', $id_wall)->first();
			
			header("Content-Type: application/json", true);
			$response = $walluser;
			echo json_encode($response);

		}
	}
	public function getBandWall()
	{
		if (Auth::check()) {

			$id_band = $_GET['id'];

			$bandwall = DB::table('bands')->where('id', $id_band)->first();
			
			header("Content-Type: application/json", true);
			$response = $bandwall;
			echo json_encode($response);

		}
	}
	public function getFollowersUser()
	{
		if (Auth::check()) {

			$id_wall = $_GET['id'];

			$response = array();

			$user = DB::table('users')->where('id_wall', $id_wall)->first();

			$favorites = DB::table('favorites')
                       ->where('id_user', $user->id)
                       ->get(); 

            $following = count($favorites);
            $followers = $user->followers;

			if (!is_null($user->id_musician)) {

				$musician = DB::table('musicians')
                      ->where('id', $user->id_musician)
                      ->first();
              	
              $followers = $followers + $musician->favorite;

              

			}
			
			$response['followers'] = $followers;
            $response['following'] = $following;
			
			header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function checkFollowersUser()
	{
		if (Auth::check()) {

			$id = $_GET['id'];
			$type = $_GET['type'];
			
			$response = array();

			if ($type == 'B') {

				$band = DB::table('bands')->where('id', $id)->first();
				
				$favorites = DB::table('favorites')
                	->where('id_user', Auth::user()->id)
                	->where('id_band', $band->id)
                	->first();
				$response['followers'] = $favorites; 
				if (is_null($favorites)) {
						$response['check'] = 'false'; 
				}else{
						$response['check'] = 'true'; 
				}
				

			}else if ($type == 'M' || $type == 'U') {
				
				$user = DB::table('users')->where('id', $id)->first();
				
				if (is_null($user->id_musician)) {

					$favorites = DB::table('favorites')
	                	->where('id_user', Auth::user()->id)
	                	->where('id_fan', $user->id)
	                	->first();
					$response['type'] = 'fan';
					$response['followers'] = $favorites;

					if (is_null($favorites)) {
						$response['check'] = 'false'; 
					}else{
						$response['check'] = 'true'; 
					}
				

				}else{

					$favorites = DB::table('favorites')
	                	->where('id_user', Auth::user()->id)
	                	->where('id_musician', $user->id_musician)
	                	->first();
					$response['type'] = 'musician';
					$response['followers'] = $favorites; 
					if (is_null($favorites)) {
						$response['check'] = 'false'; 
					}else{
						$response['check'] = 'true'; 
					}
					
				}

			}

            header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function getfollowingBands()
	{
		if (Auth::check()) {

			$id_band = $_GET['id'];

			$response = array();

			$band = DB::table('bands')->where('id', $id_band)->first();

            $followers = $band->favorite;
			
			$response['following'] = $followers;
			
			header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function checkfollowingBands()
	{
		if (Auth::check()) {

			$id = $_GET['id'];

			$band = DB::table('bands')->where('id', $id)->first();
			$response = array();

			$favorites = DB::table('favorites')
                	->where('id_user', Auth::user()->id)
                	->where('id_band', $band->id)
                	->first();
			$response['followers'] = $favorites; 


            header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}
	
	public function checkVideoType()
	{
		if (Auth::check()) {

			$response = array();

			$id_video = $_GET['id_video'];

			$video = DB::table('videos')->where('id', $id_video)->first();

			if (is_null($video->id_musician)) {

				$response['type'] = 'band';
				$response['id_video'] = $video->id;
				$response['id_band'] = $video->id_band;

			}else{

				$wall = DB::table('users')->where('id_musician', $video->id_musician)->first();

				$response['type'] = 'musician';
				$response['id_video'] = $video->id;
				$response['id_musician'] = $video->id_musician;
				$response['id_wall'] = $wall->id_wall;
			}


            header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function usersWall()
	{
		if (Auth::check()) {

			$wall = array();

			$user = DB::table('users')
				->where('id', Request::get('id'))
				->first();

			$following = DB::table('favorites')
          		->where('id_user', $user->id)
          		->count();

			if (is_null($user->id_musician)) {

          		$followers = $user->followers;

			}else{
				
				$musician = DB::table('musicians')
                      ->where('id', $user->id_musician)
                      ->first();

                $followers = $musician->favorite;

                $musicianArray = array();
                $musicianArray['id']  = $musician->id;
                $musicianArray['about']  = $musician->about;
                $genresA = unserialize($musician->genres);
                $genres = '';
                foreach ($genresA as $g) {
                	if ($genres == '') {
                		$genres = $g;
                	}else{
						$genres = $genres.' , '.$g;
                	}
                }
                $rolesA = unserialize($musician->role);
                $roles = '';
                foreach ($rolesA as $g) {
                	if ($roles == '') {
                		$roles = $g;
                	}else{
						$roles = $roles.' , '.$g;
                	}
                }

                $musicianArray['genres'] = $genres;
                $musicianArray['roles']  = $roles;

                $wall['musician'] = $musicianArray;
			}

			$comments = DB::table('comments')
	            ->where('id_wall', Request::get('id'))
				->whereNull('id_comment')
				->whereNull('id_album')
            	->orderBy('created_at', 'desc')
            	->get();

            $comalbum = DB::table('comments')
	            ->where('id_wall', Request::get('id'))
				->whereNull('id_comment')
				->whereNotNull('id_album')
            	->orderBy('created_at', 'desc')
            	->get();


            $videos = DB::table('pv_uservideo')->where('pv_uservideo.id_user', Request::get('id'))
                ->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
                ->select('videos.*')
                ->orderBy('videos.name', 'asc')
                ->get();

            $commentArray = array();
            $videosArray = array();
			$albumArray = array();
			$showedalbums = [];

            $count = 0;
            $countv = 0;

	        foreach ($comments as $c) {

	        	$username = DB::table('users')->where('id', $c->id_user)->first();

	        	$commentArray[$count]['id']          = $c->id;
				$commentArray[$count]['comment']     = $c->comment;
				$commentArray[$count]['title']       = $c->title;
				$commentArray[$count]['like']        = $c->like;
				$commentArray[$count]['type']        = $c->type;
				$commentArray[$count]['id_album']    = $c->id_album;
				$commentArray[$count]['id_user']     = $c->id_user;
				$commentArray[$count]['id_comment']  = $c->id_comment;
				$commentArray[$count]['username']    = $username->name;
				$commentArray[$count]['profile_pic'] = $username->profile_pic;
				$commentArray[$count]['date']        = $c->created_at;

				$response = DB::table('comments')
					->where('id_comment', $c->id)
					->where('id_wall', Request::get('id'))
					->whereNull('id_response')
					->orderBy('created_at', 'asc')
					->get();

				$responsesArray = array();
				$countresp = 0;

				foreach ($response as $resp) {

					$userresp = DB::table('users')->where('id', $resp->id_user)->first();

					$responsesArray[$countresp]['id']          = $resp->id;
					$responsesArray[$countresp]['response']    = $resp->comment;
					$responsesArray[$countresp]['title']       = $resp->title;
					$responsesArray[$countresp]['like']        = $resp->like;
					$responsesArray[$countresp]['type']        = $resp->type;
					$responsesArray[$countresp]['id_album']    = $resp->id_album;
					$responsesArray[$countresp]['id_user']     = $resp->id_user;
					$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
					$responsesArray[$countresp]['username']    = $userresp->name;
					$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
					$responsesArray[$countresp]['date']        = $resp->created_at;

					$countresp++;

				}

				$commentArray[$count]['responses'] = $responsesArray;
				$count++;

	        }

	        foreach ($comalbum as $c) {

	        	$username = DB::table('users')->where('id', $c->id_user)->first();

				if ($c->type == 'album' && !in_array($c->id_album, $showedalbums)) {

					$commentArray[$count]['id']          = $c->id;
					$commentArray[$count]['comment']     = $c->comment;
					$commentArray[$count]['title']       = $c->title;
					$commentArray[$count]['like']        = $c->like;
					$commentArray[$count]['type']        = $c->type;
					$commentArray[$count]['id_album']    = $c->id_album;
					$commentArray[$count]['id_user']     = $c->id_user;
					$commentArray[$count]['id_comment']  = $c->id_comment;
					$commentArray[$count]['username']    = $username->name;
					$commentArray[$count]['profile_pic'] = $username->profile_pic;
					$commentArray[$count]['date']        = $c->created_at;
						
	              	$showedalbums[] = array_push($showedalbums, $c->id_album);
                          
                              $pictures = DB::table('comments')
                                    ->where('id_album', $c->id_album)
                                    ->where('type', 'album')
                                    ->get(); 
                                  
                              $album = DB::table('albums')
                                    ->where('id_wall', $c->id_wall)
                                    ->where('id', $c->id_album)
                                    ->first();

                    for ($i=0; $i < count($pictures); $i++) { 
                    	$albumArray[$i] = $pictures[$i]->comment;
                    }

                    $commentArray[$count]['pictures']   = $albumArray;
                    $commentArray[$count]['album_name'] = $album->name;

				}

				$response = DB::table('comments')
					->where('id_comment', $c->id)
					->where('id_wall', Request::get('id'))
					->whereNull('id_response')
					->orderBy('created_at', 'asc')
					->get();

				$responsesArray = array();
				$countresp = 0;

				foreach ($response as $resp) {

					$userresp = DB::table('users')->where('id', $resp->id_user)->first();

					$responsesArray[$countresp]['id']          = $resp->id;
					$responsesArray[$countresp]['response']    = $resp->comment;
					$responsesArray[$countresp]['title']       = $resp->title;
					$responsesArray[$countresp]['like']        = $resp->like;
					$responsesArray[$countresp]['type']        = $resp->type;
					$responsesArray[$countresp]['id_album']    = $resp->id_album;
					$responsesArray[$countresp]['id_user']     = $resp->id_user;
					$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
					$responsesArray[$countresp]['username']    = $userresp->name;
					$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
					$responsesArray[$countresp]['date']        = $resp->created_at;

					$countresp++;

				}

				$commentArray[$count]['responses'] = $responsesArray;
				$count++;

	        }

        	foreach ($videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name);

        		$videosArray[$countv]['id']          = $v->id;
				$videosArray[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$videosArray[$countv]['song']        = $vinfo[0];
				$videosArray[$countv]['artist']      = $vinfo[1];
				$videosArray[$countv]['views']       = $v->views;
				$videosArray[$countv]['likes']       = $v->likes;
				$videosArray[$countv]['id_user']     = $v->id_user;
				if(is_null($v->id_band)){
					$videosArray[$countv]['type']        = 'M';
					$videosArray[$countv]['id_musician'] = $v->id_musician;
					$videosArray[$countv]['id_wall']     = $v->id_user;
					$videosArray[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
				}else{
					$videosArray[$countv]['type']    = 'B';
					$videosArray[$countv]['id_band'] = $v->id_band;
					$videosArray[$countv]['route']   = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;

	        }

	        $wall['user']       = $user;
			$wall['comments']   = $commentArray;
			$wall['videos']     = $videosArray;
			$wall['followers']  = $followers;
			$wall['following']  = $following;

	       	header("Content-Type: application/json", true);
	        echo json_encode($wall);

		}
	}

	public function bandsWall()
	{
		if (Auth::check()) {

			$wall = array();

			$band = DB::table('bands')
				->where('id', Request::get('id'))
				->first();

			$users = DB::table('users')
				->where('id_band', $band->id)
				->get();

			$membersArray = array();
			$countM = 0;

			foreach ($users as $user) {

				$members = DB::table('members')
					->where('id_user', $user->id)
					->where('verified', 'Y')
					->get();

				foreach ($members as $m) {

					$membersArray[$countM]['id']    = $user->id;
					$membersArray[$countM]['id_m']  = $m->id;
					$membersArray[$countM]['name']  = $user->name;
					$membersArray[$countM]['route'] = '/mobile_app/profile.html?id='.$user->id.'&type=M';
					$rolescon = '';
					$roles = unserialize($m->role);
					foreach ($roles as $r) {
						if ($rolescon == '') {
							$rolescon = $r;
						}else{
							$rolescon = $rolescon.' , '.$r;

						}
					}
					$membersArray[$countM]['rol']   = $rolescon;

					$countM++;
				}
			}

          	$followers = $band->favorite;

			$comments = DB::table('comments')
	            ->where('id_band', Request::get('id'))
	            ->whereNull('id_comment')
	            ->whereNull('id_album')
	            ->orderBy('created_at', 'desc')
	            ->get();

	        $comalbum = DB::table('comments')
	            ->where('id_band', Request::get('id'))
				->whereNull('id_comment')
				->whereNotNull('id_album')
            	->orderBy('created_at', 'desc')
            	->get();
            
        	$videos =  DB::table('battles')->where('id_band', Request::get('id'))
         		->orderBy('votes', 'desc')
                ->get();

            $commentArray = array();
            $videosArray = array();
			$albumArray = array();
			$showedalbums = [];

            $count = 0;
            $countv = 0;

	       	foreach ($comments as $c) {

	        	$username = DB::table('users')->where('id', $c->id_user)->first();

	        	$commentArray[$count]['id']          = $c->id;
				$commentArray[$count]['comment']     = $c->comment;
				$commentArray[$count]['title']       = $c->title;
				$commentArray[$count]['like']        = $c->like;
				$commentArray[$count]['type']        = $c->type;
				$commentArray[$count]['id_album']    = $c->id_album;
				$commentArray[$count]['id_user']     = $c->id_user;
				$commentArray[$count]['id_comment']  = $c->id_comment;
				$commentArray[$count]['username']    = $username->name;
				$commentArray[$count]['profile_pic'] = $username->profile_pic;
				$commentArray[$count]['date']        = $c->created_at;

				$response = DB::table('comments')
					->where('id_comment', $c->id)
					->where('id_band', Request::get('id'))
					->whereNull('id_response')
					->orderBy('created_at', 'asc')
					->get();

				$responsesArray = array();
				$countresp = 0;

				foreach ($response as $resp) {

					$userresp = DB::table('users')->where('id', $resp->id_user)->first();

					$responsesArray[$countresp]['id']          = $resp->id;
					$responsesArray[$countresp]['response']    = $resp->comment;
					$responsesArray[$countresp]['title']       = $resp->title;
					$responsesArray[$countresp]['like']        = $resp->like;
					$responsesArray[$countresp]['type']        = $resp->type;
					$responsesArray[$countresp]['id_album']    = $resp->id_album;
					$responsesArray[$countresp]['id_user']     = $resp->id_user;
					$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
					$responsesArray[$countresp]['username']    = $userresp->name;
					$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
					$responsesArray[$countresp]['date']        = $resp->created_at;

					$countresp++;

				}

				$commentArray[$count]['responses'] = $responsesArray;
				$count++;

	        }

	        foreach ($comalbum as $c) {

	        	$username = DB::table('users')->where('id', $c->id_user)->first();

				if ($c->type == 'album' && !in_array($c->id_album, $showedalbums)) {

					$commentArray[$count]['id']          = $c->id;
					$commentArray[$count]['comment']     = $c->comment;
					$commentArray[$count]['title']       = $c->title;
					$commentArray[$count]['like']        = $c->like;
					$commentArray[$count]['type']        = $c->type;
					$commentArray[$count]['id_album']    = $c->id_album;
					$commentArray[$count]['id_user']     = $c->id_user;
					$commentArray[$count]['id_comment']  = $c->id_comment;
					$commentArray[$count]['username']    = $username->name;
					$commentArray[$count]['profile_pic'] = $username->profile_pic;
					$commentArray[$count]['date']        = $c->created_at;
						
	              	$showedalbums[] = array_push($showedalbums, $c->id_album);
                          
                              $pictures = DB::table('comments')
                                    ->where('id_album', $c->id_album)
                                    ->where('type', 'album')
                                    ->get(); 
                                  
                              $album = DB::table('albums')
                                    ->where('id_band', $c->id_wall)
                                    ->where('id', $c->id_album)
                                    ->first();

                    for ($i=0; $i < count($pictures); $i++) { 
                    	$albumArray[$i] = $pictures[$i]->comment;
                    }

                    $commentArray[$count]['pictures']   = $albumArray;
                    $commentArray[$count]['album_name'] = $album->name;

				}

				$response = DB::table('comments')
					->where('id_comment', $c->id)
					->where('id_band', Request::get('id'))
					->whereNull('id_response')
					->orderBy('created_at', 'asc')
					->get();

				$responsesArray = array();
				$countresp = 0;

				foreach ($response as $resp) {

					$userresp = DB::table('users')->where('id', $resp->id_user)->first();

					$responsesArray[$countresp]['id']          = $resp->id;
					$responsesArray[$countresp]['response']    = $resp->comment;
					$responsesArray[$countresp]['title']       = $resp->title;
					$responsesArray[$countresp]['like']        = $resp->like;
					$responsesArray[$countresp]['type']        = $resp->type;
					$responsesArray[$countresp]['id_album']    = $resp->id_album;
					$responsesArray[$countresp]['id_user']     = $resp->id_user;
					$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
					$responsesArray[$countresp]['username']    = $userresp->name;
					$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
					$responsesArray[$countresp]['date']        = $resp->created_at;

					$countresp++;

				}

				$commentArray[$count]['responses'] = $responsesArray;
				$count++;

	        }

        	foreach ($videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$videosArray[$countv]['id']      = $v->id;
				$videosArray[$countv]['img']     = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$videosArray[$countv]['song']    = $vinfo[0];
				$videosArray[$countv]['artist']  = $vinfo[1];
				$videosArray[$countv]['views']   = $v->views;
				$videosArray[$countv]['likes']   = $v->likes;
				$videosArray[$countv]['id_band'] = $v->id_band;
				$videosArray[$countv]['id_url']  = $idurl[1];
				$videosArray[$countv]['route']   = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				$videosArray[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';

				$countv++;

	        }

	        $generos = unserialize($band->id_genre);
	        $genres = '';
	        foreach ($generos as $g) {
	        	if ($genres == '') {
	        		$genres = $g;
	        	}else{
	        		$genres = $genres.' , '.$g;
	        	}
	        }

	        
	        $wall['band']       = $band;
	        $wall['genres']     = $genres;
	        $wall['members'] = $membersArray;
			$wall['comments']   = $commentArray;
			$wall['videos']     = $videosArray;
			$wall['followers']  = $followers;

			header("Content-Type: application/json", true);
	        echo json_encode($wall);

		}
	}
	public function bandsAbout()
	{
		if (Auth::check()) {

			$about = array();

			$band = DB::table('bands')
				->where('id', Request::get('id'))
				->first();
			$users = DB::table('users')
				->where('id_band', $band->id)
				->get();

			$membersArray = array();

        	foreach ($users as $u) {

        		$member = DB::table('members')
	        		->where('id_user', $u->id)
	        		->where('verified', 'Y')
	        		->first();

				$membersArray[$u->id]['name'] = $u->name;
				$membersArray[$u->id]['roles'] = $member->role;


	        }

	        $about['band']    = $band;
			$about['members'] = $membersArray;

	        return $about;

		}
	}

	public function musiciansAbout()
	{
		if (Auth::check()) {

			$about = array();

			$musician = DB::table('musicians')
				->where('id', Request::get('id'))
				->first();

	        $about['name']   = $musician->artistic_name;
			$about['about']  = $musician->about;
			$about['rol']    = $musician->role;
			$about['genres'] = $musician->genres;

	        return $about;

		}
	}

	public function favoriteVideos()
	{
		if (Auth::check()) {

			$videos = DB::table('pv_uservideo')->where('pv_uservideo.id_user', Request::get('id'))
                    ->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
                    ->select('videos.*')
                    ->orderBy('pv_uservideo.created_at', 'desc')
                    ->get();

	       
            $videosArray = array();
            $response = array();
            $countv = 0;

        	foreach ($videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('- ', $v->name);
        		$song = $vinfo[0];
        		$artist = $vinfo[1];

        		$videosArray[$countv]['id']          = $v->id;
				$videosArray[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$videosArray[$countv]['song']        = $song;
				$videosArray[$countv]['letter']      = $song[0];
				$videosArray[$countv]['artist']      = $artist;
				$videosArray[$countv]['letterA']     = $artist[0];
				$videosArray[$countv]['views']       = $v->views;
				$videosArray[$countv]['likes']       = $v->likes;
				if (is_null($v->id_band)) {
					$videosArray[$countv]['type']        = 'M';
					$videosArray[$countv]['id_musician'] = $v->id_musician;
					$videosArray[$countv]['id_wall']     = $v->id_user;
					$videosArray[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_musician.'&type=M';
				}else{
					$videosArray[$countv]['type']        = 'B';
					$videosArray[$countv]['id_band']     = $v->id_band;
					$videosArray[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;

	        }

	        $byArt = $videosArray;
	        
	        usort($videosArray, function($a, $b){ return strcmp($a['song'], $b['song']); });
	        usort($byArt, function($a, $b){ return strcmp($a['artist'], $b['artist']); });

	     $response['videos']  = $videosArray;
	     $response['videosA'] = $byArt;

	    header("Content-Type: application/json", true);
		echo json_encode($response);


		}
	}

	public function videosMusicians()
	{
		if (Auth::check()) {

			$id = $_GET['id'];

			$musician = DB::table('musicians')->where('id_user', $id)->first();

			$videos = DB::table('videos')
					->where('id_musician', $musician->id)
                    ->get();

            $videosArray = array();
            $response = array();
            $countv = 0;

        	foreach ($videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name);

        		$videosArray[$countv]['id']          = $v->id;
				$videosArray[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$videosArray[$countv]['song']        = $vinfo[0];
				$videosArray[$countv]['artist']      = $vinfo[1];
				$videosArray[$countv]['views']       = $v->views;
				$videosArray[$countv]['likes']       = $v->likes;
				$videosArray[$countv]['id_user']     = $v->id_user;
				$videosArray[$countv]['type']        = 'M';
				$videosArray[$countv]['id_musician'] = $v->id_musician;
				$videosArray[$countv]['id_wall']     = $v->id_user;
				$videosArray[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';

				$countv++;

	        }

	     $response['videos'] = $videosArray;

	    header("Content-Type: application/json", true);
		echo json_encode($response);

		}
	}

	public function showVideos()
	{
		if (Auth::check()) {

			$videos = DB::table('videos')->orderBy('name')->get();
			$videosArray = array();
			$countv = 0;

	        foreach ($videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name);

        		$videosArray[$countv]['id']          = $v->id;
				$videosArray[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$videosArray[$countv]['song']        = $vinfo[0];
				$videosArray[$countv]['artist']      = $vinfo[1];
				$videosArray[$countv]['views']       = $v->views;
				$videosArray[$countv]['likes']       = $v->likes;
				$videosArray[$countv]['id_user']     = $v->id_user;
				if(is_null($v->id_band)){
					$videosArray[$countv]['type']        = 'M';
					$videosArray[$countv]['id_musician'] = $v->id_musician;
					$videosArray[$countv]['id_wall']     = $v->id_user;
					$videosArray[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
				}else{
					$videosArray[$countv]['type']      = 'B';
					$videosArray[$countv]['id_band']   = $v->id_band;
					$videosArray[$countv]['route']     = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$videosArray[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;

	        }

	         $response['videos'] = $videosArray;

		    header("Content-Type: application/json", true);
			echo json_encode($response);

		}
	}

	public function rankingWall()
	{

		$ranking = array();
		$countv  = 0;
		$rank1 	 = array();
		$rank2 	 = array();
		$rank3 	 = array();
		$rank4 	 = array();
		$rank5 	 = array();
		$rank6 	 = array();
  	
  	//---------------------Concurso 1 - Music Performance -----------------------------//
            
            $performancevideos = DB::table('battles')
                        ->orderBy('votes', 'desc')
                        ->get();


            foreach($performancevideos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$rank6[$countv]['id']          = $v->id;
				$rank6[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$rank6[$countv]['song']        = $vinfo[0];
				$rank6[$countv]['artist']      = $vinfo[1];
				$rank6[$countv]['votes']       = $v->votes;
				$rank6[$countv]['likes']       = $v->likes;

				if(is_null($v->id_band)){

					$musician = DB::table('users')->where('id_musician', $v->id_user)->first();

					$rank6[$countv]['type']        = 'M';
					$rank6[$countv]['id_musician'] = $v->id_user;
					$rank6[$countv]['id_wall']     = $musician->id_wall;
					$rank6[$countv]['route_musician'] = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
					$rank6[$countv]['route_song']     = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}else{
					$rank6[$countv]['type']       = 'B';
					$rank6[$countv]['id_band']    = $v->id_band;
					$rank6[$countv]['route_band'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
					$rank6[$countv]['route_song'] = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}

				$countv++;

	        }

	        $countv = 0;

        //---------------------Concurso 2 - 10 clasificated songs -----------------------------//
            
            $videos_clasif = DB::table('battles')
        				->where('llave', '2')
        				->orderBy('votes', 'desc')
        				->groupBy('id_band')
        				->take(10)
        				->get();

        	foreach($videos_clasif as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$rank1[$countv]['id']          = $v->id;
				$rank1[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$rank1[$countv]['song']        = $vinfo[0];
				$rank1[$countv]['artist']      = $vinfo[1];
				$rank1[$countv]['votes']       = $v->votes;
				$rank1[$countv]['likes']       = $v->likes;

				if(is_null($v->id_band)){

					$musician = DB::table('users')->where('id_musician', $v->id_user)->first();

					$rank1[$countv]['type']        = 'M';
					$rank1[$countv]['id_musician'] = $v->id_user;
					$rank1[$countv]['id_wall']     = $musician->id_wall;
					$rank1[$countv]['route_musician'] = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
					$rank1[$countv]['route_song']     = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}else{
					$rank1[$countv]['type']    = 'B';
					$rank1[$countv]['id_band'] = $v->id_band;
					$rank1[$countv]['route_band'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
					$rank1[$countv]['route_song'] = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}

				$countv++;

	        }

	        $countv = 0;

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

			foreach($video_contest as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name_video);

        		$rank2[$countv]['id']          = $v->id;
				$rank2[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$rank2[$countv]['song']        = $vinfo[0];
				$rank2[$countv]['artist']      = $vinfo[1];
				$rank2[$countv]['votes']       = $v->votes;
				$rank2[$countv]['likes']       = $v->likes;

				if(is_null($v->id_band)){

					$musician = DB::table('users')->where('id_musician', $v->id_user)->first();

					$rank2[$countv]['type']        = 'M';
					$rank2[$countv]['id_musician'] = $v->id_user;
					$rank2[$countv]['id_wall']     = $musician->id_wall;
					$rank2[$countv]['route_musician'] = '/mobile_app/profile.html?id='.$musician->id.'&type=M';
					$rank2[$countv]['route_song']  = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}else{
					$rank2[$countv]['type']    = 'B';
					$rank2[$countv]['id_band'] = $v->id_band;
					$rank2[$countv]['route_band'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
					$rank2[$countv]['route_song'] = '/mobile_app/video_reproductor.html?id='.$v->id.'';
				}

				$countv++;

	        }

	        $countv = 0;


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

	        foreach ($videos_clasif as $cont) {
	        	
        		$idurl = explode('=', $cont->url);
        		$vinfo = explode('-', $cont->name_video);

        		$rank3[$countv]['id']          = $cont->id;
				$rank3[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$rank3[$countv]['song']        = $vinfo[0];
				$rank3[$countv]['artist']      = $vinfo[1];
				$rank3[$countv]['votes']       = $cont->votes;

	        	if (is_null($cont->id_user)) {

	        		$banda = DB::table('bands')->where('id', $cont->id_band)->first();

	        		$rank3[$countv]['favorite']    = $banda->favorite;
	        		$rank3[$countv]['profile_pic'] = $banda->profile_pic;
	        		$rank3[$countv]['type']  = 'B';
	        		$rank3[$countv]['route_band'] = '/mobile_app/profile.html?id='.$cont->id_band.'&type=B';
	        		$rank3[$countv]['route_song'] = '/mobile_app/video_reproductor.html?id='.$cont->id.'';
	        	}else{
	        		$musician = DB::table('users')->where('id_musician', $v->id_user)->first();

	        		$rank3[$countv]['favorite']    = $musician->favorite;
	        		$rank3[$countv]['profile_pic'] = $musician->profile_pic;
	        		$rank3[$countv]['type']        = 'M';
	        		$rank3[$countv]['route_musician'] = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
	        		$rank3[$countv]['route_song'] = '/mobile_app/video_reproductor.html?id='.$cont->id.'';
	        	}
	        	
	        	$countv++;

	        }

	        $countv = 0;


        //---------------------Concurso 5: Más followers -----------------------------//

            $followeds =   $contestants;
            	
            	usort($followeds, function($a, $b) {
                	
                	return $b->favorite - $a->favorite;
            });

           	foreach ($followeds as $cont) {
	        	
	        	$rank4[$countv]['id']          = $cont->id;
	        	$rank4[$countv]['followers']   = $cont->favorite;
	        	$rank4[$countv]['profile_pic'] = $cont->profile_pic;

	        	if (is_null($cont->id_user)) {
	        		$rank4[$countv]['name']  = $cont->name;
	        		$rank4[$countv]['type']  = 'B';
	        		$rank4[$countv]['route'] = '/mobile_app/profile.html?id='.$cont->id.'&type=B';
	        	}else{
	        		$musician = DB::table('users')->where('id_musician', $cont->id_user)->first();
	        		$rank4[$countv]['name']  = $cont->artistic_name;
	        		$rank4[$countv]['type']  = 'M';
	        		$rank4[$countv]['route'] = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
	        	}
	        	
	        	$countv++;

	        	if ($countv == 9) {
	        		break;
	        	}
	        }

	        $countv = 0;


        //---------------------Concurso 6: Fans con mayor actividad -----------------------------//
            
            $fans = DB::table('users')
            	->where('user_level', '4')
            	->orderBy('activity_count', 'desc')
            	->take(10)
            	->get();

           	foreach ($fans as $cont) {
	        	
	        	$rank5[$countv]['id']          = $cont->id;
	        	$rank5[$countv]['followers']   = $cont->followers;
	        	$rank5[$countv]['profile_pic'] = $cont->profile_pic;
        		$rank5[$countv]['name']        = $cont->name;
        		$rank5[$countv]['route']       = '/mobile_app/profile.html?id='.$cont->id.'&type=U';

	        }

	        $countv = 0;
		$array_musicians = DB::table('musicians')->get();

        $ranking['music_performance']    = $rank6;
        $ranking['search_music']         = $performancevideos;
        $ranking['musicians']            = $array_musicians;
        $ranking['clasificated_artists'] = $rank3;
        $ranking['clasificated_songs']   = $rank1;
        $ranking['top_10']               = $rank2;
        $ranking['artist_followers']     = $rank4;
        $ranking['fan_followers']        = $rank5;


       	header("Content-Type: application/json", true);
	    echo json_encode($ranking);
	}


    public function loginService(Request $request)
    {

        $user = DB::table('users')->where('email', Request::get('email'))->first();

        if (is_null($user)) {

        	header("Content-Type: application/json", true);
        	$response = "msg2";
            echo json_encode($response);
        } else {
	        $userdata = array(
	            'email' => Request::get('email'),
	            'password' => Request::get('password')
	             );

	       
	        if(Auth::attempt($userdata)){
	        	header("Content-Type: application/json", true);
	            echo json_encode($user);

	        }else{

	        	header("Content-Type: application/json", true);
	        	$response = "msg1";
	            echo json_encode($response);

	        }        	
        }
 
    }

    public function registerService(Request $request)
    {
    	
        $fan = new User;
        $very = User::where('email','=',  Request::get('email'))->count();

        if ($very > 0){
            
        	header("Content-Type: application/json", true);
        	$response = "msg1";
            echo json_encode($response);
        
        }else{      

            $fan->email = Request::get('email');
	        $fan->name        = Request::get('name');
	        $fan->password    = Hash::make(Request::get('password'));
	        $fan->country     = Request::get('country');
	        $fan->province    = Request::get('province');
	        $fan->zipcode     = Request::get('zipcode');
	        $fan->profile_pic = '../../images/avatar.jpg'; 
	            
	            $fan->status      = 'A';

	        if (Request::get('type') == 'B') {
	            
	            $fan->user_level  = '5';
	        
	        }else{

	            $fan->user_level  = '4';

	        }
	        
	        $fan->verified    = '0';
	        $fan->email_token = Hash::make($fan->password);
	        
	        $genres = Request::get('id_genre');
	        $fan->id_genre = serialize($genres);        

	        if ($fan->name == '' || $fan->password == '' || $fan->province == '' || $fan->email == '' ) {

	           	header("Content-Type: application/json", true);
		        $response = "msg2";
		        echo json_encode($response);
	        
	        }else{
	            
	           $fan->id_wall = $fan->id;
	           $fan->save();

	            $topica['especificaciones'] = $fan->email_token;
	                
	                $user = $fan;
	                $data = ['user' => $user, 'topica' => $topica];

	                if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

	                    Mail::send('mailmobile', $data, function($message) use ($topica, $user)
	                        {
	                            $message->to($user->email)->subject('YLMM - Validación de Email');
	                        });
	                    
	                    }
	                
	               	header("Content-Type: application/json", true);
		        	$response = "Success";
		            echo json_encode($response);
	         }
	     }
    }

 	public function emailValidatorService()
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
                
                return Redirect::to('/mobile_app/index.html?id='.$user->id_wall);
            
            }else{
            
                return Redirect::to('/mobile_app/index.html?id='.$user->id_wall.'&type=U');    
            }
            
       }else{

        return Redirect::to('/login.html?msg=3');
       }
    }

	 public function membersValidatorService()
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
        	$notification->id_user = $noto->id;
        	$notification->id_band = $band->id;
        	$notification->seen = 'N';
        	$notification->save();

       		return Redirect::to('/mobile_app/profile.html?id='.$band->id.'&type=B');   
       }else{

            return Redirect::to('/mobile_app/index.html?id='.Auth::user()->id.'&type=M');   
       }
   }

    public function logoutMobile()
    {
        Auth::logout();

        return Redirect::to('/mobile_app/login.html');

    }

	
	public function musicianUpdateService(Request $request)
    {
    	
        if (Auth::check()) {

           $user = User::find(Auth::user()->id);

           $musician = new Musicians;

            $musician->artistic_name = Request::get('name');

            $genres = Request::get('id_genre');

            if (Request::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Request::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);

            $musician->genres = serialize($mgenre);
            
            $roles = Request::get('role');

                if (Request::get('cuerda') != '') {

                    $roles = array_diff($roles, ["CUERDA"]);

                    array_push($roles, strtoupper(Request::get('cuerda')));
                }
                if (Request::get('viento') != '') {

                    $roles = array_diff($roles, ["VIENTO"]);

                    array_push($roles, strtoupper(Request::get('viento')));
                }
                if (Request::get('otro') != '') {

                    $roles = array_diff($roles, ["OTRO"]);

                    array_push($roles, strtoupper(Request::get('otro')));
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

            $country = Request::get('selectedcountry');
            $province = Request::get('selectedprovince');

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
			
			header("Content-Type: application/json", true);
			$response = "Success";
			echo json_encode($response);
    	}
	}
public function fanUpdateService(Request $request)
{
     if (Auth::check()) {

        $country = Request::get('selectedcountry');
        $province = Request::get('selectedprovince');

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

        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        header("Content-Type: application/json", true);
		$response = "Success";
		echo json_encode($response);

    }else{
        
        header("Content-Type: application/json", true);
		$response = "Error";
		echo json_encode($response);
    }
    
}

public function createBand(Request $request){
    
    if (Auth::check()) {

    $band = new Bands;

    $counter = Request::get('number_array') - 1;
    $user_array = Request::get('user_array');
    $members = explode('__', $user_array);
    $very = 0;
    

    $band->name = Request::get('name');
    $genres = Request::get('id_genre');

        if (Request::get('other') != '') {

            $genres = array_diff($genres, ["OTRO"]);

            array_push($genres, strtoupper(Request::get('other')));
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
            $roles = Request::get('role_'.$i.'');

            if (Request::get('cuerda_'.$i.'') != '') {

                $roles = array_diff($roles, ["cuerda"]);

                array_push($roles, Request::get('cuerda_'.$i.''));
            }
            if (Request::get('viento_'.$i.'') != '') {

                $roles = array_diff($roles, ["viento"]);

                array_push($roles, Request::get('viento_'.$i.''));
            }
            if (Request::get('otro_'.$i.'') != '') {

                $roles = array_diff($roles, ["otro"]);

                array_push($roles, Request::get('otro_'.$i.''));
            }

        $role = serialize($roles);

        $admin = Auth::user()->name;

        $data = ['user' => $user, 'topica' => $topica, 'band' => $idband, 'role' => $role, 'admin' => $admin];

            if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

                Mail::send('membersmobile', $data, function($message) use ($topica, $user)
                    {
                        $message->to($user->email)->subject('YLMM - Te han invitado a formar parte de una banda');
                    });
    
            }
    }



    if ($band->name == '') {

		header("Content-Type: application/json", true);
		$response = "msg1";
		echo json_encode($response);  
    
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
        
        header("Content-Type: application/json", true);
		$response = $band->id;
		echo json_encode($response);
    
    };

    }else{
        
       	header("Content-Type: application/json", true);
		$response = "msg2";
		echo json_encode($response);
    }
  }

  public function showArtists()
  {
  	$musicians = DB::table('musicians')->orderBy('artistic_name', 'asc')->get();
  	$bands = DB::table('bands')->orderBy('name', 'asc')->get();
  	$countv = 0;
  	$byName = array();
  	$byMusicians = array();
  	$byBands = array();
  	$top_3 = array();


   	foreach ($musicians as $m) {
   		$contestants[] = $m;
   	}

   	foreach ($bands as $b) {
   		$contestants[] = $b;
   	}

   	$top3 = $contestants;

            	
	usort($top3, function($a, $b) {

		return $b->favorite - $a->favorite;

	});

	foreach ($contestants as $cont) {
    	
    	$byName[$countv]['id']          = $cont->id;
    	$byName[$countv]['followers']   = $cont->favorite;
    	$byName[$countv]['profile_pic'] = $cont->profile_pic;

    	if (is_null($cont->id_user)) {
    		$byName[$countv]['name']   = $cont->name;
    		$byName[$countv]['letter'] = $cont->name[0];
    		$byName[$countv]['type']   = 'B';
    		$byName[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id.'&type=B';
    	}else{
    		$byName[$countv]['name']   = $cont->artistic_name;
    		$byName[$countv]['letter'] = $cont->artistic_name[0];
    		$byName[$countv]['type']   = 'M';
    		$byName[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
    	}
    	
    	$countv++;
    }
	
	$countv = 0;

	usort($byName, function($a, $b){ return strcmp($a['name'], $b['name']); });

   	foreach ($top3 as $cont) {
    	
    	$top_3[$countv]['id']          = $cont->id;
    	$top_3[$countv]['followers']   = $cont->favorite;
    	$top_3[$countv]['profile_pic'] = $cont->profile_pic;

    	if (is_null($cont->id_user)) {
    		$top_3[$countv]['name']   = $cont->name;
    		$top_3[$countv]['letter'] = $cont->name[0];
    		$top_3[$countv]['type']   = 'B';
    		$top_3[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id.'&type=B';
    	}else{
    		$top_3[$countv]['name']   = $cont->artistic_name;
    		$top_3[$countv]['letter'] = $cont->artistic_name[0];
    		$top_3[$countv]['type']   = 'M';
    		$top_3[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
    	}
    	
    	$countv++;
    }

    $countv = 0;


   	foreach ($musicians as $cont) {
    	
    	$byMusicians[$countv]['id']          = $cont->id;
    	$byMusicians[$countv]['followers']   = $cont->favorite;
    	$byMusicians[$countv]['profile_pic'] = $cont->profile_pic;
		$byMusicians[$countv]['name']        = $cont->artistic_name;
		$byMusicians[$countv]['letter']      = $cont->artistic_name[0];
		$byMusicians[$countv]['type']        = 'M';
		$byMusicians[$countv]['route']       = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
    	
    	$countv++;
    }

   	$countv = 0;


   	foreach ($bands as $cont) {
    	
    	$byBands[$countv]['id']          = $cont->id;
    	$byBands[$countv]['followers']   = $cont->favorite;
    	$byBands[$countv]['profile_pic'] = $cont->profile_pic;
		$byBands[$countv]['name']        = $cont->name;
		$byBands[$countv]['letter']      = $cont->name[0];
		$byBands[$countv]['type']        = 'B';
		$byBands[$countv]['route']       = '/mobile_app/profile.html?id='.$cont->id.'&type=B';

    	
    	$countv++;
    }

	$countv = 0;

	$response['top3'] = $top_3;
	$response['all'] = $byName;
	$response['artists'] = $byMusicians;
	$response['bands'] = $byBands;

	header("Content-Type: application/json", true);
	echo json_encode($response);

  }

	public function artistsByGenre()
	{
		if (Auth::check()) {

			$musicians = DB::table('musicians')->orderBy('artistic_name', 'asc')->get();
  			$bands = DB::table('bands')->orderBy('name', 'asc')->get();
  			$artists = array();
  			$countv = 0;

		   	foreach ($musicians as $m) {
		   		$contestants[] = $m;
		   	}

		   	foreach ($bands as $b) {
		   		$contestants[] = $b;
		   	}

			foreach ($contestants as $cont) {
		    	
		    	$artists[$countv]['id']          = $cont->id;
		    	$artists[$countv]['followers']   = $cont->favorite;
		    	$artists[$countv]['profile_pic'] = $cont->profile_pic;

		    	if (is_null($cont->id_user)) {
		    		$artists[$countv]['name']   = $cont->name;
		    		$artists[$countv]['letter'] = $cont->name[0];
		    		$artists[$countv]['type']   = 'B';
		    		$artists[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id.'&type=B';
		    		$artists[$countv]['genres'] = unserialize($cont->id_genre);
		    	}else{
		    		$artists[$countv]['name']   = $cont->artistic_name;
		    		$artists[$countv]['letter'] = $cont->artistic_name[0];
		    		$artists[$countv]['type']   = 'M';
		    		$artists[$countv]['route']  = '/mobile_app/profile.html?id='.$cont->id_user.'&type=M';
		    		$artists[$countv]['genres'] = unserialize($cont->genres);
		    	}
		    	
		    	$countv++;
		    }

		    $byFollowers = $artists;

		   	usort($artists, function($a, $b){ return strcmp($a['name'], $b['name']); });
            usort($byFollowers, function($a, $b) {

                return $b['followers'] - $a['followers'];

            });

            $response['byAlf'] = $artists;
            $response['byFw']  = $byFollowers;

		    header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function videoReproductor()
	{

			$idvideo  = $_GET['id_video'];
			$video    = DB::table('videos')->where('id', $idvideo)->first();
			$comments = DB::table('comments')->where('id_video', $idvideo)->whereNull('id_comment')->get();

			$videoArray = array();
			$commentArray = array();
			$relatedVideos = array();

			$count = 0;
			$countv = 0;

			$idurl = explode('=', $video->url);
			$vinfo = explode('-', $video->name);

			$videoArray['id']      = $video->id;
			$videoArray['img']     = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
			$videoArray['song']    = $vinfo[0];
			$videoArray['artist']  = $vinfo[1];
			$videoArray['idurl']   = $idurl[1];
			$videoArray['views']   = $video->views;
			$videoArray['likes']   = $video->likes;
			$videoArray['id_user'] = $video->id_user;
			$videoArray['counter'] = count($comments);

			if(is_null($video->id_band)){

				$user = DB::table('users')->where('id', $video->id_user)->first();
				$musician = DB::table('musicians')->where('id_user', $video->id_user)->first();

				$videoArray['type']        = 'M';
				$videoArray['id_musician'] = $video->id_musician;
				$videoArray['id_wall']     = $video->id_user;
				$videoArray['route']       = '/mobile_app/profile.html?id='.$video->id_user.'&type=M';
				$videoArray['profile_pic'] = $user->profile_pic;
				$videoArray['about']       = $musician->about;

		        $related_videos = DB::table('videos')
	                            ->where('id_musician', $video->id_musician)
	                            ->where('id', '<>', $video->id)
	                            ->get();

			}else{

				$user = DB::table('bands')->where('id', $video->id_band)->first();

				$videoArray['type']    = 'B';
				$videoArray['id_band'] = $video->id_band;
				$videoArray['route']   = '/mobile_app/profile.html?id='.$video->id_band.'&type=B';
				$videoArray['profile_pic'] = $user->profile_pic;
				$videoArray['about']       = $user->about;

				$related_videos = DB::table('videos')
								->where('id_band', $video->id_band)
								->where('id', '<>', $video->id)
								->get();

			}

			foreach ($comments as $c) {

	        	$username = DB::table('users')->where('id', $c->id_user)->first();

	        	$commentArray[$count]['id']          = $c->id;
				$commentArray[$count]['text']        = $c->comment;
				$commentArray[$count]['title']       = $c->title;
				$commentArray[$count]['like']        = $c->like;
				$commentArray[$count]['id_user']     = $c->id_user;
				$commentArray[$count]['id_video']    = $c->id_video;
				$commentArray[$count]['id_comment']  = $c->id_comment;
				$commentArray[$count]['username']    = $username->name;
				$commentArray[$count]['profile_pic'] = $username->profile_pic;
				$commentArray[$count]['date']        = $c->created_at;
				$commentArray[$count]['route']       = '/mobile_app/profile.html?id='.$username->id.'&type=M';

				$response = DB::table('comments')
					->where('id_comment', $c->id)
					->where('id_video', $idvideo)
					->whereNull('id_response')
					->orderBy('created_at', 'asc')
					->get();

				$responsesArray = array();
				$countresp = 0;

				foreach ($response as $resp) {

					$userresp = DB::table('users')->where('id', $resp->id_user)->first();

					$responsesArray[$countresp]['id']          = $resp->id;
					$responsesArray[$countresp]['text']        = $resp->comment;
					$responsesArray[$countresp]['title']       = $resp->title;
					$responsesArray[$countresp]['like']        = $resp->like;
					$responsesArray[$countresp]['id_user']     = $resp->id_user;
					$responsesArray[$countresp]['id_video']    = $resp->id_video;
					$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
					$responsesArray[$countresp]['username']    = $userresp->name;
					$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
					$responsesArray[$countresp]['date']        = $resp->created_at;
					$responsesArray[$countresp]['route']       = '/mobile_app/profile.html?id='.$userresp->id.'&type=M';

					$countresp++;

				}

				$commentArray[$count]['responses'] = $responsesArray;
				$count++;

	        }

	        foreach ($related_videos as $v) {

        		$idurl = explode('=', $v->url);
        		$vinfo = explode('-', $v->name);

        		$relatedVideos[$countv]['id']          = $v->id;
				$relatedVideos[$countv]['img']         = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
				$relatedVideos[$countv]['song']        = $vinfo[0];
				$relatedVideos[$countv]['artist']      = $vinfo[1];
				$relatedVideos[$countv]['views']       = $v->views;
				$relatedVideos[$countv]['likes']       = $v->likes;
				$relatedVideos[$countv]['id_user']     = $v->id_user;
				if(is_null($v->id_band)){
					$relatedVideos[$countv]['type']        = 'M';
					$relatedVideos[$countv]['id_musician'] = $v->id_musician;
					$relatedVideos[$countv]['id_wall']     = $v->id_user;
					$relatedVideos[$countv]['route']       = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$relatedVideos[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
				}else{
					$relatedVideos[$countv]['type']      = 'B';
					$relatedVideos[$countv]['id_band']   = $v->id_band;
					$relatedVideos[$countv]['route']     = '/mobile_app/video_reproductor.html?id='.$v->id.'';
					$relatedVideos[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
				}

				$countv++;

	    	}

	        $response['video']    = $videoArray;
	        $response['comments'] = $commentArray;
	        $response['related']  = $relatedVideos;

		    header("Content-Type: application/json", true);
			echo json_encode($response);
		
	}

	public function showFollowErsIng()
	{
		if (Auth::check()) {

			$id_wall = $_GET['id'];

			$response = array();

			$user = DB::table('users')->where('id_wall', $id_wall)->first();

			$favorites = DB::table('favorites')
                       ->where('id_user', $user->id)
                       ->get();

            if (is_null($user->id_musician)) {
            
				$follower = DB::table('favorites')
	           		->where('id_fan', $user->id)
	           		->get();                       

            }else{


				$follower = DB::table('favorites')
	           		->where('id_musician', $user->id_musician)
	           		->get();                       

            }

            $following = array();
            $followers = array();

            $count = 0;
           
			foreach ($favorites as $f) {

				if (!is_null($f->id_band) && is_null($f->id_fan) && is_null($f->id_musician)) {

					$band = DB::table('bands')->where('id', $f->id_band)->first();

					$following[$count]['id'] = $band->id;
					$following[$count]['profile_pic'] = $band->profile_pic; 
					$following[$count]['name'] = $band->name; 
					$following[$count]['route'] = '/mobile_app/profile.html?id='.$band->id.'&type=B';
					$following[$count]['type'] = 'Banda';
					
				}

				if (!is_null($f->id_fan) && is_null($f->id_band) && is_null($f->id_musician)) {

					$user = DB::table('users')->where('id', $f->id_fan)->first();

					$following[$count]['id'] = $user->id;
					$following[$count]['profile_pic'] = $user->profile_pic; 
					$following[$count]['name'] = $user->name; 
					$following[$count]['route'] = '/mobile_app/profile.html?id='.$user->id.'&type=U';
					$following[$count]['type'] = 'Fan';

				}
				if (!is_null($f->id_musician) && is_null($f->id_fan) && is_null($f->id_band)) {

					$user = DB::table('users')->where('id_musician', $f->id_musician)->first();

					$following[$count]['id'] = $user->id;
					$following[$count]['profile_pic'] = $user->profile_pic; 
					$following[$count]['name'] = $user->name; 
					$following[$count]['route'] = '/mobile_app/profile.html?id='.$user->id.'&type=U';
					$following[$count]['type'] = 'Músico';

				}
				

				$count++;
			}

			$count = 0;

			foreach ($follower as $f) {

				$user = DB::table('users')->where('id', $f->id_user)->first();

				$followers[$count]['id'] = $user->id;
				$followers[$count]['profile_pic'] = $user->profile_pic; 
				$followers[$count]['name'] = $user->name; 
				$followers[$count]['route'] = '/mobile_app/profile.html?id='.$user->id.'&type=U';
				if (is_null($f->id_musician)) {
					$followers[$count]['type'] = 'Fan';
				 }else{
				 	$followers[$count]['type'] = 'Músico';
				 } 
				

				$count++;
			}



			
			$response['followers'] = $followers;
            $response['following'] = $following;
			
			header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function showFollowersBands()
	{
		if (Auth::check()) {

			$id_band = $_GET['id'];

			$response = array();

			$band = DB::table('bands')->where('id', $id_band)->first();

			$follower = DB::table('favorites')
	           		->where('id_band', $band->id)
	           		->get();

            $followers = array();

            $count = 0;
           
			foreach ($follower as $f) {

				$user = DB::table('users')->where('id', $f->id_user)->first();

				$followers[$count]['id'] = $user->id;
				$followers[$count]['profile_pic'] = $user->profile_pic; 
				$followers[$count]['name'] = $user->name; 
				$followers[$count]['route'] = '/mobile_app/profile.html?id='.$user->id.'&type=U';
				if (is_null($f->id_musician)) {
					$followers[$count]['type'] = 'Fan';
				 }else{
				 	$followers[$count]['type'] = 'Músico';
				 } 
				

				$count++;
			}
			
			$response['followers'] = $followers;
			
			header("Content-Type: application/json", true);
			echo json_encode($response);
		}
	}

	public function updateBackgroundImg(Request $request)
	{

		$type   = $_GET['type'];
		$change = $_GET['change'];
		$return = '';
		
		$image64 = Request::get('picture');

		$rand = str_random(10);
            
        $findextension = explode('image/', $image64);

        $ext = explode(';', $findextension[1]);
            
        $name = $rand .'.' .$ext[0];

        $path = 'images/fotosperfil/'.$name;

        $image = Image::make($image64)->save($path);
        
        $path     = '../../images/fotosperfil/';

        $pic = $path . $name;

        if ($type === 'band' && $change === 'background') {
        	
        	DB::table('bands')->where('id', Auth::user()->id_band)->update(['background_pic' => $pic]);
        	$return = 'Success Band';

        }
        if ($type === 'band' && $change === 'profile') {
        	
        	DB::table('bands')->where('id', Auth::user()->id_band)->update(['profile_pic' => $pic]);
        	$return = 'Success Band';

        }
        if ($type === 'user' && $change === 'background') {
        	
        	DB::table('users')->where('id', Auth::user()->id)->update(['background_pic' => $pic]);
        	$return = 'Success User';

        }

        if ($type === 'user' && $change === 'profile') {
        	
        	DB::table('users')->where('id', Auth::user()->id)->update(['profile_pic' => $pic]);
        	$return = 'Success User';

        }

            header("Content-Type: application/json", true);
			echo json_encode($return);
	}

	public function generalWallService()
	{

		$wall = array();

		$user = DB::table('users')
				->where('id', Request::get('id'))
				->first();

		$following = DB::table('favorites')
          		->where('id_user', $user->id)
          		->get();

		if (is_null($user->id_musician)) {

         	$followers = $user->followers;

		}else{
				
			$musician = DB::table('musicians')
                      ->where('id', $user->id_musician)
                      ->first();

            $followers = $musician->favorite;
            $wall['musician'] = $musician;

		}

		$comments = DB::table('comments')
	            ->where('id_wall', Request::get('id'))
				->whereNull('id_comment')
				->whereNull('id_album')
            	->orderBy('created_at', 'desc')
            	->get();

        $comalbum = DB::table('comments')
	            ->where('id_wall', Request::get('id'))
				->whereNull('id_comment')
				->whereNotNull('id_album')
            	->orderBy('created_at', 'desc')
            	->get();

        $commentArray = array();
        $videosArray = array();
		$albumArray = array();
		$showedalbums = [];

        $count = 0;
        $countv = 0;

        foreach ($comments as $c) {

        	$username = DB::table('users')->where('id', $c->id_user)->first();

        	$commentArray[$count]['id']          = $c->id;
			$commentArray[$count]['comment']     = $c->comment;
			$commentArray[$count]['title']       = $c->title;
			$commentArray[$count]['like']        = $c->like;
			$commentArray[$count]['type']        = $c->type;
			$commentArray[$count]['id_album']    = $c->id_album;
			$commentArray[$count]['id_user']     = $c->id_user;
			$commentArray[$count]['id_comment']  = $c->id_comment;
			$commentArray[$count]['username']    = $username->name;
			$commentArray[$count]['profile_pic'] = $username->profile_pic;
			$commentArray[$count]['date']        = $c->created_at;
			$commentArray[$count]['route_art']   = '/mobile_app/profile.html?id='.$c->id_user.'&type=U';

			$response = DB::table('comments')
				->where('id_comment', $c->id)
				->where('id_wall', Request::get('id'))
				->whereNull('id_response')
				->orderBy('created_at', 'asc')
				->get();

			$responsesArray = array();
			$countresp = 0;

			foreach ($response as $resp) {

				$userresp = DB::table('users')->where('id', $resp->id_user)->first();

				$responsesArray[$countresp]['id']          = $resp->id;
				$responsesArray[$countresp]['response']    = $resp->comment;
				$responsesArray[$countresp]['title']       = $resp->title;
				$responsesArray[$countresp]['like']        = $resp->like;
				$responsesArray[$countresp]['type']        = $resp->type;
				$responsesArray[$countresp]['id_album']    = $resp->id_album;
				$responsesArray[$countresp]['id_user']     = $resp->id_user;
				$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
				$responsesArray[$countresp]['username']    = $userresp->name;
				$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
				$responsesArray[$countresp]['date']        = $resp->created_at;
				$responsesArray[$countresp]['route_art']   = '/mobile_app/profile.html?id='.$resp->id_user.'&type=U';

				$countresp++;

			}

			$commentArray[$count]['responses'] = $responsesArray;
			$count++;

        }

        foreach ($comalbum as $c) {

        	$username = DB::table('users')->where('id', $c->id_user)->first();

			if ($c->type == 'album' && !in_array($c->id_album, $showedalbums)) {

				$commentArray[$count]['id']          = $c->id;
				$commentArray[$count]['comment']     = $c->comment;
				$commentArray[$count]['title']       = $c->title;
				$commentArray[$count]['like']        = $c->like;
				$commentArray[$count]['type']        = $c->type;
				$commentArray[$count]['id_album']    = $c->id_album;
				$commentArray[$count]['id_user']     = $c->id_user;
				$commentArray[$count]['id_comment']  = $c->id_comment;
				$commentArray[$count]['username']    = $username->name;
				$commentArray[$count]['profile_pic'] = $username->profile_pic;
				$commentArray[$count]['date']        = $c->created_at;
				$commentArray[$count]['route_art']   = '/mobile_app/profile.html?id='.$c->id_user.'&type=U';
					
              	$showedalbums[] = array_push($showedalbums, $c->id_album);
                      
                          $pictures = DB::table('comments')
                                ->where('id_album', $c->id_album)
                                ->where('type', 'album')
                                ->get(); 
                              
                          $album = DB::table('albums')
                                ->where('id_wall', $c->id_wall)
                                ->where('id', $c->id_album)
                                ->first();

                for ($i=0; $i < count($pictures); $i++) { 
                	$albumArray[$i] = $pictures[$i]->comment;
                }

                $commentArray[$count]['pictures']   = $albumArray;
                $commentArray[$count]['album_name'] = $album->name;

			}

			$response = DB::table('comments')
				->where('id_comment', $c->id)
				->where('id_wall', Request::get('id'))
				->whereNull('id_response')
				->orderBy('created_at', 'asc')
				->get();

			$responsesArray = array();
			$countresp = 0;

			foreach ($response as $resp) {

				$userresp = DB::table('users')->where('id', $resp->id_user)->first();

				$responsesArray[$countresp]['id']          = $resp->id;
				$responsesArray[$countresp]['response']    = $resp->comment;
				$responsesArray[$countresp]['title']       = $resp->title;
				$responsesArray[$countresp]['like']        = $resp->like;
				$responsesArray[$countresp]['type']        = $resp->type;
				$responsesArray[$countresp]['id_album']    = $resp->id_album;
				$responsesArray[$countresp]['id_user']     = $resp->id_user;
				$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
				$responsesArray[$countresp]['username']    = $userresp->name;
				$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
				$responsesArray[$countresp]['date']        = $resp->created_at;
				$responsesArray[$countresp]['route']   = '/mobile_app/profile.html?id='.$resp->id_user.'&type=U';

				$countresp++;

			}

			$commentArray[$count]['responses'] = $responsesArray;
			$count++;

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

		        	$username = DB::table('users')->where('id', $c->id_user)->first();

		        	$commentArray[$count]['id']          = $c->id;
					$commentArray[$count]['comment']     = $c->comment;
					$commentArray[$count]['title']       = $c->title;
					$commentArray[$count]['like']        = $c->like;
					$commentArray[$count]['type']        = $c->type;
					$commentArray[$count]['id_album']    = $c->id_album;
					$commentArray[$count]['id_user']     = $c->id_user;
					$commentArray[$count]['id_comment']  = $c->id_comment;
					$commentArray[$count]['username']    = $username->name;
					$commentArray[$count]['profile_pic'] = $username->profile_pic;
					$commentArray[$count]['date']        = $c->created_at;
					$commentArray[$count]['route']   = '/mobile_app/profile.html?id='.$c->id_user.'&type=U';

					$response = DB::table('comments')
						->where('id_comment', $c->id)
						->where('id_wall', Request::get('id'))
						->whereNull('id_response')
						->orderBy('created_at', 'asc')
						->get();

					$responsesArray = array();
					$countresp = 0;

					foreach ($response as $resp) {

						$userresp = DB::table('users')->where('id', $resp->id_user)->first();

						$responsesArray[$countresp]['id']          = $resp->id;
						$responsesArray[$countresp]['response']    = $resp->comment;
						$responsesArray[$countresp]['title']       = $resp->title;
						$responsesArray[$countresp]['like']        = $resp->like;
						$responsesArray[$countresp]['type']        = $resp->type;
						$responsesArray[$countresp]['id_album']    = $resp->id_album;
						$responsesArray[$countresp]['id_user']     = $resp->id_user;
						$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
						$responsesArray[$countresp]['username']    = $userresp->name;
						$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
						$responsesArray[$countresp]['date']        = $resp->created_at;
						$responsesArray[$countresp]['route']   = '/mobile_app/profile.html?id='.$resp->id_user.'&type=U';

						$countresp++;

					}

					$commentArray[$count]['responses'] = $responsesArray;
					$count++;

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

		        	$username = DB::table('users')->where('id', $c->id_user)->first();

		        	$commentArray[$count]['id']          = $c->id;
					$commentArray[$count]['comment']     = $c->comment;
					$commentArray[$count]['title']       = $c->title;
					$commentArray[$count]['like']        = $c->like;
					$commentArray[$count]['type']        = $c->type;
					$commentArray[$count]['id_album']    = $c->id_album;
					$commentArray[$count]['id_user']     = $c->id_user;
					$commentArray[$count]['id_comment']  = $c->id_comment;
					$commentArray[$count]['username']    = $username->name;
					$commentArray[$count]['profile_pic'] = $username->profile_pic;
					$commentArray[$count]['date']        = $c->created_at;
					$commentArray[$count]['route']   = '/mobile_app/profile.html?id='.$c->id_user.'&type=U';

					$response = DB::table('comments')
						->where('id_comment', $c->id)
						->where('id_wall', Request::get('id'))
						->whereNull('id_response')
						->orderBy('created_at', 'asc')
						->get();

					$responsesArray = array();
					$countresp = 0;

					foreach ($response as $resp) {

						$userresp = DB::table('users')->where('id', $resp->id_user)->first();

						$responsesArray[$countresp]['id']          = $resp->id;
						$responsesArray[$countresp]['response']    = $resp->comment;
						$responsesArray[$countresp]['title']       = $resp->title;
						$responsesArray[$countresp]['like']        = $resp->like;
						$responsesArray[$countresp]['type']        = $resp->type;
						$responsesArray[$countresp]['id_album']    = $resp->id_album;
						$responsesArray[$countresp]['id_user']     = $resp->id_user;
						$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
						$responsesArray[$countresp]['username']    = $userresp->name;
						$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
						$responsesArray[$countresp]['date']        = $resp->created_at;
						$responsesArray[$countresp]['route']   = '/mobile_app/profile.html?id='.$resp->id_user.'&type=U';

						$countresp++;

					}

					$commentArray[$count]['responses'] = $responsesArray;
					$count++;

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

		        	$username = DB::table('users')->where('id', $c->id_user)->first();

		        	$commentArray[$count]['id']          = $c->id;
					$commentArray[$count]['comment']     = $c->comment;
					$commentArray[$count]['title']       = $c->title;
					$commentArray[$count]['like']        = $c->like;
					$commentArray[$count]['type']        = $c->type;
					$commentArray[$count]['id_album']    = $c->id_album;
					$commentArray[$count]['id_user']     = $c->id_user;
					$commentArray[$count]['id_comment']  = $c->id_comment;
					$commentArray[$count]['username']    = $username->name;
					$commentArray[$count]['profile_pic'] = $username->profile_pic;
					$commentArray[$count]['date']        = $c->created_at;
					$commentArray[$count]['route']   = '/mobile_app/profile.html?id='.$c->id_user.'&type=U';

					$response = DB::table('comments')
						->where('id_comment', $c->id)
						->where('id_wall', Request::get('id'))
						->whereNull('id_response')
						->orderBy('created_at', 'asc')
						->get();

					$responsesArray = array();
					$countresp = 0;

					foreach ($response as $resp) {

						$userresp = DB::table('users')->where('id', $resp->id_user)->first();

						$responsesArray[$countresp]['id']          = $resp->id;
						$responsesArray[$countresp]['response']    = $resp->comment;
						$responsesArray[$countresp]['title']       = $resp->title;
						$responsesArray[$countresp]['like']        = $resp->like;
						$responsesArray[$countresp]['type']        = $resp->type;
						$responsesArray[$countresp]['id_album']    = $resp->id_album;
						$responsesArray[$countresp]['id_user']     = $resp->id_user;
						$responsesArray[$countresp]['id_comment']  = $resp->id_comment;
						$responsesArray[$countresp]['username']    = $userresp->name;
						$responsesArray[$countresp]['profile_pic'] = $userresp->profile_pic;
						$responsesArray[$countresp]['date']        = $resp->created_at;
						$responsesArray[$countresp]['route']   = '/mobile_app/profile.html?id='.$resp->id_user.'&type=U';

						$countresp++;

					}

					$commentArray[$count]['responses'] = $responsesArray;
					$count++;

		        } 

			}

		}

		$vi =  DB::table('pv_uservideo')->where('pv_uservideo.id_user', Request::get('id'))
		->join('videos', 'videos.id', '=', 'pv_uservideo.id_video')
		->select('videos.*')
		->orderBy('videos.name', 'asc')
		->get();

		foreach ($vi as $v) {

			$idurl = explode('=', $v->url);
			$vinfo = explode('-', $v->name);

			$videosArray[$countv]['id']      = $v->id;
			$videosArray[$countv]['img']     = 'http://img.youtube.com/vi/'.$idurl[1].'/0.jpg';
			$videosArray[$countv]['song']    = $vinfo[0];
			$videosArray[$countv]['artist']  = $vinfo[1];
			$videosArray[$countv]['views']   = $v->views;
			$videosArray[$countv]['likes']   = $v->likes;
			$videosArray[$countv]['id_url']  = $idurl[1];
			$videosArray[$countv]['route']   = '/mobile_app/video_reproductor.html?id='.$v->id.'';
			if (is_null($v->id_band)) {
				$videosArray[$countv]['route_art']   = '/mobile_app/profile.html?id='.$v->id_user.'&type=M';
			}else{
				$videosArray[$countv]['id_band'] = $v->id_band;
				$videosArray[$countv]['route_art'] = '/mobile_app/profile.html?id='.$v->id_band.'&type=B';
			}

			

			$countv++;

		}

        $wall['user']       = $user;
		$wall['comments']   = $commentArray;
		$wall['videos']     = $videosArray;
		$wall['followers']  = $followers;
		$wall['following']  = count($following);


        header("Content-Type: application/json", true);
		echo json_encode($wall);
	}

	public function textComment(Request $request)
	{
	    if (Auth::check()) {

	        $type = Request::get('type');
	    
	        $comment           = new Comments;           
	        $comment->id_user  = Request::get('id_user');

	        if ($type === 'B') {

	            $comment->id_band = Request::get('id_wall');

				if ($comment->id_band != Auth::user()->id_band) {

					$user = DB::table('users')->where('id_band', $comment->id_band)->first();

					$notification = new Notifications;
					$notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
					$notification->id_user = $user->id;
					$notification->id_comment = $comment->id;
					$notification->type = 'post';
					$notification->seen = 'N';
					$notification->save();

				}
	        }

	        if ($type === 'M' || $type === 'U' || $type === 'G') {
	            $comment->id_wall = Request::get('id_wall');
				if ($comment->id_wall != Auth::user()->id_wall) {

					$user = DB::table('users')->where('id_wall', $comment->id_wall)->first();

					$notification = new Notifications;
					$notification->comment = '¡'.Auth::user()->name.' ha publicado en tu muro!';
					$notification->id_user = $user->id;
					$notification->id_comment = $comment->id;
					$notification->type = 'post';
					$notification->seen = 'N';
					$notification->save();

				}
	        }
	        
	        $comment->comment = Request::get('comment');
	        $comment->type = 'com';
	    
	        if (Request::get('id_comment') != '') {
	            $comment->id_comment = Request::get('id_comment');
	        }      
	            
	        $comment->save();


	        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

	        $activity          = new Activities;
	        $activity->id_user = Auth::user()->id;
	        $activity->type    = 'comment';
	        $activity->save(); 

	        $check = Request::get('check');

	        if ($check == 'true') {

	        	$tagsNumber = Request::get('count');

	        	if ($tagsNumber == 1) {

	        		$notification = new Notifications;

		        	if (is_null($comment->id_comment)) {
		        		
		        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';

		        	}else{

		        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

		        	}

		        	$notification->href = '/mobile_app/profile.html?id='.$comment->id_user.'&type='.$type.'&idcomment='.$comment->id.'';
					$notification->id_user = Request::get('user');
					$notification->id_comment = $comment->id;
					$notification->type = 'tag';
					$notification->seen = 'N';
					$notification->save();
	        	
	        	}else{

	        		$users = explode(',', Request::get('user'));

		        		for ($i=0; $i < count($users); $i++) { 
		        			$notification = new Notifications;

			        	if (is_null($comment->id_comment)) {
			        		
			        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';
			        		
			        	}else{

			        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

			        	}

			        	$notification->href = '/mobile_app/profile.html?id='.$comment->id_user.'&type='.$type.'&idcomment='.$comment->id.'';
						$notification->id_user = $users[$i];
						$notification->id_comment = $comment->id;
						$notification->type = 'tag';
						$notification->seen = 'N';
						$notification->save();

	        		}


	        	}

	        }
	        
	        return $comment->id;

	    }
	}

    public function commentVideos(Request $request)
    {
        $comment           = new Comments;           
        $comment->comment  = Request::get('comment'); //Comment
        $comment->id_user  = Request::get('id_user'); //Made the comment
        $comment->id_video = Request::get('id_video'); 
        $comment->type = 'com';

        $video = DB::table('videos')->where('id', Request::get('id_video'))->first();

        if (is_null($video->id_band)) {

            $musician = DB::table('musicians')->where('id', $video->id_musician)->first();
            $user = DB::table('users')->where('id_musician', $musician->id)->first();

        }else{

            $band = DB::table('bands')->where('id', $video->id_band)->first();
            $user = DB::table('users')->where('id_band', $band->id)->first();
        }
        

        
        if (Request::get('id_comment') != null) {
            $comment->id_comment = Request::get('id_comment');
        }

        if ($user->id != Auth::user()->id) {
            
            $notification = new Notifications;
            $notification->comment = '¡'.Auth::user()->name.' ha comentado tu video!';
            $notification->id_user = $user->id;
            $notification->id_video = Request::get('id_video');
            $notification->id_comment = $comment->id;
            $notification->type = 'video';
            $notification->seen = 'N';
            $notification->save();

                
        }


       	$check = Request::get('check');

        if ($check == 'true') {

	        	$tagsNumber = Request::get('count');

	        	if ($tagsNumber == 1) {

	        		$notification = new Notifications;

		        	if (is_null($comment->id_comment)) {
		        		
		        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';

		        	}else{

		        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

		        	}

		        	$notification->href = '/mobile_app/video_reproductor.html?id='.$comment->id_video.'&idcomment='.$comment->id.'';
					$notification->id_user = Request::get('user');
					$notification->id_comment = $comment->id;
					$notification->type = 'tag';
					$notification->seen = 'N';
					$notification->save();
	        	
	        	}else{

	        		$users = explode(',', Request::get('user'));

		        		for ($i=0; $i < count($users); $i++) { 
		        			$notification = new Notifications;

			        	if (is_null($comment->id_comment)) {
			        		
			        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en una publicación!';
			        		
			        	}else{

			        		$notification->comment = '¡'.Auth::user()->name.' te ha mencionado en un comentario!';

			        	}

			        	$notification->href = '/mobile_app/video_reproductor.html?id='.$comment->id_video.'&idcomment='.$comment->id.'';
						$notification->id_user = $users[$i];
						$notification->id_comment = $comment->id;
						$notification->type = 'tag';
						$notification->seen = 'N';
						$notification->save();

	        		}


	        	}

	    }
		    
        DB::table('users')->where('id', Auth::user()->id)->update(['activity_count' => Auth::user()->activity_count + 1]);

        $activity          = new Activities;
        $activity->id_user = Auth::user()->id;
        $activity->type    = 'Comentario';
        $activity->save();      
                
        $comment->save();
            
        return $comment->id;   
      
    }

public function upload_picture() {

    $image64 = Input::get('array');

    $exploder = explode('__', $image64);

    $count = count($exploder);

    $aux = 0;

    $idalbum = str_random(5);

    $type = Input::get('type'); 
    $id = Input::get('id_wall');

    if ($count == 1) {

        $pictures = new Comments;           
                
        $pictures->id_user = Input::get('id_user');

        if ($type == 'U' || $type == 'M' || $type == 'G') {
        	$pictures->id_wall = Input::get('id_wall');
        }else{
        	$pictures->id_band = Input::get('id_wall');
        }
        
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
            $notification->type = 'post';
            $notification->id_user = $user->id;
            $notification->id_comment = $pictures->id;
            $notification->seen = 'N';
            $notification->save();
                
        }

        return Redirect::to('/mobile_app/profile.html?id='.$id.'&type='.$type);
       

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
	        if ($type == 'U' || $type == 'M' || $type == 'G') {
	        	$pictures->id_wall = Input::get('id_wall');
	        }else{
	        	$pictures->id_band = Input::get('id_wall');
	        }
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
    
        return Redirect::to('/mobile_app/profile.html?id='.$id.'&type='.$type);
    
    }

  }

     public function upload_video()
    {
       
        $files = Input::file('video');
        $getext = $files->getClientOriginalName();
        $exploder = explode('.', $getext);

        $rand = str_random(10);

        $name = Auth::user()->id.''.$rand .'.'. $exploder[1];

        $saver               = $files->move('uploads', $name);
        $path                = '../../uploads/';
        $route = $path . $name;

        $type = Input::get('type'); 
	    $id = Input::get('id_wall');

        $comentario          = new Comments;           
        $comentario->id_user = Input::get('id_user');
        if ($type == 'U' || $type == 'M' || $type == 'G') {
        	$comentario->id_wall = Input::get('id_wall');
        }else{
        	$comentario->id_band = Input::get('id_wall');
        }


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
        

        return Redirect::to('/mobile_app/profile.html?id='.$id.'&type='.$type);
    }

    public function videoArtistsUpload()
    {
        
        $idmusic = Input::get('idmusic');
        $type = Input::get('type');
        $video = new Videos;
        $id = Auth::user()->id;
        $very = Videos::where('url','=',  Input::get('url'))->count();
        
        if ($very > 0){
            
            return Redirect::to('/mobile_app/profile.html?id='.$id.'&type='.$type);
        
        }else{

	        if ($type == 'M' || $type == 'G') {

	            $video->url = Input::get('url');
	            $video->upload_date = date('d/m/Y');
		        $video->id_user     = Auth::user()->id;
		        $video->id_musician = Auth::user()->id_musician;
		        $videoname = Input::get('name');
		        $bandname = Auth::user()->name;
		        $video->name = $videoname.' - '.$bandname;

		        if ($video->name == '' || $video->url == '' ) {

		            return Redirect::to('mobile_app/profile.html?id='.$id.'&type='.$type.'&msg=empty');
		        
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
		            
		            return Redirect::to('mobile_app/profile.html?id='.$id.'&type='.$type);
		        
		        };

	        }elseif ($type == 'B') {

				$video->url = Input::get('url');
				$video->upload_date = date('d/m/Y');
				
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

					 return Redirect::to('mobile_app/profile.html?id='.$id.'&type='.$type.'&msg=empty');
    	
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
					
					return Redirect::to('mobile_app/profile.html?id='.$id.'&type='.$type);
				}  

	        }      
        
        }
        
    }

    public function setMusicianAboutService(Request $request)
    {

        $musician = Musicians::find(Request::get('id_music'));
                
        DB::table('musicians')->where('id', $musician->id)->update(['about' => Request::get('setabout')]);

        $response['id']    = $musician->id;
		$response['about'] = $musician->about;


        header("Content-Type: application/json", true);
		echo json_encode($response);
	}

    public function setBandAboutService(Request $request)
    {
        $bands = Bands::find(Request::get('id_band'));

        DB::table('bands')->where('id', $bands->id)->update(['about' => Request::get('about')]);

        $response['id']    = $bands->id;
		$response['about'] = $bands->about;


        header("Content-Type: application/json", true);
		echo json_encode($response);


    }

    public function editRoleMusician(Request $request)
    {
    	
    	$musician = Musicians::find(Request::get('id_musician'));

             $roles = Request::get('role');

                if (Request::get('cuerda') != '') {

                    $roles = array_diff($roles, ["CUERDA"]);

                    array_push($roles, Request::get('cuerda'));
                }
                if (Request::get('viento') != '') {

                    $roles = array_diff($roles, ["VIENTO"]);

                    array_push($roles, Request::get('viento'));
                }
                if (Request::get('otro') != '') {

                    $roles = array_diff($roles, ["OTRO"]);

                    array_push($roles, Request::get('otro'));
                }

            $roleA = '';

            foreach ($roles as $g) {
            	if ($roleA == '') {
            		$roleA = $g;
            	}else{
					$roleA = $roleA.' , '.$g;
            	}
            }

            $role = serialize($roles);

            DB::table('musicians')->where('id', $musician->id)->update(['role' => $role]);

            $response['id'] = $musician->id;
            $response['roles'] = $roleA;

            header("Content-Type: application/json", true);
			echo json_encode($response);
    }

    public function editGenreMusician(Request $request)
    {
    	
    	$musician = Musicians::find(Request::get('id_musician'));

            $genres = Request::get('id_genre');

            if (Request::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Request::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);
            
			$genresA = '';

            foreach ($mgenre as $g) {
            	if ($genresA == '') {
            		$genresA = $g;
            	}else{
					$genresA = $genresA.' , '.$g;
            	}
            }

            $genre = serialize($mgenre);

            DB::table('musicians')->where('id', $musician->id)->update(['genres' => $genre]);

            $response['id'] = $musician->id;
            $response['genres'] = $genresA;

            header("Content-Type: application/json", true);
			echo json_encode($response);
    }

    public function editRoleBand(Request $request)
    {
      $members = Members::find(Request::get('id_member'));

         $roles = Request::get('role');

         if (!is_null($roles)) {
         	
             if (Request::get('cuerda') != '') {

                    $roles = array_diff($roles, ["CUERDA"]);

                    array_push($roles, Request::get('cuerda'));
            }
            if (Request::get('viento') != '') {

                $roles = array_diff($roles, ["VIENTO"]);

                array_push($roles, Request::get('viento'));
            }
            if (Request::get('otro') != '') {

                $roles = array_diff($roles, ["OTRO"]);

                array_push($roles, Request::get('otro'));
            }
           }

            $roleA = '';

            foreach ($roles as $g) {
            	if ($roleA == '') {
            		$roleA = $g;
            	}else{
					$roleA = $roleA.' , '.$g;
            	}
            }

            $role = serialize($roles);

            DB::table('members')->where('id', $members->id)->update(['role' => $role]);

            $response['id'] = $members->id;
            $response['roles'] = $roleA;

            header("Content-Type: application/json", true);
			echo json_encode($response);
    }

    public function editGenreBand(Request $request)
    {
    	
            $band = Bands::find(Request::get('id_band'));

            $genres = Request::get('id_genre');

            if (Request::get('other') != '') {

                $genres = array_diff($genres, ["OTRO"]);

                array_push($genres, strtoupper(Request::get('other')));
            }
            
            $mgenre[] = '';

            $mgenre = array_merge($mgenre, $genres);
            
			$genresA = '';

            foreach ($mgenre as $g) {
            	if ($genresA == '') {
            		$genresA = $g;
            	}else{
					$genresA = $genresA.' , '.$g;
            	}
            }

            $genre = serialize($mgenre);


            DB::table('bands')->where('id', $band->id)->update(['id_genre' => $genre]);

            $response['id'] = $band->id;
            $response['genres'] = $genresA;

            header("Content-Type: application/json", true);
			echo json_encode($response);
    }

     public function addmemberService()
    {

            $users = DB::table('users')->where('email',  Request::get('id_user'))->first();

            $very = Members::where('id_user',  $users->id)->count();
            $idband = Request::get('id_band');

        	$bands = DB::table('bands')->find(Request::get('id_band'));

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
                $role = serialize(Request::get('role'));
                $admin = Auth::user()->name;
                $data = ['user' => $user, 'topica' => $topica, 'band' => $band, 'role' => $role, 'admin' => $admin];

                if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){

                    Mail::send('membersmobile', $data, function($message) use ($topica, $user)
                        {
                            $message->to($user->email)->subject('YLMM - Te han invitado a formar parte de una banda');
                        });
        
        		}

            header("Content-Type: application/json", true);
			echo json_encode("Success");
       
	}

/*---------------------------------Format Notifications--------------------------------------*/
public function notificationsService()
	{
		if (Auth::check()) {

			$not = DB::table('notifications')
	            ->where('id_user', Auth::user()->id)
	            ->orderBy('created_at', 'desc')
	            ->get();

	        $response = array();

	        if ($not == '[]') {

	        	return 0;

	        }else{

	        	for ($i=0; $i < count($not); $i++) { 

	        		if ($not[$i]->type == '') {
	        			
	        			$response[$i]['id']    = $not[$i]->id;
			        	$response[$i]['text']  = $not[$i]->comment;
			        	$response[$i]['seen']  = $not[$i]->seen;
			        	$response[$i]['route'] = '#';

	        		}
	        		
	        		if ($not[$i]->type == 'post') {
	        			
	        			$response[$i]['id']    = $not[$i]->id;
			        	$response[$i]['text']  = $not[$i]->comment;
			        	$response[$i]['seen']  = $not[$i]->seen;
			        	$response[$i]['route'] = '/mobile_app/profile.html?id='.$not[$i]->id_user.'&type=U';

	        		}

	        		if ($not[$i]->type == 'tag') {
	        			
	        			$response[$i]['id']    = $not[$i]->id;
			        	$response[$i]['text']  = $not[$i]->comment;
			        	$response[$i]['seen']  = $not[$i]->seen;
			        	$response[$i]['route'] = $not[$i]->href;

	        		}
	        		
	        		if ($not[$i]->type == 'video' || $not[$i]->type == 'votes' || $not[$i]->type == 'view' || $not[$i]->type == 'like') {
	        			
	        			$response[$i]['id']    = $not[$i]->id;
			        	$response[$i]['text']  = $not[$i]->comment;
			        	$response[$i]['seen']  = $not[$i]->seen;

			        	$video = DB::table('videos')->where('id', $not[$i]->id_video)->first();
							
						$response[$i]['route'] = '/mobile_app/video_reproductor.html?id='.$video->id.'';

			        }
	        	}

	        
		        header("Content-Type: application/json", true);
				echo json_encode($response);

	        }
		}
	}

    public function notifications()
    {
        $queryvid = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'like')
        ->wherenotNull('id_video')
        ->orderBy('id_video', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        $querypost = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'post')
        ->wherenotNull('id_comment')
        ->orderBy('id_comment', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryview = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'view')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryvotes = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'votes')
        ->orderBy('created_at', 'desc')
        ->get();

        $querytags = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'tag')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryvideos = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'video')
        ->orderBy('created_at', 'desc')
        ->get();

        $notification = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->whereNull('type')
        ->orderBy('created_at', 'desc')
        ->get();

        

        $special = array();
        $special[] = $this->formatPostNoti($querypost);
        $special[] = $this->formatVideoNoti($queryvid);
        $special[] = $this->formatNoti($notification);
        $special[] = $this->formatNoti($querytags);
        $special[] = $this->formatVideoNot($queryvideos);
        $special[] = $this->formatViewNoti($queryview);
        $special[] = $this->formatVideoVote($queryvotes);

        $final = array();

        $merged = array();


        foreach ($special as $sp) {
            foreach ($sp as $val) {
                $final[$val['date']] = $val;
            }
        }
        
        krsort($final);
        foreach ($final as $key => $fin) {
        	$merged[] = $fin;
        }

        if ($merged == '[]') {

	        	return 0;

        }else{

        	return json_encode($merged);
        	
        }

    }

    private function formatVideoNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'video';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas les ha gustado tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatPostNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_comment) {
                $video[$vnoti->id_comment]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_comment]['date'] = $date;
                $count = 1;
                $reminder = $vnoti->id_comment;
                $video[$vnoti->id_comment]['type'] = 'post';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_comment]['seen'] = 'N';
            }
            
            $video[$vnoti->id_comment]['id'] = $vnoti->id_comment;
            if ($count > 1) {
                $video[$vnoti->id_comment]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_comment]['text'] = ''.$count.' personas han publicado en tu muro';
            } else {
                $video[$vnoti->id_comment]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_comment]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id) {
                $video[$vnoti->id]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id;
                $video[$vnoti->id]['type'] = '';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id]['seen'] = 'N';
            }
            
            $video[$vnoti->id]['id'] = $vnoti->id;
            $video[$vnoti->id]['id_noti'] = $vnoti->id;
            $video[$vnoti->id]['text'] = $vnoti->comment;
            $video[$vnoti->id]['href'] = $vnoti->href;

        }

        return $video;
    }

    private function formatViewNoti($noti)
    {
    	$video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'view';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas han visto tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatVideoVote($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
       	foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type'] = 'votes';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas han votado por tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }


        return $video;
    }

    private function formatVideoNot($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'video';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas les ha gustado tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }
/*---------------------------------Format Notifications--------------------------------------*/

/*Check video likes*/

	public function checkvideoLikes()
	{

		$id = $_GET['id'];

		$likes = DB::table('pv_uservideo')
              ->where('id_user', Auth::user()->id)
              ->where('id_video', $id)
              ->first();
	                  
	    if (is_null($likes)){

			return 0;

	    }else{
			
			return 1;

	    }
	}
	public function checkCommentLikes()
	{

		$id = $_GET['id'];

		$very = DB::table('pv_usercomment')
              ->where('id_comment', $id)
              ->where('id_user', Auth::user()->id)
              ->first();

        if (is_null($very)){

			return 0;

	    }else{
			
			return 1;

	    }
	}
}