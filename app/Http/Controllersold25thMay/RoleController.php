<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Config;
use DataTables;
class RoleController extends Controller
{
    public function getAddRole(){
        if(!$this->checkPermission(Config::get('permissions.ROLE_ADD'))){
			return view('admin.unauthorized');
		}
        return view('role.add');
    }
    public function postAddRole(Request $request){
        // dd($request->all());
        $role_name = $request->role;
        $role = new Role();
        $role->role = $role_name;
        $role->save();
		$request->session()->put('success',"Role Added Successfully!!");
        return redirect('admin/role/all');
    }
    public function getEditRole(Request $request){
        if(!$this->checkPermission(Config::get('permissions.ROLE_DETAILS'))){
			return view('admin.unauthorized');
		}
        // dd(Permission::all());
        $id = $request->id;
        
        $role=Role::find($id);
		if($role!=""){
			$permissions=Permission::with('role_permission')->get();

			$permission_ids=RolePermission::where('role_id',$role->role_id)->pluck('permission_id')->toArray();
            // dd($permission_ids);
			$assigned_permissions=Permission::whereIn('permission_id',$permission_ids)->get();
			return view("role.details")->with('role',$role)->with('permission_ids',$permission_ids)->with('permissions',$permissions);
		}else{
			return redirect('admin/role/all');
		}
    }
    public function getEditRolealldata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.ROLE_DETAILS'))){
			return view('admin.unauthorized');
		}
        
        $id = $request->id;
        
        $role=Role::find($id);
		if($role!=""){
			$permissions=Permission::with('role_permission')->get();

			$permission_ids=RolePermission::where('role_id',$role->role_id)->pluck('permission_id')->toArray();
            // dd($permission_ids);
			$assigned_permissions=Permission::whereIn('permission_id',$permission_ids)->get();
			return view("role.details")->with('role',$role)->with('permission_ids',$permission_ids)->with('permissions',$permissions);
		}else{
			return redirect('admin/role/all');
		}
    }
    public function postdeletepermissionRole(Request $request){
        $rid = $request->rid;
        $pid = $request->pid;
        $rolepermission = RolePermission::where('role_id',$rid)->where('permission_id', $pid)->delete();
        $request->session()->put('success',"Role Permissions Deleted Successfully!!");
    }
    public function postEditRole(Request $request){

        $rid = $request->rid;
        $pid = $request->pid;
        $rolepermission = RolePermission::where('role_id',$rid)->where('permission_id', $pid)->first();
        if($rolepermission==null){
            $roleper = New rolepermission();
            $roleper->role_id = $rid;
            $roleper->permission_id = $pid;
            $roleper->save();
            $request->session()->put('success',"Role Permissions Updated Successfully!!");

        }
        if($rolepermission!=null){
        // dd($rolepermission);
        RolePermission::where('role_id',$rid)->where('permission_id', $pid)->delete();
            $request->session()->put('success',"Role Permissions Deleted Successfully!!");

        }

        
        return redirect('admin/role/all');
    }
    public function getAllRole(){
        if(!$this->checkPermission(Config::get('permissions.ROLE_ALL'))){
			return view('admin.unauthorized');
		}
        $roles = Role::all();
        // dd($roles);
        return view('role.all')->with('roles',$roles);
    }
    public function getAllRoledata(){
        if(!$this->checkPermission(Config::get('permissions.ROLE_ALL'))){
			return view('admin.unauthorized');
		}
        $roles = Role::all();
        return DataTables::of($roles)->make(true);
    }
}
