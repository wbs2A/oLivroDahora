<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Friend::class, function (Faker $faker) {
    return [
        'user_id'=>   $faker->numberBetween($min=1, $max=21),
        'friend_id'=> $faker->numberBetween($min=1, $max=21)
    ];
});
