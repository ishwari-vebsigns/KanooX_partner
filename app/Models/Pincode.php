<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $fillable = ['bank_id','pincode','status_id'];
    public $primaryKey="pincode_id";
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_id','bank_id');
    }
}
