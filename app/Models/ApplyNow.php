<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyNow extends Model
{
    public $primaryKey="apply_now_id";
    
    public function mutual_fund_list(){
		return $this->belongsTo('App\Models\MutualFundList','mutual_fund_list_id','mutual_fund_list_id');
	}
}
