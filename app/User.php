<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','mobile','mobile_verified',
        'email_verified','shipping_address','billing_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany('App\Order','user_id','id');
    }
    public function payments(){
        return $this->hasMany('App\Payment','user_id','id');
    }
    public function shipments(){
        return $this->hasMany('App\Shipment','user_id','id');
    }
    public function shippingAddress(){
        return $this->hasOne('App\Address','id','shipping_address');
    }
    public function billingAddress(){
        return $this->hasOne('App\Address','id','billing_address');
    }
    public function wishLists(){
        return $this->hasOne('App\WishList','user_id','id');
    }
    public function reviews(){
        return $this->hasMany('App\Reviews','product_id','id');
    }
    public function roles(){
        return $this->belongsToMany('App\Role','role_user','user_id','role_id','id','id');
    }
    public function tickets(){
        return $this->hasMany('App\Ticket','user_id','id');
    }



    public function getNameAttribute(){

        return $this->first_name." ".$this->last_name;
    }

}
