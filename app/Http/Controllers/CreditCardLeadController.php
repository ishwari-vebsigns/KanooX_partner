<?php

namespace App\Http\Controllers;

use App\Models\CreditCardLead;
use App\Exports\CreditCardLeadsExport;
use Maatwebsite\Excel\Facades\Excel;

class CreditCardLeadController extends Controller
{
    public function index()
    {
        $leads = CreditCardLead::latest()->paginate(10);
        return view('admin.credit-card-leads', compact('leads'));
    }

    public function export()
    {
        return Excel::download(
            new CreditCardLeadsExport,
            'credit_card_leads_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
}
