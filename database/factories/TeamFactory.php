<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'type' => $faker->randomElement(['club', 'national']),
        'rank' => $faker->numberBetween(1,300)
    ];
});
