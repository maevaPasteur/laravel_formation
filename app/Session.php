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

    public function classrooms()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
