<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";
    public $primaryKey = "brand_id";

    public function brand_products(){
    	return $this->hasMany('App\Product','brand_id','brand_id'); 
    }

     public function brand_prod(){
    	return $this->belongsTo('App\Product','brand_id','brand_id');
    }

    public function product_count(){
		return $this->brand_prod()
		->selectRaw('brand_id, count(brand_id) as total_product')
		->groupBy('brand_id');
	}
}
