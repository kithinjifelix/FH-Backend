<?php

use Faker\Generator as Faker;

$factory->define(App\ChildSponsor::class, function (Faker $faker) {
    return [
        'childId'=>function () {
            return factory(App\Child::class)->create()->id;
        },
        'sponsorId'=>function () {
            return factory(App\Sponsor::class)->create()->id;
        },
        'deleteFlag'=>false
    ];
});
