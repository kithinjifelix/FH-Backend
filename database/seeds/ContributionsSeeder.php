<?php

use App\Contributions;
use Illuminate\Database\Seeder;

class ContributionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Contributions::class, 10)->create();
    }
}
