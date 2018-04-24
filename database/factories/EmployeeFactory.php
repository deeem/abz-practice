<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position' => $faker->jobTitle,
        'hired' => $faker->dateTimeInInterval('-3 years', '- 5 days', null),
        'salary' => $faker->numberBetween(200, 3000),
    ];
});
