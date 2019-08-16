<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $table = 'member';

    protected $guarded = [];

    public function attendees()
    {
        return $this->hasMany('App\Registration');
    }
}
