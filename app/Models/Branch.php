<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $primaryKey="branch_id";
     public function userlevels()
    {
    	return $this->hasOne('App\Models\User','id','user_id');
    }
}
