<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
protected $fillable=['url',	'product_id'];
    protected $hidden=['created_at','updated_at'];

   public function product(){
       return $this->belongsTo('App\Product','product_id','id');
   }

}
