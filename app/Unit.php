<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable=['unit_code','unit_code'];


    public function products(){
        return$this->hasMany('App/Product','unit','id');
    }
}
