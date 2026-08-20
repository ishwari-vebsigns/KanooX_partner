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
use Haruncpi\LaravelIdGenerator\IdGenerator;
class BankController extends Controller
{
    public function getEditBank(Request $request){
        $id = $request->id;
        $services = Service::where('is_main_service',0)->get();
        $bank = Bank::where('bank_id',$id)->first();
        // dd($services);
        return view('bank.details')->with('bank', $bank)->with('services', $services);
    }
    public function postEditBank(Request $request){
        $id = $request->id;
        // dd($id);
        $bank = Bank::find($id);

          $bank_url = NULL;
          if(isset($request['save'])){
            
        $bank_name = $request->bank_name;
        $bank_desc = $request->desc;
        $sub_service_id = $request->sub_service_id;
        
        
        if($request->bank_url!=""){
            $bank_url = $request->bank_url;
        }
        else{
            $bank->is_api = 1;
        }
        $bank->bank_name = $bank_name;
        $bank->description = $bank_desc;
        $bank->bank_url = $bank_url;
        $bank->sub_service_id = $sub_service_id;
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
        return redirect('admin/bank/all');
    }
    if(isset($request['inactive'])){
        $bank->is_active = 0;
        $bank->save();
        $request->session()->put('success',"Bank Inactivated Successfully!!");
        return redirect('admin/bank/all');
    }
        return redirect('admin/bank/'.$id);
    }
    public function getAllBank(){
        $banks = Bank::with('bank_sub_service')->get();
        // dd($banks);
        return view('bank.all')->with('banks',$banks);
    }
    public function getAllBankData(){

        $banks = Bank::all();
        // dd($banks);
        return DataTables::of($banks)->make(true);
    }
    public function getAddBank(){
		$services = Service::where('is_main_service',0)->get();

        return view('bank.add')->with('services',$services);
    }
    public function postAddBank(Request $request){

        // dd($request->all());
        $bank_url = NULL;
        $bank_name = $request->bank_name;
        $bank_desc = $request->desc;
        $sub_service_id = $request->sub_service_id;
        
        $bank = new Bank();
        if($request->bank_url!=""){
            $bank_url = $request->bank_url;
        }
        else{
            $bank->is_api = 1;
        }
        $bank->bank_name = $bank_name;
        $bank->description = $bank_desc;
        $bank->bank_url = $bank_url;
        $bank->sub_service_id = $sub_service_id;
        if(Input::hasFile('logo')){
			$logo = $request->logo;
			$path = $logo->store('bank_logo');
			$bank->bank_image=$path;
		}
        $bank->save();
        $request->session()->put('success',"Bank added Successfully!!");
        return redirect('admin/bank/add');
    }
    public function getBanks(Request $request){
        $sub_service_id = $request->id;
        $banks =Bank::where('sub_service_id', $sub_service_id)->get();
        // dd($banks);
		return view('banknew')->with('banks', $banks);
	}
    public function getusersignin(Request $request){
        $id = $request->id;
        
        return view('services.user-signin')->with('id',$id);
    }
    public function postusersignin(Request $request){
         	$request->validate([
               'pincode' => 'required|digits:6|integer',    
               'contact_no' => 'unique:users,contact_number|digits:10'
            ]);
        // dd($request->all(),Bank::where('sub_service_id', $request->id)->where('is_api',0)->first());
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
        
       
    }
}
