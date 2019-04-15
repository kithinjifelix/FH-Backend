<?php

namespace Tests\Feature;

use App\Person;
use App\Child;
use App\Sponsor;
use App\ChildSponsor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChildSponsorTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_will_show_all_childsponsors()
    {
        $childsponsors = factory(ChildSponsor::class, 10)->create();

        $response = $this->get(route('childrensponsors.index'));

        $response->assertStatus(200);

        $response->assertJson($childsponsors->toArray());
    }

    /** @test */
    public function it_will_create_Child_Sponsor()
    {
        $children = factory(Child::class, 10)->create();
        $sponsors = factory(Sponsor::class, 10)->create();
        $child = Child::all()->first();
        $sponsor = Sponsor::all()->first();

        $response = $this->post(route('childrensponsors.store'), [
            'childId'=>$child->id,
            'sponsorId'=>$sponsor->id,
            'deleteFlag'=>false
        ]);

        $response->assertStatus(200);
    }
}
