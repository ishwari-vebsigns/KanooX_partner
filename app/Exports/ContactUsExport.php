<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactUsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Contact::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Message',
            'Created At',
        ];
    }

    public function map($contact): array
{
    return [
        $contact->id,
        $contact->name,
        $contact->email,
        $contact->phone,
        $contact->message,
        $contact->created_at
            ? $contact->created_at->format('d-m-Y')
            : '-',
    ];
}

}
