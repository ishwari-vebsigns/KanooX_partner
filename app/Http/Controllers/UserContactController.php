<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Exports\ContactUsExport;
use Maatwebsite\Excel\Facades\Excel;

class UserContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);
        return view('admin.user-contacts.index', compact('contacts'));
    }

    public function export()
    {
        return Excel::download(
            new ContactUsExport,
            'contact_us_submissions_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
}
