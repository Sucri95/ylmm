<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PVBands;
use App\Videos;

class Bands extends Model
{
    protected $table = 'bands';

    public function pvreg()
    {
    	return $this->hasMany('App\PVBands', 'id_band', 'id');
    }

    
}
