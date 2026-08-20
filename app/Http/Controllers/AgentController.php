<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\Wallet;
Use Hash;
use Auth;
use Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Validator;
use App\Mail\Checkkyc;
use App\Mail\CheckkycMailtoadmin;
use Config;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
class AgentController extends Controller
{
    
    public function agentprofile(){
        if(!$this->checkPermission(Config::get('permissions.PROFILE_SETTING_VIEW'))){
			return view('admin.unauthorized');
		}
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        $bankdetails = BankDetail::where('user_id', $id)->first();
        // dd($user, $bankdetails);
        return view('admin.agent-profile')->with('user',$user)->with('bankdetails', $bankdetails);
    }
    public function updateagentprofile(Request $request){
        // dd($request->all());
         $request->validate([
            'account_number' => 'required',  
            'name' => 'required',       
            'phone_number' => 'required',       
            'email' => 'required|email',       
            'pincode' => 'required|digits:6|integer',       
            'ifsc' => 'required',       
            'bank_name' => 'required', 

            'aadhar_front' => 'required|image|mimes:jpg,png,,pdf|max:1024',
            'aadhar_back' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'pan_card' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'video_kyc' => 'required|mimes:mp4|max:5120', // Accepts MP4 and MOV files, max size of 5MB
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
            'video_kyc.required' => 'The KYC video is required.',
            'video_kyc.mimes' => 'The KYC video must be in MP4 or MOV format.',
            'video_kyc.max' => 'The KYC video must not exceed 5 MB.',
        ]);

        $id = Auth::user()->id;
        $name = $request->name;
        $account_number = $request->account_number;
        $phone_number = $request->phone_number;
        $email = $request->email;
        $pincode = $request->pincode;
        $ifsc = $request->ifsc;
        $bank_name = $request->bank_name;
        $kyc_status=0;

        $user = User::find($id);
        $user->name = $name;
        $user->contact_number = $phone_number;
        $user->email = $email;
        $user->pincode = $pincode;
        //  dd($id);
         
        if(Bankdetail::where('user_id',$id)->first()!=null){
            $bankdetails = Bankdetail::where('user_id',$id)->first();
            $bankdetails->holder_name = $name;
        }
        else{
            $bankdetails = new Bankdetail();
            $bankdetails->user_id = $id;
            $bankdetails->holder_name = $name;
        }
        // dd($bankdetails);
        $bankdetails->ifsc_code = $ifsc;
        $bankdetails->bank_name = $bank_name;
        $bankdetails->bank_account_number = $account_number;
        $bankdetails->save();

        if($request->aadhar_front!=""){
            $aadhar_front = $request->aadhar_front;
            $path = $aadhar_front->store('aadhar_front');
            $user->aadhar_front=$path;
        }
        if($request->aadhar_back!=""){
            $aadhar_back = $request->aadhar_back;
            $path = $aadhar_back->store('aadhar_back');
            $user->aadhar_back=$path;
        }
        if($request->pan_card!=""){
            $pan_card = $request->pan_card;
            $path = $pan_card->store('pan_image');
            $user->pan_card=$path;
        }
        if($request->video_kyc!=""){
            $pan_card = $request->video_kyc;
            $path = $pan_card->store('kyc-video');
            $user->video_kyc=$path;
        }
        if($request->aadhar_front!="" && $request->aadhar_back!="" && $request->pan_card!=""){
            $user->kyc_status = $kyc_status;
        }
        $user->save();
        // dd($user);
        $request->session()->put('success',"Profile Updated Successfully!!");
        return redirect('admin/agent-profile');
        
    }
    public function commissionstructure(){
		return view('admin.commission-structure');
	}
    public function getagent(Request $request){
        $agent_access_code = Str::random(10);
        // dd($agent_access_code);
        return view('register-agent');
    }
    public function postAddagent(Request $request){
        // dd($request->all(), Wallet::all());
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
  
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ], $messages);
  
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required|digits:10|unique:users,contact_number',
            'pincode' => 'required|min:6',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required',
        ]);
    if($request->refered_code!=""){
        $request->validate([
            'refered_code' => 'required',   
	    ]);
    }
        $role_id=2;
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
        // dd($agent_access_id);
        $name=$request->name;
        $email=$request->email;
        $phone_number=$request->phone_number;
        $pincode=$request->pincode;
        $password=$request->password;
        $refered_id=$request->refered_id;
        $refered_code=$request->refered_code;
     
        $today = new DateTime();
        $nextYear = $today->modify('+1 year');
        $nextYearString = $nextYear->format('Y-m-d');
        
        if($refered_code!=null){
            $findagent = User::where('agent_access_code',$refered_code)->first();
            // dd($findagent);
            if($findagent!=null){
                $findagentwallet = Wallet::where('agent_id',$findagent->agent_id)->first();
                if($findagent->kyc_status==1){
                    if($findagentwallet==null){
                        $wallet = new Wallet();
                        $wallet->agent_id = $findagent->id;
                        $wallet->wallet_amount = 100;
                        $wallet->amount_expiry = $nextYearString;
                        $wallet->wallet_reason = 1;
                        $wallet->save();
                    }
                }
            }
        }
        // dd($nextYearString);die;
         $otp = rand(1000, 9999);
        $client = new Client();

        $user = new User();
        $user->new_id = $uniqid;
        $user->agent_access_code =  $agent_access_code;
        $user->name=$name;
        $user->role_id=$role_id;
        $user->email=$email;
        $user->contact_number=$phone_number;
        $user->pincode=$pincode;
        $user->otp=$otp;
        $user->password=Hash::make($password);
        if($request->refered_id!="" && $findagent!=null){
            $user->refered_id=$refered_id;
        }
        if($request->refered_code!="" && $findagent!=null){
        $user->refered_code=$refered_code;
        }
        $user->save();
        $message = 'Hello, your OTP is ' . $user->otp . '. Please use this code to verify your account.';

                        $apiUrl = "https://2factor.in/API/V1/7b70ba79-fdd8-11f0-a6b2-0200cd936042/SMS/{$user->contact_number}/{$user->otp}/LoanSarovar?otp_expiry=10&otp_length=4&message={$message}";
                try {
                    $response = $client->post($apiUrl)->getBody();
                    
                    // Handle the response as needed
                    // $response contains the API response from the SMS service
                    // echo "SMS sent successfully!";
                } catch (\Exception $e) {
                    // Handle the exception, e.g., log the error or display an error message
                    echo "Failed to send SMS: " . $e->getMessage();
                }
        // dd($user);
        $id=$user->id;
        $user_check= User::where('id',$id)->first();
        // dd($user, $user_check->kyc_status);

        if($user_check->kyc_status==0){
            $mailData = [
                'title' => 'Mail from Loan Sarovar',
                'body' => $user->name
            ];
            $mailDataAdmin = [
                'title' => 'Mail from Loan Sarovar',
                'body' => $user->name
            ];
            Mail::to($user->email)->send(new Checkkyc($mailData));
            Mail::to('loansarover@gmail.com')->send(new CheckkycMailtoadmin($mailDataAdmin));

        }

        
      
        
        return Redirect('/agent-otp/'.$id);
    }
public function resentOtp(Request $request){
        $user_id=$request->user_id;
        $otp = rand(1000, 9999); // Generate a new OTP
        $user=User::where('id', $user_id)->first();
        $user->otp = $otp;
        $user->save();

        $apiKey = '7b70ba79-fdd8-11f0-a6b2-0200cd936042'; // Replace with your actual API key
        $phoneNumber = $user->contact_number; // Replace with the recipient's phone number
        $otpValue = $user->otp; // Replace with the OTP value you want to send
        $otpTemplateName = 'LoanSarovar'; // Replace with the OTP template name if needed
        $message = 'Hello, your OTP is ' . $user->otp . '. Please use this code to verify your account. Team LoanSarovar';
        $apiUrl = "https://2factor.in/API/V1/$apiKey/SMS/$phoneNumber/$otpValue/$otpTemplateName";
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
                    dd($e->getMessage());

                }
                
        return redirect()->back()->with('success', 'OTP resent successfully.');
    }
    public function getagentotp(Request $request){
        $id=$request->id;
      
        $user=User::where('id', $id)->first();
        
       
        // dd($otp, $user->otp);
        return view('agent-otp')->with('user', $user);
    }
    public function postagentotp(Request $request){
        $user_otp = $request->otp;
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        // dd($user->otp, $user_otp);
        if($user->otp==$user_otp){
            return redirect('/agent-kyc/'.$user_id);
        }
        else{
            
            $request->session()->put('error',"OTP not Match....");
            return redirect('/agent-otp/'.$user_id);
        }
    }
    public function getagentkyc(Request $request){
        $id = $request->id;
        $user_kyc_check = User::where('id',$id)->first();
        // dd($user_kyc_check);
        if($user_kyc_check->kyc_status==1){
            return redirect('/login');
        }
        return view('agent-kyc')->with('id',$id);
    }
    public function postagentkyc(Request $request){

          $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'bank_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'ifsc_code' => 'required',
            'privacy' => 'required|accepted',
            'account_number' =>  'required|numeric',
            'front' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'back' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'pan' => 'required|image|mimes:jpg,png,pdf|max:1024',
            'kyc_video' => 'required|mimes:mp4|max:5120', // Accepts MP4 and MOV files, max size of 5MB
        ], [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field should only contain alphabetic characters and spaces.',
            'bank_name.required' => 'The name field is required.',
            'bank_name.regex' => 'The bank name field should only contain alphabetic characters and spaces.',
            'ifsc_code.required' => 'The IFSC code is required.',
            'ifsc_code.regex' => 'The IFSC code is invalid. It should follow the format ABCD0123456.',
            'account_number.required' => 'The account number is required.',
            'account_number.regex' => 'The field must be between 1 and 15 digits.',
            'front.required' => 'The front image is required.',
            'front.image' => 'The front image must be an image file.',
            'front.mimes' => 'The front image must be a JPG or PNG.',
            'front.max' => 'The front image must not exceed :max KB.',
            'back.required' => 'The back image is required.',
            'back.image' => 'The back image must be an image file.',
            'back.mimes' => 'The back image must be a JPG or PNG.',
            'back.max' => 'The back image must not exceed :max KB.',
            'pan.required' => 'The PAN image is required.',
            'pan.image' => 'The PAN image must be an image file.',
            'pan.mimes' => 'The PAN image must be a JPG or PNG.',
            'pan.max' => 'The PAN image must not exceed :max KB.',
            'kyc_video.required' => 'The KYC video is required.',
            'kyc_video.mimes' => 'The KYC video must be in MP4 format.',
            'kyc_video.max' => 'The KYC video must not exceed 5 MB.',
            'privacy.required' => 'You Need to accept Privacy Policy.',
        ]);
        // dd($request->all());
        
        $id = $request->id;
        $user_kyc_check = User::where('id',$id)->first();
        // dd($user_kyc_check);
        if($user_kyc_check->kyc_status==1){
            return redirect('/login');
        }
        $user_kyc_check = User::where('id',$id)->first();
        $bank = $request->bank_name;
        $name = $request->name;
        $ifsc = $request->ifsc_code;
        $account_number = $request->account_number;
        $kyc_status=0;
		$front=$request->file('$front');
        //  echo $front;die;
		$aadhar_back = $request->back;
        $pan_card = $request->pan;
        $user = User::find($id);
        $user->kyc_status = $kyc_status;
        $bankdetail =new BankDetail();

        $bankdetail->user_id = $id;
        $bankdetail->bank_name = $bank;
        $bankdetail->holder_name = $name;
        $bankdetail->ifsc_code = $ifsc;
        $bankdetail->bank_account_number = $account_number;
        
        if($request->front!=null){
			$front = $request->front;
			$path = $front->store('aadhar-front');
			// $bankdetail->aadhar_front=$path;
            $user->aadhar_front=$path;
		 } 
        if($request->back!=null){
			$aadhar_back = $request->back;
			$path = $aadhar_back->store('aadhar-back');
			// $bankdetail->aadhar_back=$path;
            $user->aadhar_back=$path;
		}
        if($request->pan!=null){
			$pan_card = $request->pan;
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
        // dd($bankdetail);die;
        $bankdetail->save();
        $user->save();
        // dd($user);die;
        $mailData = [
            'title' => 'Mail from Loan Sarovar',
            'body' => $user->name
        ];
       
        Mail::to($user->email)->send(new Checkkyc($mailData));
        $request->session()->put('success',"Registered Successfully!!");

        return redirect('/login');
    }
}
