<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['amount',	'user_id',	'product_id',	'paid_on',	'payment_reference'	];
    protected $hidden=['created_at','updated_at'];


   public function customer(){
       return $this->belongsTo('App/User','user_id','id');
   }
    public function order(){
        return $this->belongsTo('App/Order','payment_id','id');
    }

}
