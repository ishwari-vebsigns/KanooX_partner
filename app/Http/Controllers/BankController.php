<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use Mail;
use DataTables;
use App\Models\MutualFundList;
use Auth;
use GuzzleHttp\Client;
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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankController extends Controller
{
    public function getEditBankservices(Request $request){
       
         if(!$this->checkPermission(Config::get('permissions.BANK_DETAILS'))){
            return view('admin.unauthorized');
        }
        $bank_id = $request->id;
        $sub_service_id = $request->service_id;
        $services = Service::where('is_main_service',0)->get();
        $bankservices = BankSubservice::where('bank_id', $bank_id)->where('bank_subservice_id',$sub_service_id)->with('bank')->with('service')->first();
        return view('bank.service-details')->with('bankservices',$bankservices)->with('services', $services);

    }
    public function postEditBankservices(Request $request){
        $bank_id = $request->id;
        $sub_service_id = $request->service_id;
        $bankservices = BankSubservice::where('bank_id', $bank_id)
        ->where('bank_subservice_id',$sub_service_id)
        ->first();
        
        
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
           $bankservices->know_more_description = $request->know_more_description;
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
        // DB::statement('ALTER TABLE bank_subservices MODIFY bank_url VARCHAR(500)');
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
              $validator = Validator::make($request->all(), [
                'sub_service_id' => [
                    'required',
                    'exists:bank_subservices,sub_service_id'
                        . ',bank_id,' . $id,
                ],
            ]);     
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
             else{
                $errorMessage = 'The sub service for this bank is already exists.';
                // dd($errorMessage);
                return redirect()->back()->withErrors([$errorMessage])->withInput();
              }
          }
          if(isset($request['save'])){
              $request->validate([
                
                'bank_name' => [
                    'required',
                    Rule::unique('banks', 'bank_name')->ignore($id, 'bank_id'),
                ],      
                
                'desc' => 'required',
                'effective_interest_range' => 'required|string|max:50',
'age_limit' => 'required|string|max:50',

            ]);
        $bank_name = $request->bank_name;
        $bank_desc = $request->desc;
        // $sub_service_id = $request->sub_service_id;
        
        
       
        $bank->bank_name = $bank_name;
        $bank->description = $bank_desc;
        $bank->know_more_description = $request->know_more_description;

        $bank->effective_interest_range = $request->effective_interest_range;
$bank->age_limit = $request->age_limit;

        // $bank->bank_url = $bank_url;
        // $bank->sub_service_id = $sub_service_id;
//         if(Input::hasFile('logo')){
// 			$logo = $request->logo;
// 			$path = $logo->store('bank_logo');
// 			$bank->bank_image=$path;
// 		}
if ($request->hasFile('logo')) {
    $logo = $request->file('logo');
    $path = $logo->store('bank_logo');
    $bank->bank_image = $path;
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
     public function getdeleteBankall(Request $request){
        $bank_id = $request->id;
        // dd($bank_id);die;
        $findbank = Bank::find($bank_id);
        if($findbank!=null){
        $findbank->delete();
        $banksubservices = BankSubservice::where('bank_id',$bank_id)->delete();
        }
        return redirect('admin/bank/all');

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
        $request->validate([
            'bank_name' => 'required|string|max:255|unique:banks,bank_name',
            'desc' => 'required|string|max:255',    
            'sub_service_image' => 'required|image|mimes:jpg,png|max:1024',
            'effective_interest_range' => 'required|string|max:50',
            'age_limit' => 'required|string|max:50',

        ]);
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
        $bank->know_more_description = $request->know_more_description;

        $bank->effective_interest_range = $request->effective_interest_range;
        $bank->age_limit = $request->age_limit;
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
        $checkcashe="";
        
        $user_loan = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        
        
            // $pincodes = Pincode::where('pincode', $user_loan->pincode)->where('status_id', 1)
            // ->with('bank')->with(['bank' => function ($query) use ($sub_service_id) {
            //     $query->where('is_active', 1)->with(['banksubservice' => function ($q) use ($sub_service_id) {
            //     $q->where('sub_service_id', $sub_service_id)->where('status_id', 1);
            //             }]);
            // }])->whereHas('bank.banksubservice', function ($q) use ($sub_service_id) {
            // $q->where('sub_service_id', $sub_service_id)->where('status_id', 1);})->get();
            
            $pincodes = Pincode::where('pincode', $user_loan->pincode)
    ->where('status_id', 1)
    ->whereHas('bank', function ($q) use ($sub_service_id) {
        $q->where('is_active', 1)
          ->whereHas('banksubservice', function ($q2) use ($sub_service_id) {
              $q2->where('sub_service_id', $sub_service_id)
                 ->where('status_id', 1);
          });
    })
    ->with(['bank' => function ($query) use ($sub_service_id) {
        $query->where('is_active', 1)
              ->with(['banksubservice' => function ($q) use ($sub_service_id) {
                  $q->where('sub_service_id', $sub_service_id)
                    ->where('status_id', 1);
              }]);
    }])
    ->get();
            
         
            
           
    
        //     $checkcashe = Bank::where('bank_id',56)->with(['banksubservice'=>function ($query) use ($sub_service_id) {
        //     $query->where('sub_service_id', $sub_service_id);
        // }])->first();
        $user_pincode = $user_loan->pincode;
        $banks =BankSubservice::where('sub_service_id', $sub_service_id)
        ->with('service')
        ->with('bank')
        ->with('pincode')
        ->get();
        
       
        
        
        // dd($checkcashe);
            // dd($user_pincode, $pincodes);
		return view('banknew')->with('banks', $banks)->with('user_pincode', $user_pincode)->with('pincodes', $pincodes)->with('checkcashe', $checkcashe);
    }else{
        // dd($request->access_code);
        $checkcashe="";
        $code = $request->access_code;
        //$code = $request->access_code ?? $request->session()->get('agent_access_code');
        if($code==null){
            return view('admin.unauthorized');
        }
        $sub_service_id = $request->id;
        $loan_signin_id=$request->session()->get('loan_signin_id');
        $user_loan = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        
        // $checkcashe = Bank::where('bank_id',56)->with(['banksubservice'=>function ($query) use ($sub_service_id) {
        //     $query->where('sub_service_id', $sub_service_id);
        // }])->first();
        
        //pincode validation will remove when we will have it in web app
        // $pincodes = Pincode::where('pincode',$user_loan->pincode)
        // ->with('bank')
        // ->with(['bank'=>function ($query) use ($sub_service_id){
        //     $query->with(['banksubservice'=>function ($q) use ($sub_service_id){
        //         $q->where('sub_service_id',$sub_service_id);
        //     }]);
        // }])->get();
        
        $pincodes = BankSubservice::where('sub_service_id', $sub_service_id)
            ->where('status_id', 1)
            ->with('bank')
            ->get();
            
        // dd($user_loan->pincode);
        $user_pincode = $user_loan->pincode;
        $banks =BankSubservice::where('sub_service_id', $sub_service_id)->with('service')->with('bank')->with('pincode')->get();

            // dd($user_pincode, $pincodes);
		return view('banknew')->with('banks', $banks)->with('user_pincode', $user_pincode)->with('pincodes', $pincodes)->with('code', $code)->with('checkcashe', $checkcashe);
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
    public function getotp(Request $request){
        $id = $request->id;
        $loan_signin_id=$request->session()->get('loan_signin_id');
        $otp = rand(1000, 9999);
        $customer = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        // dd($customer);die;
        
        
        if($customer->otp==null){
        $customer->otp = $otp;
        $customer->save(); 
        }
        return view('admin.otp')->with('id',$id)->with('customer',$customer);
    }
    public function postotp(Request $request){

        $id = $request->id;
        $otp = $request->otp;
        $loan_signin_id=$request->session()->get('loan_signin_id');
        $customer = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
        $request->validate([
            'otp' => [
                'required',
                'numeric',
                'digits:4',
                function ($attribute, $value, $fail) {
                    $exists = Loansignin::where('otp', $value)->exists();
                    if (!$exists) {
                        $fail('The '.$attribute.' does not exist in the database.');
                    }
                },
            ],
        ]);
        if(Auth::user()!=null){
      
        if($otp == $customer->otp){
            // dd($otp);
              
            return redirect('admin/services/select-bank/'.$id);
        }else{
            $errorMessage = 'There was an error processing your OTP.';
            return redirect()->back()->withErrors([$errorMessage]);
        }
    }else{
            // $code = $request->access_code;
            $code = $request->access_code ?? session('agent_access_code');
            // dd($otp == $customer->otp);die;
            $findaccess = User::where('agent_access_code',$code)->first();
            $agent_id = $findaccess->id;
            $loan_signin_id=$request->session()->get('loan_signin_id');
            $customer = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
            if($otp == $customer->otp){
                // dd($otp);die;
                return redirect('admin/direct-services/select-bank/'.$id.'?access_code='.$code);
            }else{
                $errorMessage = 'There was an error processing your OTP.';
                return redirect()->back()->withErrors([$errorMessage]);
            }
    }

    //    dd($id);
        
    }
     public function postcheckcustomer(Request $request){
        $phone = $request->phone;
        $customer = Loansignin::where('contact_no', $phone)->first();
        // dd($customer);
        if ($customer) {
            // If the customer exists, return the customer name and pincode
            return response()->json([
                'name' => $customer->customer_name,
                'pincode' => $customer->pincode,
                 'salary' => $customer->salary,
                 'annual_turnover' => $customer->annual_turnover,
                  'company_name' => $customer->company_name,
                 'loan_amount' => $customer->loan_amount,
                  'vintage' => $customer->vintage
            ]);
        } else {
            // If the customer does not exist, return an empty response or an error message
            return response()->json([]);
        }
    }
    public function postusersignin(Request $request){
         	$request->validate([
                'customer_name' => 'required|string|max:255',
                'pincode' => 'required|digits:6|integer',    
                'contact_no' => 'required|digits:10'
            ]);
        //  dd($request->all(),Bank::where('sub_service_id', $request->id)->where('is_api',0)->first());
        if(Auth::user()!=null){
        $agent_id = Auth::user()->id;
        $customer_name = $request->customer_name;
        $pincode = $request->pincode;
        $sub_service_id = $request->id;
        $contact_no = $request->contact_no;
         $checkloansignin = Loansignin::where('contact_no', $contact_no)->where('pincode',$pincode)->first();
        // dd($checkloansignin);die;
         $otp = rand(1000, 9999);
            $client = new Client();
        if($checkloansignin==null){
        $loansignin = new Loansignin();
        $loansignin->customer_name = $customer_name;
        $loansignin->pincode = $pincode;
        $loansignin->contact_no = $contact_no;
        $loansignin->agent_id = $agent_id;
        $loansignin->sub_service_id = $sub_service_id;
        $loansignin->otp = $otp;

        $loansignin->company_name = $request->company_name;
        $loansignin->salary = $request->salary;
        $loansignin->annual_turnover = $request->annual_turnover;
        $loansignin->vintage = $request->vintage;
        $loansignin->loan_amount = $request->loan_amount;
        $loansignin->save();
        $message = 'Hello, your OTP is ' . $loansignin->otp . '. Please use this code to verify your account.';

                        $apiUrl = "https://2factor.in/API/V1/7b70ba79-fdd8-11f0-a6b2-0200cd936042/SMS/{$loansignin->contact_no}/{$loansignin->otp}/LoanSarovar?otp_expiry=10&otp_length=4&message={$message}";
                try {
                    $response = $client->post($apiUrl)->getBody();
                    
                    // Handle the response as needed
                    // $response contains the API response from the SMS service
                    // echo "SMS sent successfully!";
                } catch (\Exception $e) {
                    // Handle the exception, e.g., log the error or display an error message
                    echo "Failed to send SMS: " . $e->getMessage();
                }
                $request->session()->put('lead-success',"Registered Successfully!!");

                $request->session()->put('loan_signin_id', $loansignin->loan_signin_id);
         }
        else{
              // dd("user already exits");
              
              
        $checkloansignin->company_name = $request->company_name;
        $checkloansignin->salary = $request->salary;
        $checkloansignin->annual_turnover = $request->annual_turnover;
        $checkloansignin->vintage = $request->vintage;
        $checkloansignin->loan_amount = $request->loan_amount;
                $checkloansignin->otp = $otp;
                $checkloansignin->save();
                $apiKey = '7b70ba79-fdd8-11f0-a6b2-0200cd936042'; // Replace with your actual API key
                $phoneNumber = $checkloansignin->contact_no; // Replace with the recipient's phone number
                $otpValue = $checkloansignin->otp; // Replace with the OTP value you want to send
                $otpTemplateName = 'LoanSarovar'; // Replace with the OTP template name if needed
                $message = 'Hello, your OTP is ' . $checkloansignin->otp . '. Please use this code to verify your account.';

                $apiUrl = "https://2factor.in/API/V1/$apiKey/SMS/$phoneNumber/$otpValue/$otpTemplateName";
                try {
                    $response = $client->post($apiUrl)->getBody();
                    
                    // Handle the response as needed
                    // $response contains the API response from the SMS service
                    // echo "SMS sent successfully!";
                } catch (\Exception $e) {
                    // Handle the exception, e.g., log the error or display an error message
                    echo "Failed to send SMS: " . $e->getMessage();
                }
                $request->session()->put('loan_signin_id', $checkloansignin->loan_signin_id);
        }
        // dd($loansignin);die;
        $request->session()->put('sub_service_id', $sub_service_id);
        $bank = Bank::where('sub_service_id', $sub_service_id)->first();
        // // dd($bank);die;
        // if($bank->is_api==0){
        //     return redirect($bank->bank_url);
        // }
        return redirect('admin/services/otp/'.$sub_service_id);
        }else{
            $code = $request->access_code;
            // dd($code);
            $findaccess = User::where('agent_access_code',$code)->first();
            $agent_id = $findaccess->id;
            $request->session()->put('agent_access_code', $code);
            // dd($agent_id);
            $customer_name = $request->customer_name;
            $pincode = $request->pincode;
            $sub_service_id = $request->id;
            $contact_no = $request->contact_no;
        //     $loansignin = new Loansignin();
        //     $loansignin->customer_name = $customer_name;
        //     $loansignin->pincode = $pincode;
        //     $loansignin->contact_no = $contact_no;
        //     $loansignin->agent_id = $agent_id;
        //     $loansignin->sub_service_id = $sub_service_id;
        //      $loansignin->company_name = $request->company_name;
        // $loansignin->salary = $request->salary;
        // $loansignin->annual_turnover = $request->annual_turnover;
        // $loansignin->vintage = $request->vintage;
        // $loansignin->loan_amount = $request->loan_amount;
        //     $loansignin->save();
  $loansignin = Loansignin::firstOrCreate(
    [
        'contact_no' => $contact_no,
        'pincode' => $pincode
    ],
    [
        'customer_name' => $customer_name,
        'agent_id' => $agent_id,
        'sub_service_id' => $sub_service_id,
        'company_name' => $request->company_name,
        'salary' => $request->salary,
        'annual_turnover' => $request->annual_turnover,
        'vintage' => $request->vintage,
        'loan_amount' => $request->loan_amount,
    ]
);

// OTP
$otp = rand(1000, 9999);
$loansignin->otp = $otp;
$loansignin->save();
            // dd($loansignin->loan_signin_id);
            $request->session()->put('success',"Registered Successfully!!");
            $request->session()->put('loan_signin_id', $loansignin->loan_signin_id);
            $request->session()->put('sub_service_id', $sub_service_id);
            $bank = Bank::where('sub_service_id', $sub_service_id)->first();
            // // dd($bank);die;
            // if($bank->is_api==0){
            //     return redirect($bank->bank_url);
            // }
            return redirect('admin/direct-services/otp/'.$sub_service_id.'?access_code='.$code);
        }
       
        
       
    }
    public function resendOtp(Request $request){
    // dd($request->customer_id);die;
    $customer_id_fetch = $request->customer_id;
    $otp = rand(1000, 9999);
    $customer = Loansignin::where('loan_signin_id', $customer_id_fetch)->first();
    $customer->otp = $otp;
    $customer->save();

    $apiKey = '7b70ba79-fdd8-11f0-a6b2-0200cd936042'; // Replace with your actual API key
                $phoneNumber = $customer->contact_no; // Replace with the recipient's phone number
                $otpValue = $customer->otp; // Replace with the OTP value you want to send
                $otpTemplateName = 'LoanSarovar'; // Replace with the OTP template name if needed
                $message = 'Hello, your OTP is ' . $customer->otp . '. Please use this code to verify your account. Team BharatNidhi';
    $apiUrl = "https://2factor.in/API/V1/$apiKey/SMS/$phoneNumber/$otpValue/$otpTemplateName";
                        // $apiUrl = "https://2factor.in/API/V1/d538184e-1e7b-11ee-addf-0200cd936042/SMS/{$loansignin->contact_no}/{$loansignin->otp}/OTP1?otp_expiry=10&otp_length=4&message={$message}";
                        $client = new Client();

                        try {
                            $response = $client->get($apiUrl);
                        
                            if ($response->getStatusCode() == 200) {
                                echo 'OTP sent successfully!';
                            } else {
                                echo 'Failed to send OTP. Status code: ' . $response->getStatusCode();
                            }
                        } catch (\Exception $e) {
                            echo 'Failed to send OTP: ' . $e->getMessage();
                        }
    return response()->json(['message' => 'OTP resent successfully.']);
    }
}
