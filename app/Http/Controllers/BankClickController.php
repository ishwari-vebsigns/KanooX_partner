<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exports\BankClickExport;
use Maatwebsite\Excel\Facades\Excel;

class BankClickController extends Controller
{
    public function index()
    {
        $clicks = DB::table('bank_clicks')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bank-clicks', compact('clicks'));
    }
    public function export()
    {
        return Excel::download(new BankClickExport, 'bank_clicks.xlsx');
    }
}