<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildSponsor extends Model
{
    protected $guarded = [];
    
    public function children()
    {
        return $this->hasMany(Child::class, 'id');
    }

    public function SponsorChildren()
    {
        return $this->belongsTo('App\Child','childId');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'id');
    }

    public function Sponsor()
    {
        return $this->belongsTo('App\Sponsor','sponsorId');
    }
}
