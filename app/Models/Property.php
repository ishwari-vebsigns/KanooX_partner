<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $primaryKey="property_id";
     public function getamenities()
    {
    	return $this->hasMany('App\Models\Amenity','property_id','property_id');
    }
     public function propertyimages()
    {
    	return $this->hasMany('App\Models\PropertyImages','property_id','property_id');
    }
}
