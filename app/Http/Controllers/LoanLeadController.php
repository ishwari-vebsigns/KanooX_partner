<?php

namespace App\Http\Controllers;

use App\Models\BasicInfo;
use App\Exports\LoanLeadsExport;
use Maatwebsite\Excel\Facades\Excel;

class LoanLeadController extends Controller
{
    public function index()
    {
        $leads = BasicInfo::latest()->paginate(10);
        return view('admin.loan-leads', compact('leads'));
    }

    public function export()
    {
        return Excel::download(
            new LoanLeadsExport,
            'loan_leads_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
}
