<?php

namespace App\Imports;

use App\Models\Loan;
use App\Models\Bank;
use App\Models\Service;
use App\Models\User;
use App\Models\Loansignin;
use App\Models\Disburseloan;
use App\Models\Agentcommission;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ImportLoan implements ToModel, WithHeadingRow
{
    // public function model(array $row)
    // {
    //     $statusMap = [
    //         'approved' => 1,
    //         'rejected' => 2,
    //         'disbursed' => 3,
    //         'sanctioned' => 4
    //     ];

    //     $status = $statusMap[strtolower(trim($row['status'] ?? ''))] ?? 0;

    //     $bank = Bank::where('bank_name',$row['bank_name'])->first();
    //     $service = Service::where('service_name',$row['service_name'])->first();
    //     $mobile = trim($row['mobile']);
    //     $mobile = preg_replace('/\D/', '', $mobile);
    //     $lead = Loansignin::where('contact_no',$mobile)->first();
    //     $userId = $lead ? $lead->loan_signin_id : null;
    //     $agent = $lead ? User::find($lead->agent_id) : null;

    //     $loan = Loan::updateOrCreate(
    //         ['application_id'=>$row['application_id']],
    //         [
    //             'user_id' => $userId,
    //             'agent_id' => $agent?->id,
    //             'full_name' => $row['full_name'],
    //             'gst_no' => $row['gst_no'],
    //             'mother_maiden_name' => $row['mother_name'],
    //             'loan_amount' => $row['loan_amount'],
    //             'bank_service' => $bank?->bank_id,
    //             'residence_address' => $row['residence_address'],
    //             'office_address' => $row['office_address'],
    //             'permanent_address' => $row['permanent_address'],
    //             'dob' => date('Y-m-d',strtotime($row['dob'])),
    //             'email' => $row['email'],
    //             // 'mobile' => $row['mobile'],
    //             'mobile' => $mobile,
    //             'zip_code' => $row['zip_code'],
    //             'purpose_of_loan' => $service?->service_id,
    //             'status_id' => $status
    //         ]
    //     );

    //     if($agent && $status == 3){
    //         $commission = Agentcommission::where('role_id',$agent->role_id)->first();

    //         if($commission){
    //             Disburseloan::firstOrCreate(
    //                 ['loan_id'=>$loan->loan_id],
    //                 [
    //                     'agent_id'=>$agent->id,
    //                     'percent'=>$commission->commission,
    //                     'commission_amount'=>($commission->commission/100)*$row['loan_amount'],
    //                     'status_id'=>1
    //                 ]
    //             );
    //         }
    //     }

    //     return $loan;
    // }
    private function getValue($row, $key)
    {
        foreach ($row as $k => $v) {
            if (strtolower(trim($k)) == strtolower(trim($key))) {
                return $v;
            }
        }
        return null;
    }
    
    // public function model(array $row)
    // {
    //      //dd(array_keys($row));
    //     //  Detect headers (for multi-bank support)
    //     $headers = array_keys($row);
    
    //     // Detect CASHe format
    //     $isCashe = false;
    
    //     foreach ($headers as $header) {
    //         if (str_contains(strtolower(trim($header)), 'customer_id')) {
    //             $isCashe = true;
    //             break;
    //         }
    //     }
    
    //     //  MAP CASHe → YOUR FORMAT
    //     if ($isCashe) {

    //         $row['application_id'] = $this->getValue($row, 'customer_id');
    //         $row['full_name'] = $this->getValue($row, 'customer_name');
    //         $row['mobile'] = $this->getValue($row, 'mobile_no');
    //         $row['email'] = $this->getValue($row, 'personal_email_id');
        
    //         // Loan amounts
    //         $row['loan_amount'] = $this->getValue($row, 'approved_loan_amount') 
    //                           ?? $this->getValue($row, 'requested_loan_amount');
        
    //         // Status
    //         $row['status'] = $this->getValue($row, 'customer_status_name');
        
    //         // Optional fields (safe handling)
    //         $row['failure_reason'] = $this->getValue($row, 'failure reason');
    //         $row['profile_completion'] = $this->getValue($row, 'Profile Completion');
        
    //         // Defaults
    //         $row['bank_name'] = 'CASHe';
    //         $row['service_name'] = 'Business Loan';
    //     }
    
    //     // STATUS MAP (Improved)
    //     $statusMap = [
    //         'approved' => 1,
    //         'rejected' => 2,
    //         'disbursed' => 3,
    //         'sanctioned' => 4
    //     ];
    
    //     $statusRaw = strtolower(trim($row['status'] ?? ''));
    
    //     $status = 0; // default = pending
    
    //     foreach ($statusMap as $key => $value) {
    //         if (str_contains($statusRaw, $key)) {
    //             $status = $value;
    //             break;
    //         }
    //     }
    
    //     // SAFE MOBILE CLEAN
    //     $mobile = trim($row['mobile'] ?? '');
    //     $mobile = preg_replace('/\D/', '', $mobile);
    
    //     if (!$mobile) return null; // skip invalid row
    
    //     // FETCH RELATIONS
    //     $bank = Bank::where('bank_name', $row['bank_name'] ?? null)->first();
    //     $service = Service::where('service_name', $row['service_name'] ?? null)->first();
    
    //     $lead = Loansignin::where('contact_no', $mobile)->first();
    //     $userId = $lead ? $lead->loan_signin_id : null;
    //     $agent = $lead ? User::find($lead->agent_id) : null;
    
    //     // SAVE LOAN
    //     $loan = Loan::updateOrCreate(
    //         ['application_id' => $row['application_id'] ?? uniqid()],
    //         [
    //             'user_id' => $userId,
    //             'agent_id' => $agent?->id,
    //             'full_name' => $row['full_name'] ?? null,
    //             'gst_no' => $row['gst_no'] ?? null,
    //             'mother_maiden_name' => $row['mother_name'] ?? null,
    //             'loan_amount' => $row['loan_amount'] ?? 0,
    //             'bank_service' => $bank?->bank_id,
    //             'residence_address' => $row['residence_address'] ?? null,
    //             'office_address' => $row['office_address'] ?? null,
    //             'permanent_address' => $row['permanent_address'] ?? null,
    //             'dob' => !empty($row['dob']) ? date('Y-m-d', strtotime($row['dob'])) : null,
    //             'email' => $row['email'] ?? null,
    //             'mobile' => $mobile,
    //             'zip_code' => $row['zip_code'] ?? null,
    //             'purpose_of_loan' => $service?->service_id,
    //             'status_id' => $status
    //         ]
    //     );
    
    //     // COMMISSION LOGIC
    //     if ($agent && $status == 3) {
    //         $commission = Agentcommission::where('role_id', $agent->role_id)->first();
    
    //         if ($commission) {
    //             Disburseloan::firstOrCreate(
    //                 ['loan_id' => $loan->loan_id],
    //                 [
    //                     'agent_id' => $agent->id,
    //                     'percent' => $commission->commission,
    //                     'commission_amount' => ($commission->commission / 100) * ($row['loan_amount'] ?? 0),
    //                     'status_id' => 1
    //                 ]
    //             );
    //         }
    //     }
    
    //     return $loan;
    // }
    public function model(array $row)
{
    // Detect bank
    $headers = array_keys($row);
    $bankType = $this->detectBank($headers);

    switch ($bankType) {
        case 'CASHe':
            $this->mapCashe($row);
            break;

        case 'KreditBee':
            $this->mapKreditBee($row);
            break;

        default:
            return null; // skip unknown format
    }

    // STATUS MAP
    $statusMap = [
        'approved' => 1,
        'rejected' => 2,
        'disbursed' => 3,
        'sanctioned' => 4
    ];

    $statusRaw = strtolower(trim($row['status'] ?? ''));
    $status = 0;

    foreach ($statusMap as $key => $value) {
        if (str_contains($statusRaw, $key)) {
            $status = $value;
            break;
        }
    }

    // CLEAN MOBILE
    $mobile = trim($row['mobile'] ?? '');
    $mobile = preg_replace('/\D/', '', $mobile);

    if (!$mobile || strlen($mobile) < 10) return null;

    // FETCH RELATIONS
    $bank = Bank::where('bank_name', $row['bank_name'] ?? null)->first();
    $service = Service::where('service_name', $row['service_name'] ?? null)->first();

    $lead = Loansignin::where('contact_no', $mobile)->first();
    $userId = $lead ? $lead->loan_signin_id : null;
    $agent = $lead ? User::find($lead->agent_id) : null;

    // SAVE LOAN
    $loan = Loan::updateOrCreate(
        ['application_id' => $row['application_id'] ?? uniqid()],
        [
            'user_id' => $userId,
            'agent_id' => $agent?->id,
            'full_name' => $row['full_name'] ?? null,
            'gst_no' => $row['gst_no'] ?? null,
            'mother_maiden_name' => $row['mother_name'] ?? null,
            'loan_amount' => $row['loan_amount'] ?? 0,
            'bank_service' => $bank?->bank_id,
            'residence_address' => $row['residence_address'] ?? null,
            'office_address' => $row['office_address'] ?? null,
            'permanent_address' => $row['permanent_address'] ?? null,
            'dob' => !empty($row['dob']) ? date('Y-m-d', strtotime($row['dob'])) : null,
            'email' => $row['email'] ?? null,
            'mobile' => $mobile,
            'zip_code' => $row['zip_code'] ?? null,
            'purpose_of_loan' => $service?->service_id,
            'status_id' => $status,
            'note' => $row['note'] ?? null
        ]
    );

    // COMMISSION
    if ($agent && $status == 3) {
        $commission = Agentcommission::where('role_id', $agent->role_id)->first();

        if ($commission) {
            Disburseloan::firstOrCreate(
                ['loan_id' => $loan->loan_id],
                [
                    'agent_id' => $agent->id,
                    'percent' => $commission->commission,
                    'commission_amount' => ($commission->commission / 100) * ($row['loan_amount'] ?? 0),
                    'status_id' => 1
                ]
            );
        }
    }

    return $loan;
}
private function detectBank($headers)
{
    $headers = array_map(fn($h) => strtolower(trim($h)), $headers);

    if (in_array('customer_id', $headers)) return 'CASHe';
    if (in_array('loan_id', $headers)) return 'KreditBee';
    if (in_array('lead_id', $headers)) return 'PaySense';

    return 'UNKNOWN';
}
private function mapCashe(&$row)
{
    // BASIC INFO
    $row['application_id'] = $this->getValue($row, 'customer_id');
    $row['full_name'] = $this->getValue($row, 'customer_name');
    $row['mobile'] = $this->getValue($row, 'mobile_no');
    $row['email'] = $this->getValue($row, 'personal_email_id');

    // LOCATION
    $row['zip_code'] = $this->getValue($row, 'pin_code');

    // LOAN DETAILS
    $row['loan_amount'] = $this->getValue($row, 'approved_loan_amount') 
                      ?? $this->getValue($row, 'requested_loan_amount');

    $row['loan_type'] = $this->getValue($row, 'requested_product_type');

    // STATUS
    $row['status'] = $this->getValue($row, 'customer_status_name');

    // EMPLOYMENT / INCOME
    $row['salary_type'] = $this->getValue($row, 'salary_received_type');
    $row['monthly_income'] = $this->getValue($row, 'monthly_customer_income');
    $row['employment_type'] = $this->getValue($row, 'employment_type');

    // DATES
    $row['created_at'] = $this->getValue($row, 'DR_Date');
    $row['updated_at'] = $this->getValue($row, 'status_changed_date');

    // EXTRA (optional storage fields)
    $row['note'] = json_encode([
        'campaign' => $this->getValue($row, 'campaign'),
        'campaign_changed_date' => $this->getValue($row, 'campaign_changed_date'),
        'preapproval_status' => $this->getValue($row, 'preapproval_status'),
        'ds_amount' => $this->getValue($row, 'ds_amount'),
        'api_push_date' => $this->getValue($row, 'Api_push_date'),
        'approved_product_type' => $this->getValue($row, 'approved_product_type'),
        'failure_reason' => $this->getValue($row, 'failure reason'),
        'ccp_date' => $this->getValue($row, 'CCP_date'),
        'fields_pending' => $this->getValue($row, 'FieldsPending'),
        'pending_docs' => $this->getValue($row, 'PendingDocs'),
        'profile_completion' => $this->getValue($row, 'Profile Completion'),
        'missing_docs' => $this->getValue($row, 'missing_document_list'),
        'reference_id' => $this->getValue($row, 'reference_id'),
    ]);

    // DEFAULTS
    $row['bank_name'] = 'CASHe';
    $row['service_name'] = 'Business Loan';
}
private function mapKreditBee(&$row)
{
    $row['application_id'] = $this->getValue($row, 'loan_id');
    $row['full_name'] = $this->getValue($row, 'name');
    $row['mobile'] = $this->getValue($row, 'phone');
    $row['email'] = $this->getValue($row, 'email_id');

    $row['loan_amount'] = $this->getValue($row, 'amount');
    $row['status'] = $this->getValue($row, 'status');

    $row['bank_name'] = 'KreditBee';
    $row['service_name'] = 'Personal Loan';
}
}










