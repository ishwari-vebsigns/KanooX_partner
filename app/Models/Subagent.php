<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subagent extends Model
{
    public $primaryKey="sub_agent_id";

    public function subagent(){
		return $this->BelongsTo('App\Models\User','new_subagent_id','id');
	}
  public function subagent_qr(){
		return $this->belongsTO('App\Models\AgentQr','new_subagent_id','agent_id');
	}
}
