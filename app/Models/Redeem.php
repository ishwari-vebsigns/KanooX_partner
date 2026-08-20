<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    public $primaryKey="redeem_id";

   public function user(){
    return $this->belongsTo('App\Models\User','user_id','id');
   }

}
