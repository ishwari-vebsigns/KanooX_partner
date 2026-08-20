<?php

namespace App\Exports;

use App\Models\BankClick;
use Maatwebsite\Excel\Concerns\FromCollection;

class BankClickExport implements FromCollection
{
    public function collection()
    {
        return BankClick::latest()->get();
    }
}