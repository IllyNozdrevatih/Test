<?php

use Faker\Generator as Faker;

$factory->define(App\Region::class, function (Faker $faker) {
    return [
        'title'=>$faker->name,
        'city_id'=> random_int(1,9)
    ];
});
