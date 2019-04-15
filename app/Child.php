<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    public function persons()
    {
        return $this->hasOne(Person::class , 'id')->with('persons');
    }

    public function person()
    {
        return $this->belongsTo('App\Person','personId');
    }
}
