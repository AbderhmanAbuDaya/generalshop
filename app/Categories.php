<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable=['name'];
    protected $hidden=['created_at','updated_at'];
    public function products(){
        return $this->hasMany('App\Product','category_id','id');
    }
}
