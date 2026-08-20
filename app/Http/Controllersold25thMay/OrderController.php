<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use App\Product;
use App\OrderProduct;
use App\User;
use App\InvoicePurchaseOrder;
use App\InvoicePurchaseOrderProduct;
class OrderController extends Controller
{


    public function getStockOrderProduct(){
        $user = Auth::user();
        if($user->role_id==1){
            return view('admin/stock/stockOrderProduct');
        }else{
            return redirect('/');
        }
        
    }

    public function getStockOrderProductDatatable(){
            $order_ids = Order::where('order_status',3)->pluck('order_id');
            $order_products = OrderProduct::whereIn('order_id',$order_ids)->with('products')->get();
        return Datatables($order_products)->make(true);
    }



    public function getStockInvoicePurchaseOrderProduct(){
        $user = Auth::user();
        if($user->role_id==1){
            return view('admin/stock/stockInvoicePurchaseOrderProduct');
        }else{
            return redirect('/');
        }
    }

    public function getStockInvoicePurchaseOrderProductDatatable(){
            $order_invoice_order_ids = InvoicePurchaseOrder::where('order_status',2)->pluck('invoice_purchase_order_id');
            $order_invoice_purchase_orders = InvoicePurchaseOrderProduct::whereIn('invoice_pur_order_id',$order_invoice_order_ids)->with('products')->get();
        return Datatables($order_invoice_purchase_orders)->make(true);
    }
    
    public function inventoryReport(){
        $user = Auth::user();
        if($user->role_id==1){
            return view('admin.stock.inventoryreport');
        }else{
            return redirect('/');
        }
        
    }

    public function inventoryReportDatatable(){
            // $order_ids = Order::where('order_status',3)->pluck('order_id');
            // $order_products = OrderProduct::whereIn('order_id',$order_ids)->with('products')->get();
            
            $products=Product::with('purchase_order_product_count')->with('order_product_count')->get();
        return Datatables($products)->make(true);
    }
    
}
