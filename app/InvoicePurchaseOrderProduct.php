<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePurchaseOrderProduct extends Model
{
    protected $table = "invoice_purchase_order_products";
    public $primaryKey = "invoice_purchase_order_product_id";

    public function products(){
    	return $this->belongsTo('App\Product','product_id','product_id'); 
    }

    public function orders(){
    	return $this->belongsTo('App\Order','order_id','order_id');
    }
}
