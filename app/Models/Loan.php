<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Http\Controllers\LoanController;
class Loan extends Model
{
    public $primaryKey="loan_id";
    protected $fillable = [
        'application_id', // Add application_id to the fillable array
        'agent_id',
        'user_id',
        'full_name',
        'gst_no',
        'mother_maiden_name',
        'company_incorporation_date',
        'loan_amount',
        'bank_service',
        'residence_address',
        'office_address',
        'permanent_address',
        'dob',
        'email',
        'mobile',
        'zip_code',
        'purpose_of_loan',
        'status_id',
        'note',
    ];
    // public function loandoc()
    // {
    //     return $this->belongsTo('App\Models\LoanDocuments','loan_id','loan_id');
    // }
    
    public function loandoc()
    {
        return $this->hasMany('App\Models\LoanDocuments','loan_id','loan_id');
    }

     public function refer_by()
    {
        return $this->belongsTo('App\Models\User','refered_by','id');
    }
    
     public function associate()
    {
        return $this->belongsTo('App\Models\User','assigned_to','id');
    }
     public function comments()
    {
        return $this->hasMany('App\Models\Comment','loan_id','loan_id');
    }
    public function substatus()
    {
        return $this->belongsTo('App\Models\Status','status_id','status_id');
    }
    public function agent()
    {
        return $this->belongsTo('App\Models\User','agent_id','id');
    }
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_service','bank_id');
    }
     public function service()
    {
        return $this->belongsTo('App\Models\ServicesHierarchy','purpose_of_loan','child_service_id');
    }
    public function bankresponse()
    {
        return $this->Hasmany('App\Models\Bankresponse','loan_id','loan_id');
    }
    public function custdocument()
    {
        return $this->Hasmany('App\Models\Custdocument','loan_id','loan_id');
    }
}
