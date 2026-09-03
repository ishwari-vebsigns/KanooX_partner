<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InsuranceLead;
use App\Models\Bank;
use App\Models\Service;
use App\Exports\InsuranceLeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class InsuranceLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub_service_id'      => 'required|integer|exists:services,service_id',
            'bankid'              => 'required|integer|exists:banks,bank_id',
            'customer_name'       => 'required|string',
            'gender'              => 'required|string',
            'dob'                 => 'required|date',
            'contact_no'          => 'required|string',
            'email'               => 'nullable|email',
            'national_id'         => 'nullable|string',
            'terms_accepted'      => 'required|boolean',
        ]);

        $additionalDetails = $request->only([
            'medical_history',
            'existing_medical_condition',
            'coverage_amount',
            'nominee_name',
            'current_medications',
            'previous_insurance_details',
            'annual_income',
            'relationship_with_beneficiary',
        ]);

        $lead = InsuranceLead::create([
            'name'                => $validated['customer_name'],
            'gender'              => $validated['gender'],
            'dob'                 => $validated['dob'],
            'mobile'              => $validated['contact_no'],
            'email'               => $validated['email'] ?? null,
            'national_id_number'  => $validated['national_id'] ?? null,
            'bankid'              => $validated['bankid'],
            'sub_service_id'      => $validated['sub_service_id'],
            'terms_accepted'      => $validated['terms_accepted'],
            'additional_details'  => array_filter($additionalDetails),
            'user_id'             => auth()->id() ?? null,
        ]);

        return response()->json([
            'success'      => true,
            'reference_id' => $lead->reference_id,
            'message'      => 'Insurance application submitted successfully.',
        ], 201);
    }

    // Optional: Insurance companies list dikhane ke liye (Screen 3 - "Compare Insurance")
    public function companies($subServiceId)
    {
        $companies = \App\Models\Bank::where('sub_service_id', $subServiceId)
                        ->where('is_active', 1)
                        ->get(['bank_id', 'bank_name', 'bank_image', 'description']);

        return response()->json(['success' => true, 'data' => $companies]);
    }

    // Optional: user apni leads dekh sake (History screen)
    public function myLeads(Request $request)
    {
        $leads = InsuranceLead::with('insuranceCompany', 'subService')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return response()->json(['success' => true, 'data' => $leads]);
    }

    public function index()
    {
        $leads = InsuranceLead::with('insuranceCompany', 'subService')->latest()->paginate(10);
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
