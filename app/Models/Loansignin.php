<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MenuClick;
use App\Models\BankClick;
use App\Models\BasicInfo;
use App\Models\CreditReport;

class Loansignin extends Model
{
    public $primaryKey="loan_signin_id";
    
    
    protected $fillable = [
        'customer_name',
        'contact_no',
        'pincode',
        'agent_id',
        'sub_service_id',
        'otp',
        'company_name',
        'salary',
        'annual_turnover',
        'vintage',
        'loan_amount',
        'email',
        'password',
        'api_token',
    ];

     public function agent()
    {
        return $this->belongsTo('App\Models\User','agent_id','id');
    }
    public function subservice()
    {
        return $this->belongsTo('App\Models\Service','sub_service_id','service_id');
    }
    public function menuClicks()
    {
        // menu_clicks.user_id → loan_signin.loan_signin_id
        return $this->hasMany(MenuClick::class, 'user_id', 'loan_signin_id');
    }

    public function bankClicks()
    {
        return $this->hasMany(BankClick::class, 'loan_signin_id', 'loan_signin_id');
    }
    
    public function basicInfos()
    {
        return $this->hasMany(BasicInfo::class, 'user_id', 'loan_signin_id');
    }
    
    public function creditReports()
    {
        return $this->hasMany(CreditReport::class, 'user_id', 'loan_signin_id');
    }
}







