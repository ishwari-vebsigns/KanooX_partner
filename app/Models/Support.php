<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public $primaryKey="support_id";

    public function user(){
		return $this->belongsTo('App\Models\User','agent_id','id');
	}
}
