<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class MenuClick extends Model
{
    protected $table = 'menu_clicks';

    protected $fillable = [
        'user_id',
        'ip_address',
        'menu_type',
        'item',
        'click_count',
    ];

    //  FRONTEND CUSTOMER (not admin)
    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class, 'user_id');
    // }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'loan_signin_id');
        
    }
}
