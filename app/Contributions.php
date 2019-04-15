<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    protected $guarded = [];
    
    public function childsponsors()
    {
        return $this->hasMany('App\ChildSponsor', 'id');
    }
}
