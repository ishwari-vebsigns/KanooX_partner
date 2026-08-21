<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $primaryKey="bank_id";
     protected $fillable = [
        'bank_name',
        'bank_image',
        'description',
        'know_more_description',
        'effective_interest_range',
        'age_limit',
        'sub_service_id',
        'is_active',
        'is_api',
        'bank_url',
        'processing_fee'
    ];

    public function bank_sub_service()
    {
        return $this->belongsTo('App\Models\Service','sub_service_id','service_id');
    }
    public function banksubservice()
    {
        return $this->belongsTo('App\Models\BankSubservice','bank_id','bank_id')->with('service');
    }
    
    public function bankpincode()
    {
        return $this->hasMany('App\Models\Pincode','bank_id','bank_id');
    }
}
