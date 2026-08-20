<?php

namespace App\Http\Controllers;

use App\Models\InsuranceLead;
use App\Exports\InsuranceLeadsExport;
use Maatwebsite\Excel\Facades\Excel;

class InsuranceLeadController extends Controller
{
    public function index()
    {
        $leads = InsuranceLead::latest()->paginate(10);
        return view('admin.insurance-leads', compact('leads'));
    }

    public function export()
    {
        return Excel::download(
            new InsuranceLeadsExport,
            'insurance_leads_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
}
