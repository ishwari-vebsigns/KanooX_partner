<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public $primaryKey = "product_id";

    public function brands(){
    	return $this->belongsTo('App\Brand','brand_id','brand_id');
    }
    
     public function order_products(){
    	return $this->belongsTo('App\OrderProduct','product_id','product_id');
    }
    
     public function purchase_order_products(){
    	return $this->belongsTo('App\InvoicePurchaseOrderProduct','product_id','product_id');
    }
    
    public function order_product_count(){
		return $this->order_products()
		->whereHas('orders',function($query){
		$query=$query->where('order_status',3);
	})->selectRaw('product_id, sum(quantity) as total_quantity')
		->groupBy('product_id');
	}
	
	public function purchase_order_product_count(){
		return $this->purchase_order_products()
		->where('order_status',2)->selectRaw('product_id,  sum(quantity) as purchase_total_quantity')
		->groupBy('product_id');
	}

  
}
