<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function attendees()
    {
        return $this->hasMany('App\Registration');
    }
}
