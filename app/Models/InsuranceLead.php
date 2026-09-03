<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceLead extends Model
{
    protected $table = 'insurance_leads';

    protected $fillable = [
        'name', 'gender', 'dob', 'mobile', 'email', 'national_id_number',
        'bankid', 'sub_service_id', 'user_id',
        'reference_id', 'status', 'terms_accepted',
        'additional_details',
    ];

    protected $casts = [
        'dob'                => 'date',
        'terms_accepted'     => 'boolean',
        'additional_details' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($lead) {
            if (empty($lead->reference_id)) {
                $lead->reference_id = 'LN-' . now()->format('Ymd') . '-' . random_int(100000, 999999);
            }
        });
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(Bank::class, 'bankid', 'bank_id');
    }

    public function subService()
    {
        return $this->belongsTo(Service::class, 'sub_service_id', 'service_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Bonus accessor - hardcoding avoid karta hai
    public function getInsuranceTypeLabelAttribute()
    {
        return $this->subService->service_name ?? null;
    }
}