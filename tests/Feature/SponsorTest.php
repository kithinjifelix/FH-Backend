<?php

namespace Tests\Feature;

use App\Person;
use App\Sponsor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SponsorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_create_a_Sponsor()
    {
        $persons = factory(Person::class, 10)->create();
        $person = Person::all()->first();
        if($person){
            $sponsor = new Sponsor();
            $sponsor->personId = $person->id;
            $sponsor->deleteFlag = false;
            $sponsor->save();

            $this->assertInstanceOf(Sponsor::class, $sponsor);
        }
    }

     /** @test */
     public function it_will_update_a_Sponsor()
     {
        $persons = factory(Person::class, 10)->create();
        $person = Person::all()->first();
        if($person){
            $sponsor = new Sponsor();
            $sponsor->personId = $person->id;
            $sponsor->deleteFlag = true;
            $sponsor->save();

            $sponsor = $sponsor->fresh();

            $this->assertEquals($sponsor->deleteFlag, true);
        }
     }
}
