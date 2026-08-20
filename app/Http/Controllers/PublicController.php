<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
Use Hash;
use App\Models\Userloan;
use App\Models\Loan;
use App\Models\Bank;
use App\Models\BankSubservice;




use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function getHomePage(){
        // dd("nisarg");
        return redirect('/login');
    }
    public function getbankid(Request $request){
        // dd($request->bank_id);
        $user_selected_bank = $request->bank_id;
        $request->session()->put('user_selected_bank', $user_selected_bank);
    }
    public function getLogout(Request $request){
		
		Auth::logout();
		return redirect('login');

	}
    public function postselect1(Request $request){
       $service_id = $request->service_id;
        $data1 = BankSubservice::where('sub_service_id',$service_id)->with('bank')->get();
        // $data1 = Bank::where('is_active',1)->where('sub_service_id',$service_id)->get();
        // dd($data1);
        // $this->data['data']=$data1;
            $this->response['data']=$data1;
            return $this->response; 
    }	
	public function getuser(Request $request){

        return view('register-user');
    }
    public function postAdduser(Request $request){
        // dd($request->all());
        $role_id=3;

        $name=$request->name;
        $email=$request->email;
        $phone_number=$request->phone_number;
        $password=$request->password;

        $user = new User();

        $user->name=$name;
        $user->role_id=$role_id;
        $user->email=$email;
        $user->phone_no=$phone_number;
        $user->password=Hash::make($password);
        $user->save();
        
        return Redirect('/login');
    }
    public function getloans(){

        $loans = Loan::all();
        return view('index')->with('loans', $loans);
    }
}
