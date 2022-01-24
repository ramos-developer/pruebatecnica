<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Hobbie;

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'customer_id' => Customer::inRandomOrder()->first()->id,
        'hobbie_id' => Hobbie::inRandomOrder()->first()->id
    ];
});
