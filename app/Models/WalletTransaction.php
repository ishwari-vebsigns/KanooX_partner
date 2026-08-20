<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    public $primaryKey="wallet_transaction_id";

   public function user(){
    return $this->belongsTo('App\Models\User','user_id','id');
   }

   public function loan(){
    return $this->belongsTo('App\Models\Loan','loan_id','loan_id');
   }


}
