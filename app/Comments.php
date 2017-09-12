<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

public function banda(){

	return $this->belongsTo('app/Bands', 'id', 'id_band');
}

public function usuario(){

	return $this->belongsTo('app/Users', 'id', 'id_user');
}

public function muro(){

	return $this->belongsTo('app/Walls', 'id', 'id_wall');
}
}