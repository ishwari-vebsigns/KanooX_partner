<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    public $primaryKey = "category_id";

    public function category_products(){
    	return $this->hasMany('App\ProductCategory','category_id','category_id')->with('products'); 
    }

     public function cat_products(){
    	return $this->belongsTo('App\ProductCategory','category_id','category_id'); 
    }

    public function pro_count(){
		return $this->cat_products()
		->selectRaw('category_id, count(category_id) as total_product')
		->groupBy('category_id');
	}


	


    
}
