<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanServiceField extends Model
{
    protected $table = 'loan_service_fields';

    protected $fillable = [
        'loan_service_id',
        'field_name',
        'field_label',
        'field_type',
        'is_required',
        'is_active',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(LoanService::class, 'loan_service_id');
    }
    
    
}
