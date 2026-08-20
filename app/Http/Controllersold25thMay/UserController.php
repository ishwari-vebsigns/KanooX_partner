<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use Storage;
use Auth;

class UserController extends Controller
{

	public function getUserAll(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('user/allUser');
        }else{
            return redirect('/');
        }
            
	}

	public function getAllUserDatatable(){
        $user = Auth::user();
        if($user->role_id==1){
           $user = User::where('role_id',3)->orderBy('id', 'desc')->with('role')->get();
        return Datatables($user)->make(true);
        }else{
            return redirect('/');
        }

		
	}



//==============================Add User=================================
    public function getUserAdd(){
        $user = Auth::user();
        if($user->role_id==1){
           $roles = Role::get();
           return view('user/addUser')->with('roles',$roles);
        }else{
            return redirect('/');
        }
    }

    public function postUserAdd(Request $request){
// dd($request->all());                                                                                                                                                           
        // phpinfo();die;
            $request->validate([
                                "company_name"=>'required',
                                'name'=>'required',
                                'email'=>'required',
                                'password'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                'city'=>'required',
                                'designation'=>'required',
                                'state'=>'required',
                                'country'=>'required',
                                'pincode'=>'required',
                                // 'password'=>'required'
                                ]);

            $user = User::where('is_active',1)->where('email',$request->email)->first();
            // echo $user;die;
        if($user==""){
                    $password = Hash::make($request->password);
                    $user = new User;
                    
                    $user->company_name = $request->company_name;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = $password;
                    $user->phone = $request->phone;
                    $user->address = $request->address;
                    $user->designation = $request->designation;
                    $user->city = $request->city;
                    $user->state = $request->state;
                    $user->country = $request->country;
                    $user->pincode = $request->pincode;
                    $user->role_id = 3;
                    $user->save();
                    return redirect('allUser');
        }else{
            $notification = array(
              'message' => 'Email Already Exists', 
              'alert-type' => 'info'
              );
            return redirect()->back()->with($notification);
        }

    }

//============================================= Update User ============================================
	public function getUserUpdate($id){
            $user = Auth::user();
        if($user->role_id==1){
            $user = User::find($id);
            $roles = Role::get();
            return view('user/updateUser')->with('user',$user)->with('roles',$roles);
        }else{
            return redirect('/');
        }


			
           
	}

	public function postUserUpdate(Request $request){
        
         $request->validate([
                                // "first_name"=>'required',
                                'name'=>'required',
                                'email'=>'required',
                                // 'password'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                'designation'=>'required',
                                'city'=>'required',
                                'state'=>'required',
                                'country'=>'required',
                                'pincode'=>'required',
                                // 'role_id'=>'required'
                                ]);

		$user = User::find($request->id);
    	if($request->password!=""){
            $password = Hash::make($request->password);
            $user->password = $password;
        }        
        // $user->first_name = $request->first_name;
        $user->name = $request->name;
        $user->email = $request->email;
        
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->role_id = 3;
        $user->save();
        return redirect('allUser');
	} 


//========================= Delete User ======================================

public function getUserStatus(Request $request){
    $user = User::find($request->id);

   if($user!=""){
            if($user->is_active==1){

                $user->is_active=0;
            }else{
                $user->is_active=1;
            }
        }
        $user->save();
    return redirect('allUser');
}



public function getUserProfile(){
        $user = Auth::user();
        if($user->role_id==1){        
    return view('admin/userProfile/userProfile')->with('user',$user);
        }else{
            return redirect('/');
        }
        
}

public function postUserProfile(Request $request){
    // dd($request->all());
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

        $user_profile = User::find($request->id);
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
        // return redirect('allUser');
        return redirect()->back();


}











}
