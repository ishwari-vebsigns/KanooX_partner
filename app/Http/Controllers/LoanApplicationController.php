<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Exports\LoanApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;
    
class LoanApplicationController extends Controller
{
    public function index()
    {
        $applications = LoanApplication::with('customer','loanType')
            ->latest()
            ->paginate(10);

        return view('admin.loan-applications', compact('applications'));
    }

    public function export()
    {
        return Excel::download(
            new LoanApplicationsExport,
            'loan_applications_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
    public function showDocumentUploadForm($id)
    {
        $application = LoanApplication::findOrFail($id);
    
        return view('admin.loan-application-documents', compact('application'));
    }
    public function uploadDocuments(Request $request, $id)
    {
        $request->validate([
            'aadhaar_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pan_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'income_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        $application = LoanApplication::findOrFail($id);
    
        //  Aadhaar
        if ($request->hasFile('aadhaar_document')) {
            $application->aadhaar_document =
                $request->file('aadhaar_document')->store('aadhaar');
        }
    
        //  PAN
        if ($request->hasFile('pan_document')) {
            $application->pan_document =
                $request->file('pan_document')->store('pan');
        }
    
        //  Income Certificate
        if ($request->hasFile('income_certificate')) {
            $application->income_certificate =
                $request->file('income_certificate')->store('income');
        }
        if (
            $application->aadhaar_document &&
            $application->pan_document &&
            $application->income_certificate
        ) {
            $application->status = 1; // Documents Uploaded
        }
    
        $application->save();
        $this->sendSMS($application->mobile, "Documents Uploaded Successfully");

        $mailData = [
            'type' => 'congrats',
            'title' => 'Documents Uploaded Successfully',
            'body' => $application->full_name,
            'content' => 'Your documents have been successfully uploaded. Our team will now review your loan application.'
        ];
        
        Mail::to($application->email)->send(new MailNotify($mailData));
        
        Http::post('https://loansarovar.com/api/send-notification',[
            'customer_id' => $application->user_id,
            'title' => 'Documents Uploaded',
            'message' => 'Your documents uploaded successfully.'
        ]);

    
        return back()->with('success', 'Documents uploaded successfully');
    }
    public function toggleApproval($id)
    {
        
        $application = LoanApplication::findOrFail($id);
        //dd($application->user_id);
        if ($application->status == 3) {
            return back()->with('error', 'Rejected application cannot be approved');
        }
        //  Cannot approve without documents
        if (
            !$application->aadhaar_document ||
            !$application->pan_document ||
            !$application->income_certificate
        ) {
            return back()->with('error', 'Upload all required documents before approval');
        }
    
        // Approve
        $application->is_approved = 1;
        $application->approved_by = Auth::id();
        $application->status = 2; //  Approved
    
        $application->save();
        $this->sendSMS($application->mobile, "Approved");

        $mailData = [
            'type' => 'congrats',
            'title' => 'Loan Approved 🎉',
            'body' => $application->full_name,
            'content' => 'Congratulations! Your loan application has been approved. Our team will contact you shortly with further details.'
        ];
        
        Mail::to($application->email)->send(new MailNotify($mailData));
        
    //   $response= Http::post('https://loansarovar.com/api/send-notification',[
    //         'customer_id' => $application->user_id,
    //         'title' => 'Loan Approved 🎉',
    //         'message' => 'Congratulations! Your loan application has been approved.'
    //     ]);
        //dd($response->body());
Http::asForm()->post('https://loansarovar.com/api/send-notification',[
    'customer_id' => $application->user_id,
    'title' => 'Loan Approved 🎉',
    'message' => 'Congratulations! Your loan application has been approved.'
]);
    
        return back()->with('success', 'Loan approved successfully');
    }
    public function reject($id)
    {
        $application = LoanApplication::findOrFail($id);
        if ($application->status == 2) {
            return back()->with('error', 'Approved application cannot be rejected');
        }

        // Already rejected not to  reject again
        if ($application->status == 3) {
            return back()->with('error', 'Application already rejected');
        }
    
        
    
        $application->status = 3; // Rejected
        $application->is_approved = 0;
        $application->approved_by = Auth::id();
        $application->save();
    
        $this->sendSMS($application->mobile, "Rejected");
    
        $mailData = [
            'type' => 'reject',
            'title' => 'Loan Application Rejected',
            'body' => $application->full_name,
            'content' => 'We regret to inform you that your loan application has been rejected. Please contact support for more details.'
        ];
    
        Mail::to($application->email)->send(new MailNotify($mailData));
        
        // Http::post('https://loansarovar.com/api/send-notification',[
        //     'customer_id' => $application->user_id,
        //     'title' => 'Loan Application Rejected',
        //     'message' => 'Your loan application has been rejected. Please contact support.'
        // ]);
        Http::asForm()->post('https://loansarovar.com/api/send-notification',[
    'customer_id' => $application->user_id,
    'title' => 'Loan Application Rejected',
    'message' => 'Your loan application has been rejected. Please contact support.'
]);
    
        return back()->with('success', 'Loan rejected successfully');
    }
    public function viewDocument($id, $type)
    {
        $application = LoanApplication::findOrFail($id);
    
        $path = match ($type) {
            'aadhaar' => $application->aadhaar_document,
            'pan' => $application->pan_document,
            'income' => $application->income_certificate,
            default => abort(404),
        };
    
        if (!$path || !Storage::exists($path)) {
            abort(404);
        }
    
        return response()->file(storage_path('app/'.$path));
    }
    
    private function sendSMS($mobile, $status)
    {
        $apiKey = "7b70ba79-fdd8-11f0-a6b2-0200cd936042";
    
        $message = "Dear Customer, your application is {$status}. -Sarvodaya Solutions Private Limited";

    
        $response = \Illuminate\Support\Facades\Http::asForm()->post(
            "https://2factor.in/API/R1/",
            [
                'module' => 'TRANS_SMS',
                'apikey' => $apiKey,
                'to' => '91' . $mobile,
                'from' => 'SRVDSP',
                'msg' => $message,
                'ctid' => '1107177132397312328',
                
            ]
        );
    
        \Log::info('2Factor SMS Response: ' . $response->body());
    }


}







