<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use DataTables;
use App\Models\MutualFundList;
use Auth;
use App\Models\GetStarted;
use App\Models\ReferFriend;
use App\Models\TermInsurance;
use App\Models\HealthInsurance;
use App\Models\Loan;
use App\Models\MutualFund;
use App\Models\ApplyNow;
use App\Models\User;
use App\Models\CommissionMaster;
use App\Models\Branch;
use App\Models\WalletTransaction;
use App\Models\Redeem;
use App\Models\Bank;
use Hash;
use App\Models\LoanDocuments;
use App\Models\Contact;
use App\Models\ReferalTools;
use App\Models\PropertyLead;
use App\Models\Comment;
use App\Models\Status;
use App\Models\SanctionCalculator;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Loansignin;
use App\Models\Pincode;
use Config;
use App\Models\BankSubservice;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ExportBank;
use Maatwebsite\Excel\Facades\Excel;

class BankController extends Controller
{
    public function getEditBankservices(Request $request){
       
        $bank_id = $request->id;
        $sub_service_id = $request->service_id;
        $services = Service::where('is_main_service',0)->get();
        $bankservices = BankSubservice::where('bank_id', $bank_id)->where('bank_subservice_id',$sub_service_id)->with('bank')->with('service')->first();
        // dd($services);
        return view('bank.service-details')->with('bankservices',$bankservices)->with('services', $services);

    }
    public function postEditBankservices(Request $request){
        $bank_id = $request->id;
        $sub_service_id = $request->service_id;
        $bankservices = BankSubservice::where('bank_id', $bank_id)->where('bank_subservice_id',$sub_service_id)->first();
        // dd($request->all());
        if(isset($request['save'])){
            $bankservices->sub_service_id = $request->form_sub_service_id;
            if($request->bank_url!=""){
                $bankservices->bank_url = $request->bank_url;
            }
            else{
                 if($bankservices->bank_url!=""){
                    $bankservices->bank_url = null;
                 }   
                $bankservices->is_api = 1;
            }
           
            $bankservices->save();
            $request->session()->put('success',"Bank Service Updated Successfully!!");

        }
        if(isset($request['active'])){
            $bankservices->status_id = 1;
            $bankservices->save();
            $request->session()->put('success',"Bank Service activated Successfully!!");

        }
        if(isset($request['inactive'])){
            $bankservices->status_id = 0;
            $bankservices->save();
            $request->session()->put('success',"Bank Service inactivated Successfully!!");

        }


        return redirect('admin/bank/'.$bank_id);
    }
    public function getEditBank(Request $request){
        if(!$this->checkPermission(Config::get('permissions.BANK_DETAILS'))){
			return view('admin.unauthorized');
		}
        $id = $request->id;
        $services = Service::where('is_main_service',0)->get();
        $bank = Bank::where('bank_id',$id)->first();
        // $banks =Bank::all();
        $banks = BankSubservice::where('bank_id',$id)->with('bank')->with('service')->get();
        // dd($banks);
        return view('bank.details')->with('bank', $bank)->with('services', $services)->with('banks', $banks);
    }
    public function postEditBank(Request $request){
        $id = $request->id;
        // dd($id);
        
        $bank = Bank::find($id);

          $bank_url = NULL;
          if(isset($request['add-service'])){
            // dd($request->all());
            $sub_service_id = $request->sub_service_id;
            $bankcheck = BankSubservice::where('bank_id', $id)->where('sub_service_id', $sub_service_id)->first();
            if($bankcheck==null){
                $banksubservice = new BankSubservice();
                $banksubservice->sub_service_id = $sub_service_id;
                $banksubservice->bank_id = $id;
                $banksubservice->bank_url = $bank_url;
                if($request->bank_url!=""){
                    $banksubservice->bank_url = $request->bank_url;
                }
                else{
                    $banksubservice->is_api = 1;
                }
                // dd($banksubservice);
                $banksubservice->save();
                
            }
          }
          if(isset($request['save'])){
            
        $bank_name = $request->bank_name;
        $bank_desc = $request->desc;
        // $sub_service_id = $request->sub_service_id;
        
        
       
        $bank->bank_name = $bank_name;
        $bank->description = $bank_desc;
        // $bank->bank_url = $bank_url;
        // $bank->sub_service_id = $sub_service_id;
        if(Input::hasFile('logo')){
			$logo = $request->logo;
			$path = $logo->store('bank_logo');
			$bank->bank_image=$path;
		}
        $bank->save();
        
        $request->session()->put('success',"Bank Updated Successfully!!");
    }
    if(isset($request['active'])){
        $bank->is_active = 1;
        $bank->save();
        $request->session()->put('success',"Bank Activated Successfully!!");
        
    }
    if(isset($request['inactive'])){
        $bank->is_active = 0;
        $bank->save();
        $request->session()->put('success',"Bank Inactivated Successfully!!");
    }
    return redirect('admin/bank/all');
    }
    public function getAllBank(){
        if(!$this->checkPermission(Config::get('permissions.BANK_ALL'))){
			return view('admin.unauthorized');
		}
        $banks =Bank::all();
        // $banks = BankSubservice::with('bank')->with('service')->get();
        // dd($banks);
        return view('bank.all')->with('banks',$banks);
    }
    public function exportBank(Request $request){
        return Excel::download(new ExportBank, 'banks.xlsx');

    }
    public function getAllBankData(){

        $banks = Bank::all();
        // dd($banks);
        return DataTables::of($banks)->make(true);
    }
    public function getAddBank(){
        if(!$this->checkPermission(Config::get('permissions.BANK_ADD'))){
			return view('admin.unauthorized');
		}
		$services = Service::where('is_main_service',0)->get();

        return view('bank.add')->with('services',$services);
    }
    public function postAddBank(Request $request){

        $bank_url = NULL;
        $bank_name = $request->bank_name;
        $bank_desc = $request->desc;
        $bankcheck = Bank::where('bank_name', $bank_name)->first();
        // dd(count($request->sub_service_id));

        if($bankcheck==null){
        $bank = new Bank();
        // if($request->bank_url!=""){
        //     $bank_url = $request->bank_url;
        // }
        // else{
        //     $bank->is_api = 1;
        // }

        $bank->bank_name = $bank_name;
        $bank->description = $bank_desc;
        // $bank->bank_url = $bank_url;
        // $bank->sub_service_id = $sub_service_id;
        if($request->sub_service_image!=null){
			$logo = $request->sub_service_image;
			$path = $logo->store('bank_logo');
			$bank->bank_image=$path;
		}
        $bank->save();

        // $banksubservice = new BankSubservice();
        // $sub_service_id = $request->sub_service_id;
        // for($i=0;$i<count($sub_service_id);$i++){
        // $banksubservice->sub_service_id = $sub_service_id[$i];
        // $banksubservice->bank_id = $bank->bank_id;
        // $banksubservice->bank_url = $bank_url;
        // $banksubservice->save();
        // }
    }
    // if($bankcheck!=null){
    //     $banksubservice = new BankSubservice();
    //     $sub_service_id = $request->sub_service_id;
    //     for($i=0;$i<count($sub_service_id);$i++){
    //     $banksubservice->sub_service_id = $sub_service_id[$i];
    //     $banksubservice->bank_id = $bankcheck->bank_id;
    //     $banksubservice->bank_url = $bank_url;

    //     $banksubservice->save();
    //     }
    // }
        $request->session()->put('success',"Bank added Successfully!!");
        return redirect('admin/bank/all');
    }
    public function getBanks(Request $request){
        if(Auth::user()!=null){
        $sub_service_id = $request->id;
        $loan_signin_id=$request->session()->get('loan_signin_id');
        
        $user_loan = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        
        $pincodes = Pincode::where('pincode',$user_loan->pincode)->with('bank')->with(['bank'=>function ($query) use ($sub_service_id){
            $query->with(['banksubservice'=>function ($q) use ($sub_service_id){
                $q->where('sub_service_id',$sub_service_id);
            }]);
        }])->get();
        // dd($user_loan->pincode);
        $user_pincode = $user_loan->pincode;
        $banks =BankSubservice::where('sub_service_id', $sub_service_id)->with('service')->with('bank')->with('pincode')->get();

            // dd($user_pincode, $pincodes);
		return view('banknew')->with('banks', $banks)->with('user_pincode', $user_pincode)->with('pincodes', $pincodes);
    }else{
        // dd($request->access_code);
        $code = $request->access_code;
        if($code==null){
            return view('admin.unauthorized');
        }
        $sub_service_id = $request->id;
        $loan_signin_id=$request->session()->get('loan_signin_id');
        
        $user_loan = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        
        $pincodes = Pincode::where('pincode',$user_loan->pincode)->with('bank')->with(['bank'=>function ($query) use ($sub_service_id){
            $query->with(['banksubservice'=>function ($q) use ($sub_service_id){
                $q->where('sub_service_id',$sub_service_id);
            }]);
        }])->get();
        // dd($user_loan->pincode);
        $user_pincode = $user_loan->pincode;
        $banks =BankSubservice::where('sub_service_id', $sub_service_id)->with('service')->with('bank')->with('pincode')->get();

            // dd($user_pincode, $pincodes);
		return view('banknew')->with('banks', $banks)->with('user_pincode', $user_pincode)->with('pincodes', $pincodes)->with('code', $code);
    }
	}
    public function getusersignin(Request $request){
        $id = $request->id;
        if(Auth::user()==null){
        // dd($request->all());
        $code = $request->access_code;
			if($code==null){
				return view('admin.unauthorized');
			}
    }

        return view('services.user-signin')->with('id',$id);
    }
    public function postusersignin(Request $request){
         	$request->validate([
               'pincode' => 'required|digits:6|integer',    
               'contact_no' => 'unique:users,contact_number|digits:10'
            ]);
        // dd($request->all(),Bank::where('sub_service_id', $request->id)->where('is_api',0)->first());
        if(Auth::user()!=null){
        $agent_id = Auth::user()->id;
        $pincode = $request->pincode;
        $sub_service_id = $request->id;
        $contact_no = $request->contact_no;
        $loansignin = new Loansignin();
        $loansignin->pincode = $pincode;
        $loansignin->contact_no = $contact_no;
        $loansignin->agent_id = $agent_id;
        $loansignin->sub_service_id = $sub_service_id;
        $loansignin->save();
        // dd($loansignin->loan_signin_id);
        $request->session()->put('success',"Registered Successfully!!");
        $request->session()->put('loan_signin_id', $loansignin->loan_signin_id);
        $bank = Bank::where('sub_service_id', $sub_service_id)->first();
        // // dd($bank);die;
        // if($bank->is_api==0){
        //     return redirect($bank->bank_url);
        // }
        return redirect('admin/services/select-bank/'.$sub_service_id);
        }else{
            $code = $request->access_code;
            // dd($code);
            $findaccess = User::where('agent_access_code',$code)->first();
            $agent_id = $findaccess->id;
            // dd($agent_id);
            $pincode = $request->pincode;
            $sub_service_id = $request->id;
            $contact_no = $request->contact_no;
            $loansignin = new Loansignin();
            $loansignin->pincode = $pincode;
            $loansignin->contact_no = $contact_no;
            $loansignin->agent_id = $agent_id;
            $loansignin->sub_service_id = $sub_service_id;
            $loansignin->save();
            // dd($loansignin->loan_signin_id);
            $request->session()->put('success',"Registered Successfully!!");
            $request->session()->put('loan_signin_id', $loansignin->loan_signin_id);
            $bank = Bank::where('sub_service_id', $sub_service_id)->first();
            // // dd($bank);die;
            // if($bank->is_api==0){
            //     return redirect($bank->bank_url);
            // }
            return redirect('admin/direct-services/select-bank/'.$sub_service_id.'?access_code='.$code);
        }
       
        
       
    }
}
