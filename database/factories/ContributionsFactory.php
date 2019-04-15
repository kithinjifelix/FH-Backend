<?php

use Faker\Generator as Faker;

$factory->define(App\Contributions::class, function (Faker $faker) {
    return [
        'childSponsorId'=>function () {
            return factory(App\ChildSponsor::class)->create()->id;
        },
        'amount'=>$faker->randomDigit(),
        'contributionDate'=>$faker->date(),
    ];
});
