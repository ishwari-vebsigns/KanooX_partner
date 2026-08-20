<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    public $primaryKey = "cart_id";

    public function products(){
    	return $this->belongsTo('App\Product','product_id','product_id');
    }

    public function users(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
