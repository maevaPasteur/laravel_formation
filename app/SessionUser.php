<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    protected $table = 'session_user';

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
