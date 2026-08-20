<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferalTools extends Model
{
     public $primaryKey="referal_tool_id ";
       public function refer_by(){
    return $this->belongsTo('App\Models\User','referred_by','id');
   }
}
