<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ========================
       RELATIONSHIPS (UNCHANGED)
       ======================== */

    public function user_role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'role_id');
    }

    public function agent_loan()
    {
        return $this->hasMany('App\Models\Loan', 'agent_id', 'id');
    }

    public function agent_qr()
    {
        return $this->belongsTo('App\Models\AgentQr', 'id', 'agent_id');
    }

    public function wallet()
    {
        return $this->hasMany('App\Models\Wallet', 'agent_id', 'id');
    }

    // public function bankdetail(){
    //     return $this->belongsTO('App\Models\BankDetail','id','user_id');
    // }
}
