<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The formations that belong to the categorie.
    */
    public function formations()
    {
        return $this->belongsToMany('App\Formation');
    }
}
