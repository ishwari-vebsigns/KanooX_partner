<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Walletreason;

class WalletreasonController extends Controller
{
    public function getAddreason(){
        return view('reason.add');
    }
    public function postAddreason(Request $request){
        // dd($request->all());
        $request->validate([
			'reason_name' => 'unique:walletreasons,reason_name',    
			'amount' => 'required',    
		 ]);
         $reason_name = $request->reason_name;
         $amount = $request->amount;
        
         $walletreason = new Walletreason();
         $walletreason->reason_name = $reason_name;
         $walletreason->amount = $amount;
         $walletreason->status_id = 1;
         $walletreason->save();
         $request->session()->put('success',"Wallet Reason Added Successfully!!");
         return redirect('admin/walletreason/all');

    }
    public function getAllreason(){
        $walletreasons = Walletreason::all();
        return view('reason.all')->with('walletreasons',$walletreasons);
    }
    
    public function getEditreason(Request $request){
    $id = $request->id;
    // dd($id);
    $reason = Walletreason::where('reason_id',$id)->first();
    return view('reason.details')->with('reason',$reason);
    }
    public function postEditreason(Request $request){
        $id = $request->id;
        // dd($id);
        $reason_name = $request->reason_name;
        $amount = $request->amount;
        // $request->validate([
		// 	'reason_name' => 'unique:walletreasons,reason_name',    
		// 	'amount' => 'required',    
		//  ]);
        $reason = Walletreason::where('reason_id',$id)->first();
        if(isset($request['save'])){
            $reason->reason_name = $reason_name;
            $reason->amount = $amount;
            $reason->save();
            $request->session()->put('success',"Wallet Reason Updated Successfully!!");
        }
        if(isset($request['active'])){
            $reason->status_id = 1;
            $reason->save();
            $request->session()->put('success',"Wallet Reason Activated Successfully!!");
        }
        if(isset($request['inactive'])){
            $reason->status_id = 0;
            $reason->save();
            $request->session()->put('success',"Wallet Reason Inactivated Successfully!!");
        }
        return redirect('admin/walletreason/all');
    }
}
