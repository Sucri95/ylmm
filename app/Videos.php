<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = 'videos';


	public function genero(){

		return $this->belongsTo('app/Genders', 'id', 'id_genero');
	}

	public function banda(){

		return $this->belongsTo('app/Bands', 'id', 'id_genero');
	}

	public function pvreg(){

		return $this->belongsTo('app/PVBands', 'id_video', 'id');
	}
}