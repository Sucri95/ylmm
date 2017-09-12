<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PVUserVideo extends Model
{
    protected $table = 'pv_uservideo';

    public function video()
    {
    	return $this->hasOne('App\Videos', 'id', 'id_video');
    } 

}
