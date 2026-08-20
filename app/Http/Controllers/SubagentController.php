<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\Wallet;
use App\Models\Walletreason;
use App\Models\AgentQr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
Use Hash;
use Auth;
use Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;
use App\Mail\Checkkyc;
use App\Mail\MailNotify;
use App\Models\Subagent;
use App\Mail\CheckkycMailtoadmin;
use Config;
use Carbon\Carbon;
use DateTime;
use DataTables;
use Illuminate\Validation\Rule;

class SubagentController extends Controller
{
   public function getAddsubagent(){
    // dd(Subagent::all());
    $agents = User::where('new_id','!=',null)->where('role_id',2)->where('kyc_status',1)->get();
    return view('subagent.add')->with('agents', $agents);
   }
   public function postAddsubagent(Request $request){
    // dd($request->all());
    $request->validate([
        'user_name' => 'required', 
        'email' => 'required|unique:users,email',    
        'phone' => 'required|unique:users,contact_number|digits:10',  
        'pincode' => 'required',
        'password' => 'required',
        'bank_name' => 'required',
        'bank_account_number' => 'required|numeric',
        'ifsc_code' => 'required',
        'kyc_video' => 'required|mimes:mp4|max:5120',
        'aadhar_front' => 'required|max:1024',
        'aadhar_back' => 'required|max:1024',
        'pan_card' => 'required|max:1024',
        'password' => 'required|min:6',
        'c_password' => 'required|min:6|same:password',
        // 'refered_code' => 'required', 
           
    ],[
        'kyc_video.required' => 'The KYC video is required.',
        'kyc_video.mimes' => 'The KYC video must be in MP4 format.',
        'kyc_video.max' => 'The KYC video must not exceed 5 MB.',
        'aadhar_front.required' => 'The front image is required.',
        'aadhar_front.mimes' => 'The front image must be a PDF.',
        'aadhar_front.max' => 'The front image must not exceed :max KB.',
        'aadhar_back.required' => 'The back image is required.',
        'aadhar_back.mimes' => 'The back image must be a PDF.',
        'aadhar_back.max' => 'The back image must not exceed :max KB.',
        'pan_card.required' => 'The PAN image is required.',
        'pan_card.mimes' => 'The PAN image must be a PDF.',
        'pan_card.max' => 'The PAN image must not exceed :max KB.',
    ]);
    if($request->refer_code!=null){
        $request->validate([
            'refer_code' => 'required|exists:users,agent_access_code',
            'agent_id' =>'required'
        ]);
    }

    $role_id=3;
    $prefix = 'LS';
    $length = 6;
    $isUnique = false;
    $numericPart = 100001;
    while (!$isUnique) {
    $uniqid = $prefix . str_pad($numericPart, $length - strlen($prefix), '0', STR_PAD_LEFT);
    $existingUser = User::where('new_id', $uniqid)->first();

        if (!$existingUser) {
            $isUnique = true;
        } else {
            $numericPart++;
        }
    }
    
    $agent_access_code = Str::random(10);
    $agent_id = $request->agent_id;
    $user_name = $request->user_name;
    $phone = $request->phone;
    $email = $request->email;
    $pincode = $request->pincode;
    $bank_name = $request->bank_name;
    $bank_account_number = $request->bank_account_number;
    $ifsc_code = $request->ifsc_code;
    $password = $request->password;

    $user = new User();
    $user->new_id = $uniqid;
    $user->agent_access_code =  $agent_access_code;
    $user->name=$user_name;
    $user->role_id=$role_id;
    $user->email=$email;
    $user->contact_number=$phone;
    $user->pincode=$pincode;
    if($agent_id==null){
        $user->refered_id = Auth::user()->id;
        }
        else{
            $user->refered_id = $agent_id;
        }
    $user->password=Hash::make($password);

    if($request->aadhar_front!=null){
        $front = $request->aadhar_front;
        $path = $front->store('aadhar-front');
        // $bankdetail->aadhar_front=$path;
        $user->aadhar_front=$path;
     } 
    if($request->aadhar_back!=null){
        $aadhar_back = $request->aadhar_back;
        $path = $aadhar_back->store('aadhar-back');
        // $bankdetail->aadhar_back=$path;
        $user->aadhar_back=$path;
    }
    if($request->pan_card!=null){
        $pan_card = $request->pan_card;
        $path = $pan_card->store('pan_image');
        // $bankdetail->pan_card=$path;
        $user->pan_card=$path;
    } 
    if($request->kyc_video!=null){
        $video_kyc = $request->kyc_video;
        $path = $video_kyc->store('kyc-video');
        // $bankdetail->aadhar_back=$path;
        $user->video_kyc=$path;
    }
    $user->save();
    // dd($user);die;
    $bankcheck = BankDetail::find($user->id);
    if($bankcheck==null){
    $bankdetail =new BankDetail();
    $bankdetail->user_id = $user->id;
    $bankdetail->bank_name = $bank_name;
    $bankdetail->holder_name = $user_name;
    $bankdetail->ifsc_code = $ifsc_code;
    $bankdetail->bank_account_number = $bank_account_number;
    $bankdetail->save();
    }
    $subagent = new Subagent();
    if($agent_id==null){
    $subagent->agent_id = Auth::user()->id;
    }
    else{
        $subagent->agent_id = $agent_id;
    }
    $subagent->new_subagent_id = $user->id;
    $subagent->save();
    $this->sendSMS($user->contact_number, "Registered Successfully");

    $mailData = [
        'title' => 'Mail from Loan Sarovar',
        'body' => $user->name,
        'type'=> 'congrats',
        'content' => 'You registration is done successfully. Your KYC approval is under process please wait for the approval and the next process. Thank you Team Loan Sarovar.',
        

    ];
    Mail::to($user->email)->send(new MailNotify($mailData));
    if(Auth::user()){
        $mailData = [
            'title' => 'Mail from Loan Sarovar',
            'body' => Auth::user()->name,
            'type'=> 'congrats',
            'content' => 'A new Sub Agent named as '.$user->name.' Registered successfully',
            

        ];
        // Mail::to(Auth::user()->email)->send(new MailNotify($mailData));
        Mail::to('nisargnavale@gmail.com')->send(new MailNotify($mailData));

    }
    $request->session()->put('success',"Registrated Successfully!!");
    // return view('subagent.add');
    return redirect('admin/dashboard');
   }
   public function getAllsubagent(){
    return view('subagent.all');
   }
   public function getAllDatasubagent(){
    if(Auth::user()->role_id ==1){
        // Subagent::where('agent_id',145)->delete();
         $subagents = Subagent::with('subagent')->with('subagent_qr')->get();
         // dd($subagents);
    }
    if(Auth::user()->role_id ==2){
        $subagents = Subagent::where('agent_id', Auth::user()->id)->with('subagent')->with('subagent_qr')->get();
   }
    return DataTables::of($subagents)->make(true);
   }
   public function getEditsubagent(Request $request){
    //use agent approve kyc page.
        $id = $request->id;
        $agent = Subagent::where('new_subagent_id', $id)->with('subagent')->first();
        $agent_bank = BankDetail::where('user_id',$id)->first();
        // dd($agent);
    return view('subagent.details')->with('agent',$agent)->with('agent_bank',$agent_bank);
   }
   public function postEditsubagent(Request $request){
    $id = $request->id;
    $request->validate([
        'user_name' => 'required', 
        'email' => [
            'required',
            Rule::unique('users', 'email')->ignore($id),
        ],      
        'phone' => [
            'required',
            Rule::unique('users', 'contact_number')->ignore($id),
            'digits:10',
        ],  
        'pincode' => 'required',
       
        'bank_name' => 'required',
        'bank_account_number' => 'required',
        'ifsc_code' => 'required',
        // 'refered_code' => 'required', 
           
    ]);
    $user_name = $request->user_name;
    $phone = $request->phone;
    $email = $request->email;
    $pincode = $request->pincode;
    $bank_name = $request->bank_name;
    $bank_account_number = $request->bank_account_number;
    $ifsc_code = $request->ifsc_code;
    $password = $request->password;
    $user = User::find($id);
    $agent_bank = BankDetail::where('user_id',$id)->first();
    if(isset($request['save'])){
        // dd($request->all(), $user, BankDetail::where('user_id',$id)->first(),$id);die;
        $user->name=$user_name;
        $user->email=$email;
        $user->contact_number=$phone;
        $user->pincode=$pincode;
        if(Auth::user()->role_id =1){
            if($request->aadhar_front!=null){
                $front = $request->aadhar_front;
                $path = $front->store('aadhar-front');
                // $bankdetail->aadhar_front=$path;
                $user->aadhar_front=$path;
            } 
            if($request->aadhar_back!=null){
                $aadhar_back = $request->aadhar_back;
                $path = $aadhar_back->store('aadhar-back');
                // $bankdetail->aadhar_back=$path;
                $user->aadhar_back=$path;
            }
            if($request->pan_card!=null){
                $pan_card = $request->pan_card;
                $path = $pan_card->store('pan_image');
                // $bankdetail->pan_card=$path;
                $user->pan_card=$path;
            } 
            // if($request->kyc_video!=null){
            //     $video_kyc = $request->kyc_video;
            //     $path = $video_kyc->store('kyc-video');
            //     // $bankdetail->aadhar_back=$path;
            //     $user->video_kyc=$path;
            // }
        }
        $user->save();
        if(Auth::user()->role_id = 1){
            $bankdetail = BankDetail::where('user_id',$id)->first();
            if($bankdetail==null){
                $bankdetailnew = new BankDetail();
                $bankdetailnew->user_id = $id;
                $bankdetailnew->bank_name = $bank_name;
                $bankdetailnew->holder_name = $user_name;
                $bankdetailnew->ifsc_code = $ifsc_code;
                $bankdetailnew->bank_account_number = $bank_account_number;
                $bankdetailnew->save();
            } else{
                $bankdetail->bank_name = $bank_name;
                $bankdetail->holder_name = $user_name;
                $bankdetail->ifsc_code = $ifsc_code;
                $bankdetail->bank_account_number = $bank_account_number;
                $bankdetail->save();
            }
           

        }
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
        $data = User::where('id',$id)->first();
            // dd($data);die;
            if(AgentQr::where('agent_id', $data->id)->first()==null){
                //$qrcode = QrCode::size(250)->generate('https://agent.bharatnidhi.com/admin/direct-services?access_code='.$data->agent_access_code);
                $qrcode = QrCode::size(250)->generate('https://partner.loansarovar.com/admin/direct-services?access_code='.$data->agent_access_code);
                $agentqr = new AgentQr();
                $agentqr->agent_id = $data->id;
                $agentqr->qr_code = htmlentities($qrcode);
                $agentqr->save();
            }
        if($agent_bank!=null){
            
            $user->kyc_status = 1;
            $user->save();
            $this->sendSMS($user->contact_number, "KYC Approved");
            $mailData = [
                'type' => 'congrats',
                'title' => 'Mail from Loan Sarovar',
                'body' => $user->name,
                'content' => "Your Request for KYC is Approved. Thanks for Connecting with Loan Sarovar."
            ];
             
            Mail::to($user->email)->send(new MailNotify($mailData));
        
        }
    }
    $request->session()->put('success',"Sub-agent details Updated Successfully!!");
    return redirect('admin/sub-agent/all');
   }
   
   private function sendSMS($mobile, $status)
    {
        $apiKey = "7b70ba79-fdd8-11f0-a6b2-0200cd936042";
    
        $message = "Dear Customer, your application is {$status}. -Sarvodaya Solutions Private Limited";
    
        $response = \Illuminate\Support\Facades\Http::asForm()->post(
            "https://2factor.in/API/R1/",
            [
                'module' => 'TRANS_SMS',
                'apikey' => $apiKey,
                'to' => '91' . $mobile,
                'from' => 'SRVDSP',
                'msg' => $message,
                'ctid' => '1107177132397312328',
            ]
        );
    
        \Log::info('Subagent SMS Response: ' . $response->body());
    }

}
