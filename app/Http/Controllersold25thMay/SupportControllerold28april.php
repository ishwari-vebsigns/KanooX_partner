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
use App\Models\Support;



class SupportController extends Controller
{
    public function getedithelpandSupport(Request $request){
        $id = $request->id;
        $support = Support::where('support_id', $id)->with('user')->first();
        $comments = Comment::where('support_id', $id)->with('username')->get();
        // dd($comments);
        return view('help-support.details')->with('support', $support)->with('comments', $comments);
    }
    public function postedithelpandSupport(Request $request){
        // dd($request->all(), $request->id);
        $id = $request->id;
        $comment1 = $request->comment;
        $user_id = Auth::user()->id;
        $comment = new Comment();
        $comment->support_id = $id;
        $comment->message_user_id = $user_id;
        $comment->commentname = $comment1;
        $comment->save();
        $request->session()->put('success',"Comment Sent Successfully!!");
        return redirect('admin/help&support/'.$id);
        // $support = Support::where('support_id', $id)->with('user')->first();
        // $comments = Comment::where('support_id', $id)->with('username')->get();
        // dd($support);
    }
    public function getagentcomplaint(){
        $services = Service::where('is_main_service', 1)->get();
        $subservices = Service::where('is_main_service', 0)->get();
       
		return view('admin.help-support')->with('services', $services)->with('subservices', $subservices);
    }
    public function postagentcomplaint(Request $request){
        // dd($request->all(), Auth::user()->id);die;
        $agent_id = Auth::user()->id;
        $transaction_id = $request->trans_id;
        $service_id = $request->service_id;
        $sub_service_id = $request->sub_service_id;
        $comment = $request->comment;
        $message = $request->message;

        $support = new Support();
        $support->agent_id = $agent_id;
        $support->service_id = $service_id;
        $support->sub_service_id = $sub_service_id;
        $support->comment = $comment;
        $support->message = $message;
        
        if($request->file_image!=""){
            $file_image = $request->file_image;
            $path = $file_image->store('Support-files');
            $support->file_image=$path;
        }
         
        $support->save();
        $comment = new Comment();
        $comment->support_id = $support->support_id;
        $comment->message_user_id = $agent_id;
        $comment->commentname = $message;
        // dd($comment, $support);
        $comment->save();
		$request->session()->put('success',"Complaint & comment Sent Successfully!!");
        return redirect('admin/support');
        
    }
    public function gethelpandSupport(){
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        if($role_id == 1){
		$supports = Support::with('user')->get();
        }
        if($role_id == 2){
        $supports = Support::where('agent_id',$user_id)->with('user')->get();
        // dd($supports);
        }
		return view('help-support.all')->with('supports', $supports);
	}
	public function gethelpandSupportData(){
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;
        if($role_id == 1){
		$support = Support::with('user')->get();
        }
        if($role_id == 2){
        $support = Support::where('agent_id',$user_id)->with('user')->get();
        // dd($support);
        }
        return DataTables::of($support)->make(true);

	}
}
