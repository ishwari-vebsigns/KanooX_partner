<?php

namespace App\Exports;

use App\Models\BasicInfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanLeadsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return BasicInfo::with('service')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Mobile',
            'Pincode',
            'Loan Type',
            'Loan Details',
            'User ID',
            'Created At',
        ];
    }

    public function map($lead): array
    {
        // ---- Handle dynamic fields ----
        $details = [];

        if (!empty($lead->dynamic_fields) && is_array($lead->dynamic_fields)) {
            foreach ($lead->dynamic_fields as $key => $value) {
                $label = ucwords(str_replace('_', ' ', $key));
                $details[] = $label . ': ' . ($value ?? '-');
            }
        } else {
            // ---- Fallback for old records ----
            if ($lead->company_name) {
                $details[] = 'Company: ' . $lead->company_name;
            }
            if ($lead->salary) {
                $details[] = 'Salary: ' . number_format($lead->salary, 2);
            }
            if ($lead->loan_amount) {
                $details[] = 'Loan Amount: ' . number_format($lead->loan_amount, 2);
            }
        }

        return [
            $lead->id,
            $lead->customer_name,
            $lead->contact_no,
            $lead->pincode,
            optional($lead->service)->name ?? '-',
            implode(' | ', $details) ?: '-',
            $lead->user_id ?? '-',
            $lead->created_at->format('d-m-Y'),
        ];
    }
}
