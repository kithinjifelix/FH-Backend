<?php

use Faker\Generator as Faker;

$factory->define(App\Child::class, function (Faker $faker) {
    return [
        'personId' => function () {
            return factory(App\Person::class)->create()->id;
        },
        'deleteFlag'=>false
    ];
});
