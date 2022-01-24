<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'surname' => $faker->name,
        'user_id' => \Bloonde\UsersAndPrivileges\User::inRandomOrder()->first()->id
    ];
});
