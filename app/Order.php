<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id',	'payment_id','cart_id',	'order_date'];
    protected $hidden=['created_at','updated_at'];


   public function customer(){
       return $this->belongsTo('App/User','user_id','id');
   }
   public function cart(){
       return $this->hasOne(Order::class);
   }
   public function payment(){
       return $this->hasOne(Payment::class);
   }
   public function ticket(){
       return $this->hasOne(Ticket::class);
   }



}
