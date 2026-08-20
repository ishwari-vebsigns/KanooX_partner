<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //



    protected $table = 'contacts';
    public $timestamps=true;
    

  
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
    
    public static $contactRules=[
        'email'=>'required|regex:/^.+@.+\..+$/i',
        'name'=>'required',
        'phone'=>'required|max:11|min:10',
        'message'=>'required'
        
       ];
}
