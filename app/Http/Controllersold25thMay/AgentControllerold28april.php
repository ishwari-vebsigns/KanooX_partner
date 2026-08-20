<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\BankDetail;
Use Hash;
use Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AgentController extends Controller
{
    
    public function agentprofile(){
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

		 ]);

        $id = Auth::user()->id;
        $name = $request->name;
        $account_number = $request->account_number;
        $phone_number = $request->phone_number;
        $email = $request->email;
        $pincode = $request->pincode;
        $ifsc = $request->ifsc;
        $bank_name = $request->bank_name;
        $kyc_status=1;

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
        // dd($request->all());
        $role_id=2;
        $prefix = "BM";
        $uniqid = IdGenerator::generate(['table' => 'users','field'=>'new_id', 'length' => 8, 'prefix' => $prefix]);;
        $agent_access_code = Str::random(10);
        // dd($agent_access_id);
        $name=$request->name;
        $email=$request->email;
        $phone_number=$request->phone_number;
        $pincode=$request->pincode;
        $password=$request->password;
        $refered_id=$request->refered_id;
        $refered_code=$request->refered_code;

        $user = new User();
        $user->new_id = $uniqid;
        $user->agent_access_code =  $agent_access_code;
        $user->name=$name;
        $user->role_id=$role_id;
        $user->email=$email;
        $user->contact_number=$phone_number;
        $user->pincode=$pincode;
        $user->password=Hash::make($password);
        if($request->refered_id!=""){
            $user->refered_id=$refered_id;
        }
        if($request->refered_code!=""){
        $user->refered_code=$refered_code;
        }
        $user->save();

        $id=$user->id;
        
        return Redirect('/agent-otp/'.$id);
    }

    public function getagentotp(Request $request){
        $id=$request->id;
        $otp = rand(1000, 9999);
        $user=User::where('id', $id)->first();
        
        $user->otp = $otp;
        $user->save(); 
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
        // dd($request->id);
        $id = $request->id;

        return view('agent-kyc')->with('id',$id);
    }
    public function postagentkyc(Request $request){
        $id = $request->id;
        $bank = $request->bank_name;
        $name = $request->name;
        $ifsc = $request->ifsc_code;
        $account_number = $request->account_number;
        $kyc_status=1;
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
        
        if(Input::hasFile('front')){
			$front = $request->front;
			$path = $front->store('aadhar-front');
			// $bankdetail->aadhar_front=$path;
            $user->aadhar_front=$path;
		 } 
        if(Input::hasFile('back')){
			$aadhar_back = $request->back;
			$path = $aadhar_back->store('aadhar-back');
			// $bankdetail->aadhar_back=$path;
            $user->aadhar_back=$path;
		}
        if(Input::hasFile('pan')){
			$pan_card = $request->pan;
			$path = $pan_card->store('pan_image');
			// $bankdetail->pan_card=$path;
            $user->pan_card=$path;
		} 
        // dd($bankdetail);die;
        $bankdetail->save();
        $user->save();
        // dd($user);die;
        return redirect('/login');
    }
}
