<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $table = 'activities';

public function banda(){

	return $this->belongsTo('app/Bands', 'id', 'id_band');
}
public function usuario(){

	return $this->belongsTo('app/Users', 'id', 'id_user');
}
}