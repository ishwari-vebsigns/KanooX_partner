<?php

namespace App\Exports;

use App\Models\LoanApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanApplicationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return LoanApplication::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Mobile',
            'Email',
            'PAN',
            'Loan Type',
            'Amount',
            'Term (Months)',
            'Profession',
            'Status',
            'Applied On',
        ];
    }

    public function map($app): array
    {
        return [
            $app->id,
            $app->full_name,
            $app->mobile,
            $app->email,
            $app->pan_card,
            $app->loan_type,
            $app->loan_amount,
            $app->loan_term,
            $app->profession_type,
            $this->statusText($app->status),
            $app->created_at->format('d-m-Y'),
        ];
    }

    private function statusText($status)
    {
        if ($status == -1) return 'Pending';
        if ($status == 1) return 'Approved';
        return 'Rejected';
    }
}
