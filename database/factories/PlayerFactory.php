<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'age' => $faker->numberBetween(17, 35),
        'weight' => $faker->numberBetween(57, 85),
        'height' => $faker->numberBetween(160, 210),
        'market_value' => $faker->numberBetween(100000, 999999999),
        'post' => $faker->randomElements(['gk', 'cb', 'lb', 'rb', 'cmf', 'lmf', 'rmf', 'dmf', 'amf', 'ss', 'rwf', 'lwf', 'cf'], 2, false)
    ];
});
