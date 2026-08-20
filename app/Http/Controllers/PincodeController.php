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
      
        // dd($request->all());
        $bank_id = $request->bank_id;
        $pin_code = $request->pincode;
         $validatedData = $request->validate([
            'bank_id' => 'required', 
            'pincode' => 'required|digits:6',    
        ]);
        $count = Pincode::where('bank_id', $validatedData['bank_id'])
        ->where('pincode', $validatedData['pincode'])
        ->count();
        if ($count > 0) {
            // Combination already exists, handle the validation error
            $errorMessage = 'The combination of bank and Pincode is already exists.';
            return redirect()->back()->withErrors([$errorMessage])->withInput();
        }
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
       
        $bank_id = $request->bank_id;
        $pin_code = $request->pincode;
         $validatedData = $request->validate([
            'bank_id' => 'required', 
            'pincode' => 'required|digits:6',    
        ]);
        $count = Pincode::where('bank_id', $validatedData['bank_id'])
        ->where('pincode', $validatedData['pincode'])
        ->where('pincode_id','!=', $id)
        ->count();
        if ($count > 0) {
            // Combination already exists, handle the validation error
            $errorMessage = 'The combination of bank and Pincode is already exists.';
            return redirect()->back()->withErrors([$errorMessage])->withInput();
        }
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
        //$pincodes = Pincode::with('bank')->get();
        $pincodes = Pincode::with('bank')
                    ->orderBy('pincode_id', 'DESC')
                    ->limit(100)
                    ->get();
        // dd($pincodes);die;
        return view('pincode.all')->with('pincodes', $pincodes);
    }
    public function getAllPincodedata(){
        if(!$this->checkPermission(Config::get('permissions.PINCODE_ALL'))){
			return view('admin.unauthorized');
		}
        
        //$pincodes = Pincode::with('bank')->get();
        $pincodes = Pincode::with('bank')
                    ->orderBy('pincode_id', 'DESC')
                    ->limit(100)
                    ->get();
       $data = [];
        // dd(Pincode::where('updated_at',null)->with('bank')->first());

    foreach ($pincodes as $pincode) {
        $data[] = [
            'pincode_id' => $pincode->pincode_id,
            //'bank_name' => $pincode->bank->bank_name,
            'bank_name' => optional($pincode->bank)->bank_name ?? 'N/A',
            'pincode' => $pincode->pincode,
            'updated_at' => $pincode->updated_at,
            'status_id' => $pincode->status_id
        ];
    }
        // dd($data);

    return response()->json(['data' => $data]);
    }
}
