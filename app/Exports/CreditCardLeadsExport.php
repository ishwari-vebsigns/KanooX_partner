<?php

namespace App\Exports;

use App\Models\CreditCardLead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CreditCardLeadsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return CreditCardLead::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Mobile',
            'PAN',
            'DOB',
            'Profession Type',
            'Annual Income',
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
            $lead->mobile,
            $lead->pan,
            $lead->dob,
            $lead->profession_type,
            $lead->annual_income,
            $lead->user_id ?? '-',
            $lead->sub_service_id ?? '-',
            $lead->created_at->format('d-m-Y'),
        ];
    }
}
