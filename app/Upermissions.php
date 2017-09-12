<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upermissions extends Model
{
    protected $table = 'upermissions';


//If
public function usuario(){

	return $this->belongsTo('app/Users', 'id', 'id_user');
}
//else
public function usuario(){

	return $this->hasMany('app/Users', 'id', 'id_user');
}
}