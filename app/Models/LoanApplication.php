<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServicesHierarchy;
use App\Models\Customer;
use App\Models\User;

class LoanApplication extends Model
{
    protected $table = 'loan_applications';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'mobile',
        'gender',
        'dob',
        'pan_card',

        // documents
        'aadhaar_document',
        'pan_document',
        'income_certificate',

        //  loan details
        'loan_type',
        'loan_amount',
        'loan_term',
        'purpose_of_loan',
        'loan_requirement',
        'profession_type',
        'company_name',
        'work_experience',

        //  workflow
        'status',

        // approval button system
        'is_approved',
        'approved_by',
    ];

    //  frontend customer (who applied)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    //  admin / staff who approved
    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    //  Loan Type (from services_hierarchies)
    public function loanType()
    {
        return $this->belongsTo(
            ServicesHierarchy::class,
            'loan_type',        // loan_applications.loan_type
            'service_hierarchy_id'  // services_hierarchies.child_service_id
        );
    }

}
