<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Customer::create([
            'surname' => $faker->name,
            'user_id' => 2
        ]);
    }
}
