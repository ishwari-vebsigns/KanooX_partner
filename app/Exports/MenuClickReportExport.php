<?php

namespace App\Exports;

use App\Models\MenuClick;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MenuClickReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return MenuClick::with('customer')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Email',
            'Mobile',
            'Menu Type',
            'Item',
            'Click Count',
            'IP Address',
            'Last Clicked',
        ];
    }

    public function map($click): array
    {
        return [
            $click->id,
            $click->customer->name ?? 'Guest',
            $click->customer->email ?? '-',
            $click->customer->phone ?? '-',
            ucfirst($click->menu_type),
            str_replace('_', ' ', $click->item),
            $click->click_count,
            $click->ip_address,
            $click->updated_at->format('d-m-Y H:i'),
        ];
    }
}
