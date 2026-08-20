<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDepartment extends Model
{
    protected $table = "product_departments";
    public $primaryKey = "product_department_id";

    public function departments(){
    	return $this->belongsTo('App\Department','department_id','department_id');
    }

    public function products(){
    	return $this->belongsTo('App\Product','product_id','product_id');
    }
}
