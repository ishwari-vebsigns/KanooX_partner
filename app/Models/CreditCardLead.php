<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCardLead extends Model
{
    protected $table = 'credit_card_leads';

    protected $fillable = [
        'name',
        'mobile',
        'dob',
        'pan',
        'profession_type',
    'annual_income',
        'user_id',
        'sub_service_id',
    ];
}
