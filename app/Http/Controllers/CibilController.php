<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CibilExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CreditReport;

class CibilController extends Controller
{
    // LIST PAGE
        public function index(Request $request)
        {
            $query = DB::table('credit_reports');

            if ($request->filled('search')) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%")
                    ->orWhere('pan', 'like', "%{$search}%")
                    ->orWhere('credit_score', 'like', "%{$search}%");
                });
            }

            // Date filter
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }

            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }

            $reports = $query->orderBy('id', 'desc')->paginate(10);

            return view('admin.cibil.index', compact('reports'));
        }

        // DETAILS PAGE
        public function show($id)
        {
            $report = DB::table('credit_reports')->where('id', $id)->first();
        
            if (!$report) {
                abort(404);
            }
        
            $full = json_decode($report->full_response, true);
        
            
            $credit = $full['score']['data']['credit_report'] ?? [];
        
            return view('admin.cibil.details', compact('report', 'credit'));
        }

        public function export(Request $request)
        {
            return Excel::download(new CibilExport(
                    $request->search,
                    $request->from_date,
                    $request->to_date
                ),
                'cibil_reports.xlsx'
            );
        }
}







