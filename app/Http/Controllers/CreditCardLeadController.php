<?php

namespace App\Http\Controllers;

use App\Models\CreditCardLead;
use App\Exports\CreditCardLeadsExport;
use Illuminate\Http\Request;
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
    public function updateStatus(Request $request, CreditCardLead $lead)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,completed',
        ]);

        $lead->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }
}
