<?php

namespace App\Exports;

use App\Models\Pincode;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPincode implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pincode::all();
    }
}
