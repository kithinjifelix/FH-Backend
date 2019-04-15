<?php

namespace Tests\Feature;

use App\Person;
use App\Child;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChildTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_create_a_Child()
    {
        $persons = factory(Person::class, 10)->create();
        $person = Person::all()->first();
        if($person){
            $child = new Child();
            $child->personId = $person->id;
            $child->deleteFlag = false;
            $child->save();

            $this->assertInstanceOf(Child::class, $child);
        }
    }

     /** @test */
     public function it_will_update_a_Child()
     {
        $persons = factory(Person::class, 10)->create();
        $person = Person::all()->first();
        if($person){
            $child = new Child();
            $child->personId = $person->id;
            $child->deleteFlag = true;
            $child->save();

            $child = $child->fresh();

            $this->assertEquals($child->deleteFlag, true);
        }
     }
}
