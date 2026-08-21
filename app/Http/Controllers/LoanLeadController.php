<?php

namespace App\Http\Controllers;

use App\Models\BasicInfo;
use App\Exports\LoanLeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,completed',
        ]);

        $lead = BasicInfo::findOrFail($id);
        $lead->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}