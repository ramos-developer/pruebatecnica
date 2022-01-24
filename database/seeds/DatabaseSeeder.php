<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
        $this->call([
            // ProfileTableSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            HobbieSeeder::class,
            CustomerHobbieSeeder::class
        ]);
	}
}
