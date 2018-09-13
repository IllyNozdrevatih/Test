<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function area(){
        return $this->belongsTo('App/Area');
    }

    public function regions(){
        return $this->hasMany('App/Region');
    }
}
