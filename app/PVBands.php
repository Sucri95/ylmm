<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PVBands extends Model
{
    protected $table = 'pv_bandvideo';

    public function video()
    {
    	return $this->hasOne('App\Videos', 'id', 'id_video');
    }     
}
