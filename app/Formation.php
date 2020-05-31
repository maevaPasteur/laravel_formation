<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sessions()
    {
    return $this->morphMany('App\Session', 'formation')->lastest();
    }
}
