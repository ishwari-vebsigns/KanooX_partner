<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $primaryKey="comment_id";
      protected $table="comments";

      public function username()
    {
        return $this->belongsTo('App\Models\User','message_user_id','id');
    }
}
