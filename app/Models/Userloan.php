<?php

namespace App\Models;
// use App\Models\Loan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userloan extends Model
{
    public $primaryKey='user_loan_id';

    public function user_loan(){
        return $this->belongsTO('App\Models\Loan','loan_id','loan_id');
    }
}
