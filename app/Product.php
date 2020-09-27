<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title'	,'description'	,'unit'	,'price','options','discount'	,'total'];
    protected $hidden=['created_at','updated_at'];


    public function images(){
        return $this->hasMany('App\Image','product_id','id');
    }
    public function reviews(){
        return $this->hasMany('App\Review','product_id','id');
    }
    public function category(){
        return $this->belongsTo('App\Categories','category_id','id');
    }
    public function hasUnit(){
        return $this->belongsTo('App\Unit','unit','id');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag','product_tag','product_id','tag_id','id','id');
    }
   public function jsonOptions(){
        return json_decode($this->options);
   }
}
