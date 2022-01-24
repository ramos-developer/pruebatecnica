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
            'name' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'activated' => 1,
            'password' => bcrypt('123456789'),
        ));

        $admin = User::create(array(
            'name' => 'Admin Company',
            'email' => 'admincompany@email.com',
            'activated' => 1,
            'password' => bcrypt('123456789'),
        ));

        $admin = User::create(array(
            'name' => 'User Final',
            'email' => 'userfinal@email.com',
            'activated' => 1,
            'password' => bcrypt('123456789'),
        ));
    }
}
