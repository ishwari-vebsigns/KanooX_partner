<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $table = "orders";
    public $primaryKey = "order_id";

    public function users(){
    	return $this->belongsTo('App\User','user_id','id'); 
    }

     public function order_products(){
    	return $this->hasMany('App\OrderProduct','order_id','order_id')->with('products'); 
    }

    
}
