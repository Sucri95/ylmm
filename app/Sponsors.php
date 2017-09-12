<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{
    protected $table = 'sponsors';


public function bandas(){

    return $this->hasMany('app/Bands', 'id_bands', 'id');
}

public function usuarios(){

    return $this->hasMany('app/Users', 'id_user', 'id');
}
}