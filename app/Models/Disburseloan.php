<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disburseloan extends Model
{
    public $primaryKey="disburse_loan_id";
     protected $fillable = [
        'loan_id',
        'agent_id',
        'percent',
        'commission_amount',
        'status_id'
    ];
    public function agent()
    {
        return $this->belongsTo('App\Models\User','agent_id','id');
    }
    public function loan()
    {
        return $this->belongsTo('App\Models\Loan','loan_id','loan_id');
    }
}
