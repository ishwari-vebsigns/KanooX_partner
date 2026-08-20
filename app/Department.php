<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    public $primaryKey = "department_id";
    public function categories(){
    	return $this->belongsTo('App\Category','category_id','category_id');
    }
}
