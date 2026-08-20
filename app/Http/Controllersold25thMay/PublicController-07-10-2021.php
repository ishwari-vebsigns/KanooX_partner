<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Product;
use Auth;
use App\Cart;
use App\Category;
use App\Brand;
use App\ProductCategory;
use App\Order;
use App\OrderProduct;
use App\Slider;
class PublicController extends Controller
{
    public function getContactUs(){
    	return view('contact-us');
    }
    public function getAboutUs(){
    	return view('about-us');
    }
    public function getShop(){
    	return view('shop');
    }
    public function login(){
    	return view('login');
    }

    public function register(Request $request){
        // dd($request->all());
        $request->validate([
                            'name'=>'required',
                            'password'=>'required',
                            'email'=>'required',
                            'phone'=>'required',
                            'address'=>'required'
                            ]);
        $user = User::where('email',$request->email)->first();
        // echo gettype($user);die;
        // echo $user;die;
        
        if($user==null || $user="" || $user=="undefined" || $user=="[]"){
            // echo "Null";die();
            $password = Hash::make($request->password);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $password;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->role_id = 3;
            $user->save();
            return redirect('/');
        }else{
            // echo "Not Null";die;        
            $notification = array(
              'message' => 'This Email Already Exist', 
              'alert-type' => 'warning'
              );
            return redirect()->back()->with($notification);
        }
        
        
    }
    
//======================================================Product Data Start==========
    public function getProduct(Request $request){
        $search=$request->search;

        $categories = Category::where('is_active',1)->with('category_products')->with('pro_count')->get();
        // dd($categories);
        // echo $categories;die;
        $brands = Brand::where('is_active',1)->with('brand_products')->with('product_count')->get();
       
        // foreach ($brands as $brand) {

        //    echo $brand->product_count->total_product; die; 
        // }
        // dd($brands);
        $products = Product::where('is_active',1)->get();
        // echo $products;die;
        $sliders = Slider::where('is_active',1)->get();

        return view('product')->with('categories',$categories)->with('brands',$brands)->with('products',$products)->with('sliders',$sliders)->with('search',$search);
    }

    public function getProductDatatable(Request $request){
            // dd($request->all());

            $product = Product::where('is_active',1);
            if($request->category_id!="" && $request->category_id!="undefined"){
                $category_id=explode(' ,',$request->category_id);
                // print_r($category_id);die;
                $product_category = ProductCategory::where('is_active',1)->whereIn('category_id',$category_id)->pluck('product_id');
                $product = $product->whereIn('product_id',$product_category);

            }

            if($request->brand_id!="" && $request->brand_id!="undefined"){
                $brand_id=explode(' ,',$request->brand_id);
                // print_r($brand_id);die;
                $product = $product->whereIn('brand_id',$brand_id);
                // echo $product->get();die;
            }

            //search data start=========

            if($request->search!=""&&$request->search!="undefined"){
                $keyword=$request->search;

                // $product_search = Product::where("upc_case", "LIKE", "%" . $request->search . "%")->get();
                // return $product_search;

                $product_search = Product::where("product_name", "LIKE", "%" . $request->search . "%")->orWhere("upc_case", "LIKE", "%" . $request->search . "%")->orWhereHas('brands',function($query) use($keyword){
                        if($keyword!="" && $keyword!="undefined"){
                            $query->where('brand_name','like','%'.$keyword.'%');
                        }
                    })->pluck('product_id');
                // return $product_search;
                
               
                if($product_search!="[]"&&$product_search!=""&&$product_search!='undefined'&&$product_search!=null){

                    $product = $product->whereIn('product_id',$product_search);
                }
                
                $category = Category::where('category_name',"LIKE", "%" . $request->search . "%")->pluck('category_id');

                if($category!="[]"&&$category!=""&&$category!='undefined'&&$category!=null){
                    $product_category = ProductCategory::where('is_active',1)->whereIn('category_id',$category)->pluck('product_id');
                        if($product_category!=""){
                            $product =$product->whereIn('product_id',$product_category);
                        }
                }
            }
            //search data end============
        
            $product = $product->get();

           
        return Datatables($product)->make(true);
    }
//=====================================================Product Data End=========


//==============================================Cart Data Start==================
    public function getCart(Request $request){
        $user = Auth::user();
        $carts = Cart::where('user_id',$user->id)->get();
        // echo $carts;die;

        $sum=0;
        $total_quantity=0;
        foreach ($carts as $cart) {
            $cart_quantity=$cart->quantity;
            $product=Product::where('is_active',1)->where('product_id',$cart->product_id)->first();
            $price=$product->selling_price;
            // $price = str_replace('$','',$price);
            $amount=$price*$cart_quantity;
            $sum=$sum+$amount;
            $total_quantity = $total_quantity+$cart_quantity;
        }
        
        return view('cart')->with('sum',$sum)->with('total_quantity',$total_quantity)->with('carts',$carts);
    }

    public function getCartDatatable(Request $request){
             $user = Auth::user();
             $cart = Cart::where('user_id',$user->id)->with('products')->get();
             // echo $cart;die;
        return Datatables($cart)->make(true);
    }


    //Post Data From product.blade.php
    public function postCart(Request $request){
        // dd($request->all());
        $user = Auth::user();
        $user_id = $user->id;
        $product_id = $request->product_id;

        $product = Product::where('product_id',$product_id)->first();
        $product_quantity = $product->product_quantity;
        // if($product_quantity>=$request->quantity){
             $cart = Cart::where('product_id',$product_id)->first();
                
        if($cart!=""){
            $cart_id = $cart->cart_id;
            $cart_quantity = $cart->quantity;
            $cart = Cart::find($cart_id);
            $cart->quantity= $request->quantity+$cart_quantity;
            $cart->save();
        }else{
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        $cart_count = Cart::where('user_id',$user->id)->count();

        return $cart_count;

        // }else{
        //     return 'false';
        // }

       
    }

    public function postCartUpdate(Request $request){
            //===========
                    $user = Auth::user();
                    $carts = Cart::where('user_id',$user->id)->get();
                    $sum=0;
                    
                    foreach ($carts as $cart) {
                        $cart_quantity_total=$cart->quantity;
                        $product=Product::where('is_active',1)->where('product_id',$cart->product_id)->first();
                        $price=$product->selling_price;
                        $amount=$price*$cart_quantity_total;
                        $sum=$sum+$amount;
                    }

                //===========
            if($request->quantity_plus!=""){
                $cart_id = $request->cart_id;
                $quantity = $request->quantity_plus;
                $cart = Cart::find($cart_id);
                $cart->quantity = $quantity+1;
                $cart->save();
                $cart_quantity = $cart->quantity;

                
                // $sum=$request->sum;
                $product=Product::where('product_id',$cart->product_id)->first();
                $price=$product->selling_price;
                $amount=$price+$sum;
                $sum=$amount;
                $total_quantity=$cart_quantity;

            }else{
                $cart_id = $request->cart_id;
                $quantity = $request->quantity_minus;
                $cart = Cart::find($cart_id);
                $cart->quantity = $quantity-1;
                $cart->save();
                $cart_quantity = $cart->quantity;
                $product=Product::where('product_id',$cart->product_id)->first();
                $price=$product->selling_price;
                $amount=$sum-$price;
                $sum=$amount;
                $total_quantity=$cart_quantity;
            }

            // return response()->json($sum,$total_quantity);
            // echo $sum;die;
           return [$sum,$total_quantity]; 
    }
    
    
public function getCheckout(){

    $user = Auth::user();
        $carts = Cart::where('user_id',$user->id)->get();
        // print_r($carts) ;die;
        if($carts!=""&&$carts!="[]"){
            $sum=0;
        $total_quantity=0;
        foreach ($carts as $cart) {
            $cart_quantity=$cart->quantity;
            $product=Product::where('is_active',1)->where('product_id',$cart->product_id)->first();
            $price=$product->selling_price;
            $amount=$price*$cart_quantity;
            $sum=$sum+$amount;
            $total_quantity = $total_quantity+$cart_quantity;
        }

        $product=Product::where('is_active',1)->where('product_id',$cart->product_id)->first();
        // echo $sum;die;
    return view('checkout')->with('sum',$sum)->with('total_quantity',$total_quantity)->with('product',$product)->with('user',$user);

        }else{
            $notification = array(
              'message' => 'No Record', 
              'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);

        }
        
}

public function postCheckoutOrder(Request $request){
    // dd($request->all());

    $request->validate([
                            'name'=>'required',
                            'email'=>'required',
                            'company_name'=>'required',
                            'contact_number'=>'required',
                            // 'discount'=>'required',
                            // 'final_amount'=>'required',
                            // 'order_status'=>'required',
                            'address'=>'required',
                            'city'=>'required',
                            'state'=>'required',
                            'country'=>'required',
                            'zip'=>'required'
                        ]);


    $user = Auth::user();
    $carts = Cart::where('user_id',$user->id)->get();
    if($carts==""){
        $notification = array(
              'message' => 'Cart is Empty',
              'alert-type' => 'success'
              );
        return redirect('my_orders')->with($notification);
    }

        $sum=0;
        $total_quantity=0;
        foreach ($carts as $cart) {
            $cart_quantity=$cart->quantity;
            $product=Product::where('is_active',1)->where('product_id',$cart->product_id)->first();
            $price=$product->selling_price;
            $amount=$price*$cart_quantity;
            $sum=$sum+$amount;
            $total_quantity = $total_quantity+$cart_quantity;
        }

        if($sum==""){
            
            return redirect('my_orders');
        }
    
    $order_amount = $sum;
    // echo $carts;die;
    // $auth_user_order = 
    $user_id = $user->id;
    
    $order_status = 1;
    $company_name  = $request->company_name;
    $name  = $request->name;
    $email = $request->email;
    $contact_number = $request->contact_number;
    $address = $request->address;
    $city = $request->city;
    $state = $request->state;
    $country = $request->country;
    $zip = $request->zip;
    $is_paid = 0;
    
    $order = new Order;
    $order->user_id = $user_id;
    $order->order_amount = $order_amount;
    // $order->discount = $discount;
    // $order->final_amount = $final_amount;
    $order->order_status = $order_status;
    $order->company_name = $company_name;
    $order->name = $name;
    $order->email = $email;
    $order->contact_number = $contact_number;
    $order->address = $address;
    $order->city = $city;
    $order->state = $state;
    $order->country = $country;
    $order->zip = $zip;
    $order->is_paid = $is_paid;
    $order->save();

    $order_id = $order->order_id;

    $carts = Cart::where('user_id',$user_id)->get();

    foreach ($carts as $cart) {
        
        $product_id = $cart->product_id;
        $product = Product::where('is_active',1)->where('product_id',$product_id)->first();
        // $product_quantity = $product->product_quantity;
        $quantity = $cart->quantity;
        $price = $product->selling_price;
        $tax = 0;
     

        $order_product = new OrderProduct;
        $order_product->user_id = $user_id;
        $order_product->order_id = $order_id;
        $order_product->product_id = $product_id;
        $order_product->quantity = $quantity;
        $order_product->tax = $tax;
        $order_product->price = $price;
        $order_product->save();

        // $product_remove = Product::find($product_id);
        // $product_remove->product_quantity = $product_quantity-$quantity;
        // $product_remove->save();

    }
    
    $cart=Cart::where('user_id',$user_id)->delete();//sir

    $notification = array(
              'message' => 'Order Added Successfully', 
              'alert-type' => 'success'
              );
    return redirect('my_orders')->with($notification);
    


}

public function myOrders(Request $request){
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->orderBy('order_id','desc')->get();
    return view('my-order')->with('orders',$orders);
}

public function myOrdersDetails(Request $request){
        $order_id = $request->id;
        $orders=Order::where('order_id',$order_id)->with('order_products')->first();
        
        return view('my-order-detail')->with('orders',$orders);
}

public function orderCancel(Request $request){

    $order_id = $request->id;
    $cancel_reason = $request->cancel_reason;
    $order = Order::find($order_id);
    $order->order_status=4;
    $order->save();

    // $product_ids = OrderProduct::where('order_id',$order_id)->pluck('product_id');
    // foreach ($product_ids as $product_id) {
    //     $order_product = OrderProduct::where('product_id',$product_id)->first();
    //     $quantity = $order_product->quantity;

    //     $product = Product::where('product_id',$product_id)->first();
    //     $product_quantity = $product->product_quantity;

    //     $product = Product::find($product_id);
    //     $product->product_quantity=$product_quantity+$quantity;
    //     $product->save();
    // }
    
    
    return redirect()->back();
}

// My Profile =============================
public function getUserProfile(){
    $user = Auth::user();
    return view('profile')->with('user',$user);
}

public function postUserProfile(Request $request){
    
    $request->validate([
                               
                                'name'=>'required',
                                'email'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                'designation'=>'required',
                                'city'=>'required',
                                'state'=>'required',
                                'country'=>'required',
                                'pincode'=>'required'
                                
                                
                                ]);
        $user = Auth::user();


        $user_profile = User::find($user->id);
        if($request->password!=""){
            $password = Hash::make($request->password);
            $user_profile->password = $password;
        }
        if($request->hasfile('image')){
                $image = $request->file('image');
                $image_path = $image->store('image');
                $user_profile->image=$image_path;
            }
        $user_profile->name = $request->name;
        $user_profile->email = $request->email;
        $user_profile->phone = $request->phone;
        $user_profile->address = $request->address;
        $user_profile->city = $request->city;
        $user_profile->state = $request->state;
        $user_profile->country = $request->country;
        $user_profile->pincode = $request->pincode;
        $user_profile->designation = $request->designation;
        $user_profile->save();

        $notification = array(
              'message' => 'User Profile Updated successfully', 
              'alert-type' => 'success'
              );
        return redirect()->back()->with($notification);
}
}
