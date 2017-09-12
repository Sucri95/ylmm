<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    protected $table = 'winners';

public function ganador(){

    return $this->belongsTo('app/Bands', 'id', 'id_band');
}
}