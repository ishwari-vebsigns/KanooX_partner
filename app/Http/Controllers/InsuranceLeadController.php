<?php

namespace App\Http\Controllers;

use App\Models\InsuranceLead;
use App\Exports\InsuranceLeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class InsuranceLeadController extends Controller
{
    public function index()
    {
        $leads = InsuranceLead::latest()->paginate(10);
        return view('admin.Insurance_lead.insurances_page', compact('leads'));
    }

    public function export()
    {
        return Excel::download(
            new InsuranceLeadsExport,
            'insurance_leads_' . now()->format('d_m_Y') . '.xlsx'
        );
    }

     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,submitted,approved,rejected',
        ]);
 
        $lead = InsuranceLead::findOrFail($id);
        $lead->update(['status' => $request->status]);
 
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
