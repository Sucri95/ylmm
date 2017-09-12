<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;
use Input;
use View;
use Redirect;
use Auth;
use App\Responses;
use App\Notifications;

class ResponseController extends Controller
{
    public function createresponse()
    {
		$responses = new Responses;
	
		$responses->response = Input::get('response');
		$responses->id_user    = Input::get('id_user');
		$responses->id_video = Input::get('id_video_response');
        $responses->id_comment = Input::get('id_comment');

            $responses->save();

            return Redirect::to('/bands/band_comments?id='.$responses->id_video.'?msg=Su respuesta ha sido publicada exitosamente=SUCCESS');
	}

	public function addLikeResponse()
    {
    	try {
    		$response = Responses::find(Request::get('id'));
    		$response->like = $response->like + 1;
    		$response->save();
    		return 1;
    	} catch (\Exception $e) {
    		return $e;
    	}
    	

    }
}
