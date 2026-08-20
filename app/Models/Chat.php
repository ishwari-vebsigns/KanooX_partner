<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $primaryKey="chat_id";
    public function username()
    {
        return $this->belongsTo('App\Models\User','message_user_id','id');
    }
}
