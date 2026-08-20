<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $primaryKey="permission_id";
    public function role_permission(){
        return $this->hasMany('App\Models\RolePermission','permission_id','permission_id')->with('role');
    }
}
