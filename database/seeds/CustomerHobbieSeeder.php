<?php

use App\Models\CustomerHobbie;
use Illuminate\Database\Seeder;

class CustomerHobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CustomerHobbie::class, 50)->create();
    }
}
