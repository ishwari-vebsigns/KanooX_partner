<?php

namespace App\Http\Controllers;

use App\Models\MenuClick;
use App\Exports\MenuClickReportExport;
use Maatwebsite\Excel\Facades\Excel;

class MenuClickReportController extends Controller
{
    public function index()
    {
        $clicks = MenuClick::with('customer')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.reports.menu-clicks', compact('clicks'));
    }

    public function export()
    {
        return Excel::download(
            new MenuClickReportExport,
            'menu_click_report_' . now()->format('d_m_Y') . '.xlsx'
        );
    }
}
