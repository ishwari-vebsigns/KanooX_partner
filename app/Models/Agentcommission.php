<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agentcommission extends Model
{
    public $primaryKey="agent_commission_id";
   public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_id','bank_id');
    }
    public function sub_service()
    {
        return $this->belongsTo('App\Models\Service','sub_service_id','service_id');
    }
    public function agent()
    {
        return $this->belongsTo('App\Models\Role','role_id','role_id');
    }
}
