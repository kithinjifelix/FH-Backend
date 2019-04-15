<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function persons()
    {
        return $this->hasOne(Person::class,  'id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person','personId');
    }
}
