<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PersonSeeder::class);
        $this->call(ChildSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(ChildSponsorSeeder::class);
        $this->call(ContributionsSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
