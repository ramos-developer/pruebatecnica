<?php

use Bloonde\UsersAndPrivileges\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(array(
            'name' => 'admin',
            'email' => 'admin@email.com',
            'activated' => 1,
            'password' => bcrypt('123456789'),
        ));
        \Bloonde\UsersAndPrivileges\Profile::find(\App\Helpers\ProfileHelper::ADMIN_PROFILE)->users()->attach($admin->id);

        $customer = User::create(array(
            'name' => 'Customer',
            'email' => 'customer@email.com',
            'activated' => 1,
            'password' => bcrypt('123456789'),
        ));
        \Bloonde\UsersAndPrivileges\Profile::find(\App\Helpers\ProfileHelper::CUSTOMER_PROFILE)->users()->attach($customer->id);

    }
}
