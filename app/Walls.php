<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walls extends Model
{
    protected $table = 'walls';

public function comentarios(){

    return $this->hasMany('app/Comments', 'id_comment', 'id');
}

public function banda(){

    return $this->belongsTo('app/Bands', 'id_band', 'id');
}
public function usuario(){

    return $this->belongsTo('app/Users', 'id_user', 'id');
}
}