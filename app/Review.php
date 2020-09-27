<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable=['user_id','product_id','stars','review'];

    public function customer(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
    public function getDateAttribute(){
return  \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }

}
