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

    /**
     * The categories that belong to the categorie.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
