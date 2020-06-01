<?php

namespace App;

use App\Classroom;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];

    public function formation()
    {
        return $this->belongsTo('App\Formation');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function session_users()
    {
        return $this->hasMany('App\SessionUser');
    }

    public function getNote()
    {
        return "STFU" ;
    }
}
