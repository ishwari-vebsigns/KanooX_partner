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
use App\Exports\ExportCommission;
use Maatwebsite\Excel\Facades\Excel;
use Config;
class CommissionController extends Controller
{
    public function getEditCommission(Request $request){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_DETAILS'))){
			return view('admin.unauthorized');
		}
        $commission_id = $request->id;
        $check_commission = Commission::where('commission_id',$commission_id)->first();
        // dd($check_commission);
        $banks = Bank::where('is_active',1)->get();
        $services = Service::where('is_main_service',0)->get();
        return view('commission.details')->with('check_commission', $check_commission)->with('services', $services)->with('banks', $banks);
    }
    public function postEditCommission(Request $request){
        // dd($request->all(),$request->id);
        $commission_id = $request->id;
        $bank_id = $request->bank_id;
        $sub_service_id = $request->sub_service_id;
        $percent = $request->commission;

        if(isset($request['save'])){
        $commission = Commission::where('commission_id',$commission_id)->first();
        $commission->bank_id = $bank_id;
        $commission->sub_service_id = $sub_service_id;
        $commission->percent = $percent;
        $commission->save();
        // dd($commission);
        $request->session()->put('success',"Commission Updated Successfully!!");
        }
        if(isset($request['active'])){
        $commission = Commission::where('commission_id',$commission_id)->first();
        $commission->status_id = 1;
        $commission->save();
        $request->session()->put('success',"Commission Status Activated Successfully!!");
        // return redirect('admin/commission/all');
        }
        if(isset($request['inactive'])){
        $commission = Commission::where('commission_id',$commission_id)->first();
        // dd($commission);
        $commission->status_id = 0;
        $commission->save();
        $request->session()->put('success',"Commission Status In-activated Successfully!!");
        }
        return redirect('admin/commission/all');
        
        
    }
    public function getAllCommission(){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_ALL'))){
			return view('admin.unauthorized');
		}
        $commissions = Commission::with('bank')->with('sub_service')->get();
        // dd($commissions);
        return view('commission.all')->with('commissions', $commissions);
    }
    public function getAllCommissiondata(){
        if(!$this->checkPermission(Config::get('permissions.COMMISSION_ALL'))){
			return view('admin.unauthorized');
		}
        $commissions = Commission::with('bank')->with('sub_service')->get();
        // dd($commissions);
        return DataTables::of($commissions)->make(true);
    }
    public function exportCommission(Request $request){
        return Excel::download(new ExportCommission, 'Commissions.xlsx'); 

    }
    
   public function getAddCommission(){
    if(!$this->checkPermission(Config::get('permissions.COMMISSION_ADD'))){
        return view('admin.unauthorized');
    }
    $banks = Bank::where('is_active',1)->get();
    $services = Service::where('is_main_service',0)->get();
    return view('commission.add')->with('services', $services)->with('banks', $banks);

   }
   public function postAddCommission(Request $request){
    $validatedData = $request->validate([
        'bank_id' => 'required',
        'sub_service_id' => 'required',
        'commission' => 'required',
    ]);

    $count = Commission::where('bank_id', $validatedData['bank_id'])
        ->where('sub_service_id', $validatedData['sub_service_id'])
        ->count();

    if ($count > 0) {
        // Combination already exists, handle the validation error
        $errorMessage = 'The combination of sub service, bank already exists.';
        return redirect()->back()->withErrors([$errorMessage])->withInput();
    }

    $bank_id = $request->bank_id;
    $sub_service_id = $request->sub_service_id;
    $percent = $request->commission;
    // dd($request->all(), Commission::all());
    
    $commission = new Commission();
    $commission->bank_id = $bank_id;
    $commission->sub_service_id = $sub_service_id;
    $commission->percent = $percent;
    $commission->status_id = 1;
    $commission->save();

    $request->session()->put('success',"Commission Added Successfully!!");
    return redirect('admin/commission/all');



    
   }
}
