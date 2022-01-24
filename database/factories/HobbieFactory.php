<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Hobbie::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
