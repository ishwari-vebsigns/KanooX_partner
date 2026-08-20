<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePurchaseOrder extends Model
{
    protected $table = "invoice_purchase_orders";
    public $primaryKey = "invoice_purchase_order_id";

    public function invoicePurchaseOrderProducts(){
    	return $this->hasMany('App\InvoicePurchaseOrderProduct','invoice_pur_order_id','invoice_purchase_order_id')->with('products');
    }



    
}
