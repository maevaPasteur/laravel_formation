<?php

namespace App;

use App\Classroom;
use App\Report;

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

    /**
     * Get the report record associated with the session.
     */
    public function report()
    {
        return $this->hasOne('App\Report');
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
