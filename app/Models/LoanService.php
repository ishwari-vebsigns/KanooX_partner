<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanService extends Model
{
    protected $table = 'loan_services';

    protected $fillable = [
        'name',
        'slug',
        'service_child_id',
        'is_active',
    ];

    public function fields()
    {
        return $this->hasMany(LoanServiceField::class, 'loan_service_id');
        
    }
}
