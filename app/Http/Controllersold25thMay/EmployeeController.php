<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Hash;
class EmployeeController extends Controller
{
    //=========================================== Employee Data =====================================


	public function getEmployeeAll(){
            $user = Auth::user();
        if($user->role_id==1){
           return view('admin/employee/allEmployee');
        }else{
            return redirect('/');
        }
            
    }

    public function getAllEmployeeDatatable(){
        $user = Auth::user();
        if($user->role_id==1){
           $employee = User::where('role_id',2)->orderBy('id','desc')->get();
           return Datatables($employee)->make(true);
        }else{
            return redirect('/');
        }
        
    }



//==============================Add Employee=================================
    public function getEmployeeAdd(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/employee/addEmployee');
        }else{
            return redirect('/');
        }
        
    }

    public function postEmployeeAdd(Request $request){
            $request->validate([
                                "name"=>'required',
                                'email'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                'designation'=>'required',
                                'password'=>'required'
                                ]);

            
        $password = Hash::make($request->password);
        $user = User::where('is_active',1)->where('email',$request->email)->first();
        if($user==""){
            $employee = new User;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->password = $password;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->designation = $request->designation;
            // $user->city = $request->city;
            // $user->state = $request->state;
            // $user->country = $request->country;
            // $user->pincode = $request->pincode;
            $employee->role_id = 2;
            $employee->save();
            return redirect('allEmployee');
        }else{
            $notification = array(
              'message' => 'Email Already Exists', 
              'alert-type' => 'info'
              );
            return redirect()->back()->with($notification);
        }
        
        
    }

//============================================= Update Employee ============================================
    public function getEmployeeUpdate($id){
        $user = Auth::user();
        if($user->role_id==1){
           $employee = User::find($id);
            return view('admin/employee/updateEmployee')->with('employee',$employee); 
        }else{
            return redirect('/');
        }    
    }

    public function postEmployeeUpdate(Request $request){
        
         $request->validate([
                                "name"=>'required',
                                'email'=>'required',
                                'phone'=>'required',
                                'address'=>'required',
                                'designation'=>'required'
                                // 'pincode'=>'required'
                                ]);

        $employee = User::find($request->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        if($request->password!=""){
            $password = Hash::make($request->password);
            $employee->password = $password;
        }
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        // $user->city = $request->city;
        // $user->state = $request->state;
        // $user->country = $request->country;
        // $user->pincode = $request->pincode;
        $employee->role_id = 2;
        $employee->save();
        return redirect('allEmployee');
    } 


//========================= Delete Employee ======================================

public function getEmployeeStatus(Request $request){
    $employee = User::find($request->id);

   if($employee!=""){
            if($employee->is_active==1){

                $employee->is_active=0;
            }else{
                $employee->is_active=1;
            }
        }
        $employee->save();
    return redirect('allEmployee');
}

}
