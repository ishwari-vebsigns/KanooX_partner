<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanService;
use App\Models\LoanServiceField;
use Illuminate\Support\Str;
use App\Models\ServicesHierarchy;

class LoanServiceController extends Controller
{
    // public function index()
    // {
    //     $services = LoanService::with('fields')->get();
    //     return view('admin.loan-services', compact('services'));
    // }
    public function index()
    {
        $services = LoanService::with('fields')->get();
    
        $childServices = ServicesHierarchy::where('status_id',1)->get();
    
        return view('admin.loan-services', compact('services','childServices'));
    }
    public function storeField(Request $request)
    {
        $data = $request->validate([
            'loan_service_id' => 'required|exists:loan_services,id',
            'field_label'     => 'required|string|max:100',
            'field_name'      => 'required|string|max:100',
            'field_type'      => 'required|in:text,number,select',
            'is_required'     => 'required|boolean',
            'options'         => 'nullable|string',
        ]);
        
        if ($data['field_type'] === 'select') {

        //  split by comma OR new line
        $rawOptions = preg_split('/[\n,]+/', $request->options);

        // trim + remove empty values
        $options = array_values(array_filter(array_map('trim', $rawOptions)));

        $data['options'] = $options; // <-- IMPORTANT (array, not json)
        } else {
            $data['options'] = null;
        }

        LoanServiceField::create($data);

        return redirect()->back()->with('success', 'Field added successfully');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'service_child_id' => 'required|exists:services_hierarchies,child_service_id',
            'is_active' => 'required|boolean',
        ]);

        $data['slug'] = \Str::slug($data['name']);

        LoanService::create($data);

        return redirect()->back()->with('success', 'Loan service added successfully');
    }
    public function toggleField($id)
    {
        $field = LoanServiceField::findOrFail($id);
    
        $field->is_active = !$field->is_active;
        $field->save();
    
        return redirect()->back()->with('success', 'Field status updated');
    }
    public function toggleService($id)
    {
        $service = LoanService::findOrFail($id);
    
        $service->is_active = !$service->is_active;
        $service->save();
    
        return redirect()->back()->with('success', 'Service status updated');
    }

}



