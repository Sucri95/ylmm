<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Sponsors;
use App\Notifications;
use App\Bands;
use View;
use Form;

class YoutubeController extends Controller
{
 
    /**
     * Muestra la vista del formulario.
     */
     public function index()
    {
        $sponsors = $this->takeSponsors();
        return \View::make('youtubeindex', array('sponsors' => $sponsors));
    }

    public function takeSponsors()
    {
    	return Sponsors::all();
    }

    public function search()
    {
        $sponsors = $this->takeSponsors();
        $word = Input::get('search');
 
        $youtube = new \Madcoda\Youtube(array('key' => 'AIzaSyBgBfezfpU4c2kJ7ybDxwzdZgeANrAyb8s'));
 
        // Parametros
        $params = array(
            'q' => $word,
            'type' => 'video',
            'part' => 'id, snippet',
            'maxResults' => 20    //Número de resultados
        );

       
 
        // Hacer la busqueda con los parametros
        $videos = $youtube->searchAdvanced($params, true);
        return \View::make('youtubeindex', array('videos' => $videos['results'], 'sponsors' => $sponsors));
}
}
