<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    public $primaryKey="bank_detail_id";

   public function user(){
    return $this->belongsTo('App\Models\User','user_id','id');
   }

}
