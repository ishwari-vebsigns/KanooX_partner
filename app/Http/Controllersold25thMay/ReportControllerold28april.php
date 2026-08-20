<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
Use Hash;
use App\Models\Userloan;
use App\Models\Loan;



use Illuminate\Http\Request;

class ReportController extends Controller
{
	public function getcommisionreport(){
        // dd();
        return view('admin.commision-report');
    }
    public function getcustomerreport(){
        $loans = Loan::all();
        // dd($loans);
        return view('admin.customer-report')->with('loans',$loans);
    }
    
}
