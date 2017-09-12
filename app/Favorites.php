<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
   protected $table = 'favorites';

public function banda(){

	return $this->belongsTo('app/Bands', 'id', 'id_band');
}

public function user(){

	return $this->belongsTo('app/Users', 'id', 'id_user');
}

}