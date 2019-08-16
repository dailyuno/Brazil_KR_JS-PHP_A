<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
