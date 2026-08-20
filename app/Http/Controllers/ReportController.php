<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Models\User;
Use Hash;
use Mail;
use App\Models\Userloan;
use App\Models\Loan;
use App\Models\BankDetail;
use App\Models\Disburseloan;
use App\Models\AgentQr;
use App\Models\Wallet;
use App\Models\Walletreason;
use App\Models\Permission;
use App\Models\Agentcommission;
use App\Models\Loansignin;
use Carbon\Carbon;

use App\Mail\MailNotify;
use App\Exports\ExportAgent;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use DataTables;
use App\Imports\ImportLoan;
use App\Exports\UserJourneyExport;

class ReportController extends Controller
{
	public function getcommisionreport(Request $request){
        // $checkpermission = Permission::where('permission_name', 'IMPORT')->first();
        // // dd($checkpermission);die;
        // if($checkpermission==null){
        // $permission = new Permission();
        // $permission->permission_name = "IMPORT";
        // $permission->permission_description="IMPORT";
        // $permission->save();
        // }
        // dd($checkpermission);
        $disburse = Disburseloan::first();
        // dd($disburse);
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_REPORT'))){
			return view('admin.unauthorized');
		}
         if(Auth::user()->kyc_status==0){
            if(Auth::user()->role_id==2 || Auth::user()->role_id==3){
            return view('admin.unaccess');
        }
        }
        $dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		if($dateRange!=null){
		$startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
		$endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
		}else{
			$startDate = Carbon::today()->format('Y-m-d');
			$endDate = Carbon::today()->subMonth()->format('Y-m-d');
		}
        if(Auth::user()->role_id!=2 || Auth::user()->role_id!=3){
        $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('agent')->with('bank')->get();
        }
        if(Auth::user()->role_id==2){
            $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('agent_id',Auth::user()->id)->with('agent')->with('bank')->get();
            }
        if(Auth::user()->role_id==3){
            $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('agent_id',Auth::user()->id)->with('agent')->with('bank')->get();
            }
        // dd($approvedloans, $startDate, $endDate);
        return view('admin.commision-report')->with('approvedloans',$approvedloans)->with('startDate', $startDate)->with('endDate', $endDate);
    }
    public function postcommisionremark(Request $request){
        // dd($request->all());
        $disburse_id = $request->buttonId;
        $disburse_remark = $request->textarea;
        $status_id = $request->dropdown;

        $disburse = Disburseloan::where('disburse_loan_id', $disburse_id)->first();
        $disburse->remark = $disburse_remark;
        $disburse->status_id = $status_id;
        $disburse->save();
        $request->session()->put('success',"Commission status changed Successfully!!");
        return redirect('admin/report/commision-report');
    }
    public function getcommisionreportalldata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_REPORT'))){
            return view('admin.unauthorized');
        }
        
        $dateRange = $request->daterange;

        $dates = explode(' - ', $dateRange);
        
        $startDate = $request["date_from"];
        $endDate = $request["date_to"];
        // dd($startDate, $endDate);
        $disburseloans = Disburseloan::with('agent')->with(['loan' => function ($query){
            $query->with('bank')->with('service');
            // dd($query->get());
        }])->get();
        // dd($disburseloans);
        if(Auth::user()->role_id!=2 || Auth::user()->role_id!=3){
        $approvedloans = Disburseloan::with('agent')->with(['loan' => function ($query){
            $query->with('bank')->with('service');
        }])->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==2){
            $approvedloans = Disburseloan::where('agent_id',Auth::user()->id)->with('agent')->with(['loan' => function ($query){
                $query->with('bank')->with('service');
            }])->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==3){
            $approvedloans = Disburseloan::where('agent_id',Auth::user()->id)->with('agent')->with(['loan' => function ($query){
                $query->with('bank')->with('service');
            }])->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        return DataTables::of($approvedloans)->make(true);
    }
    // public function getcustomer(Request $request){
    //     // dd(Disburseloan::with('agent')->with('loan')->get(), Agentcommission::first());
    //     $loan_id= $request->id;
    //     $user_loan = Loan::where('loan_id',$loan_id)->first();
    //     // dd($user_loan);
    //     return view('admin.customer-report-detail')->with('user_loan', $user_loan);

    // }
    public function getcustomer(Request $request){
       
        // dd(Disburseloan::with('agent')->with('loan')->get(), Agentcommission::first());
        $loan_id= $request->id;
        $user_loan = Loan::where('loan_id',$loan_id)->with('bankresponse')->with('custdocument')->first();
        // dd($user_loan->bank_service);
        if($user_loan->bank_service==53){
            $collectfiletype = [];
            foreach($user_loan->bankresponse as $response){
                if($response->filetype!=null){
                    array_push($collectfiletype, $response->filetype);
                }
                
            }
            if(in_array("GSTCertification-RegProof", $collectfiletype) && in_array("PanCard-Personal", $collectfiletype) && in_array("BankStatement-Company", $collectfiletype)){
                $user_loan->status_id = 5;
                $user_loan->save();
            }
            // dd($collectfiletype);

            return view('admin.customer-details-lendingkart')->with('user_loan', $user_loan)->with('collectfiletype', $collectfiletype);
        }
        elseif($user_loan->bank_service==56){
            $collectfiletype = [];
            foreach($user_loan->bankresponse as $response){
                if($response->filetype!=null){
                    array_push($collectfiletype, $response->filetype);
                }
                
            }
            if(in_array("profile", $collectfiletype) && in_array("pancard", $collectfiletype) && in_array("bankStatement", $collectfiletype)){
                $user_loan->status_id = 5;
                $user_loan->save();
            }
            // dd($collectfiletype);

            return view('admin.customer-details-cashe')->with('user_loan', $user_loan)->with('collectfiletype', $collectfiletype);
        }else{
            //dd($user_loan->bank_service);
            return view('admin.customer-report-detail')->with('user_loan', $user_loan);
        }

    }
    public function getagentpassword(Request $request){
        // dd($request->id);
        $agent_id = $request->id;
        $agent = User::where('id',$agent_id)->first();
        return view('admin.agent-password-change')->with('agent', $agent);
    }
    public function postagentpassword(Request $request){
        $agent_id = $request->id;
        $request->validate([
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ], [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.min' => 'The password confirmation must be at least 6 characters.',
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);
        $password = $request->password;
        $agent = User::where('id',$agent_id)->first();
        // dd($request->all(), $agent);
        $agent->password = Hash::make($password);
        $agent->save();
        $request->session()->put('success',"Password Changed Successfully!!");
        return redirect('admin/report/agent-report');


    }
      public function postusernewdetail(Request $request){
        $loan_id = $request->id;
        // dd($loan_id);
        if(isset($request['save'])){
            // dd($request->all(),Loan::find($loan_id) );die;
            $request->validate([
                'user_name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'pincode' => 'required|digits:6',
                'mother_maiden_name' => 'required',
                'company_incor_date' => 'required|date|before:' . now()->format('Y-m-d'),
                'dob' => 'required|date|before_or_equal:' . now()->subYears(10)->format('Y-m-d'),
                'loan_amount' => 'required|numeric',
                'residential_address' => 'required',
                'company_address' => 'required',
                'permanent_address' => 'required',
                'gst_no' => 'required',
            ]);
            $username = $request->user_name;
            // $fname = $request->fname;
            $phone = $request->phone;
            $email = $request->email;
            $pincode = $request->pincode;
            $loan_amount = $request->loan_amount;
            // $monthly_salary = $request->monthly_salary;
            // $gender = $request->gender;
            // $employee_type = $request->employee_type;
            $address = $request->address;
            // $city = $request->city;
            // $state = $request->state;
            // $pan_card = $request->pan_card;
            $dob = $request->dob;
            $mother_maiden_name = $request->mother_maiden_name;
            $company_incor_date = $request->company_incor_date;
            $residential_address = $request->residential_address;
            $company_address = $request->company_address;
            $permanent_address = $request->permanent_address;
            $gst_no = $request->gst_no;

            $loan = Loan::find($loan_id);
            // $loan->agent_id = $agent_id;
            $loan->full_name = $username;
            // $loan->fathers_name = $fname;
            $loan->mobile = $phone;
            $loan->email = $email;
            $loan->zip_code = $pincode;
            $loan->loan_amount = $loan_amount;
            // $loan->month_one_net_salary = $monthly_salary;
            // $loan->gender = $gender;
            // $loan->profession_type = $employee_type;
            $loan->residence_address = $residential_address;
            // $loan->city = $city;
            // $loan->state = $state;
            // $loan->pan_card = $pan_card;
            $loan->dob = $dob;
            $loan->mother_maiden_name = $mother_maiden_name;
            $loan->company_incorporation_date = $company_incor_date;
            $loan->office_address = $company_address;
            $loan->permanent_address = $permanent_address;
            $loan->gst_no = $gst_no;
            // $loan->residence_address = $residential_address;
            $loan->save();
            // dd($loan);
            $request->session()->put('success',"Loan details Updated Successfully!!");
            return redirect('admin/report/customer-report');
        }
        if(isset($request['approve'])){
            $loan = Loan::where('loan_id', $loan_id)->first();
            $loan->status_id = 1;
            $loan->save();
            $mailData = [
                'type' => 'congrats',
                'title' => 'Mail from Loan Sarovar',
                'body' => $loan->full_name,
                'content' => "Your Loan has been approved successfully, thank for connecting with Loan Sarovar."
            ];
             
            Mail::to($loan->email)->send(new MailNotify($mailData));
            $request->session()->put('success',"Loan Approved Successfully!!");
            return redirect('admin/report/customer-report');
        }
        if(isset($request['reject'])){
            $loan = Loan::where('loan_id', $loan_id)->first();
            $loan->status_id = 2;
            $loan->save();
            $mailData = [
                'type' => 'reject',
                'title' => 'Mail from Loan Sarovar',
                'body' => $loan->full_name,
                'content' => "Your Loan application is rejected, thank for connecting with Loan Sarovar."
            ];
             
            Mail::to($loan->email)->send(new MailNotify($mailData));
            $request->session()->put('success',"Loan Rejected Successfully!!");
            return redirect('admin/report/customer-report');
        }
        if(isset($request['disburse'])){

            $loan = Loan::where('loan_id', $loan_id)->first();
            // dd($loan);die;
            $checkbank = $loan->bank_service;
            $checksubservice = $loan->purpose_of_loan;
            $agent_role = User::where('id',$loan->agent_id)->first();

            $count = Agentcommission::where('role_id', $agent_role->role_id)->where('bank_id', $checkbank)->where('sub_service_id', $checksubservice)->first();
            // dd($count, $loan);
            if($count==null){
            // dd($count);die;
                $errorMessage = 'Note: The commission for this service is not declared yet please contact admin or try again later.';
                return redirect()->back()->withErrors([$errorMessage])->withInput();
            }
            $loan->status_id = 3;
            $loan->save();
            $agent_role=User::where('id',$loan->agent_id)->first();
            $commission_percent = Agentcommission::where('role_id', $agent_role->role_id)->where('bank_id', $checkbank)->where('sub_service_id', $checksubservice)->first();
            // dd($loan, $commission_percent, ($commission_percent->commission/100)*$loan->loan_amount);

            $checkdisburse = Disburseloan::where('loan_id',$loan_id)->first();
            // dd($checkdisburse);die;
            if($checkdisburse==null){
                $commission_amount =($commission_percent->commission/100)*$loan->loan_amount;
                $disburse = new Disburseloan();
                $disburse->loan_id = $loan_id;
                $disburse->agent_id = $loan->agent_id;
                $disburse->percent = $commission_percent->commission;
                $disburse->commission_amount = $commission_amount;

                $disburse->status_id = 1;
                $disburse->save();
                $mailData = [
                    'type' => 'congrats',
                    'title' => 'Mail from Loan Sarovar',
                    'body' => $loan->full_name,
                    'content' => "Your Loan Amount disbursed successfully, thank for connecting with Loan Sarovar."
                ];
                 
                Mail::to($loan->email)->send(new MailNotify($mailData));
            }

            $request->session()->put('success',"Loan disbursed Successfully!!");
            return redirect('admin/report/customer-report');
        }
        if(isset($request['sanction'])){
            $loan = Loan::where('loan_id', $loan_id)->first();
            $loan->status_id = 4;
            $loan->save();
            $request->session()->put('success',"Loan sanctioned Successfully!!");
            return redirect('admin/report/customer-report');
        }
    }
     public function importLoanView(){
        // dd(Loan::first());
        return view('admin.importLoanFile');
    }
    public function importLoanreport(Request $request){
        // dd($request->all());
        Excel::import(new ImportLoan, $request->file('file')->store('files'));
        return redirect()->back();
    }
    
    // public function autoImportFromEmail()
    // {
    //     try {
    //         $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
    //         $username = env('GMAIL_USERNAME');
    //         $password = env('GMAIL_PASSWORD');
    
    //         $inbox = imap_open($hostname, $username, $password);
    
    //         if (!$inbox) {
    //             return back()->with('error', 'IMAP Connection Failed');
    //         }
    
    //         // CASHe filter
    //         $emails = imap_search($inbox, 'UNSEEN FROM "cashemerchantreports@cashe.co.in" SUBJECT "Partners MIS Report"');
    
    //         if (!$emails) {
    //             return back()->with('success', 'No new emails found');
    //         }
    
    //         foreach ($emails as $email_number) {
    
    //             $structure = imap_fetchstructure($inbox, $email_number);
    
    //             if (!isset($structure->parts)) continue;
    
    //             foreach ($structure->parts as $key => $part) {
    
    //                 if (isset($part->disposition) && strtoupper($part->disposition) == "ATTACHMENT") {
    
    //                     $attachment = imap_fetchbody($inbox, $email_number, $key + 1);
    
    //                     if ($part->encoding == 3) {
    //                         $attachment = base64_decode($attachment);
    //                     } elseif ($part->encoding == 4) {
    //                         $attachment = quoted_printable_decode($attachment);
    //                     }
    
    //                     $filename = $part->dparameters[0]->value ?? ('file_' . time() . '.xlsx');
    
    //                     // Only Excel
    //                     if (!str_contains($filename, '.xlsx')) continue;
    
    //                     $filePath = storage_path('app/' . $filename);
    //                     file_put_contents($filePath, $attachment);
    
    //                     //  Import
    //                     Excel::import(new ImportLoan, $filePath);
    //                 }
    //             }
    
    //             //  Mark as read
    //             imap_setflag_full($inbox, $email_number, "\\Seen");
    //         }
    
    //         imap_close($inbox);
    
    //         return back()->with('success', 'Auto Import Completed Successfully ✅');
    
    //     } catch (\Exception $e) {
    //         return back()->with('error', $e->getMessage());
    //     }
    // }
    
    public function autoImportFromEmail()
{
    try {
        $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
        $username = env('GMAIL_USERNAME');
        $password = env('GMAIL_PASSWORD');

        $inbox = imap_open($hostname, $username, $password);

        if (!$inbox) {
            return back()->with('error', 'IMAP Connection Failed');
        }

        $banks = [
            [
                'email' => 'cashemerchantreports@cashe.co.in',
                'subject' => 'Partners MIS Report'
            ]
        ];

        $totalEmails = 0;
        $processedEmails = 0;

        foreach ($banks as $bank) {

            $search = 'UNSEEN FROM "' . $bank['email'] . '"';

            if (!empty($bank['subject'])) {
                $search .= ' SUBJECT "' . $bank['subject'] . '"';
            }

            $emails = imap_search($inbox, $search);

            if (!$emails) continue;

            $totalEmails += count($emails);

            foreach ($emails as $email_number) {

                $structure = imap_fetchstructure($inbox, $email_number);

            $parts = $structure->parts ?? [$structure];

foreach ($parts as $index => $part) {

    $isAttachment = false;
$filename = '';

// Try to get filename
if (isset($part->dparameters)) {
    foreach ($part->dparameters as $param) {
        if (strtolower($param->attribute) == 'filename') {
            $filename = $param->value;
            $isAttachment = true;
        }
    }
}

if (isset($part->parameters)) {
    foreach ($part->parameters as $param) {
        if (strtolower($param->attribute) == 'name') {
            $filename = $param->value;
            $isAttachment = true;
        }
    }
}

//  FIX: also allow type 3 (octet-stream)
if (!$isAttachment && $part->type != 3) continue;

// If no filename → generate one
if (!$filename) {
    $filename = 'cashe_' . time() . '.xlsx';
}

    // IMPORTANT: Fix part number
    $partNumber = isset($structure->parts) ? $index + 1 : 1;

    $attachment = imap_fetchbody($inbox, $email_number, $partNumber);

    // Decode
    if ($part->encoding == 3) {
        $attachment = base64_decode($attachment);
    } elseif ($part->encoding == 4) {
        $attachment = quoted_printable_decode($attachment);
    }

    if (strlen($attachment) < 1000) continue;

    if (!str_contains($filename, '.xlsx')) {
        $filename = time() . '.xlsx';
    }

    $filePath = storage_path('app/' . $filename);
    file_put_contents($filePath, $attachment);

    
    // dd("FILE SAVED", $filePath);

    Excel::import(new ImportLoan, $filePath);

    $processedEmails++;
}

                //  Mark as read
                imap_setflag_full($inbox, $email_number, "\\Seen");
            }
        }

        imap_close($inbox);

        if ($totalEmails == 0) {
            return back()->with('success', 'No new emails found 📭');
        }

        return back()->with(
            'success',
            "✅ Emails Found: $totalEmails | Imported: $processedEmails"
        );

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}
    public function getcustomerreport(Request $request){
        if(!$this->checkPermission(Config::get('permissions.LOAN_REPORT'))){
			return view('admin.unauthorized');
		}
        if(Auth::user()->kyc_status==0){
            if(Auth::user()->role_id==2 || Auth::user()->role_id==3){
            return view('admin.unaccess');
        }
        }
        $id = Auth::user()->id;
        $dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		if($dateRange!=null){
		$startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
		$endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
		}else{
			$startDate = Carbon::today()->format('Y-m-d');
			$endDate = Carbon::today()->subMonth()->format('Y-m-d');

		}
         $agents = User::where('role_id', 2)->get();
        if(Auth::user()->role_id!=2 || Auth::user()->role_id!=3){
        $loans = Loan::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==2){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==3){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        // dd($loans);
        return view('admin.customer-report')->with('agents',$agents)->with('loans',$loans)->with('startDate', $startDate)->with('endDate', $endDate);
    }
    public function getcustomerreportdata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.LOAN_REPORT'))){
			return view('admin.unauthorized');
		}
       
        $id = Auth::user()->id;
        $dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		$startDate = $request["date_from"];
		$endDate = $request["date_to"];
         $agent_id = $request->agent_id;
        // dd($startDate);
        if(Auth::user()->role_id!=2 || Auth::user()->role_id!=3){
         if($agent_id !=null){
        $loans = Loan::where('agent_id', $agent_id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('bankresponse')->with('bank')->get();
        }else{
        $loans = Loan::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('bankresponse')->with('bank')->get();

        }
        }
        if(Auth::user()->role_id==2){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('bankresponse')->with('bank')->get();
        } 
        if(Auth::user()->role_id==3){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('bankresponse')->with('bank')->get();
        }   
        
        return DataTables::of($loans)->make(true);
    }
    public function getagentreport(){
        if(!$this->checkPermission(Config::get('permissions.AGENT_REPORT'))){
			return view('admin.unauthorized');
		}
        $agents = User::where('new_id','!=',null)->orderBy('created_at','desc')->with('agent_loan')->with('agent_qr')->get();
        // dd($agents);
        return view('admin.agent-report')->with('agents', $agents);
    }
    public function getagentreportdata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.AGENT_REPORT'))){
			return view('admin.unauthorized');
		}
        $startDate = $request["date_from"];
		$endDate = $request["date_to"];
        $agents = User::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('new_id','!=',null)->where('role_id',2)->with('agent_loan')->with('agent_qr')->get();
        // dd($agents);
        return DataTables::of($agents)->make(true);
    }
    public function downloadagentreport(Request $request){
        return Excel::download(new ExportAgent, 'agents.xlsx'); 
    }
    public function generator($id)
    {
        // $data = User::where('agent_access_code',$id)->first();
        // if(AgentQr::where('agent_id', $data->id)->first()==null){
        //     $qrcode = QrCode::size(250)->generate('http://localhost/fintech/admin/direct-services?access_code='.$data->agent_access_code);
        //     $agentqr = new AgentQr();
        //     $agentqr->agent_id = $data->id;
        //     $agentqr->qr_code = htmlentities($qrcode);
        //     $agentqr->save();
        // }
        return redirect('admin/qrcode/'.$id);


    }
    public function getagentqr(Request $request){
        $id = $request->id;
        $data = User::where('agent_access_code',$id)->with('agent_qr')->first();
        $agentqrcode = AgentQr::where('agent_id',$data->id)->first();
        // dd($data);
        return view('qrcode')->with('data',$data);
    }
    public function exportUsers(Request $request){
        return Excel::download(new ExportAgent, 'agents.xlsx');
    }
    public function getagentdetail(Request $request){
        $id = $request->id;
        $agent = User::where('id', $id)->first();
        $agent_bank = BankDetail::where('user_id',$id)->first();
        $customers = Loan::where('agent_id',$id)->get();
        // dd($agent);
        return view('admin.agent-detail')->with('agent',$agent)->with('agent_bank',$agent_bank)->with('customers',$customers);
    }
    public function getcustomeralldata(Request $request){
        $id = $request->id;
        $agent = User::where('id', $id)->first();
        $agent_bank = BankDetail::where('user_id',$id)->first();
        $customers = Loan::where('agent_id',$id)->get();
        // dd($agent);
        return DataTables::of($customers)->make(true);

    }
    public function postagentdetail(Request $request){
            // dd(AgentQr::all());die;
        
        $id = $request->id;
        $agent = User::where('id', $id)->first();
        $agent_bank = BankDetail::where('user_id',$id)->first();
        $user_name = $request->user_name;
        // $agent_id = $request->agent_id;
        // $agent_access_code = $request->agent_access_code;
        $phone = $request->phone;
        $email = $request->email;
        $pincode = $request->pincode;
        $bank_name = $request->bank_name;
        $ifsc_code = $request->ifsc_code;
        $bank_account_number = $request->bank_account_number;
        
        if(isset($request['save'])){
            $request->validate([
            'bank_name'=> 'required',
            'bank_account_number'=> 'required',
            'ifsc_code'=> 'required',

            'aadhar_front' => 'required|image|mimes:jpg,png,,pdf|max:1024',
            'aadhar_back' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'pan_card' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'kyc_video' => 'required|mimes:mp4|max:5120', // Accepts MP4 and MOV files, max size of 5MB
        ], [
            'aadhar_front.required' => 'The front image is required.',
            'aadhar_front.image' => 'The front image must be an image file.',
            'aadhar_front.mimes' => 'The front image must be a JPG or PNG.',
            'aadhar_front.max' => 'The front image must not exceed :max KB.',
            'aadhar_back.required' => 'The back image is required.',
            'aadhar_back.image' => 'The back image must be an image file.',
            'aadhar_back.mimes' => 'The back image must be a JPG or PNG.',
            'aadhar_back.max' => 'The back image must not exceed :max KB.',
            'pan_card.required' => 'The PAN image is required.',
            'pan_card.image' => 'The PAN image must be an image file.',
            'pan_card.mimes' => 'The PAN image must be a JPG or PNG.',
            'pan_card.max' => 'The PAN image must not exceed :max KB.',
            'kyc_video.required' => 'The KYC video is required.',
            'kyc_video.mimes' => 'The KYC video must be in MP4 or MOV format.',
            'kyc_video.max' => 'The KYC video must not exceed 5 MB.',
        ]);
        //  dd($request->all());   
         $agent->name = $user_name;
        //  $agent->new_id = $agent_id;
        //  $agent->agent_access_code = $agent_access_code;
         $agent->contact_number = $phone;
         $agent->email = $email;
         $agent->pincode = $pincode;
        //  if(Input::hasFile('aadhar_front')){
        if($request->hasFile('aadhar_front')){
			$front = $request->aadhar_front;
			$path = $front->store('aadhar-front');
			// $bankdetail->aadhar_front=$path;
            $agent->aadhar_front=$path;
		 } 
        // if(Input::hasFile('aadhar_back')){
        if($request->hasFile('aadhar_back')){
			$aadhar_back = $request->aadhar_back;
			$path = $aadhar_back->store('aadhar-back');
			// $bankdetail->aadhar_back=$path;
            $agent->aadhar_back=$path;
		}
        // if(Input::hasFile('pan_card')){
        if($request->hasFile('pan_card')){
			$pan_card = $request->pan_card;
			$path = $pan_card->store('pan_image');
			// $bankdetail->pan_card=$path;
            $agent->pan_card=$path;
		}
        //  if(Input::hasFile('pan_card')){
        if($request->hasFile('pan_card')){
            $pan_card = $request->pan_card;
            $path = $pan_card->store('pan_image');
            // $bankdetail->pan_card=$path;
            $agent->pan_card=$path;
        }
        // if(Input::hasFile('kyc_video')){
        if($request->hasFile('kyc_video')){
            $kyc_video = $request->kyc_video;
            $path = $kyc_video->store('kyc-video');
            // $bankdetail->pan_card=$path;
            $agent->video_kyc=$path;
        }
        $agent->save();
        if($agent_bank==null){
                $agent_new_bank = new BankDetail();
                $agent_new_bank->user_id = $id;
                $agent_new_bank->bank_name = $bank_name;
                $agent_new_bank->ifsc_code = $ifsc_code;
                $agent_new_bank->bank_account_number = $bank_account_number;
                $agent_new_bank->holder_name = $agent->name;
                $agent_new_bank->save();
        }
        else{
            $agent_bank->bank_name = $bank_name;
            $agent_bank->ifsc_code = $ifsc_code;
            $agent_bank->bank_account_number = $bank_account_number;
            $agent_bank->holder_name = $agent->name;
            $agent_bank->save();

        }
        }
         if(isset($request['nokyc'])){
            $agent->kyc_status = 0;
                $agent->save();
         }
        if(isset($request['kyc'])){
            $checkwallet = Wallet::find($id);
            // dd($checkwallet,$id, Carbon::today()->addMonths(3)->toDateString());die;
            if($checkwallet==null){
                $today = Carbon::today();
                $dateAfterThreeMonths = $today->addMonths(3)->toDateString();
                $walletadd = Walletreason::where('role_id',3)->where('reason_name','bonus')->first();
                $wallet = new Wallet();
                $wallet->agent_id = $id;
                $wallet->wallet_amount = $walletadd->amount;
                $wallet->amount_expiry = $dateAfterThreeMonths;
                $wallet->wallet_reason = $walletadd->reason_id;
                $wallet->save();
            }
            // $findaccesscode = User::where('id',$id)->first();
            $data = User::where('id',$id)->first();
            // dd($data);die;
            if(AgentQr::where('agent_id', $data->id)->first()==null){
                //$qrcode = QrCode::size(250)->generate('https://agent.bharatnidhi.com/admin/direct-services?access_code='.$data->agent_access_code);
                //$qrcode = QrCode::size(250)->generate('https://partner.loansarovar.com/admin/direct-services?access_code='.$data->agent_access_code);
                $qrcode = QrCode::format('svg')
    ->size(260)
    ->margin(0)
    ->color(255, 255, 255)          // QR blocks = WHITE
    ->backgroundColor(12, 12, 62)   // background = #0c0c3e
    ->generate(
        'https://partner.loansarovar.com/admin/direct-services?access_code='.$data->agent_access_code
    );

                $agentqr = new AgentQr();
                $agentqr->agent_id = $data->id;
                $agentqr->qr_code = htmlentities($qrcode);
                $agentqr->save();
            }
            // if($agent_bank!=null){
                
                $agent->kyc_status = 1;
                $agent->save();
                $mailData = [
                    'type' => 'congrats',
                    'title' => 'Mail from Loan Sarovar',
                    'body' => $agent->name,
                    'content' => "Your Request for KYC is Approved. Thanks for Connecting with Loan Sarovar."
                ];
                 
                Mail::to($agent->email)->send(new MailNotify($mailData));
            
        // }
    }
    if(isset($request['reject_kyc'])){
        $agent->kyc_status = 2; // 2 = rejected
        $agent->save();
    
        $mailData = [
            'type' => 'reject',
            'title' => 'Mail from Loan Sarovar',
            'body' => $agent->name,
            'content' => "Your KYC request has been rejected. Please contact support."
        ];
    
        Mail::to($agent->email)->send(new MailNotify($mailData));
    
        $request->session()->put('success',"KYC Rejected Successfully!!");
    }
        // return redirect('admin/report/'.$id);
        return redirect('admin/report/agent-report');
    }
    
    
    public function userJourneyReport()
    {
          $query = Loansignin::with([
        'menuClicks',
        'basicInfos',
        'bankClicks',
        'creditReports',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Date Filter
    |--------------------------------------------------------------------------
    */

    if (request()->filled('from_date')) {

        $query->whereDate(
            'created_at',
            '>=',
            request('from_date')
        );
    }

    if (request()->filled('to_date')) {

        $query->whereDate(
            'created_at',
            '<=',
            request('to_date')
        );
    }
    if (request()->filled('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'like', "%{$search}%")
            ->orWhere('contact_no', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhereHas('creditReports', function ($q2) use ($search) {
                $q2->where('pan', 'like', "%{$search}%");
            });
        });
    }

    if (request()->filled('active_from')) {
        $query->whereRaw("
            GREATEST(
                COALESCE(loansignins.updated_at, '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM basic_infos WHERE basic_infos.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM credit_reports WHERE credit_reports.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(created_at) FROM bank_clicks WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM menu_clicks WHERE menu_clicks.user_id = loansignins.loan_signin_id), '1970-01-01')
            ) >= ?
        ", [request('active_from')]);
    }

    if (request()->filled('active_to')) {
        $query->whereRaw("
            GREATEST(
                COALESCE(loansignins.updated_at, '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM basic_infos WHERE basic_infos.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM credit_reports WHERE credit_reports.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(created_at) FROM bank_clicks WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM menu_clicks WHERE menu_clicks.user_id = loansignins.loan_signin_id), '1970-01-01')
            ) <= ?
        ", [request('active_to') . ' 23:59:59']);
    }
    /*
    |--------------------------------------------------------------------------
    | Final Data
    |--------------------------------------------------------------------------
    */

        // $users = $query
            //     ->latest('loan_signin_id')
            //     ->paginate(10)
            //     ->appends(request()->query());
    
   $query->selectRaw("
    loansignins.*,

    GREATEST(

        COALESCE(loansignins.updated_at, '1970-01-01'),

        COALESCE(
            (SELECT MAX(updated_at)
             FROM basic_infos
             WHERE basic_infos.user_id = loansignins.loan_signin_id),
            '1970-01-01'
        ),

        COALESCE(
            (SELECT MAX(updated_at)
             FROM credit_reports
             WHERE credit_reports.user_id = loansignins.loan_signin_id),
            '1970-01-01'
        ),
        

        COALESCE(
            (SELECT MAX(created_at)
             FROM bank_clicks
             WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id),
            '1970-01-01'
        ),

        COALESCE(
            (SELECT MAX(updated_at)
             FROM menu_clicks
             WHERE menu_clicks.user_id = loansignins.loan_signin_id),
            '1970-01-01'
        )

    ) as last_activity_at
");

$users = $query
    ->orderByDesc('last_activity_at')
    ->paginate(10)
    ->appends(request()->query());
    
        $reports = $users->map(function ($user) {
    
           
            /*
            |--------------------------------------------------------------------------
            | Menu Data
            |--------------------------------------------------------------------------
            */
            
            $menuData = $user->menuClicks
                ->whereNotNull('item');
            
            $menusBrowsed = $menuData
                ->pluck('item')
                ->unique()
                ->implode(', ');
            
            $menuClicks = $menuData
                ->sum('click_count');
    
            /*
            |--------------------------------------------------------------------------
            | Basic Info
            |--------------------------------------------------------------------------
            */
    
            $basicInfo = $user->basicInfos->first();
    
            $basicInfoStatus = $basicInfo ? 'Yes' : 'No';
    
            $profession = null;
    
            if ($basicInfo && isset($basicInfo->dynamic_fields['profession_type'])) {
                $profession = $basicInfo->dynamic_fields['profession_type'];
            }
    
            /*
            |--------------------------------------------------------------------------
            | Bank Clicks
            |--------------------------------------------------------------------------
            */
    
            $bankGrouped = $user->bankClicks
                ->groupBy('bank_name');
    
            $banksClicked = [];
    
            foreach ($bankGrouped as $bankName => $clicks) {
    
                $count = $clicks->count();
    
                $banksClicked[] = $bankName . '-' . $count . ' clicks';
            }
    
            $banksClicked = implode(', ', $banksClicked);
    
            /*
            |--------------------------------------------------------------------------
            | Credit Report
            |--------------------------------------------------------------------------
            */
    
            $creditReport = \App\Models\CreditReport::where(
                                'user_id',
                                $user->loan_signin_id
                            )
                            
                            ->orderByDesc('updated_at')
                            ->first();
    
            $creditScore = $creditReport->credit_score ?? null;
            
            $loanAmount = $creditReport->loan_amount ?? null;
            
            $income = $creditReport->income ?? null;

             /*
            |--------------------------------------------------------------------------
            | Credit Card Lead
            |--------------------------------------------------------------------------
            */

            $creditCardLead = \App\Models\CreditCardLead::where(
                        'mobile',
                        $user->contact_no
                    )
                    ->orderByDesc('created_at')
                    ->first();

            $creditCardLeadStatus = $creditCardLead ? 'Yes' : 'No';

            // PAN (Credit Report first, then Credit Card)
            $pan = $creditReport->pan ?? $creditCardLead->pan ?? null;

             /*
|--------------------------------------------------------------------------
| Entry Source Tracking
|--------------------------------------------------------------------------
*/

$sources = [];

if ($basicInfo) {
    $sources[] = 'Loan Form';
}

if ($creditReport) {
    $sources[] = 'Credit Score / Loan Eligibility';
}

if ($creditCardLead) {
    $sources[] = 'Credit Card Page';
}

if ($user->bankClicks->count() > 0) {
    $sources[] = 'Bank Click';
}

// Agar koi bhi flow match nahi hua, matlab sirf popup se register hua
if (empty($sources)) {
    $sources[] = 'Direct Registration (Popup)';
}

$entrySource = implode(', ', $sources);
    
            /*
            |--------------------------------------------------------------------------
            | Journey Percentage
            |--------------------------------------------------------------------------
            */
    
           $journey = 20; // Registered

            if ($user->basicInfos->count() > 0) {
                $journey += 20;
            }
            
            if ($user->creditReports->count() > 0) {
                $journey += 20;
            }
            
            if ($user->bankClicks->count() > 0) {
                $journey += 20;
            }
            
            

    
            return (object)[
    
                'user_id' => $user->loan_signin_id,

                'otp_verified'     => (bool) $user->otp_verified,
    
                'name' => $user->customer_name,
    
                'phone' => $user->contact_no,
    
                'email' => $user->email,
    
                'registered' => optional($user->created_at)->format('Y-m-d'),

                'last_activity_at'   => $user->last_activity_at ? Carbon::parse($user->last_activity_at)->format('d M Y, h:i A') : null,
    
                'pincode' => $user->pincode,
    
                'menus_browsed' => $menusBrowsed,
    
                'menu_clicks' => $menuClicks,
    
                'basic_info' => $basicInfoStatus,

                'credit_card_lead' => $creditCardLeadStatus,

                'entry_source' => $entrySource,
    
                'profession' => $profession,
    
                'loan_amount' => $loanAmount,
                
                'income' => $income,
    
                'banks_clicked' => $banksClicked,
    
                'credit_score' => $creditScore,
    
                'pan' => $pan,
    
                'journey_percentage' => $journey,
            ];
        });
    
        return view('admin.reports.user_journey_report',compact('reports', 'users'));
    }
    public function userJourneyExport()
    {
        $filters = request()->only('from_date', 'to_date', 'search', 'active_from', 'active_to');
        return Excel::download(
            new UserJourneyExport($filters),
            'user-journey-report.xlsx'
        );
    }
}
