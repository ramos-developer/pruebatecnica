<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ['name' => 'admin'],
            ['name' => 'customer'],
        ];

        foreach($profiles as $profile){
            \Bloonde\UsersAndPrivileges\Profile::create($profile);
        }
    }
}
