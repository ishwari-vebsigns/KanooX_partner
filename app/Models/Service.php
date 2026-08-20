<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $primaryKey="service_id";
    
    public function main_services(){
      return $this->BelongsTo('App\Models\ServicesHierarchy','child_service_id','service_id');
    }
  public function child_services(){
		return $this->hasMany('App\Models\ServicesHierarchy','parent_service_id','service_id');
	}
  public function service(){
      return $this->BelongsTo('App\Models\ServicesHierarchy','service_id','child_service_id');
    }
}
