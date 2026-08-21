<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    protected $table = 'basic_infos';
     protected $fillable = [
        'contact_no',
        'customer_name',
        'pincode',
        'user_id',
        'loan_service_id',
        'dynamic_fields',
        'status',
    ];

    protected $casts = [
        'dynamic_fields' => 'array',
    ];
    
    public function service()
{
    return $this->belongsTo(LoanService::class, 'loan_service_id');
}

}
