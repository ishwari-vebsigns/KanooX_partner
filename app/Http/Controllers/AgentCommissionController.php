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
use App\Models\Commission;
use App\Models\Branch;
use App\Models\WalletTransaction;
use App\Models\Agentcommission;
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
use App\Models\Role;
use App\Models\Loansignin;
use App\Exports\ExportCommission;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use Illuminate\Support\Facades\Schema;

class AgentCommissionController extends Controller
{
    public function getAllagentCommission(Request $request){

        return view('agentcommission.all');
    }
    public function getAllagentCommissiondata(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_ALL'))){
            return view('admin.unauthorized');
        }
        $commissions = Agentcommission::with('bank')->with('sub_service')->with('agent')->get();
        // dd($commissions);
        return DataTables::of($commissions)->make(true);

    }
    public function getAddagentCommission(){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_ADD'))){
            return view('admin.unauthorized');
        }
        $roles = Role::whereIn('role_id', [2, 3])->get();
        $banks = Bank::where('is_active',1)->get();
        $services = Service::where('is_main_service',0)->get();
        return view('agentcommission.add')->with('services', $services)->with('banks', $banks)->with('roles', $roles);
        
    }
    public function postAddagentCommission(Request $request){
        $validatedData = $request->validate([
            'bank_id' => 'required',
            'sub_service_id' => 'required',
            'commission' => 'required',
            'role_id' =>'required'
        ]);
        $count = Agentcommission::where('bank_id', $validatedData['bank_id'])
        ->where('sub_service_id', $validatedData['sub_service_id'])
        ->where('role_id', $validatedData['role_id'])
        ->count();
        // dd($count);die;
    if ($count > 0) {
        // Combination already exists, handle the validation error
        $errorMessage = 'The combination of sub service, bank and role already exists.';
        return redirect()->back()->withErrors([$errorMessage])->withInput();
    }
        $bank_id = $request->bank_id;
        $sub_service_id = $request->sub_service_id;
        $percent = $request->commission;
        $role_id = $request->role_id;

        $agentcommission = new Agentcommission();
        $agentcommission->bank_id = $bank_id;
        $agentcommission->sub_service_id = $sub_service_id;
        $agentcommission->commission = $percent;
        $agentcommission->status_id = 1;
        $agentcommission->role_id = $role_id;
        $agentcommission->save();

        $request->session()->put('success',"Agent Commission Added Successfully!!");
        return redirect('admin/agent-commission/all');


    }
    public function getEditagentCommission(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_DETAILS'))){
            return view('admin.unauthorized');
        }
        $commission_id = $request->id;
        $check_commission = Agentcommission::where('agent_commission_id',$commission_id)->first();
        // dd($check_commission);
        $roles = Role::whereIn('role_id', [2, 3])->get();
        $banks = Bank::where('is_active',1)->get();
        $services = Service::where('is_main_service',0)->get();
        return view('agentcommission.details')->with('check_commission', $check_commission)->with('services', $services)->with('banks', $banks)->with('roles', $roles);
    }
    public function postEditagentCommission(Request $request){
        $validatedData = $request->validate([
            'bank_id' => 'required',
            'sub_service_id' => 'required',
            'commission' => 'required',
            'role_id' =>'required'
        ]);
        
        $commission_id = $request->id;
        $bank_id = $request->bank_id;
        $sub_service_id = $request->sub_service_id;
        $percent = $request->commission;
        $role_id = $request->role_id;
        $count = Agentcommission::where('bank_id', $validatedData['bank_id'])
        ->where('sub_service_id', $validatedData['sub_service_id'])
        ->where('role_id', $validatedData['role_id'])
        ->where('agent_commission_id', '!=', $commission_id)
        ->count();
        if ($count > 0) {
            // Combination already exists, handle the validation error
            $errorMessage = 'The combination of sub service, bank and role already exists.';
            return redirect()->back()->withErrors([$errorMessage])->withInput();
        }
        $commission = Agentcommission::find($commission_id);
        // dd(Schema::getColumnListing('agentcommissions'));
        if(isset($request['save'])){
            $commission->bank_id = $bank_id;
            $commission->sub_service_id = $sub_service_id;
            $commission->commission = $percent;
            $commission->role_id = $role_id;
            $commission->save();
            // dd($commission);
            $request->session()->put('success',"Agent Commission Updated Successfully!!");
            }
            if(isset($request['active'])){
            $commission->status_id = 1;
            $commission->save();
            $request->session()->put('success',"Agent Commission Status Activated Successfully!!");
            // return redirect('admin/commission/all');
            }
            if(isset($request['inactive'])){

            $commission->status_id = 0;
            // dd($commission);
            $commission->save();
            // dd($commission->save());
            $request->session()->put('success',"Agent Commission Status In-activated Successfully!!");
            }
            return redirect('admin/agent-commission/all');
                
    }

}
