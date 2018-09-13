<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'title'=> $faker->city,
        'area_id' => random_int(1,3)
    ];
});
