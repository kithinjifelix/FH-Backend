<?php

use App\ChildSponsor;
use Illuminate\Database\Seeder;

class ChildSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ChildSponsor::class, 10)->create();
    }
}
