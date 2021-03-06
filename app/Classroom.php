<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo('App\Session');
    }
}
