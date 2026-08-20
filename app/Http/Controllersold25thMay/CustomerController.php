<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use Auth;
class CustomerController extends Controller
{
     //=========================================== Customer Data =====================================


	public function getCustomerAll(){

            $user = Auth::user();
        if($user->role_id==1){
           return view('admin/customer/allCustomer');
        }else{
            return redirect('/');
        }

            
    }

    public function getAllCustomerDatatable(){
        $user = Auth::user();
        if($user->role_id==1){
           $customer = User::where('role_id',3)->get();
           return Datatables($customer)->make(true);
        }else{
            return redirect('/');
        }
        
    }



//==============================Add Customer=================================
    public function getCustomerAdd(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/customer/addCustomer');
        }else{
            return redirect('/');
        }

        
    
    }

    public function postCustomerAdd(Request $request){
// dd($request->all());                                                                                                                                                           
        // phpinfo();die;
            $request->validate([
                                "name"=>'required',
                                'email'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                ]);
        $user = User::where('is_active',1)->where('email',$request->email)->first();
        if($user==""){
                $customer = new User;
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->role_id = 3;
                $customer->save();
                return redirect('allCustomer');
        }else{
            $notification = array(
              'message' => 'Email Already Exists', 
              'alert-type' => 'info'
              );
            return redirect()->back()->with($notification);
        }
        
    }

//============================================= Update Customer ============================================
    public function getCustomerUpdate($id){
        $user = Auth::user();
        if($user->role_id==1){
            $customer = User::find($id);
            return view('admin/customer/updateCustomer')->with('customer',$customer); 
        }else{
            return redirect('/');
        }
           
    }

    public function postCustomerUpdate(Request $request){
        
         $request->validate([
                                "name"=>'required',
                                'email'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                ]);
        $customer = User::find($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->role_id = 3;
        $customer->save();
        return redirect('allCustomer');
    } 


//========================= Delete Customer ======================================

public function getCustomerStatus(Request $request){
    $customer = User::find($request->id);

   if($customer!=""){
            if($customer->is_active==1){

                $customer->is_active=0;
            }else{
                $customer->is_active=1;
            }
        }
        $customer->save();
    return redirect('allCustomer');
}

}
