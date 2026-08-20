<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walletreason extends Model
{
    public $primaryKey="reason_id";

    public function role(){
        return $this->belongsTO('App\Models\Role','role_id','role_id');
    }
}
