<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battles extends Model
{
    protected $table = 'battles';

public function concursantes(){

    return $this->hasMany('app/Bandas', 'id_band', 'id');
}

public function votantes(){

    return $this->hasMany('app/Users', 'id_user', 'id');
}

public function videos_concurso(){

    return $this->hasMany('app/Videos', 'id_video', 'id');
}
}