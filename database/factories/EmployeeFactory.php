<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position' => $faker->jobTitle,
        'hired' => $faker->date(),
        'salary' => $faker->numberBetween(200, 3000),
        'parent_id' => null,
    ];
});
