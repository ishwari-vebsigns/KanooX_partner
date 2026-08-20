<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
	protected $table = "order_products";
	public $primaryKey = "order_product_id";

    public function users(){
    	return $this->belongsTo('App\User','user_id','id'); 
    }

    public function products(){
    	return $this->belongsTo('App\Product','product_id','product_id'); 
    }

    public function orders(){
    	return $this->belongsTo('App\Order','order_id','order_id');
    }
}
