<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];

    public function children()
    {
        return $this->hasOne(Child::class , 'personId');
    }

    public function sponsors()
    {
        return $this->hasOne(Sponsor::class, 'personId');
    }
}
