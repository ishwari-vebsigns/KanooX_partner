<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   protected $table = 'loansignins'; 

    protected $primaryKey = 'loan_signin_id'; 

    public $incrementing = true;

}
