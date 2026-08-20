<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAgent implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('new_id','agent_access_code','name','email','kyc_status')->where('new_id','!=',null)->orderBy('created_at','desc')->get();
        // return User::where('new_id','!=',null)->orderBy('created_at','desc')->with('agent_loan')->get();
    }
}
