<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipment extends Model
{
    protected $fillable=['user_id',	'payment_id',	'order_id',	'status',	'shipping_date'];
    protected $hidden=['created_at','updated_at'];

    public function customer(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }

}
