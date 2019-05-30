<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Chat::class, function (Faker $faker) {
    return [
        'user_id'   =>   $faker->numberBetween($min=1, $max=21),
        'friend_id' =>   $faker->numberBetween($min=1, $max=21),
        'chat'      =>   $faker->text($maxNbChars = 150)
    ];
});
