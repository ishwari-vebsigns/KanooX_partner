<?php

namespace App\Http\Controllers;
use App\Models\Userloan;
use Illuminate\Http\Request;
use Auth;
use App\Models\Loan;
class LoanController extends Controller
{
    public function getHomeLoan(Request $request){
        $url = $request->url;
        $get_loan_names = Loan::where('url',$url)->get();
        foreach($get_loan_names as $get_loan_name){
            $loan_name = $get_loan_name->loan_name;
        }
        return view('home-loan')->with('loan_name', $loan_name)->with('url', $url);
    }
    public function postHomeLoan(Request $request){
        $url = $request->url;
        // dd($url);
        $get_loan_ids = Loan::where('url',$url)->get();
        foreach($get_loan_ids as $get_loan_id){
            $loan_id = $get_loan_id->loan_id;
        }
        
        // $loan_id=1;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }

    public function getPersonalLoan(){
        
        return view('personal-loan');
    }
    public function postPersonalLoan(Request $request){
        // dd($request->all());
        $loan_id=2;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }

    public function getVehicleLoan(){
        
        return view('vehicle-loan');
    }
    public function postVehicleLoan(Request $request){
        // dd($request->all());
        $loan_id=3;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }

    public function getEducationLoan(){
        
        return view('education-loan');
    }
    public function postEducationLoan(Request $request){
        // dd($request->all());
        $loan_id=5;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }

    public function getBusinessLoan(){
        
        return view('business-loan');
    }
    public function postBusinessLoan(Request $request){
        // dd($request->all());
        $loan_id=4;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }

    public function getGoldLoan(){
        
        return view('gold-loan');
    }
    public function postGoldLoan(Request $request){
        // dd($request->all());
        $loan_id=6;
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $state = $request->state;
        $city = $request->city;

        $userloan = new Userloan();
        $userloan->loan_id = $loan_id;
        $userloan->user_name = $name;
        $userloan->email = $email;
        $userloan->phone_no = $phone_number;
        $userloan->state = $state;
        $userloan->city = $city;
        $userloan->save();

        return redirect('/');
        
        
        
    }
}
