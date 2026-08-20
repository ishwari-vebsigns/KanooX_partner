<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceLead extends Model
{
    protected $table = 'insurance_leads';

    protected $fillable = [
        'gender',
        'name',
        'dob',
        'mobile',
        'user_id',
        'sub_service_id'
    ];
}
