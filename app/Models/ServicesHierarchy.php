<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesHierarchy extends Model
{
    public $primaryKey="service_hierarchy_id";

    protected $fillable = [
        'parent_service_id',
        'child_service_id',
        'sub_service_name',
        'sub_service_image',
        'sub_service_image_2', 
        'description',
        'status_id'
    ];

    public function main_services(){
      return $this->BelongsTo('App\Models\Service','service_id','child_service_id');
    }
    public function parent_service(){
		return $this->hasOne('App\Models\Service','service_id','parent_service_id');
    }
}
