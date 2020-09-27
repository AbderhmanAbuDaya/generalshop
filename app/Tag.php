<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['tag'];
    public function products(){
        return $this->belongsToMany('App\Product','product_tag','product_id','tag_id','id','id');
    }
}
