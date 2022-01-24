<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
