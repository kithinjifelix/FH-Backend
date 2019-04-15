<?php

use Faker\Generator as Faker;

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName(),
        'middleName' => '',
        'lastName' => $faker->lastName(),
        'dob' => $faker->date(),
        'sex' => 'm',
        'registrationDate' => $faker->date(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
