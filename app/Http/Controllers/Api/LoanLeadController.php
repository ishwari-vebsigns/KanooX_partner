<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoanLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_service_id'     => 'required',
            'sub_service_id'      => 'required',
            'national_id'         => 'required',
            'income'              => 'required|numeric',
            'contact_no'          => 'required',
            'customer_name'       => 'required',
            'pincode'             => 'required',
            'profession_type'     => 'required',
            'tenure'              => 'required',
            'loan_amount'         => 'required|numeric',
            'bank_name'           => 'required',
            'document_type'       => 'required',
            'email'               => 'required|email',
            'document_front_image'=> 'required|file|image',
            'document_back_image' => 'required|file|image',
        ]);

        // Files upload karo
        $frontPath = $request->file('document_front_image')->store('loan_documents', 'public');
        $backPath  = $request->file('document_back_image')->store('loan_documents', 'public');

        $lead = BasicInfo::create([
            'loan_service_id' => $validated['loan_service_id'],
            'sub_service_id'  => $validated['sub_service_id'],
            'customer_name'   => $validated['customer_name'],
            'contact_no'      => $validated['contact_no'],
            'pincode'         => $validated['pincode'],
            'email'           => $validated['email'],
            'document_type'   => $validated['document_type'],
            'document_front_image' => Storage::url($frontPath),
            'document_back_image'  => Storage::url($backPath),
            'dynamic_fields'  => json_encode([
                'profession_type' => $validated['profession_type'],
                'national_id'     => $validated['national_id'],
                'income'          => $validated['income'],
                'loan_amount'     => $validated['loan_amount'],
                'tenure'          => $validated['tenure'],
                'bank_name'       => $validated['bank_name'],
            ]),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Loan lead submitted successfully',
            'next_step' => 'banks',
            'sub_service_id' => $validated['sub_service_id'],
            'email' => $validated['email'],
            'data'  => $lead,
        ]);
    }
}