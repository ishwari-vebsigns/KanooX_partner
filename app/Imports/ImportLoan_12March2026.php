<?php
namespace App\Imports;

use App\Models\Loan;
use App\Models\Bank;
use App\Models\Service;
use App\Models\User;
use App\Models\Disburseloan;
use App\Models\Agentcommission;
use Carbon\Carbon;
use App\Models\Loansignin;

use Maatwebsite\Excel\Concerns\ToModel;

class ImportLoan implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] === 'Application ID') {
            return null;
        }
        // $status = 0;
        $bank = null;
        $service = null;
        // if ($row[16] == "approved" || $row[16] == "Approved") {
        //     $status = 1;
        // } elseif ($row[16] == "rejected" || $row[16] == "Rejected" ) {
        //     $status = 2;
        // } elseif ($row[16] == "disbursed" || $row[16] == "Disbursed") {
        //     $status = 3;
        // } elseif ($row[16] == "sanctioned" || $row[16] == "Sanctioned") {
        //     $status = 4;
        // } else {
        //     $status = 0;
        // }
        if ($row[16] == "approved" || $row[16] == "Approved") {
            $status = 1;
        } elseif ($row[16] == "rejected" || $row[16] == "Rejected" ) {
            $status = 2;
        } elseif ($row[16] == "disbursed" || $row[16] == "Disbursed") {
            $status = 3;
        } elseif ($row[16] == "sanctioned" || $row[16] == "Sanctioned") {
            $status = 4;
        } else {
            $status = 0;
        }
        // $bank = Bank::where('bank_name', $row[7])->first();
         $bank = Bank::where('bank_name', $row[6])->first();
        $service = Service::where('service_name', $row[15])->first();
         //$service = Service::where('service_name', $row[14])->first();
        // $checkaccess = User::where('agent_access_code', $row[1])->first();
        $mobile = $row[13];
        //$mobile = $row[12];

        $lead = Loansignin::where('contact_no', $mobile)
                ->orderBy('created_at','asc')
                ->first();
        
        $checkaccess = null;
        
        if($lead){
            $checkaccess = User::find($lead->agent_id);
        }
        $checkloan = Loan::where('application_id', $row[0])->first();
        
        $dob = null; // Initialize the $dob variable

        // Check if the $row array has the necessary elements
       
            // Parse the date using Carbon

            //$dob =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d');
            //$company_incorporation_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->format('Y-m-d');
            if(is_numeric($row[11])){
                $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d');
            }else{
                $dob = date('Y-m-d', strtotime($row[11]));
            }
            
            if(is_numeric($row[4])){
                $company_incorporation_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d');
            }else{
                $company_incorporation_date = date('Y-m-d', strtotime($row[4]));
            }
        // dd($row, $dob, $company_incorporation_date);

        if ($checkloan == null) {
            // if ($checkaccess != null) {
                $loan = new Loan([
                    'application_id' => $row[0],
                    // 'agent_id' => $checkaccess->id,
                    'agent_id' => $checkaccess ? $checkaccess->id : null,
                    'full_name' => $row[2],
                    'gst_no' => $row[3],
                    'mother_maiden_name' => $row[4],
                    'company_incorporation_date' => $company_incorporation_date,
                    // 'loan_amount' => $row[6],
                    'loan_amount' => $row[5],
                    // 'bank_service' => $bank->bank_id,
                    'bank_service' => $bank ? $bank->bank_id : null,
                    'residence_address' => $row[8],
                    'office_address' => $row[9],
                    'permanent_address' => $row[10],
                    'dob' => $dob,
                    'email' => $row[12],
                    'mobile' => $row[13],
                    'zip_code' => $row[14],
                    // 'email' => $row[11],
                    // 'mobile' => $row[12],
                    // 'zip_code' => $row[13],
                    // 'purpose_of_loan' => $service->service_id,
                    'purpose_of_loan' => $service ? $service->service_id : null,
                    'status_id' => $status,
                ]);

                $loan->save();

                // $findpercent = Agentcommission::where('role_id',$checkaccess->role_id)->first();
                // $commission_amount = ($findpercent->commission/100)*$row[6];
                if($checkaccess && $status == 3){
                $findpercent = Agentcommission::where('role_id',$checkaccess->role_id)->first();

                if (!$findpercent) {
                    return null;
                }
                
                // $loanAmount = floatval($row[6]);
                $loanAmount = floatval($row[5]);
                $commissionPercent = floatval($findpercent->commission);
                
                $commission_amount = ($commissionPercent / 100) * $loanAmount;
                $checkloanid = Disburseloan::where('loan_id',$loan->loan_id)->first();
                
                if ($status == 3) {
                    if($checkloanid==null){
                        $disburseloan = new Disburseloan();
                        $disburseloan->loan_id = $loan->loan_id;
                        $disburseloan->agent_id = $checkaccess->id;
                        $disburseloan->percent = $findpercent->commission;
                        $disburseloan->commission_amount = $commission_amount;
                        $disburseloan->status_id = 1;
                        $disburseloan->save();
                    }
                }
            // }
                }
        } else {
            // $checkloan->agent_id = $checkaccess->id;
            $checkloan->agent_id = $checkaccess ? $checkaccess->id : null;
            $checkloan->full_name = $row[2];
            $checkloan->gst_no = $row[3];
            $checkloan->mother_maiden_name = $row[4];
            $checkloan->company_incorporation_date = $company_incorporation_date;
            // $checkloan->loan_amount = $row[6];
            $checkloan->loan_amount = $row[5];
            // $checkloan->bank_service = $bank->bank_id;
            $checkloan->bank_service = $bank ? $bank->bank_id : null;
            $checkloan->residence_address = $row[8];
            $checkloan->office_address = $row[9];
            $checkloan->permanent_address = $row[10];
            $checkloan->dob = $dob;
            $checkloan->email = $row[12];
            $checkloan->mobile = $row[13];
            $checkloan->zip_code = $row[14];
            // $checkloan->purpose_of_loan = $service->service_id;
            $checkloan->purpose_of_loan = $service ? $service->service_id : null;
            $checkloan->status_id = $status;
            $checkloan->save();
            // dd($checkloan, $status);


            // $findpercent = Agentcommission::where('role_id',$checkaccess->role_id)->first();
            // $commission_amount = ($findpercent->commission/100)*$row[6];
            if($checkaccess && $status == 3){
            $findpercent = Agentcommission::where('role_id',$checkaccess->role_id)->first();

            if (!$findpercent) {
                return null;
            }
            
            // $loanAmount = floatval($row[6]);
            $loanAmount = floatval($row[5]);
            $commissionPercent = floatval($findpercent->commission);
            
            $commission_amount = ($commissionPercent / 100) * $loanAmount;
            
            $checkloanid = Disburseloan::where('loan_id',$checkloan->loan_id)->first();
            
            if ($status == 3) {
                if($checkloanid==null){
                    $disburseloan = new Disburseloan();
                    $disburseloan->loan_id = $checkloan->loan_id;
                    $disburseloan->agent_id = $checkaccess->id;
                    $disburseloan->percent = $findpercent->commission;
                    $disburseloan->commission_amount = $commission_amount;
                    $disburseloan->status_id = 1;
                    $disburseloan->save();
                }
            }
        }
        }
    }
}
