<?php

use App\Models\Hobbie;
use Illuminate\Database\Seeder;

class HobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Hobbie::class, 10)->create();
    }
}
