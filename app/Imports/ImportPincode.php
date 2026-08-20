<?php

namespace App\Imports;

use App\Models\Pincode;
use App\Models\Bank;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportPincode implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        $bank1 = Bank::where('bank_name', $row[0])->first();
        // dd($row, $bank1);die;
        if($bank1 == null){
            $bank = new Bank();
            $bank->bank_name = $row[0];
            $bank->bank_url = Str::slug($row[0]);
            $bank->description = $row[3];
            $bank->is_active = 1;
            $bank->save();

            return new Pincode([
                'bank_id' =>$bank->bank_id,
                'pincode' =>$row[1],
                'status_id' =>$row[2],
             ]);
        }
        if($bank1 != null){
            $checkpincodes = Pincode::where('bank_id',$bank1->bank_id)->where('pincode', $row[1])->first();
           
            if($checkpincodes==null){
                // dd($bank1, $row[0], $row[1],$row[2]);
                return new Pincode([
                    'bank_id' =>$bank1->bank_id,
                    'pincode' =>$row[1],
                    'status_id' =>$row[2],
                 ]);  
            }


        }
        

        
      
      
    }
    public function chunkSize(): int
    {
        return 1000; // Set the desired chunk size
    }
}
