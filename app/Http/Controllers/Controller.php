<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Config;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function checkPermission($permission){
		if (Auth::user()) {
			$user_id=Auth::user()->id;
			$role_id=Auth::user()->role_id;

			$role_permission_ids=RolePermission::where('role_id',$role_id)->pluck('permission_id');

			// $user_permission_ids=UserPermission::where('user_id',$user_id)->pluck('permission_id');

			$permissions=Permission::orWhereIn('permission_id',$role_permission_ids)->pluck('permission_name');
            // dd($permissions, Config::get('permissions.SERVICE_ADD'));
			if($permissions->contains($permission)){
				return true;
			}else{
				return false;
			}
		}
	}
}
