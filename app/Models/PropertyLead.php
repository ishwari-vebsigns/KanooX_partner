<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyLead extends Model
{
    public $primaryKey="property_lead_id";
    protected $table ="property_leads"; 
    
     public function properties()
    {
    	return $this->belongsTo('App\Models\Property','property_id','property_id');
    }
}
