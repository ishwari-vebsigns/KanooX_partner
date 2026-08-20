<?php

namespace App\Exports;

use App\Models\InsuranceLead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InsuranceLeadsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return InsuranceLead::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Gender',
            'DOB',
            'Mobile',
            'User ID',
            'Sub Service ID',
            'Created At',
        ];
    }

    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->name,
            ucfirst($lead->gender),
            $lead->dob,
            $lead->mobile,
            $lead->user_id ?? '-',
            $lead->sub_service_id ?? '-',
            $lead->created_at->format('d-m-Y'),
        ];
    }
}
