<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Hash;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAlluser(Request $request){
        $users = User::wherenotIn('role_id',[1,2,3])->get();
        // dd($users);
        return view('user.all');
    }
    public function getAlluserdata(Request $request){
        $users = User::wherenotIn('role_id',[1,2,3])->with('user_role')->get();
        return DataTables::of($users)->make(true);
    }
    public function getAdduser(Request $request){
        $roles = Role::wherenotIn('role_id',[1,2,3])->get();
        // dd($roles);
        return view('user.add')->with('roles',$roles);
    }
    public function postAdduser(Request $request){
        // dd($request->all());
        $request->validate([
            'role_id' => 'required',
            'user_name' => 'required',
            'phone' => 'required|unique:users,contact_number|digits:10',
            'email' => 'required|unique:users,email',    
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
               
        ]);
        $role_id = $request->role_id;
        $user_name = $request->user_name;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;

        $user = new User();
        $user->role_id = $role_id;
        $user->name = $user_name;
        $user->contact_number = $phone;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        $request->session()->put('success',"User Registrated Successfully!!");
        // return view('subagent.add');
        return redirect('admin/user/all');

       
    }
    public function getEdituser(Request $request){
        $id = $request->id;
        $user = User::where('id',$id)->first();
        $roles = Role::wherenotIn('role_id',[1,2,3])->get();
        return view('user.details')->with('user',$user)->with('roles',$roles);
    }
    public function postEdituser(Request $request){
        // dd($request->all());
        $id = $request->id;
        $user = User::where('id',$id)->first();

        if(isset($request['save'])){
            $request->validate([
                'role_id' => 'required',
                'user_name' => 'required', 
                'email' => [
                    'required',
                    Rule::unique('users', 'email')->ignore($id),
                ],      
                'phone' => [
                    'required',
                    Rule::unique('users', 'contact_number')->ignore($id),
                    'digits:10',
                ],  
                
            ]);
            $role_id = $request->role_id;
            $user_name = $request->user_name;
            $phone = $request->phone;
            $email = $request->email;
            
            $user->role_id = $role_id;
            $user->name = $user_name;
            $user->contact_number = $phone;
            $user->email = $email;
            $user->save();
        }
        if(isset($request['active'])){
            $user->is_active = 1;
            $user->save();
        }
        if(isset($request['inactive'])){
            $user->is_active = 0;
            $user->save();
        }

        return redirect('admin/user/all');
    }
    
}
