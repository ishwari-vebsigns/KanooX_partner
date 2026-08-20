<?php

namespace App\Http\Controllers;

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
use Hash;
use App\Models\LoanDocuments;
use App\Models\Contact;
use App\Models\ReferalTools;
use App\Models\PropertyLead;
use App\Models\Comment;
use App\Models\Status;
use App\Models\Service;
use App\Models\SanctionCalculator;
use App\Models\ServicesHierarchy;
use App\Models\Invoice;
use App\Models\Loansignin;
use App\Models\Training;
use App\Models\Wallet;
use Illuminate\Support\Str;
use App\Mail\LoanMail;
use App\Mail\MailNotify;
use App\Exports\ExportService;
use App\Exports\ExportSubservice;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use App\Models\AgentQr;
use PDF;
use Dompdf\Dompdf;
use Spatie\Browsershot\Browsershot;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
	public function getallcustomers(Request $request){
		if(!$this->checkPermission(Config::get('permissions.CUSTOMER_ALL'))){
			return view('admin.unauthorized');
		}
		$dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		if($dateRange!=null){
		$startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
		$endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
		}else{
			$startDate = Carbon::today()->format('Y-m-d');
			$endDate = Carbon::today()->subMonth()->format('Y-m-d');
		}
		// dd($startDate,$endDate);
		$services =  Service::where('is_main_service',1)->where('status_id',1)->get();
		// dd($startDate,$endDate, $services);

		$id = Auth::user()->id;
		if(Auth::user()->role_id==1){
			$customers = Loan::with('agent')->whereDate('created_at', '>=', $startDate)
			->whereDate('created_at', '<=', $endDate)
			->get();
		}
		if(Auth::user()->role_id==2){
			$customers = Loan::where('agent_id',$id)->with('agent')->whereBetween('created_at', [$startDate, $endDate])->get();
		}
		// dd($customers, $startDate, $endDate);
		return view('admin.all-customer')->with('services', $services)->with('customers', $customers)->with('startDate', $startDate)->with('endDate', $endDate);
	}
	public function getallcustomersalldata(Request $request){
		if(!$this->checkPermission(Config::get('permissions.CUSTOMER_ALL'))){
			return view('admin.unauthorized');
		}
		$dateRange = $request->daterange;

		$dates = explode(' - ', $dateRange);
		$startDate = $request["date_from"];
		$endDate = $request["date_to"];
		// dd($startDate,$endDate);
		$services =  Service::where('is_main_service',1)->where('status_id',1)->get();
		// dd($startDate,$endDate, $services);

		$id = Auth::user()->id;
		if(Auth::user()->role_id==1){
			$customers = Loan::with('agent')->whereDate('created_at', '>=', $startDate)
			->whereDate('created_at', '<=', $endDate)
			->get();
		}
		if(Auth::user()->role_id==2){
			$customers = Loan::where('agent_id',$id)->with('agent')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
		}
		// dd($customers, $startDate, $endDate);
		return DataTables::of($customers)->make(true);
	}
	public function gettraining(){
		if(!$this->checkPermission(Config::get('permissions.TRAINING_VIEW'))){
			return view('admin.unauthorized');
		}
		if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
		$trainings = Training::all();
		return view('admin.training')->with('trainings', $trainings);
	}
	public function geteditsubservice(Request $request){
		if(!$this->checkPermission(Config::get('permissions.SERVICE_DETAILS'))){
			return view('admin.unauthorized');
		}
		$id = $request->id;
		$main_services = Service::where('is_main_service',1)->get();
		$services = Service::where('service_id', $id)->first();
		$servicehierarchy = ServicesHierarchy::where('child_service_id', $id)->with('parent_service')->first();
		// dd($servicehierarchy);
		// $parent_service = Service::where('service_id',$services->child_services->parent_service_id)->first();
		return view('sub-services.details')->with('services', $services)->with('main_services', $main_services)->with('servicehierarchy', $servicehierarchy);
	}
	public function posteditsubservice(Request $request){
		$id = $request->id;
		$service_id = $request->service_id;
		if(isset($request['save'])){
			// dd($request->all());
		$service1 = Service::find($service_id);
		$service1->is_parent_service = 1;
		$service1->save();
		$main_service = 0;
		$sub_service = $request->sub_service;
		$service_url=str::slug($request->sub_service_url);
		$description = $request->description;

		// dd($request->all(), $service_url);
		$service = Service::find($id);
		$service->service_name = $sub_service;
		$service->service_url = $service_url;
		$service->is_main_service = $main_service;

		
		$service->save();
		$serviceshierarchy = ServicesHierarchy::where('child_service_id', $id)->first();
		// dd($serviceshierarchy);
		$serviceshierarchy->parent_service_id = $service_id;
		$serviceshierarchy->child_service_id = $service->service_id;
		$serviceshierarchy->sub_service_name = $sub_service;
		$serviceshierarchy->description = $description;
		if($request->sub_service_image!=""){
            $service_image = $request->sub_service_image;
            $path = $service_image->store('sub-service-images');
            $serviceshierarchy->sub_service_image=$path;
        }
		$serviceshierarchy->save();
		$request->session()->put('success',"Sub-Service Updated Successfully!!");
	}
	if(isset($request['active'])){
		$service = Service::find($id);
		$service->status_id = 1;
		$service->save();
		// dd($service);
		$request->session()->put('success',"Service Activated Successfully!!");
		return redirect('admin/sub-services/all');
	}
	if(isset($request['inactive'])){
		$service = Service::find($id);
		$service->status_id = 0;
		$service->save();
		// dd($service);
		$request->session()->put('success',"Service Inactivated Successfully!!");
		return redirect('admin/sub-services/all');

	}
        return redirect('admin/sub-services/edit/'.$id);
		// dd($request->all(), $service, $service1);


	}
	public function getallsubServices(){
		if(!$this->checkPermission(Config::get('permissions.SUBSERVICE_ALL'))){
			return view('admin.unauthorized');
		}
		$services = Service::where('is_main_service',0)->get();
		return view('sub-services.all')->with('services', $services);


	}
	public function exportSubservices(Request $request){
        return Excel::download(new ExportSubservice, 'sub-services.xlsx'); 

	}
	public function getallsubServicesData(){
		$services = Service::where('is_main_service',0)->get();
		return DataTables::of($services)->make(true);
	}
	public function getAddsubservice(){
		if(!$this->checkPermission(Config::get('permissions.SUBSERVICE_ADD'))){
			return view('admin.unauthorized');
		}
		$services = Service::where('is_main_service',1)->get();
		// dd(ServicesHierarchy::all());
		return view('sub-services.add')->with('services', $services);
	}
	public function postAddsubservice(Request $request){
		$request->validate([
			'service_id' => 'required', 
			'sub_service' => 'required|unique:services,service_name',    
			'sub_service_url' => 'required|unique:services,service_url',  
			'description' => 'required', 
			   
	]);
			// dd($request->all());

		$service_id = $request->service_id;
		$service1 = Service::find($service_id);
		$service1->is_parent_service = 1;
		$service1->save();

		// dd();
		$main_service = 0;
		$sub_service = $request->sub_service;
		$service_url=str::slug($request->sub_service_url);
		$description = $request->description;

		$service = new Service();
		$service->service_name = $sub_service;
		$service->service_url = $service_url;
		$service->is_main_service = $main_service;
		$service->save();

		// dd($service->service_name);
		$serviceshierarchy = new ServicesHierarchy();
		$serviceshierarchy->parent_service_id = $service_id;
		$serviceshierarchy->child_service_id = $service->service_id;
		$serviceshierarchy->sub_service_name = $sub_service;
		$serviceshierarchy->description = $description;

		if($request->sub_service_image!=""){
            $service_image = $request->sub_service_image;
            $path = $service_image->store('sub-service-images');
            $serviceshierarchy->sub_service_image=$path;
        }
		$serviceshierarchy->save();
		// dd($request->all(),$serviceshierarchy);

		$request->session()->put('success',"sub-Service added Successfully!!");
        return redirect('admin/sub-services/all');
		
	}
	public function getpostServices(Request $request){
		
		$id = $request->id;
		$service = Service::find($id);
		if(isset($request['save'])){
		$request->validate([
				'service_name' => 'unique:services,service_name',    
				'service_url' => 'unique:services,service_url',    
				   
		]);
		$service_name = $request->service_name;
		$service_url = $request->service_url;
		$service->service_name = $service_name;
		$service->service_url = $service_url;
		$service->save();
		// dd($service);
		$request->session()->put('success',"Service Updated Successfully!!");
		}
		if(isset($request['active'])){
			$service->status_id = 1;
			$service->save();
			$request->session()->put('success',"Service Activated Successfully!!");
			return redirect('admin/service/all');
		}
		if(isset($request['inactive'])){
			$service->status_id = 0;
			$service->save();
			$request->session()->put('success',"Service Inactivated Successfully!!");
			return redirect('admin/service/all');

		}
		return redirect('admin/service/all');
	}
	public function geteditServices(Request $request){
		$id = $request->id;
		$service = Service::find($id);
		// dd($service);
		return view('services.details')->with('service', $service);
	}
	public function getaddServices(){
		if(!$this->checkPermission(Config::get('permissions.SERVICE_ADD'))){
			return view('admin.unauthorized');
		}
		if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
		return view('services.add');
	}
	public function postaddServices(Request $request){
		$request->validate([
			'service_name' => 'unique:services,service_name',    
			'service_url' => 'unique:services,service_url',    
			   
		 ]);
		$main_service = 1;
		$service_name = $request->service_name;
		$service_url=str::slug($request->service_url);
		// dd($request->all(), $service_url);
		$service = new Service();
		$service->service_name = $service_name;
		$service->service_url = $service_url;
		$service->is_main_service = $main_service;
		$service->save();
		$request->session()->put('success',"Service added Successfully!!");
        return redirect('admin/service/all');
		
	}
    public function getALLPropertyLead(){
		return view('admin.property-lead');
	}
	
	public function getOtp(){
		return view('admin.otp');

	}
	public function invoiceadd()
	{
		return view('admin.invoice_add');
	}
	
	
	public function getCards(){
		return view('admin.cards');
	}
	public function getallServices(){
		if(!$this->checkPermission(Config::get('permissions.SERVICE_ALL'))){
			return view('admin.unauthorized');
		}
		$services = Service::where('is_main_service',1)->get();
		// dd($services);
		return view('services.all')->with('services', $services);
	}
	public function exportServices(Request $request){
		return Excel::download(new ExportService, 'services.xlsx');
	}
	public function getallServicesAllData(){
		$services = Service::where('is_main_service',1)->get();
		return DataTables::of($services)->make(true);
	}
	public function getserviceType(Request $request){
		// dd($request->all());
		if(Auth::user()!=null){
		if(!$this->checkPermission(Config::get('permissions.SERVICES'))){
			return view('admin.unauthorized');
		}
		if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
		$service_url = $request->url;
		if($request->url == "Loans"){
			$services = Service::where('service_url', $service_url)->with('child_services')->get();
			// dd($services);

		return view('admin.service-type')->with('services',$services);
		}
		if($request->url == "Insurances"){
			$services = Service::where('service_url', $service_url)->with('child_services')->get();
		return view('admin.insurance')->with('services',$services);
		}
		if($request->url == "cards"){
		return view('admin.cards');
		}
		}else{
			$code = $request->access_code;
			if($code==null){
				return view('admin.unauthorized');
			}
			$findagent = User::where('agent_access_code', $code)->first();
			// dd($findagent);
			$service_url = $request->url;
		if($request->url == "Loans"){
			$services = Service::where('service_url', $service_url)->with('child_services')->get();
			// dd($services);

		return view('admin.service-type')->with('services',$services)->with('code',$code);
		}
		if($request->url == "Insurances"){
			$services = Service::where('service_url', $service_url)->with('child_services')->get();
		return view('admin.insurance')->with('services',$services)->with('code',$code);
		}
		if($request->url == "cards"){
		return view('admin.cards');
		}
		}
		
		// return view('admin.service-type');
	}
	public function getLoan(){
		return view('admin.loan-form');

	}
	
	public function getServices(Request $request)
	{
		// dd($request->all());
		$code = $request->access_code;
		if($code == null){
			return view('admin.unauthorized');
		}
		return view('admin.services')->with('code', $code);
	}
	
	
		public function invoiceedit(Request $request)
	{
	    
	    $id=$request->id;
	    $invoice=Invoice::find($id);
		return view('admin.editinvoice')->with('invoice',$invoice);
	}
	public function invoicesave(Request $request)
	{
	    $content=$request->content;
	    $invoice=new Invoice();
	    $invoice->content=$content;
	     $invoice->biller_name_one=$request->biller_name_one;
	      $invoice->biller_name_two=$request->biller_name_two;
	      $invoice->bank_name=$request->bank_name;
	      $invoice->amount=$request->amount;
	    $invoice->save();
	    
		return $invoice;
	}
	
		public function calculatesave(Request $request)
	{
	   // return $request->all();die;
	    $content=$request->content;
	   
	    $sanction=new SanctionCalculator();
	
		$sanction->name=$request->name;	
		$sanction->dob=$request->dob;	
		$sanction->age=$request->age;
		$sanction->content=$request->content;
	    $sanction->save();
		return $sanction;
	}
	
	public function calculateeditsave(Request $request)
	{
	   // return $request->all();die;
	    $content=$request->content;
	    $sanction_id=$request->sanction_id;
	   
	    $sanction=SanctionCalculator::find($sanction_id);
	
		$sanction->name=$request->name;	
		$sanction->dob=$request->dob;	
		$sanction->age=$request->age;
		$sanction->content=$request->content;
	    $sanction->save();
		return $sanction;
	}
	
	
	
		public function editsave(Request $request)
	{
	    $content=$request->content;
	    $sr_id=$request->sr_id;
	    $invoice=Invoice::find($sr_id);
	    $invoice->content=$content;
	        $invoice->biller_name_one=$request->biller_name_one;
	      $invoice->biller_name_two=$request->biller_name_two;
	      $invoice->bank_name=$request->bank_name;
	      $invoice->amount=$request->amount;
	    $invoice->save();
	    
		return $invoice;
	}
	
	
	  public function invoice(){
		return view('admin.invoice');
	}
	public function invoiceData()
	{
		$invoice=Invoice::get();
		return DataTables::of($invoice)->make(true);
	}
	
		public function getStatusUser(Request $request)
	{
	    
		$id=$request->id;
		
		$user=User::find($id);
		$status=$user->is_active;
		
		if($status==1){
		    $user->is_active=0;
		}else{
		    $user->is_active=1;
		}
		 $user->save();
		return redirect('admin/user/all');
	}
	
	
	
	

	public function getALLPropertyLeadData(Request $request){
		$lead =PropertyLead::with('properties')->orderBy('property_lead_id','desc')->get();
		return DataTables::of($lead)->make(true);
	}
    public function getALLReferalTool(){
		return view('admin.referal-tool');
	}

	public function getALLReferalToolData(Request $request){
		$referal_tool =ReferalTools::with('refer_by')->orderBy('referal_tool_id','desc');
		return DataTables::of($referal_tool)->make(true);
	}
	public function getDashboard(Request $request){
		// Loansignin
		if(!$this->checkPermission(Config::get('permissions.DASHBOARD'))){
			return view('admin.unauthorized');
		}
		if(Auth::user()->kyc_status==0){
			return view('admin.unaccess');
		}
		$user=Auth::user();
     //    if ($user!="") {
     //        $role=$user->role_id;
		if ($user->role_id!=1 && $user->role_id!=2) {
            	// $users=User::where('email',$user->email)->first();
            	//$loan_details=Loan::where('user_id', $user->id)->first();
			return redirect('dashboard');
                // return view('myaccount.my_account_details')->with('loan_details', $loan_details);
		}
		else{	
		    $pie=$request->pie;
		    $bar=$request->bar;
		    
		  //  $seven_days=date('Y-m-d', strtotime('- 7 days'));
		    
		  //  $thirty_days=date('Y-m-d', strtotime('- 30 days'));
		    
		    
		    
			$refer_earn_count =ReferFriend::count();

			$get_started_count =GetStarted::count();
			$apply_now_count =ApplyNow::count();
			$term_insurance_count =TermInsurance::count();
			$health_insurance_count =HealthInsurance::count();
			$loan_count =Loan::count();
			$mutual_fund_count =MutualFund::count();

			$loan_applied_for=Loan::whereIn('status',[2,3])->sum('loan_amount');
			$total_loan_applied_for=Loan::whereNotIn('status',[-1,4])->sum('loan_amount');
			$loan_approved=Loan::where('status',2)->sum('loan_amount');
			$loan_rejected=Loan::where('status',3)->sum('loan_amount');
			

			$loan_applied_for_count=Loan::whereIn('status',[2,3])->count();
			$total_loan_applied_for_count=Loan::whereNotIn('status',[-1,4])->count();

			//---------------NN-------------//
			if($user->role_id==1){
			$agentqr = AgentQr::first();
			$loan_registered_count = Loan::count();
			$loan_disbursed_count = Loan::where('status_id',3)->count();
			// dd($loan_disbursed_count);
			$month_wise_revenue=array();
			$labels=["January","February","March","April","May","June","July","August","September","October","November","December"];
			$year=date("Y");
			for($i=1;$i<=12;$i++){

				$loan_approved_count=Loan::where('status_id',1)->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->count();
				$loan_nonapproved_count=Loan::where('status_id',2)->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->count();
				$total_loan_approved_count = Loan::where('status_id',1)->count();
				$total_loan_nonapproved_count = Loan::where('status_id',2)->count();
				$data=[
					"label"=>$labels[$i-1],
					"loan_approved_count"=>$loan_approved_count,
					"loan_nonapproved_count"=>$loan_nonapproved_count,
					"total_loan_approved_count"=>$total_loan_approved_count,
					"total_loan_nonapproved_count"=>$total_loan_nonapproved_count,
					
				];

				array_push($month_wise_revenue, $data);
			}
			$mrw =[];
			$new_mrw= array();
			
			$new_mrw1= array();
			foreach($month_wise_revenue as $mwr){
				array_push($new_mrw, $mwr['loan_approved_count']);
				array_push($new_mrw1, $mwr['loan_nonapproved_count']);

			}
		}
		if($user->role_id==2){
			$agentqr = User::where('id', $user->id)->with('agent_qr')->first();
			$month_wise_revenue=array();
			$labels=["January","February","March","April","May","June","July","August","September","October","November","December"];
			$year=date("Y");
			for($i=1;$i<=12;$i++){
				$loan_approved_count=Loan::where('agent_id',$user->id)->where('status_id',1)->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->count();
				$loan_nonapproved_count=Loan::where('agent_id',$user->id)->where('status_id',0)->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->count();
				$total_loan_approved_count = Loan::where('agent_id',$user->id)->where('status_id',1)->count();
				$total_loan_nonapproved_count = Loan::where('agent_id',$user->id)->where('status_id',2)->count();

				$data=[
					"label"=>$labels[$i-1],
					"loan_approved_count"=>$loan_approved_count,
					"loan_nonapproved_count"=>$loan_nonapproved_count,
					"total_loan_approved_count"=>$total_loan_approved_count,
					"total_loan_nonapproved_count"=>$total_loan_nonapproved_count,
				];

				array_push($month_wise_revenue, $data);
			}
			$mrw =[];
			$new_mrw= array();
			
			$new_mrw1= array();
			foreach($month_wise_revenue as $mwr){
				array_push($new_mrw, $mwr['loan_approved_count']);
				array_push($new_mrw1, $mwr['loan_nonapproved_count']);

			}
			// dd($month_wise_revenue);
			$loan_registered_count = Loan::where('agent_id',$user->id)->count();
			$loan_disbursed_count = Loan::where('agent_id',$user->id)->where('status_id',3)->count();
		}

			

			$loan_approved_count=Loan::where('status_id',1)->count();
			$loan_nonapproved_count=Loan::where('status_id',0)->count();
			$loan_rejected_count=Loan::where('status_id',3)->count();
			//--------------NN---------------//
			
			// dd($month_wise_revenue);

			
			// $loan_approved_percentage=($loan_approved_count/$total_loan_applied_for_count)*100;
			// $loan_rejected_percentage=($loan_rejected_count/$total_loan_applied_for_count)*100;
			
			// $loan_approved_percentage=round($loan_approved_percentage);
			// $loan_rejected_percentage=round($loan_rejected_percentage);
			
			
			// $amount_loan_approved_percentage=($loan_approved/$total_loan_applied_for)*100;
			// $amount_loan_rejected_percentage=($loan_rejected/$total_loan_applied_for)*100;
			
			// $amount_loan_approved_percentage=round($amount_loan_approved_percentage);
			// $amount_loan_rejected_percentage=round($amount_loan_rejected_percentage);
			
			$user_count=User::where('role_id',2)->count();
			
			$user = User::where('id', Auth::user()->id)->with('wallet')->first();
			// $user = User::where('id', Auth::user()->id)->with(['wallet'=> function ($query){
			// 	$query->where('wallet_reason',3);
			// }])->get();
			$walletcount = Wallet::where('agent_id',Auth::user()->id)->sum('wallet_amount');
			// dd($total_loan_nonapproved_count);
			// if($user->wallet!=null){
				foreach($user->wallet as $walletdata){
					if($walletdata->wallet_reason==1){
						$wallet_updated_date_formate = date('Y-m-d');
						// dd($wallet_updated_date_formate);
						$wallet_updated_date = date('Y-m-d', strtotime($wallet_updated_date_formate));
						// dd($walletdata->amount_expiry, $wallet_updated_date);
						if($walletdata->amount_expiry == $wallet_updated_date){
							$new_wallet_amount = $walletdata->wallet_amount - "100";
							if($walletdata->wallet_amount<="100"){
								$wallet_id = $walletdata->wallet_id;
								$wallet = Wallet::find($wallet_id);
								if($wallet->wallet_amount>=100){
								$wallet->wallet_amount = $new_wallet_amount;
								}
								$wallet->save();
							}
						}
					}
					if($walletdata->wallet_reason==3){
						$wallet_updated_date_formate = date('Y-m-d');
						$wallet_updated_date = date('Y-m-d', strtotime($wallet_updated_date_formate));
						if($walletdata->amount_expiry == $wallet_updated_date){
							$new_wallet_amount = $walletdata->wallet_amount - "50";
							if($walletdata->wallet_amount<="50"){
								// dd($walletdata->wallet_amount);
								$wallet_id = $walletdata->wallet_id;
								$wallet = Wallet::find($wallet_id);
								// dd($wallet->wallet_amount>=50);
								if($wallet->wallet_amount>=50){
								$wallet->wallet_amount = $new_wallet_amount;
								}
								$wallet->save();
							}
						}
					}	
					
					
				}
				$latestwalletcount = Wallet::where('agent_id',Auth::user()->id)->sum('wallet_amount');
				// dd($wallet);
			// }
			// dd($user);
			// if($user->wallet!=null){
			// 	if($user->wallet->wallet_reason==1){
			// 		$wallet_updated_date_formate = date($user->wallet->updated_at);
			// 		$wallet_updated_date = date('Y-m-d', strtotime($wallet_updated_date_formate));
					
			// 		// echo $user->wallet->wallet_amount - "30";
			// 		if($user->wallet->amount_expiry == $wallet_updated_date){
			// 			$new_wallet_amount = $user->wallet->wallet_amount - "100";
			// 			if($user->wallet->wallet_amount<"100"){
			// 				$wallet_id = $user->wallet->wallet_id;
			// 				$wallet = Wallet::find($wallet_id);
			// 				// dd($new_wallet_amount, $wallet);
			// 				$wallet->wallet_amount = $new_wallet_amount;
			// 				$wallet->save();
			// 				// dd($wallet);
			// 			}
			// 		}
			// 	}

			// }

			$lead_count=$get_started_count + $apply_now_count + $term_insurance_count + $health_insurance_count + $loan_count + $mutual_fund_count;
			return view('admin.dashboard')->with('total_loan_approved_count',$total_loan_approved_count)->with('total_loan_nonapproved_count',$total_loan_nonapproved_count)->with('loan_registered_count',$loan_registered_count)->with('loan_disbursed_count',$loan_disbursed_count)->with('latestwalletcount',$latestwalletcount)->with('user',$user)->with('agentqr',$agentqr)->with('new_mrw1',$new_mrw1)->with('new_mrw',$new_mrw)->with('user_count',$user_count)->with('refer_earn_count',$refer_earn_count)->with('loan_approved_count',$loan_approved_count)->with('loan_nonapproved_count',$loan_nonapproved_count);
			// return view('admin.dashboard')->with('user',$user)->with('amount_loan_approved_percentage',$amount_loan_approved_percentage)->with('amount_loan_rejected_percentage',$amount_loan_rejected_percentage)->with('user_count',$user_count)->with('lead_count',$lead_count)->with('refer_earn_count',$refer_earn_count)->with('loan_applied_for',$loan_applied_for)->with('total_loan_applied_for',$total_loan_applied_for)->with('loan_approved',$loan_approved)->with('loan_rejected',$loan_rejected)->with('loan_approved_percentage',$loan_approved_percentage)->with('loan_rejected_percentage',$loan_rejected_percentage)->with('loan_applied_for_count',$loan_applied_for_count)->with('total_loan_applied_for_count',$total_loan_applied_for_count)->with('loan_approved_count',$loan_approved_count)->with('loan_rejected_count',$loan_rejected_count);
		}
	}
	// public function getAccountInfo()
	// {
	// 	return view('myaccount.my_account_details');
	// }
	
	public function getagentqr(Request $request){
		$agent_code = $request->agent_code;
		$agentqrc = User::where('agent_access_code', $agent_code)->with('agent_qr')->first();
		return view('my-blade-page')->with('agentqrc',$agentqrc);
	}
	public function downloadagentqr(){
		$agentqrc = User::where('id', Auth::user()->id)->with('agent_qr')->first();
		// $pdf = PDF::loadView('my-blade-page', ['agentqrc' => $agentqrc]);
		$html = view('my-blade-page', ['agentqrc' => $agentqrc])->render();
    	$dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('my-blade-page.pdf');
	}
	
	public function postAssignAssociate(Request $request){
	    $loan_id=$request->loan_id;
	    $assigned_to=$request->assigned_to;
	    
	    $loan=Loan::where('loan_id',$loan_id)->first();
	    $loan->assigned_to=$assigned_to;
	    $loan->save();
	    
	    	$notification = array(
			'message' => 'Associate Assigned Successfully!', 
			'alert-type' => 'success'
		);
		
		return redirect('admin/loanDetails/'.$loan_id)->with($notification);
	}

	public function getAddMutualFund(){
		
		return view('admin.mutual-fund.add');
	}


	public function postAddMutualFund (Request $request)
	{	


		
		$mutual_fund_type=$request->mutual_fund_type;
		
		$mutual_fund =new MutualFundList();
		$mutual_fund->mutual_fund_name=$request->mutual_fund_name;
		
		$mutual_fund->rating=$request->rating;
		$mutual_fund->aum_cr=$request->aum_cr;
		$mutual_fund->one_year=$request->one_year;
		$mutual_fund->three_year=$request->three_year;
		$mutual_fund->five_year=$request->five_year;

		if(Input::hasFile('logo')){
			$logo = $request->logo;
			$path = $logo->store('mutual_fund');
			$mutual_fund->logo=$path;
		}
		$mutual_fund->mutual_fund_type=$mutual_fund_type;
		$mutual_fund->save();

		$notification = array(
			'message' => 'Mutual Fund Data Added Successfully!', 
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	}
	public function getALLGetStarted(){
		return view('admin.get-started');
	}

	public function getAllGetStartedData(Request $request){
		$get_started =GetStarted::orderBy('get_started_id','desc');
		return DataTables::of($get_started)->make(true);
	}
	
	public function getusernew(Request $request){
		$code = $request->access_code;
		if(Auth::user()==null){
			if($code==null){
				return view('admin.unauthorized');
			}
		}
		// if(session()->has('loan_signin_id')){
			$loan_signin_id = $request->session()->get('loan_signin_id');
			$user_selected_bank = $request->session()->get('user_selected_bank');
			// dd($user_selected_bank);
			if($loan_signin_id==null){
				return redirect('admin/services/Loans');
			}
			// dd($loan_signin_id);	 
			$user_loan = Loansignin::where('loan_signin_id', $loan_signin_id)->first();
			
		// }	
		return view('admin.user-apply')->with('user_loan', $user_loan)->with('code', $code);
	}
	public function postusernew(Request $request){
		
		$loan_signin_id=$request->session()->get('loan_signin_id');
		$user_selected_bank = $request->session()->get('user_selected_bank');
		// dd($loan_signin_id);

		$request->validate([
			'user_name' => 'required',
			'phone' => 'required',
			'email' => 'required|email',
			'pincode' => 'required|digits:6',
			'mother_maiden_name' => 'required',
			'company_incor_date' => 'required|date|before:' . now()->format('Y-m-d'),
			'dob' => 'required|date|before_or_equal:' . now()->subYears(10)->format('Y-m-d'),
			'residential_address' => 'required',
			'company_address' => 'required',
			'permanent_address' => 'required',
			'gst_no' => 'required',
		]);
		// if ($validator->fails()) {
		// 	dd($validator->errors());
		// }
	
		//  dd($request->all());

		$username = $request->user_name;
		// $fname = $request->fname;
		$phone = $request->phone;
		$email = $request->email;
		$pincode = $request->pincode;
		// $loan_amount = $request->loan_amount;
		// $monthly_salary = $request->monthly_salary;
		// $gender = $request->gender;
		// $employee_type = $request->employee_type;
		$address = $request->address;
		// $city = $request->city;
		// $state = $request->state;
		// $pan_card = $request->pan_card;
		$dob = $request->dob;
		$mother_maiden_name = $request->mother_maiden_name;
		$company_incor_date = $request->company_incor_date;
		$residential_address = $request->residential_address;
		$company_address = $request->company_address;
		$permanent_address = $request->permanent_address;
		$gst_no = $request->gst_no;


		$code = $request->access_code;
		if(Auth::user()!=null){
			$agent_id = Auth::user()->id;
		}else{
			$checkagent = User::where('agent_access_code',$code)->first();
			$agent_id = $checkagent->id;
		}
		$loan = new Loan();
		$loan->agent_id = $agent_id;
		$loan->full_name = $username;
		// $loan->fathers_name = $fname;
		$loan->mobile = $phone;
		$loan->email = $email;
		$loan->zip_code = $pincode;
		// $loan->loan_amount = $loan_amount;
		// $loan->month_one_net_salary = $monthly_salary;
		// $loan->gender = $gender;
		// $loan->profession_type = $employee_type;
		$loan->residence_address = $address;
		// $loan->city = $city;
		// $loan->state = $state;
		// $loan->pan_card = $pan_card;
		$loan->dob = $dob;
		$loan->mother_maiden_name = $mother_maiden_name;
		$loan->company_incorporation_date = $company_incor_date;
		$loan->office_address = $company_address;
		$loan->permanent_address = $permanent_address;
		$loan->gst_no = $gst_no;
		$loan->bank_service = $user_selected_bank;

		// $loan->save();
		// dd($loan);
		session()->forget('loan_signin_id');
		if($user_selected_bank== 53){
		// dd($loan, $user_selected_bank== 53);die;
			
			$url = 'https://api.lendingkart.com/v2/partner/leads/create-application';

			$payload = [
				// "firstName" => $username,
				// "lastName" => $fname,
				// "email" => $email,
				// "mobile" => $phone,
				// "businessAge" => null,
				// "businessRevenue" => null,
				// "registeredAs" => "Proprietorship",
				// "personalDob" => $dob,
				// "personalPAN" => $pan_card,
				// "gender" => $gender,
				// "cibilConsentForLK" => true,
				// "personalAddress" => [
				// 	"pincode" => $pincode,
				// 	"address" => $address
				// ],
				// "businessRunBy" => "Self",
				// "loanAmount" => $loan_amount,
				// "businessAddress" => [
				// 	"address" => $address,
				// 	"pincode" => $pincode
				// ],
				// "productCategory" => "Film Producer",
				// "uniqueId" => $loan->loan_id,
				// "otherFields" => [
				//     "testfield1" => "test",
				//     "testfield2" => "dsasd",
				//     "testfield3" => 123
				// ]
			];

	

			$headers = [
				'Content-Type' => 'application/json',
				'Accept' => 'application/json',
				'X-Api-Key' => '7cd84080-9bfd-4484-9726-eb104ed8e6da'
			];

    		// $response = Http::withHeaders($headers)
                    // ->post($url, $payload);

    		// dd($response->body());
			
		}
		$agent_data = User::where('id', $agent_id)->first();
			// dd($agent_data);die;
		$mailData = [
			'title' => 'Mail from Bharat Nidhi',
			'body' => $loan->full_name,
			'agent_name' => $agent_data->name,
			'content'=> 'please provide document of the customer '.$loan->full_name,
			'list1' => 'Aadhar card copy.',
			'list2' => 'Pan Card Copy.',
			'list3' => 'Customer bank Statement.',

		];
		 
		// Mail::to($agent_data->email)->send(new LoanMail($mailData));
		Mail::to($loan->email)->send(new LoanMail($mailData));

		$mailData = [
			'title' => 'Mail from Bharat Nidhi',
			'body' => $loan->full_name,
			'type'=> 'congrats',
			'content' => 'Your request for loan Application login successfully. thanks for connecting with Bharat Nidhi.',
			

		];
		Mail::to($loan->email)->send(new MailNotify($mailData));
		$request->session()->put('success',"User Loan Applied Successfully!!");
		if(Auth::user()!=null){
		return redirect('admin/services/form/apply-user');
		}else{
			return redirect('admin/direct-services?access_code='.$code);
		}

	}
	
	public function getALLApplyNow(){
		return view('admin.apply-now');
	}

	public function getAllApplyNowData(Request $request){
		$apply_now =ApplyNow::with('mutual_fund_list')->orderBy('apply_now_id','desc');
		return DataTables::of($apply_now)->make(true);
	}

	public function getALLTermInsurance(){
		return view('admin.term-insurance');
	}

	public function getAllTermInsuranceData(Request $request){
		$term_insurance =TermInsurance::orderBy('term_insurance_id','desc');
		return DataTables::of($term_insurance)->make(true);
	}
	public function getALLHealthInsurance(){
		return view('admin.health-insurance');
	}

	public function getALLHealthInsuranceData(Request $request){
		$health_insurance =HealthInsurance::orderBy('health_insurance_id','desc');
		return DataTables::of($health_insurance)->make(true);
	}
	//Rejected Loan--------------------------------
	public function getRejectedLoanAll(){
		return view('admin.loan');
	}

	public function getRejectedLoanAllData(Request $request){
	    
		$user=Auth::user();
	    $role_id=$user->role_id;
	    
	    if($role_id==1){
				$loan =Loan::where('status',3)->with('associate')->orderBy('loan_id','desc')->get();
	    }else{
	        $loan=Loan::where('status',3)->with('associate')->where('assigned_to',$user->id)->get();
	    }
		return DataTables::of($loan)->make(true);
	}

	
	//Documents Pending------------------------------
	public function getDocPendinglLoanAll(Request $request)
	{
		return view('admin.docpendingloan');
	}
	public function getDocPendingLoanAllData(Request $request)
	{
	    $user=Auth::user();
	    $role_id=$user->role_id;
	    
	    if($role_id==1){
		$docpending=Loan::where('status', 1)->with('associate')->with('associate')->get();
	    }else{
	        $docpending=Loan::where('status', 1)->with('associate')->with('associate')->where('assigned_to',$user->id)->get();
	    }

		return DataTables::of($docpending)->make(true);
	}
	//Pending Loan------------------------------
	public function getPendinglLoanAll(Request $request)
	{
		// dd($request->all());
		$status=$request->status;

		return view('admin.pendingloan')->with('status',$status);

	}
	public function getPendingLoanAllData(Request $request)
	{
		
		$user=Auth::user();
	    $role_id=$user->role_id;
	    $status=$request->status;

	    if($role_id==1){
			
			if($status!=""){
	    	$pendingloan=Loan::where('status', $status)->with('associate')->with('substatus')->get();
	  
	    	}	
	    	else{
	    		$pendingloan=Loan::where('status', 0)->orWhere('status', 1)->with('associate')->with('substatus')->get();
	    	}	
	    	//return DataTables::of($pendingloan)->make(true);	
	    }
	  	else{
	        
	        if($status!=""){
	    	$pendingloan=Loan::where('status', $status)->with('associate')->with('substatus')->get();
	    	}
	    	else{
	    		$pendingloan=Loan::where('status', 0)->orWhere('status', 1)->with('associate')->where('assigned_to',$user->id)->with('substatus')->get();
	    	}
	    	//return DataTables::of($pendingloan)->make(true);
	    }
		return DataTables::of($pendingloan)->make(true);
	}
	//Approved Loan-----------------------------
	public function getApprovedLoanAll(Request $request)
	{
		return view('admin.approvedloan');
	}
	public function getApprovedLoanAllData(Request $request)
	{
		
		$user=Auth::user();
	    $role_id=$user->role_id;
	    
	    if($role_id==1){
			$approvedloan=Loan::where('status', 2)->with('associate')->get();
	    }else{
	        $approvedloan=Loan::where('status', 2)->with('associate')->where('assigned_to',$user->id)->get();
	    }

		return DataTables::of($approvedloan)->make(true);
	}

	//Details Of loan
	public function getLoanDetails(Request $request)
	{
		$loan_id=$request->id;
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('associate')->with('comments')->first();
		$comment_name=Comment::where('loan_id', $loan_id)->with('username')->groupBy('commentname')->orderBy('comment_id','ASC')->get();
		$associates=User::where('role_id',4)->get();
		//echo $associates;
		$loanstatus=Status::get();
		//echo $status;die;
		return view('admin.loan_details')->with('loandetails',$loandetails)->with('loan_id',$loan_id)->with('associates',$associates)->with('comment_name',$comment_name)->with('loanstatus',$loanstatus);
		//return DataTables::of($loandetails)->make(true);

	}
	//Delete Comment
	public function postDeleteComment(Request $request)
	{
		$comment_id=$request->id;

		$cmt=Comment::where('comment_id',$comment_id)->delete();

		$notification = array(
				'message' => 'Comments Deleted Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);

	}
	public function postDeleteDocument(Request $request)
	{
		$loan_doc_id=$request->id;
		$doc=LoanDocuments::where('loan_doc_id',$loan_doc_id)->delete();
		$notification = array(
				'message' => 'Loan Document Deleted Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
	}
	public function postDeleteUserDoc(Request $request)
	{
		$loan_doc_id=$request->id;
		$doc=LoanDocuments::where('loan_doc_id',$loan_doc_id)->delete();
		$notification = array(
				'message' => 'Loan Document Deleted Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
	}

	//Status Update
	public function postStatusLoanInprocess(Request $request)
	{
		$loan_id=$request->id;
		$status_id=$request->status_id;
		$note=$request->note;
		$loandetail=Loan::find($loan_id);
		$loandetail->status=0;
		$loandetail->status_id=$status_id;
		$loandetail->note=$note;
		$loandetail->save();
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('comments')->first();
		$notification = array(
				'message' => 'Loan Status Changes Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
		// return view('admin.loan_details')->with('loandetails',$loandetails);
	}

	//send Comments
	public function postSendMessage(Request $request)
	{
		$user=Auth::user();
	    $message_user_id=$user->id;

	    $loan_id=$request->loan_id;
		
		$commentname=$request->commentname;
		$attachment=$request->attachment;

		if($attachment!='')
		{
			$img_count = count($attachment);
	        for ($i=0; $i < $img_count; $i++) 
	        { 

	            $sendcomment=new Comment();
	            $sendcomment->loan_id=$loan_id;	
				$sendcomment->message_user_id=$message_user_id;
	            $sendcomment->commentname=$commentname;
	            $sendcomment->is_admin_read=1;
				
	            if(Input::hasFile('attachment')){
	                $eventImage = $request->attachment[$i];
	                $path = $eventImage->store('attachment');
	                $sendcomment->attachment=$path;
	            }
	            $sendcomment->save();
	        }
    	}
    	else{
    		$sendcomment=new Comment();
            $sendcomment->commentname=$commentname;
			$sendcomment->attachment=$attachment;
			$sendcomment->loan_id=$loan_id;	
			$sendcomment->message_user_id=$message_user_id;
			$sendcomment->is_admin_read=1;
            $sendcomment->save();

    	}
    	$notification = array(
				'message' => 'Comments Added Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
	}
	public function postSendComment(Request $request)
	{
		$user=Auth::user();
	    $message_user_id=$user->id;

	    $loan_id=$request->loan_id;
		
		$commentname=$request->commentname;
		$attachment=$request->attachment;

		if($attachment!='')
		{
			$img_count = count($attachment);
	        for ($i=0; $i < $img_count; $i++) 
	        { 

	            $sendcomment=new Comment();
	            $sendcomment->loan_id=$loan_id;	
				$sendcomment->message_user_id=$message_user_id;
	            $sendcomment->commentname=$commentname;
	            $sendcomment->is_user_read=1;
				
	            if(Input::hasFile('attachment')){
	                $eventImage = $request->attachment[$i];
	                $path = $eventImage->store('attachment');
	                $sendcomment->attachment=$path;
	            }
	            $sendcomment->save();
	        }
    	}
    	else{
    		$sendcomment=new Comment();
            $sendcomment->commentname=$commentname;
			$sendcomment->attachment=$attachment;
			$sendcomment->loan_id=$loan_id;	
			$sendcomment->message_user_id=$message_user_id;
			$sendcomment->is_user_read=1;
            $sendcomment->save();

    	}
    	$notification = array(
				'message' => 'Comments Added Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
	}
	public function postStatusLoanDocPending(Request $request)
	{
		$loan_id=$request->id;
		$note=$request->note;

		$loandetail=Loan::where('loan_id',$loan_id)->first();
		$loandetail->status=1;
		$loandetail->note=$note;
		$loandetail->save();
		
		$email=$loandetail->email;
		$name=$loandetail->full_name;
	
		$data = array('name'=>$name,'email'=>$email,'note'=>$note);

		try{

			

		Mail::send('mail.userLoanPendingDocumentMail', $data, function($message) use ($email,$name){
			$message->to($email,$name)->subject('Pending Documents');
			$message->from('jfinservconsultant@gmail.com', 'JFinserv');
		});
		}catch (Exception $e) {
		
	}
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('comments')->first();
		// return view('admin.loan_details')->with('loandetails',$loandetails);
		$notification = array(
				'message' => 'Loan Status Change Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
	}
	public function postStatusLoanApproved(Request $request)
	{
		$loan_id=$request->id;
		$loandetail=Loan::find($loan_id);

		$loandetail->status=2;
		$loandetail->note="";
		$loandetail->save();
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('comments')->first();
        //echo $loandetails;die;
		$old_branch=Branch::where('user_id',$loandetails->refered_by)->first();

		$user_id=$loandetails->user_id;
       
		if ($old_branch!="") {
			$level=$old_branch->level;
			$level_start_id=$old_branch->level_start_id;
			$new_level=$level+1;
			if ($new_level<10) {

				$branch=new Branch();
			
				$branch->user_id=$user_id;
				$branch->level=$new_level;
				$branch->referred_by=$loandetails->refered_by;
				$branch->level_start_id=$level_start_id;
				$branch->save();
			}
		}
		else{
            
            if($loandetails->refered_by!="")
            {
			$newbranch=new Branch();
			$newbranch->user_id=$loandetails->refered_by;
			$newbranch->level=1;
			$newbranch->referred_by=1;
			$newbranch->level_start_id=$loandetails->refered_by;

			$newbranch->save();

			$branch=new Branch();
			$branch->user_id=$user_id;
			$branch->level=2;
			$branch->referred_by=$loandetails->refered_by;
			$newbranch->level_start_id=$loandetails->refered_by;
			$branch->save();
            }

		}
		$notification = array(
				'message' => 'Loan Approved Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
		//return view('admin.loan_details')->with('loandetails',$loandetails);
	}
	public function postStatusLoanRejected(Request $request)
	{
		$loan_id=$request->id;
		$loandetail=Loan::find($loan_id);
		$loandetail->status=3;
		$loandetail->save();
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('comments')->first();
		$notification = array(
				'message' => 'Loan Rejected Successfully', 
				'alert-type' => 'success'
			);
		return redirect()->back()->with($notification);
		//return view('admin.loan_details')->with('loandetails',$loandetails);
	}
	

	public function getALLMutualFund(){
		return view('admin.mutual-fund');
	}

	public function getALLMutualFundData(Request $request){
		$mutual_fund =MutualFund::orderBy('mutual_fund_id','desc');
		return DataTables::of($mutual_fund)->make(true);
	}

	public function getALLReferEarn(){
		return view('admin.refer-earn');
	}

	public function getALLReferEarnData(Request $request){
		$refer_earn =ReferFriend::with('refer_by')->with('loan_user')->with('loan')->orderBy('refer_friend_id','desc');
		return DataTables::of($refer_earn)->make(true);
	}

	public function getALLPartner(Request $request)
	{
		return view('admin.partner');
	}
	public function getALLPartnerData(Request $request){
		$partners=User::where('role_id',3)->orderBy('id','desc')->get();
		return DataTables::of($partners)->make(true);
	}

	public function getALLUser(Request $request)
	{
		return view('admin.user');
	}
	public function getALLUserData(Request $request){
		$users=User::where('role_id',2)->orderBy('id','desc')->get();
		return DataTables::of($users)->make(true);
	}
	
	public function getAccountInfo(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::where('user_id', $user->id)->first();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		
		return view('myaccount.myprofile')->with('loan_details',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
		
	}
	public function getEditMyprofile(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::where('user_id', $user->id)->first();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		
		return view('myaccount.edit-my-profile')->with('loan_details',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
		
	}

	public function getReadAdminNotify(Request $request)
	{
		$loan_id=$request->id;
		$cmt=Comment::where('loan_id',$loan_id)->get();
		foreach($cmt as $cmts){
    		$cmts->is_admin_read=1;
			$cmts->save();
		}
		$loandetails=Loan::where('loan_id', $loan_id)->with('loandoc')->with('associate')->with('comments')->first();
		$comment_name=Comment::where('loan_id', $loan_id)->with('username')->groupBy('commentname')->orderBy('comment_id','ASC')->get();
		$associates=User::where('role_id',4)->get();
		//echo $associates;
		$loanstatus=Status::get();
		//echo $status;die;
		return view('admin.loan_details')->with('loandetails',$loandetails)->with('loan_id',$loan_id)->with('associates',$associates)->with('comment_name',$comment_name)->with('loanstatus',$loanstatus);
	}
	public function postReadUserNotification(Request $request)
	{
		$user=Auth::user();
		$loan_id=$request->id;
	// echo $loan_id;die;
		$cmt=Comment::where('loan_id',$loan_id)->get();
		foreach($cmt as $cmts){
    		$cmts->is_user_read=1;
			$cmts->save();
		}

		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$loan_details=Loan::where('loan_id',$loan_id)->with('loandoc')->with('comments')->first();
		$loan_dully=LoanDocuments::get();
		// echo $loan_details;die;
		$comment_name=Comment::where('loan_id',$loan_id)->with('username')->groupBy('commentname')->orderBy('comment_id','ASC')->get();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		return view('myaccount.account_loandetails')->with('loandetail',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_dully',$loan_dully)->with('comment_name',$comment_name);
		
		//return redirect()->back();
	}
	
		public function postAccountInfo(Request $request)
	{
		$user=Auth::user();
		$name=$request->name;
		$contact_number=$request->contact_number;
		$present_address=$request->present_address;
		$city=$request->city;
		$state=$request->state;
		$pincode=$request->pincode;
		$MaritalStatas=$request->MaritalStatas;
		$date_of_birth=$request->date_of_birth;
		$email=$request->email;
	
		
		
		
		$user->pincode=$pincode;
		$user->state=$state;
		$user->city=$city;
		$user->present_address=$present_address;
		$user->contact_number=$contact_number;
	    $user->name=$name;
	    $user->marital_status=$MaritalStatas;
	     $user->date_of_birth=$date_of_birth;
	      $user->email=$email;
	     
	     
		$user->save();
	
	
	    return redirect()->back();
	}
	
	public function getProfessionalDetail(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::where('user_id', $user->id)->first();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		
		return view('myaccount.professional-detail')->with('loan_details',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
		
	}
	public function getNotificationDetail(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::where('user_id', $user->id)->get();
		$loan_id=[];
		foreach ($loan_details as $loan_detail) {
			$loan_ids=$loan_detail->loan_id;
			array_push($loan_id, $loan_ids);
		}
		// print_r($loan_id);
		$user_comments=Comment::whereIn('loan_id',$loan_id)->where('is_user_read',0)->groupBy('loan_id')->get();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		return view('myaccount.mynotification')->with('user_comments',$user_comments)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
	}
	public function getAdminNotificationAll(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::get();
		$loan_id=[];
		foreach ($loan_details as $loan_detail) {
			$loan_ids=$loan_detail->loan_id;
			array_push($loan_id, $loan_ids);
		}
		$user_comments=Comment::whereIn('loan_id',$loan_id)->where('is_admin_read',0)->groupBy('loan_id')->get();
		//echo $user_comments;die;
		return view('admin.notifications')->with('user_comments',$user_comments);
	}
	
		public function postProfessionalDetail(Request $request)
	{
		$user=Auth::user();
		$profession_type=$request->profession_type;
		$qualification=$request->qualification;
		$company_name=$request->company_name;
		$nature_of_work=$request->nature_of_work;
		$work_experience=$request->work_experience;
		$business_estabish_date=$request->business_estabish_date;
		$company_address=$request->company_address;
			$job_business_profile=$request->job_business_profile;
		
		
		$user->profession_type=$profession_type;
		$user->highest_qualification=$qualification;
		$user->company_name=$company_name;
		$user->nature_of_work=$nature_of_work;
		$user->work_exp=$work_experience;
	    $user->business_estabish_date=$business_estabish_date;
	    $user->company_address=$company_address;
	     $user->job_business_profile=$job_business_profile;
	    
		$user->save();
	
	
	    return redirect()->back();
	}
	
		public function getEditProfessionalDetail(Request $request)
	{
		$user=Auth::user();
		$loan_details=Loan::where('user_id', $user->id)->first();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		
		return view('myaccount.edit-professional-detail')->with('loan_details',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
		
	}
// 	public function postProfessionalDetail(Request $request)
// 	{
// 		$user=Auth::user();
// 		$loan_details=Loan::where('user_id', $user->id)->first();
// 		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
// 		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
// 		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
// 		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
// 		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		
// 		return view('myaccount.professional-detail')->with('loan_details',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('user',$user);
		
// 	}
	
	
	
	public function getMyLoanInfo(Request $request)
	{	
		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->first();
		
		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();
		return view('myaccount.myloans')->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);
	}
	public function getAllMyLoanInfo(Request $request)
	{
		// $user=Auth::user();
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->where('status',1)->get();

		return DataTables::of($loan_details)->make(true);
	}
	public function getAccountLoanDetails(Request $request)
	{
		
// 		$user=Auth::user();
// 		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
// 		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
// 		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
// 		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
// 		$loan_id=$request->id;
// 		$loan_details=Loan::where('loan_id',$loan_id)->with('loandoc')->first();
// 		$referearn=ReferFriend::where('referred_by',$user->id)->count();
// 		return view('myaccount.account_loandetails')->with('loandetail',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn);
	$user=Auth::user();
		$doc_pending=Loan::where('user_id', $user->id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user->id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user->id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user->id)->where('status',3)->count();
		$loan_id=$request->id;
		$loan_details=Loan::where('loan_id',$loan_id)->with('loandoc')->with('comments')->first();
		$loan_dully=LoanDocuments::get();
		// echo $loan_details;die;
		$comment_name=Comment::where('loan_id',$loan_id)->with('username')->groupBy('commentname')->orderBy('comment_id','ASC')->get();
		$referearn=ReferFriend::where('referred_by',$user->id)->count();
		return view('myaccount.account_loandetails')->with('loandetail',$loan_details)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_dully',$loan_dully)->with('comment_name',$comment_name);
	    
	}

	public function getMyLoanApprove(Request $request)
	{	
		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->first();
		
		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();
		return view('myaccount.myapproved_loan')->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);
	}
	public function getAllMyLoanApprove(Request $request)
	{
		// $user=Auth::user();
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->where('status',2)->get();

		return DataTables::of($loan_details)->make(true);
	}
	public function getMyLoanInprocess(Request $request)
	{	
		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->first();
		
		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();
		return view('myaccount.myinprocess_loan')->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);
	}
	public function getAllMyLoanDraft(Request $request)
	{
		// $user=Auth::user();
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->where('status',-1)->get();

		return DataTables::of($loan_details)->make(true);
	}
	
		public function getAllMyLoanInprocess(Request $request)
	{
		// $user=Auth::user();
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->with('substatus')->where('status',0)->get();

		return DataTables::of($loan_details)->make(true);
	}

	public function getMyLoanReject(Request $request)
	{	
		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->first();
		
		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();
		return view('myaccount.myrejected_loan')->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);
	}
	public function getAllMyLoanReject(Request $request)
	{
		// $user=Auth::user();
		$user_id=$request->id;
		$loan_details=Loan::where('user_id', $user_id)->where('status',3)->get();

		return DataTables::of($loan_details)->make(true);
	}

	public function getMyReferearn(Request $request)
	{	
		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$user->id;
		$loan_details=Loan::where('user_id', $user->id)->first();


		

		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();
		return view('myaccount.myrefer_earn')->with('user',$user)->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);
	}
	public function getAllMyReferearn(Request $request)
	{
		$user=Auth::user();
		// $mobile=$request->phone;
			$user_id=$user->id;
		$refer_earn =ReferFriend::where('referred_by',$user_id)->with('refer_by')->with('loan_user')->with('loan')->orderBy('refer_friend_id','desc');
		return DataTables::of($refer_earn)->make(true);
	}

	public function myrefercode(Request $request)
	{

		$user=Auth::user();

		if ($user->role_id!=2 && $user->role_id!=3) {
			return redirect('/');
		}
		$user_id=$user->id;
		$loan_details=Loan::where('user_id', $user->id)->first();
		
		$referearn=ReferFriend::where('referred_by',$user_id)->count();
		$doc_pending=Loan::where('user_id', $user_id)->where('status',1)->count();
		$inprocess=Loan::where('user_id', $user_id)->where('status',0)->count();
		$approved=Loan::where('user_id', $user_id)->where('status',2)->count();
		$rejeted=Loan::where('user_id', $user_id)->where('status',3)->count();

		return view('myaccount.share')->with('user',$user)->with('user_id',$user_id)->with('doc_pending',$doc_pending)->with('inprocess',$inprocess)->with('approved',$approved)->with('rejeted',$rejeted)->with('referearn',$referearn)->with('loan_details',$loan_details);


	}

	public function getApproveWallet(Request $request)
	{

       $user=Auth::user();
		if ($user->role_id!=1) {
			return redirect('/');
		}

		$referred_id=$request->id;

		$refer_friend=ReferFriend::find($referred_id);

		$referred_by=$refer_friend->referred_by;

		$branch=Branch::where('referred_by',$referred_by)->first();
		if($branch!=""){
		$branch_count=Branch::where('level','<=',$branch->level)->where('level_start_id',$branch->level_start_id)->count();
       
		$branch_users=Branch::where('level','<=',$branch->level)->where('level_start_id',$branch->level_start_id)->orderBy('level','desc')->get();
		$loan=Loan::find($refer_friend->loan_id);

		$loan_amount=$loan->loan_amount;

		$refer_amount=0.04*$loan_amount;

         $i=0;
		foreach ($branch_users as $branch_user) {
			$i++;

	     $CommissionMaster=CommissionMaster::where('commission_id',$i)->first();

	     $commission_percentage=$CommissionMaster->commission_percent/100;

	     $amount=$refer_amount*$commission_percentage;

	     $wallet_transaction=new WalletTransaction();

	     $new_user=User::find($branch_user->referred_by);

	     $old_walltet=$new_user->wallet;
	     $new_wallet=$old_walltet+$amount;
	     $new_user->wallet=$new_wallet;
	     $new_user->save();

         $wallet_transaction->amount=$amount;
         $wallet_transaction->user_id=$branch_user->referred_by;
         $wallet_transaction->loan_id=$refer_friend->loan_id;
         $wallet_transaction->save();



			
		}

		$refer_friend->is_claim=3;
		$refer_friend->save();
		}

			return redirect('admin/refer_earn/all');

	}


	
	public function getAllWallet(){
		return view('admin.wallet');
	}

	public function getAllWalletData(Request $request){
		$refer_earn =WalletTransaction::with('loan')->with('user')->orderBy('wallet_transaction_id','desc');
		return DataTables::of($refer_earn)->make(true);
	}
	public function getAllRedeem(){
		return view('admin.walletredeem');
	}
	public function getAllRedeemData(Request $request){
		$redeem =Redeem::with('user')->orderBy('redeem_id','desc');
		return DataTables::of($redeem)->make(true);
	}
	public function getAllPartnerLoan(Request $request)
	{
		 $user_id=$request->id;
		 // $loan=Loan::where('channel_partner_id',$user_id)->get();
		 // echo $loan;die;
		 return view('admin.partnerloans')->with('user_id',$user_id);
		 

	}
	public function getAllPartnerLoanData(Request $request)
	{
		$user_id=$request->id;
		$loan=Loan::where('channel_partner_id',$user_id)->with('associate')->get();

		return DataTables::of($loan)->make(true);

	}

	public function getAllBranch(Request $request)
	{

        $user_id=$request->id;
        // $branchdetails=Branch::where('level_start_id',$user_id)->where('user_id','!=',$user_id)->orWhere('referred_by',$user_id)->with('userlevels')->get();
        // echo $branchdetails;die;

        return view('admin.userbranch')->with('user_id',$user_id);
	}
	public function getAllBranchData(Request $request)
	{
		$user_id=$request->id;

        $branchdetails=Branch::where('level_start_id',$user_id)->where('user_id','!=',$user_id)->orWhere('referred_by',$user_id)->with('userlevels')->get();
        return DataTables::of($branchdetails)->make(true);
	}
	

	public function getSanctionCalculator(){
		return view('admin.sanctioncalculator');
	}
	public function getEditSanctionCalculator(Request $request){
      
      $id=$request->id;

      $sanction=SanctionCalculator::find($id);

		return view('admin.editsanction')->with('sanction',$sanction);
	}

	public function getSanctionCalculatorHistory($value='')
	{
		return view('admin.history');
	}
	public function getAllSanctionCalculatorHistory($value='')
	{
		$sanction=SanctionCalculator::get();
        return DataTables::of($sanction)->make(true);
	}
	public function postAddSanctionCalculator(Request $request)
	{	

		// dd($request->all());
	
		$sanction=new SanctionCalculator();
		$sanction->profession_type=$request->profession_type;
		$sanction->name=$request->name;	
		$sanction->dob=$request->dob;	
		$sanction->age=$request->age;	
		$sanction->cm_gross_margin=$request->master_income_margin;
		$sanction->cm_rental_margin=$request->master_rental_margin;
		$sanction->cm_ltv_margin_1=$request->master_ltv_margin;
		$sanction->cm_ltv_margin_2=$request->master_ltv_margin2;	
		$sanction->cm_ltv_margin_3=$request->master_ltv_margin3;


		$sanction->selfb_gi_year1=$request->selfb_gi_year1;
		$sanction->selfb_gi_year2=$request->selfb_gi_year2;
		$sanction->selfb_gi_yearlatest=$request->selfb_gi_yearlatest;
		$sanction->selfb_gi_avg_latest=$request->selfb_gi_avg_latest;
		$sanction->selfb_gi_avg_all=$request->selfb_gi_avg_all;


		$sanction->selfb_sr_year1=$request->selfb_sr_year1;
		$sanction->selfb_sr_year2=$request->selfb_sr_year2;
		$sanction->selfb_sr_yearlatest=$request->selfb_sr_yearlatest;
		$sanction->selfb_sr_avg_latest=$request->selfb_sr__avg_latest;
		$sanction->selfb_sr_avg_all=$request->selfb_sr_avg_all;

		$sanction->selfb_interest_year1=$request->selfb_interest_year1;
		$sanction->selfb_interest_year2=$request->selfb_interest_year2;
		$sanction->selfb_interest_yearlatest=$request->selfb_interest_yearlatest;
		$sanction->selfb_interest_avg_latest=$request->selfb_interest_avg_latest;
		$sanction->selfb_interest_avg_all=$request->selfb_interest_avg_all;

		$sanction->selfco_sr_year1=$request->selfco_sr_year1;
		$sanction->selfco_sr_year2=$request->selfco_sr_year2;
		$sanction->selfco_sr_yearlatest=$request->selfco_sr_yearlatest;
		$sanction->selfco_sr_avg_latest=$request->selfco_sr__avg_latest;
		$sanction->selfco_sr_avg_all=$request->selfco_sr_avg_all;

		$sanction->selfco_interest_year1=$request->selfco_interest_year1;
		$sanction->selfco_interest_year2=$request->selfco_interest_year2;
		$sanction->selfco_interest_yearlatest=$request->selfco_interest_yearlatest;
		$sanction->selfco_interest_avg_latest=$request->selfco_interest_avg_latest;
		$sanction->selfco_interest_avg_all=$request->selfco_interest_avg_all;


		$sanction->selfb_ai_year1=$request->selfb_ai_year1;
		$sanction->selfb_ai_year2=$request->selfb_ai_year2;
		$sanction->selfb_ai_yearlatest=$request->selfb_ai_yearlatest;
		$sanction->selfb_ai_avg_latest=$request->selfb_ai_avg_latest;
		$sanction->selfb_ai_avg_all=$request->selfb_ai_avg_all;
		$sanction->selfb_oi_year1=$request->selfb_oi_year1;
		$sanction->selfb_oi_year2=$request->selfb_oi_year2;
		$sanction->selfb_oi_yearlatest=$request->selfb_oi_yearlatest;
		$sanction->selfb_oi_avg_latest=$request->selfb_oi_avg_latest;
		$sanction->selfb_oi_avg_all=$request->selfb_oi_avg_all;
		$sanction->selfb_d_year1=$request->selfb_d_year1;
		$sanction->selfb_d_year2=$request->selfb_d_year2;
		$sanction->selfb_d_yearlatest=$request->selfb_d_yearlatest;
		$sanction->selfb_d_avg_latest=$request->selfb_d_avg_latest;
		$sanction->selfb_d_avg_all=$request->selfb_d_avg_all;
		$sanction->selfb_tgi_year1=$request->selfb_tgi_year1;
		$sanction->selfb_tgi_year2=$request->selfb_tgi_year2;
		$sanction->selfb_tgi_yearlatest=$request->selfb_tgi_yearlatest;
		$sanction->selfb_tgi_avg_latest=$request->selfb_tgi_avg_latest;
		$sanction->selfb_tgi_avg_all=$request->selfb_tgi_avg_all;
		$sanction->selfb_tax_year1=$request->selfb_tax_year1;
		$sanction->selfb_tax_year2=$request->selfb_tax_year2;
		$sanction->selfb_tax_yearlatest=$request->selfb_tax_yearlatest;	
		$sanction->selfb_tax_avg_latest=$request->selfb_tax_avg_latest;	
		$sanction->selfb_tax_avg_all=$request->selfb_tax_avg_all;		
		$sanction->selfb_od_year1=$request->selfb_od_year1;	
		$sanction->selfb_od_year2=$request->selfb_od_year2;	
		$sanction->selfb_od_yearlatest=$request->selfb_od_yearlatest;
		$sanction->selfb_od_avg_latest=$request->selfb_od_avg_latest;	
		$sanction->selfb_od_avg_all=$request->selfb_od_avg_all;	
		$sanction->selfb_td_year1=$request->selfb_td_year1;	
		$sanction->selfb_td_year2=$request->selfb_td_year2;	
		$sanction->selfb_td_yearlatest=$request->selfb_td_yearlatest;
		$sanction->selfb_td_avg_latest=$request->selfb_td_avg_latest;	
		$sanction->selfb_td_avg_all=$request->selfb_td_avg_all;	
		$sanction->selfco_gi_year1=$request->selfco_gi_year1;	
		$sanction->selfco_gi_year2=$request->selfco_gi_year2;	
		$sanction->selfco_gi_yearlatest=$request->selfco_gi_yearlatest;	
		$sanction->selfco_gi_avg_latest=$request->selfco_gi_avg_latest;	
		$sanction->selfco_gi_avg_all=$request->selfco_gi_avg_all;	
		$sanction->selfco_ai_year1=$request->selfco_ai_year1;	
		$sanction->selfco_ai_year2=$request->selfco_ai_year2;	
		$sanction->selfco_ai_yearlatest=$request->selfco_ai_yearlatest;	
		$sanction->selfco_ai_avg_latest=$request->selfco_ai_avg_latest;
		$sanction->selfco_ai_avg_all=$request->selfco_ai_avg_all;	
		$sanction->selfco_oi_year1=$request->selfco_oi_year1;	
		$sanction->selfco_oi_year2=$request->selfco_oi_year2;	
		$sanction->selfco_oi_yearlatest=$request->selfco_oi_yearlatest;	
		$sanction->selfco_oi_avg_latest=$request->selfco_oi_avg_latest;	
		$sanction->selfco_oi_avg_all=$request->selfco_oi_avg_all;	
		$sanction->selfco_d_year1=$request->selfco_d_year1;	
		$sanction->selfco_d_year2=$request->selfco_d_year2;	
		$sanction->selfco_d_yearlatest=$request->selfco_d_yearlatest;	
		$sanction->selfco_d_avg_latest=$request->selfco_d_avg_latest;	
		$sanction->selfco_d_avg_all=$request->selfco_d_avg_all;	
		$sanction->selfco_tgi_year1=$request->selfco_tgi_year1;	
		$sanction->selfco_tgi_year2=$request->selfco_tgi_year2;	
		$sanction->selfco_tgi_yearlatest=$request->selfco_tgi_yearlatest;	
		$sanction->selfco_tgi_avg_latest=$request->selfco_tgi_avg_latest;	
		$sanction->selfco_tgi_year_all=$request->selfco_tgi_year_all;	
		$sanction->selfco_tax_year1=$request->selfco_tax_year1;	
		$sanction->selfco_tax_year2=$request->selfco_tax_year2;
		$sanction->selfco_tax_yearlatest=$request->selfco_tax_yearlatest;
		$sanction->selfco_tax_avg_latest=$request->selfco_tax_avg_latest;
		$sanction->selfco_tax_avg_all=$request->selfco_tax_avg_all;
		$sanction->selfco_od_year1=$request->selfco_od_year1;
		$sanction->selfco_od_year2=$request->selfco_od_year2;
		$sanction->selfco_od_yearlatest=$request->selfco_od_yearlatest;
		$sanction->selfco_od_avg_latest=$request->selfco_od_avg_latest;
		$sanction->selfco_od_avg_all=$request->selfco_od_avg_all;
		$sanction->selfco_td_year1=$request->selfco_td_year1;
		$sanction->selfco_td_year2=$request->selfco_td_year2;
		$sanction->selfco_td_yearlatest=$request->selfco_td_yearlatest;
		$sanction->selfco_td_avg_latest=$request->selfco_td_avg_latest;
		$sanction->selfco_td_avg_all=$request->selfco_td_avg_all;
		$sanction->salb_gi_month1=$request->salb_gi_month1;
		$sanction->salb_gi_month2=$request->salb_gi_month2;
		$sanction->salb_gi_month3=$request->salb_gi_month3;
		$sanction->salb_gi_month4=$request->salb_gi_month4;
		$sanction->salb_gi_month5=$request->salb_gi_month5;
		$sanction->salb_gi_monthlatest=$request->salb_gi_monthlatest;
		$sanction->salb_gi_avg=$request->salb_gi_avg;
		$sanction->salb_tax_month1=$request->salb_tax_month1;
		$sanction->salb_tax_month2=$request->salb_tax_month2;
		$sanction->salb_tax_month3=$request->salb_tax_month3;
		$sanction->salb_tax_month4=$request->salb_tax_month4;
		$sanction->salb_tax_month5=$request->salb_tax_month5;
		$sanction->salb_tax_monthlatest=$request->salb_tax_monthlatest;
		$sanction->salb_tax_avg=$request->salb_tax_avg;
		$sanction->salb_od_month1=$request->salb_od_month1;
		$sanction->salb_od_month2=$request->salb_od_month2;
		$sanction->salb_od_month3=$request->salb_od_month3;	
		$sanction->salb_od_month4=$request->salb_od_month4;
		$sanction->salb_od_month5=$request->salb_od_month5;	
		$sanction->salb_od_monthlatest=$request->salb_od_monthlatest;	
		$sanction->salb_od_avg=$request->salb_od_avg;
		$sanction->salb_nmi_month1=$request->salb_nmi_month1;
		$sanction->salb_nmi_month2=$request->salb_nmi_month2;
		$sanction->salb_nmi_month3=$request->salb_nmi_month3;
		$sanction->salb_nmi_month4=$request->salb_nmi_month4;
		$sanction->salb_nmi_month5=$request->salb_nmi_month5;
		$sanction->salb_nmi_monthlatest=$request->salb_nmi_monthlatest;
		$sanction->salb_nmi_avg=$request->salb_nmi_avg;
		$sanction->salco_gi_month1=$request->salco_gi_month1;
		$sanction->salco_gi_month2=$request->salco_gi_month2;
		$sanction->salco_gi_month3=$request->salco_gi_month3;
		$sanction->salco_gi_month4=$request->salco_gi_month4;
		$sanction->salco_gi_month5=$request->salco_gi_month5;
		$sanction->salco_gi_monthlatest=$request->salco_gi_monthlatest;
		$sanction->salco_gi_avg=$request->salco_gi_avg;
		$sanction->salco_tax_month1=$request->salco_tax_month1;
		$sanction->salco_tax_month2=$request->salco_tax_month2;
		$sanction->salco_tax_month3=$request->salco_tax_month3;
		$sanction->salco_tax_month4=$request->salco_tax_month4;
		$sanction->salco_tax_month5=$request->salco_tax_month5;
		$sanction->salco_tax_monthlatest=$request->salco_tax_monthlatest;	
		$sanction->salco_tax_avg=$request->salco_tax_avg;	
		$sanction->salco_od_month1=$request->salco_od_month1;
		$sanction->salco_od_month2=$request->salco_od_month2;
		$sanction->salco_od_month3=$request->salco_od_month3;
		$sanction->salco_od_month4=$request->salco_od_month4;
		$sanction->salco_od_month5=$request->salco_od_month5;
		$sanction->salco_od_monthlatest=$request->salco_od_monthlatest;
		$sanction->salco_od_avg=$request->salco_od_avg;
		$sanction->salco_nmi_month1=$request->salco_nmi_month1;
		$sanction->salco_nmi_month2=$request->salco_nmi_month2;
		$sanction->salco_nmi_month3=$request->salco_nmi_month3;
		$sanction->salco_nmi_month4=$request->salco_nmi_month4;	
		$sanction->salco_nmi_month5=$request->salco_nmi_month5;
		$sanction->salco_nmi_monthlatest=$request->salco_nmi_monthlatest;
		$sanction->salco_nmi_avg=$request->salco_nmi_avg;
		$sanction->rent=$request->rent;
		$sanction->eligible_rental_income=$request->eligible_rental_income;	
		$sanction->other_monthly=$request->other_monthly;
		$sanction->eligible_other_income=$request->eligible_other_income;
		$sanction->disposal_gi_latest_itr=$request->disposal_gi_latest_itr;
		$sanction->disposal_gi_avg_itr=$request->disposal_gi_avg_itr;
		$sanction->disposal_d_latest_itr=$request->disposal_d_latest_itr;
		$sanction->disposal_d_avg_itr=$request->disposal_d_avg_itr;
		$sanction->disposal_niat_latest_itr=$request->disposal_niat_latest_itr;
		$sanction->disposal_niat_avg_itr=$request->disposal_niat_avg_itr;
		$sanction->disposal_otheremi_latest_itr=$request->disposal_otheremi_latest_itr;
		$sanction->disposal_otheremi_avg_itr=$request->disposal_otheremi_avg_itr;
		$sanction->disposal_niad_latest_itr=$request->disposal_niad_latest_itr;
		$sanction->disposal_niad_avg_itr=$request->disposal_niad_avg_itr;
		$sanction->disposal_grossi_latest_itr=$request->disposal_grossi_latest_itr;	
		$sanction->disposal_grossi_avg_itr=$request->disposal_grossi_avg_itr;	
		$sanction->disposable_income_latest_itr=$request->disposable_income_latest_itr;	
		$sanction->disposable_income_avg_itr=$request->disposable_income_avg_itr;	
		$sanction->reverse_loan_amt=$request->reverse_loan_amt;
		$sanction->reverse_interest=$request->reverse_interest;	
		$sanction->reverse_time_period=$request->reverse_time_period;	
		$sanction->reverse_emi=$request->reverse_emi;	
		$sanction->quantam_applicant=$request->quantam_applicant;	
		$sanction->quantam_coapplicant1=$request->quantam_coapplicant1;	
		$sanction->quantam_coapplicant2=$request->quantam_coapplicant2;
		$sanction->quantam_coapplicant3=$request->quantam_coapplicant3;	
		$sanction->max_quantam_homeloan=$request->max_quantam_homeloan;
		$sanction->max_age_months=$request->max_age_months;	
		$sanction->remaining_age=$request->remaining_age;	
		$sanction->max_eligible_term=$request->max_eligible_term;	
		$sanction->max_eligible_term_relex=$request->max_eligible_term_relex;	
		$sanction->repayment_capacity_interest_rate=$request->repayment_capacity_interest_rate;
		$sanction->no_of_months=$request->no_of_months;	
		$sanction->emi_per_lakhs=$request->emi_per_lakhs;	
		$sanction->eligible_avg_income=$request->eligible_avg_income;	
		$sanction->eligible_latest_income=$request->eligible_latest_income;	
		$sanction->ltv_mkt_property_val=$request->ltv_mkt_property_val;
		$sanction->cost_of_project=$request->cost_of_project;	
		$sanction->ltv_loan_amount=$request->ltv_loan_amount;	
		$sanction->ltv_value_consider=$request->ltv_value_consider;	
		$sanction->ltv_takeover=$request->ltv_takeover;	
		$sanction->eligible_ltv=$request->eligible_ltv;	
		$sanction->eligible_ltv_takeover=$request->eligible_ltv_takeover;	
		$sanction->eligible_max_home_loan_amt_avg=$request->eligible_max_home_loan_amt_avg;	
		$sanction->eligible_max_home_loan_amt_latest=$request->eligible_max_home_loan_amt_latest;	
		$sanction->calc_loan_amt=$request->calc_loan_amt;	
		$sanction->calc_interest_rate=$request->calc_interest_rate;	
		$sanction->calc_time_period=$request->calc_time_period;
		$sanction->calc_emi=$request->calc_emi;
		$sanction->save();
		
		
			$notification = array(
				'message' => 'Saved Successfully', 
				'alert-type' => 'success'
			);

		return redirect()->back()->with($notification);

	}
	
	public function getAllContact(Request $request){
		$user=Auth::user();
		if ($user!="") {
			$role=$user->role_id;
			if ($role!=1 && $role!=4) {
				return redirect('/');
			}
		}
		return view('admin.contact');
	}

	public function getAllContactData(Request $request){
		
		$contact=Contact::all();
		
		return DataTables::of($contact)->make(true);
	}


	public function getAddAdmin(){
		$user=Auth::user();
		if ($user!="") {
			$role=$user->role_id;
			if ($role!=1) {
				return redirect('/');
			}
		}
		return view('admin.admin.add');
	}
	public function postAddAdmin(Request $request)
	{	


		$name=$request->name;
		$email=$request->email;

		$contact_number=$request->contact_number;

		$password=Hash::make($request->password);

		$user=User::where('contact_number',$contact_number)->orWhere('email',$email)->first();

		if ($user!="") {

			$notification = array(
				'message' => 'Employee Exist, Please Login', 
				'alert-type' => 'success'
			);
			return redirect('admin/admin/all')->with($notification);
		}else{

			$user=new User();
			$user->name=$name;
			$user->email=$email;
			$user->contact_number=$contact_number;
			
			$user->designation=$request->designation;
			$user->doj=$request->doj;
			$user->job_location=$request->job_location;
				$user->is_verify=1;
			
			
				$user->present_address=$request->present_address;
			$user->company_address=$request->c_address;
			$user->g_address=$request->g_address;
			
			
				$user->guardian_contact_number=$request->guardian_contact_number;

			
			
			$user->password=$password;
			$user->role_id=4;
			$user->save();

			$notification = array(
				'message' => 'Employee Added Successfully', 
				'alert-type' => 'success'
			);

			return redirect('admin/admin/all')->with($notification);
		}
	}

		public function getAllAdmin(){
		    
		    
			$user=Auth::user();
			if ($user!="") {
				$role=$user->role_id;
				if ($role!=1) {
					return redirect('/');
				}
			}
			
			return view('admin.admin.all');
		}

		public function getAllAdminData(Request $request){
			$admin=User::where('role_id',4)->where('is_active',1)->get();
			return DataTables::of($admin)->make(true);
		}

		public function getEditAdmin(Request $request){
			$user=Auth::user();
			if ($user!="") {
				$role=$user->role_id;
				if ($role!=1) {
					return redirect('/');
				}
			}
			$admin_id=$request->id;
			$admin=User::find($admin_id);

			return view('admin.admin.edit')->with('admin',$admin);
		}

		public function postEditAdmin(Request $request,$id){



			$admin_id=$id;

			$name=$request->name;
			$email=$request->email;

			$contact_number=$request->contact_number;

			$password=Hash::make($request->password);

			$user=User::find($admin_id);
			$user->name=$name;
			$user->email=$email;
			$user->contact_number=$contact_number;
				$user->is_verify=1;
			
			if ($password!="") {
				$user->password=$password;
			}
			$user->role_id=4;
				$user->designation=$request->designation;
			$user->doj=$request->doj;
			$user->job_location=$request->job_location;
			
			
				$user->present_address=$request->present_address;
			$user->company_address=$request->c_address;
			$user->g_address=$request->g_address;
			
			
				$user->guardian_contact_number=$request->guardian_contact_number;

			$user->save();

			$notification = array(
				'message' => 'Employee Updated Successfully!', 
				'alert-type' => 'success'
			);

			return redirect('admin/admin/all')->with($notification);
		}



		public function getActiveAdmin(Request $request){
			$admin_id=$request->id;

			$admin=User::find($admin_id);
			if($admin!=""){
				$admin->is_active=0;
			}
			$admin->save();
			return redirect('admin/admin/all');
		}
		
		public function getDeleteAdmin(Request $request){
			$admin_id=$request->id;
		

			$admin=User::where('id',$admin_id)->first();
			
		$admin->is_active=0;
		
		$admin->save();
			
			$notification = array(
			'message' => 'Employee Deleted Successfully!', 
			'alert-type' => 'success'
		);
			return redirect('admin/admin/all')->with($notification);
		}
// 		public function getDeleteAdmin(Request $request){
// 			$admin_id=$request->id;
// 			$admin=User::find($admin_id);
// 			if($admin!=""){
// 				$admin->is_active=1;
// 			}
// 			$admin->save();
// 			return redirect('admin/admin/all');
// 		}
}
