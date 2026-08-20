<?php

namespace App\Http\Controllers;
use App\Models\Bank;
use App\Models\Pincode;
use App\Exports\ExportPincode;
use App\Imports\ImportPincode;
use Config;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DataTables;

class PincodeController extends Controller
{
    public function importView(Request $request){

        return view('admin.importFile');
    }
    public function importPincode(Request $request){
        // dd($request->all());
        Excel::import(new ImportPincode, $request->file('file')->store('files'));
        return redirect()->back();
    }
    public function exportPincode(Request $request){
        return Excel::download(new ExportPincode, 'pincodes.xlsx'); 

    }
    public function getAddPincode(){
        if(!$this->checkPermission(Config::get('permissions.PINCODE_ADD'))){
			return view('admin.unauthorized');
		}
        $banks = Bank::where('is_active',1)->get();
        return view('pincode.add')->with('banks', $banks);
    }
    public function postAddPincode(Request $request){
        $request->validate([
			'bank_id' => 'required', 
			'pincode' => 'required|digits:6',    
	]);
        // dd($request->all());
        $bank_id = $request->bank_id;
        $pin_code = $request->pincode;
        $pincode = new Pincode();
        $pincode->bank_id = $bank_id;
        $pincode->pincode = $pin_code;
        $pincode->status_id = 1;
        $pincode->save();
		$request->session()->put('success',"Pincode added Successfully!!");
        return Redirect('admin/pincode/all');
    }
    public function getEditPincode(Request $request){
        if(!$this->checkPermission(Config::get('permissions.PINCODE_DETAILS'))){
			return view('admin.unauthorized');
		}
        $id = $request->id;
        $banks = Bank::where('is_active',1)->get();
        $pincode = Pincode::where('pincode_id',$id)->first();
        return view('pincode.details')->with('banks', $banks)->with('pincode', $pincode);
    }
    public function postEditPincode(Request $request){
        $id = $request->id;
        // $banks = Bank::where('is_active',1)->get();
        $request->validate([
			'bank_id' => 'required', 
			'pincode' => 'required|digits:6',    
	    ]);
        $bank_id = $request->bank_id;
        $pin_code = $request->pincode;
        if(isset($request['save'])){
        $pincode = Pincode::where('pincode_id',$id)->first();
        $pincode->bank_id = $bank_id;
        $pincode->pincode = $pin_code;
        $pincode->save();
		$request->session()->put('success',"Pincode updated Successfully!!");
        }

        if(isset($request['active'])){
        $pincode = Pincode::where('pincode_id',$id)->first();
        $pincode->status_id = 1;
        $pincode->save();
		$request->session()->put('success',"Pincode activated Successfully!!");
        }

        if(isset($request['inactive'])){
        $pincode = Pincode::where('pincode_id',$id)->first();
        $pincode->status_id = 0;
        $pincode->save();
		$request->session()->put('success',"Pincode inactivated Successfully!!");
        }

        return Redirect('admin/pincode/all');
    }
    public function getAllPincode(){
        if(!$this->checkPermission(Config::get('permissions.PINCODE_ALL'))){
			return view('admin.unauthorized');
		}
        $pincodes = Pincode::with('');
        $pincodes = Pincode::with('bank')->get();
        return view('pincode.all')->with('pincodes', $pincodes);
    }
    public function getAllPincodedata(){
        if(!$this->checkPermission(Config::get('permissions.PINCODE_ALL'))){
			return view('admin.unauthorized');
		}
        
        $pincodes = Pincode::with('bank')->get();
        return DataTables::of($pincodes)->make(true);
    }
}
