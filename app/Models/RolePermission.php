<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    public $primaryKey='role_permission_id';


    public function permission(){
		return $this->hasOne('App\Models\Permission','permission_id','permission_id');
	}
    
    public function role(){
		return $this->belongsTo('App\Models\Role','role_id','role_id');
	}
}
