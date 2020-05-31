<?php

namespace App;

use App\Classroom;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];

    public function formation()
    {
        return $this->morphTo();
    }

    public function classrooms()
    {
        return $this->morphTo();
    }

}
