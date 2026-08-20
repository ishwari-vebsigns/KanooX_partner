<?php

namespace App\Http\Controllers;
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
use App\Models\Agentcommission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Mail\MailNotify;
use App\Exports\ExportAgent;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use DataTables;

class ReportController extends Controller
{
	public function getcommisionreport(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_REPORT'))){
			return view('admin.unauthorized');
		}
        if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
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
        if(Auth::user()->role_id==1){
        $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->with('agent')->with('bank')->get();
        }
        if(Auth::user()->role_id==2){
            $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('agent_id',Auth::user()->id)->with('agent')->with('bank')->get();
            }
        // dd($approvedloans, $startDate, $endDate);
        return view('admin.commision-report')->with('approvedloans',$approvedloans)->with('startDate', $startDate)->with('endDate', $endDate);
    }
    public function getcommisionreportalldata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_REPORT'))){
			return view('admin.unauthorized');
		}
        if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
        $dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		
        $startDate = $request["date_from"];
		$endDate = $request["date_to"];
        // dd($startDate, $endDate);
		
        if(Auth::user()->role_id==1){
        $approvedloans = Loan::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status_id',3)->with('agent')->with('bank')->get();
        }
        if(Auth::user()->role_id==2){
            $approvedloans = Loan::where('status_id',3)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('agent_id',Auth::user()->id)->with('agent')->with('bank')->get();
            }
        return DataTables::of($approvedloans)->make(true);
    }
    public function getcustomer(Request $request){
        // dd(Disburseloan::with('agent')->with('loan')->get(), Agentcommission::first());
        $loan_id= $request->id;
        $user_loan = Loan::where('loan_id',$loan_id)->first();
        // dd($user_loan);
        return view('admin.customer-report-detail')->with('user_loan', $user_loan);

    }
  
    public function postusernewdetail(Request $request){
		$loan_id = $request->id;
		// dd($loan_id);
		if(isset($request['approve'])){
			$loan = Loan::where('loan_id', $loan_id)->first();
			$loan->status_id = 1;
			$loan->save();
            $mailData = [
                'type' => 'congrats',
                'title' => 'Mail from Bharat Nidhi',
                'body' => $loan->full_name,
                'content' => "Your Loan has been approved successfully, thank for connecting with Bharat Nidhi."
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
                'title' => 'Mail from Bharat Nidhi',
                'body' => $loan->full_name,
                'content' => "Your Loan application is rejected, thank for connecting with Bharat Nidhi."
            ];
             
            Mail::to($loan->email)->send(new MailNotify($mailData));
			$request->session()->put('success',"Loan Rejected Successfully!!");
			return redirect('admin/report/customer-report');
		}
        if(isset($request['disburse'])){
            $loan = Loan::where('loan_id', $loan_id)->first();
			$loan->status_id = 3;
			$loan->save();
            $commission_amount = Agentcommission::first();
            $checkdisburse = Disburseloan::where('loan_id',$loan_id)->first();

            if($checkdisburse==null){
                $disburse = new Disburseloan();
                $disburse->loan_id = $loan_id;
                $disburse->agent_id = $loan->agent_id;
                $disburse->percent = $commission_amount->commission;
                $disburse->status_id = 1;
                $disburse->save();
                $mailData = [
                    'type' => 'congrats',
                    'title' => 'Mail from Bharat Nidhi',
                    'body' => $loan->full_name,
                    'content' => "Your Loan Amount disbursed successfully, thank for connecting with Bharat Nidhi."
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
    public function getcustomerreport(Request $request){
        if(!$this->checkPermission(Config::get('permissions.LOAN_REPORT'))){
			return view('admin.unauthorized');
		}
        if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
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
        if(Auth::user()->role_id==1){
        $loans = Loan::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==2){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        // dd($loans);
        return view('admin.customer-report')->with('loans',$loans)->with('startDate', $startDate)->with('endDate', $endDate);
    }
    public function getcustomerreportdata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.LOAN_REPORT'))){
			return view('admin.unauthorized');
		}
        if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
        $id = Auth::user()->id;
        $dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		$startDate = $request["date_from"];
		$endDate = $request["date_to"];
        // dd($startDate);
        if(Auth::user()->role_id==1){
        $loans = Loan::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
        }
        if(Auth::user()->role_id==2){
            $loans = Loan::where('agent_id', $id)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
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
        $agents = User::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('new_id','!=',null)->with('agent_loan')->with('agent_qr')->get();
        // dd($agents);
        return DataTables::of($agents)->make(true);
    }
    public function downloadagentreport(Request $request){
        return Excel::download(new ExportAgent, 'agents.xlsx'); 
    }
    public function generator($id)
    {
        $data = User::where('agent_access_code',$id)->first();

        if(AgentQr::where('agent_id', $data->id)->first()==null){
            $qrcode = QrCode::size(250)->generate('http://localhost/fintech/admin/direct-services?access_code='.$data->agent_access_code);
            $agentqr = new AgentQr();
            $agentqr->agent_id = $data->id;
            $agentqr->qr_code = htmlentities($qrcode);
            $agentqr->save();
        }
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
        // dd($customers);
        return view('admin.agent-detail')->with('agent',$agent)->with('agent_bank',$agent_bank)->with('customers',$customers);
    }
    public function getcustomeralldata(Request $request){
        $id = $request->id;
        $agent = User::where('id', $id)->first();
        $agent_bank = BankDetail::where('user_id',$id)->first();
        $customers = Loan::where('agent_id',$id)->get();
        // dd($customers);
        return DataTables::of($customers)->make(true);

    }
    public function postagentdetail(Request $request){
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
        //  dd($request->all());   
         $agent->name = $user_name;
        //  $agent->new_id = $agent_id;
        //  $agent->agent_access_code = $agent_access_code;
         $agent->contact_number = $phone;
         $agent->email = $email;
         $agent->pincode = $pincode;
         if(Input::hasFile('aadhar_front')){
			$front = $request->aadhar_front;
			$path = $front->store('aadhar-front');
			// $bankdetail->aadhar_front=$path;
            $agent->aadhar_front=$path;
		 } 
        if(Input::hasFile('aadhar_back')){
			$aadhar_back = $request->aadhar_back;
			$path = $aadhar_back->store('aadhar-back');
			// $bankdetail->aadhar_back=$path;
            $agent->aadhar_back=$path;
		}
        if(Input::hasFile('pan_card')){
			$pan_card = $request->pan_card;
			$path = $pan_card->store('pan_image');
			// $bankdetail->pan_card=$path;
            $agent->pan_card=$path;
		}
        $agent->save();
        if($agent_bank!=null){
                $agent_bank->bank_name = $bank_name;
                $agent_bank->ifsc_code = $ifsc_code;
                $agent_bank->bank_account_number = $bank_account_number;
                $agent_bank->holder_name = $agent->name;
                $agent_bank->save();
        }

        }
        if(isset($request['kyc'])){
            $checkwallet = Wallet::find($id);
            // dd($checkwallet,$id, Carbon::today()->addMonths(3)->toDateString());die;
            if($checkwallet==null){
                $today = Carbon::today();
                $dateAfterThreeMonths = $today->addMonths(3)->toDateString();
                $wallet = new Wallet();
                $wallet->agent_id = $id;
                $wallet->wallet_amount = 50;
                $wallet->amount_expiry = $dateAfterThreeMonths;
                $wallet->wallet_reason = 3;
                $wallet->save();
            }
            if($agent_bank!=null){
                
                $agent->kyc_status = 1;
                $agent->save();
                $mailData = [
                    'type' => 'congrats',
                    'title' => 'Mail from Bharat Nidhi',
                    'body' => $agent->name,
                    'content' => "Your Request for KYC is Approved. Thanks for Connecting with Bharat Nidhi."
                ];
                 
                Mail::to($agent->email)->send(new MailNotify($mailData));
            
        }
    }
        return redirect('admin/report/'.$id);
    }
}
