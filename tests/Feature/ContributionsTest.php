<?php

namespace Tests\Feature;

use App\Contributions;
use App\ChildSponsor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContributionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_show_all_contributions()
    {
        $contributions = factory(Contributions::class, 10)->create();

        $response = $this->get(route('contributions.index'));

        $response->assertStatus(200);

        $response->assertJson($contributions->toArray());
    }

    /** @test */
    public function it_will_create_childcontributions()
    {
        $childSponsors = factory(ChildSponsor::class, 10)->create();
        $childsponsor = ChildSponsor::all()->first();

        $response = $this->post(route('contributions.store'), [
            'childSponsorId' => $childsponsor->id,
            'amount'=>'100',
            'contributionDate'=>'2019-01-01'
        ]);

        $response->assertStatus(200);
    }
}
