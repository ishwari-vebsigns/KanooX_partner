<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSubservice extends Model
{
    public $primaryKey="bank_subservice_id";
    
      protected $fillable = [
        'bank_id',
        'sub_service_id',
        'bank_url',
        'is_api',
        'status_id',
         
    ];

    public function bank(){
     return $this->belongsTo('App\Models\Bank','bank_id','bank_id');
    }
    public function service(){
        return $this->belongsTo('App\Models\Service','sub_service_id','service_id');
    }
    public function pincode(){
        return $this->belongsTo('App\Models\Pincode','bank_id','bank_id');
    }
}
